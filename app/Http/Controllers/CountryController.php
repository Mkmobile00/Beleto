<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CountryStoreRequest;
use App\Http\Requests\CountryUpdateRequest;

class CountryController extends Controller
{
    protected $country;
    public function __construct(Country $country)
    {
        $this->country=$country;
    }
    public function index()
    {
        $data['countrys']=$this->country->get();
        return view('admin.country.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.country.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryStoreRequest $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try{
            $data=$request->all();
            $this->country->fill($data);
            $this->country->save();
            DB::commit();
            $request->session()->flash('success','Country Created Successfully !!');
            return redirect()->route('country.index');
        }catch(\Throwable $th)
        {
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        $data['country']=$country;
        return view('admin.country.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryUpdateRequest $request, Country $country)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $country->fill($data);
            $country->save();
            DB::commit();
            $request->session()->flash('success','Country Updated Successfully !!');
            return redirect()->route('country.index');
        }catch(\Throwable $th)
        {
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Country $country)
    {
        DB::beginTransaction();
        try{
            $country->delete();
            DB::commit();
            $request->session()->flash('success','Country Deleted Successfully !!');
            return redirect()->route('country.index');
        }catch(\Throwable $th)
        {
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }
}
