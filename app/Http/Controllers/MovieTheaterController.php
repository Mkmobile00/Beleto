<?php

namespace App\Http\Controllers;

use App\Enum\UserStatusEnum;
use App\Http\Requests\MovieTheaterStoreRequest;
use App\Http\Requests\MovieTheaterUpdateRequest;
use App\Http\Traits\CinemasTrait;
use App\Models\Cinemas;
use App\Models\CinemasBranch;
use App\Models\City;
use App\Models\Movie;
use App\Models\MovieTheater;
use App\Models\TheaterMovie;
use App\Models\TheaterMovieDate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use ReflectionClass;

class MovieTheaterController extends Controller
{
    use CinemasTrait;
    protected $movietheater;
    public function __construct(MovieTheater $movietheater)
    {
        $this->movietheater=$movietheater;
    }
    public function index()
    {
        $data['notifications']=$this->movietheater->get();
        $data['movies']=Movie::get();
        return view('admin.movietheater.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status=new ReflectionClass(UserStatusEnum::class);
        $data['cinemas_status']=array_values($status->getConstants());
        $data['cinemas']=Cinemas::with('cinemasBranch')->where('status','1')->get();
        $data['cinemasBranches']=CinemasBranch::with('cities')->where('status','1')->get();
        $data['cinemasBranchArrayData'] = collect($data['cinemas'])->mapWithKeys(function($item) {
            return [
                $item->id => $item->cinemasBranch->pluck('id')->toArray()
            ];
        })->toArray();
        $data['cinemasBranchCityArrayData'] = collect($data['cinemasBranches'])->mapWithKeys(function($item) {
            return [
                $item->id => $item->cities->pluck('city_id')->toArray()
            ];
        })->toArray();
        $data['cities']=City::where('status','1')->get();
        $data['theater_unique_id']=$this->generateMovieTheaterUniqueCode();
        return view('admin.movietheater.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieTheaterStoreRequest $request)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $this->movietheater->fill($data);
            $this->movietheater->save();
            DB::commit();
            $request->session()->flash('success','Movie Theater Created Successfully !!');
            return redirect()->route('movietheater.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MovieTheater $movietheater)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MovieTheater $movietheater)
    {
        $data['movietheater']=$movietheater;
        $status=new ReflectionClass(UserStatusEnum::class);
        $data['cinemas_status']=array_values($status->getConstants());
        $data['cinemas']=Cinemas::with('cinemasBranch')->where('status','1')->get();
        $data['cinemasBranches']=CinemasBranch::with('cities')->where('status','1')->get();
        $data['cinemasBranchArrayData'] = collect($data['cinemas'])->mapWithKeys(function($item) {
            return [
                $item->id => $item->cinemasBranch->pluck('id')->toArray()
            ];
        })->toArray();
        $data['cinemasBranchCityArrayData'] = collect($data['cinemasBranches'])->mapWithKeys(function($item) {
            return [
                $item->id => $item->cities->pluck('city_id')->toArray()
            ];
        })->toArray();
        $data['cities']=City::where('status','1')->get();
        return view('admin.movietheater.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieTheaterUpdateRequest $request, MovieTheater $movietheater)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $movietheater->fill($data);
            $movietheater->save();
            DB::commit();
            $request->session()->flash('success','Movie Theater Updated Successfully !!');
            return redirect()->route('movietheater.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,MovieTheater $movietheater)
    {
        DB::beginTransaction();
        try{
            $movietheater->delete();
            DB::commit();
            $request->session()->flash('success','Movie Theater Deleted Successfully !!');
            return redirect()->route('movietheater.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    // public function getSlotPopUp(Request $request){
    //     // try{
    //         $data['movies']=Movie::get();

    //         $movieTheater=MovieTheater::where('id',$request->selectedTheater)->first();
    //         if(!$movieTheater){
    //             throw new Exception();
    //         }
    //         // dd($movieTheater->id);
    //         // $theaterMoviesData=TheaterMovie::where('movie_theater_id',$movieTheater->id)->get();
    //         // dd($theaterMoviesData);
    //         // $theaterMovies=$theaterMoviesData->pluck('id')->toArray();
    //         // dd($theaterMovies);
    //         // if($theaterMovies){
    //         //     $bookedDates=TheaterMovieDate::whereIn('theater_movies_id',$theaterMovies)->get()->pluck('show_date')->unique()->map(function($item){
    //         //         return Carbon::parse($item)->format('Y/m/d');
    //         //     });
    //         // }else{
    //         //     $bookedDates=[];
    //         // }
    //         // $data['moviesData']=$theaterMoviesData->map(function($item){
    //         //     return[
    //         //         'movie'=>$item->movie->title,
    //         //         'movie_theater_id'=>$item->movie_theater_id,
    //         //         'dates'=>$item->bookedDates->map(function($item){
    //         //             return[
    //         //                 "id" => $item->id,
    //         //                 "show_date" => $item->show_date,
    //         //                 'timeSlot'=>$item->timeSlot->map(function($item){
    //         //                     return[
    //         //                         'start_value'=>$item->start_time,
    //         //                         'start_time'=>Carbon::parse($item->start_time)->format('h:i:s A'),
    //         //                         'end_value'=>$item->end_time,
    //         //                         'end_time'=>Carbon::parse($item->end_time)->format('h:i:s A')
    //         //                     ];
    //         //                 })
    //         //             ];
    //         //         })
    //         //     ];
    //         // });
    //         $view=view('admin.movietheater.slotformblade',$data)->render();
    //         $response=[
    //             'error'=>false,
    //             'data'=>[
    //                 'view'=>$view,
    //                 // 'bookedDates'=>$bookedDates
    //                 'bookedDates'=>null
    //             ],
    //             'msg'=>'Success'
    //         ];
    //         return response()->json($response,200);
    //     // }catch(\Throwable $th){
    //     //     $response=[
    //     //         'error'=>true,
    //     //         'msg'=>'Something Went Wrong !!'
    //     //     ];
    //     //     return response()->json($response,200);
    //     // }
    // }

    // public function setTheaterTimeSlot(Request $request){
    //     $rules = array(
    //         "movie_id*" => "required|exists:movie_theaters,id",
    //         "date_range" => "required|string",
    //         "shows_number" => "required|integer",
    //         "start_time*" => "required",
    //         "end_time*" =>"required",
    //         "theaterId"=>"required|exists:movie_theaters,id",
    //     );
    //     $v = Validator::make($request->all(), $rules);
    //     if (!$v->passes()) {
    //         $messages = $v->messages();
    //         foreach ($rules as $key => $value) {
    //             $verrors[$key] = $messages->first($key);
    //         }
    //         $response_values = array(
    //             'validate' => true,
    //             'validation_failed' => 1,
    //             'errors' => $verrors
    //         );
    //         return response()->json($response_values, 200);
    //     }
    //     DB::beginTransaction();
    //     // try{
    //         DB::commit();
    //         $response=[
    //             'error'=>false,
    //             'msg'=>'Theater Setup Successfully !!'
    //         ];
    //         return response()->json($response,200);

    //     // }catch(\Throwable $th){
    //     //     DB::rollback();
    //     //     $response=[
    //     //         'error'=>true,
    //     //         'data'=>null,
    //     //         'msg'=>'Something Went Wrong !!'
    //     //     ];
    //     //     return response()->json($response,200);
    //     // }
    // }

    // public function deleteDate(Request $request){
    //     DB::beginTransaction();
    //     try{
    //         $theaterMoviesDatesId=$request->theaterMoviesDateid;
    //         if(!$theaterMoviesDatesId){
    //             throw new Exception();
    //         }
    //         $theaterMovieDates=TheaterMovieDate::where('id',$theaterMoviesDatesId)->first();
    //         if(!$theaterMovieDates){
    //             throw new Exception();
    //         }
    //         $theaterMovie=TheaterMovie::where('id',$theaterMovieDates->theater_movies_id)->first();
    //         $theaterMovieDates->delete();
    //         $remaingDateForTheater=TheaterMovieDate::where('theater_movies_id',$theaterMovie->id)->get();
    //         if(!$remaingDateForTheater || count($remaingDateForTheater)<=0){
    //             $theaterMovie->delete();
    //         }
    //         DB::commit();
    //         $response=[
    //             'error'=>false,
    //             'msg'=>'Date Removed Successfully !!'
    //         ];
    //         return response()->json($response,200);
    //     }catch(\Throwable $th){
    //         DB::rollback();
    //         $response=[
    //             'error'=>true,
    //             'data'=>null,
    //             'msg'=>'Something Went Wrong !!'
    //         ];
    //         return response()->json($response,200);
    //     }
    // }

    public function timmimgView(Request $request,$id){
        $theater=MovieTheater::findOrFail($id);
        $slots = $theater->slots->groupBy('day_of_week');
        if($slots && count($slots) > 0){
            return view('admin.movietheater.tmimingviewedit',['model'=>$theater,'slots'=>$slots]);
        }
        return view('admin.movietheater.tmimingview',compact('theater'));
    }

    public function addTheaterTime(Request $request,$id){
        DB::beginTransaction();
        try{
            $movieTheater=MovieTheater::where('id',$id)->first();
            if(!$movieTheater){
                throw new Exception();
            }
            foreach ($request->start_time as $day => $start_time) {
                $day_end_time = $request->end_time[$day] ?? [];
                foreach ($start_time as $key => $start) {
                    if ($start >= $day_end_time[$key]) {
                        return redirect()->back()->with('error', 'Start time is after end time for ' . $day);
                    }
                    $slot = [
                        'theater_id'=>$movieTheater->id,
                        'day_of_week' => $day,
                        'start_time' => $start,
                        'end_time' => $day_end_time[$key] ?? null,
                    ];
                    $movieTheater->slots()->create($slot);
                }
            }
            DB::commit();
            $request->session()->flash('success','Theater Timing Slots Created Successfully !!');
            return redirect()->route('movietheater.index');
        }catch(\Throwable $th){
            DB::rollBack();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    public function editTheaterTime(Request $request,$id){
        DB::beginTransaction();
        // try{
            $movieTheater=MovieTheater::where('id',$id)->first();
            if(!$movieTheater){
                throw new Exception();
            }
            $movieTheater->slots()->delete();
            foreach ($request->start_time as $day => $start_time) {
                $day_end_time = $request->end_time[$day] ?? [];
                foreach ($start_time as $key => $start) {
                    if ($start >= $day_end_time[$key]) {
                        return redirect()->back()->with('error', 'Start time is after end time for ' . $day);
                    }
                    $slot = [
                        'theater_id'=>$movieTheater->id,
                        'day_of_week' => $day,
                        'start_time' => $start,
                        'end_time' => $day_end_time[$key] ?? null,
                    ];
                    $movieTheater->slots()->create($slot);
                }
            }
            DB::commit();
            $request->session()->flash('success','Theater Timing Slots Updated Successfully !!');
            return redirect()->route('movietheater.index');
        // }catch(\Throwable $th){
        //     DB::rollBack();
        //     $request->session()->flash('error','Something Went Wrong !!');
        //     return redirect()->back();
        // }
    }
}
