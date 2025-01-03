<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Events\HlsVideoPlayerConvertEvent;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;

class FileUploadController extends Controller
{
    public function index()
    {
        return view('upload-file.index');
    }

    public function uploadLargeFiles(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
        if (!$receiver->isUploaded()) {
            return [
                'done' => 'Something Went Wrong !!',
                'status' => false
            ];
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
            $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name

            $disk = Storage::disk(config('filesystems.default'));
            $path = $disk->putFileAs('public/videos', $file, $fileName);

            // delete chunked file
            unlink($file->getPathname());
            // $generateRandomStr=Str::random(10);
            // event(new HlsVideoPlayerConvertEvent($fileName,$generateRandomStr));

            return [
                'path' => asset('storage/videos/' . $fileName),
                'filename' => $fileName,
                'url' => route('movie.index'),
                // 'transcode'=>$generateRandomStr
            ];
        }

        // otherwise return percentage informatoin
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true,
            'tableId' => '111'
        ];
    }

    // public function uploadLargeFiles(Request $request) {
    //     $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
    //     if (!$receiver->isUploaded()) {
    //         return [
    //             'done' => 'Something Went Wrong !!',
    //             'status' => false
    //         ];
    //     }

    //     $fileReceived = $receiver->receive(); // receive file
    //     if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded

    //         $file = $fileReceived->getFile(); // get file
    //         // $extension = $file->getClientOriginalExtension();
    //         // $fileName = str_replace('.'.$extension, '', $file->getClientOriginalName()); //file name without extenstion
    //         // $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name

    //         // $disk = Storage::disk(config('filesystems.default'));
    //         // $path = $disk->putFileAs('public/videos', $file, $fileName);
    //         $originalFilename = $file->getClientOriginalName();
    //         $extension = $file->getClientOriginalExtension();
    //         $fileName = now()->millisecond . '_' . Str::slug(pathinfo($originalFilename, PATHINFO_FILENAME)) . '.' . $extension;
    //         $location = $fileName;
    //         $path = Storage::disk('s3')->put($location, file_get_contents($file));
    //         $path = Storage::disk('s3')->url($location);
    //         return $path;
    //         // delete chunked file
    //         // unlink($file->getPathname());

    //         // return [
    //         //     'path' => asset('storage/videos/'.$fileName),
    //         //     'filename' => $fileName,
    //         //     'url'=>route('movie.index')
    //         // ];
    //     }

    //     // otherwise return percentage informatoin
    //     $handler = $fileReceived->handler();
    //     return [
    //         'done' => $handler->getPercentageDone(),
    //         'status' => true,
    //         'tableId'=>'111'
    //     ];
    // }

    public function uploadLargeFilesSeries(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
        if (!$receiver->isUploaded()) {
            return [
                'done' => 'Something Went Wrong !!',
                'status' => false
            ];
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
            $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name

            $disk = Storage::disk(config('filesystems.default'));
            $path = $disk->putFileAs('public/videos', $file, $fileName);

            // delete chunked file
            unlink($file->getPathname());

            return [
                'path' => asset('storage/videos/' . $fileName),
                'filename' => $fileName,
                'url' => route('tvseries.index')
            ];
        }

        // otherwise return percentage informatoin
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true,
            'tableId' => '111'
        ];
    }

    public function uploadTrailer(Request $request)
    {
        dd($request->all());
    }

    public function uploadTvSeriesEpisodes(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
        if (!$receiver->isUploaded()) {
            return [
                'done' => 'Something Went Wrong !!',
                'status' => false
            ];
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
            $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name

            $disk = Storage::disk(config('filesystems.default'));
            $path = $disk->putFileAs('public/videos', $file, $fileName);
            // delete chunked file
            unlink($file->getPathname());

            return [
                'path' => asset('storage/videos/' . $fileName),
                'filename' => $fileName,
                'url' => route('tvseries.index')
            ];
        }

        // otherwise return percentage informatoin
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true,
            'tableId' => '111'
        ];
    }

    public function uploadWebSeriesSeriesEpisodes(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
        if (!$receiver->isUploaded()) {
            return [
                'done' => 'Something Went Wrong !!',
                'status' => false
            ];
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
            $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name

            $disk = Storage::disk(config('filesystems.default'));
            $path = $disk->putFileAs('public/videos', $file, $fileName);
            // delete chunked file
            unlink($file->getPathname());

            return [
                'path' => asset('storage/videos/' . $fileName),
                'filename' => $fileName,
                'url' => route('webseries.index')
            ];
        }

        // otherwise return percentage informatoin
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true,
            'tableId' => '111'
        ];
    }
}