<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\SendRegisterEmail;
use Hash;
use Auth;
use Redirect;
class GuardController extends Controller
{
    
    public function adminguardlist(Request $request){

        if($request -> method() == "POST"){

        }else{
           return view('admin.guard_list', ['data' => \App\Models\User::get()]);
        }
    }

    public function securityguardlist(Request $request){
        if($request -> method() == "POST"){

        }else{         
            $security = \App\Models\User::where('security_id', Auth::guard('security')->id()) -> get(); 
            return view('security.guard_list', ['data' => $security]);
        }
    }

    public function addsecurityguard(Request $request){       
        if($request -> method() == "POST"){
           
            $request -> validate([
                'name'=> 'required|max:255',
                // 'email'=> 'required|email|unique:users',
                'email'=> 'required|email',
                'mobile'=> 'required|digits:10',
                'address' => 'required|max:255',
                'amount' => 'required|numeric'
            ]);

            $password = rand(10000, 99999);
            $users = new \App\Models\User([
                'security_id' => Auth::guard('security') -> id(),
                'name'=> $request -> input('name'),
                'email'=> $request -> input('email'),
                'mobile'=> $request -> input('mobile'),
                'address' => $request -> input('address'),
                'password' => Hash::make($password),
                'amount' => $request -> input('amount')
            ]);


            // event(new SendRegisterEmail(['name'=> $request->input('name'), 'password'=>$password, 'email' => $request -> input('email')]));

            if($users -> save()){
                event(new SendRegisterEmail(['name'=> $request->input('name'), 'password'=>$password, 'email' => $request -> input('email')]));
                return redirect::route('security.guard.list')-> with('success', "Data has been added successfully.");;
            }else{
                return redirect::route('security.guard.add') -> with('errmsg', "Somthing error please try agian.");
            }


        }else{
            return view('security.guard_add');
        }
    }

    public function updatesecurityguard(Request $request, $updateId=''){

        if($request -> method() == "POST"){
            $request -> validate([
                'name'=> 'required|max:255',
                'email'=> 'required|email|unique:users,email,'.$request -> post('update_id'),
                'mobile'=> 'required|digits:10',
                'address' => 'required|max:255',
                'amount' => 'required|numeric'
            ]);

            $guard = \App\Models\User::findOrFail($request -> post('update_id'));
            $guard -> fill([
                'name' => $request -> input('name'),
                'email' => $request -> input('email'),
                'mobile' => $request -> input('mobile'),
                'address' => $request -> input('address'),
                'amount' => $request -> input('amount'),
            ]);

            if($guard -> save()){
                return redirect::route('security.guard.list') -> with('success', "Data update successfully");
            }else{
                return redirect::route('security.guard.update', ['id' => $request -> input('update_id')])->with('errmsg', "Something error!! Please try again");
            }

        }else{

            $guard = \App\Models\User::where(['security_id' => Auth::guard('security') -> id()])->where('id', $updateId)->first();

            if($guard){
                return view("security.guard_update", ['data' => $guard]);
            }else{
                return redirect::route("security.guard.list");
            }
            
        }
    }

    public function deletesecurityguard(Request $request, $deleteid){
        if(\App\Models\User::where('security_id', Auth::guard('security') -> id() )->where('id', $deleteid)->count()){
            \App\Models\User::find($deleteid)->delete();            
            return redirect::route('security.guard.list')->with('success', "Data has been deleted successfully.");
        }else{
            return redirect::route('security.guard.list')->with('errmsg', "Somthing error. Please try agian");
        }     
    }

    public function adminguardupdate(Request $request, $updateId=''){

        if($request -> method() == "POST"){
            $request -> validate([
                'name'=> 'required|max:255',
                'email'=> 'required|email|unique:users,email,'.$request -> post('update_id'),
                'mobile'=> 'required|digits:10',
                'address' => 'required|max:255',
                'amount' => 'required|numeric'
            ]);

            $guard = \App\Models\User::findOrFail($request -> post('update_id'));
            $guard -> fill([
                'security_id' => $request -> input('security_id'),
                'name' => $request -> input('name'),
                'email' => $request -> input('email'),
                'mobile' => $request -> input('mobile'),
                'address' => $request -> input('address'),
                'amount' => $request -> input('amount'),
            ]);

            if($guard -> save()){
                return redirect::route('admin.guard.list') -> with('success', "Data updated successfully");
            }else{
                return redirect::route('admin.guard.update', ['id' => $request -> input('update_id')])->with('errmsg', "Something error!! Please try again");
            }

        }else{

            $guard = \App\Models\User::where('id', $updateId)->first();

            if($guard){
                $security = \App\Models\Security::select(['id', 'name'])-> get();               
                return view("admin.guard_update", ['data' => $guard, 'security' => $security]);
            }else{
                return redirect::route("security.guard.list");
            }
            
        }
    }

    public function adminguarddelete(Request $request, $deleteid){
        if(\App\Models\User::where('id', $deleteid)->count()){
            \App\Models\User::find($deleteid)->delete();            
            return redirect::route('admin.guard.list')->with('success', "Data has been deleted successfully.");
        }else{
            return redirect::route('admin.guard.list')->with('errmsg', "Somthing error. Please try agian");
        }     
    }

    
}
