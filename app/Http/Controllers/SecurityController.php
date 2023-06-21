<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use Redirect;
use App\Events\SendRegisterEmail;
use App\Http\Controllers\security\StripeManageController;
use App\Http\Controllers\security\PaymentMethodController;

//
use App\Http\Controllers\security\SubscriptionManageController;

class SecurityController extends Controller
{
    public function login(Request $request){
        if($request -> method() == "POST"){      
           if(Auth::guard('security')->attempt(['email' => $request -> email, 'password' => $request -> password])){
                return redirect()->route('security.dashboard');
           }else{
                return redirect()->route('security.login')->with('errmsg', "Email id or password does not match");
           }
        }else{
            return view("security.login");
        }
    }

    public function dashboard(Request $request){
        if($request -> method() == "POST"){
        }else{
            return view("security.dashboard");
        }
    }

    // change here..

    public function register(Request $request){
        if($request -> method() == "POST"){
            
             $request->validate([
                  'name' => 'required|max:200',
                  'email' => 'required|email|max:200',
                  'mobile' => 'required',
                  'person' => 'required|max:200',
                  'phone' => 'required',
                  'address' => 'required',
                  'password' => 'required',
                  'conf_pass' => 'required|same:password',

                  // card details

                  'card_no' => 'required|min:16',
                  'exp_month' => 'required|not_in:Month',
                  'exp_year' => 'required',
                  'cvc' => 'required|min:3',
             ],[
                   'person.required' => 'Contact Person Name is required',
                   'conf_pass.required' => 'Confirm Password is Required',
                   'conf_pass.same' => 'Confirm Password Must be same as Password'
             ]);

              // Create an instance of the StripeManageController
              $Stripe = app(StripeManageController::class);

             // create security
             $security = new \App\Models\Security([
                'name' => $request -> input('name'),
                'email' => $request -> input('email'),
                'mobile' => $request -> input('mobile'),
                'contact_person' => $request -> input('person'),
                'phone_no' => $request -> input('phone'),
                'address' => $request -> input('address'),
                'password' => Hash::make($request->password)
            ]);

            if($security->save()){

                // Create an instance of the StripeManageController
                $Stripe = app(StripeManageController::class);

                /// create a new customer in stripe
                $cust_id = $Stripe->add_customers($request->name, $request->email, $request->card_no, 
                $request->exp_month, $request->exp_year, $request->cvc);

                // add subscription in db
                $subs = app(SubscriptionManageController::class);
                $subs->subscriptionAdd($cust_id, $security->id, '00', '10', 'security');

                // // create payment methods for customer in stripe
                // $payment = $Stripe->add_customers($cust_id, $request->card_no, 
                // $request->exp_month, $request->exp_year, $request->cvc);

                // save payment method in local DB
                $pay_save = app(PaymentMethodController::class);
                $pay_save->save_pay_method($security->id, 'security', $cust_id, $request->card_no, 
                $request->exp_month, $request->exp_year, $request->cvc);
                ////////

                return back()->with('reg_success', 'Registered successfully');
            }else{
               return back()->with('reg_err', 'Sorry! somethig is wrong, please try again');
            }
        }else{          
            return view("security.register");
        }
    }

    public function adminsecuritylist(Request $request){
        if($request -> method() == "POST"){
        }else{        
            return view("admin.security_list", ['data'=> \App\Models\Security::get()]);
        }
    }

    public function adminsecurityadd(Request $request){        
        if($request -> method() == "POST"){           
            $request -> validate([
                'name' => ['required', 'max:255'],
                'email' => ['required', 'max: 255', 'email', 'unique:securities'],
                'mobile' => ['required', 'numeric'],
                'contact_person' => ['required'],
                'phone_no' => ['required', 'digits:10', 'numeric'],
                'address' => ['required']
            ]);

            $password = rand(10000, 99999);

            $security = new \App\Models\Security([
                'name' => $request -> input('name'),
                'email' => $request -> input('email'),
                'mobile' => $request -> input('mobile'),
                'contact_person' => $request -> input('contact_person'),
                'phone_no' => $request -> input('phone_no'),
                'address' => $request -> input('address'),
                'password' => Hash::make($password)
            ]);

            if($security -> save()){
                event(new SendRegisterEmail(['name'=> $request->input('name'), 'password'=>$password, 'email' => $request -> input('email')]));
                return Redirect::route('admin.security.list')->with('success', 'Data has been added successfully.');
            }else{
                return Redirect::route('admin.security.add')->with('errmsg', 'Error!! Please try again.');
            }

        }else{               
            return view("admin.security_add");
        }
    }

    public function adminsecurityupdate(Request $request, $updateid = ""){        
        if($request -> method() == "POST"){           
            $request -> validate([
                'name' => ['required', 'max:255'],
                'email' => ['required', 'max: 255', 'email', 'unique:securities,email,'.$request->input('update_id')],
                'mobile' => ['required', 'numeric'],
                'contact_person' => ['required'],
                'phone_no' => ['required', 'digits:10', 'numeric'],
                'address' => ['required']
            ]);

            $security = \App\Models\Security::find($request->input('update_id'));
            $security -> fill([
                'name' => $request -> input('name'),
                'email' => $request -> input('email'),
                'mobile' => $request -> input('mobile'),
                'contact_person' => $request -> input('contact_person'),
                'phone_no' => $request -> input('phone_no'),
                'address' => $request -> input('address'),
                'password' => Hash::make('12345678')
            ]);

            if($security -> save()){
                return Redirect::route('admin.security.list')->with('success', 'Data has been updated successfully.');
            }else{
                return Redirect::route('admin.security.list')->with('errmsg', 'Error!! Please try again.');
            }
        }else{               
            $security = \App\Models\Security::find($updateid);            
            return view("admin.security_update", ['data' => $security]);
        }
    }

    public function adminsecuritydelete(Request $request, $deleteid){
        if($request -> method() == "GET" && $deleteid != ''){
            $security = \App\Models\Security::find($deleteid);
            $security -> delete();
            return Redirect::route('admin.security.list')->with('success', 'Data has been deleted successfully.');
        }else{
            return Redirect::route('admin.security.list')->with('errmsg', 'Error!! Please try again.');
        }
    }

    public function logout(Request $request){
        if($request->method() == "GET"){
            \Auth::guard('security')->logout();
            return Redirect::route('security.login');
        }
    }
    
}