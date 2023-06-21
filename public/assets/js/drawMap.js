var mapOptions;
var map;

var coordinates = []
let new_coordinates = []
let lastElement

function InitMap(lat, lng) {
    var location = new google.maps.LatLng(lat, lng)
    mapOptions = {
        zoom: 18,
        center: location,
        mapTypeId: google.maps.MapTypeId.RoadMap
    }
    
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions)
    var all_overlays = [];
    var selectedShape;
    var drawingManager = new google.maps.drawing.DrawingManager({
        //drawingMode: google.maps.drawing.OverlayType.MARKER,
        //drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: [
                //google.maps.drawing.OverlayType.MARKER,
                //google.maps.drawing.OverlayType.CIRCLE,
                google.maps.drawing.OverlayType.POLYGON,
                //google.maps.drawing.OverlayType.RECTANGLE
            ]
        },
        markerOptions: {
            //icon: 'images/beachflag.png'
        },
        circleOptions: {
            fillColor: '#ffff00',
            fillOpacity: 0.2,
            strokeWeight: 3,
            clickable: false,
            editable: true,
            zIndex: 1
        },
        polygonOptions: {
            clickable: true,
            draggable: false,
            editable: true,
            // fillColor: '#ffff00',
            fillColor: '#ADFF2F',
            fillOpacity: 0.5,

        },
        rectangleOptions: {
            clickable: true,
            draggable: true,
            editable: true,
            fillColor: '#ffff00',
            fillOpacity: 0.5,
        }
    });

    function clearSelection() {
        if (selectedShape) {
            selectedShape.setEditable(false);
            selectedShape = null;
        }
    }
    //to disable drawing tools
    function stopDrawing() {
        drawingManager.setMap(null);
    }

    function setSelection(shape) {
        clearSelection();
        stopDrawing()
        selectedShape = shape;
        shape.setEditable(true);
    }

    function deleteSelectedShape() {
        if (selectedShape) {
            selectedShape.setMap(null);
            drawingManager.setMap(map);
            coordinates.splice(0, coordinates.length)
            document.getElementById('info').innerHTML = ""
        }
    }

    function CenterControl(controlDiv, map) {

        // Set CSS for the control border.
        var controlUI = document.createElement('div');
        controlUI.style.backgroundColor = '#fff';
        controlUI.style.border = '2px solid #fff';
        controlUI.style.borderRadius = '3px';
        controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUI.style.cursor = 'pointer';
        controlUI.style.marginBottom = '22px';
        controlUI.style.textAlign = 'center';
        controlUI.title = 'Select to delete the shape';
        controlDiv.appendChild(controlUI);

        // Set CSS for the control interior.
        var controlText = document.createElement('div');
        controlText.style.color = 'rgb(25,25,25)';
        controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlText.style.fontSize = '16px';
        controlText.style.lineHeight = '38px';
        controlText.style.paddingLeft = '5px';
        controlText.style.paddingRight = '5px';
        controlText.innerHTML = 'Delete Selected Area';
        controlUI.appendChild(controlText);

        //to delete the polygon
        controlUI.addEventListener('click', function () {
            deleteSelectedShape();
        });
    }

    drawingManager.setMap(map);

    var getPolygonCoords = function (newShape) {

        coordinates.splice(0, coordinates.length)

        var len = newShape.getPath().getLength();

        for (var i = 0; i < len; i++) {
            coordinates.push(newShape.getPath().getAt(i).toUrlValue(6))
        }
        document.getElementById('info').value = coordinates      
    }

    google.maps.event.addListener(drawingManager, 'polygoncomplete', function (event) {
        event.getPath().getLength();
        google.maps.event.addListener(event, "dragend", getPolygonCoords(event));

        google.maps.event.addListener(event.getPath(), 'insert_at', function () {
            getPolygonCoords(event)
            
        });

        google.maps.event.addListener(event.getPath(), 'set_at', function () {
            getPolygonCoords(event)
        })
    })

    google.maps.event.addListener(drawingManager, 'overlaycomplete', function (event) {
        all_overlays.push(event);
        if (event.type !== google.maps.drawing.OverlayType.MARKER) {
            drawingManager.setDrawingMode(null);

            var newShape = event.overlay;
            newShape.type = event.type;
            google.maps.event.addListener(newShape, 'click', function () {
                setSelection(newShape);
            });
            setSelection(newShape);
        }
    })

    var centerControlDiv = document.createElement('div');
    var centerControl = new CenterControl(centerControlDiv, map);

    
    centerControlDiv.index = 1;
    map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(centerControlDiv);

}

function getMap(client_id) {  

    $.ajax({
        type: 'GET',
        url: '/security/get-location',
        data: 'client_id='+client_id,
        success: function(data){
            var locationData = data.split(",");
            var map = new google.maps.Map(document.getElementById('map-canvas'), {
                center: {
                    lat: Number(locationData[0]),
                    lng: Number(locationData[1])
                },
                zoom: 18,
                mapTypeId: google.maps.MapTypeId.RoadMap
            });  


            navigator.geolocation.getCurrentPosition(
                function (position) {        
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;                     
                    var myLatLng = {
                        lat,
                        lng,
                    };                  
                   
                    var marker = new google.maps.Marker({
                        position: myLatLng,
                        map: map
                    });
                   
                },
                function errorCallback(error) {
                    console.log(error);
                }
                ); 


                var BucaramangaDelimiters = [
                    { lng: Number(locationData[3]),  lat: Number(locationData[2]) },
                    { lng: Number(locationData[5]),  lat: Number(locationData[4]) },
                    { lng: Number(locationData[7]),  lat: Number(locationData[6]) },
                    { lng: Number(locationData[9]),  lat: Number(locationData[8]) }
                ];

                var secondmarker = [
                    {lat: Number(locationData[2]), lng: Number(locationData[3]) },
                    {lat: Number(locationData[4]), lng: Number(locationData[5]) },
                    {lat: Number(locationData[6]), lng: Number(locationData[7]) },
                    {lat: Number(locationData[8]), lng: Number(locationData[9]) }
                ];

                var marker = new google.maps.Marker({
                    position: secondmarker,
                    map: map
                });

              

                // Construct the polygon.
                var BucaramangaPolygon = new google.maps.Polygon({
                    paths: BucaramangaDelimiters,
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 3,
                    fillColor: '#FF0000',
                    fillOpacity: 0.35
                });
                // Draw the polygon on the desired map instance
                BucaramangaPolygon.setMap(map);           
        }
    })

}
