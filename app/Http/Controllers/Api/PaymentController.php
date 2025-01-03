<?php

namespace App\Http\Controllers\Api;
use App\Events\PaymentEvent;
use Illuminate\Http\Request;
use App\Enum\PaymentTypeEnum;
use App\Models\PremiumContent;
use App\Enum\Device\DeviceEnum;
use App\Enum\PaymentStatusEnum;
use Illuminate\Validation\Rule;
use App\Models\Customer\Customer;
use Illuminate\Support\Facades\DB;
use App\Models\SubscriptionPayment;
use Illuminate\Support\Facades\Log;
use App\Enum\Customer\MovieTypeEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PremiumContentPayment;
use App\Models\SubscriptionPaymentType;
use Illuminate\Support\Facades\Validator;
use App\Actions\Payment\PaymentHistoryAction;
use App\Actions\Payment\SubscriptionPaymentAction;
use App\Actions\Api\CustomerDeviceAction\CustomerAddDevice;
use Exception;

class PaymentController extends Controller
{
    protected $subscriptionPayment;
    protected $subscriptionPaymentType;
    protected $premiumContentPayment;
    public function __construct(SubscriptionPayment $subscriptionPayment,SubscriptionPaymentType $subscriptionPaymentType,PremiumContentPayment $premiumContentPayment)
    {
        $this->subscriptionPayment=$subscriptionPayment;
        $this->subscriptionPaymentType=$subscriptionPaymentType;
        $this->premiumContentPayment=$premiumContentPayment;
    }
    public function subscriptionPayment(Request $request){
        $customer=Auth::user();
        if(!$customer){
            $response = [
                'error' => true,
                'data' => null,
                'msg' =>'UnAuthorized User !!',
            ];
            return response()->json($response, 200);
        }
        $validator = Validator::make($request->all(), [
            'subscription_id'=>'required|exists:subscriptions,id',
            'payment_type'=>['required',Rule::in(PaymentTypeEnum::ESEWA,PaymentTypeEnum::KHALTI,PaymentTypeEnum::PRABHUPAY,PaymentTypeEnum::IMEPAY,PaymentTypeEnum::BANK,PaymentTypeEnum::PAYPAL,PaymentTypeEnum::HAMROPAY)],
            'payment_status'=>['required',Rule::in(PaymentStatusEnum::SUCCESS,PaymentStatusEnum::PENDING,PaymentStatusEnum::CANCELLED)],
            'amount'=>'required',
            'transaction_id'=>'required|string',
            'device_type'=>['required',Rule::in(DeviceEnum::MOBILE,DeviceEnum::TV,DeviceEnum::BROWSER)],
            'device_name'=>'required|string',
            'device_serial_num'=>'required|string'
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }

        
        
        DB::beginTransaction();
        try{
            
            $data=(new SubscriptionPaymentAction($request,$this->subscriptionPayment,$customer,$this->subscriptionPaymentType))->subscriptionCallBackAction();
            $deviceList=$customer->deviceList;
            foreach($deviceList as $list){
                $list->delete();
            }
            (new CustomerAddDevice($customer))->setDeviceListMain($request);
            $paymentHistory=$customer->paymentHistories;
            DB::commit();
            $response = [
                'error' => false,
                'data' => null,
                'msg' => 'Subscription Added Successfully !!',
                'invoice_num'=>$paymentHistory->last()->transaction_id ?? null
            ];
            return response()->json($response, 200);
        }catch(\Throwable $th){
            DB::rollBack();
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $th->getMessage()
            ];
            return response()->json($response, 200);
        }
    }

   

    public function primiumPayment(Request $request){
        $customer=Auth::user();
        $type=$request->type;
        if(!$customer){
            $response = [
                'error' => true,
                'data' => null,
                'msg' =>'UnAuthorized User !!',
            ];
            return response()->json($response, 200);
        }

        if(!$type){
            $response = [
                'error' => true,
                'data' => null,
                'msg' =>'Type Field Required !!',
            ];
            return response()->json($response, 200);
        }

        $rules=[
            'premium_content_id'=>"required|exists:premium_contents,id",
            'type'=>["required",Rule::in(MovieTypeEnum::MOVIE,MovieTypeEnum::TVSERIES,MovieTypeEnum::WEBSERIES)],
            'payment_type'=>['required',Rule::in(PaymentTypeEnum::ESEWA,PaymentTypeEnum::KHALTI,PaymentTypeEnum::PRABHUPAY,PaymentTypeEnum::IMEPAY,PaymentTypeEnum::BANK)],
            'payment_status'=>['required',Rule::in(PaymentStatusEnum::SUCCESS,PaymentStatusEnum::PENDING,PaymentStatusEnum::CANCELLED)],
            'amount'=>'required',
            'transaction_id'=>'required|string',
            // 'device_type'=>['required',Rule::in(DeviceEnum::MOBILE,DeviceEnum::TV,DeviceEnum::BROWSER)],
            // 'device_name'=>'required|string',
            // 'device_serial_num'=>'required|string'
        ];
        switch((int)$request->type){
            case 1:
                $rules["movieId"] = 'required|exists:movies,id';
                break;
            case 2:
                $rules["movieId"] = 'required|exists:tv_series,id';
                break;
            case 3:
                $rules["movieId"] = 'required|exists:web_series,id';
                break;
            default:
                return false;
        }

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            $response = [
                'validate' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        
        DB::beginTransaction();
        try{
            $premiumContent=PremiumContent::where('id',$request->premium_content_id)->where('movie_id',$request->movieId)->where('type',$request->type)->first();
            if(!$premiumContent){
                return "kera";
               return $this->responseApiError('Something Went Wrong !!',null,200);
            }
            // if((int)$request->amount != (int)$premiumContent->amount){
            //     return $this->responseApiError('Amount Must Be Equals To'.$premiumContent->amount.' !!',null,200);
            // }
            $value=[
                'premium_content_id'=>$premiumContent->id,
                'customer_id'=>$customer->id,
                'amount'=>$request->amount
            ];
            $this->premiumContentPayment->fill($value);
            $this->premiumContentPayment->save();
            $paymentData = (new PaymentHistoryAction(
                $customer->id,
                get_class($this->premiumContentPayment->getModel()),
                $this->premiumContentPayment->id,
                $request->transaction_id,
                'Premium Content Payment',
                $value['amount'],
                'npr',
                (int)$request->payment_type,
                $request->remarks ?? ''
            ))->getData();
            event(new PaymentEvent($paymentData));
            DB::commit();
            $response = [
                'error' => false,
                'data' => null,
                'msg' => 'Premium Content Payment Successfull !!',
                'invoice_num'=>$request->transaction_id ?? ''
            ];
            return response()->json($response, 200);
        }catch(\Throwable $th){
            DB::rollBack();
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $th->getMessage()
            ];
            return response()->json($response, 200);
        }
       
        
    }
    

    public function redirect(Request $request){
        Log::info($request->all());
        $response=[
            'error'=>false,
            'data'=>$request->all(),
            'msg'=>'Khalti Redirect'
        ];
        return response()->json($response,200);
        // return $request->all();
    }
}
