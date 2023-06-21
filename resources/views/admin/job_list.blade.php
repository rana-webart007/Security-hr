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
										<th>Client Name</th>
										<th>Guard Name</th>
                                        <th>Date</th>
										<th>Start time</th>
										<th>End time</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach($data as $val)
									<tr>
										<td>{{ $val -> security->name }}</td>
										<td>{{ $val -> client -> name }}</td>
										<td>{{ $val -> user -> name }}</td>
										<td>{{ date("m-d-Y", strtotime($val -> date)) }}</td>
										<td>{{ date("h:i a", strtotime($val -> start_time)) }}</td>
										<td>{{ date("h:i a", strtotime($val -> end_time)) }}</td>
										<td>
											<div class="d-flex order-actions">	
											<a href="{{ route('admin.schedule.update', ['updateid' => $val -> id]) }}" class=""><i class="bx bx-cog"></i></a>
											<a href="{{ route('admin.schedule.delete', ['deleteid'=> $val -> id]) }}" onclick="return confirm('Do you really want to delete this data?');" class="ms-4"><i class='bx bx-down-arrow-alt'></i></a>
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