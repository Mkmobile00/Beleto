<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use App\Models\CurrencyRate;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\PremiumContent;
use Illuminate\Support\Facades\DB;
use App\Models\PremiumContentPayment;
use Illuminate\Support\Facades\Session;
use App\Actions\Customer\ImepayValidate;
use App\Actions\Customer\HamroPayValidate;
use App\Actions\Customer\SavePaymentAction;
use App\Actions\Customer\SavePremiumPaymentAction;

class PaymentActionController extends Controller
{
    public function khaltiCallBackAction(Request $request, $id)
    {
        $currencyRate = 1;
        $usdCurrencyPrice = CurrencyRate::where('code', 'USD')->first();
        if ($usdCurrencyPrice) {
            $usdCurrencyPrice = (float)$usdCurrencyPrice->rate / (float)$usdCurrencyPrice->unit;
        }
        $subscription = Subscription::where('id', $id)->first();
        if (!$subscription) {
            $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect()->route('home');
        }
        $actualPriceInUsd=$subscription->price;
        $subscription->period_id = $subscription->period->value . '(' . $subscription->period->type->name . ')';
        $subscription->currency_type = $customerCurrencyType ?? "NPR";
        $subscription->price = round(($subscription->price * $usdCurrencyPrice) / $currencyRate, 4);
        $subscription->price=$actualPriceInUsd*100;
        DB::beginTransaction();
        try {
            $data = (new SavePaymentAction($request, $subscription))->saveSubscriptionPayment();
            if (!$data) {
                throw new Exception();
            }
            DB::commit();
            $request->session()->flash('success', 'Subscription Payment Successfully !!');
            return redirect()->route('home');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect()->route('home');
        }
    }

    public function khaltiCallBackActionPremium(Request $request, $id)
    {
        $currencyRate = 1;
        $usdCurrencyPrice = CurrencyRate::where('code', 'USD')->first();
        if ($usdCurrencyPrice) {
            $usdCurrencyPrice = (float)$usdCurrencyPrice->rate / (float)$usdCurrencyPrice->unit;
        }
        $premiumContent = PremiumContent::where('id', $id)->first();
        if (!$premiumContent) {
            $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect()->route('home');
        }
        $finalAmount = round(($premiumContent->price * $usdCurrencyPrice) / $currencyRate, 4);
        $request['payment_type']=2;
        DB::beginTransaction();
        try {
            $data = (new SavePremiumPaymentAction($request, $premiumContent,new PremiumContentPayment()))->saveSubscriptionPayment($finalAmount);
            
            if (!$data) {
                throw new Exception();
            }
            DB::commit();
            $request->session()->flash('success', 'Premium Content Payment Successfully !!');
            return redirect()->route('home');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect()->route('home');
        }
    }

    public function esewaSuccessAction(Request $request)
    {
        $susbcriptionId = explode('??kantipurcinemas/', $request->oid)[1];
        $currencyRate = 1;
        $usdCurrencyPrice = CurrencyRate::where('code', 'USD')->first();
        if ($usdCurrencyPrice) {
            $usdCurrencyPrice = (float)$usdCurrencyPrice->rate / (float)$usdCurrencyPrice->unit;
        }
        $subscription = Subscription::where('id', $susbcriptionId)->first();
        if (!$subscription) {
            $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect()->route('home');
        }
        $actualPriceInUsd=$subscription->price;
        $subscription->period_id = $subscription->period->value . '(' . $subscription->period->type->name . ')';
        $subscription->currency_type = $customerCurrencyType ?? "NPR";
        $subscription->price = round(($subscription->price * $usdCurrencyPrice) / $currencyRate, 4);
        $subscription->price=$actualPriceInUsd*100;
        DB::beginTransaction();
        try {
            if ($request->q == 'su') {

                $url = "https://esewa.com.np/epay/transrec";
                $data1 = [
                    'amt' => (int)$subscription->price,
                    'rid' => $request->refId,
                    'pid' => $request->oid,
                    'scd' => 'NP-ES-KANTIPURCINEMAS'
                ];
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data1);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($curl);
                curl_close($curl);
                $ref_id = 'OD' . rand(100000, 999999);
                if (strpos($response, "Success") !== false) {
                    $data = (new SavePaymentAction($request, $subscription))->saveSubscriptionPaymentEsewa();
                    if (!$data) {
                        throw new Exception();
                    }
                    DB::commit();
                    $request->session()->flash('success', 'Subscription Added Successfully !!');
                    return redirect()->route('home');
                } else {
                    throw new Exception();
                }
            } else {
                throw new Exception();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect()->route('home');
        }
    }

