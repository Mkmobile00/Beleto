<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecomendedSearch extends Model
{
    use HasFactory;
    protected $fillable=[
        'key',
        'search_date'
    ];
}
