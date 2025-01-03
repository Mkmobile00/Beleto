<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\GenreStoreRequest;
use App\Http\Requests\GenreUpdateRequest;

class GenreController extends Controller
{
    protected $genre;
    public function __construct(Genre $genre)
    {
        $this->genre=$genre;
    }
    public function index()
    {
        $data['genres']=$this->genre->get();
        return view('admin.genre.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.genre.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GenreStoreRequest $request)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $data['slug']=Str::slug($request->title);
            $this->genre->fill($data);
            $this->genre->save();
            DB::commit();
            $request->session()->flash('success','Genre Created Successfully !!');
            return redirect()->route('genre.index');
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
    public function show(Genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        $data['genre']=$genre;
        return view('admin.genre.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GenreUpdateRequest $request, Genre $genre)
    {
        // dd($request->all());
        DB::beginTransaction();
        try{
            $data=$request->all();
            $genre->fill($data);
            $genre->save();
            DB::commit();
            $request->session()->flash('success','Genre Updated Successfully !!');
            return redirect()->route('genre.index');
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
    public function destroy(Request $request,Genre $genre)
    {
        DB::beginTransaction();
        try{
            $genre->delete();
            DB::commit();
            $request->session()->flash('success','Genre Deleted Successfully !!');
            return redirect()->route('genre.index');
        }catch(\Throwable $th)
        {
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }
}
