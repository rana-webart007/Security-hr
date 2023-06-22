<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use App\Models\{IncidentReport};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncidentReportManageController extends Controller
{
    //

    public function incident_reports(){
           $data = IncidentReport::where('security_id', Auth::guard('security')->user()->id)->get();
           return view('security.incident.page', compact('data'));
    }

    public function incident_reports_details($id) {
            $data = IncidentReport::where('incident_id', $id)->first();
            return view('security.incident.details', compact('data'));
    }
}