<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\{Notifications};
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    //

    public function notification_add(Request $request){
        $validator = Validator::make($request->all(), [
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = $validator->messages()->first();;
            return response()->json($responseArr);
        }

        $notification_id = Str::random(15);

        $details = Notifications::create([
            'guard_id' => auth()->user()->id,
            'security_id' => auth()->user()->security_id,
            'notification_id' => $notification_id,
            'message' => $request->message,
        ]);

        return response()->json(['msg' => "Successfully Saved", 'details' => $details], 200);
    }


}
