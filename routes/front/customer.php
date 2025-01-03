<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerDashboardController;

Route::get('/user/login', [CustomerAuthController::class, 'getLoginPage'])->name('customer.login');
Route::get('/user/register', [CustomerAuthController::class, 'getRegisterPage'])->name('customer.register');
Route::get('/user/verify', [CustomerAuthController::class, 'verifyCustomerOtp'])->name('customer.customerotp');


Route::get('/user/reset-password',[CustomerAuthController::class,'resetPasswordView'])->name('customer.frontresetPassword');
Route::post('/user/reset-password',[CustomerAuthController::class,'resetPasswordAction'])->name('customer.password.email');
Route::post('/user/update-reset-password',[CustomerAuthController::class,'updatePasswordAction'])->name('customer.password.update');

Route::post('user/verificationNew', [CustomerAuthController::class, 'verificationNew'])->name('customer.verificationNew');
Route::get('/otp', [CustomerAuthController::class, 'showOTPForm'])->name('customers.otp');

Route::post('/user/login', [CustomerAuthController::class, 'customerNewLogin'])->name('customer.loginnew');
// Route::post('/customer/login',[CustomerAuthController::class,'loginResponse'])->name('customer.login-register');

Route::post('/user/verify-otp', [CustomerAuthController::class, 'verifyOtp'])->name('customer.verifyotp');

Route::post('/user/resgister', [CustomerAuthController::class, 'registerNewUser'])->name('customer.registernew');
Route::get('/user/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
Route::post('/user/add-susbcription', [CustomerAuthController::class, 'addSusbcription'])->name('customer.addSusbcription');
Route::post('/user/subscription-payment', [CustomerAuthController::class, 'susbcriptionPayment'])->name('subscription.payment');


Route::post('/setCustomerCurrency', [CustomerAuthController::class, 'setCurrency'])->name('setCustomerCurrency')->middleware('customer');

Route::post('/user/add-premium-content', [CustomerAuthController::class, 'addPremiumContent'])->name('customer.addPremiumContent')->middleware('customer');
Route::post('/user/premium-payment/', [CustomerAuthController::class, 'primiumPayment'])->name('premium.payment')->middleware('customer');

Route::get('/user/add-wishlist/{movie_id}/{video_type}', [CustomerAuthController::class, 'addToWishList'])->name('customer.addWishList')->middleware('customer');
Route::post('/removeFromWishList',[CustomerAuthController::class,'removeFromWishList'])->name('removeFromWishList');

Route::get('/ime-pay-delivery-mobile', function (Request $request) {
    Log::info('sumit', $request->all());
})->name('imepaydelivery');

Route::get('/kantipur/customer_dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard')->middleware('customer');
Route::get('/kantipur/customer_allsusbcription', [CustomerDashboardController::class, 'allSubscription'])->name('customer.subscriptionlogin')->middleware('customer');
Route::get('/kantipur/customer_payments', [CustomerDashboardController::class, 'allPayments'])->name('customer.paymentslogin')->middleware('customer');
Route::put('/kantipur/update-profile', [CustomerDashboardController::class, 'updateProfile'])->name('kantipur.update-profile');
Route::put('/user/update-password', [CustomerDashboardController::class, 'updatePassword'])->name('user.update-password');
Route::get('/payment/details/{invoiceNum}',[CustomerDashboardController::class,'downloadInvoice'])->name('payment.details')->middleware('customer');
Route::get('/kantipur/customer/device_list',[CustomerDashboardController::class,'customerAllDeviceList'])->name('customer.alldevicelist')->middleware('customer');
Route::delete('/kantipur/customer/device_list/deleteDeviceList/{id}',[CustomerDashboardController::class,'customerDeleteDeviceList'])->name('customer.deletedevicelist')->middleware('customer');

