@php
    $data = Session::get('data');    
@endphp

<div class="page-wrapper">
    <div class="page-content">
        <div class="card radius-10">
            <div class="card-body">
                <div class="table-responsive">
                    <span class="text-success">{{ Session::get('success') }}</span>
                    
                    @php 
                            $user = App\Models\User::whereId($data['guard_id'])->first(); 
                    @endphp

                        <div id="details_div">
                           <h2> User Information </h2><hr>
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Key</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Guard Name</td>
                                                    <td>{{ $user->name }}</td>
                                                </tr>	                         
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                         <h2>Initial Information</h2><hr>

                         <div id="all_details_1">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Key</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Incident Location</td>
                                                    <td>{{ $data['location'] ? ($data['location']) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Incident Date</td>
                                                    <td>{{ $data['incident_date'] ? ($data['incident_date']) : "No Record Found"}}</td>
                                                </tr>	
                                                <tr>
                                                    <td>3</td>
                                                    <td>Incident Time</td>
                                                    <td>{{ $data['incident_time'] ? ($data['incident_time']) : "No Record Found"}}</td>
                                                </tr>	
                                                <tr>
                                                    <td>4</td>
                                                    <td>Incident Category</td>
                                                    <td>{{ $data['incident_category'] ? ($data['incident_category']) : "No Record Found"}}</td>
                                                </tr>	
                                                <tr>
                                                    <td>5</td>
                                                    <td>Incident Type</td>
                                                    <td>{{ $data['incident_type'] ? ($data['incident_type']) : "No Record Found"}}</td>
                                                </tr>	
                                                <tr>
                                                    <td>6</td>
                                                    <td>Incident Details</td>
                                                    <td>{{ $data['incident_details'] ? ($data['incident_details']) : "No Record Found"}}</td>
                                                </tr>
                                                                	
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                         

                         








                </div>

            </div>
        </div>
    </div>
</div>