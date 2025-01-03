<?php

namespace App\Models;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $fillable=[
        'customer_id',
        'video_unique_code',
        'parent_id',
        'comments',
        'status',
        'type'
    ];

    protected $casts=[
        'status'=>\App\Enum\Setting\VideoEnum::class,
        'type'=>\App\Enum\Customer\MovieTypeEnum::class
    ];

    public function commentReplies(){
        return $this->hasMany($this, 'parent_id', 'id');
    }

    public function customer(){
        return $this->hasOne(Customer::class,'id','customer_id');
    }
}
