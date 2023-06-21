<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breakhistory extends Model
{
    use HasFactory;
    protected $fillable = ["jobschedule_id", "start_time", "end_time"];
}
