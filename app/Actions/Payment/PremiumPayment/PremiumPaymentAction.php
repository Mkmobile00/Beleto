<?php
namespace App\Actions\Payment\PremiumPayment;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use App\Models\PremiumContent;
use Exception;
use Illuminate\Support\Facades\Session;

class PremiumPaymentAction{

    protected $data;
    protected $customer;
    public function __construct($data)
    {
        $this->data=$data;
    }

    public function payWithKhalti(){
        $id=$this->data['premium_content_id'];
        $amount = $this->data['amount'];
        $data = [
            "return_url" => route('khalti-callback-return-premium', $id),
            "website_url" => "https://kantipurcinemas.com/",
            "amount" => (int)$amount * 100,
            "purchase_order_id" => $id,
            "purchase_order_name" => "Test Product",
            // "customer_info"=> [
            //     "name" => $this->customer->customerDetail ? $this->customer->customerDetail->first_name : $this->customer->id,
            //     "email" => $this->customer->email ?? $this->customer->id,
            //     "phone" => $this->customer->phone ?? $this->customer->id
            // ],
        ];
        $ch = curl_init('https://a.khalti.com/api/v2/epayment/initiate/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Key live_secret_key_68791341fdd94846a146f0457ff7b455',
            'Content-Type: application/json',
            'Accept: application/json',
        ]);
        $response = curl_exec($ch);
        $responseData = json_decode($response, true);
        curl_close($ch);
        if (isset($responseData['detail'])) {
            session()->flash('error', $responseData['detail']);
            $checkout = route('cart.checkout', ['reference'=>'kjkjk']);
            return redirect($checkout)->send();
        }
        return redirect($responseData['payment_url'])->send();
    }

    public function payWithEsewa(){
        $premiumContent=PremiumContent::where('id',$this->data['premium_content_id'])->first();
        $amount = $this->data['amount'];
        $poid = Str::random(6) . rand(100, 1000).'??kantipurcinemas/'.$premiumContent->id.'??kantipurcinemas/';
        $data = [
            'tAmt' => (int)$amount,
            'amt' => (int)$amount,
            'txAmt' => 0,
            'psc' => 0,
            'pdc' => 0,
            'pid' => $poid,
            'su' => route('esewa-success-return-premium-content'),
            'fu' => route('esewa-failure-return'),
        ];
        return $data;
    }

    public function payWithImepay(){
        $client = new Client();
        $url = 'https://stg.imepay.com.np:7979/api/Web/GetToken';
        $apiUser = 'kantipurcinemas';
        $password = 'ime@1234';
        $module = 'KANTIPURC';
        $refId=Str::random(10);
        $parameters = [
            'MerchantCode' => 'KANTIPURC',
            'Amount' => $this->data['amount'],
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
            'amount'=> $this->data['amount'],
            'method'=>'GET',
            'successUrl'=>route('imepay.success-premium'),
            'failureUrl'=>route('imepay.cancel'),
            'premium_content_id'=>$this->data['premium_content_id']
        ];
        Session::put('imepayDataPremium',null);
        Session::put('imepayDataPremium',$data);
        return $data;
    }

    public function payWithHamroPay(){

        $id=$this->data['premium_content_id'];
        $amount = $this->data['amount'];
        
        $tnxNumber=Str::random(12);
        $data = [
            "totalAmount" => $amount, 
            "merchantId" => "kantipurtest121", 
            "password" => "p00wk5d2", 
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
            "returnUrl" => route('hamropay-returnurl-premium-content') 
        ];

        $ch = curl_init('https://stagesys.prabhupay.com/api/EPayment/Initiate');
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
                $data=[
                    'merchantCode'=>'KANTIPURC',
                    'refId'=>$tnxNumber,
                    'amount'=> $this->data['amount'],
                    'method'=>'GET',
                    'successUrl'=>route('imepay.success-premium'),
                    'failureUrl'=>route('imepay.cancel'),
                    'premium_content_id'=>$this->data['premium_content_id']
                ];
                Session::put('hamroPayDataPremium',null);
                Session::put('hamroPayDataPremium',$data);
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