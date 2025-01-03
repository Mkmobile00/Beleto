<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable=[
        'event_id',
        'title',
        'description',
        'link',
        'image',
        // 'location',
        'status',
        'event_date_nep',
        'event_date_eng',
        'time',
        'lat',
        'lng',
        'expired_status'
    ];

    protected $casts=[
        'status'=>\App\Enum\EventStatusEnum::class
    ];

    public function passList()
    {
        return $this->hasMany(EventPassVisitor::class,'event_id','id');
    }


}
