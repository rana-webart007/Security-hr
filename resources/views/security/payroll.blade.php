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
							<a href="{{ route('security.client.add') }}" class="mbnbtn"><i class='bx bx-plus me-2' ></i>New Client</a>
						</div>
					</div>
			  </div>	
				<div class="card radius-10">
					<div class="card-body">
						<div class="table-responsive">
							<span class="text-success">{{ Session::get('success') }}</span>
							<table class="table align-middle mb-0" id="example2">
								<thead class="table-light">
									<tr>
										<th>Name</th>
										<th>Email Id</th>
                                        <th>Mobile No</th>
										<th>Working Duration</th>
										<th>Break Time</th>
										<th>Working Hours</th>
										<th>Amount</th>
										<th>Print</th>
										
									</tr>
								</thead>
								<tbody>
                                    @foreach($data as $val)
									@php 
									$totalWorkingHour = round(($val['working_time_sec'] - $val['break_time_sec']) / 3600); 
									@endphp
									<tr>
										<td>{{ $val['name'] }}</td>
										<td>{{ $val['email'] }}</td>
										<td>{{ $val['mobile'] }}</td>
										<td>{{ $val['working_time_sec']?gmdate('H:i:s', $val['working_time_sec']):0 }}</td>
										<td>{{ $val['break_time_sec']?gmdate('H:i:s', $val['break_time_sec']):0 }}</td>
										<td>{{ gmdate('H:i:s',($val['working_time_sec'] - $val['break_time_sec'])) }}</td>
										<td>${{ number_format($totalWorkingHour * $val['amount'], 2) }}</td>
                                        <!-- <td>
											<a target="_blank" id='payroll_print'>
												<input type="button" value="print">
											</a>
										</td> -->
										

                                        <td><a target="_blank" href="{{ url('security/payroll/print', $val['id']) }}"><input type="button" value="print"></a></td>
									</tr>	
                                    @endforeach											
								</tbody>
							</table>
						</div>
					</div>
				</div>
            </div>
    </div>


	<script>
        document.getElementById("payroll_print").addEventListener("click", myFunction, false);

		function myFunction() {
		var id = document.getElementById("print_id").value;
		alert(id);
		}
	</script>
<x-securityfooter/>