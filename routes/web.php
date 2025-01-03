<?php

use Illuminate\Http\Request;
use App\Models\CustomerDetail;
use App\Imports\CustomerImport;
use App\Models\Customer\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Enum\Customer\CustomerStatusEnum;
use Illuminate\Support\Facades\Validator;
use App\Events\HlsVideoPlayerConvertEvent;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\FileUploadController;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Jenssegers\Agent\Agent;
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



Route::get('file-upload', [FileUploadController::class, 'index'])->name('files.index');
Route::post('file-upload/upload-large-files', [FileUploadController::class, 'uploadLargeFiles'])->name('files.upload.large');
Route::post('file-upload/series/upload-large-files', [FileUploadController::class, 'uploadLargeFilesSeries'])->name('files.upload.series');
Route::post('uploadtrailer', [FileUploadController::class, 'uploadTrailer'])->name('uploadtrailer');
Route::post('file-upload/series/episodes/upload-large-files', [FileUploadController::class, 'uploadTvSeriesEpisodes'])->name('files.upload.seriesepisodes');
Route::post('file-upload/series/webepisodes/upload-large-files', [FileUploadController::class, 'uploadWebSeriesSeriesEpisodes'])->name('files.upload.webseriesepisodes');



// Route::get('/sumit', function () {

//     // ----------------------Migrate--------------------------
//     defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));

//     // Replace 'database/migrations/2022_06_15_110318_create_featured_sections_table.php' with your migration path
//     $migrationPath = 'database/migrations/2024_01_21_152236_add_photo_column_table_users.php';

//     // Run the migrate:refresh command
//     Artisan::call('migrate:refresh', [
//         '--path'  => $migrationPath,
//         '--force' => true,
//     ]);
//     // Get the command output
//     $output = Artisan::output();

//     return response()->json(['success' => true, 'message' => $output]);

//     // Artisan::call('db:seed', ['--class' => 'PermissionSeeder']);
//     // dd('o');
//     // Artisan::call('storage:link');
//     //         return 'Storage link created successfully.';
//     // return view('welcome');
// })->name('index');

// Route::get('detailpage', [HomeController::class, 'detailpage'])->name('detailpage');
Route::get('see_terms_use', [HomeController::class, 'seeterms'])->name('see_terms_use');
// Route::get('aboutus', [HomeController::class, 'aboutus'])->name('aboutus');
// Route::get('privacy_policy', [HomeController::class, 'privacy_policy'])->name('privacy_policy');
// Route::get('help_center', [HomeController::class, 'help_center'])->name('help_center');


Route::get('/event', function () {
    // event(new HlsVideoPlayerConvertEvent());
});
Route::get('/video/playlist/{playlist}', function ($playlist) {
    return FFMpeg::dynamicHLSPlaylist()
        ->fromDisk('public')
        ->open("transcode/{$playlist}")
        // ->setKeyUrlResolver(function ($key) {
        //     return route('video.key',[$key]);
        // })
        ->setPlaylistUrlResolver(function ($playlist) {
            return route('video.playlist', $playlist);
        })
        ->setMediaUrlResolver(function ($media) {
            return Storage::disk('public')->url("transcode/{$media}");
        });
})->name('video.playlist');

Route::get('/video/key/{$key}', function ($key) {
    return Storage::disk('secrets')->download($key);
})->name('video.key');

Route::get('/watch-video', function () {
    return view('testvideo');
});

Route::get('/kantipur_cinemas_live',function(){
    $agent = new Agent();
    if($agent->is('Windows')){
        return redirect('https://kantipurcinemas.com/');
    }elseif($agent->is('iPhone'))
    {
        return redirect('https://apps.apple.com/ph/app/kantipur-cinemas-ott/id6478458781');
    }
    elseif($agent->isAndroidOS()){
        return redirect('https://play.google.com/store/apps/details?id=com.kctech.kantipurcinemas');
    }elseif($agent->is('OS X')){
        return redirect('https://play.google.com/store/apps/details?id=com.kctech.kantipurcinemas');
    }
    else{
        return redirect('https://kantipurcinemas.com/');
    }
});



