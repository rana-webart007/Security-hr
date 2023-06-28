<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Notifications};

class NotificationManageController extends Controller
{
    //

    public function mark__all_as_read(){
        Notifications::where('security_id', auth()->user()->id)->update([
            'read_status' => 1,
        ]);

        return redirect()->back();
    }

    public function view_all_notification(){
        $notifications = Notifications::where('security_id', auth()->user()->id)->where('read_status', 0)->orderBy('id', 'desc')->get();
        return view('security.notification.view_all', compact('notifications'));
    }
}
