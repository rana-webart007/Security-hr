<x-securityheader/>
<div class="page-wrapper">
	<div class="page-content">
        <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                 	<div class="card">
							<div class="card-body">
                                <form action="{{ route('admin.guard.update.success') }}" method="post" autocomplete="off" onsubmit="return valid();">
                                    <input type="hidden" id="update_id" name="update_id" value="{{ $data -> id }}"/>
                                    @csrf
                                    <div class="border p-3 rounded">
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Security company name</label>
                                            <select name="security_id" id="security_id" class="form-control selectOption">
                                              <option value="">Select</option>
                                              @foreach($security as $sec)
                                                <option value="{{ $sec->id }}" {{$sec -> id == $data -> security_id ?'Selected': ''}}>{{ $sec -> name }}</option>
                                              @endforeach
                                            </select>
                                            <span class="text-danger d-block pt-2" id="nameerror"></span>
                                            @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Security guard name</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Security guard name" value="{{ $data->name }}"/>										
                                            <span class="text-danger d-block pt-2" id="nameerror"></span>
                                            @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email ID</label>                                            
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Email id" value="{{ $data->email }}"/>										
                                            <span class="text-danger" id="emailerror"></span>
                                            @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="mobile">Mobile no</label>
                                            <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile no" value="{{ $data->mobile }}"/>										
                                            <span class="text-danger" id="mobileerror"></span>
                                            @if ($errors->has('mobile'))
                                            <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                            @endif
                                        </div>                                   

                                        <div class="mb-3">
                                            <label class="form-label" for="address">Address</label>
                                            <input type="text" name="address" id="address" class="form-control" placeholder="Address" value="{{ $data->address }}"/>										
                                            <span class="text-danger" id="addresserror"></span>
                                            @if ($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div> 

                                        <div class="mb-3">
                                            <label class="form-label" for="amount">Rate (per hour)</label>
                                            <input type="number" name="amount" id="amount" class="form-control" placeholder="Amount" value="{{ $data->amount }}"/>										
                                            <span class="text-danger" id="amounterror"></span>
                                            @if ($errors->has('amount'))
                                            <span class="text-danger">{{ $errors->first('amount') }}</span>
                                            @endif
                                        </div> 
                                        <div class="sbg">
                                            <input type="submit" class="btn btn-success" id="submit" name="submit" value="Submit"/>
                                            <a href="{{ route('admin.guard.list') }}" class="btn btn-dark">Back</a>
                                        </div>                                
                                    </div>  
                                </form>								                         
						    </div>
					</div>
                </div>
            </div>
    </div>
</div>
<x-securityfooter/>
<script>
    function valid(){
      if($("#name").val() == ""){
        $("#nameerror").html("Guard name is a require field.");
        $("#name").focus();
        return false;
      }else if($("#email").val() == ""){
        $("#emailerror").html("Email id is a require field.");
        $("#email").focus();
        return false;
      }else if($("#mobile").val() == ""){
        $("#mobileerror").html("Mobile no is a require field.");
        $("#mobile").focus();
        return false;
      }else if($("#address").val() == ""){
        $("#addresserror").html("Address is a require field.");
        $("#address").focus();
        return false;
      }
    }
</script>