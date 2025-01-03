<?php

namespace App\Http\Controllers;

use ReflectionClass;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PushNotification;
use App\Models\Customer\Customer;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\NotificationTrait;
use App\Models\PushNotificationCustomer;
use App\Enum\PushNotification\NotificationUserType;
use App\Http\Requests\PushNotificationStoreRequest;
use App\Enum\PushNotification\PushNotificationStatus;

class PushNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use NotificationTrait;
    protected $pushnotification;
    protected $pushnotificationcustomer;
    public function __construct(PushNotification $pushnotification,PushNotificationCustomer $pushnotificationcustomer)
    {
        $this->pushnotification=$pushnotification;
        $this->pushnotificationcustomer=$pushnotificationcustomer;
    }
    public function index()
    {
        $data['notifications']=$this->pushnotification->get();
        return view('admin.pushnotification.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $notificationStatus=new ReflectionClass(PushNotificationStatus::class);
        $data['notification_status']=array_values($notificationStatus->getConstants());
        $userTypes=new ReflectionClass(NotificationUserType::class);
        $data['userTypes']=array_values($userTypes->getConstants());
        $data['customers']=Customer::get()->map(function($item){
            return[
                'id'=>$item->id,
                'name'=>$item->name ?? $item->email ?? $item->phone,
            ];
        });
        return view('admin.pushnotification.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PushNotificationStoreRequest $request)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $data['pushed_date']=Carbon::now()->format('Y-m-d');
            $data['slug']=Str::slug($request->title);
           
            $this->pushnotification->fill($data);
            $this->pushnotification->save();
            
            if($request->for !='1'){
                $temp=[];
                foreach($request->selected_id as $id){
                    $temp[]=[
                        'notification_id'=>$this->pushnotification->id,
                        'customer_id'=>$id
                    ];
                }
                $this->pushnotificationcustomer->insert($temp);
            }
            if($request->status =='1'){
                $this->pushNotification($this->pushnotification);
            }
            DB::commit();
            $request->session()->flash('success','Notification Created Successfully !!');
            return redirect()->route('pushnotification.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PushNotification $pushNotification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PushNotification $pushnotification)
    {
        $notificationStatus=new ReflectionClass(PushNotificationStatus::class);
        $data['notification_status']=array_values($notificationStatus->getConstants());
        $userTypes=new ReflectionClass(NotificationUserType::class);
        $data['userTypes']=array_values($userTypes->getConstants());
        $data['customers']=Customer::get()->map(function($item){
            return[
                'id'=>$item->id,
                'name'=>$item->name ?? $item->email ?? $item->phone,
            ];
        });
        $data['pushnotification']=$pushnotification;
        return view('admin.pushnotification.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PushNotificationStoreRequest $request, PushNotification $pushnotification)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $data['pushed_date']=Carbon::now()->format('Y-m-d');
            $data['slug']=Str::slug($request->title);
            $pushnotification->fill($data);
            $pushnotification->save();
            $pushnotification->customer()->delete();
            if($request->for !='1'){
                $temp=[];
                foreach($request->selected_id as $id){
                    $temp[]=[
                        'notification_id'=>$pushnotification->id,
                        'customer_id'=>$id
                    ];
                }
                $this->pushnotificationcustomer->insert($temp);
            }
            if($request->status =='1'){
                $this->pushNotification($pushnotification);
            }
            DB::commit();
            $request->session()->flash('success','Notification Updated Successfully !!');
            return redirect()->route('pushnotification.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PushNotification $pushNotification)
    {
        //
    }
}
