<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
class AdminController extends Controller
{    
    public function login(Request $request){
       if($request -> method() == "POST"){    
        if(Auth::guard('admin')->attempt(['email' => $request -> input('email'), 'password' => $request -> input('password')])){
            return redirect() -> route('admin.dashboard');
        }else{
            return redirect()->route('admin.login')->with('message', 'You entered a worng email id or password.')->withInput();
        }         
       }else{
        return view("admin.login");
       }
    } 

    public function dashboard(Request $request){
        if($request -> method() == "POST"){

        }else{
            return view("admin.dashboard");
        }
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        return redirect() -> route('admin.login');
    }
}
