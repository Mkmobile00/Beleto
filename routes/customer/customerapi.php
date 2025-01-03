<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\CurrencyController;
use App\Http\Controllers\VideoHistoryController;
use App\Http\Controllers\Api\LikeDislikeController;
use App\Http\Controllers\Customer\CustomerController;


Route::group(['prefix' => 'customer'], function () {
    Route::post('/login-register', [CustomerController::class, 'loginOrRegister']);
    Route::post('/verify-otp', [CustomerController::class, 'getLogin']);
    Route::post('/customer/login',[CustomerController::class,'customerNewLogin']);
    Route::post('/social-login-register', [CustomerController::class, 'socialLoginOrRegister']);
    Route::get('/streamming_now',[HomeController::class,'streammingNow']);
    Route::get('/movie-details', [HomeController::class, 'movieDetails']);
    Route::get('/home', [HomeController::class, 'home']);
    Route::get('/casts', [HomeController::class, 'castsDetails']);
    Route::get('/genre', [HomeController::class, 'getGenre']);
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/subscription', [ApiController::class, 'subscription']);
        Route::post('/register-details', [CustomerController::class, 'updateDetails']);
        Route::post('/update-profile', [CustomerController::class, 'updateProfile']);
        Route::get('/customer-profile', [CustomerController::class, 'customerProfile']);
        Route::post('/subscription-payment', [PaymentController::class, 'subscriptionPayment']);
        Route::post('/premium_payment', [PaymentController::class, 'primiumPayment']);
        Route::get('/customer-subscription', [HomeController::class, 'subscription']);
        Route::post('/set-default-currency', [HomeController::class, 'setDefaultCurrency']);
        Route::post('/fetch-currency-price', [HomeController::class, 'fetCurrencyPrice']);
        Route::get('/payment-history', [HomeController::class, 'customerPaymentHistory']);
        Route::get('/allsubscription', [HomeController::class, 'customerAllSubscription']);
        Route::get('/wish-list', [HomeController::class, 'customerWishList']);
        Route::post('/add-wish-list', [HomeController::class, 'addWishList']);
        Route::get('/get-history', [HomeController::class, 'getViewHistory']);
        Route::post('/add-history', [HomeController::class, 'saveHistory']);
        Route::get('/notification-list',[HomeController::class,'notificationList']);
        Route::get('/device-list',[HomeController::class,'customerDeviceList']);
        Route::post('/delete-device-list',[HomeController::class,'customerDeleteDeviceList']);
        Route::post('/fetch_video',[HomeController::class,'fetchVideo']);
        Route::get('/video_path',[HomeController::class,'fetchVideoPath']);
        Route::get('/logout',[CustomerController::class,'logout']);
        Route::post('/add_comment',[CommentController::class,'addComment']);
        Route::post('/like_dislike',[LikeDislikeController::class,'likeDislike']);
        Route::post('/video-history',[VideoHistoryController::class,'videoHistory']);
        Route::get('/delete-account',[CustomerController::class,'deleteAccount']);
        Route::post('/ios_fetch_video',[HomeController::class,'fetchVideoIos']);
        
    });
    Route::get('/comments',[CommentController::class,'comments']);
    Route::get('/payment-download/{invoiceNum}', [CustomerController::class, 'downloadBill']);
    Route::get('/currency-price-filter', [CurrencyController::class, 'filterPrice']);
    Route::post('/khalti/redirect', [PaymentController::class, 'redirect']);
    Route::get('/generate-randomnum', [HomeController::class, 'generateRandomNum']);
    Route::get('/currency', [HomeController::class, 'getCurrency']);
    Route::get('/search/{searchitem?}', [SearchController::class, 'search'])->name('search');
    Route::get('/recomended-search', [SearchController::class, 'recomendedSearch'])->name('search');
    Route::get('/category',[HomeController::class,'categories']);
    Route::get('/get-category',[HomeController::class,'categoriesMovies']);
    Route::get('/hotnew',[HomeController::class,'hotNew']);
    Route::get('/sliders',[HomeController::class,'sliders']);
    Route::post('/sliders/details',[HomeController::class,'slidersDetails']);
    Route::get('/featured-details',[HomeController::class,'featuredDetails']);
    Route::get('/hotnew-details',[HomeController::class,'hotnewDetails']);
    Route::get('/pages',[HomeController::class,'allPages']);
    Route::get('/page/{slug}',[HomeController::class,'getPage']);

    Route::post('/hamro-pay-api',[HomeController::class,'hamroPayCheckout']);
    Route::post('/request_reset_password',[HomeController::class,'requestResetPasswordCheck']);

    Route::post('/reset_password',[HomeController::class,'resetPassword']);

    Route::post('/startupadd',[HomeController::class,'getStartUpData']);
    Route::post('/delete_customer_startupadd',[HomeController::class,'deleteCustomerStartupAdd']);
    
    Route::get('/generate-signature',function(){
        $merchantId='PN_-Nru3OC4Pmi8upkOPkQ_';
        $transactionId='testsumit1454';
        $amount='10000';
        $clientId='KC_HP_100';
        $clientApiKey='HP100-uat-kantipur';
        $clientSecretKey='P@55Kantipur1';
        $baseUrl='https://uat-payclient.hamropatro.com/';
        $gateWayUrl='https://uat-checkout-pay.hamropatro.com/';
        
        $generateSignature=signHMAC($merchantId.','.$clientId.','.$clientApiKey,$clientSecretKey);
        $signatureKeySecond=generateSinganture($transactionId.','.$amount.','.$merchantId.','.$clientId.','.$clientApiKey);
        return[
            
            'signature_generated'=>$generateSignature
        ];
    });
  
    Route::post('/ime-pay-recordingurl',[HomeController::class,'imepayResponse']);
    
});