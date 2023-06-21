<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Jobschedule, JobsRepeateHistory};
use Carbon\Carbon;
use Auth;

class JobRepetationController extends Controller
{
    //

    public function repeat_job($id, $extension)
    {
           $today = date("Y-m-d");

           $extendedDays = Carbon::now()->addDays($extension);
           
           /**
            * change jobschedule date 
           */

           Jobschedule::whereId($id)->update([
                 'date' => $extendedDays,
           ]);

           /**
            * job repeat history..  
           */

           JobsRepeateHistory::create([
               'security_id' => Auth::guard('security')->user()->id,
               'job_id' => $id,
               'start_date' => $today,
               'end_date' => $extendedDays,
               'repeat_for' => $extension." Days",
           ]);

           // return response()->json(['status'=> 'ok']);

           return redirect()->back();
    }

    /**
     * Repetation History 
    */

    public function repetation_history($client, $security, $job_id)
    {
            $security_id = Auth::guard('security')->user()->id;
            $history = JobsRepeateHistory::where('security_id', $security_id)->where('job_id', $job_id)->get();
            return view('security.jobs.repetation_history', compact('history', 'client', 'security'));
    }
}
