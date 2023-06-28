<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Messages};

class MessageManageController extends Controller
{
    //

    public function mark__all_as_read(){
        Messages::where('security_id', auth()->user()->id)->update([
            'read_status' => 1,
        ]);

        return redirect()->back();
    }

    public function message_details($id) {
            $message = Messages::where('message_id', $id)->first();
            return view('security.message.details', compact('message'));
    }

    public function message_reply(Request $request, $id) {
            $request->validate([
                'reply' => 'required',
            ]);

            Messages::where('message_id', $id)->update([
                  'reply' => $request->reply,
            ]);

            return redirect()->back()->with('success', 'Replied Successfully');
    }

    public function view_all_message(){
            $messages = Messages::where('read_status', 0)->get();
            return view('security.message.view_all', compact('messages'));
    }

    public function delete_message($id) {
        Messages::find($id)->delete();
        return redirect()->back();
    }
}
