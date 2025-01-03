<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\PaymentActionController;
use Illuminate\Http\Request;

Route::get('/payment/khalti-return-callback/{slug}', [PaymentActionController::class, 'khaltiCallBackAction'])->name('khalti-callback-return');

Route::get('/payment/khalti-return-callback-premium/{slug}', [PaymentActionController::class, 'khaltiCallBackActionPremium'])->name('khalti-callback-return-premium');



Route::get('/payment/esewa-success-callback', [PaymentActionController::class, 'esewaSuccessAction'])->name('esewa-success-return');
Route::get('/payment/esewa-failure-callback', [PaymentActionController::class, 'esewaFailureAction'])->name('esewa-failure-return');

Route::get('/payment/esewa-success-callback-premium-content', [PaymentActionController::class, 'esewaSuccessActionPremiumContent'])->name('esewa-success-return-premium-content');


Route::get('/payment/customer/paypal-success/{extraDetails?}', [PaymentActionController::class, 'paypalSuccess'])->name('paypal.success');
Route::get('/payment/customer/paypal-success-premium-content/{extraDetails?}', [PaymentActionController::class, 'paypalSuccessPremiumContent'])->name('paypal.success-premium-content');
Route::get('/payment/customer/paypal-cancel', [PaymentActionController::class, 'paypalCancel'])->name('paypal.cancel');

Route::get('/payment/customer/imepay-success/{extraDetails?}', [PaymentActionController::class, 'imepaySuccess'])->name('imepay.success');
Route::get('/payment/customer/imepay-success-premium/{extraDetails?}', [PaymentActionController::class, 'imepaySuccessPremium'])->name('imepay.success-premium');
Route::get('/payment/customer/imepay-cancel', [PaymentActionController::class, 'imepayCancel'])->name('imepay.cancel');

Route::get('/payment/prabhu-pay-return-url',[PaymentActionController::class,'prabhupayPaySuccess'])->name('prabhupay-returnurl');
Route::get('/payment/prabhu-pay-return-url-premium-content',[PaymentActionController::class,'prabhupayPaySuccessPremiumContent'])->name('prabhupay-returnurl-premium-content');


Route::get('/hamro-pay/success',[PaymentActionController::class,'hamroPaySubscription'])->name('hamro-pay.success');

Route::get('/hamro-pay/failure',function(Request $request){
    $request->session()->flash('something Went Wrong !!');
        return redirect()->route('home');
})->name('hamro-pay.failure');


Route::get('/mobile/hamro-pay-success',function(Request $request){
    $request->session()->flash('something Went Wrong !!');
        return redirect()->route('home');
})->name('mobile.hamropay-success');
Route::get('/mobile/hamro-pay-failure',function(Request $request){
    $request->session()->flash('something Went Wrong !!');
    return redirect()->route('home');
})->name('mobile.hamropay-failure');