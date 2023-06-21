<x-securityheader />
<div class="page-wrapper">
    <div class="page-content">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('security.client.update.success') }}" method="post" autocomplete="off"
                            onsubmit="return valid()">
                            <input type="hidden" name="updateid" id="updateid" value="{{ $data -> id }}">
                            @csrf
                            <div class="border p-3 rounded">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Building Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Building name" value="{{ $data -> name }}" />
                                    <span class="text-danger d-block pt-2" id="nameerror"></span>
                                    @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email ID</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Email id" value="{{ $data -> email }}" />
                                    <span class="text-danger d-block pt-2" id="emailerror"></span>

                                    @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="mobile">Mobile no</label>
                                    <input type="text" name="mobile" id="mobile" class="form-control"
                                        placeholder="Mobile no" value="{{ $data -> mobile }}" />
                                    <span class="text-danger d-block pt-2" id="mobileerror"></span>

                                    @if ($errors->has('mobile'))
                                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="contact_person">Contact person</label>
                                    <input type="text" name="contact_person" id="contact_person" class="form-control"
                                        placeholder="Contact person" value="{{ $data -> contact_person }}" />
                                    <span class="text-danger d-block pt-2" id="namecontactperson"></span>
                                    @if ($errors->has('contact_person'))
                                    <span class="text-danger">{{ $errors->first('contact_person') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="phone_no">Phone no</label>
                                    <input type="text" name="phone_no" id="phone_no" class="form-control"
                                        placeholder="Phone no" value="{{ $data -> phone_no }}" />
                                    <span class="text-danger d-block pt-2" id="phoneerror"></span>

                                    @if ($errors->has('phone_no'))
                                    <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="address">Address</label>
                                    <input type="text" name="address" id="address" class="form-control"
                                        placeholder="Address" value="{{ $data->address }}" />
                                    <span class="text-danger d-block pt-2" id="addresserror"></span>
                                    @if ($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>

                                <!-- Add More -->
                                <div class="text-end pt-1">
                                    <a href="#" id="more_address"><i class='bx bx-plus me-2'></i>Add More Address</a>
                                </div>

                                <div id="new-address" class="mb-3">
                                        
                                </div>

                                <!-- -->




                                <!-- -->

                                @if(sizeof($branch_addresses) > 0)
                                <div class="col-md-10">
                                    <label class="form-label" for="address">More Address</label>
                                </div>

                                @foreach($branch_addresses as $key => $branch_address)
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="text" name="more_address[]" id="more_address"
                                            class="form-control mt-2" placeholder="Address"
                                            value="{{ $branch_address->address }}" />

                                        <input type="hidden" name="more_address_id[]" value="{{ $branch_address->id }}">

                                        <span class="text-danger d-block pt-2" id="more_address_error"></span>
                                        @if ($errors->has('more_address'))
                                        <span class="text-danger">{{ $errors->first('more_address') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <a href="{{ url('security/client-multiple-address-delete', $branch_address->id) }}"
                                            id="more_add_check_0"><i class='bx bx-trash fa-2x mr-2 mt-1'></i></a>
                                    </div>
                                </div>
                                @endforeach
                                @endif

                                <!-- -->

                                <div id="map-canvas" class="mb-3" style="height: 400px; width: 100%"></div>
                                <input type="hidden" id="info" name="location_data"
                                    value="{{ $data -> location_data }}" />
                                <input type="hidden" id="address_map" name="address_map"
                                    value="{{ $data -> address_map }}" />

                                <div class="sbg">
                                    <input type="submit" class="btn btn-success" id="submit" name="submit"
                                        value="Submit" />
                                    <a href="{{ route('security.client.list') }}" class="btn btn-dark">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-securityfooter />
<script
    src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places,drawing&key=AIzaSyB2h5V1Jl9owOguijhl9Fy21uuAjlkKjpY">
</script>


<script>
$(document).ready(function() {
    $("#map-canvas").hide();
    var autocomplete;
    autocomplete = new google.maps.places.Autocomplete((document.getElementById('address')), {
        types: ['geocode'],
    });

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var near_place = autocomplete.getPlace();
        $("#map-canvas").show();
        var locationId = near_place.geometry.location.lat() + ',' + near_place.geometry.location.lng();
        $("#address_map").val(locationId);
        InitMap(near_place.geometry.location.lat(), near_place.geometry.location.lng());
    });
})


function valid() {
    if ($("#name").val() == "") {
        $("#nameerror").html("Building name is a require field.");
        $("#name").focus();
        return false;
    } else if ($("#email").val() == "") {
        $("#emailerror").html("Email id is a require field.");
        $("#email").focus();
        return false;
    } else if ($("#mobile").val() == "") {
        $("#mobileerror").html("Mobile no is a require field.");
        $("#mobile").focus();
        return false;
    } else if ($("#contact_person").val() == "") {
        $("#namecontactperson").html("Contact person name is a require field.");
        $("#contact_person").focus();
        return false;
    } else if ($("#phone_no").val() == "") {
        $("#phoneerror").html("Phone no is a require field.");
        $("#phone_no").focus();
        return false;
    } else if ($("#address").val() == "") {
        $("#addresserror").html("Address is a require field.");
        $("#address").focus();
        return false;
    }
}
</script>


<!-- Add more address field -->

<script>
$(function() {
  $("#more_address").click(function(e) {
    e.preventDefault();
    $("#new-address").append('<input type="text" id="address" class="form-control mt-2" placeholder="Address" name="add_more_address[]">');
  });
});
</script>

<!-------- -------------->