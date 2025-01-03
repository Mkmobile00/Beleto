<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvSeriesPart extends Model
{
    use HasFactory;
    protected $fillable=[
        'tvseries_id',
        'title',
        'video_path',
        'status',
        'releasedate',
        'order',
        'poster',
        'slug',
        'summary',
        'description',
        'unique_code',
        'type'
    ];

    public function views(){
        return $this->hasOne(VideoView::class,'video_unique_code','unique_code');
    }
    public function likeDislikes(){
        return $this->hasMany(VideoLike::class,'video_unique_code','unique_code');
    }
}
