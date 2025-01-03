<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use HasFactory;
    use NodeTrait;
    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'image',
        'status',
        'view_type',
        'is_featured',
        'meta_title',
        'meta_keyword',
        'meta_description'
    ];

    protected $casts=[
        'view_type'=>\App\Enum\Layout\LayoutDesignEnum::class
    ];

    public function getParentCat()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function childCat()
    {
        return $this->hasMany($this, 'parent_id', 'id');
    }

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_categories', 'cat_id', 'movie_id')
        ->select(['title', 'slug', 'poster', 'rating', 'type', 'thumbnail','movies.id'])->where('publication','1')->orderBy('position','ASC');
    }

    public function moviesFront()
    {
        return $this->belongsToMany(Movie::class, 'movie_categories', 'cat_id', 'movie_id')
        ->with('genre')->select(['title', 'slug', 'poster',  'type', 'thumbnail','movies.id','run_time'])->where('publication','1')->orderBy('position','ASC');
    }

    
}