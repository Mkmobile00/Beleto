<?php

namespace App\Http\Controllers\Api;

use App\Models\Plan;
use App\Models\PlanContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\CurrencyRate;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function subscription()
    {
        $customer=Auth::user();
        $planContent = PlanContent::first();
        $plans = Plan::where('status','active')->get();
        $plansDatas = [];
        $plansContents = [];
        $customerCurrencyType='NPR';
        $currencyRate=1;
        $convertPrice=1;
        $usdCurrencyPrice=CurrencyRate::where('code','USD')->first();
        if($usdCurrencyPrice){
            $usdCurrencyPrice=(float)$usdCurrencyPrice->rate/(float)$usdCurrencyPrice->unit;
        }
        if($customer->cutomerDefaultCurrency){
            $currencyRateData=$customer->cutomerDefaultCurrency->currency;
            $customerCurrencyType=$currencyRateData->code;
            $currencyRate=((float)$currencyRateData->rate/(float)$currencyRateData->unit);
        }else{
            $convertPrice=100;
        }
        foreach ($plans as $key => $planData) {
            $plansDatas[$key] = [
                'id' => $planData->id,
                "title" => $planData->title,
                "features" => [
                    $planData->premium_content ? true :false,
                    $planData->livetv ? true :false,
                    $planData->addfree ? true :false,
                    $planData->download ? true :false,
                    ($planData->device != 'null') ? $planData->device() : '',
                    $planData->screensize,
                    ($planData->video_quality != 'null') ? $planData->videoQuality() : '',
                    ($planData->audio_quality != 'null') ? $planData->audioQuality() : '',
                ],
                'subscription' => collect($planData->subscription)->map(function ($item) use($customerCurrencyType,$usdCurrencyPrice,$currencyRate,$customer,$convertPrice) {
                    $item->period_id = $item->period->value . '(' . $item->period->type->name . ')';
                    $item->currency_type=$customerCurrencyType ?? "NPR";
                    if($customer->cutomerDefaultCurrency){
                        $item->price=round(($item->price * $usdCurrencyPrice)/$currencyRate,4);
                    }else{
                        $item->price=round(($item->price * $convertPrice),4);
                    }
                    // $item->price=round(($item->price * $usdCurrencyPrice)/$currencyRate,4);
                    $item->makeHidden('period');
                    return $item;
                })
            ];
        }
        $finalData = [];
        $finalData = [
            'data' => [
                'premium_content' => [
                    'title' => 'Premium Content',
                    'item' => ($planContent->premium_content != 'null') ? $planContent->premiumContent() : ''
                ],
                'live_tv' => [
                    'title' => 'Live Tv',
                    'item' =>  $planContent->livetv
                ],
                'add_free' => [
                    'title' => 'Add free',
                    'item' => $planContent->addfree
                ],
                'download' => [
                    'title' => 'Download',
                    'item' => $planContent->download
                ],
                'device' => [
                    'title' => 'Device',
                    'item' => ($planContent->device != 'null') ? $planContent->device() : ''
                ],
                'no_of_screen' => [
                    'title' => 'No. of screens',
                    'item' => $planContent->size ?? ''
                ],
                'video_quality' => [
                    'title' => 'Max video quality',
                    'item' => ($planContent->video_quality != 'null') ? $planContent->videoQuality() : ''
                ],
                'audio_quality' => [
                    'title' => 'Max audio quality',
                    'item' => ($planContent->audio_quality != 'null') ? $planContent->audioQuality() : ''
                ]
            ],
            'plan' => $plansDatas

        ];
        $response = [
            'error' => false,
            'data' => $finalData,
            'msg' => 'Subscription !!'
        ];
        return response()->json($response, 200);
    }
}
