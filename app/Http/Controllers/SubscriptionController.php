<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

////////
use App\Http\Controllers\security\StripeManageController;

class SubscriptionController extends Controller
{
    
    public function adminsubscriptionlist(Request $request){

        if($request -> method() == "POST"){

        }else{
            return view("admin.subscription", ['data' => \App\Models\Subscription::get()]);
        }
    }

    public function adminsubscriptionadd(Request $request){
        if($request -> method() == "POST"){
            
            $request -> validate([
                'name' => 'required|max:255',
                'amount' => 'required|numeric',
                'details' => 'required',

                //
                'max_guards' => 'required|numeric',
                'valid_for' => 'required|numeric',
                'valid_type' => 'required|not_in:Select Subscription Type'
            ]);


            /**
             * First check the same product is already present in db or not
             * If not present then only a new product will be created
            */


            $check_existing = \App\Models\Subscription::whereName($request->name)
            ->whereAmount($request->amount)
            ->first();


            /**
             *  If, extra amount is present, then extra amount will be added to normal amount
            */

            $extra_amount = ($request->extra_charge == null) ? 0 : $request->extra_charge;
            $total_amount = ($request->amount + $extra_amount);
            

            /**
             * no of year must not grater than 1
            */

            if($request->valid_type == "Year"){
                if($request->valid_for > 0 && $request->valid_for < 2){
                    $check_status = 0;     
                }else{
                    $check_status = 1;
                }
            }else{
                $check_status = 0;
            }

            /**
             * create product & price for newly added subscription plans..
            */

    if($check_status == 0){
        if($check_existing == null){
            $prod = app(StripeManageController::class);
            $results = $prod->product_add($request->name, $request->details, $total_amount, $request->valid_type, $request->valid_for);
            $product_id = $results['product_id'];
            $priceId = $results['priceId'];
            $status = $results['status'];

            /**
             * 
            */


            $security = new \App\Models\Subscription([
                'name' => $request->input('name'),
                'amount' => $request->input('amount'),
                'details' => $request->input('details'),
                'valid_for' => $request->input('valid_for'),
               
                //
                'valid_type' => $request->valid_type,
                'extra_charge' => $extra_amount,
                'total_amount' => $total_amount,
                //
                'max_guards' => $request->max_guards, 
                'stripe_price_id' => $priceId,
                'stripe_product_id' => $product_id,
                'status' => $status
            ]);

            if($security -> save()){
                return \Redirect::route('admin.subscription.list')->with('success', "Data has been added successfully!!");
            }else{
                return \Redirect::route('admin.subscription.add')->with('errmsg', "Error. Please try agian!!");
            }
          }

        else{
            return \Redirect::route('admin.subscription.list')->with('success', "Data has been added successfully!!");
        }
    }
        
        //////////////
        else{
            return \Redirect::back()->with(['err_msg' => 'No. of Years must not be grater than 1']);
        }
            
        }

        else{
            return view("admin.subscription_add");
          }
    
      
    }

    
    
    

    public function adminsubscriptionupdate(Request $request, $updateid = ''){

        if($request -> method() == "POST"){

            $request -> validate([
                "name" => 'required|max:255',
                'valid_for' => 'required|numeric',
                'details' => 'required',
                'amount' => 'required|numeric',
                'max_guards' => 'required|numeric',

                // 

                'valid_type' => 'required'
            ]);

            $subscription = \App\Models\Subscription::find($request->input('update_id'));


            /**
             *  If, extra amount is present, then extra amount will be added to normal amount
            */

            $extra_amount = ($request->extra_charge == null) ? 0 : $request->extra_charge;
            $total_amount = ($request->amount + $extra_amount);
            //

            /**
             * no of year must not grater than 1
            */

            if($request->valid_type == "Year"){
                if($request->valid_for > 0 && $request->valid_for < 2){
                    $check_status = 0;     
                }else{
                    $check_status = 1;
                }
            }else{
                $check_status = 0;
            }

            //


        if($check_status == 0){
            $prod = app(StripeManageController::class);
            $new_price_id = $prod->product_update($request->name, $subscription->stripe_product_id, $total_amount, $subscription->stripe_price_id, $request->valid_type, $request->valid_for);

            $subscription -> fill([
                'name' => $request -> input('name'),
                'valid_for' => $request -> input('valid_for'),
                'details' => $request -> input('details'),
                'amount' => $request -> input('amount'),

                //
                'valid_type' => $request->valid_type,
                'extra_charge' => $extra_amount,
                'total_amount' => $total_amount,
                //

                'stripe_price_id' => $new_price_id,
                'max_guards' => $request->max_guards,
                'status' => 'success'
            ]);

            if($subscription -> save()){
                return \Redirect::route('admin.subscription.list')->with('success', "Data has been updated successfully!!");
            }else{
                return \Redirect::route('admin.subscription.udpate', ['updateid'=> $request->input('updateid')])->with('errmsg', "Error. Please try agian!!");
            }
        }else{
            return \Redirect::back()->with(['err_msg' => 'No. of Years must not be grater than 1']);
            //return redirect()->back();
        }

        }else{
            return view('admin.subscription_update', ['data' => \App\Models\Subscription::find($updateid)]);
        }

    }

    public function adminsubscriptiondelete(Request $request, $deleteid){
         if($request -> method() == "GET"){
            $subscription = \App\Models\Subscription::find($deleteid);
            $subscription->delete();
            return \Redirect::route('admin.subscription.list')->with('success', "Data has been deleted successfully!!");
        }else{
            return \Redirect::route('admin.subscription.list')->with('errmsg', "Error!! Please try agian.");
        }
    }
}