<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'slug',
        'premium_content',
        'device',
        'screensize',
        'video_quality',
        'audio_quality',
        'livetv',
        'addfree',
        'download',
        'status'
    ];

    public function device(){
        $device=Device::whereIn('id',json_decode($this->device))->get()->pluck('title')->toArray();
        $item='';
        if($device && count($device) > 0){
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
        if($device && count($device) > 0){
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
        if($device && count($device) > 0){
            foreach($device as $key=>$data){
                $item.=$data;
                if($key < (count($device)-1)){
                    $item.=',';
                }
            }
        }
        return $item;
    }

    public function subscription(){
        return $this->hasMany(Subscription::class,'plan_id','id')->where('status','active');
    }
    
}
