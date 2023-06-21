<x-securityheader/>
<div class="page-wrapper">
	<div class="page-content">
        <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                 	<div class="card">
							<div class="card-body">
                                <form action="{{ route('admin.schedule.update.success') }}" method="post" autocomplete="off" onsubmit="return valid();">
                                <input type="hidden" name="updateid" id="updateid" value="{{ $data -> id }}">    
                                @csrf
                                    <div class="border p-3 rounded">
                                        <div class="mb-3">
                                            <label class="form-label" for="client_id">Client name</label>
                                            <select name="client_id" id="client_id" class="form-control">
                                              <option value="">Select</option>
                                              @foreach($client as $val)
                                                <option value="{{ $val -> id }}" {{ $data -> client_id  == $val -> id?'Selected':'' }}>{{ $val -> name }}</option>
                                              @endforeach
                                            </select>
                                            <span class="text-danger d-block pt-2" id="client_iderror"></span>
                                            @if ($errors->has('client_id'))
                                            <span class="text-danger">{{ $errors->first('client_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="user_id">Security guard</label>
                                            <select name="user_id" id="user_id" class="form-control">
                                              <option value="">Select</option>
                                              @foreach($guard as $val)
                                                <option value="{{ $val -> id }}" {{ $data -> user_id  == $val -> id?'Selected':'' }}>{{ $val -> name }}</option>
                                              @endforeach
                                            </select>
                                            <span class="text-danger d-block pt-2" id="user_iderror"></span>
                                            @if ($errors->has('user_id'))
                                            <span class="text-danger">{{ $errors->first('user_id') }}</span>
                                            @endif
                                        </div>
                                    
                                        <div class="mb-3">
                                            <label class="form-label" for="start_time">Start time</label>
                                            <input type="time" name="start_time" id="start_time" class="form-control" value="{{ date("H:i", strtotime($data -> start_time)) }}"/>										
                                            <span class="text-danger" id="start_timeerror"></span>
                                            @if ($errors->has('start_time'))
                                            <span class="text-danger">{{ $errors->first('start_time') }}</span>
                                            @endif
                                        </div>                                   

                                        <div class="mb-3">
                                            <label class="form-label" for="end_time">End time</label>
                                            <input type="time" name="end_time" id="end_time" class="form-control" value="{{ date("H:i", strtotime($data -> end_time)) }}"/>										
                                            <span class="text-danger" id="end_timeerror"></span>
                                            @if ($errors->has('end_time'))
                                            <span class="text-danger">{{ $errors->first('end_time') }}</span>
                                            @endif
                                        </div> 

                                        <div class="mb-3">
                                            <label class="form-label" for="comments">Comments</label>
                                            <textarea name="comments" id="comments" class="form-control" placeholde="Comments"> {{ $data -> comments }}</textarea>										
                                            <span class="text-danger" id="commentserror"></span>
                                            @if ($errors->has('comments'))
                                            <span class="text-danger">{{ $errors->first('comments') }}</span>
                                            @endif
                                        </div> 

                                        <div class="sbg">
                                            <input type="submit" class="btn btn-success" id="submit" name="submit" value="Submit"/>
                                            <a href="{{ route('admin.schedule.list') }}" class="btn btn-dark">Back</a>
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
      if($("#client_id").val() == ""){
        $("#client_iderror").html("Client name is a require field.");
        $("#client_id").focus();
        return false;
      }else if($("#security_id").val() == ""){
        $("#emailerror").html("Security name is a require field.");
        $("#security_id").focus();
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