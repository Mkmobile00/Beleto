<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function responseError(string $message, int $code = 500)
    {
        return response()->json([
            'status' => false,
            'code' => $code,
            'message' => $message
        ], $code);
    }

    public function responseSuccessMessage(string $message, int $code = 200)
    {
        return response()->json([
            'status' => true,
            'code' => $code,
            'message' => $message
        ], $code);
    }

    public function responseApiError(string $message, $data=null,int $code = 500)
    {
        return response()->json([
            'error' => true,
            'data'=>$data,
            'msg' => $message
        ], $code);
    }

    public function responseApiSuccess(string $message, $data=null,int $code = 500)
    {
        return response()->json([
            'error' => false,
            'data'=>$data,
            'msg' => $message
        ], $code);
    }
    public function responseApiSuccessCustome(string $message, $data=null,$field,$value,int $code = 500)
    {
        return response()->json([
            'error' => false,
            'data'=>$data,
            $field=>$value,
            'msg' => $message
        ], $code);
    }

    public function webError(Request $request){
        $request->session()->flash('error','Something Went Wrong !!');
        return redirect()->back();
    }

    public function returnHomePage(Request $request,$msg){
        $request->session()->flash('error',$msg);
        return redirect()->route('home');
    }

    public function returnHomePageSuccess(Request $request,$msg){
        $request->session()->flash('success',$msg);
        return redirect()->route('home');
    }
}
