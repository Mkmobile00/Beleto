<?php
namespace App\Actions\Payment;

use App\Models\Subscription;
use Illuminate\Support\Carbon;
use App\Enum\Period\PeriodTypeEnum;
use App\Models\Customer\Customer;
use App\Models\SubscriptionPayment;
use Exception;

class SubscriptDateAction{

    protected $subscription;
    protected $currentDate;
    protected $customer;
    
    public function __construct(Subscription $subscription,Customer $customer)
    {
        $this->subscription=$subscription;
        $this->customer=$customer;
    }

    public function setSubscriptionDate(){
        $this->currentDate=Carbon::now();
        $purchaseDate=$this->currentDate->format('Y-m-d');
        $fromDate=$purchaseDate;
        $toDate=null;
        $alreadySubscription=SubscriptionPayment::where('subscription_id',$this->subscription->id)->where('customer_id',$this->customer->id)->first();
        if($alreadySubscription){
            switch($this->subscription->period->type){
                case PeriodTypeEnum::MONTH:
                    $toDate=$this->calculateFinalMonth(Carbon::parse($alreadySubscription->to_date),$this->subscription->period->value);
                    break;
                case PeriodTypeEnum::YEAR:
                    $toDate=$this->calculateFinalYear(Carbon::parse($alreadySubscription->to_date),$this->subscription->period->value);
                    break;
                default:
                throw new Exception();
                    break;
            }
        }else{
            switch($this->subscription->period->type){
                case PeriodTypeEnum::MONTH:
                    $toDate=$this->calculateFinalMonth($this->currentDate,$this->subscription->period->value);
                    break;
                case PeriodTypeEnum::YEAR:
                    $toDate=$this->calculateFinalYear($this->currentDate,$this->subscription->period->value);
                    break;
                default:
                throw new Exception();
                    break;
            }
        }
        if(!$purchaseDate && $fromDate && $toDate){
            throw new Exception('Paurchase Not Not Valid !! ');
        }
        $data=[
            'purchase_date'=>$purchaseDate,
            'from_date'=>$fromDate,
            'to_date'=>$toDate
        ];
        return $data;
    }

    public function calculateFinalMonth($date,$value){
        $finalDate=$date->addMonths($value);
        return $finalDate->format('Y-m-d');
    }
    public function calculateFinalYear($date,$value){
        $finalDate=$date->addYears($value);
        return $finalDate->format('Y-m-d');
    }
}