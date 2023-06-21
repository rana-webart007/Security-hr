<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{User};
use Auth;

class ReportController extends Controller
{
    //

    public function security_reports()
    {
            $security_id = Auth()->guard('security')->user()->id;
            $users = User::where('security_id', $security_id)->get();
            return view('security.reports.all', compact('security_id', 'users'));
    }

    public function attendance_reports($id)
    {
            // $user = User::where('id', $id)->first();

            $users = DB::table('users')
            ->join('jobschedules', 'users.id', '=', 'jobschedules.user_id')
            ->join('clients', 'jobschedules.client_id', '=', 'clients.id')
            ->select('users.name as user_name', 
                     'jobschedules.date as jd', 
                     'jobschedules.start_time as jst',
                     'jobschedules.end_time as jet', 
                     'jobschedules.leave_time as jlt', 
                     'clients.name as client_name')
            ->where('users.id', $id)
            ->get();

            return view('security.reports.attendance', compact('users'));
    }
}