    public function esewaSuccessActionPremiumContent(Request $request)
    {
        $premiumContentId = explode('??kantipurcinemas/', $request->oid)[1];
        
        $currencyRate = 1;
        $usdCurrencyPrice = CurrencyRate::where('code', 'USD')->first();
        if ($usdCurrencyPrice) {
            $usdCurrencyPrice = (float)$usdCurrencyPrice->rate / (float)$usdCurrencyPrice->unit;
        }
        $premiumContent = PremiumContent::where('id', $premiumContentId)->first();
        if (!$premiumContent) {
            $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect()->route('home');
        }
        $finalAmount = round(($premiumContent->price * $usdCurrencyPrice) / $currencyRate, 4);
        $request['payment_type']=1;
        $request['transaction_id']=$request->refId;
        DB::beginTransaction();
        try {
            if ($request->q == 'su') {
                // dd($request->all(),'premium payment',$premiumContentId,$finalAmount);
                $url = "https://uat.esewa.com.np/epay/transrec";
                $data1 = [
                    'amt' => (int)$finalAmount,
                    'rid' => $request->refId,
                    'pid' => $request->oid,
                    'scd' => 'EPAYTEST'
                ];
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data1);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($curl);
                curl_close($curl);
                $ref_id = 'OD' . rand(100000, 999999);
                if (strpos($response, "Success") !== false) {
                    $data = (new SavePremiumPaymentAction($request, $premiumContent,new PremiumContentPayment()))->saveSubscriptionPayment($finalAmount);
                    if (!$data) {
                        throw new Exception();
                    }
                    DB::commit();
                    $request->session()->flash('success', 'Subscription Added Successfully !!');
                    return redirect()->route('home');
                } else {
                    throw new Exception();
                }
            } else {
                throw new Exception();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect()->route('home');
        }
    }
    public function esewaFailureAction(Request $request)
    {
        $request->session()->flash('something Went Wrong !!');
        return redirect()->route('home');
    }

    public function paypalSuccess(Request $request)
    {

        DB::beginTransaction();
        try {
            $sessionData = Session::get('paypalData');
            if (!$sessionData) {
                throw new Exception();
            }
            $susbcriptionId = $sessionData['subscription_id'];
            $currencyRate = 1;
            $usdCurrencyPrice = CurrencyRate::where('code', 'USD')->first();
            if ($usdCurrencyPrice) {
                $usdCurrencyPrice = (float)$usdCurrencyPrice->rate / (float)$usdCurrencyPrice->unit;
            }
            $subscription = Subscription::where('id', $susbcriptionId)->first();
            if (!$subscription) {
                throw new Exception();
            }
            $subscription->period_id = $subscription->period->value . '(' . $subscription->period->type->name . ')';
            $subscription->currency_type = $customerCurrencyType ?? "NPR";
            $subscription->price = $subscription->price;
            $data = (new SavePaymentAction($request, $subscription))->saveSubscriptionPaymentPaypal($sessionData);
            if (!$data) {
                throw new Exception();
            }
            Session::forget('paypalData');
            DB::commit();
            $request->session()->flash('success', 'Subscription Added Successfully !!');
            return redirect()->route('home');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect()->route('home');
        }
    }

