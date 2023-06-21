<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class TotalGuardCheckingMiddleware
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
        $guards_key = $request->session()->get('dayLeft');

        /**
         *  $guards_key = 1 for new subscription
        */
        
                if($guards_key['guard_checking_key'] == 1){
                    return response()->view('security.subscription.guard_expired');
                }
                else{
                    return $next($request);
                }
        
    }
}