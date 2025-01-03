<?php
namespace App\Actions\Customer;

use Exception;
use App\Events\PaymentEvent;
use Illuminate\Http\Request;
use App\Models\PremiumContent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\PremiumContentPayment;
use App\Actions\Payment\PaymentHistoryAction;

class SavePremiumPaymentAction{

    protected $request;
    protected $premiumContent;
    protected $premiumContentPayment;
    public function __construct(Request $request,PremiumContent $premiumContent,PremiumContentPayment $premiumContentPayment)
    {
        $this->request=$request;
        $this->premiumContent=$premiumContent;
        $this->premiumContentPayment=$premiumContentPayment;
    }
    public function saveSubscriptionPayment($finalAmount,$typeValue='npr'){
        try{
            $customer=Auth::guard('customer')->user();
            if(!$customer){
                throw new Exception();
            }
            $premiumContent=$this->premiumContent;
            if(!$premiumContent){
                throw new Exception();
            }
            $value=[
                'premium_content_id'=>$premiumContent->id,
                'customer_id'=>$customer->id,
                'amount'=>$finalAmount
            ];
            $this->premiumContentPayment->fill($value);
            $this->premiumContentPayment->save();
            $paymentData = (new PaymentHistoryAction(
                $customer->id,
                get_class($this->premiumContentPayment->getModel()),
                $this->premiumContentPayment->id,
                $this->request->transaction_id,
                'Premium Content Payment',
                $value['amount'],
                $typeValue,
                (int)$this->request->payment_type,
                $this->request->remarks ?? ''
            ))->getData();
            event(new PaymentEvent($paymentData));
            return true;
        }catch(\Throwable $th){
            return false;
        }
    }
}