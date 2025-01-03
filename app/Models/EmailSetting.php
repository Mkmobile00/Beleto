<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSetting extends Model
{
    use HasFactory;
    protected $fillable=[
        'contact_email',
        'mail_type',
        'smtp_server_address',
        'smtp_username',
        'smtp_password',
        'smtp_port',
        'smtp_crypto'
    ];
}
