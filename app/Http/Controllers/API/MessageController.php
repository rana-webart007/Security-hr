<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\{Messages};
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    //

    public function message_add(Request $request){
        $validator = Validator::make($request->all(), [
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = $validator->messages()->first();;
            return response()->json($responseArr);
        }

        $message_id = Str::random(20);

        $details = Messages::create([
            'guard_id' => auth()->user()->id,
            'security_id' => auth()->user()->security_id,
            'message_id' => $message_id,
            'message' => $request->message
        ]);

        return response()->json(['msg' => "Successfully Saved", 'details' => $details], 200);
    }


    public function all_message(){
           $messages = Messages::where('guard_id', auth()->user()->id)->get();
           return response()->json(['msg' => "Success", 'details' => $messages], 200);
    }

    public function individual_message_details($message_id){
            $messages = Messages::where('message_id', $message_id)->get();
            return response()->json(['msg' => "Success", 'details' => $messages], 200);
    }
}