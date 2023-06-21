<?php

namespace App\Listeners;

use App\Events\SendRegisterEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use \App\Mail\Usermail;
class NotifyUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendRegisterEmail  $event
     * @return void
     */
    public function handle(SendRegisterEmail $event)
    {
        $admin = \App\Models\Admin::first();
        \Mail::to($event -> registerData['email'])-> send(new Usermail($event -> registerData));     



        //  properly working mail in server


        // sending welcome email to users
        // $details = new Usermail($event -> registerData);
        // $user_name = $details-> registerData['name'];
        // $user_email = $details-> registerData['email'];
        // $user_password = $details-> registerData['password'];
        
        // $body = "<html><body>
        //             <h2><b> Thanks for join with us </b></h2>
        //             <h2> Login details </h2>

        //             <h2> Name : ".$user_name." </h2>
        //             <h2> User email : ".$user_email." </h2>
        //             <h2> Password : ".$user_password." </h2>
        //         </body></html>";
        
        // content-type when sending HTML email
        // $headers = "MIME-Version: 1.0" . "\r\n";
        // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // mail($event -> registerData['email'], 'Create a new account', $body, $headers);
    }
}
