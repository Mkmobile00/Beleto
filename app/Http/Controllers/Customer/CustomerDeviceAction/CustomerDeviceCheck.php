<?php
namespace App\Actions\Api\CustomerDeviceAction;

use App\Models\Api\CustomerDeviceList;
use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use Carbon\Carbon;

class CustomerDeviceCheck{
    
    protected $customer;
    protected $request;
    protected $customerHasSubscription=false;
    public function __construct(Request $request,Customer $customer)
    {
        $this->customer=$customer;     
        $this->request=$request;   
    }

    public function checkSubscription()
    {
        $customerSubscription=$this->customer->subscription->where('is_expired','0');
        if(count($customerSubscription) > 0){
            $this->customerHasSubscription=true;
        }else{
            $this->customerHasSubscription=false;
        }
        return $this->customerHasSubscription;
    }

    public function checkDeviceList(){
        $customerSubscriptionListCount=$this->customer->subscription->unique('subscription_id')->map(function($subItem){
           return $subItem->subscription->plan->screensize ?? 0;
        })->max();
        $customerDeviceList=$this->customer->deviceList;
        $mainDevice=$customerDeviceList->where('main','1');
        if(count($customerDeviceList) >=$customerSubscriptionListCount){
            return false;
        }else{
            return true;
        }
    }
}