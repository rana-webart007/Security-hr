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
			  @include('security.subscription.days_left')
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
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                 @if(sizeof($guards) > 0)
                                    @foreach($guards as $val)
                        
                                    @php
                                        $guard_details = App\Models\User::whereId($val->guard_id)->first();
                                        $parm_details = App\Models\GuardTrackingHistory::whereId($val->guard_id)->first();
                                    @endphp

									<tr>
										<td>{{ $guard_details->name }}</td>
										<td>{{ $guard_details->email }}</td>
										<td>{{ $guard_details->mobile}}</td>
										<td>
											<div class="d-flex order-actions">
                                                <a href="{{ route('security.view.active.guards.tracking', ['client_id' => $client_id, 'job_id' => $val->job_id]) }}" class=""><i class="bx bx-cog"></i></a>
											</div>
										</td>
									</tr>	
                                    @endforeach		
                                 @endif									
								</tbody>
							</table>
						</div>
					</div>
				</div>
            </div>
    </div>


<x-securityfooter/>