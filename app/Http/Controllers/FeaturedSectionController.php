<?php

namespace App\Http\Controllers;

use ReflectionClass;
use App\Models\Movie;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\FeaturedItem;
use Illuminate\Http\Request;
use App\Models\MovieCategory;
use App\Models\FeaturedSection;
use Illuminate\Support\Facades\DB;
use App\Enum\Layout\LayoutDesignEnum;
use App\Data\FeaturedSection\FeaturedType;
use App\Http\Requests\FeaturedItemRequest;
use App\Http\Requests\FeaturedSetionStoreRequest;
use App\Enum\FeaturedSection\FeaturedSectionTypeEnum;
use App\Models\TvSeries;
use App\Models\WebSeries;

class FeaturedSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $featuredsection;
    protected $featuredItem;
    public function __construct(FeaturedSection $featuredsection, FeaturedItem $featuredItem)
    {
        $this->featuredsection = $featuredsection;
        $this->featuredItem = $featuredItem;
    }
    public function index()
    {
        $data['featuredSections'] = $this->featuredsection->orderBy('position','ASC')->get();
        return view('admin.featuredsection.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = (new FeaturedType())->getAllValues();
        $view_types=new ReflectionClass(LayoutDesignEnum::class);
        $data['view_types']=array_values($view_types->getConstants());
        return view('admin.featuredsection.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeaturedSetionStoreRequest $request)
    {
        $data = $request->all();
        try {
            $data['slug'] = Str::slug($request->title);
            $this->featuredsection->fill($data);
            $this->featuredsection->save();
            DB::commit();
            $request->session()->flash('success', 'Featured Section Added !!');
            return redirect()->route('featuredsection.index');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FeaturedSection $featuredSection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeaturedSection $featuredsection)
    {
        $data = (new FeaturedType())->getAllValues();
        $data['featuredsection'] = $featuredsection;
        $view_types=new ReflectionClass(LayoutDesignEnum::class);
        $data['view_types']=array_values($view_types->getConstants());
        return view('admin.featuredsection.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeaturedSetionStoreRequest $request, FeaturedSection $featuredsection)
    {
        $data = $request->all();
        try {
            $data['slug'] = Str::slug($request->title);
            $featuredsection->fill($data);
            $featuredsection->save();
            DB::commit();
            $request->session()->flash('success', 'Featured Section Updated !!');
            return redirect()->route('featuredsection.index');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, FeaturedSection $featuredsection)
    {
        try {
            $featuredsection->delete();
            DB::commit();
            $request->session()->flash('success', 'Featured Deleted !!');
            return redirect()->route('featuredsection.index');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect()->back();
        }
    }

    public function addFeaturedItem(Request $request, $id)
    {
        $data['featuredsection'] = FeaturedSection::findOrFail($id);
        switch ($data['featuredsection']->type) {
            case FeaturedSectionTypeEnum::CATEGORY:
                $data['items'] = Category::where('status', '1')->get();
                break;
            case FeaturedSectionTypeEnum::TVSERIES:
                $data['items']=TvSeries::get();
                break;
            case FeaturedSectionTypeEnum::WEBSERIES:
                $data['items']=WebSeries::get();
                break;
            case FeaturedSectionTypeEnum::MOVIES:
                $data['items'] = Movie::get();
                break;
            default:
                $request->session()->flash('error', 'Something Went Wrong !!');
                return redirect()->route('featuredsection.index');
                break;
        }
        return view('admin.featuredsection.addItem', $data);
    }

    public function storeFeaturedItem(FeaturedItemRequest $request)
    {
        $data = $request->all();
        $featuredSection = FeaturedSection::findOrFail($request->featured_id);
        try {
            $temp = [];
            foreach ($request->item_id as $item) {
                $temp[] = [
                    'featured_id' => $featuredSection->id,
                    'type' => $featuredSection->type,
                    'item_id' => $item
                ];
            }
            $featuredSection->items()->delete();
            $this->featuredItem->insert($temp);
            DB::commit();
            $request->session()->flash('success', 'Item Added Successfully !!');
            return redirect()->route('featuredsection.index');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect()->back();
        }
    }

    public function updatePosition(Request $request)
    {
        DB::beginTransaction();
        try{
                $array = $request->order;
                foreach($array as $arr){
                    $trip = FeaturedSection::find($arr['id']);
                    $trip->position = $arr['position'];
                    $trip->save();
                }
                DB::commit();
                $response=[
                    'error'=>false,
                    'msg'=>'Position Updated !!'
                ];
                return response($response, 200);
        }catch(\Throwable $th){
                DB::rollBack();
                $response=[
                    'error'=>true,
                    'msg'=>'Something Went Wrong !!'
                ];
                return response($response, 200);
        }
       
    }

    public function setPosition(Request $request,$id){
        $data['featuredsection'] = FeaturedSection::findOrFail($id);
        switch ($data['featuredsection']->type) {
            case FeaturedSectionTypeEnum::CATEGORY:
                $data['items'] = Category::where('status', '1')->get();
                break;
            case FeaturedSectionTypeEnum::TVSERIES:
                $data['items']=TvSeries::get();
                break;
            case FeaturedSectionTypeEnum::WEBSERIES:
                $data['items']=WebSeries::get();
                break;
            case FeaturedSectionTypeEnum::MOVIES:
                $data['items'] = Movie::get();
                break;
            default:
                $request->session()->flash('error', 'Something Went Wrong !!');
                return redirect()->route('featuredsection.index');
                break;
        }
        $itemsData=$data['featuredsection']->items;
        $finalData=collect($data['items'])->whereIn('id',$data['featuredsection']->items->pluck('item_id'))->map(function($item) use ($itemsData){
             $itemsData->map(function($originalData) use ($item){
                if($originalData->item_id==$item->id){
                    $item->id=$originalData->id;
                }
            });
            return $item;
        });

        return view('admin.featuredsection.featuredItem',compact('finalData'));
    }

    public function updatePositionItem(Request $request)
    {
        DB::beginTransaction();
        try{
                $array = $request->order;
                foreach($array as $arr){
                    $trip = FeaturedItem::find($arr['id']);
                    $trip->position = $arr['position'];
                    $trip->save();
                }
                DB::commit();
                $response=[
                    'error'=>false,
                    'msg'=>'Position Updated !!'
                ];
                return response($response, 200);
        }catch(\Throwable $th){
                DB::rollBack();
                $response=[
                    'error'=>true,
                    'msg'=>'Something Went Wrong !!'
                ];
                return response($response, 200);
        }
       
    }
    
}