<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    protected $table = "messages";
    protected $fillable = [
        'guard_id',
        'security_id',
        'message_id',
        'message',
        'reply',
        'read_status'
    ];
}