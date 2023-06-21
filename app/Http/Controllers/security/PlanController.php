<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe;
use Session;
use App\Models\SubscriptionLists;
use Carbon\Carbon;
use Auth;
use App\Http\Controllers\security\SubscriptionManageController;


//
use App\Models\Subscription;

class PlanController extends Controller
{
    //

    public function index()
    { 
        $subscriptions = Subscription::all();
        return view("security.subscription.plans", compact('subscriptions'));
    }  

    public function subscription(Request $request)
    {
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $amount = $request->amount;
        $max_guards = $request->guards;
        $currency = $request->currency;
        $price_id = $request->price_id;


        $interval = $request->valid_for;
        $interval_type = $request->valid_type;


        $cust_id = SubscriptionLists::where('user_id', Auth::guard('security')->user()->id)
                   ->where('user_type', 'security')
                   ->first();


        /**
         * 
        */

        // create a new Stripe subscription
        $subscription = Stripe\Subscription::create([
            'customer' => $cust_id->subscription_id,
            'items' => [['price' => $price_id]],
        ]);

        if($subscription){
                 $status = "success";
            }
        else{
                $status = "failed";
        }

         /*
         * Save into DB
         */
        
         $subs = app(SubscriptionManageController::class);
         $subs->subscriptionEdit(Auth::guard('security')->user()->id, 'security', $amount, $max_guards, $status, $interval, $interval_type);
   
        Session::flash('success', 'Payment Successfull!');   
        return back();
  
    }

}