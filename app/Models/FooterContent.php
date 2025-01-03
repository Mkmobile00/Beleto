<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterContent extends Model
{
    use HasFactory;
    protected $fillable=[
        'footer_title1',
        'footer_content1',
        'footer_title2',
        'footer_content2',
        'footer_title3',
        'footer_content3',
        'copyright'
    ];
}
