<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable = [
        'province',
        'np_name',
    ];

    public function getLocals()
    {
        return $this->hasMany(Local::class,'dist_id','dist_id');
    }
}
