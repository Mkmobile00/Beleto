<?php
namespace App\Actions\Customer;

use Illuminate\Http\Request;

class HamroPayValidate{

    protected $data;
    protected $request;
    public function __construct($data,Request $request)
    {
        $this->data=$data;
        $this->request=$request;
    }

    public function validateHamroPay(){
        // dd('hsadgch',$this->data,$this->request->all());
        $data = [
            "merchantId" => "kantipurcine564", 
            "password" => "1@CInem@&ajs", 
            "invoiceNo" => $this->request->invoiceNo,
            "transactionId"=>$this->request->transactionId 
        ];

        $ch = curl_init('https://sys.prabhupay.com/api/EPayment/CheckStatus');
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
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}