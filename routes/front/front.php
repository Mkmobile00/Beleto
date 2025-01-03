<?php

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Admin\CustomerController;
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/kantipur/details_page/{slug}/{type}', [FrontendController::class, 'movieDetailsPage'])->name('movieDetailsPage');
Route::get('/kantipur/stremmingsoon/{slug}', [FrontendController::class, 'stremmingsoon'])->name('stremmingsoon');
Route::get('/kantipur/movie-details/{slug}/{type}', [FrontendController::class, 'movieDetails'])->name('movieDetails');
Route::get('/kantipur/stremmingsoon/details/{slug}', [FrontendController::class, 'movieDetailsStremmingSoon'])->name('movieDetailsStremmingSoon');
Route::get('/kantipur/{series}/{episode}/{type}', [FrontendController::class, 'episodeDetails'])->name('episodesDetails');
Route::get('/kantipur/category/details/{slug}/{type}', [FrontendController::class, 'categoryDetails'])->name('category.details');
Route::get('/kantipur/hotnew-details', [FrontendController::class, 'hotNewDetails'])->name('hotnewdetails');
Route::get('/kantipur/collection/{slug}/{type}/data', [FrontendController::class, 'collectionDetails'])->name('collectiondetails');
Route::get('/kantipur/cast/{slug}', [FrontendController::class, 'castDetails'])->name('castDetails');
Route::get('/kantipur/genre/{slug}', [FrontendController::class, 'genreDetails'])->name('genreDetails');
Route::get('/kantipur/language/{slug}', [FrontendController::class, 'languageDetails'])->name('languageDetails');
Route::get('/kantipur/subscription', [FrontendController::class, 'subscription'])->name('customer.subscription');
Route::post('/kantipur/fetch-currency-price', [FrontendController::class, 'fetCurrencyPriceFront'])->name('fetch-currency-price');
Route::get('/kantipur/page_details/{slug}', [FrontendController::class, 'pageDetails'])->name('page.details');
Route::get('/kantipur/search',[FrontendController::class,'searchItem'])->name('customer.search');
Route::get('/kantipur/privacy-policy', function () {
    $data = Menu::first();
    return view('frontend.test', compact('data'));
});

Route::get('/test', function () {
    return view('test');
});

Route::post('/upload', [FrontendController::class, 'upload']);

Route::get('/downloadInvoice/{invoiceNum}',[CustomerController::class,'downloadInvoice'])->name('downloadInvoice');
