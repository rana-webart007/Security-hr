<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobschedule extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'user_id', 'security_id', 'date', 'start_time', 'end_time', 'attend_time', 'leave_time', 'status', 'comments'];
    protected $dates = ['date'];

    public function client(){
        return $this -> belongsTo(\App\Models\Client::class);
    }

    public function user(){    
        return $this -> belongsTo(\App\Models\User::class);
    }

    public function security(){    
        return $this -> belongsTo(\App\Models\Security::class);
    }
}
