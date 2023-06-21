<x-adminheader/>
<div class="page-wrapper">
			<div class="page-content">
				
				<div class="card radius-10">
					<div class="card-body">
						<div class="table-responsive">
							<span class="text-success">{{ Session::get('success') }}</span>
							<span class="text-danger">{{ Session::get('errmsg') }}</span>
							<table class="table align-middle mb-0" id="example2">
								<thead class="table-light">
									<tr>
										<th>Security Company</th>
										<th>Name</th>
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
										<td>{{ $val -> security->name }}</td>
										<td>{{ $val -> name }}</td>
										<td>{{ $val -> mobile}}</td>
										<td>{{ $val -> contact_person }}</td>
										<td>{{ $val -> phone_no }}</td>
										<td>{{ $val -> address }}</td>
										<td>
											<div class="d-flex order-actions">	
											<a href="{{ route('admin.client.update', ['updateid' => $val -> id]) }}" class=""><i class="bx bx-cog"></i></a>
											<a href="{{ route('admin.client.delete', ['deleteid'=> $val -> id]) }}" onclick="return confirm('Do you really want to delete this data?');" class="ms-4"><i class='bx bx-down-arrow-alt'></i></a>
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
<x-adminfooter/>