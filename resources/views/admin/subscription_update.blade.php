<x-adminheader />
<div class="page-wrapper">
    <div class="page-content">
        <div class="row align-items-center justify-content-center">

        @if(Session::has('err_msg'))
            <div class="text-center m-2">
                <div class="bg-white p-2">   
                    <span class="text-danger">{{Session::get('err_msg')}}</span> 
                </div>
            </div>
          @endif


            <div class="col-md-6">
                <div class="card">

                    <div class="card-body">
                        <form action="{{ route('admin.subscription.update.success') }}" method="post" autocomplete="off"
                            onsubmit="return valid();">
                            <input type="hidden" name="update_id" value="{{ $data-> id }}">
                            @csrf
                            <div class="border p-3 rounded">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Subscription Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Subscription name" value="{{ $data -> name }}" />
                                    <span class="text-danger d-block pt-2" id="nameerror"></span>
                                    @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="details">Details</label>
                                    <textarea name="details" id="details" class="form-control"
                                        placeholder="Subscription Details">{{ $data -> details }}</textarea>
                                    <span class="text-danger d-block pt-2" id="detailserror"></span>
                                    @if ($errors->has('details'))
                                    <span class="text-danger">{{ $errors->first('details') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="amount">Amount</label>
                                    <input type="number" name="amount" id="amount" class="form-control"
                                        placeholder="Amount" value="{{ $data -> amount }}" />
                                    <span class="text-danger d-block pt-2" id="amounterror"></span>
                                    @if ($errors->has('amount'))
                                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="amount">Max. Guards</label>
                                    <input type="number" name="max_guards" id="max_guards" class="form-control"
                                        placeholder="max_guards" value="{{ $data->max_guards }}" />
                                    <span class="text-danger d-block pt-2" id="amounterror"></span>
                                    @if ($errors->has('max_guards'))
                                    <span class="text-danger">{{ $errors->first('max_guards') }}</span>
                                    @endif
                                </div>






                                <div class="mb-3">
                                    <label class="form-label" for="valid_type">Validity Type</label>
                                    <select name="valid_type" id="valid_type" class="form-control">
                                        @if($data->valid_type == "Year")
                                        <option value="{{ $data->valid_type }}">{{ $data->valid_type }}</option>
                                        <option value="Month">Month</option>
                                        @else
                                        <option value="{{ $data->valid_type }}">{{ $data->valid_type }}</option>
                                        <option value="Year">Year</option>
                                        @endif
                                    </select>

                                    <span class="text-danger d-block pt-2" id="valid_typeerror"></span>
                                    @if ($errors->has('valid_type'))
                                    <span class="text-danger">{{ $errors->first('valid_type') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="valid_for">Valid for</label>
                                    <input type="number" name="valid_for" id="valid_for" class="form-control"
                                        value="{{ $data -> valid_for }}" />
                                    <span class="text-danger d-block pt-2" id="valid_forerror"></span>
                                    @if ($errors->has('valid_for'))
                                    <span class="text-danger">{{ $errors->first('valid_for') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="extra_charge">Extra Charge ( If any )</label>
                                    <input type="number" name="extra_charge" id="extra_charge" class="form-control"
                                        placeholder="Extra Charge" value="{{ $data->extra_charge }}" />
                                    <span class="text-danger d-block pt-2" id="extra_chargeerror"></span>
                                    @if ($errors->has('extra_charge'))
                                    <span class="text-danger">{{ $errors->first('extra_charge') }}</span>
                                    @endif
                                </div>


                                <div class="sbg">
                                    <input type="submit" class="btn btn-success" id="submit" name="submit"
                                        value="Submit" />
                                    <a href="{{ route('admin.subscription.list') }}" class="btn btn-dark">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-adminfooter />
<script>
function valid() {
    if ($("#name").val() == "") {
        $("#nameerror").html("Subscription name is a require field.");
        $("#name").focus();
        return false;
    } else if ($("#details").val() == "") {
        $("#detailserror").html("Subscription details is a require field.");
        $("#details").focus();
        return false;
    } else if ($("#amount").val() == "") {
        $("#amounterror").html("Amount is a require field.");
        $("#amount").focus();
        return false;
    } else if ($("#valid_for").val() == "") {
        $("#valid_forerror").html("Valid for is a require field.");
        $("#valid_for").focus();
        return false;
    }
}
</script>