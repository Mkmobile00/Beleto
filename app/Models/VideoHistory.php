<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoHistory extends Model
{
    use HasFactory;
    protected $fillable=[
        'customer_id',
        'type',
        'duration',
        'videoCode'
    ];

    protected $casts=[
        'type'=>\App\Enum\Customer\MovieTypeEnum::class
    ];
}
