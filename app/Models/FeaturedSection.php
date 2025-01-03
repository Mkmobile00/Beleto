<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedSection extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'slug',
        'status',
        'type',
        'image',
        'view_type',
        'meta_keywords',
        'meta_Description',
        'meta_title',
        'position'
    ];

    protected $casts=[
        'status'=>\App\Enum\Setting\VideoEnum::class,
        'type'=>\App\Enum\FeaturedSection\FeaturedSectionTypeEnum::class,
        'view_type'=>\App\Enum\Layout\LayoutDesignEnum::class
    ];
  
    public function items(){
        return $this->hasMany(FeaturedItem::class,'featured_id','id')->orderBy('position','ASC');
    }
}
