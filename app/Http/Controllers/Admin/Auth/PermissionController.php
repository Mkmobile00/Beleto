<?php
namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions=Permission::paginate(20);
        return view('admin.permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permission.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $data['guard_name']='web';
            Permission::create($data);
            DB::commit();
            $request->session()->flash('success','Permission Created Successfully !!');
            return redirect()->route('permission.index');
        }catch(\Throwable $th){
            DB::rollBack();
            $request->session()->flash('error','Something Wrent Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd('ok');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,Permission $permission)
    {
       
        return view('admin.permission.form',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request,Permission $permission)
    {
        DB::beginTransaction();
        try{
            $data=$request->all();
            $data['guard_name']='web';
            $permission->update($data);
            DB::commit();
            $request->session()->flash('success','Permission Updated Successfully !!');
            return redirect()->route('permission.index');
        }catch(\Throwable $th){
            DB::rollBack();
            $request->session()->flash('error','Something Wrent Wrong !!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
