@extends('layouts.app')
@section('content')

@if(Session::has('reg_success'))
<div class="alert alert-success">
    {{ Session::get('reg_success') }}
    @php
    Session::forget('reg_success');
    @endphp
</div>
@endif

@if(Session::has('reg_err'))
<div class="alert alert-danger">
    {{ Session::get('reg_err') }}
    @php
    Session::forget('reg_err');
    @endphp
</div>
@endif


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Security Registration') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('security/register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Full Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="mobile" class="col-md-4 col-form-label text-md-end">{{ __('Mobile') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="number"
                                    class="form-control @error('mobile') is-invalid @enderror" name="mobile" required
                                    autocomplete="new-mobile">

                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="person"
                                class="col-md-4 col-form-label text-md-end">{{ __('Contact Person') }}</label>

                            <div class="col-md-6">
                                <input id="person" type="text"
                                    class="form-control @error('person') is-invalid @enderror" name="person" required
                                    autocomplete="new-person">

                                @error('person')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone"
                                class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="number"
                                    class="form-control @error('phone') is-invalid @enderror" name="phone" required
                                    autocomplete="new-phone">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address" required
                                    autocomplete="new-address">

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="conf_pass"
                                    required autocomplete="new-password">
                            </div>
                        </div>



                        <!-- card details -->
                        <h5 class="text-center m-2">Card Details</h5>

                        <div class="row mb-3">
                            <label for="card_no"
                                class="col-md-4 col-form-label text-md-end">{{ __('Card No.') }}</label>

                            <div class="col-md-6">
                                <input id="card_no" type="number"
                                    class="form-control @error('card_no') is-invalid @enderror" name="card_no"
                                    placeholder="Enter Your Card's 16 digit Number" required autocomplete="new-address">

                                @error('card_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="exp_month"
                                class="col-md-4 col-form-label text-md-end">{{ __('Exp Month') }}</label>

                            <div class="col-md-6">
                                <!-- <div class="col-md-6"> -->
                                <!-- <input id="exp_month" type="text"
                                    class="form-control @error('exp_month') is-invalid @enderror" name="exp_month"
                                    required autocomplete="new-exp_month"> -->

                                <select id='month-dropdown' class="form-control @error('exp_month') is-invalid @enderror" name="exp_month" >
                                </select>

                                @error('exp_month')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <!-- </div> -->
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="exp_year"
                                class="col-md-4 col-form-label text-md-end">{{ __('Exp Year') }}</label>

                            <div class="col-md-6">
                                <!-- <div class="col-md-6"> -->
                                <!-- <input id="exp_year" type="text"
                                    class="form-control @error('exp_year') is-invalid @enderror" name="exp_year" placeholder="YYYY" required
                                    autocomplete="new-exp_year"> -->

                                <select id='year-dropdown' class="form-control @error('exp_year') is-invalid @enderror" name="exp_year" >
                                </select>

                                @error('exp_year')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <!-- </div> -->
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cvc" class="col-md-4 col-form-label text-md-end">{{ __('CVC') }}</label>

                            <div class="col-md-6">
                                <input id="cvc" type="number" class="form-control @error('cvc') is-invalid @enderror"
                                    placeholder="Enter 3 digit Cvc" name="cvc" required autocomplete="new-cvc">

                                @error('cvc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- -->

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection