<x-securityheader/>
<div class="page-wrapper">
			<div class="page-content">			
                <div class="row">
                	<div class="col-12">
					<div id="map-canvas" style="height: 600px; width: 1200px"></div>
                	</div>
                </div>
            </div>
		</div> 
		<input type="hidden" value="{{ $client_id }}" id="client_id">
        <x-securityfooter/>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places,drawing&key=AIzaSyB2h5V1Jl9owOguijhl9Fy21uuAjlkKjpY"></script>
<script>
	$(document).ready(function(){
		getMap($("#client_id").val());
	})
</script>
