<?php

namespace App\Http\Controllers;

use App\Enum\UserStatusEnum;
use App\Http\Requests\CitiesStoreRequest;
use App\Http\Requests\CitiesUpdateRequest;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use ReflectionClass;

class CityController extends Controller
{
    protected $cities;
    public function __construct(City $cities)
    {
        $this->cities=$cities;
    }
    public function index()
    {
        $data['notifications']=$this->cities->get();
        return view('admin.cities.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status=new ReflectionClass(UserStatusEnum::class);
        $data['cities_status']=array_values($status->getConstants());
        return view('admin.cities.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CitiesStoreRequest $request)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $data['slug']=Str::slug($request->title);
            $this->cities->fill($data);
            $this->cities->save();
            DB::commit();
            $request->session()->flash('success','Cities Created Successfully !!');
            return redirect()->route('city.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        $status=new ReflectionClass(UserStatusEnum::class);
        $data['cities_status']=array_values($status->getConstants());
        $data['city']=$city;
        return view('admin.cities.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CitiesUpdateRequest $request, City $city)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $city->fill($data);
            $city->save();
            DB::commit();
            $request->session()->flash('success','Cities Updated Successfully !!');
            return redirect()->route('city.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,City $city)
    {
        DB::beginTransaction();
        try{
            $city->delete();
            DB::commit();
            $request->session()->flash('success','Cities Deleted Successfully !!');
            return redirect()->route('city.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }
}
