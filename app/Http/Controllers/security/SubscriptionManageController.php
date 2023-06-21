<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe;
use Session;
use Exception;
use App\Models\Security;
use App\Models\SubscriptionLists;
use Carbon\Carbon;


class SubscriptionManageController extends Controller
{
    //
 
    public function subscriptionAdd($cust_id, $user_id, $amount, $max_guard, $user_type)
    {
         $currentDateTime = Carbon::now();
         $newDateTime = Carbon::now()->addDays(15);

        SubscriptionLists::create([
                'subscription_id' => $cust_id,
                'user_id' => $user_id, 
                'user_type' => $user_type,
                'subscription_amt' => $amount,
                'max_guards' => $max_guard,
                'subscription_date' => date("d-m-Y"),
                'expire_date' => $newDateTime,
                'status' => 'trial',
        ]);

        return true;
    }

    /**
     * subscriptio edit
     */

    public function subscriptionEdit($user_id, $user_type, $amount, $max_guards, $status, $interval, $interval_type)
    {
            $currentDateTime = Carbon::now();

            if($interval_type == "Month"){
               $newDateTime = Carbon::now()->addMonths($interval);
            }else{
                $newDateTime = Carbon::now()->addYears($interval);
            }

            SubscriptionLists::where('user_id', $user_id)->where('user_type', $user_type)->update([
                'subscription_amt' => $amount,
                'max_guards' => $max_guards,
                'subscription_date' => date("d-m-Y"),
                'expire_date' => $newDateTime,
                'status' => $status,
            ]);

            return true;
    }
}
