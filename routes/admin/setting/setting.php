<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Setting\WesiteLogoController;
use App\Http\Controllers\Admin\Setting\ThemeOptionController;
use App\Http\Controllers\Admin\Setting\EmailSettingController;
use App\Http\Controllers\Admin\Setting\SystemSettingController;
use App\Http\Controllers\Admin\Setting\AndroidSettingController;
use App\Http\Controllers\Admin\Setting\FooterContentController;
use App\Http\Controllers\Admin\Setting\SeoSocialController;
use App\Http\Controllers\Admin\Setting\VideoQualityController;
use App\Http\Controllers\AudioQualityController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\PostCategoryController;

Route::group(['middleware'=>['auth:web','language'],'prefix'=>'nd-admin'],function()
{
      //-------------------------Post--------------------------
      Route::resource('post-category',PostCategoryController::class);
      //------------------------/Post--------------------------
    // ------------------System Setting----------------------
    Route::resource('system-setting',SystemSettingController::class);
    // ------------------System Setting----------------------

    // ------------------Theme Option----------------------
    Route::resource('theme-option',ThemeOptionController::class);
    // ------------------Theme Option----------------------

    // ------------------Android Setting----------------------
    Route::resource('android-setting',AndroidSettingController::class);
    // ------------------Android Setting----------------------

    // ------------------Email Setting----------------------
    Route::resource('email-setting',EmailSettingController::class);
    // ------------------Email Setting----------------------

    // ------------------Logo Setting----------------------
    Route::resource('websitelogo-setting',WesiteLogoController::class);
    // ------------------Logo Setting----------------------

    // ------------------Footer Setting----------------------
    Route::resource('footer-setting',FooterContentController::class);
    // ------------------Footer Setting----------------------

    // ------------------Footer Setting----------------------
    Route::resource('seosocial-setting',SeoSocialController::class);
    // ------------------Footer Setting----------------------

    // ------------------Footer Setting----------------------
    Route::resource('device',DeviceController::class);
    // ------------------Footer Setting----------------------

    // ------------------Currency----------------------
    Route::resource('currency',CurrencyController::class);
    // ------------------Currency----------------------


    // ------------------Footer Setting----------------------
    Route::resource('video-quality',VideoQualityController::class)->except('update');
    Route::patch('video-quality/{videoQuality}', [VideoQualityController::class, 'update'])->name('video-quality.update');
    Route::post('video-quality/set-default/', [VideoQualityController::class, 'setDefault'])->name('video-quality.setDefault');

    Route::resource('audio-quality',AudioQualityController::class)->except('update');
    Route::patch('audio-quality/{audioQuality}', [AudioQualityController::class, 'update'])->name('audio-quality.update');
    Route::post('audio-quality/set-default/', [AudioQualityController::class, 'setDefault'])->name('audio-quality.setDefault');

    
    // ------------------Footer Setting----------------------

  

});