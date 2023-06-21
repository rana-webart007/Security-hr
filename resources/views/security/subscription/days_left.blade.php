@php
    if(Session::has('dayLeft')){
          $total_days_left = Session::get('dayLeft'); 
    }
@endphp

@if($total_days_left['guard_checking_key'] != 9999)
<div class="alert alert-danger">
    <h5 class="text-dark text-center" style="margin-bottom:0 !important;">Your Free Trial will be ends in : {{ $total_days_left['days_left'] }} days</h5>
    <h6 class="text-dark text-center" style="margin-top: 10px;" >Your can add no of guards: {{ $total_days_left['guards_left'] }} </h6>
</div>
@endif