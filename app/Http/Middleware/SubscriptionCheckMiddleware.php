<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\SubscriptionLists;
use Carbon\Carbon;
use App\Models\User;


//////////
use App\Models\Settings;

class SubscriptionCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $segment = $request->segments()[0];

        if ($segment == "security") {
            $user_id = Auth::guard('security')->user()->id;
            $user_type = "security";
        }

        /**
         * check users subscription
         */

        $check_user = SubscriptionLists::where('user_id', $user_id)
            ->where('user_type', $user_type)
            ->first();

        $created_date = $check_user->created_at->format('Y-m-d');
        $today = Carbon::now();

        // $exp_date = $check_user->expire_date;
        // $exp_diff_from_creation = $exp_date->diffInDays($created_date);
        // dd($exp_diff_from_creation);
        

        /**
         * 
         */

         $guards = User::where('security_id', $user_id)->get();
         $max_guards = $check_user->max_guards;
         $total_guards = count($guards);

        /**
         *  find diff between today and first subscribed date
         *  to give 15 days free access
         */

         $date_diff = $today->diffInDays($created_date);
        
        // $date_diff = 17;

        /**
         * free trial days
         */

         $free_trial_days = Settings::where('key', 'security-free-trial-days')->first();
        //  dd($date_diff);

        // Give free access for 15 days
        if ($date_diff < $free_trial_days->value) {

            /**
             * to check whether a client in free trial, subscribed for a plan or not
             *  if, subscribed, free trial message will not shown
            */

            // $exp_date = Carbon::parse($check_user->expire_date);
            // $diff = $exp_date->diffInDays($today);
            


            /**
             * check number of guards added.. 
             *  a user with free trial can add upto 10 guards
             */

            
            if ($user_type == "security") {
                
                $remaining_guards = ($max_guards - $total_guards);
 
                // if 10 guards not added yet
                 if ($remaining_guards > 0) {
                    $request->session()->put('dayLeft', ['days_left' => ($free_trial_days->value - $date_diff), 'guards_left' => $remaining_guards, 'guard_checking_key' => 0]);
                    return $next($request);      
                } else {
                    $request->session()->put('dayLeft', ['days_left' => ($free_trial_days->value - $date_diff), 'guards_left' => $remaining_guards, 'guard_checking_key' => 1]);
                    // $request->session()->put('guard_checking_key', 1);
                    return $next($request);
                }
            }

        }

        /**
         * After 15 days, user have to choose a plan & subscribe to continue access
         */

        else {

            /**
             * check whether subscription expiration date has over or not
             */
            // $exp_date_diff = $today->diffInDays($exp_date);

            $exp_date = explode(" ", $check_user->expire_date)[0];
            $exp_date_diff = $today->diffInDays($exp_date);
            
            $exp_over_or_not = Carbon::parse($exp_date)->isPast();

            if ($exp_over_or_not == false) {
                /**
                 * check maximum guards add.
                 * can process if added guards number is less than according to subs
                */
            
                // $total_guards = 52;
                // $max_guards = 2;

                if($total_guards <= $max_guards){
                    // $request->session()->put('dayLeft', 9999);
                    $request->session()->put('dayLeft', ['days_left' => $exp_date_diff, 'guards_left' => ($max_guards - $total_guards), 'guard_checking_key' => 9999]);
                    return $next($request);
                }
                else{
                    $request->session()->put('dayLeft', ['days_left' => $exp_date_diff, 'guards_left' => ($max_guards - $total_guards), 'guard_checking_key' => 1]);
                    return $next($request);
                }

            } else {
                return redirect()->route('security.subscription.plans');
                //   return response()->view('security.subscription.plans');
            }
            
        }

        return $next($request);
    }
}