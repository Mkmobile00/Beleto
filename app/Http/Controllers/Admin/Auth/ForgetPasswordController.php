<?php

namespace App\Http\Controllers\Admin\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\GenerateOtp;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminForgetPasswordMail;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\ForgetPasswordFinalRequest;

class ForgetPasswordController extends Controller
{
    use GenerateOtp;
    public function viewPage(){
        return view('admin.auth.forget-password');
    }

    public function getForgetEmail(ForgetPasswordRequest $request){
        try{

            $data['email']=$request->email;
            $data['otp']=$this->generateOtp();
            session()->put('admin-forget-password',null);
            session()->put('admin-forget-password',$data);
            Mail::to($data['email'])->send(new AdminForgetPasswordMail($data));

            return view('admin.auth.resetpassword',$data);
            
        }catch(\Throwable $th){
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    public function updateForgetPassword(ForgetPasswordFinalRequest $request){
    DB::beginTransaction();
        try{

            $sessionData=session()->get('admin-forget-password');
            if(!$sessionData || $sessionData==null)
            {
                throw new Exception();
            }  

            $email=$request->email;
            $otp=$request->otp;
            if($email !=$sessionData['email'])
            {
                throw new Exception();
            }
            if($otp !=$sessionData['otp'])
            {
                throw new Exception('Otp Doesnot Match !!');
            }
            
            $user=User::where('email',$email)->first();
            $user->password=bcrypt($request->password);
            $user->save();
            DB::commit();
             $response=[
                'error'=>false,
                'msg'=>'Password Updated Successfully !!',
                'url'=>route('login')
            ];
            return response()->json($response,200);
            
        }catch(\Throwable $th){
            DB::rollBack();
            $response=[
                'error'=>true,
                'msg'=>$th->getMessage() ?? 'Something Went Wrong !!'
            ];
            return response()->json($response,200);
        }
    }
}
