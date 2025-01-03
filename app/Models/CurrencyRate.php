<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CurrencyRate extends Model
{
    use HasFactory;
    protected $guarded = [];

    function scopeSearch($query, $term){
        $term="%$term%";
        $query->where(function($query) use ($term){
            $query->where('name','like', $term)
                  ->orwhere("code",'like', $term);
        });
    }


    public function getRules($act='add',$id=null){
        $rules= [
            'name'=>'required|string|max:50',
            'symbol'=>'nullable|max:4',
            'code'=>'required|max:10',
            'rate'=>'required|numeric',
            'is_active'=>'required|in:1,0',
            'is_default'=>'required|in:1,0',
        ];
        return $rules;
    }

    public function exchange():HasMany
    {
        return $this->hasMany(CurrencyExchange::class, 'currency_id');
    }
}
