<?php

namespace App\Events;

use App\Models\Movie;
use Illuminate\Support\Str;
use FFMpeg\Format\Video\X264;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Events\TranscodingProgressEvent;
use App\Models\WebSeries;
use App\Models\WebSeriesPart;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Illuminate\Broadcasting\InteractsWithSockets;
use ProtoneMedia\LaravelFFMpeg\Exporters\HLSExporter;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use ProtoneMedia\LaravelFFMpeg\Exporters\HLSVideoFilters;

class TestTranscodeEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    protected $fileName;
    protected $path;
    protected $sliderData;
    public function __construct()
    {
        // dd('ok sumit');
        $slider=Movie::findOrFail(41);
        $filePath=$slider->movie_path;
        $fileName=explode(env('VIDEO_PATH'),$filePath)[1];
        // dd($slider);
        $path=Str::random(20);
        $this->fileName=$fileName;
        $this->path=$slider->unique_code.'.m383';
        $this->transcodeVideo();
        $slider->transcode=$slider->unique_code;
        $slider->transcodeStatus='true';
        $slider->save();
        dd('success');
    }
// -----------------------movie----------------------
//     $slider=Movie::findOrFail(13);
//     $filePath=$slider->movie_path;
//     $fileName=explode(env('VIDEO_PATH'),$filePath)[1];
//     // dd($slider);
//     $path=Str::random(20);
//     $this->fileName=$fileName;
//     // dd($this->fileName);
//     $this->path=$slider->unique_code.'.m383';
//     $this->transcodeVideo();
//     $slider->transcode=$slider->unique_code;
//     $slider->transcodeStatus='true';
//     $slider->save();
//     dd('success');
//     -----------------------/movie----------------------
    public function transcodeVideo(){
        // $highFormat=(new X264('aac'))->setKiloBitrate(1280);
        // $standardFormat=(new X264('aac'))->setKiloBitrate(720);
        $midFormat=(new X264('aac'))->setKiloBitrate(600);
        // $lowFormat=(new X264('aac'))->setKiloBitrate(480);
        
        // return FFMpeg::fromDisk('transcodePath')
        ini_set('max_execution_time', 36000000000);
        return FFMpeg::fromDisk('transcodePath')
        ->open($this->fileName)
        ->exportForHLS()
        // ->withRotatingEncryptionKey(function ($filename,$contents){
        //     Storage::disk('secrets')->put($filename,$contents);
        // })
        ->addFormat($midFormat,function(HLSVideoFilters $filters){
            $filters->resize(600,600);
        })
        // ->addFormat($standardFormat,function(HLSVideoFilters $filters){
        //     $filters->resize(1280,720);
        // })
        // ->addFormat($midFormat,function(HLSVideoFilters $filters){
        //     $filters->resize(1280, 600);
        // })
        // ->addFormat($lowFormat,function(HLSVideoFilters $filters){
        //     $filters->resize(1280, 480);
        // })
        // ->onProgress(function($progress){
        //     event(new TranscodingProgressEvent($progress));
        // })
        ->toDisk('public')
        ->save("transcode/".$this->path);

        // return $this->path;
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
