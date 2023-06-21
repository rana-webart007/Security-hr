<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table ="subscriptions_plans";
    protected $fillable = ['name', 'details', 'amount', 'max_guards', 'valid_for', 'valid_type', 'extra_charge', 'total_amount', 'stripe_product_id', 'stripe_price_id', 'status'];
}
