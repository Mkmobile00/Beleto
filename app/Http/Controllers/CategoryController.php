<?php

namespace App\Http\Controllers;

use ReflectionClass;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Enum\Layout\LayoutDesignEnum;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $category;
    public function __construct(Category $category)
    {
        $this->category=$category;
    }
    public function index()
    {
        $data['categories']=$this->category->orderBy('id','DESC')->get();
        return view('admin.category.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories']=$this->category->get();
        $view_types=new ReflectionClass(LayoutDesignEnum::class);
        $data['view_types']=array_values($view_types->getConstants());
        return view('admin.category.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $data['slug']=Str::slug($request->title);
            $this->category->fill($data);
            $this->category->save();
            DB::commit();
            $request->session()->flash('success','Category Created Successfully !!');
            return redirect()->route('category.index');
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
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $data['categories']=$this->category->where('id','!=',$category->id)->get();
        $data['category']=$category;
        $view_types=new ReflectionClass(LayoutDesignEnum::class);
        $data['view_types']=array_values($view_types->getConstants());
        return view('admin.category.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            // dd($data);
            $category->fill($data);
            $category->save();
            DB::commit();
            $request->session()->flash('success','Category Updated Successfully !!');
            return redirect()->route('category.index');
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
    public function destroy(Request $request,Category $category)
    {
        
        DB::beginTransaction();
        try{
            $childCategory=$category->childCat;
            if($childCategory && count($childCategory) >0){
                foreach($childCategory as $cat){
                    $cat->parent_id=null;
                    $cat->save();
                }
            }
           
            $category->delete();
            DB::commit();
            $request->session()->flash('success','Category Deleted Successfully !!');
            return redirect()->route('category.index');
        }catch(\Throwable $th)
        {
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    public function organizeCategory(){
        $data['categories']=$this->category->whereNull('parent_id')->get();
        return view('admin.category.organize',$data);
    }

    public function updateOrganizeCategory(Request $request){
        
        parse_str($request->sort, $arr);
        foreach ($arr['test'] as $key => $value) {
            Category::where('id', $key)
                ->update(['parent_id' => (int) $value]);
           
        }
        Category::fixTree();
        $response=[
            'error'=>false,
            'msg'=>'Category Updated'
        ];
        return response()->json($response, 200);
    }
}
