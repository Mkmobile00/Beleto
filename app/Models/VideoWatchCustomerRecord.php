<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoWatchCustomerRecord extends Model
{
    use HasFactory;
    protected $fillable=[
        'video_views_id',
        'customer_id'
    ];

    public function viewVideo(){
        return $this->hasOne(VideoView::class,'id','video_views_id');
    }
}
