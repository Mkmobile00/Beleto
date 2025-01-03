<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Enum\UserStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\AdminUpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $user;
    public function __construct(User $user)
    {
        $this->user=$user;
    }
    public function index()
    {
        $data['users']=User::get();
        return view('admin.user.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['roles']=Role::get();
        return view('admin.user.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        DB::beginTransaction();
        $data=$request->all();
        try{
            if($request->password && $request->password !=null)
            {
                $data['password']=bcrypt($request->password);
            }
            if($request->status=='1')
            {
                $data['status']=UserStatusEnum::ACTIVE->value;
            }else{
                $data['status']=UserStatusEnum::INACTIVE->value;
            }

            $role=Role::find($request->role);
            $this->user->fill($data);
            $this->user->save();
            $this->user->assignRole($role->name);
            DB::commit();
            $request->session()->flash('success','User Added Successfully !!');
            return redirect()->route('user.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
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
    public function edit(User $user)
    {
        $data['roles']=Role::get();
        $data['user']=$user;
        return view('admin.user.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        DB::beginTransaction();
        $data=$request->all();
        // try{
           
            if($request->status=='1')
            {
                $data['status']=UserStatusEnum::ACTIVE->value;
            }else{
                $data['status']=UserStatusEnum::INACTIVE->value;
            }

            $role=Role::find($request->role);
           
            $user->fill($data);
            $user->save();
            $user->roles()->detach();
            $user->assignRole($role->name);
            DB::commit();
            $request->session()->flash('success','User Updated Successfully !!');
            return redirect()->route('user.index');
        // }catch(\Throwable $th){
        //     DB::rollback();
        //     $request->session()->flash('error','Something Went Wrong !!');
        //     return redirect()->back();
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,User $user)
    {
        DB::beginTransaction();
        try{
           
            $user->delete();
            DB::commit();
            $request->session()->flash('success','User Deleted Successfully !!');
            return redirect()->route('user.index');
        }catch(\Throwable $th){
            DB::rollback();
            $request->session()->flash('error','Something Went Wrong !!');
            return redirect()->back();
        }
    }

    public function updatePassword(AdminUpdatePasswordRequest $request)
    {
        $admin=auth()->user();
        if(!$admin)
        {
            $response=[
                'error'=>true,
                'msg'=>'Unauthorized Access !!'
            ];
            return response()->json($response,200);
        }

        $old_password=Hash::check($request->current_password,$admin->password);
        if(!$old_password)
        {
            $response=[
                'old_password'=>true,
                'msg'=>'Sorry !! Current Password Doesnot Match Our Records'
            ];
            return response()->json($response,200);
        }
        
        $admin->password=bcrypt($request->password);
        DB::beginTransaction();
        try{
            $admin->save();
            DB::commit();
            $response=[
                'success'=>true,
                'msg'=>'Password Updated Successfully !!'
            ];
            return response()->json($response,200);
        }catch(\Throwable $th){
            $response=[
                'error'=>true,
                'msg'=>$th->getMessage()
            ];
            session()->flash('success','Password Updated Successfully !!');
            return response()->json($response,200);
        }
       


    }
}
