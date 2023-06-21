<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionLists extends Model
{
    use HasFactory;

    protected $table="subscription_lists";
    protected $fillable = [
        'subscription_id',
        'user_id',
        'user_type',
        'subscription_amt',
        'max_guards',
        'subscription_date',
        'expire_date',
        'status'
    ];
}
