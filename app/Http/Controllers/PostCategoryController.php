<?php

namespace App\Http\Controllers;

use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PostCategoryStoreRequest;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $postCategory;
    public function __construct(PostCategory $postCategory)
    {
        $this->postCategory=$postCategory;
    }
    public function index()
    {
        $data['posts']=$this->postCategory->get();
        return view('admin.postcategory.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCategoryStoreRequest $request)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $this->postCategory->fill($data);
            $this->postCategory->save();
            DB::commit();
            $request->session()->flash('success','Post Category Created Successfully !!');
            return redirect()->back();
        }catch(\Throwable $th){
            DB::rollBack();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PostCategory $postCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostCategory $postCategory)
    {
        $data['postCat']=$postCategory;
        return view('admin.postcategory.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostCategoryStoreRequest $request, PostCategory $postCategory)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $postCategory->fill($data);
            $postCategory->save();
            DB::commit();
            $request->session()->flash('success','Post Category Updated Successfully !!');
            return redirect()->route('post-category.index');
        }catch(\Throwable $th){
            DB::rollBack();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,PostCategory $postCategory)
    {
        DB::beginTransaction();
        try{
            $postCategory->delete();
            DB::commit();
            $request->session()->flash('success','Post Category Deleted Successfully !!');
            return redirect()->back();
        }catch(\Throwable $th){
            DB::rollBack();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }
}
