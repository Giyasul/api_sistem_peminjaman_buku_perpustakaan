<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAktivitasModel extends Model
{
    protected $table = 'log_aktivitas';

    protected $fillable = ['user_email', 'action', 'resource', 'description', 'ip_address'];
}
