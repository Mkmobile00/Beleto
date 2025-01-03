<?php
namespace App\Http\Controllers\Admin\Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::withCount(['users', 'permissions'])->get();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required'
            ]
        );
        
        try {
            Role::create($request->all());
            request()->session()->flash('success', 'Role Created Successfully');
            return redirect()->route('role.index');
        } catch (\Throwable $th) {
            request()->session()->flash(
                'error',
                $th->getMessage()
            );
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::findorfail($id);
        $selectedPermissions = $role->permissions()->pluck('id')->toArray();

        $permissions = Permission::get()->groupBy(function ($item, $key) {
            return explode('-', $item->name)[0];
        });
        return view('admin.role.form', compact('role', 'permissions', 'selectedPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate(
            [
                'name' => 'required',
                'permission' => ['nullable', 'array'],
                'permission.*' => ['nullable', 'exists:permissions,id']
            ]
        );
        $role = Role::findorfail($id);
        try {
            $role->update(['name' => $request->name]);
            $role->permissions()->sync($request->permission);
            request()->session()->flash('success', 'Role Updated Successfully');
            return redirect()->route('role.index');
        } catch (\Throwable $th) {
            request()->session()->flash(
                'error',
                $th->getMessage()
            );
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Role $role)
    {
        DB::beginTransaction();
       try{
            $role->permissions()->delete();
            $role->delete();
            // dd($role);
            DB::commit();
            $request->session()->flash('success','Role Deleted Successfully !!');
            return redirect()->back();
       }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
       }
    }
}