    public function paypalSuccessPremiumContent(Request $request)
    {
        DB::beginTransaction();
        try {
            $sessionData = Session::get('paypalDataPremiumContent');
            if (!$sessionData) {
                throw new Exception();
            }
            $premiumContentId = $sessionData['premium_content_id'];
            $currencyRate = 1;
            $usdCurrencyPrice = CurrencyRate::where('code', 'USD')->first();
            if ($usdCurrencyPrice) {
                $usdCurrencyPrice = (float)$usdCurrencyPrice->rate / (float)$usdCurrencyPrice->unit;
            }
            $premiumContent = PremiumContent::where('id', $premiumContentId)->first();
            if (!$premiumContent) {
                throw new Exception();
            }
            
            $premiumContent->price = $premiumContent->price;
            $request['payment_type']=$sessionData['request']['payment_type'];
            $request['transaction_id']=$sessionData['request']['transaction_id'];
            $data = (new SavePremiumPaymentAction($request, $premiumContent,new PremiumContentPayment()))->saveSubscriptionPayment($premiumContent->price,'usd');
            if (!$data) {
                throw new Exception();
            }
            DB::commit();
            $request->session()->flash('success', 'Subscription Added Successfully !!');
            return redirect()->route('home');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect()->route('home');
        }
    }

    public function paypalCancel(Request $request)
    {
        $request->session()->flash('something Went Wrong !!');
        return redirect()->route('home');
    }

