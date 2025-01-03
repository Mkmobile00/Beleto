<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerDetail;
use App\Models\PaymentHistory;
use Illuminate\Support\Carbon;
use App\Models\Customer\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\CustomerProfileUpdateRequest;
use App\Models\Api\CustomerDeviceList;
use Exception;

class CustomerDashboardController extends Controller
{
    protected $customer;
    public function __construct(Customer $customer)
    {
      $this->customer=$customer;  
    }
    public function index(){
        return view('customerdashboard.dashboard');
    }

    public function allSubscription(){
        $this->customer=Auth::guard('customer')->user();
        $today = Carbon::today();
        $future_date = Carbon::createFromFormat('Y-m-d', '2026-02-09');
        $days_left = $today->diffInDays($future_date);
        $allSubscription = $this->customer->subscription->map(function ($item) use ($today) {
            $future_date = Carbon::createFromFormat('Y-m-d', $item->to_date);
            $days_left = $today->diffInDays($future_date);
            return [
                'title' => $item->subscription->title,
                'is_expired'=>$item->is_expired,
                'days' => $item->subscription_id,
                'total_days' => (Carbon::parse($item->from_date))->diffInDays(Carbon::parse($item->to_date)),
                'left_days' => $days_left,
                'percentage' => round(($days_left / (Carbon::parse($item->from_date))->diffInDays(Carbon::parse($item->to_date))) * 100),
                'from' => Carbon::parse($item->from_date)->formatLocalized('%d %B, %Y'),
                'to' => Carbon::parse($item->to_date)->formatLocalized('%d %B, %Y')
            ];
        });
        return view('customerdashboard.subscriptionlist',compact('allSubscription'));
    }

    public function allPayments(Request $request){
        $this->customer=Auth::guard('customer')->user();
        $paymentHistories = $this->customer->paymentHistories->map(function ($item) {
            return [
                'title' => 'Online Payment',
                'amount' => ($item->amount_type == 'npr' ? 'NPR ' : '$ ') . $item->amount,
                'operator' => $item->payment_type->name,
                'type' => 'Online',
                'invoice_num' => $item->transaction_id,
                'for_payment' => $item->purpose,
                'date' => Carbon::parse($item->created_at)->formatLocalized('%d %B, %Y')
            ];
        });
        return view('customerdashboard.paymentlist',compact('paymentHistories'));
    }

    public function updateProfile(CustomerProfileUpdateRequest $request){
        try{
            $customer=Auth::guard('customer')->user();
            $data = $request->except('image');
            if ($request->image && $request->image != null) {
                $image_name = uploadProfileImage($request->image, 'customer', '200x200');
                if ($image_name) {
                    $data['photo'] = $image_name;
                }
            }
            if ($customer->customerDetail) {
                $customer->customerDetail['photo_status']='main';
                $customer->customerDetail->fill($data);
                $customer->customerDetail->save();
            } else {
                $temp = [
                    'customer_id' => $customer->id,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'gender' => $request->gender,
                    'date_of_birth' => $request->date_of_birth,
                    'photo' => $data['image'] ?? null,
                    'photo_status'=>'main'
                ];

                CustomerDetail::insert($temp);
            }

            DB::commit();
            $request->session()->flash('success','Profile Updated Successfully !!');
            return redirect()->back();
        }catch(\Throwable $th){
            DB::rollBack();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password'=>'required|string',
            'password'=>'required|string|confirmed',
            'password_confirmation'=>'required|string',
        ]);
        if ($validator->fails()) {
            $response = [
                'validate' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }

        $customer=Auth::guard('customer')->user();
        $d=$request->old_password;
        $result=Hash::check($d, $customer->password);
        if(!$result)
        {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => 'Your Old Password Doesnot Match Our Records  !'
            ];
            return response()->json($response, 200);
        }

        $customer->password=bcrypt($request->password);
        $status=$customer->save();

        if($status)
        {
            Session::flush();
            Auth::guard('customer')->logout();
            $response = [
                'error' => false,
                'data' => null,
                'msg' => 'Your Password Has Been Updated Successfully !'
            ];
            return response()->json($response, 200);
        }
        else
        {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => 'Sorry ! There Was A Problem While Updating Your Password !!'
            ];
            return response()->json($response, 200);
        }
    }

    public function downloadInvoice(Request $request,$invoiceNum){
        if (!$invoiceNum) {
            return $this->responseApiError('Invoice Num Required...', null, 200);
        }
        $item = PaymentHistory::where('transaction_id', $invoiceNum)->first();
        // dd($item);
        if (!$item) {
            return $this->responseApiError('Something Went Wrong !!', null, 200);
        }
        $subscriptionData = $item->from_model::where('id', $item->model_id)->first();
        // dd($subscriptionData);
        $data = [
            'title' => 'Online Payment',
            'amount' => ($item->amount_type == 'npr' ? 'NPR ' : '$ ') . $item->amount,
            'operator' => $item->payment_type->name,
            'type' => 'Online',
            'invoice_num' => $item->transaction_id,
            'for_payment' => $item->purpose,
            'date' => Carbon::parse($item->created_at)->formatLocalized('%d %B, %Y')
        ];

        return view('frontend.order_detail',$data);
    }

    public function customerAllDeviceList(){
        $customer=Auth::guard('customer')->user();
        return view('customerdashboard.devicelist',compact('customer'));
    }

    public function customerDeleteDeviceList(Request $request,$id){
        $computerId = $_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'];
        // dd($request->all(),$computerId);
        DB::beginTransaction();
        try{
            $customer=Auth::guard('customer')->user();
            if(!$customer){
                throw new Exception();
            }
            $deviceData=CustomerDeviceList::where('customer_id',$customer->id)->where('id',$id)->first();
            $deviceIpAddress=$deviceData->device_serial_num;
            $deviceData->delete();
            DB::commit();
            if($deviceIpAddress==$computerId){
                Session::flush();
                Auth::guard('customer')->logout();
                request()->session()->flash('success', 'Your Current Device Has Been Removed !!');
                return redirect()->route('home');
            }
            $request->session()->flash('success','Device Deleted Successfully !!');
            return redirect()->back();
        }catch(\Throwable $th){
            DB::rollBack();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }
}
