<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Product;
use Stripe\Price;
use Stripe\Customer;
use Stripe\PaymentMethod;
use Stripe\Token;
use Session;
use Auth;

class StripeManageController extends Controller
{
    /**
     * Stripe Product Add
     */

     public function product_add($name, $description, $amount, $valid_type, $interval_count)
     {
            // Set your Stripe API key
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $interval = ($valid_type == "Month") ? "month" : "year";

            // Create a new product
            $product = Product::create([
                'name' => $name,
                'description' => $description,
            ]);

            // Create a new price for the product
            $price = Price::create([
                'unit_amount' => ($amount * 100),
                'currency' => 'usd',
                'product' => $product->id,
                'recurring' => [
                    'interval' => $interval,
                    'interval_count' => $interval_count,
                ],
            ]);

            // product status
            $status = $product->status;

            $result = [
                'product_id' => $product->id,
                'priceId' => $price->id,
                'status' => $status
            ];
            
            return $result;
     }


     /**
      * get all products
     */

     public function product_all()
     {
             // Set your Stripe API key
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Get all products
            $products = Product::all();

            // Iterate over the products and get their prices
            $result = [];
            foreach ($products->autoPagingIterator() as $product) {
                $prices = Price::all(['product' => $product->id]);
                $result[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'images' => $product->images,
                    'prices' => $prices->data,
                ];
            }


            foreach($result as $res){
                    $price_ids[] = $res['prices'][0]->id;
            }

            dd($price_ids);
     }


     /**
      * Update Product
     */

     public function product_update($name, $product_id, $amount, $priceId, $valid_type, $valid_for)
     {

             // Set your Stripe API key
             Stripe::setApiKey(env('STRIPE_SECRET'));


             $interval = ($valid_type == "Month") ? "month" : "year";

             // product id
             $productId = $product_id;

             // Fetch the product from Stripe
             $product = Product::retrieve($productId);

             //fetch price
             $price = Price::retrieve($priceId);
            //  dd($price);
             
             // update the price object with the new values
            $price->active = false; // set the new price in cents
            $price->save(); // save the changes to Stripe
             
            // Update the product name
             $product->name = $name;

              // Create a new price object with the updated values
                $updatedPrice = Price::create([
                    'unit_amount' => ($amount * 100), // New price in cents
                    'currency' => 'USD', // New currency
                    'product' => $product->id,
                    'active' => true,
                    'recurring' => [
                        'interval' => $interval,
                        'interval_count' => $valid_for,
                    ],
                ]);

            

            // Save the updated product
            $product->save();
            
            $new_price_id= $updatedPrice->id;

            return $new_price_id;
    }


    /**
     * product price update
    */

    public function product_price_update()
    {
           // Set your Stripe API key
           Stripe::setApiKey(env('STRIPE_SECRET'));

           // retrieve the price ID that you want to update
            $price_id = 'price_1Mxl5QSCgMR7q6bkszDpB4hX';

            // retrieve the price object from Stripe
            $price = Price::retrieve($price_id);

            // update the price object with the new values
            $price->active = false; // set the new price in cents
            $price->save(); // save the changes to Stripe

            dd("Success");
    }

    /**
     * Add Card Details of user
    */

    public function add_cards($cust_id, $card_no, $exp_mon, $exp_year, $cvc)
    {
            // Set your Stripe API key
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Retrieve the Stripe customer object for the user (replace with your own customer ID)
            $customer = Customer::retrieve($cust_id);

            // Create a new payment method
            $paymentMethod = PaymentMethod::create([
                'type' => 'card',
                'card' => [
                    'number' => $card_no,
                    'exp_month' => $exp_mon,
                    'exp_year' => $exp_year,
                    'cvc' => $cvc,
                ],
            ]);

            // Attach the payment method to the customer
            $paymentMethod->attach(['customer' => $customer->id]);

            // Set the payment method as the default for the customer
            $customer->invoice_settings->default_payment_method = $paymentMethod->id;
            $customer->save(); 

            return true;
    }

    /*
     * create stripe token
    */

    public function createToken($card_no, $exp_mon, $exp_year, $cvc)
    {
            // Set your Stripe API key
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Create a new Stripe token
            $token = Token::create([
                'card' => [
                    'number' => $card_no,
                    'exp_month' => $exp_mon,
                    'exp_year' => $exp_year,
                    'cvc' => $cvc,
                ],
            ]);

            $tokenId = $token->id;
            return $tokenId;
    }

    /**
     * Create new Customer
     */

     public function add_customers($name, $email, $card_no, $exp_mon, $exp_year, $cvc)
     {
            
            // Set your Stripe API key
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // token id
            $token_id = $this->createToken($card_no, $exp_mon, $exp_year, $cvc);

            //we have to create a customer for payment
            $customer = Customer::create(array(
                'name' => $name,
                'email' => $email,
                'description' => 'New customer',
                "source" => $token_id,
            ));

            $cust_id = $customer->id;
            return $cust_id;
     }
}