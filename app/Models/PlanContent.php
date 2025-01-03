<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanContent extends Model
{
    use HasFactory;
    protected $fillable=[
        'content',
        'categoryitem',
        'device',
        'size',
        'video_quality',
        'audio_quality',
        'livetv',
        'addfree',
        'download'
    ];

    public function premiumContent(){
        $premiumContent=Category::whereIn('id',json_decode($this->content))->get()->pluck('title')->toArray();
        $item='';
        if($premiumContent){
            foreach($premiumContent as $key=>$data){
                $item.=$data;
                if($key < (count($premiumContent)-1)){
                    $item.=',';
                }
            }
        }
        return $item;
    }

    public function device(){
        $device=Device::whereIn('id',json_decode($this->device))->get()->pluck('title')->toArray();
        $item='';
        if($device){
            foreach($device as $key=>$data){
                $item.=$data;
                if($key < (count($device)-1)){
                    $item.=',';
                }
            }
        }
        return $item;
    }

    public function videoQuality(){
        $device=VideoQuality::whereIn('id',json_decode($this->video_quality))->get()->pluck('quality')->toArray();
        $item='';
        if($device){
            foreach($device as $key=>$data){
                $item.=$data;
                if($key < (count($device)-1)){
                    $item.=',';
                }
            }
        }
        return $item;
    }

    public function audioQuality(){
        $device=AudioQuality::whereIn('id',json_decode($this->audio_quality))->get()->pluck('quality')->toArray();
        $item='';
        if($device){
            foreach($device as $key=>$data){
                $item.=$data;
                if($key < (count($device)-1)){
                    $item.=',';
                }
            }
        }
        return $item;
    }
}
