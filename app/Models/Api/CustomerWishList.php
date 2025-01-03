<?php

namespace App\Models\Api;

use App\Models\Movie;
use App\Models\TvSeries;
use App\Models\WebSeries;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerWishList extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'movie_id',
        'video_type'
    ];

    protected $casts = [
        'movie_type' => \App\Enum\Customer\MovieTypeEnum::class
    ];

    public function movie()
    {
        return $this->hasOne(Movie::class, 'id', 'movie_id');
    }

    public function tvSeries()
    {
        return $this->hasOne(TvSeries::class, 'id', 'movie_id');
    }

    public function webSeries()
    {
        return $this->hasOne(WebSeries::class, 'id', 'movie_id');
    }
}