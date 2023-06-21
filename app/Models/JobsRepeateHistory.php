<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobsRepeateHistory extends Model
{
    use HasFactory;

    protected $table = "job_repeat_history";
    protected $fillable = [
            'security_id',
            'job_id',
            'start_date',
            'end_date',
            'repeat_for'
    ];
}
