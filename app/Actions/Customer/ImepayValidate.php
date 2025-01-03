<?php
namespace App\Actions\Customer;

use Illuminate\Support\Str;
use GuzzleHttp\Client;
class ImepayValidate{
    protected $data;
    protected $imepayResponseData;
    public function __construct($data,$imepayResponseData){
        $this->data=$data;
        $this->imepayResponseData=$imepayResponseData;
    }

    public function validateImePay(){
        $amount=$this->data['amount'];
        return $this->getResponseData();
    }

    public function getResponseData(){
        // dd($this->imepayResponseData);
        $client = new Client();
        $url = 'https://payment.imepay.com.np:7979/api/Web/Confirm';
        $apiUser = 'kantipurcinemas';
        $password = 'ime@1234';
        $module = 'KANTIPURC';
        $refId=Str::random(10);
        $parameters = [
            "MerchantCode"=>$this->imepayResponseData['MerchantCode'],
            "RefId"=>$this->imepayResponseData['RefId'],
            "TokenId"=>$this->imepayResponseData['TokenId'],
            "TransactionId"=>$this->imepayResponseData['TransactionId'],
            "Msisdn"=>$this->imepayResponseData['Msisdn']
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
        $responseCode=$result['ResponseCode'];
        if($responseCode=='0'){
            return $result;
        }else{
            return null;
        }
        // $tokenId = $result['TokenId'];
        // $data=[
        //     'tokenId'=>$tokenId,
        //     'merchantCode'=>'KANTIPURC',
        //     'refId'=>$refId,
        //     'amount'=> $this->subscription->price,
        //     'method'=>'GET',
        //     'successUrl'=>route('imepay.success'),
        //     'failureUrl'=>route('imepay.cancel')
        // ];
        // $this->request->session()->put('imepayData', null);
        // $this->request->session()->put('imepayData', $data);
        // return $data;
    }
}
