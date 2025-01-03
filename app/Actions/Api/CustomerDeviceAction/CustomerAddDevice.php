<?php
namespace App\Actions\Api\CustomerDeviceAction;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Customer\Customer;
use App\Models\Api\CustomerDeviceList;

class CustomerAddDevice{
    protected $customer;
    protected $request;
    public function __construct(Customer $customer)
    {
        $this->customer=$customer;
    }

    public function setDeviceListMain(Request $request){
        $this->request=$request;
        $deviceName=$this->request->device_name;
        $deviceSerialNum=$this->request->device_serial_num;
        $customerDeviceExists=CustomerDeviceList::where('device_serial_num',$deviceSerialNum)->first();
        if($customerDeviceExists){
            return true;
        }
        CustomerDeviceList::create([
            'customer_id'=>$this->customer->id,
            'device_type'=>$this->request->device_type,
            'device_name'=>$deviceName,
            'device_serial_num'=>$deviceSerialNum,
            'added_date'=>Carbon::now()->format('Y-m-d H:i:s'),
            'main'=>'1'
        ]);
    }

    public function setDeviceList(Request $request){
        $this->request=$request;
        $deviceName=$this->request->device_name;
        $deviceSerialNum=$this->request->device_serial_num;
        $customerSubscriptionListCount=$this->customer->subscription->unique('subscription_id')->map(function($subItem){
            return $subItem->subscription->plan->screensize ?? 0;
         })->max();
         $customerDeviceList=count($this->customer->deviceList);
        
        if($customerSubscriptionListCount !=null)
        {
            if($customerDeviceList == $customerSubscriptionListCount){
                return false;
            }
        }
        $customerDeviceExists=CustomerDeviceList::where('customer_id',$this->customer->id)->where('device_serial_num',$deviceSerialNum)->withTrashed()->first();
        
        if($customerDeviceExists){
            $customerDeviceExists->deleted_at=null;
            $customerDeviceExists->save();
            return true;
        }
        $data=[
            'customer_id'=>$this->customer->id,
            'device_type'=>$this->request->device_type,
            'device_name'=>$deviceName,
            'device_serial_num'=>$deviceSerialNum,
            'added_date'=>Carbon::now()->format('Y-m-d H:i:s'),
            'main'=>'1'
        ];
        CustomerDeviceList::create([
            'customer_id'=>$this->customer->id,
            'device_type'=>$this->request->device_type,
            'device_name'=>$deviceName,
            'device_serial_num'=>$deviceSerialNum,
            'added_date'=>Carbon::now()->format('Y-m-d H:i:s'),
            'main'=>'1'
        ]);
        return true;
    }

    public function setDeviceListSocial(Request $request){
        $this->request=$request;
        $deviceName=$this->request->device_name;
        $deviceSerialNum=$this->request->device_serial_num;
        $customerSubscriptionListCount=$this->customer->subscription->unique('subscription_id')->map(function($subItem){
            return $subItem->subscription->plan->screensize ?? 0;
         })->max();
        $customerDeviceList=count($this->customer->deviceList);
        if($customerSubscriptionListCount !=null)
        {
            if($customerDeviceList == $customerSubscriptionListCount){
                return false;
            }
        }
        $customerDeviceExists=CustomerDeviceList::where('customer_id',$this->customer->id)->where('device_serial_num',$deviceSerialNum)->first();
        if($customerDeviceExists){
            return true;
        }
        CustomerDeviceList::create([
            'customer_id'=>$this->customer->id,
            'device_type'=>$this->request->device_type,
            'device_name'=>$deviceName,
            'device_serial_num'=>$deviceSerialNum,
            'added_date'=>Carbon::now()->format('Y-m-d H:i:s'),
            'main'=>'1'
        ]);
        return true;
    }
}