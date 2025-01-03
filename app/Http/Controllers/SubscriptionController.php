<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use ReflectionClass;
use App\Models\Period;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Enum\CurrencyTypeEnum;
use App\Enum\Setting\VideoEnum;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SubscriptionRequest;
use App\Http\Requests\SubscriptionUpdateRequest;
use App\Models\Currency;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $subscription;
    public function __construct(Subscription $subscription)
    {
            $this->subscription=$subscription;        
    }
    public function index()
    {
        $data['subscriptions']=$this->subscription->get();
        return view('admin.subscription.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['plaTypes']=Plan::get();
        $data['periods']=Period::orderBy('type','ASC')->get();
        return view('admin.subscription.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriptionRequest $request)
    {
        $data=$request->all();
        if($request->is_suggested=='1'){
            $allSubscription=Subscription::get();
            foreach($allSubscription as $sub){
                $sub->is_suggested='0';
                $sub->save();
            }
        }
        DB::beginTransaction();
        // try{
            $this->subscription->fill($data);
            $this->subscription->save();
            DB::commit();
            $request->session()->flash('success','Subscription Added Successfully !!');
            return redirect()->route('subscription.index');
        // }catch(\Throwable $th){
        //     DB::rollback();
        //     $request->session()->flash('error','Something Went Wrong !!');
        //     return redirect()->back();
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        $data['plaTypes']=Plan::get();
        $data['subscription']=$subscription;
        $data['periods']=Period::orderBy('type','ASC')->get();
        $data['currencyTypes']=Currency::where('status',VideoEnum::ACTIVE)->get();
        return view('admin.subscription.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubscriptionUpdateRequest $request, Subscription $subscription)
    {
        $data=$request->all();
        if($request->is_suggested=='1'){
            $allSubscription=Subscription::where('id','!=',$subscription->id)->get();
            foreach($allSubscription as $sub){
                $sub->is_suggested='0';
                $sub->save();
            }
        }
        $data['is_suggested']=$request->is_suggested ?? '0';
        DB::beginTransaction();
        try{
            $subscription->fill($data);
            $subscription->save();
            // dd($subscription);
            DB::commit();
            $request->session()->flash('success','Subscription Updated Successfully !!');
            return redirect()->route('subscription.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
