<?php
namespace App\Actions\Api\PremiumContent;

use App\Models\Customer\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PremiumContentAction{

    protected $currentDate;
    protected $customer;
    protected $movie;
    protected $premiumContentData;
    public function __construct(Customer $customer,$movie)
    {
        $this->currentDate=Carbon::now()->format('Y-m-d');
        $this->customer=$customer;
        $this->movie=$movie;
    }
    public function invalidPremiumResponse(){
        return [
            'id'=>$this->premiumContentData->id,
            'status'=>true,
            'price'=>(int)$this->premiumContentData->price ?? 0,
            'msg'=>'Sorry Plz Get Premium Content To Watch This Video !!'
        ];
    }

    public function noPremium(){
        return null;
    }


    public function checkPremium(){
        $status=$this->checkPremiumAccess();
        if($status){
            return $this->invalidPremiumResponse();
        }
        return $this->noPremium();
    }

    public function checkPremiumAccess(){
        $premiumCheckStatus=false;
        $isPremiumContent=$this->movie->isPremium;
        // dd($isPremiumContent);
        $this->premiumContentData=$isPremiumContent;
        if($isPremiumContent){
            if($isPremiumContent->is_premium=='1'){
                $fromDate=$isPremiumContent->from ?? null;
                $toDate=$isPremiumContent->to ?? null;
                if($fromDate && $toDate){
                    if($this->currentDate <= $toDate){
                        $premiumCheckStatus=true;
                    }else{
                        $premiumCheckStatus=false;
                    }
                }else{
                    $premiumCheckStatus=true;
                }
            }
        }
        return $premiumCheckStatus;
    }
    
}