<?php

namespace App\Http\Controllers;

use App\Actions\ShowDate\ShowDateAction;
use App\Enum\UserStatusEnum;
use App\Http\Requests\ShowDatesStoreRequest;
use App\Http\Requests\ShowsBranchStoreRequest;
use App\Http\Requests\ShowsBranchUpdateRequest;
use App\Models\Movie;
use App\Models\MovieTheater;
use App\Models\ShowDates;
use App\Models\Shows;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use ReflectionClass;
use Spatie\Permission\Commands\Show;

class ShowsController extends Controller
{
    protected $shows;
    public function __construct(Shows $shows)
    {
        $this->shows=$shows;
    }
    public function index()
    {
        $data['notifications']=$this->shows->get();
        return view('admin.shows.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status=new ReflectionClass(UserStatusEnum::class);
        $data['shows_status']=array_values($status->getConstants());
        $data['movies']=Movie::get();
        $data['theaters']=MovieTheater::where('status','1')->get();
        return view('admin.shows.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShowsBranchStoreRequest $request)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $this->shows->fill($data);
            $this->shows->save();
            DB::commit();
            $request->session()->flash('success','Shows Created Successfully !!');
            return redirect()->route('shows.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Shows $shows)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shows $show)
    {
        $status=new ReflectionClass(UserStatusEnum::class);
        $data['shows_status']=array_values($status->getConstants());
        $data['movies']=Movie::get();
        $data['theaters']=MovieTheater::where('status','1')->get();
        $data['show']=$show;
        return view('admin.shows.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShowsBranchUpdateRequest $request, Shows $show)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $show->fill($data);
            $show->save();
            DB::commit();
            $request->session()->flash('success','Shows Created Successfully !!');
            return redirect()->route('shows.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Shows $show)
    {
        DB::beginTransaction();
        try{
            $show->delete();
            DB::commit();
            $request->session()->flash('success','Shows  Deleted Successfully !!');
            return redirect()->route('shows.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    public function setTimeView(Request $request,$id){
        $show=Shows::findOrFail($id);
        $theaterShows=Shows::where('theater_id',$show->theater_id)->get();
        $dataExistTheaterShow=$theaterShows->pluck('id')->toArray();
        $showBookedDate=ShowDates::whereIn('show_id',$dataExistTheaterShow)->get();
        $bookedDateArray=$showBookedDate->pluck('date')->map(function($item){
            return Carbon::parse($item)->format('Y/m/d');
        });

        $presentTheaterDates=$show->showDates->map(function($item){
            return[
                'id'=>$item->id,
                'date'=>$item->date,
                'timeSlot'=>$item->timeSlot->map(function($item){
                    return[
                        'start_time'=>$item->start_time,
                        'end_time'=>$item->end_time
                    ];
                })
            ];
        });
        return view('admin.shows.settimeview',compact('show','showBookedDate','bookedDateArray','presentTheaterDates'));
    }

    public function setDatesData(ShowDatesStoreRequest $request,$id){
        $show=Shows::findOrFail($id);
        DB::beginTransaction();
        try{
            if(!$show){
                throw new Exception();
            }
            new ShowDateAction($request,$show);
            DB::commit();
            $request->session()->flash('success','Show Dates Added Successfully !!');
            return redirect()->back();

        }catch(\Throwable $th){
            DB::rollBack();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    public function deleteDates(Request $request){
        DB::beginTransaction();
        try{
            $showDate=ShowDates::where('id',$request->showDateId)->first();
            if(!$showDate){
                throw new Exception();
            }
            $showDate->delete();
            $show=Shows::where('id',$showDate->show_id)->first();
            $theaterShows=Shows::where('theater_id',$show->theater_id)->get();
            $dataExistTheaterShow=$theaterShows->pluck('id')->toArray();
            $showBookedDate=ShowDates::whereIn('show_id',$dataExistTheaterShow)->get();
            $bookedDateArray=$showBookedDate->pluck('date')->map(function($item){
                return Carbon::parse($item)->format('Y/m/d');
            });
            $presentTheaterDates=$show->showDates->map(function($item){
                return[
                    'id'=>$item->id,
                    'date'=>$item->date,
                    'timeSlot'=>$item->timeSlot->map(function($item){
                        return[
                            'start_time'=>$item->start_time,
                            'end_time'=>$item->end_time
                        ];
                    })
                ];
            });
            $view=view('admin.shows.updateview',compact('show','showBookedDate','bookedDateArray','presentTheaterDates'))->render();
            DB::commit();
            $response=[
                'error'=>false,
                'view'=>$view,
                'msg'=>'Date Deleted Successfully !!',
                'bookedDateArray'=>$bookedDateArray
            ];
            return response()->json($response,200);
        }catch(\Throwable $th){
            $response=[
                'error'=>true,
                'msg'=>'Something Went Wrong !!'
            ];
            return response()->json($response,200);
        }
    }
}
