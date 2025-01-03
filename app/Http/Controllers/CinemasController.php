<?php

namespace App\Http\Controllers;

use App\Enum\UserStatusEnum;
use App\Http\Requests\CinemasStoreRequest;
use App\Http\Requests\CinemasUpdateRequest;
use App\Http\Traits\CinemasTrait;
use App\Models\Cinemas;
use App\Models\CinemasCity;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ReflectionClass;

class CinemasController extends Controller
{
    use CinemasTrait;
    protected $cinemas;
    protected $cinemasCity;
    public function __construct(Cinemas $cinemas,CinemasCity $cinemasCity)
    {
        $this->cinemas=$cinemas;
        $this->cinemasCity=$cinemasCity;
    }
    public function index()
    {
        $data['notifications']=$this->cinemas->get();
        return view('admin.cinemas.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status=new ReflectionClass(UserStatusEnum::class);
        $data['cinemas_status']=array_values($status->getConstants());
        $data['cinemas_unique_code']=$this->generateCinemasUniqueCode();
        $data['cities']=City::where('status','1')->get();
        return view('admin.cinemas.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CinemasStoreRequest $request)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $this->cinemas->fill($data);
            $this->cinemas->save();
            $temp=[];
            foreach($request->cities as $city){
                $temp[]=[
                    'cinemas_id'=>$this->cinemas->id,
                    'city_id'=>$city
                ];
            }
            $this->cinemasCity->insert($temp);
            DB::commit();
            $request->session()->flash('success','Cinemas Created Successfully !!');
            return redirect()->route('cinemas.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cinemas $cinemas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cinemas $cinema)
    {
        $status=new ReflectionClass(UserStatusEnum::class);
        $data['cinemas_status']=array_values($status->getConstants());
        $data['cinema']=$cinema;
        $data['cities']=City::where('status','1')->get();
        return view('admin.cinemas.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CinemasUpdateRequest $request, Cinemas $cinema)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $cinema->fill($data);
            $cinema->save();
            $cinema->city()->delete();
            $temp=[];
            foreach($request->cities as $city){
                $temp[]=[
                    'cinemas_id'=>$cinema->id,
                    'city_id'=>$city
                ];
            }
            $this->cinemasCity->insert($temp);
            DB::commit();
            $request->session()->flash('success','Cinemas Updated Successfully !!');
            return redirect()->route('cinemas.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Cinemas $cinema)
    {
        DB::beginTransaction();
        // try{
            $cinema->delete();
            DB::commit();
            $request->session()->flash('success','Cinemas Deleted Successfully !!');
            return redirect()->route('cinemas.index');
        // }catch(\Throwable $th){
        //     DB::rollback();
        //     $request->session()->flash('error','Something Went Wrong !!');
        //     return redirect()->back();
        // }
    }
}
