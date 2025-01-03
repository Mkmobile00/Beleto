<?php
namespace App\Actions\Api;

use App\Models\Visitor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Traits\JsonFormat;
use App\Http\Traits\GenerateOtp;

class VisitorRegistration{

    use GenerateOtp,JsonFormat;
    protected $request;
    protected $data=[];
    protected $visitor;
    public function __construct(Request $request,Visitor $visitor)
    {
        $this->request=$request;
        $this->visitor=$visitor;
    }

    public function getStoreData()
    {
        $this->data = $this->request->except('photo');
        $this->data['password'] = bcrypt($this->request->password);
        if ($this->request->photo && $this->request->photo != null) {
            $image_name = uploadImage($this->request->photo, 'visitor', '200x200');
            if ($image_name) {
                $this->data['photo'] = $image_name;
            }
        }
        $this->data['status'] = '0';
        $this->data['verify_token'] = Str::random(25);
        $this->data['verify_otp'] = $this->generateOtp();
        $this->data['visitor_id']=$this->visitor->getUniqueId();
        $this->data['entry_date']=Carbon::now()->format('Y-m-d H:i:s');
        $this->data['langType']='1';
        $this->data['passtype']='4';
        $this->data['contact_number']=$this->jsonStoreFormat($this->request->contact_number);
        $this->data=array_merge($this->data,$this->getNameData());
        return $this->data;
    }

    public function getNameData()
    {
        $name=explode(' ',$this->request->name);
        if(count($name) > 2)
        {
            $middleName=null;
            foreach($name as $key=>$data)
            {
                if($key != 0 && $key !=(count($name)-1))
                {
                    $middleName.=$data.' ';
                }
            }
            return[
                'first_name'=>$this->jsonStoreFormat($name[0]),
                'middle_name'=>$this->jsonStoreFormat(trim($middleName)) ?? null,
                'last_name'=>$this->jsonStoreFormat($name[count($name)-1]) ?? null
            ];
        }
        elseif(count($name) ===2)
        {
            return[
                'first_name'=>$this->jsonStoreFormat($name[0]),
                'middle_name'=>null,
                'last_name'=>$this->jsonStoreFormat($name[1]) ?? null
            ];
        }
        else
        {
            return[
                'first_name'=>$this->jsonStoreFormat($name[0]),
                'middle_name'=>null,
                'last_name'=>null
            ];
        }
        
       
    }
}