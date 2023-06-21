<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\{Client, GuardTrackingHistory, Jobschedule};

class TrackingController extends Controller
{
    public function list(Request $request){
        if($request -> method() == "POST"){

        }else{
            $clients = Client::where('security_id', auth()->guard('security')->user()->id)
                       ->orderBy('id', 'desc')->get();     
            return view("security.tracking_list", ['data' => $clients]);
        }
    }

    public function track(Request $request, $trackingid){
        if($request -> method() == "POST"){

        }else{   
            $data = \App\Models\Jobschedule::where('id', $trackingid)->first();                       
            return view("security.tracking_history", ['client_id' => $data -> client-> id]);
        }
    }

    public function getlocation(Request $request){
        $clientDetails = \App\Models\Client::find($request-> get('client_id'));
        echo $clientDetails -> address_map.','.$clientDetails-> location_data;
    }

     public function view_guards($client_id)
     {
            
         $guards = GuardTrackingHistory::where('security_id', auth()->guard('security')->user()->id)
                   ->where('client_id', $client_id)->select(['guard_id', 'job_id'])->distinct()->get();

         return view('security.tracking.active_guards', compact('guards', 'client_id'));
     }

     public function guards_tracking($client_id, $job_id)
     {
        # code...
        // $tracking_history = GuardTrackingHistory::where('security_id', auth()->guard('security')->user()->id)
        //    ->where('client_id', $client_id)->where('job_id', $job_id)->get();

        return view('security.tracking.guards_tracking', compact('client_id', 'job_id'));
     }


     public function cron_test(Request $request)
     {
        // $tracking_history = GuardTrackingHistory::where('security_id', auth()->guard('security')->user()->id)->get();
        // return view('security.tracking.guards_tracking', compact('tracking_history'));
        
        // $data = $request->job_id;
        // return response()->json($data);

        return redirect()->route('security.view.active.guards.tracking', ['client_id' => $request->client_id, 'job_id' => $request->job_id]);
     }
}