<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LanguageSelection;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LanguageSelectionStoreRequest;
use App\Http\Requests\LanguageSelectionUpdateRequest;

class LanguageSelectionController extends Controller
{
    protected $languageSelection;
    public function __construct(LanguageSelection $languageSelection)
    {
        $this->languageSelection=$languageSelection;
    }
    public function index()
    {
        $data['languageSelections']=$this->languageSelection->get();
        return view('admin.languageselection.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.languageselection.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LanguageSelectionStoreRequest $request)
    {
        
        DB::beginTransaction();
        try{
            $data=$request->all();
            $this->languageSelection->fill($data);
            $this->languageSelection->save();
            DB::commit();
            $request->session()->flash('success','Language Created Successfully !!');
            return redirect()->route('language-selection.index');
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
    public function show(LanguageSelection $languageSelection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LanguageSelection $languageSelection)
    {
        $data['languageSelection']=$languageSelection;
        return view('admin.languageselection.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LanguageSelectionUpdateRequest $request, LanguageSelection $languageSelection)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $languageSelection->fill($data);
            $languageSelection->save();
            DB::commit();
            $request->session()->flash('success','Language Updated Successfully !!');
            return redirect()->route('language-selection.index');
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
    public function destroy(Request $request,LanguageSelection $languageSelection)
    {
        DB::beginTransaction();
        try{
            $languageSelection->delete();
            DB::commit();
            $request->session()->flash('success','Language Deleted Successfully !!');
            return redirect()->route('language-selection.index');
        }catch(\Throwable $th)
        {
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }
}
