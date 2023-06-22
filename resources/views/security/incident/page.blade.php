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
                                <th>#</th>
                                <th>Guard Name</th>
                                <th>Incident Location</th>
                                <th>Incident Date</th>
                                <th>Incident Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $val)
                            @php
                                $user = App\Models\User::whereId($val->guard_id)->first();    
                            @endphp

                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $val -> location }}</td>
                                <td>{{ $val -> incident_date }}</td>
                                <td>{{ $val -> incident_time }}</td>
                                <td>
                                   <a href="{{ url('security/incident/reports/details', $val->incident_id) }}" class="btn btn-dark">Details</a>
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