    public function imepaySuccess(Request $request)
    {

        DB::beginTransaction();
        try {
            $imepaySessionData = Session::get('imepayData');
            if (!$imepaySessionData) {
                throw new Exception();
            }
            $imepayResponse = base64_decode($request->data);
            $extractImepayResponse = explode('|', $imepayResponse);
            $responseCode = $extractImepayResponse[0];
            $responseDescription = $extractImepayResponse[1];
            $msisdn = $extractImepayResponse[2];
            $transactionId = $extractImepayResponse[3];
            $refId = $extractImepayResponse[4];
            $amount = $extractImepayResponse[5];
            $tokenId = $extractImepayResponse[6];
            $responseData = [
                'MerchantCode' => 'KANTIPURC',
                'RefId' => $refId,
                'TokenId' => $tokenId,
                'TransactionId' => $transactionId,
                'Msisdn' => $msisdn
            ];
            if ($responseCode === '0') {
                $status = (new ImepayValidate($imepaySessionData, $responseData))->validateImePay();
                if ($status == null) {
                    throw new Exception();
                }

                $susbcriptionId = $imepaySessionData['subscription_id'];
                $currencyRate = 1;
                $usdCurrencyPrice = CurrencyRate::where('code', 'USD')->first();
                if ($usdCurrencyPrice) {
                    $usdCurrencyPrice = (float)$usdCurrencyPrice->rate / (float)$usdCurrencyPrice->unit;
                }
                $subscription = Subscription::where('id', $susbcriptionId)->first();
                if (!$subscription) {
                    throw new Exception();
                }
                $subscription->period_id = $subscription->period->value . '(' . $subscription->period->type->name . ')';
                $subscription->currency_type = $customerCurrencyType ?? "NPR";
                $subscription->price = $subscription->price *100;
                $data = (new SavePaymentAction($request, $subscription))->saveSubscriptionPaymentImePay($imepaySessionData);
                if (!$data) {
                    throw new Exception();
                }
                Session::forget('imepayData');
                DB::commit();
                $request->session()->flash('success', 'Subscription Added Successfully !!');
                return redirect()->route('home');
            } else {
                throw new Exception();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect()->route('home');
        }
    }

    public function imepaySuccessPremium(Request $request)
    {
        DB::beginTransaction();
        try {
            $imepaySessionData = Session::get('imepayDataPremium');
           
            if (!$imepaySessionData) {
                throw new Exception();
            }
            $imepayResponse = base64_decode($request->data);
            $extractImepayResponse = explode('|', $imepayResponse);
            $responseCode = $extractImepayResponse[0];
            $responseDescription = $extractImepayResponse[1];
            $msisdn = $extractImepayResponse[2];
            $transactionId = $extractImepayResponse[3];
            $refId = $extractImepayResponse[4];
            $amount = $extractImepayResponse[5];
            $tokenId = $extractImepayResponse[6];
            $responseData = [
                'MerchantCode' => 'KANTIPURC',
                'RefId' => $refId,
                'TokenId' => $tokenId,
                'TransactionId' => $transactionId,
                'Msisdn' => $msisdn
            ];
            $premiumContentId = $imepaySessionData['premium_content_id'];
            $currencyRate = 1;
            $usdCurrencyPrice = CurrencyRate::where('code', 'USD')->first();
            if ($usdCurrencyPrice) {
                $usdCurrencyPrice = (float)$usdCurrencyPrice->rate / (float)$usdCurrencyPrice->unit;
            }
            $premiumContent = PremiumContent::where('id', $premiumContentId)->first();
            if (!$premiumContent) {
                throw new Exception();
            }
            $finalAmount= round(($premiumContent->price * $usdCurrencyPrice) / $currencyRate, 4);
            if ($responseCode === '0') {
                $status = (new ImepayValidate($imepaySessionData, $responseData))->validateImePay();
                if ($status == null) {
                    throw new Exception();
                }
                $request['payment_type']=4;
                $request['transaction_id']=$refId;
                $data = (new SavePremiumPaymentAction($request, $premiumContent,new PremiumContentPayment()))->saveSubscriptionPayment($finalAmount);
                DB::commit();
                $request->session()->flash('success', 'Subscription Added Successfully !!');
                return redirect()->route('home');
            } else {
                throw new Exception();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect()->route('home');
        }
    }

    public function imepayCancel(Request $request)
    {
        $request->session()->flash('something Went Wrong !!');
        return redirect()->route('home');
    }

    public function prabhupayPaySuccess(Request $request){
        DB::beginTransaction();
        try{
            
            if($request->success !='true'){
                throw new Exception();
            }
            if($request->status !='00'){
                throw new Exception();
            }
            $sessionData=Session::get('hamroPaySessionData');
            if(!$sessionData){
                throw new Exception();
            }
            $status=(new HamroPayValidate($sessionData,$request))->validateHamroPay();
            if(!$status){
                throw new Exception();
            }
            $currencyRate = 1;
            $usdCurrencyPrice = CurrencyRate::where('code', 'USD')->first();
            if ($usdCurrencyPrice) {
                $usdCurrencyPrice = (float)$usdCurrencyPrice->rate / (float)$usdCurrencyPrice->unit;
            }
            $subscription = Subscription::where('id', $sessionData['subscription_id'])->first();
            if (!$subscription) {
                $request->session()->flash('error', 'Something Went Wrong !!');
                return redirect()->route('home');
            }
            $subscription->period_id = $subscription->period->value . '(' . $subscription->period->type->name . ')';
            $subscription->currency_type = $customerCurrencyType ?? "NPR";
            // $subscription->price = round(($subscription->price * $usdCurrencyPrice) / $currencyRate, 4);
            $subscription->price =$subscription->price * 100;
            $data = (new SavePaymentAction($request, $subscription))->saveSubscriptionPaymentHamroPay($sessionData);
            if(!$data){
                throw new Exception();
            }
            Session::forget('hamroPaySessionData');
            DB::commit();
            $request->session()->flash('success', 'Subscription Added Successfully !!');
            return redirect()->route('home');
            

        }catch(\Throwable $th){
            $request->session()->flash('something Went Wrong !!');
            return redirect()->route('home');
        }
    }

    public function prabhupayPaySuccessPremiumContent(Request $request){
        DB::beginTransaction();
        try {


            if($request->success !='true'){
                throw new Exception();
            }
            if($request->status !='00'){
                throw new Exception();
            }
            $hamropaySessionData = Session::get('hamroPayDataPremium');
            if(!$hamropaySessionData){
                throw new Exception();
            }
            $status=(new HamroPayValidate($hamropaySessionData,$request))->validateHamroPay();
            if(!$status){
                throw new Exception();
            }
            $premiumContentId = $hamropaySessionData['premium_content_id'];
            
            $currencyRate = 1;
            $usdCurrencyPrice = CurrencyRate::where('code', 'USD')->first();
            if ($usdCurrencyPrice) {
                $usdCurrencyPrice = (float)$usdCurrencyPrice->rate / (float)$usdCurrencyPrice->unit;
            }
            $premiumContent = PremiumContent::where('id', $premiumContentId)->first();
            if (!$premiumContent) {
                throw new Exception();
            }
            $finalAmount= round(($premiumContent->price * $usdCurrencyPrice) / $currencyRate, 4);
            $request['payment_type']=6;
            $request['transaction_id']=$request->transactionId;
            $data = (new SavePremiumPaymentAction($request, $premiumContent,new PremiumContentPayment()))->saveSubscriptionPayment($finalAmount);
            if(!$data){
                throw new Exception();
            }
            DB::commit();
            $request->session()->flash('success', 'Subscription Added Successfully !!');
            return redirect()->route('home');
            
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect()->route('home');
        }
    }

    public function hamroPaySubscription(Request $request){
        
        $client = new Client();
        $url = 'https://payclient.hamropatro.com/v1/checkout/transaction';
        $hamroPayClientId='KC_HP_100';
        $hamroPayClientApiKey='HP4-KCS-0d4f39bbbafe6eef8S2023';
        $secretId='HP4-KC100@SxIIJZQwac450d4f39bbbafe6P';
        $signatureField=signHMAC($request['MerchantTxnId'].','.'PN_-Nru3OC4Pmi8upkOPkQ_'.','.$hamroPayClientId.','.$hamroPayClientApiKey,$secretId);
        $parameters = [
            "merchantId"=> 'PN_-Nru3OC4Pmi8upkOPkQ_',
            "merchantTxnId"=> $request['MerchantTxnId']
        ];
       
        $response = $client->post($url, [
            'headers' => [
                'Signature' => $signatureField,
                'Client-Id'=>$hamroPayClientId,
                'Client-API-Key'=>$hamroPayClientApiKey
            ],
            'json' => $parameters
        ]);
        $body = $response->getBody();
        $result = json_decode($body, true);
        if($result['status']=='COMPLETED'){
            try {

                $sessionData = Session::get('hamroPaySessionData');
                if (!$sessionData) {
                    throw new Exception();
                }
                $susbcriptionId = $sessionData['subscription_id'];
                $currencyRate = 1;
                $usdCurrencyPrice = CurrencyRate::where('code', 'USD')->first();
                if ($usdCurrencyPrice) {
                    $usdCurrencyPrice = (float)$usdCurrencyPrice->rate / (float)$usdCurrencyPrice->unit;
                }
                $subscription = Subscription::where('id', $susbcriptionId)->first();
                if (!$subscription) {
                    throw new Exception();
                }
                $subscription->period_id = $subscription->period->value . '(' . $subscription->period->type->name . ')';
                $subscription->currency_type = $customerCurrencyType ?? "NPR";
                $subscription->price = $subscription->price;
                $data = (new SavePaymentAction($request, $subscription))->saveSubscriptionPaymentHamroPay($sessionData);
                if (!$data) {
                    throw new Exception();
                }
                Session::forget('hamroPaySessionData');
                DB::commit();
                $request->session()->flash('success', 'Subscription Added Successfully !!');
                return redirect()->route('home');
                
            } catch (\Throwable $th) {
                DB::rollback();
                $request->session()->flash('error', 'Something Went Wrong !!');
                return redirect()->route('home');
            }
        }else{
            return false;
        }
    }
}
