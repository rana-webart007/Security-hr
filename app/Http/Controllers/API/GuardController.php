<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\User;
use Mail;
use Auth;

class GuardController extends Controller
{
    public function login(Request $request){
        if($request -> method() == "POST"){
            $validator = \Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
               
            ]);
            if ($validator->fails()) {
                $responseArr['message'] = $validator->messages()->first();;
                return response()->json($responseArr);
            }
            $data = [
                'email' => $request -> input('email'),
                'password' => $request -> input('password')
            ];
           
            if(auth() -> attempt($data)){
                $token = auth() -> user() -> createToken('Token') -> accessToken;
                return response() -> json(['status' => 1, 'token' => $token, 'user' => \App\Models\User::whereId(\Auth::user() -> id) ->first(['id', 'email', 'name', 'mobile']) ], 200); 
            }else{
                return response() -> json(['status' => 0,'msg' => "Unauthorized"], 401); 
            }
        }else{
            return response() -> json(['status' => 0,'msg' => "Invalid token code"], 401); 
        }           
    }

    public function forgotpassword(Request $request){      
        $mailto = $request -> input('email');
        // dd($mailto); 

        // //testing...
        // $otp = rand(1000, 9999);

        // $to = "rana.saha@webart.technology";
        // $subject = "Forgot Pass OTP";
        // $txt = $otp;
        // //$headers = "From: sankar.webart@gmail.com";

        // if(mail($to,$subject,$txt)){
        //       echo "success";
        // }
        // else{
        //        echo "fail";
        // }




        $otp = rand(1000, 9999);
        $user = \App\Models\User::where(['email' => $mailto]) -> update(['forgot_otp'=> $otp]);
        if($user){
            Mail::send('forgotpassword_email', ['otp' => $otp, 'email' => $mailto], function ($message) use($mailto) {  
                $message->to($mailto)->subject('Request for forgot password');
            });
            return response() -> json(['status' => 1, 'msg' => "OTP has been send to your registered email id."], 200);
        }else{
            return response() -> json(['status' => 0, 'msg' => "Email id not registered"], 400); 
        }        
    }

    public function otp_verification(Request $request, $otp, $email){  
       
        $user = \App\Models\User::where(['email' => $email])->first();
        if($user){
            if($user -> forgot_otp == $otp){
                return response() -> json(['status' => 1, 'msg' => "OTP has been verified."], 200);
            }else{
                return response() -> json(['status' => 0, 'msg' => "You enter a wrong OTP."], 400);
            }
        }else{
            return response() -> json(['status' => 0, 'msg' => "Email id dose not found."], 400);
        }
       
    }

    public function reset_password(Request $request){      
        $validator = \Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|same:confirm_password',
            'confirm_password' => 'required'           
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = $validator->messages()->first();;
            return response()->json($responseArr);
        }

        $user = \App\Models\User::where(['email' => $request -> input('email')])->update(['password' => \Hash::make($request -> input('password'))]);
        if($user){
            return response() -> json(['status' => 1, 'msg' => "Password reset successfully."], 200);
        }else{
            return response() -> json(['status' => 0, 'msg' => "Email id does not found."], 400);
        }
    }

    public function jobschedulebyid(Request $request, $scheduleId){      
        $guard = \App\Models\Jobschedule::select(['clients.name as client_name', 'clients.address', 'clients.address_map', 
        'clients.location_data', 'clients.contact_person', 'clients.phone_no',
        'clients.email', 'jobschedules.date', 'jobschedules.start_time', 'jobschedules.end_time', 'jobschedules.id as schedule_id']) 
        ->join('clients', 'clients.id', '=', 'jobschedules.client_id')
        ->where('jobschedules.id', $scheduleId)
        ->first();    
        return response() -> json(['status'=> 1, 'data' => $guard], 200);
    }

    public function job_scheduler(Request $request, $guardId){
        $today = date("Y-m-d");
        $guard = \App\Models\Jobschedule::select(['clients.name as client_name', 'clients.address', 'clients.address_map', 
                                                   'clients.location_data', 'clients.contact_person', 'clients.phone_no',
                                                   'clients.email', 'jobschedules.date', 'jobschedules.start_time', 'jobschedules.end_time', 'jobschedules.id as schedule_id']) 
                                          ->join('clients', 'clients.id', '=', 'jobschedules.client_id')
                                          ->where('date', '>=', $today)
                                          ->where('user_id', $guardId)
                                          ->get();    
        return response() -> json(['status'=> 1, 'data' => $guard], 200);
    }

    public function attend_job(Request $request){
        $validator = \Validator::make($request->all(), [
            'attend_time' => 'required|date_format:H:i:s',
            'schedule_id' => 'required|exists:jobschedules,id',
            'user_id' => 'required|exists:users,id',         
        ]);

        if ($validator->fails()) {
            $responseArr['message'] = $validator->messages()->first();;
            return response()->json($responseArr);
        }

        $jobshcedule = \App\Models\Jobschedule::find($request -> input('schedule_id'));

        $jobshcedule -> fill([
            'attend_time' => $request -> input('attend_time')
        ]);

        $jobshcedule -> save();

        return response() -> json(['status'=> 1, 'msg' => "Job started"], 200);
    }

    public function leave_job(Request $request){
        $validator = \Validator::make($request->all(), [
            'leave_time' => 'required|date_format:H:i:s',
            'schedule_id' => 'required|exists:jobschedules,id',
            'user_id' => 'required|exists:users,id',                  
        ]);

        if ($validator->fails()) {
            $responseArr['message'] = $validator->messages()->first();;
            return response()->json($responseArr);
        }

        $jobshcedule = \App\Models\Jobschedule::find($request -> input('schedule_id'));

        $jobshcedule -> fill([
            'leave_time' => $request -> input('leave_time')
        ]);

        $jobshcedule -> save();
        return response() -> json(['status'=> 1, 'msg' => "Job ended"], 200);
    }

    public function start_break(Request $request){

        $validator = \Validator::make($request -> all(), [
            'schedule_id' => 'required|exists:jobschedules,id',
            'start_time' => 'required|date_format:H:i:s',
        ]);

        if($validator -> fails()){
            $responseArr['message'] = $validator->messages()->first();;
            return response()->json($responseArr);
        }

        $breakhistory = new \App\Models\Breakhistory([
            'jobschedule_id' => $request -> input('schedule_id'),
            'start_time' => $request -> input('start_time')
        ]);

        $breakhistory -> save();

        return response() -> json(['status'=> 1, 'msg' => "Break started"], 200);
 
    }

    public function end_break(Request $request){
        $validator = \Validator::make($request -> all(), [
            'schedule_id' => 'required|exists:jobschedules,id',
            'end_time' => 'required|date_format:H:i:s',
        ]);

        if($validator -> fails()){
            $responseArr['message'] = $validator->messages()->first();;
            return response()->json($responseArr);
        }

        $breakhistory = \App\Models\Breakhistory::latest()->first();
        
        $breakhistory -> fill([
            'end_time' => $request -> input('end_time')
        ]);

        $breakhistory -> save();

        
        return response() -> json(['status'=> 1, 'msg' => "Break Ended"], 200);
    }

    public function calculatebreak(Request $request, $scheduleId){      
        if($request -> method() == "GET"){
            $result = \App\Models\Breakhistory::selectRaw("sum(TIMESTAMPDIFF(second, breakhistories.start_time, breakhistories.end_time)) as diff")
                                                 ->join('jobschedules', 'breakhistories.jobschedule_id', '=', 'jobschedules.id')
                                                ->where('jobschedules.user_id', $scheduleId)
                                                ->first();
            $workinghours = \App\Models\Jobschedule::selectRaw("sum(TIMESTAMPDIFF(second, attend_time, leave_time)) as diff")
                                                    ->where('user_id', $scheduleId)
                                                    ->first(); 
                      
            $networkingtime = $workinghours['diff'] - $result['diff'];
            $totalWorkingHour = round($networkingtime / 3600);          
            $userDetails = \App\Models\User::find($scheduleId);
            $totalEarning = $totalWorkingHour * $userDetails -> amount;         
            return response() -> json(['status'=> 1, 'data' => ['workinghours' => gmdate('H:i:s', $networkingtime), 'totalearning' => number_format($totalEarning, 2), 'breaktime' => gmdate('H:i:s', $result['diff'])]], 200);
        }
    }




    /**
     * Send job related notification to guards
    */

    public function job_notification(Request $request)
    {
            /**
             * first check, whether job scheduled for that guard for that day or not
             */
            
             // today's date
            $date = date("Y-m-d");

            // checking jobs
            $check_jobs = \App\Models\Jobschedule::where('user_id', auth()->user()->id)
                          ->where('date', $date)->first();
            
            if($check_jobs != null){
                $job_id = $check_jobs->id;

                // checking job locations
                $locations = \App\Models\guardsJobLocations::where('job_id', $job_id)->first();
                if($locations != null){
                    // send location of job scheduled..
                    return response() -> json(['status'=> 1, 'message' => 'success', 
                    'job_id' => $job_id, 'date' => $date, 'job_locations' => $locations->job_locations], 
                    200);
                }else{
                    return response() -> json(['status'=> 0, 'message' => 'No Job Scheduled for you today.'], 
                    200);
                }
            }else{
                return response() -> json(['status'=> 0, 'message' => 'No Job Scheduled for you today.'], 
                200);
            }
            
    }
}