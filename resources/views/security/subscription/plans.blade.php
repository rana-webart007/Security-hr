<x-securityheader />

<div class="page-wrapper">
    <div class="page-content">

        <div class="row align-items-center justify-content-center">
            <div class="col-md-12">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Subscribe Here</h5>
                    </div>
                </div>
            </div>


            <!-- card 1 -->
            <div class="row align-items-center justify-content-center">

                @foreach($subscriptions as $subscription)
                <div class="col-md-4">
                    <form action="{{ route('subscription.create') }}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card text-center">
                                <div class="card-header">
                                    <h2> {{ $subscription->name}} </h2>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $subscription->name}}</h5>
                                    <p class="card-text">
                                        Guard Limit: upto {{ $subscription->max_guards}}
                                    </p>
                                    <p class="card-text">
                                        Amount: ${{ $subscription->amount}}
                                    </p>
                                    <p class="card-text">
                                        Charge: ${{ $subscription->extra_charge}}
                                    </p>
                                    <p class="card-text">
                                        Total Amount: ${{ $subscription->total_amount}}
                                    </p>
                                    <p class="card-text">
                                        Valid For: {{ $subscription->valid_for}} {{ $subscription->valid_type}}
                                    </p>


                                    <input type="hidden" name="amount" value="{{ $subscription->total_amount}}">
                                    <input type="hidden" name="guards" value="{{ $subscription->max_guards}}">
                                    <input type="hidden" name="currency" value="usd">
                                    <input type="hidden" name="price_id" value="{{ $subscription->stripe_price_id}}">

                                    <input type="hidden" name="valid_for" value="{{ $subscription->valid_for}}">
                                    <input type="hidden" name="valid_type" value="{{ $subscription->valid_type}}">



                                    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                        data-key="{{ env('STRIPE_KEY') }}" data-name="Securityhr"
                                        data-amount="{{ ($subscription->total_amount) * 100}}" data-currency="USD"
                                        data-description="Securityhr Subscription"
                                        data-image="{{ asset('assets\images\icon.png') }}">
                                    </script>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @endforeach

            </div>
        </div>
    </div>
<x-securityfooter />