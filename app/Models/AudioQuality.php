<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioQuality extends Model
{
    use HasFactory;
    protected $fillable=[
        'quality',
        'description',
        'status',
        'default'
    ];

    protected $casts=[
        'status'=>\App\Enum\Setting\VideoEnum::class
    ];
}
