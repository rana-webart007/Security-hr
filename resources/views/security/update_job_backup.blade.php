<x-securityheader />
<div class="page-wrapper">
    <div class="page-content">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('security.job.update.success') }}" method="post" autocomplete="off"
                            onsubmit="return valid();">
                            <input type="hidden" name="updateid" id="updateid" value="{{ $data -> id }}">
                            @csrf
                            <div class="border p-3 rounded">
                                <div class="mb-3">
                                    <label class="form-label" for="client_id">Client name</label>

                                    <select name="client_id" id="client_id" class="form-control" >
                                        <option value="">Select</option>
                                        @foreach($client as $val)
                                        <option value="{{ $val -> id }}"
                                            {{ $data -> client_id  == $val -> id?'Selected':'' }}>{{ $val -> name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger d-block pt-2" id="client_iderror"></span>
                                    @if ($errors->has('client_id'))
                                    <span class="text-danger">{{ $errors->first('client_id') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="user_id">Security guard</label>

                                    <!-- -->
                                    <input type="text" name="security_guard" class="form-control"
                                        value="{{ $guard->name }}" readonly />
                                    <input type="hidden" name="user_id" value="{{ $guard->id }}">
                                    <!-- -->

                                    <span class="text-danger d-block pt-2" id="user_iderror"></span>
                                    @if ($errors->has('user_id'))
                                    <span class="text-danger">{{ $errors->first('user_id') }}</span>
                                    @endif
                                </div>

                                <!-- -->
                                <label for="" id="job_locations" style="">Select Job Locations</label>
                                <div id="map-canvas" class="mb-3" style="height: 400px; width: 100%; ">
                                </div>
                                <input type="hidden" id="user_address" name="user_address"
                                    value="{{ $guard->address }}" />
                                <input type="hidden" id="info" name="location_data" value="{{ $location }}" />
                                <input type="hidden" id="address_map" name="address_map" />
                                <!-- -->

                                <div class="mb-3">
                                    <label class="form-label" for="start_time">Start time</label>
                                    <input type="time" name="start_time" id="start_time" class="form-control"
                                        value="{{ date("H:i", strtotime($data -> start_time)) }}" />
                                    <span class="text-danger" id="start_timeerror"></span>
                                    @if ($errors->has('start_time'))
                                    <span class="text-danger">{{ $errors->first('start_time') }}</span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="end_time">End time</label>
                                    <input type="time" name="end_time" id="end_time" class="form-control"
                                        value="{{ date("H:i", strtotime($data -> end_time)) }}" />
                                    <span class="text-danger" id="end_timeerror"></span>
                                    @if ($errors->has('end_time'))
                                    <span class="text-danger">{{ $errors->first('end_time') }}</span>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="comments">Comments</label>
                                    <textarea name="comments" id="comments" class="form-control"
                                        placeholde="Comments"> {{ $data -> comments }}</textarea>
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
// to find latitude & longitude of a address
var address = document.getElementById('user_address').value;
var locations = document.getElementById('info').value;


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

        // latitude & logitude section
        // if (locations) {
        //     // InitMap(lat, lng);

        //     var map = new google.maps.Map(document.getElementById('address_map'), {
        //         zoom: 10,
        //         center: locationId // San Francisco
        //     });


        //     // //
        //     // // alert(locations);
        //     // var location_len = locations.split(',').length;
        //     // // var polygoneCoords = {};
        //     // var item, items = [];

        //     // for (i = 0; i < location_len; i++) {
        //     //     // var lat = location_len[i];
        //     //     // var lng = location_len[i+1];

        //     //     // polygoneCoords  = { lat : lat, lng : lng};

        //     //     item = {};
        //     //     item.lat = location_len[i];
        //     //     item.lng = location_len[i+1];
        //     //     items.push(item);
        //     // }

        //     // console.log(items);

        //     //

        //     // Construct the polygon
        //     var polygon = new google.maps.Polygon({
        //         paths: polygoneCoords,
        //         strokeColor: '#FF0000',
        //         strokeOpacity: 0.8,
        //         strokeWeight: 2,
        //         fillColor: '#FF0000',
        //         fillOpacity: 0.35
        //     });

        //     // Add the polygon to the map
        //     polygon.setMap(map);


    //     $("#info").val(locations);
    //     InitMap(lat, lng);

    // } else {
    //     $("#info").val(locationId);
    //     InitMap(lat, lng);
    // }

    InitMap(lat, lng);

    // 
} else {
    console.log(
        'Geocode was not successful for the following reason: ' +
        status);
}
});
</script>

<script>
function defaultAddress() {
    alert("Default Address");
}

function selectedAddress() {
    alert("selected Address");
}
</script>



<!-- google map location draw example -->