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
										<th>Contact Person</th>
										<th>Phone no</th>
										<th>Address</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach($data as $val)
									<tr>
										<td>{{ $val -> name }}</td>
										<td>{{ $val -> email }}</td>
										<td>{{ $val -> mobile}}</td>
										<td>{{ $val -> contact_person }}</td>
										<td>{{ $val -> phone_no }}</td>
										<td>{{ $val -> address }}</td>
										<td>
											<div class="d-flex order-actions">	<a href="{{ route('security.client.update', ['updateid'=> $val -> id]) }}" class=""><i class="bx bx-cog"></i></a>
												<a onclick='return confirm("Do you really want to delete this data?")' href="{{ route('security.client.delete', ['deleteid' => $val -> id ]) }}" class="ms-4"><i class='bx bx-down-arrow-alt'></i></a>
											</div>
										</td>
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