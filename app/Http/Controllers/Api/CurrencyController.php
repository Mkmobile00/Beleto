<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    public function filterPrice(Request $request){
        $validator = Validator::make($request->all(), [
            'amount'=>'required|string',
            'currency_type'=>'required|exists:currencies,id',
        ]);
        if ($validator->fails()) {
            $response = [
                'error' => true,
                'data' => null,
                'msg' => $validator->errors()
            ];
            return response()->json($response, 200);
        }
        $currencyType=Currency::where('id',$request->currency_type)->first();
        if(!$currencyType){
            $response = [
                'error' => true,
                'data' => null,
                'msg' => 'Something Went Wrong !!'
            ];
            return response()->json($response, 200);
        }
        $amount=$request->amount*$currencyType->value;
        $response = [
            'error' => false,
            'amount' => (int)$amount,
            'msg' => 'Amount After Converted !!'
        ];
        return response()->json($response, 200);
    }
}
