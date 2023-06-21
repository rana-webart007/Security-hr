<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use Redirect;
use App\Events\SendRegisterEmail;

//
use App\Models\{ClientsAddress, Client};
use Response;


class ClientController extends Controller
{
    
    public function securityclientadd(Request $request){

        if($request -> method() == "POST"){   
                              
            $request -> validate([
                'name' => 'required',
                'email' => 'required|unique:clients',
                'mobile' => 'required',
                'contact_person'=> 'required',
                'phone_no' => 'required',
                'address' => 'required'
            ]);
            // $password = rand(10000, 99999);
            $password = 123456;


            $client = \App\Models\Client::create([
                'security_id' => Auth::guard('security')-> id(),
                'name' => $request -> input('name'),
                'email' => $request -> input('email'),
                'mobile' => $request -> input('mobile'),
                'contact_person' => $request -> input('contact_person'),
                'address' => $request -> input('address'),
                'location_data' => $request -> input('location_data'),
                'address_map' => $request -> input('address_map'),                
                'phone_no' => $request -> input('phone_no'),
                'password' => Hash::make($password)
            ]);


            /**
             *  for main addresses 
            */
            ClientsAddress::create([
                'client_id' => $client->id,
                'address' => $request->address,
                'add_type' => 'main-address',
            ]);  
            
            if($request->more_address != null){

                /**
                 * for multiple addresses
                 */
                foreach($request->more_address as $more_addres){
                       ClientsAddress::create([
                               'client_id' => $client->id,
                               'address' => $more_addres,
                       ]);       
                }
            }

            if($client -> save()){
                event(new SendRegisterEmail(['name'=> $request->input('name'), 'password'=>$password, 'email' => $request -> input('email')]));
                return redirect::route('security.client.list')->with('success', "Data has been added successfully.");
            }else{
                return redirect::route('security.client.insert')->with('errmsg', "Insert error. Please try once")->withInput();
            }


        }else{
            return view("security.client_add"); 
        }
    }

    public function securityclientupdate(Request $request, $updateid=''){
        if($request -> method() == "POST"){

            $request -> validate([
                'name' => 'required',
                'email' => 'required|unique:clients,email,'.$request -> input('updateid'),
                'mobile' => 'required',
                'contact_person'=> 'required',
                'phone_no' => 'required',
                'address' => 'required'
            ]);

            $client = \App\Models\Client::find($request -> input('updateid'));
            $client -> fill([
                'security_id' => Auth::guard('security')-> id(),
                'name' => $request -> input('name'),
                'email' => $request -> input('email'),
                'mobile' => $request -> input('mobile'),
                'contact_person' => $request -> input('contact_person'),
                'address' => $request -> input('address'),
                'location_data' => $request -> input('location_data'),
                'phone_no' => $request -> input('phone_no'),
                'address_map' => $request -> input('address_map')
            ]);


            /**
             * update main address in clientaddress table 
            */

            ClientsAddress::where('client_id', $request->updateid)
            ->where('add_type', 'main-address')->update([
                  'address' => $request->address,
            ]);

            /**
             * If, client wanted to add more addresses 
            */

            if($request->has('add_more_address')){
                   foreach($request->add_more_address as $add_more){
                          ClientsAddress::create([
                               'client_id' => $request->updateid,
                               'address' => $add_more,
                          ]);
                   }
            } 

            /**
             *  update more addresses 
            */

            if($request->has('more_address')){
                   $ids = [];
                   $adds = [];

                   foreach($request->more_address_id as $more_add_id){
                          $ids = $more_add_id;      
                   }

                   foreach($request->more_address as $more_add){
                          $adds = $more_add;      
                   }

                   ClientsAddress::whereId($ids)->update([
                         'address' => $adds,
                   ]);
            }

            /**
             * 
             */

            if($client -> save()){
                return \Redirect::route('security.client.list')->with('success', "Data has been updated successfully.");
            }else{
                return \Redirect::route('security.client.list')->with('errmgs', "Unauthorized access.");
            }

        }else{
            $client = \App\Models\Client::where(['id' => $updateid])->first();
            if($client -> security_id == \Auth::guard('security')-> id()){

                /**
                 *   fetch client's address 
                */

                $branch_addresses = ClientsAddress::where('client_id', $updateid)
                                    ->where('add_type', 'branch-address')->get();

                return view("security.client_update", ['data' => $client, 'branch_addresses' => $branch_addresses]);
            }else{
                return \Redirect::route('security.client.list')->with('errmgs', "Unauthorized access.");
            }
            
        }
    }

