<x-adminheader/>
<div class="page-wrapper">
	<div class="page-content">
        <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                 	<div class="card">
							<div class="card-body">
                                <form action="{{ route('admin.security.insert') }}" method="post" autocomplete="off" onsubmit="return valid();">
                                    @csrf
                                    <div class="border p-3 rounded">
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Company Name</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Company name" value="{{ old('name') }}"/>										
                                            <span class="text-danger d-block pt-2" id="nameerror"></span>
                                            @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email ID</label>                                            
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Email id" value="{{ old('email') }}"/>										
                                            <span class="text-danger" id="emailerror"></span>
                                            @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="mobile">Mobile no</label>
                                            <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile no" value="{{ old('mobile') }}"/>										
                                            <span class="text-danger" id="mobileerror"></span>
                                            @if ($errors->has('mobile'))
                                            <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="contact_person">Contact person</label>
                                            <input type="text" name="contact_person" id="contact_person" class="form-control" placeholder="Contact person" value="{{ old('contact_person') }}"/>										
                                            <span class="text-danger" id="contact_personerror"></span>
                                            @if ($errors->has('contact_person'))
                                            <span class="text-danger">{{ $errors->first('contact_person') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="phone_no">Phone no</label>
                                            <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="Phone no" value="{{ old('phone_no') }}"/>										
                                            <span class="text-danger" id="phone_noerror"></span>
                                            @if ($errors->has('phone_no'))
                                            <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                                            @endif
                                        </div> 

                                        <div class="mb-3">
                                            <label class="form-label" for="address">Address</label>
                                            <input type="text" name="address" id="address" class="form-control" placeholder="Address" value="{{ old('address') }}"/>										
                                            <span class="text-danger" id="addresserror"></span>
                                            @if ($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div> 
                                        <div class="sbg">
                                            <input type="submit" class="btn btn-success" id="submit" name="submit" value="Submit"/>
                                            <a href="{{ route('admin.security.list') }}" class="btn btn-dark">Back</a>
                                        </div>                                
                                    </div>  
                                </form>								                         
						    </div>
					</div>
                </div>
            </div>
    </div>
</div>
<x-adminfooter/>
<script>
    function valid(){
      if($("#name").val() == ""){
        $("#nameerror").html("Company name is a require field.");
        $("#name").focus();
        return false;
      }
    }
</script>
