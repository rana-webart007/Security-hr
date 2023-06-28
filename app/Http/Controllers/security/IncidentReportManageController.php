<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use App\Models\{IncidentReport};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

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

    public function pdf_generate(Request $request, $id){
        // retreive all records from db
        $result = IncidentReport::where('incident_id', $id)->first();
        
        $data = [
               'guard_id' => $result->guard_id,
               'location' => $result->location,
               'incident_date' => $result->incident_date,
               'incident_time' => $result->incident_time,
               'incident_category' => $result->incident_category,
               'incident_type' => $result->incident_type,
               'incident_details' => $result->incident_details,
               'incident_img' => $result->incident_img,
        ];

        $request->session()->put('data', $data);
        $pdf = PDF::loadView('security.incident.incident_pdf', $data);
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }
}