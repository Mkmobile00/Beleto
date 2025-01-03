<?php
namespace App\Http\Traits;

use App\Models\Customer\Customer;

trait GenerateOtp{

    protected $newOtp;

    public function generateOtp()
    {
        $newOtp=rand(11111, 99999);
        $existOtp=Customer::where('verify_otp',$newOtp)->first();
        if($existOtp){
            $this->generateOtp();
        }
        return $newOtp;
    }
}