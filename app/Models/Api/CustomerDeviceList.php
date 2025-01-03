<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CustomerDeviceList extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'customer_id',
        'device_type',
        'device_name',
        'device_serial_num',
        'added_date',
        'main',
        'deleted_at'
    ];
    protected $casts=[
        'device_type'=>\App\Enum\Device\DeviceEnum::class
    ];
}
