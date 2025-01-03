<?php
namespace App\Actions\Api\PremiumContent;

use App\Models\PremiumContent;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PhpParser\Node\Stmt\Break_;

class PremiumContentActionUnAuthorized{

    protected $currentDate;
    protected $movie;
    protected $premiumContentData;
    public function __construct($movie)
    {
        $this->currentDate=Carbon::now()->format('Y-m-d');
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
        switch((int)$this->movie['type']){
            case 1:
                $status=$this->checkMoviesPremium('1');
                if($status){
                    return $this->invalidPremiumResponse();
                }
                return $this->noPremium();
                break;
            case 2:
                $status=$this->checkMoviesPremium('2');
                if($status){
                    return $this->invalidPremiumResponse();
                }
                return $this->noPremium();
                break;
            case 3:
                $status=$this->checkMoviesPremium('3');
                if($status){
                    return $this->invalidPremiumResponse();
                }
                return $this->noPremium();
                break;
            default:
            return false;
        }
        
    }

    public function checkMoviesPremium($type){
        
        $premiumCheckStatus=false;
        $isPremiumContent=PremiumContent::where('movie_id',$this->movie['id'])->where('type',$type)->first();
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