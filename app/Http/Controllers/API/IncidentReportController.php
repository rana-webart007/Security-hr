<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\{IncidentReport};

class IncidentReportController extends Controller
{
    //

    public function incident_report(Request $request){
           // dd(auth()->user()->id);

        $validator = Validator::make($request->all(), [
            'location' => 'required', 
            'incident_date' => 'required|date_format:d-m-Y|before_or_equal:' . date('d-m-Y'),
            'incident_time' => 'required|date_format:H:i:s',
            'incident_category' => 'required',
            'incident_details' => 'required',
        ]);
        if ($validator->fails()) {
            $responseArr['message'] = $validator->messages()->first();;
            return response()->json($responseArr);
        }

        $incident_id = Str::random(15);

        /**
         * Incident Img. upload 
        */

        if($request->has('incident_img')){
            $incidentImg = Str::random(25).'.'.$request->incident_img->extension();
            $request->incident_img->move(public_path('incident/img/'), $incidentImg);
        }else{
            $incidentImg = "";
        }

        $details = IncidentReport::create([
              'guard_id' => auth()->user()->id,
              'security_id' => auth()->user()->security_id,
              'incident_id' => $incident_id,

              'location' => $request->location,
              'incident_date' => $request->incident_date,
              'incident_time' => $request->incident_time,
              'incident_category' => $request->incident_category,
              'incident_type' => $request->incident_type,
              'incident_img' => $incidentImg,

              'reported_by' => $request->reported_by,
              'reported_by_title' => $request->reported_by_title,
              'reported_by_phone' => $request->reported_by_phone,
              'reported_by_email' => $request->reported_by_email,

              'weapons' => $request->weapons,
              'weapon_type' => $request->weapon_type,
              'weapon_type_other' => $request->weapon_type_other,

              'vehicle_type' => $request->vehicle_type,
              'vehicle_year' => $request->vehicle_year,
              'vehicle_model' => $request->vehicle_model,
              'vehicle_color' => $request->vehicle_color,
              'vehicle_license_plate' => $request->vehicle_license_plate,
              'vehicle_notes' => $request->vehicle_notes,

              'police_report_number' => $request->police_report_number,
              'police_agency' => $request->police_agency,
              'police_notified' => $request->police_notified,
              'police_officer_name' => $request->police_officer_name,
              'police_officer_badge_number' => $request->police_officer_badge_number,
              'police_notified_time' => $request->police_notified_time,
              'police_arrival_time' => $request->police_arrival_time,
              'police_phone' => $request->police_phone,

              'incident_details' => $request->incident_details,
              'involved_person_type' => $request->involved_person_type,
              'involved_person_first_name' => $request->involved_person_first_name,
              'involved_person_last_name' => $request->involved_person_last_name,
              'involved_person_emp_id' => $request->involved_person_emp_id,
              'involved_person_phone' => $request->involved_person_phone,
              'involved_person_email' => $request->involved_person_email,
              'involved_person_dob' => $request->involved_person_dob,
              'involved_person_home_address' => $request->involved_person_home_address,
              'involved_person_home_city' => $request->involved_person_home_city,
              'involved_person_home_state' => $request->involved_person_home_state,
              'involved_person_home_zip' => $request->involved_person_home_zip,
              'involved_person_home_country' => $request->involved_person_home_country,
              'involved_person_sex' => $request->involved_person_sex,
              'involved_person_height' => $request->involved_person_height,
              'involved_person_weight' => $request->involved_person_weight,
              'involved_person_clothing' => $request->involved_person_clothing,
              'involved_person_hair_color' => $request->involved_person_hair_color,
              'involved_person_eye_color' => $request->involved_person_eye_color,
              'involved_person_tattoos' => $request->involved_person_tattoos,
              'involved_person_piercings' => $request->involved_person_piercings,
              'involved_person_identification_type' => $request->involved_person_identification_type,
              'involved_person_drivers_license_no' => $request->involved_person_drivers_license_no,
              'involved_person_drivers_license_state' => $request->involved_person_drivers_license_state,

              'individual_sku_number' => $request->individual_sku_number,
              'individual_description' => $request->individual_description,
              'individual_unit_price' => $request->individual_unit_price,
              'individual_quantity' => $request->individual_quantity,
              'individual_item_category' => $request->individual_item_category,
              'individual_recovered' => $request->individual_recovered,
              'individual_damaged' => $request->individual_damaged,
        ]);

        return response()->json(['msg' => "Successfully Saved", 'details' => $details], 200);
    }


    public function incident_details(){
          $all = IncidentReport::where('guard_id', auth()->user()->id)->orderBy('id', 'desc')->get();
          return response()->json(['msg' => "Success", 'details' => $all], 200);
    }

    public function individual_incident_details($incident_id){
            $check = IncidentReport::where('guard_id', auth()->user()->id)->where('incident_id', $incident_id)->first();
            
            if($check == null){
                return response()->json(['msg' => "No Incident Found"], 400);
            }else{
                return response()->json(['msg' => "Success", 'details' => $check], 200);
            }
    }
}