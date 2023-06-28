<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\{Notifications, Messages};

class Securityheader extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $notifications = Notifications::where('security_id', auth()->user()->id)->where('read_status', 0)->orderBy('id', 'desc')->take(6)->get();
        $notifications_no = count(Notifications::where('security_id', auth()->user()->id)->where('read_status', 0)->get());

        $messages = Messages::where('security_id', auth()->user()->id)->where('read_status', 0)->orderBy('id', 'desc')->take(6)->get();
        $message_no = count(Messages::where('security_id', auth()->user()->id)->where('read_status', 0)->get());
        return view('components.securityheader', compact('notifications', 'notifications_no', 'messages', 'message_no'));
    }
}
