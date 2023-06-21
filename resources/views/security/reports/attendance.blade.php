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
                                        <th>Date</th>
                                        <th>Client</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Work Hour</th>
										<!-- <th>Print</th> -->
									</tr>
								</thead>
								<tbody>
                                    @foreach($users as $user)

                                        @php
                                            $from_time = strtotime($user->jst); 
                                            $to_time = strtotime($user->jet); 
                                            $diff_minutes = round(abs($from_time - $to_time) / (60 * 60),2). " hr";
                                        @endphp

                                   		<tr>
                                            <td>{{ $user->user_name }}</td>
                                            <td>{{ Carbon\Carbon::parse($user->jd)->format('d-m-Y') }}</td>
                                            <td>{{ $user->client_name }}</td>
                                            <td>{{ $user->jst }}</td>
                                            <td>{{ $user->jet }}</td>
                                            <td>{{ $diff_minutes }}</td>
                                            <!-- <td>
                                                <div class="d-flex order-actions">
                                                    <a href="#" ><button class="btn btn-dark"> Print </button></a>
                                                </div>
                                            </td> -->
                                        </tr>
                                    @endforeach					
								</tbody>
							</table>
						</div>
					</div>
				</div>
            </div>
    </div>


<x-securityfooter/>