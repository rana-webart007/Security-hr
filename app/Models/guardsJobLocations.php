<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guardsJobLocations extends Model
{
    use HasFactory;

    protected $table = "guards_job_locations";
    protected $fillable = [
        'job_id',
        'user_id',
        'job_address_id',
        'job_locations',
    ];
}
