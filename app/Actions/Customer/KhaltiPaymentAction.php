<?php
namespace App\Actions\Customer;

use Illuminate\Http\Request;

class KhaltiPaymentAction{

    protected $request;
    public function __construct(Request $request)
    {
        $this->request=$request;
    }

    public function validateTransaction()
    {
        $args = http_build_query(array(
            "pidx" => $this->request->pidx
        ));
        $url = "https://khalti.com/api/v2/epayment/lookup/";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $headers = ['Authorization: Key live_secret_key_db8d339df3b5443ca49ffdc204d77187'];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($status_code !== 200) {
           return false;
        }else{
            return true;
        }
    }

    public function validatePaypal(){
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $responsedata = $provider->capturePaymentOrder($this->request['token']);
        // dd($responsedata);
        if($responsedata['status'] === 'COMPLETED'){
            return true;
        }else{
            return false;
        }
    }
}