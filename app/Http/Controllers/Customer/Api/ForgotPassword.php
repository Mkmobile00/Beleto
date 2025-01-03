<?php
namespace App\Actions\Api;

use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Http\Traits\GenerateOtp;
use App\Models\VisitorForgetPassword;

 class ForgotPassword{
    use GenerateOtp;
    protected $visitor;
    protected $request;
    public function __construct(Request $request,Visitor $visitor)
    {
        $this->visitor=$visitor;
        $this->request=$request;
    }

    public function saveData()
    {
        
        $forgotPassword=VisitorForgetPassword::create([
            'email'=>$this->visitor->email,
            'visitor_id'=>$this->visitor->id,
            'password'=>bcrypt($this->request->password),
            'otp'=>$this->generateOtp()
        ]);
        return $forgotPassword;
    }

    public function updatePassword($verifyOtp)
    {
        $this->visitor->password=$verifyOtp->password;
        $this->visitor->save();
        $this->visitor->forgotPassword->delete();
    }
 }