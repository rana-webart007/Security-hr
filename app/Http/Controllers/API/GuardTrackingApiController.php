<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Jobschedule, GuardTrackingHistory};
use Carbon\Carbon;
use Validator;

class GuardTrackingApiController extends Controller
{
    //

    public function tracking_add(Request $request)
    {
        // dd(auth()->user()->id);

        $validator = Validator::make($request->all(), [
            'security_id' => 'required|integer',
            'job_id' => 'required|integer',
            'tracking_date' => 'required|date_format:d-m-Y',
            'tracking_time' => 'required|date_format:H:i:s',
            'guard_coordinate' => 'required'
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = $validator->messages()->first();;
            return response()->json($responseArr);
        }


        $check_job = Jobschedule::where('user_id', auth()->user()->id)
                     ->where('security_id', $request->security_id)
                     ->where('id', $request->job_id)
                     ->first();

        
        /**
         * check job expired or not.. 
        */

        if($check_job != null){
          if($check_job->date->isPast() == "false"){
        
                /**
                 * check attend time
                */

                 if($check_job->attend_time == null){
                          return response() -> json(['msg' => "You have not Clocked In yet."], 401);
                 }else{
                          /**
                           * check leave time 
                          */

                          if($check_job->leave_time != null){
                              return response() -> json(['msg' => "You have already Clocked out."], 401);
                          }else{
                              /**
                               * create new tracking history 
                              */

                              GuardTrackingHistory::create([
                                    'guard_id' => auth()->user()->id,
                                    'security_id' => $request->security_id,
                                    'job_id' => $request->job_id,
                                    'client_id' => $check_job->client_id,
                                    'tracking_id' => "track_".md5(date("d-m-Y").uniqid()),
                                    'tracking_date' => $request->tracking_date,
                                    'tracking_time' => $request->tracking_time,
                                    'guard_coordinate' => $request->guard_coordinate,
                              ]);

                              return response() -> json(['msg' => "Successfully Saved"], 200);
                          }
                 }
                }else{
                    return response() -> json(['msg' => "Sorry! this job is expired"], 400);
                }
        }else{
               return response() -> json(['msg' => "please provide correct Information."], 400);
        }
      
    }


    /**
     * 
    */

    public function tracking_fetch(Request $request, $job_id, $security_id)
    {
            
            $histories = GuardTrackingHistory::where('guard_id', auth()->user()->id)
                         ->where('security_id', $security_id)
                         ->where('job_id', $job_id)
                         ->orderBy('id', 'desc')
                         ->get();

            return response() -> json(['msg' => "success", "history" => $histories], 200);
    }   
}