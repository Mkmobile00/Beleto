<?php

namespace App\Http\Controllers;

use App\Enum\UserStatusEnum;
use App\Http\Requests\CinemasBranchStoreRequest;
use App\Http\Requests\CinemasBranchUpdateRequest;
use App\Http\Traits\CinemasTrait;
use App\Models\Cinemas;
use App\Models\CinemasBranch;
use App\Models\CinemasBranchCities;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ReflectionClass;

class CinemasBranchController extends Controller
{
    use CinemasTrait;
    protected $cinemasBranch;
    protected $cinemasBranchCities;
    public function __construct(CinemasBranch $cinemasBranch,CinemasBranchCities $cinemasBranchCities)
    {
        $this->cinemasBranch=$cinemasBranch;
        $this->cinemasBranchCities=$cinemasBranchCities;
    }
    public function index()
    {
        $data['notifications']=$this->cinemasBranch->get();
        return view('admin.cinemasbranch.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status=new ReflectionClass(UserStatusEnum::class);
        $data['cinemas_status']=array_values($status->getConstants());
        $data['branch_id']=$this->generateCinemasBranchUniqueCode();
        $data['cinemas']=Cinemas::with('city')->where('status','1')->get();
        $cinemasCityArray = collect($data['cinemas'])->mapWithKeys(function($item) {
            return [
                $item->id => $item->city->pluck('city_id')->toArray()
            ];
        })->toArray();
        $data['cinemasCityArray'] = $cinemasCityArray;
        $data['citiesData']=City::where('status','1')->get();
        return view('admin.cinemasbranch.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CinemasBranchStoreRequest $request)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $this->cinemasBranch->fill($data);
            $this->cinemasBranch->save();
            $temp=[];
            foreach($request->cities as $city){
                $temp[]=[
                    'cinemas_branch_id'=>$this->cinemasBranch->id,
                    'city_id'=>$city
                ];
            }
            $this->cinemasBranchCities->insert($temp);
            DB::commit();
            $request->session()->flash('success','Cinemas Branch Created Successfully !!');
            return redirect()->route('cinemasbranch.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CinemasBranch $cinemasBranch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CinemasBranch $cinemasbranch)
    {
        $status=new ReflectionClass(UserStatusEnum::class);
        $data['cinemas_status']=array_values($status->getConstants());
        $data['branch_id']=$this->generateCinemasBranchUniqueCode();
        $data['cinemas']=Cinemas::with('city')->where('status','1')->get();
        $cinemasCityArray = collect($data['cinemas'])->mapWithKeys(function($item) {
            return [
                $item->id => $item->city->pluck('city_id')->toArray()
            ];
        })->toArray();
        $data['cinemasCityArray'] = $cinemasCityArray;
        $data['citiesData']=City::where('status','1')->get();
        $data['cinemasbranch']=$cinemasbranch;
        return view('admin.cinemasbranch.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CinemasBranchUpdateRequest $request, CinemasBranch $cinemasbranch)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $cinemasbranch->fill($data);
            $cinemasbranch->save();
            $cinemasbranch->cities()->delete();
            $temp=[];
            foreach($request->cities as $city){
                $temp[]=[
                    'cinemas_branch_id'=>$cinemasbranch->id,
                    'city_id'=>$city
                ];
            }
            $this->cinemasBranchCities->insert($temp);
            DB::commit();
            $request->session()->flash('success','Cinemas Branch Updated Successfully !!');
            return redirect()->route('cinemasbranch.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,CinemasBranch $cinemasbranch)
    {
        DB::beginTransaction();
        try{
            $cinemasbranch->delete();
            DB::commit();
            $request->session()->flash('success','Cinemas Branch Deleted Successfully !!');
            return redirect()->route('cinemasbranch.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }
}
