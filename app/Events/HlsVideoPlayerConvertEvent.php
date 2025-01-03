<?php

namespace App\Events;

use FFMpeg\Format\Video\X264;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Events\TranscodingProgressEvent;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Illuminate\Broadcasting\InteractsWithSockets;
use ProtoneMedia\LaravelFFMpeg\Exporters\HLSExporter;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use ProtoneMedia\LaravelFFMpeg\Exporters\HLSVideoFilters;

class HlsVideoPlayerConvertEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    protected $fileName;
    protected $path;
    public function __construct($fileName,$path)
    {
        $this->fileName=$fileName;
        $this->path=$path.'.m383';
        return $this->transcodeVideo();
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
    public function transcodeVideo(){
        $highFormat=(new X264('aac'))->setKiloBitrate(1280);
        $standardFormat=(new X264('aac'))->setKiloBitrate(720);
        $midFormat=(new X264('aac'))->setKiloBitrate(600);
        $lowFormat=(new X264('aac'))->setKiloBitrate(480);
        
        // return FFMpeg::fromDisk('transcodePath')
        ini_set('max_execution_time', 3600);
        return FFMpeg::fromDisk('transcodePath')
        ->open($this->fileName)
        ->exportForHLS()
        // ->withRotatingEncryptionKey(function ($filename,$contents){
        //     Storage::disk('secrets')->put($filename,$contents);
        // })
        ->addFormat($highFormat,function(HLSVideoFilters $filters){
            $filters->resize(1280,1280);
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

        return $this->path;
    }
    // public function transcodeVideo(){
    //     $lowFormat=(new X264('aac'))->setKiloBitrate(500);
    //     $highFormat=(new X264('aac'))->setKiloBitrate(1000);
    //     // return FFMpeg::fromDisk('transcodePath')
    //     ini_set('max_execution_time', 3600);
    //     return FFMpeg::fromDisk('transcodePath')
    //     ->open($this->fileName)
    //     ->exportForHLS()
    //     // ->withRotatingEncryptionKey(function ($filename,$contents){
    //     //     Storage::disk('secrets')->put($filename,$contents);
    //     // })
    //     ->addFormat($lowFormat,function(HLSVideoFilters $filters){
    //         $filters->resize(1280,720);
    //     })
    //     // ->onProgress(function($progress){
    //     //     // TranscodingProgressEvent::dispatch($progress);
    //     //     // event(new TranscodingProgressEvent($progress));
    //     // })
    //     ->toDisk('public')
    //     ->save("transcode/".$this->path);

    //     return $this->path;
    // }
}
