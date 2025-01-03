<?php
namespace App\Actions\Customer;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Customer\Customer;
use App\Enum\Customer\CustomerStatusEnum;

class LoginRegisterAction{

    protected $request;
    protected $customer;
    protected $arrangeData;
    protected $finalData=[];
    public function __construct(Request $request,Customer $customer)
    {
        $this->request=$request;
        $this->customer=$customer;
        $this->arrangeData=new LoginRegisterArrangeAction();
    }

    public function toResponse(){
        $status=(int)$this->request->email_or_phone;
        
        if($status==0)
        {
            $alreadyRegister=Customer::where('phone',$this->request->phone)->withTrashed()->first();
        }
        else{
            $alreadyRegister=Customer::where('email',$this->request->email)->withTrashed()->first();
        }
        // dd($alreadyRegister);
       
        if($alreadyRegister)
        {
            $this->finalData=[
                'name'=>null,
                'email'=>$alreadyRegister->email,
                'phone'=>$alreadyRegister->phone,
                'verify_otp'=>null,
                'email_or_phone'=>$this->request->email_or_phone,
                'status'=>CustomerStatusEnum::ACTIVE->value,
                'country_code'=>$this->request->country_code ?? null,
                'password'=>bcrypt($alreadyRegister->phone ?? $alreadyRegister->email),
                'platform'=>$alreadyRegister->platform
            ];
            $this->updateCustomer($this->finalData,$alreadyRegister);
            switch($status){
                case 1:  //Email
                    $this->arrangeData->sendNotification($alreadyRegister,1);
                    break;
                case 0; // Phone
                    $this->arrangeData->sendNotification($alreadyRegister,0);
                    break;
                default:
                    throw new Exception();
                    break;
            }
            return $alreadyRegister;
        }
        else{
            $this->finalData=$this->arrangeData->arrangeData($this->request,$status);
            $this->addCustomer($this->finalData);
            switch($status){
                case 1:  //Email
                    $this->arrangeData->sendNotification($this->customer,1);
                    break;
                case 0;  // Phone
                    $this->arrangeData->sendNotification($this->customer,0);
                    break;
                default:
                    throw new Exception();
                    break;
            }
            return $this->customer;
        }

    }

    public function addCustomer($data){
        $this->customer->fill($data);
        $this->customer->save();
    }

    public function updateCustomer($data,$alreadyRegister){
        $alreadyRegister->fill($data);
        $alreadyRegister->save();
    }

    public function toResponseSocailMedia(){
        $status=(int)$this->request->email_or_phone;
        $alreadyRegister=Customer::where('email',$this->request->email)->withTrashed()->first();
        if($alreadyRegister)
        {
            $this->finalData=[
                'name'=>null,
                'email'=>$alreadyRegister->email,
                'phone'=>$alreadyRegister->phone,
                'verify_otp'=>null,
                'email_or_phone'=>$this->request->email_or_phone,
                'status'=>CustomerStatusEnum::ACTIVE->value,
                'country_code'=>$this->request->country_code ?? null,
                // 'password'=>bcrypt($alreadyRegister->phone ?? $alreadyRegister->email),
                'login_type'=>$alreadyRegister->login_type,
                'platform'=>$alreadyRegister->platform,
                'deleted_at'=>null,
                'email_verified_at' => Carbon::now()
            ];
            $this->updateCustomer($this->finalData,$alreadyRegister);
            switch($status){
                case 1:  //Email
                    $this->arrangeData->sendNotification($alreadyRegister,1);
                    break;
                default:
                    throw new Exception();
                    break;
            }
            return $alreadyRegister;
        }
        else{
            $this->finalData=$this->arrangeData->arrangeData($this->request,$status);
            $this->addCustomer($this->finalData);
            switch($status){
                case 1:  //Email
                    $this->arrangeData->sendNotification($this->customer,1);
                    break;
                default:
                    throw new Exception();
                    break;
            }
            return $this->customer;
        }

    }
}