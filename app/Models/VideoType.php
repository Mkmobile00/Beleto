<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoType extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description',
        'status',
        'primary_menu',
        'footer_menu'
    ];

    protected $casts=[
        'status'=>\App\Enum\Setting\VideoEnum::class
    ];
}
