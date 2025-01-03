<?php
namespace App\Actions\Customer;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Traits\GenerateOtp;
use App\Models\Customer\Customer;
use Illuminate\Support\Facades\Mail;
use App\Enum\Customer\CustomerStatusEnum;
use App\Mail\Customer\CustomerRegisterMail;

class LoginRegisterArrangeAction{

    use GenerateOtp;
    protected $status;
    protected $data=[];
    protected $otp;
    public function __construct()
    {
        
    }

    public function arrangeData(Request $request,$status){
        $this->status=$status;
        switch($this->status){
            case 1:
                return[
                    'name'=>null,
                    'email'=>$request->email,
                    'email_or_phone'=>$request->email_or_phone,
                    'verify_otp'=>null,
                    'verified_from'=>'Web',
                    'status'=>CustomerStatusEnum::ACTIVE->value,
                    'country_code'=>$request->country_code ?? null,
                    'password'=>bcrypt($request->email),
                    'login_type'=>$request->login_type ?? '1',
                    'platform'=>$request->platform,
                    'email_verified_at' => Carbon::now()
                ];
                break;
            case 0:
                return[
                    'name'=>null,
                    'phone'=>$request->phone,
                    'email_or_phone'=>$request->email_or_phone,
                    'country_code'=>$request->country_code,
                    'verify_otp'=>null,
                    'verified_from'=>'Web',
                    'status'=>CustomerStatusEnum::ACTIVE->value,
                    'country_code'=>$request->country_code ?? null,
                    'password'=>bcrypt($request->phone),
                    'platform'=>$request->platform,
                    'email_verified_at' => Carbon::now()
                ];
                break;
            default:
                throw new Exception();
            break;
        }
    }

    public function sendNotification(Customer $customer,$type){
        $this->otp=$this->generateOtp();
        $customer->verify_otp=$this->otp;
        $customer->save();
        switch((int)$type){
            case 1:
                Mail::to($customer->email)->send(new CustomerRegisterMail($customer));
                break;
            case 0:
                $this->sendSms($customer);
                break;
            default:
                throw new Exception();
                break;
        }
    }

    public function sendSms($customer)
    {
        $args = http_build_query(array(
            'token' => 'v2_cW6mkM6ZFC29LdP3NNDWyalAoZf.2SJT',
            'from'  => 'Kantipur Cinemas',
            'to'    =>  $customer->phone,
            'text'  => 'Dear, ' . $customer->name . ' Plz Use This Code To Verify Your Account ' . $customer->verify_otp
        ));
        // dd($args);
        $url = "https://api.sparrowsms.com/v2/sms";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    }
    
}