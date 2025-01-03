<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\Auth\RoleController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Admin\LanguageEditController;
use App\Http\Controllers\Admin\Auth\PermissionController;
use App\Http\Controllers\Admin\EventGoogleTrackController;
use App\Http\Controllers\Admin\Auth\ForgetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('nd-admin/forget-password',[ForgetPasswordController::class,'viewPage'])->name('forget.password');
Route::post('nd-admin/forget-password',[ForgetPasswordController::class,'getForgetEmail'])->name('forget.getresetemail');

Route::put('/update/forget-password',[ForgetPasswordController::class,'updateForgetPassword'])->name('updateForgetPassword');



Route::group(['middleware'=>['auth:web','language'],'prefix'=>'nd-admin'],function()
{
    Route::group(['prefix' => 'laravel-filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    Route::get('/getMovieType',[AdminController::class,'getMovieType'])->name('getMovieType');
    Route::get('/getMovieTypeTv',[AdminController::class,'getMovieTypeTv'])->name('getMovieTypeTv');
    Route::get('/getMovieTypeWeb',[AdminController::class,'getMovieTypeWeb'])->name('getMovieTypeWeb');
    Route::get('/getVideoPerformance/{id}/{type}',[AdminController::class,'getVideoPerformance'])->name('getVideoPerformance');
    Route::get('/change-language/{code}', [LanguageController::class, 'changeLanguage'])->name('change.language');
 

    //    ----------------------Address-----------------------------
    Route::post('/districts',[AddressController::class,'districts'])->name('getDistrict');
    Route::post('/locals',[AddressController::class,'locals'])->name('getLocal');
    //    ----------------------/Address-----------------------------

    
    Route::resource('setting',SettingController::class);
    Route::get('view', [LanguageEditController::class, 'Index'])->name('language_english.view');
    Route::post('/language/update', [LanguageEditController::class, 'updateLanguage'])->name('update.english_language');

    //---------------------------/MenuController--------------------------------
    Route::resource('menu',AdminMenuController::class);
    Route::post('updateMenu', [AdminMenuController::class, 'updateMenuOrder'])->name('updateMenuOrder');
    Route::get('menu/link/course', [AdminMenuController::class, 'menuLinkCourse'])->name('menuLinkCourse');
    Route::post('saveMenuCategory', [AdminMenuController::class, 'create_menuCategory'])->name('saveMenuCategory');

    Route::resource('role',RoleController::class);
    Route::resource('permission',PermissionController::class);

    Route::resource('user',UserController::class);
    Route::put('/update-password', [UserController::class, 'updatePassword'])->name('admin.updatePassword');

});
