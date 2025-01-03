<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteLogo extends Model
{
    use HasFactory;
    protected $fillable=[
        'website_logo',
        'website_favicon',
    ];
}
