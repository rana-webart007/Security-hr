<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuardTrackingHistory extends Model
{
    use HasFactory;

    protected $table = "guard_tracking_histories";
    protected $fillable = [
        'guard_id', 
        'security_id',
        'job_id',
        'client_id',
        'tracking_id',
        'tracking_date',
        'tracking_time',
        'guard_coordinate'
    ];
}
