<x-securityheader/>

<div class="page-wrapper">
			<div class="page-content">
				<div class="row">
					<div class="col-md-6">
					   <div class="ctpgafy">
						<div class="dropdown mb-4 d-inline-block me-2">
  							<a class="nbbtn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                             All Categories
                            </a>
					   <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                             <li><a class="dropdown-item" href="#">Action</a></li>
                             <li><a class="dropdown-item" href="#">Another action</a></li>
                             <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                        <div class="dropdown mb-4 d-inline-block">
  							<a class="nbbtn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                             All Categories
                            </a>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                             <li><a class="dropdown-item" href="#">Action</a></li>
                             <li><a class="dropdown-item" href="#">Another action</a></li>
                             <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                       </div>
				</div>
				<div class="col-md-6 text-end">
						<div class="ctpgbfy mb-3">
						   <div class="dropdown mb-4 d-inline-block me-2">
  							<a class="mbnbtn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><i class='bx bxs-note'></i> Export
                                   </a>
						    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                             		  <li><a class="dropdown-item" href="#">Action</a></li>
                             		  <li><a class="dropdown-item" href="#">Another action</a></li>
                             		  <li><a class="dropdown-item" href="#">Something else here</a></li>
                                  </ul>
                                 </div>
							<!-- <a href="{{ route('security.client.add') }}" class="mbnbtn"><i class='bx bx-plus me-2' ></i>New Client</a> -->
						</div>
					</div>
			  </div>	
				<div class="card radius-10">
					<div class="card-body">
						<div class="table-responsive">
							<span class="text-success">{{ Session::get('success') }}</span>
							
                            @php 
									$totalWorkingHour = round(($securityguard['working_time_sec'] - $securityguard['break_time_sec']) / 3600); 
							@endphp

                            <div id="all_details_1">
                                <h2> User Information </h2>

                                <p> Name: {{ $user->name }} </p>
                                <p> Email: {{ $user->email }} </p>
                                <p> Phone: {{ $user->mobile }} </p>
                                <p> Address: {{ $user->address }} </p>
                                
                                <h2> Working Information </h2>
                                
                                <p>Working Duration : {{ ($securityguard['working_time_sec']) ? gmdate('H:i:s', $securityguard['working_time_sec']) : 0 }} </p>
                                <p>Break Time : {{ ($securityguard['break_time_sec']) ? gmdate('H:i:s', $securityguard['break_time_sec']) : 0 }}</p>
                                <p>Working Hours : {{ gmdate('H:i:s',($securityguard['working_time_sec'] - $securityguard['break_time_sec'])) }}</p>
                                <p>Amount : ${{ number_format($totalWorkingHour * ($user->amount) , 2) }}</p>
                            </div>

                            <input type="button" class="btn btn-primary" value="Print" onclick="printDiv()">

						</div>
					</div>
				</div>
            </div>
    </div>

<x-securityfooter/>

<!-- <script>
    function printDiv() {
        var details = document.getElementById("all_details").innerHTML;

        var a = window.open('', '', 'height=1500, width=1500');
        a.document.write(details);
        a.print();
    }
</script> -->