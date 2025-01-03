<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDefaultCurrency extends Model
{
    use HasFactory;
    protected $fillable=[
        'customer_id',
        'currency_id'
    ];

    public function currency(){
        return $this->hasOne(CurrencyRate::class,'id','currency_id');
    }
}
