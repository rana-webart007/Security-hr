<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethods;

class PaymentMethodController extends Controller
{
    //

    public function save_pay_method($cust_id, $cust_type, $cust_stripe_id, $card_no, $exp_month, $exp_year, $cvc)
    {
        PaymentMethods::create([
              'cust_id' => $cust_id,
              'cust_type' => $cust_type,
              'cust_stripe_id' => $cust_stripe_id,
              'card_no' => $card_no,
              'exp_month' => $exp_month,
              'exp_year' => $exp_year,
              'cvc' => $cvc,
        ]);

        return true;
    }
}
