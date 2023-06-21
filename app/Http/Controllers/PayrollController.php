<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function payroll(Request $request){

        $securityguard = \App\Models\User::where(['security_id'=>\Auth::guard('security') -> id()])->get(['name', 'id', 'mobile', 'email', 'amount'])->toArray();
        foreach($securityguard as $key => $val){            
            $result = \App\Models\Breakhistory::selectRaw("sum(TIMESTAMPDIFF(second, breakhistories.start_time, breakhistories.end_time)) as diff")
                                                 ->join('jobschedules', 'breakhistories.jobschedule_id', '=', 'jobschedules.id')
                                                ->where('jobschedules.user_id', $val['id'])
                                                ->first();  
            $securityguard[$key]['break_time_sec'] = $result -> diff;   
            
            $workinghours = \App\Models\Jobschedule::selectRaw("sum(TIMESTAMPDIFF(second, attend_time, leave_time)) as diff")
                                                    ->where('user_id', $val['id'])
                                                    ->first();
            $securityguard[$key]['working_time_sec'] = $workinghours -> diff;  

        }
       
       return view('security.payroll', ['data' => $securityguard]);
    }


    // print payroll

    public function payroll_print($id)
    {
            $user = \App\Models\User::whereId($id)->first();
            $result = \App\Models\Breakhistory::selectRaw("sum(TIMESTAMPDIFF(second, breakhistories.start_time, breakhistories.end_time)) as diff")
                                                 ->join('jobschedules', 'breakhistories.jobschedule_id', '=', 'jobschedules.id')
                                                ->where('jobschedules.user_id', $id)
                                                ->first();  
            $securityguard['break_time_sec'] = $result -> diff;   
            
            $workinghours = \App\Models\Jobschedule::selectRaw("sum(TIMESTAMPDIFF(second, attend_time, leave_time)) as diff")
                                                    ->where('user_id', $id)
                                                    ->first();
            $securityguard['working_time_sec'] = $workinghours -> diff;  

            return view('security.payroll_details', compact('user', 'securityguard'));
    }
}
