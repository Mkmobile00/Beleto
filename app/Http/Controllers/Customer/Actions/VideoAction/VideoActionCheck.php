<?php
namespace App\Actions\VideoAction;

use Carbon\Carbon;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use App\Enum\Plan\CategoryTypeEnum;
use App\Models\Api\CustomerDeviceList;
use App\Models\PlanContent;
use App\Models\PremiumContent;

class VideoActionCheck{

    protected $customer;
    protected $request;
    protected $movies;
    protected $currentDate;
    public function __construct(Request $request,Customer $customer)
    {
        $this->request=$request;
        $this->customer=$customer;
        $this->currentDate=Carbon::now()->format('Y-m-d');
    }
    public function check(){
        $checkDeviceSerialNum=CustomerDeviceList::where('device_serial_num',$this->request->device_serial_num)->first();
        if(!$checkDeviceSerialNum){

            return [
                'status'=>false,
                'msg'=>'Unauthorized Device !!'
            ];
        }
        $customerSubscription=$this->customer->subscription->where('is_expired','0');
        if(count($customerSubscription) <= 0){
            return [
                'status'=>false,
                'msg'=>'No Subscription Found !!'
            ];
        }
        $currentDate=Carbon::now()->format('Y-m-d');
        $finalCheckDate=collect($customerSubscription)->max('to_date');
        if($currentDate > $finalCheckDate){
            return [
                'status'=>false,
                'msg'=>'Subscription Expired !!'
            ];
        }
        return [
            'status'=>true,
            'msg'=>'Success !!'
        ];
       
    }

    public function checkPremiumDevice(){
        $checkDeviceSerialNum=CustomerDeviceList::where('device_serial_num',$this->request->device_serial_num)->first();
        if(!$checkDeviceSerialNum){

            return [
                'status'=>false,
                'msg'=>'Unauthorized Device !!'
            ];
        }
        
        return [
            'status'=>true,
            'msg'=>'Success !!'
        ];
       
    }

    public function checkContent($movies){
        $this->movies=$movies;
        switch((int)$movies->type){
            case 1: //Movie Category
                $status=$this->checkMoviesCategoryAccess();
                if(!$status){
                    return $this->invalidResponse();
                }
                $this->setVideoCount($movies,$this->customer);
                return $this->isSuccessResponse();
                break;
            case 2: // Tv Series
                $status=$this->checkTvSeriesAccess();
                if(!$status){
                    return $this->invalidResponse();
                }
                $this->setVideoCount($movies,$this->customer);
                return $this->isSuccessResponse();
                break;
            case 3: // Web Series
                $status=$this->checkWebSeriesAccess();
                if(!$status){
                    return $this->invalidResponse();
                }
                $this->setVideoCount($movies,$this->customer);
                return $this->isSuccessResponse();
                break;
            default:
            return $this->invalidResponse();
        }
    }

    public function setVideoCount($movies,$customer){
        new VideoViewCount($movies,$customer);
    }
    public function checkMoviesCategoryAccess(){
        $customerSubscription=$this->customer->subscription->where('is_expired','0')->pluck('subscription_id');
        $customerSubscriptionData=Subscription::whereIn('id',$customerSubscription)->get()->pluck('plan_id');
        $customerPlanData=Plan::whereIn('id',$customerSubscriptionData)->get();
        $premimumContentValue=$customerPlanData->pluck('premium_content');
        $checkStatus=false;
        $premimumContentValue->map(function($item) use (&$checkStatus){
            if($item =='1'){
                $checkStatus=true;
            }
        });
        if($checkStatus){
            $checkStatus=false;
            $planContent=PlanContent::first();
            $content=json_decode($planContent->content);
            $checkStatus=in_array(1,$content);
            if($checkStatus){
                $checkStatus=false;
                $categoryItem=json_decode($planContent->categoryitem);
                foreach ($this->movies->movieHasCategories->pluck('id') as $id){
                    if (in_array($id, $categoryItem)) {
                        $checkStatus = true;
                        break; 
                    }
                }
            }
        }
        return $checkStatus;
    }

    public function checkTvSeriesAccess(){
        $customerSubscription=$this->customer->subscription->where('is_expired','0')->pluck('subscription_id');
        $customerSubscriptionData=Subscription::whereIn('id',$customerSubscription)->get()->pluck('plan_id');
        $customerPlanData=Plan::whereIn('id',$customerSubscriptionData)->get();
        $premimumContentValue=$customerPlanData->pluck('premium_content');
        $checkStatus=false;
        $premimumContentValue->map(function($item) use (&$checkStatus){
            if($item =='1'){
                $checkStatus=true;
            }
        });
        if($checkStatus){
            $checkStatus=false;
            $planContent=PlanContent::first();
            $content=json_decode($planContent->content);
            $checkStatus=in_array(2,$content);
            
        }
        return $checkStatus;
    }

    public function checkWebSeriesAccess(){
        $customerSubscription=$this->customer->subscription->where('is_expired','0')->pluck('subscription_id');
        $customerSubscriptionData=Subscription::whereIn('id',$customerSubscription)->get()->pluck('plan_id');
        $customerPlanData=Plan::whereIn('id',$customerSubscriptionData)->get();
        $premimumContentValue=$customerPlanData->pluck('premium_content');
        $checkStatus=false;
        $premimumContentValue->map(function($item) use (&$checkStatus){
            if($item =='1'){
                $checkStatus=true;
            }
        });
        if($checkStatus){
            $checkStatus=false;
            $planContent=PlanContent::first();
            $content=json_decode($planContent->content);
            $checkStatus=in_array(3,$content);
            
        }
        return $checkStatus;
    }

    public function invalidResponse(){
        return [
            'status'=>false,
            'msg'=>'Sorry You Have No Access !!'
        ];
    }


    public function isSuccessResponse(){
        return [
            'status'=>true,
            'msg'=>'Success !!'
        ];
    }
}