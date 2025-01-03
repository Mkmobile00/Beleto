<?php
namespace App\Actions\Payment;

use Exception;
use App\Models\Currency;
use App\Events\PaymentEvent;
use App\Models\CurrencyRate;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Customer\Customer;
use App\Models\SubscriptionPayment;
use App\Models\SubscriptionPaymentType;

class SubscriptionPaymentAction{

    protected $request;
    protected $subscriptionPayment;
    protected $data;
    protected $customer;
    protected $subscriptionPaymentType;
    public function __construct(Request $request,SubscriptionPayment $subscriptionPayment,Customer $customer,$subscriptionPaymentType)
    {
        $this->request=$request;
        $this->subscriptionPayment=$subscriptionPayment;
        $this->data=$this->request->all();
        $this->customer=$customer;
        $this->data['customer_id']=$customer->id;
        $this->subscriptionPaymentType=$subscriptionPaymentType;
    }

    public function subscriptionCallBackAction(){
        
        $subscription=Subscription::where('id',$this->request->subscription_id)->first();
        if(!$subscription){
            $response = [
                'error' => true,
                'data' => null,
                'msg' => 'Sorry The Subscription Not Available At This Momoent !!'
            ];
            return response()->json($response, 200);
        }
        $customerDefaultCurrency=$this->customer->cutomerDefaultCurrency;
        $customerAmount=(float)$this->request->amount;
        $this->data['amount_type']='npr';
        $this->data['payment_code']='NPR';
        // if($customerDefaultCurrency){
        //     $subscriptionAmount=round((float)$subscription->price,4);
        //     $this->data['amount_type']='usd';
        //     $this->data['payment_code']=$customerDefaultCurrency;
        //     $difference = abs($subscriptionAmount - $customerAmount);

        //     if ($difference > 10) {
        //         throw new Exception('Amount must be same with subscription amount!');
        //     }   
        //     // if($subscriptionAmount !=$customerAmount){
        //     //     throw new Exception('Amount Must Be Same With Subscription Amount !! ');
        //     // }
           
        // }else{
        //     $todayUsdPrice=CurrencyRate::where('code','USD')->first();
        //     $todayUsdPrice=((float)$todayUsdPrice->rate/(float)$todayUsdPrice->unit);
        //     $payableAmount=round(((float)$subscription->price)*$todayUsdPrice,4);
        //     $difference = abs($payableAmount - $customerAmount);
        //     if ($difference > 10) {
        //         throw new Exception('Amount must be same with subscription amount!');
        //     } 
        //     // if($payableAmount !=$customerAmount){
        //     //     throw new Exception('Amount Must Be Same With Subscription Amount !! ');
        //     // }
        // }
        $setDate=(new SubscriptDateAction($subscription,$this->customer))->setSubscriptionDate();
        $this->data=array_merge($setDate,$this->data);
        $alreadySubscription=SubscriptionPayment::where('subscription_id',$subscription->id)->where('customer_id',$this->customer->id)->first();
        if($alreadySubscription){
            $this->data['is_expired']='0';
            $alreadySubscription->fill($this->data);
            $alreadySubscription->save();
            $this->subscriptionPaymentType->fill($this->data);
            $this->subscriptionPaymentType->save();
            $paymentData = (new PaymentHistoryAction(
                $this->customer->id,
                get_class($alreadySubscription->getModel()),
                $alreadySubscription->id,
                $alreadySubscription->transaction_id,
                'Subscription Payment',
                $customerAmount,
                $this->data['amount_type'],
                (int)$this->data['payment_type'],
                $this->request->remarks ?? ''
            ))->getData();
        }else{
            $this->data['payment_type']=json_decode($this->data['payment_type']);
            $this->subscriptionPayment->fill($this->data);
            $this->subscriptionPayment->save();
            $this->subscriptionPaymentType->fill($this->data);
            $this->subscriptionPaymentType->save();
            $paymentData = (new PaymentHistoryAction(
                $this->customer->id,
                get_class($this->subscriptionPayment->getModel()),
                $this->subscriptionPayment->id,
                $this->subscriptionPayment->transaction_id,
                'Subscription Payment',
                $customerAmount,
                $this->data['amount_type'],
                (int)$this->data['payment_type'],
                $this->request->remarks ?? ''
            ))->getData();
           
        }
        event(new PaymentEvent($paymentData));
    }
}