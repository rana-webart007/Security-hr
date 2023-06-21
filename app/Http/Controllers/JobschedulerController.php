<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobschedulerController extends Controller
{
    
    public function securityjob(Request $request){
        if($request -> method() == "POST"){

        }else{
            return view("security.job_list", ['data' => \App\Models\Jobschedule::where(['security_id' => \Auth::guard('security')->id()])->get()]);
        }
    }

    public function securityjobadd(Request $request){
        if($request -> method() == "POST"){
           
            $request -> validate([
                'client_id' => 'required|exists:clients,id',
                'user_id' => 'required|exists:users,id',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time'
            ]);

            $schedule = \App\Models\Jobschedule::create([
                'client_id' => $request -> input('client_id'),
                'security_id' => \Auth::guard('security') -> id(),
                'user_id' => $request -> input('user_id'),
                'start_time' => $request -> input('start_time'),
                'end_time' => $request -> input('end_time'),
                'date' => date("Y-m-d", time()),
                'status' => '1',
                'comments' => $request -> input('comments')?$request -> input('comments'):""
            ]);

            // dd($schedule->id);

            // for job locations ..
            $locations = \App\Models\guardsJobLocations::create([
                   'job_id' => $schedule->id,
                   'user_id' => $request -> input('user_id'),
                   'job_address_id' => $request->selected_address,
                   'job_locations' => $request->location_data,
            ]);
            //

            if($schedule -> save()){
                return \Redirect::route('security.job.list')->with('success', "Data has been added successfully.");
            }else{
                return \Redirect::route('security.job.add')->with('errmsg', "Error!! Please try agian.");
            }
        }else{
            $client = \App\Models\Client::where('security_id', \Auth::guard('security')->id())->get();
            $guard = \App\Models\User::where('security_id', \Auth::guard('security')->id())->get();
            return view("security.add_job", ['client' => $client, 'guard' => $guard]);
        }
    }

    public function securityjobupdate(Request $request, $updateid=''){

        if($request -> method() == "POST"){
            $request -> validate([
                'client_id' => 'required|exists:clients,id',
                'user_id' => 'required|exists:users,id',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time'
            ]);

            $schedule = \App\Models\Jobschedule::find($request -> input('updateid'));
            $schedule->fill([
                'client_id' => $request -> input('client_id'),
                'user_id' => $request -> input('user_id'),
                'start_time' => $request -> input('start_time'),
                'end_time' => $request -> input('end_time'),
                'comments' => $request -> input('comments')?$request -> input('comments'):''
            ]);

            // for job locations
            /**
             * check job location present or not, if not present cretae one else update the existing one
            */

            $check_location = \App\Models\guardsJobLocations::where('job_id', $request->input('updateid'))->where('user_id', $request->input('user_id'))->first();
            if($check_location == null){
                    \App\Models\guardsJobLocations::create([
                           'job_id' => $request->input('updateid'),
                           'user_id' => $request->input('user_id'),
                           'job_locations' => $request->location_data,
                    ]);
            }else{
                $check_location->update([
                          'job_locations' => $request->location_data,
                ]);
            }
            // 

            if($schedule -> save()){
                return \Redirect::route('security.job.list')->with('success', "Data has been updated successfully.");
            }else{
                return \Redirect::route('security.job.update', ['updateid', $request -> input('updateid')])->with('errmsg', "Error!! Please try agian.");
            }


        }else{
            
            $data = \App\Models\Jobschedule::where('id', $updateid) ->where('security_id', \Auth::guard('security')->id())-> first();
            if($data){
                // $client = \App\Models\Client::where('security_id', \Auth::guard('security')->id())->get();
                // $guard = \App\Models\User::where('security_id', \Auth::guard('security')->id())->get();

                $client = \App\Models\Client::where('id', $data->client_id)->first();
                
                $guard = \App\Models\User::whereId($data->user_id)->first();

                //
                     // check job locations
                      $check_locations = \App\Models\guardsJobLocations::where('job_id', $updateid)->first();
                    //   dd($check_locations);

                      if($check_locations == null){
                             $location = "";
                             $job_address = "";
                      }else{
                             $location = $check_locations->job_locations;
                             $job_address = $check_locations->job_address_id;

                             

                             /**
                              *   To get separate coordinates from location string 
                             */

                             // Explode the string into an array
                                // $array[] = explode(",", $location);
                                
                                // // Check if the array has at least 3 elements (2 commas)
                                // // Explode the string into an array
                                // $new_str = [];
                                // // dd($array);

                                // for($i=0; $i<(count($array)/2); $i+=2){
                                //     // dd($array);
                                //      array_push($new_str, $array[0][$i]);
                                //      array_push($new_str, $array[0][$i+1]); 
                                // }

                                // dd($new_str);


                      }

                    //   dd("location");
                //

                return view("security.update_job", ['data' => $data, 'client' => $client, 'guard' => $guard, 'location' => $location, 'job_address' => $job_address]);
            }else{
                return \Redirect::route('security.job.list');
            }
       
        }
    }

    public function securityjobdelete(Request $request, $deleteid){
        if($request -> method() == "GET"){
            $data = \App\Models\Jobschedule::find($deleteid);
            if($data -> security_id == \Auth::guard('security')->id()){
                $data-> delete();
                return \Redirect::route('security.job.list')->with('success', "Data has been deleted successfully.");
            }else{
                return \Redirect::route('security.job.list')->with('errmsg', "Unauthorized access.");
            }

        }else{
            return \Redirect::route('security.job.list');
        }
    }

    public function adminjobschedule(Request $request){
        if($request -> method() == "POST"){

        }else{
            return view("admin.job_list", ['data' => \App\Models\Jobschedule::get()]);
        }
    }

    public function adminjobscheduleupdate(Request $request){
        if($request -> method() == "POST"){
            $request -> validate([
                'client_id' => 'required|exists:clients,id',
                'user_id' => 'required|exists:users,id',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time'
            ]);

            $schedule = \App\Models\Jobschedule::find($request -> input('updateid'));
            $schedule->fill([
                'client_id' => $request -> input('client_id'),
                'user_id' => $request -> input('user_id'),
                'start_time' => $request -> input('start_time'),
                'end_time' => $request -> input('end_time'),
                'comments' => $request -> input('comments')?$request -> input('comments'):''
            ]);

            if($schedule -> save()){
                return \Redirect::route('admin.schedule.list')->with('success', "Data has been updated successfully.");
            }else{
                return \Redirect::route('admin.schedule.update', ['updateid', $request -> input('updateid')])->with('errmsg', "Error!! Please try agian.");
            }
            

        }else{
            $client = \App\Models\Client::where('security_id', \Auth::guard('security')->id())->get();
            $guard = \App\Models\User::where('security_id', \Auth::guard('security')->id())->get();
            return view("admin.update_job", ['data' => \App\Models\Jobschedule::first(), 'client' => $client, 'guard' => $guard]);
        }
    }

    public function adminjobscheduledelete(Request $request, $deleteid){
        if($request -> method() == "GET"){
            $data = \App\Models\Jobschedule::find($deleteid);
            $data-> delete();
            return \Redirect::route('admin.schedule.list')->with('success', "Data has been deleted successfully.");

        }else{
            return \Redirect::route('admin.schedule.list');
        }
    }



    /**
     * 
    */

     public function fetch_user_details(Request $request)
     {
            /**
             *  For getting address from user dropdown 
            */

            // $value = $request->input('value');
            // $user_data = \App\Models\User::where('id', $value)->first();
            // // Perform any necessary processing based on the dropdown value
            // return response()->json(['success' => true, 'data' => $user_data->address]);


            /**
             * for getting address from clients address
            */

            $value = $request->input('value');
            return response()->json(['success' => true, 'data' => $value]);
     }
}