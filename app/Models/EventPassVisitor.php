<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPassVisitor extends Model
{
    use HasFactory;
    protected $fillable=[
        'event_id',
        'visitor_id',
        'pass_type',
        'status',
        'lat',
        'lng',
        'pass_limit',
        // 'entry_time',
        // 'exit_time'
    ];

    protected $casts=[
        'status'=>\App\Enum\EventPass\EventPassStatus::class,
        'pass_limit'=>\App\Enum\EventPass\EventPassLimit::class,
    ];

    public function visitor()
    {
        return $this->hasOne(Visitor::class,'id','visitor_id');
    }
}
