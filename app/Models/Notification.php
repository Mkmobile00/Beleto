<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable=[
        'from_model',
        'from_id',
        'to_model',
        'to_id',
        'title',
        'is_read'

    ];
}
