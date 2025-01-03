<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use Exception;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function districts(Request $request)
    {
       $province=Province::where('id',$request->provinceId)->first();
       try{
            if(!$province)
            {
                throw new Exception();
            }
            $districts=$province->getDistrict;
            $response=[
                'error'=>false,
                'data'=>$districts,
                'msg'=>'District List With Province Wise !!'
            ];
            return response()->json($response,200);
       }catch(\Throwable $th)
       {
            $response=[
                'error'=>true,
                'data'=>'null',
                'msg'=>'Something Went Wrong !!'
            ];
            return response()->json($response,200);
       }
       
    }

    public function locals(Request $request)
    {
       $dictrict=District::where('id',$request->districtId)->first();
      
       try{
            if(!$dictrict)
            {
                throw new Exception();
            }
            $locals=$dictrict->getLocals;
            $response=[
                'error'=>false,
                'data'=>$locals,
                'msg'=>'Locals List With District Wise !!'
            ];
            return response()->json($response,200);
       }catch(\Throwable $th)
       {
            $response=[
                'error'=>true,
                'data'=>'null',
                'msg'=>'Something Went Wrong !!'
            ];
            return response()->json($response,200);
       }
       
    }
}
