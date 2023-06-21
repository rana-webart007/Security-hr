<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model
{
    use HasFactory;

    protected $table = "payment_methods";
    protected $fillable = [
        'cust_id',
        'cust_type',
        'cust_stripe_id',
        'card_no',
        'exp_month',
        'exp_year',
        'cvc'
    ];
}
