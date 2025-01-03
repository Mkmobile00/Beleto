<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'value',
        'status'
    ];
    protected $casts=[
        'status'=>\App\Enum\Setting\VideoEnum::class
    ];
}