    public function securityclientdelete(Request $request, $deleteid){
        $client = \App\Models\Client::find($deleteid);

        if($client -> security_id == \Auth::guard('security')-> id()){
            $client -> delete();
            return \Redirect::route('security.client.list')->with('success', 'Data has been deleted successfully.');
        }else{
            return \Redirect::route('security.client.list')->with('errmsg', 'Unauthorized access.');
        }
    }

    public function adminclientlist(Request $request){

        if($request -> method() == "POST"){

        }else{
            $clients = \App\Models\Client::get();          
            return view("admin.client_list", ['data' => $clients]);
        }

    }

    public function login(){

    }

    public function dashboard(){

    }

    public function securityclientlist(Request $request){
        if($request -> method() == "POST"){

        }else{
            return view("security.client_list", ['data' => \App\Models\Client::where('security_id', Auth::user() -> id) -> get()]);
        }
    }

    public function adminclientupdate(Request $request, $updateid = ''){
        if($request -> method() == "POST"){   
                
            $request -> validate([
                'name' => 'required',
                'email' => 'required|email|unique:clients,email,'.$request -> input('updateid'),
                'mobile' => 'required',
                'contact_person' => 'required',
                'phone_no' => 'required',
                'address' => 'required'
            ]);
            $client = \App\Models\Client::find($request -> input('updateid'));

            $client -> fill([
                'name' => $request -> input('name'),
                'email' => $request -> input('email'),
                'mobile' => $request -> input('mobile'),
                'contact_person' => $request -> input('contact_person'),
                'phone_no' => $request -> input('phone_no'),
                'address' => $request -> input('address'),
                'address_map' => $request -> input('address_map')
            ]);

            if($client -> save()){
                return redirect::route('admin.client.list')->with('success', "Data has been updated successfully.");
            }else{
                return redirect::route('admin.client.update', ['updateid', $request-> input('updateid')])->with('errmsg', "Update error. Please try again.");
            }

        }else{
            $client = \App\Models\Client::where('id', $updateid)-> first();
            return view("admin.client_update", ['data' => $client]);
        }
    }

    public function adminclientdelete(Request $request, $deleteid){
        if($request -> method() == "GET" && $deleteid != ''){
            $client = \App\Models\Client::find($deleteid);
            if($client -> delete()){
                return redirect::route('admin.client.list')->with('success', "Data has been deleted successfully.");
            }else{
                return redirect::route('admin.client.list')->with('errmsg', "Something error. Please try agian.");
            }
            
        }
    }


    /**
     * client's addresses
    */

    public function fetch_client_address(Request $request)
    {
        $client_id = $request->id;
        $addresses = ClientsAddress::where('client_id', $client_id)->get();
        $alternate_add = Client::whereId($client_id)->first();

        $address = (sizeof($addresses)) ? $addresses : ($alternate_add->address); 
        $alternate_id = (gettype($address) == "string") ? ($alternate_add->id) : "NA";

        return response()->json(['address' => $address, 'alternate_id' => $alternate_id]);
    }

    /**
     * Delete Multiple Add
     */

     public function del_multiple_Add($id)
     {
            ClientsAddress::find($id)->delete();
            return redirect()->back();
     }
}