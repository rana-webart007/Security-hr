<x-securityheader />

<div class="page-wrapper">
    <div class="page-content">

         @php
                    $guards = App\Models\User::where('security_id', Auth()->guard('security')->user()->id)->get();
                    
                    $total_guards = count($guards);
                    $currency = "USD";

                    if($total_guards > 0 && $total_guards< 50){
                    $amount = (10);
                    }

                    if($total_guards > 50 && $total_guards< 101){
                    $amount = (500);
                    }

                    if($total_guards > 100 && $total_guards< 151){
                    $amount = (750);
                    }

                    if($total_guards > 150 && $total_guards< 201){
                    $amount = (1000);
                    }

                    if($total_guards > 200 && $total_guards< 251){
                    $amount = (1250);
                    }

                    if($total_guards > 250 && $total_guards< 301){
                    $amount = (1500);
                    }

                    if($total_guards > 300 && $total_guards< 401){
                    $amount = (2000);
                    }

                    if($total_guards > 400 && $total_guards< 501){
                    $amount = (3000);
                    }

                    if($total_guards > 500 && $total_guards< 601){
                    $amount = (4000);
                    }

                    if($total_guards > 600 && $total_guards< 801){
                    $amount = (5000);
                    }

                    if($total_guards > 800 && $total_guards< 1001){
                    $amount = (6000);
                    }

                    if($total_guards > 1000 && $total_guards< 3001){
                    $amount = (7000);
                    }

                    if($total_guards > 3000 && $total_guards< 5001){
                    $amount = (10000);
                    }

         @endphp


         @php
              $check_subs = App\Models\SubscriptionLists::where('user_id', Auth()->guard('security')->user()->id)->first();
              if($check_subs != null){
                   $expload_date = explode(" ", $check_subs->expire_date);
                   $expire_date = $expload_date[0];
              }
              else{
                   $expire_date = "";
              }
         @endphp


          <div class="m-5">
          
          @if(Session::has('success'))
             <p class="alert alert-success">{{ Session::get('success') }}</p>
          @endif

          <form action="{{ route('subscription.create') }}" method="post">
          @csrf

          <input type="hidden" value="{{ $amount }}" name="amount">
          <input type="hidden" value="{{ $currency }}" name="currency">
          <input type="hidden" value="security" name="user_type">


          <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"  
               data-key="{{ env('STRIPE_KEY') }}"
               data-name="Securityhr" 
               data-amount="{{ ($amount * 100) }}" 
               data-currency="{{ $currency }}"
               data-description="Securityhr Subscription" 
               data-image="{{ asset('assets\images\icon.png') }}">
          </script>
     </form>
    </div>

    </div>
</div>
<x-securityfooter />