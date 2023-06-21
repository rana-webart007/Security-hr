<x-securityheader />

<div class="page-wrapper">
    <div class="page-content">

        <style>
        #mapCanvas {
            width: 100%;
            height: 400px;
            background-color: burlywood;
        }
        </style>



        <!-- -->
        <!-- <div id="map-canvas" class="mb-3" style="height: 400px; width: 100%;">
        </div> -->

        @php
            $tracking_history = App\Models\GuardTrackingHistory::where('security_id',
            auth()->guard('security')->user()->id)
            ->where('client_id', $client_id)->where('job_id', $job_id)->get();

            foreach($tracking_history as $history){
            $coordinates1[] = [
            'lat' => explode(',', $history->guard_coordinate)[0],
            'lng' => explode(',', $history->guard_coordinate)[1]
            ];
        }
        @endphp

        <div class="map">            
            <div id="mapCanvas" class="mapping"></div>
        </div>

        <input type="hidden" id="client_id" value="{{ $client_id }}">
        <input type="hidden" id="job_id" value="{{ $job_id }}">

        <!-- -->

    </div>
</div>

<script
    src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places,drawing&key=AIzaSyB2h5V1Jl9owOguijhl9Fy21uuAjlkKjpY">
</script>

<!--- -->
<script>
var geocoder = new google.maps.Geocoder();
var address = "USA";

geocoder.geocode({
    'address': address
}, function(results, status) {

    // var locationId = lat + ',' + lng;

    var coordinates = [];
    <?php 
      foreach($tracking_history as $history){
        $coordinates = $history->guard_coordinate;
      }
    ?>

    coordinates.push(<?php echo $coordinates ?>);
    console.log(coordinates);


    /**
     * 
     */

    $("#address_map").val(coordinates);

    // generate the map here
    InitMap(coordinates[0], coordinates[1]);

    // latitude & logitude section
    $("#info").val(coordinates);

});
</script>




<!-- Multiple LOcation shown -->


<script>
function mappp(flag = "") {
    // alert(flag);

    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };

    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(50);


    var coordinates = [];

    if (flag == "") {
        <?php 
                 $tracking_history = $tracking_history;
            ?>
    } else {
        <?php  
                  $tracking_history = App\Models\GuardTrackingHistory::where('security_id', auth()->guard('security')->user()->id)
                  ->where('client_id', $client_id)->where('job_id', $job_id)->get();
            ?>
    }

    <?php 
      $all = [];
      $coordinates = [];

      foreach($tracking_history as $history){
        $coordinates[] = $history->guard_coordinate;
      }

      $all = $coordinates;
      $json_array = json_encode($all);
      
    ?>

    // var coordinates2 = [];
    coordinates = JSON.parse('<?php echo $json_array; ?>');
    // coordinates2.push(coordinates.split(","));


    // Multiple markers location, latitude, and longitude

    var markers = [];

    for (var i = 0; i < coordinates.length; i++) {
        markers.push(coordinates[i]);
    }

    console.log(markers);

    // var markers = [
    //     [22.590120, 88.408518],
    //     [22.576767, 88.412573],
    //     [22.501018, 88.348805],

    // ];

    // Info window content
    // var infoWindowContent = [
    //     ['<div class="info_content">' +
    // 	'<h5>Shalini Body Massage </h5>' +
    //     '<h6>Saltlake kalyan Jewelers</h6>' + '</div>'],
    //     ['<div class="info_content">' +
    // 	'<h5>Shalini Body Massage </h5>' +
    //     '<h6>Salt lake Quality more Anjali Jewelers</h6>' +
    //     '</div>'],
    //     ['<div class="info_content">' +
    // 	'<h5>Shalini Body Massage </h5>' +
    //     '<h6>Tollygaunge Menoka Cinama Hall</h6>' +
    //     '</div>'],
    // ];

    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(),
        marker, i;

    // Place each marker on the map  
    for (i = 0; i < markers.length; i++) {
        var position = new google.maps.LatLng(markers[i][0], markers[i][1]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            // title: markers[i][0]
        });

        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                // infoWindow.setContent(infoWindowContent[i][0]);
                // infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });

}
// Load initialize function
// google.maps.event.addDomListener(window, 'onload', initMap);
</script>


<!-- <script>
function mappp() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };

    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(50);


    var coordinates = [];
    

     coordinates = JSON.parse('');
    console.log("coordinates" + coordinates);

    // Multiple markers location, latitude, and longitude
    // var markers = [];

    //    for(var j=0; j<coordinates.length; j++){
    //       markers.push([coordinates[j]]);
    //    }

    //    console.log("markers - "+markers);

    var markers = [
        [22.590120, 88.408518],
        [15.2993, 74.1240],
        [19.0760, 72.8777],

    ];

    // Info window content
    // var infoWindowContent = [
    //     ['<div class="info_content">' +
    // 	'<h5>Shalini Body Massage </h5>' +
    //     '<h6>Saltlake kalyan Jewelers</h6>' + '</div>'],
    //     ['<div class="info_content">' +
    // 	'<h5>Shalini Body Massage </h5>' +
    //     '<h6>Salt lake Quality more Anjali Jewelers</h6>' +
    //     '</div>'],
    //     ['<div class="info_content">' +
    // 	'<h5>Shalini Body Massage </h5>' +
    //     '<h6>Tollygaunge Menoka Cinama Hall</h6>' +
    //     '</div>'],
    // ];

    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(),
        marker, i;

    // Place each marker on the map  
    for (i = 0; i < markers.length; i++) {
        var position = new google.maps.LatLng(markers[i][0], markers[i][1]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            // title: markers[i][0]
        });

        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                // infoWindow.setContent(infoWindowContent[i][0]);
                // infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });

}
// Load initialize function
// google.maps.event.addDomListener(window, 'onload', initMap);
</script> -->

<!-- -->


<script>
$(document).ready(function() {

    let interval = 10000; //60 seconds

    setInterval(function() {

        let client_id = document.getElementById('client_id').value;
        let job_id = document.getElementById('job_id').value;

        $.ajax({
            
            // url: window.location.href,
            url: "{{ route('security\cron-test') }}",
            type: 'GET',
            data: { // the data to send to the server
                client_id: client_id,
                job_id: job_id
            },
            success: function(data) {
                // console.log(data),
                //     // mappp(999);
                //     $('#map').load('security.view.active.guards.tracking');
                // // location.reload();
                $("#map").load("#map");
            }
        });
    }, interval);
});
</script>
<x-securityfooter />