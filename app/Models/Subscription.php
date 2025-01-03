<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\SubscriptionRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'price',
        'is_suggested',
        'plan_id',
        'period_id',
        'status',
        'currency_type'
    ];
    

    public function plan(){
        return $this->hasOne(Plan::class,'id','plan_id');
    }
    public function period(){
        return $this->hasOne(Period::class,'id','period_id');
    }
    public function currency(){
        return $this->hasOne(Currency::class,'id','currency_type');
    }
}