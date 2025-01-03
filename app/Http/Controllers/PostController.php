<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Enum\Post\PostEnum;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PostStoreRequest;
use App\Actions\Admin\Post\PostStoreAction;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $post;
    public function __construct(Post $post)
    {
        $this->post=$post;
    }
    public function index()
    {
        $data['posts']=$this->post->get();
        return view('admin.post.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['postStatus']=array_values((new \ReflectionClass(PostEnum::class))->getConstants());
        $data['postCategories']=PostCategory::get();
        return view('admin.post.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {
        DB::beginTransaction();
        try{
            $data=(new PostStoreAction($request,$this->post))->store();
            DB::commit();
            $request->session()->flash('success','Post Created Successfully !!');
            return redirect()->route('post.index');
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
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $data['post']=$post;
        $data['postStatus']=array_values((new \ReflectionClass(PostEnum::class))->getConstants());
        $data['postCategories']=PostCategory::get();
        return view('admin.post.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostStoreRequest $request, Post $post)
    {
        
        DB::beginTransaction();
        try{
            $data=(new PostStoreAction($request,$post))->update();
            DB::commit();
            $request->session()->flash('success','Post Updated Successfully !!');
            return redirect()->route('post.index');
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
    public function destroy(Request $request,Post $post)
    {
        DB::beginTransaction();
        try{
            $post->delete();
            DB::commit();
            $request->session()->flash('success','Post Deleted Successfully !!');
            return redirect()->route('post.index');
        }catch(\Throwable $th)
        {
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }
}
