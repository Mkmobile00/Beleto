<?php
namespace App\Actions\Customer;

use Exception;
use GuzzleHttp\Client;
use App\Models\WebsiteLogo;
use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentAction{

    protected $request;
    protected $subscription;
    protected $customer;
    public function __construct(Request $request,Subscription $subscription)
    {
        $this->request=$request;
        $this->subscription=$subscription;
        $this->customer=Auth::guard('customer')->user();
        if(!$this->customer){
            throw new Exception();
        }
    }

    public function payWithKhati(){
        $id=$this->subscription->id;
        $amount = $this->subscription->price;
        $data = [
            "return_url" => route('khalti-callback-return', $id),
            "website_url" => "https://kantipurcinemas.com/",
            "amount" => (int)$amount * 100,
            "purchase_order_id" => $this->subscription->title,
            "purchase_order_name" => "Test Product",
            // "customer_info"=> [
            //     "name" => $this->customer->customerDetail ? $this->customer->customerDetail->first_name : $this->customer->id,
            //     "email" => $this->customer->email ?? $this->customer->id,
            //     "phone" => $this->customer->phone ?? $this->customer->id
            // ],
        ];
        $ch = curl_init('https://khalti.com/api/v2/epayment/initiate/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            // 'Authorization: Key live_secret_key_68791341fdd94846a146f0457ff7b455',
            'Authorization: Key live_secret_key_db8d339df3b5443ca49ffdc204d77187',
            'Content-Type: application/json',
            'Accept: application/json',
        ]);
        $response = curl_exec($ch);
        $responseData = json_decode($response, true);
        curl_close($ch);
        if (isset($responseData['detail'])) {
            session()->flash('error', $responseData['detail']);
            return redirect()->route('home')->send();
        }
        return redirect($responseData['payment_url'])->send();
    }

    public function payWithHamroPay(){
        $id=$this->subscription->id;
        $amount = $this->subscription->price * 100;
        $invoiceNum=Str::random(10);
        // $amount='1000';
        $hamroPayMerchantId='PN_-Nru3OC4Pmi8upkOPkQ_';
        $hamroPayClientId='KC_HP_100';
        $hamroPayClientApiKey='HP4-KCS-0d4f39bbbafe6eef8S2023';
        $secretId='HP4-KC100@SxIIJZQwac450d4f39bbbafe6P';
        $signatureField=signHMAC($invoiceNum.','.$amount.','.$hamroPayMerchantId.','.$hamroPayClientId.','.$hamroPayClientApiKey,$secretId);
        $client = new Client();
        $logo=WebsiteLogo::first();
        $url = 'https://payclient.hamropatro.com/v1/checkout/sessionId';
        
        $parameters = [
            "merchantTxnId"=> $invoiceNum,
            "merchantId"=> $hamroPayMerchantId,
            "transactionAmount"=> $amount,
            "failedRedirectionUrl"=> route('hamro-pay.failure'),
            "successRedirectionUrl"=>route('hamro-pay.success'),
            "productList"=>[
                [
                    "name"=>"Premium 4K",
                    "imageUrl"=>@$logo->website_logo,
                    "description"=>"Payment Details",
                    "price"=>$amount/100,
                    "quantity"=>1
                ]
            ]
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
        if($result['sessionId']){
             $data = [
                'subscription_id' => $this->subscription->id,
                'request' => $this->request->except('_token'),
                'amount' => $this->subscription->price
            ];
            Session::put('hamroPaySessionData', null);
            Session::put('hamroPaySessionData', $data);
            return $this->getHamroPayFormResult($result,$invoiceNum,$amount);
        }else{
            throw new Exception();
        }
    }

    public function getHamroPayFormResult($result,$invoiceNum,$amount){
        // dd('ok',$result);
        $sessionId=$result['sessionId'];
        $invoiceNum=$invoiceNum;
        $amount=$amount;
        $hamroPayMerchantId='PN_-Nru3OC4Pmi8upkOPkQ_';
        $hamroPayClientId='KC_HP_100';
        $hamroPayClientApiKey='HP4-KCS-0d4f39bbbafe6eef8S2023';
        $secretId='HP4-KC100@SxIIJZQwac450d4f39bbbafe6P';
        $signatureField=signHMAC($hamroPayMerchantId.','.$invoiceNum.','.$sessionId.','.$amount.','.$hamroPayClientId.','.$hamroPayClientApiKey,$secretId);

        $client = new Client();
        $url ='https://checkout-pay.hamropatro.com/api/checkout';
        $parameters = [
            "merchant_id"=> $hamroPayMerchantId,
            "session_id"=> $sessionId,
            "token"=> $signatureField,
            "merchant_transaction_id"=>$invoiceNum,
            "remarks"=>"Testing"
        ];
        // $response = $client->post($url, [
        //     'headers' => [
        //         'Content-Type' => 'application/json'
        //     ],
        //     'json' => $parameters
        // ]);
        return $parameters;
        // $body = $response->getBody();
        // $resultData = json_decode($body, true);
        // dd($resultData);
    }

    public function payWithEsewa(){
        $id=$this->subscription->id;
        $amount = $this->subscription->price;
        $poid = Str::random(6) . rand(100, 1000).'??kantipurcinemas/'.$this->subscription->id.'??kantipurcinemas/';
       
        $data = [
            'tAmt' => (int)$amount,
            'amt' => (int)$amount,
            'txAmt' => 0,
            'psc' => 0,
            'pdc' => 0,
            'pid' => $poid,
            'su' => route('esewa-success-return'),
            'fu' => route('esewa-failure-return'),
        ];
       
        return $data;
    
    }

    public function payWithPayPal($actualPriceInUsd){
        $provider = new PayPalClient();
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);
        $order = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $actualPriceInUsd
                    ]
                ]
            ],
            "application_context" => [
                "cancel_url" => route('paypal.cancel'),
                "return_url" => route('paypal.success')
            ]
        ]);
        $data=[
            'subscription_id'=>$this->subscription->id,
            'request'=>$this->request->all(),
            'amount'=>$actualPriceInUsd
        ];
        if ($order['status'] === 'CREATED') {
            $this->request->session()->put('paypalData', null);
            $this->request->session()->put('paypalData', $data);
            return redirect()->to($order['links'][1]['href']);
        } else {
            throw new Exception();
        }
    }

    public function payWithImePay(){
        $client = new Client();
        $url = 'https://payment.imepay.com.np:7979/api/Web/GetToken';
        $apiUser = 'kantipurc';
        $password = 'Ime@1234';
        $module = 'KANTIPURC';
        $refId=Str::random(10);
        $parameters = [
            'MerchantCode' => 'KANTIPURC',
            'Amount' => $this->subscription->price,
            'RefId' => $refId
        ];
        $authorizationHeader = base64_encode($apiUser . ':' . $password);
        $response = $client->post($url, [
            'headers' => [
                'Authorization' => 'Basic ' . $authorizationHeader,
                'Module' => base64_encode($module),
                'Content-Type' => 'application/json'
            ],
            'json' => $parameters
        ]);
        $body = $response->getBody();
        $result = json_decode($body, true);
        $tokenId = $result['TokenId'];
        $data=[
            'tokenId'=>$tokenId,
            'merchantCode'=>'KANTIPURC',
            'refId'=>$refId,
            'amount'=> $this->subscription->price,
            'method'=>'GET',
            'successUrl'=>route('imepay.success'),
            'failureUrl'=>route('imepay.cancel'),
            'subscription_id'=>$this->subscription->id
        ];
        $this->request->session()->put('imepayData', null);
        $this->request->session()->put('imepayData', $data);
        return $data;
    }

    public function payWithPrabhuPay(){
        
        $id = $this->subscription->id;
        $amount = $this->subscription->price;
        $tnxNumber=Str::random(12);
        $data = [
            "totalAmount" => $amount, 
            "merchantId" => "kantipurcine564", 
            "password" => "1@CInem@&ajs", 
            "invoiceNo" => $tnxNumber,
            "productDetails" => [
                [
                    "productName" => "MASK",
                    "quantity" => 4,
                    "rate" => 1,
                    "total" => $amount
                ]
            ],
            "remarks" => "abc",
            "returnUrl" => route('prabhupay-returnurl') 
        ];

        $ch = curl_init('https://sys.prabhupay.com/api/EPayment/Initiate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
        ]);

        $response = curl_exec($ch);
        $responseData = json_decode($response, true);
        if($responseData['success']){
            if($responseData['status']=='00'){
                Session::put('hamroPaySessionData',null);
                $data=[
                    'refId'=>$tnxNumber,
                    'amount'=> $this->subscription->price,
                    'subscription_id'=>$this->subscription->id
                ];
                Session::put('hamroPaySessionData',$data);
                $redirectionUrl=$responseData['data']['redirectionUrl'];
                return redirect($redirectionUrl)->send();
            }else{
                throw new Exception();
            }
        }else{
            throw new Exception();
        }
        
    }
}