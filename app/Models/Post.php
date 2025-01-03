<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'slug',
        'content',
        'thumbnail',
        'is_file',
        'status',
        'meta_title',
        'meta_keyword',
        'meta_description',
    ];

    public function postCategory(){
        return $this->belongsToMany('App\Models\PostCategory','post_cat_items','post_id','post_cat_id');
    }
    public function postCatItem(){
        return $this->hasMany(PostCatItem::class,'post_id','id');
    }
    protected $casts=[
        'status'=>\App\Enum\Post\PostEnum::class
    ];
}
