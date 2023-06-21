<x-securityheader />
<div class="page-wrapper">
    <div class="page-content">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('security.job.add.success') }}" method="post" autocomplete="off"
                            onsubmit="return valid();">
                            @csrf
                            <div class="border p-3 rounded">
                                <div class="mb-3">
                                    <label class="form-label" for="client_id">Client name</label>
                                    <select name="client_id" id="client_id" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($client as $val)
                                        <option value="{{ $val -> id }}"
                                            {{ old('client_id')  == $val -> id?'Selected':'' }}>{{ $val -> name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger d-block pt-2" id="client_iderror"></span>
                                    @if ($errors->has('client_id'))
                                    <span class="text-danger">{{ $errors->first('client_id') }}</span>
                                    @endif
                                </div>




                                <div class="form-group mb-3">
                                    <select id="all-address" class="form-control">
                                        <option value="">Select Address</option>
                                    </select>
                                </div>


                                 <!-- -->
                                 <label for="" id="job_locations" style="display:none">Select Job Locations</label>
                                <div id="map-canvas" class="mb-3" style="height: 400px; width: 100%; display:none">
                                </div>
                                <input type="hidden" id="info" name="location_data" />
                                <input type="hidden" id="address_map" name="address_map" />
                                <!-- -->


                                <input type="hidden" name="selected_address" id="selected_address">



                                <div class="mb-3">
                                    <label class="form-label" for="user_id">Security guard</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($guard as $val)
                                        <option value="{{ $val -> id }}"
                                            {{ old('user_id')  == $val -> id?'Selected':'' }}>{{ $val -> name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger d-block pt-2" id="user_iderror"></span>
                                    @if ($errors->has('user_id'))
                                    <span class="text-danger">{{ $errors->first('user_id') }}</span>
                                    @endif
                                </div>


                               

                                <div class="mb-3">
                                    <label class="form-label" for="start_time">Start time</label>
                                    <input type="time" name="start_time" id="start_time" class="form-control"
                                        value="{{ old('start_time') }}" />
                                    <span class="text-danger" id="start_timeerror"></span>
                                    @if ($errors->has('start_time'))
                                    <span class="text-danger">{{ $errors->first('start_time') }}</span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="end_time">End time</label>
                                    <input type="time" name="end_time" id="end_time" class="form-control"
                                        value="{{ old('end_time') }}" />
                                    <span class="text-danger" id="end_timeerror"></span>
                                    @if ($errors->has('end_time'))
                                    <span class="text-danger">{{ $errors->first('end_time') }}</span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="comments">Comments</label>
                                    <textarea name="comments" id="comments" class="form-control"
                                        placeholde="Comments"> {{ old('comments') }}</textarea>
                                    <span class="text-danger" id="commentserror"></span>
                                    @if ($errors->has('comments'))
                                    <span class="text-danger">{{ $errors->first('comments') }}</span>
                                    @endif
                                </div>

                                <div class="sbg">
                                    <input type="submit" class="btn btn-success" id="submit" name="submit"
                                        value="Submit" />
                                    <a href="{{ route('security.guard.list') }}" class="btn btn-dark">Back</a>
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
<script>
function valid() {
    if ($("#client_id").val() == "") {
        $("#client_iderror").html("Client name is a require field.");
        $("#client_id").focus();
        return false;
    } else if ($("#security_id").val() == "") {
        $("#emailerror").html("Security name is a require field.");
        $("#security_id").focus();
        return false;
    } else if ($("#mobile").val() == "") {
        $("#mobileerror").html("Mobile no is a require field.");
        $("#mobile").focus();
        return false;
    } else if ($("#address").val() == "") {
        $("#addresserror").html("Address is a require field.");
        $("#address").focus();
        return false;
    }
}
</script>

<!-- ajax call on guards change -->

<!-- for google map -->

<script
    src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places,drawing&key=AIzaSyB2h5V1Jl9owOguijhl9Fy21uuAjlkKjpY">
</script>

<script>
// $('#user_id').on('change', function() { // for user address 
$('#all-address').on('change', function() { // for client address
    var dropdownValue = $(this).val();

    if (dropdownValue != "") {
        $.ajax({
            url: "{{ route('fetch-user-details') }}",
            method: 'GET',
            data: {
                value: dropdownValue,
                // _token: "{{ csrf_token() }}"
            },
            success: function(response) {

                // to find latitude & longitude of a address
                var address = response.data;
                document.getElementById('map-canvas').style.display = "block";
                document.getElementById('job_locations').style.display = "block";

                document.getElementById('selected_address').value = address;

                var geocoder = new google.maps.Geocoder();

                geocoder.geocode({
                    'address': address
                }, function(results, status) {
                    if (status === 'OK') {
                        var lat = results[0].geometry.location.lat();
                        var lng = results[0].geometry.location.lng();

                        var locationId = lat + ',' + lng;
                        console.log(locationId);

                        $("#address_map").val(locationId);

                        // generate the map here
                        InitMap(lat, lng);

                        // latitude & logitude section
                        $("#info").val(locationId);
                    } else {
                        console.log(
                            'Geocode was not successful for the following reason: ' +
                            status);
                    }
                });

                // alert(response.data);
            },
            error: function(xhr) {
                // Handle errors here
                alert("Something Went wrong, PLease try after sometime");
            }
        });
    } else {
        document.getElementById('map-canvas').style.display = "none";
        document.getElementById('job_locations').style.display = "none";
        setTimeout(display_alert, 500);
        return false;
    }
});

// to display the alert after 500 milisec

function display_alert() {
    alert("Please select a Address");
}
</script>


<!-- for client's dynamic address -->
<script>
$("[name='client_id']").on("change", function(e) {
    let id = $(this).val();

    if (id != "") {
        $.ajax({
            url: '{{ url("security/fetch-clients-address")}}',
            method: 'GET',
            data: {
                id: id
            },
            success: function(response) {
                console.log(response.alternate_id);

                $('#all-address').html('<option value="">Select Address</option>');
                if (typeof(response.address) == "string") {
                    $("#all-address").append('<option value="' + response
                        .address + '">' + response.address + '</option>');
                } else {
                    $.each(response.address, function(key, value) {
                        $("#all-address").append('<option value="' + value
                            .address + '">' + value.address + '</option>');
                    });
                }

            },
            error: function(response) {}
        });
    } else {
        alert("Please Select a Client First");
        $("#all-address").append('<option value=""></option>');
    }


});
</script>