<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Enum\Setting\VideoEnum;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CurrencyStoreRequest;
use App\Http\Requests\CurrencyUpdateRequest;

class CurrencyController extends Controller
{
    protected $currency;
    public function __construct(Currency $currency)
    {
        $this->currency=$currency;
    }
    public function index()
    {
        $data['currencies']=$this->currency->get();
        $reflection=new \ReflectionClass(VideoEnum::class);
        $data['videoEnum']=array_values($reflection->getConstants());
        return view('admin.setting.currency.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CurrencyStoreRequest $request)
    {
        $data=$request->all();
        DB::beginTransaction();
        // try{
            $this->currency->fill($data);
            $this->currency->save();
            DB::commit();
            $request->session()->flash('success','Currency Added Successfully !!');
            return redirect()->back();
        // }catch(\Throwable $th){
        //     DB::rollback();
        //     $request->session()->flash('error','Something Went Wrong !!');
        //     return redirect()->back();
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Currency $currency)
    {
        $reflection=new \ReflectionClass(VideoEnum::class);
        $data['videoEnum']=array_values($reflection->getConstants());
        $data['currency']=$currency;
        return view('admin.setting.currency.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CurrencyUpdateRequest $request,Currency $currency)
    {
        $data=$request->all();
        DB::beginTransaction();
        try{
            $currency->fill($data);
            $currency->save();
            DB::commit();
            $request->session()->flash('success','Currency Updated Successfully !!');
            return redirect()->route('currency.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Currency $currency)
    {
        DB::beginTransaction();
        try{
            $currency->delete();
            DB::commit();
            $request->session()->flash('success','Currency Deleted Successfully !!');
            return redirect()->back();
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

   
}
