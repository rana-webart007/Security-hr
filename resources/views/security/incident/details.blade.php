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
                            $user = App\Models\User::whereId($data->guard_id)->first(); 
                    @endphp

                    <div class="text-end">
                        <input type="button" class="btn btn-primary" value="Print" onclick="printDetails()">
                        <a href="{{ url('security/incident/details/pdf/generate', $data->incident_id) }}" class="btn btn-danger">Generate PDF</a>
                    </div>

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
                                                    <td>{{ $data->location ? ($data->location) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Incident Date</td>
                                                    <td>{{ $data->incident_date ? ($data->incident_date) : "No Record Found"}}</td>
                                                </tr>	
                                                <tr>
                                                    <td>3</td>
                                                    <td>Incident Time</td>
                                                    <td>{{ $data->incident_time ? ($data->incident_time) : "No Record Found"}}</td>
                                                </tr>	
                                                <tr>
                                                    <td>4</td>
                                                    <td>Incident Category</td>
                                                    <td>{{ $data->incident_category ? ($data->incident_category) : "No Record Found"}}</td>
                                                </tr>	
                                                <tr>
                                                    <td>5</td>
                                                    <td>Incident Type</td>
                                                    <td>{{ $data->incident_type ? ($data->incident_type) : "No Record Found"}}</td>
                                                </tr>	
                                                <tr>
                                                    <td>6</td>
                                                    <td>Incident Details</td>
                                                    <td>{{ $data->incident_details ? ($data->incident_details) : "No Record Found"}}</td>
                                                </tr>
                                                @if($data->incident_img != "")
                                                <tr>
                                                    <td>7</td>
                                                    <td>Incident Image</td>
                                                    <td>
                                                        <a href="{{ asset('incident/img/'.$data->incident_img) }}" target="_blank"><img src="{{ asset('incident/img/'.$data->incident_img) }}" alt="img" height="150" width="125"></a>
                                                            <a href="{{ asset('incident/img/'.$data->incident_img) }}" download="" class="btn btn-primary btn-sm">Download</a>
                                                </td>
                                                </tr>	 
                                                @endif                 	
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                         <h2>Report</h2><hr>
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
                                                    <td>Reported By</td>
                                                    <td>{{ $data->reported_by ? ($data->reported_by) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Reported By Title</td>
                                                    <td>{{ $data->reported_by_title ? ($data->reported_by_title) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Reported By Phone</td>
                                                    <td>{{ $data->reported_by_phone ? ($data->reported_by_phone) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Reported By Email</td>
                                                    <td>{{ $data->reported_by_email ? ($data->reported_by_email) : "No Record Found"}}</td>
                                                </tr>	                         
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                         <h2>Weapon</h2><hr>
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
                                                    <td>Weapons</td>
                                                    <td>{{ $data->weapons ? ($data->weapons) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Type</td>
                                                    <td> {{ $data->weapon_type ? ($data->weapon_type) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Type (Other)</td>
                                                    <td>{{ $data->weapon_type_other ? ($data->weapon_type_other) : "No Record Found"}}</td>
                                                </tr>	                         
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                         <h2>Vehicle</h2>
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
                                                    <td>Type</td>
                                                    <td>{{ $data->vehicle_type ? ($data->vehicle_type) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Year</td>
                                                    <td>{{ $data->vehicle_year ? ($data->vehicle_year) : "No Record Found"}}</td>
                                                </tr>		                         
                                                <tr>
                                                    <td>3</td>
                                                    <td>Model</td>
                                                    <td>{{ $data->vehicle_model ? ($data->vehicle_model) : "No Record Found"}}</td>
                                                </tr>	
                                                <tr>
                                                    <td>4</td>
                                                    <td>Color</td>
                                                    <td>{{ $data->vehicle_color ? ($data->vehicle_color) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>License Plate</td>
                                                    <td>{{ $data->vehicle_license_plate ? ($data->vehicle_license_plate) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Notes</td>
                                                    <td>{{ $data->vehicle_notes ? ($data->vehicle_notes) : "No Record Found"}}</td>
                                                </tr>	
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                         <h2>Police</h2><hr>
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
                                                    <td>Report Number</td>
                                                    <td>{{ $data->police_report_number ? ($data->police_report_number) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Agency</td>
                                                    <td>{{ $data->police_agency ? ($data->police_agency) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Notified</td>
                                                    <td>{{ $data->police_notified ? ($data->police_notified) : "No Record Found"}}</td>
                                                </tr>	                         
                                                <tr>
                                                    <td>4</td>
                                                    <td>Officer Name</td>
                                                    <td>{{ $data->police_officer_name ? ($data->police_officer_name) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Officer Badge Name</td>
                                                    <td>{{ $data->police_officer_badge_number ? ($data->police_officer_badge_number) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Notified Time</td>
                                                    <td>{{ $data->police_notified_time ? ($data->police_notified_time) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td>Arrival Time</td>
                                                    <td>{{ $data->police_arrival_time ? ($data->police_arrival_time) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>8</td>
                                                    <td>Phone</td>
                                                    <td>{{ $data->police_phone ? ($data->police_phone) : "No Record Found"}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                          </div>
                        
                         <h2>Involved Person</h2><hr>

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
                                                    <td>Type</td>
                                                    <td>{{ ($data->involved_person_type) ?  ($data->involved_person_type) : "No Record Found" }}</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Name</td>
                                                    <td>{{ $data->involved_person_first_name ? ($data->involved_person_first_name) : "No Record Found"}} {{ ($data->involved_person_last_name) ? ($data->involved_person_last_name) : '' }}</td>
                                                </tr>	                         
                                                <tr>
                                                    <td>3</td>
                                                    <td>Emp. Id</td>
                                                    <td>{{ $data->involved_person_emp_id ? ($data->involved_person_emp_id) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Phone Number</td>
                                                    <td>{{ $data->involved_person_phone ? ($data->involved_person_phone) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Email</td>
                                                    <td>{{ $data->involved_person_email ? ($data->involved_person_email) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>DOB</td>
                                                    <td>{{ $data->involved_person_dob ? ($data->involved_person_dob) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td>Home Address</td>
                                                    <td>{{ $data->involved_person_home_address ? ($data->involved_person_home_address) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>8</td>
                                                    <td>Home City</td>
                                                    <td>{{ $data->involved_person_home_city ? ($data->involved_person_home_city) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>9</td>
                                                    <td>Home State</td>
                                                    <td> {{ $data->involved_person_home_state ? ($data->involved_person_home_state) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>10</td>
                                                    <td>Zip</td>
                                                    <td>{{ $data->involved_person_home_zip ? ($data->involved_person_home_zip) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>11</td>
                                                    <td>Country</td>
                                                    <td>{{ $data->involved_person_home_country ? ($data->involved_person_home_country) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>12</td>
                                                    <td>Sex</td>
                                                    <td>{{ $data->involved_person_sex ? ($data->involved_person_sex) : "No Record Found" }}</td>
                                                </tr>
                                                <tr>
                                                    <td>13</td>
                                                    <td>Height</td>
                                                    <td>{{ $data->involved_person_height ? ($data->involved_person_height) : "No Record Found" }}</td>
                                                </tr>
                                                <tr>
                                                    <td>14</td>
                                                    <td>Weight</td>
                                                    <td>{{ $data->involved_person_weight ? ($data->involved_person_weight) : "No Record Found" }}</td>
                                                </tr>
                                                <tr>
                                                    <td>15</td>
                                                    <td>Clothing</td>
                                                    <td>{{ $data->involved_person_clothing ? ($data->involved_person_clothing) : "No Record Found" }}</td>
                                                </tr>
                                                <tr>
                                                    <td>16</td>
                                                    <td>Hair Color</td>
                                                    <td>{{ ($data->involved_person_hair_color) ? ($data->involved_person_hair_color) : "No Record Found"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>17</td>
                                                    <td>Eye Color</td>
                                                    <td>{{ ($data->involved_person_eye_color) ? (($data->involved_person_eye_color)) : "No Record Found" }}</td>
                                                </tr>
                                                <tr>
                                                    <td>18</td>
                                                    <td>Tattoos</td>
                                                    <td>{{ ($data->involved_person_tattoos) ? ($data->involved_person_tattoos) : "No Record Found" }}</td>
                                                </tr>
                                                <tr>
                                                    <td>19</td>
                                                    <td>Piercings</td>
                                                    <td>{{ ($data->involved_person_piercings) ? ($data->involved_person_piercings) : "No Record Found" }}</td>
                                                </tr>
                                                <tr>
                                                    <td>20</td>
                                                    <td>Identification Type</td>
                                                    <td>{{ ($data->involved_person_identification_type) ? ($data->involved_person_identification_type) : "No Record Found" }}</td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Driver's License Number</td>
                                                    <td>{{ ($data->involved_person_drivers_license_no) ? ($data->involved_person_drivers_license_no) : "No Record Found" }}</td>
                                                </tr>
                                                <tr>
                                                    <td>22</td>
                                                    <td>Driver's License State</td>
                                                    <td>{{ ($data->involved_person_drivers_license_state) ? ($data->involved_person_drivers_license_state) : "No Record Found" }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                         <h2>Individual Details</h2><hr>
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
                                                    <td>SKU Code</td>
                                                    <td>{{ ($data->individual_sku_number) ? ($data->individual_sku_number) : "No Record Found" }}</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Description</td>
                                                    <td>{{ ($data->individual_description) ? ($data->individual_description) : "No Record Found" }}</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Unit Price</td>
                                                    <td>{{ ($data->individual_unit_price) ? ($data->individual_unit_price) : "No Record Found" }}</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Quantity</td>
                                                    <td>{{ ($data->individual_quantity) ? ($data->individual_quantity) : "No Record Found" }}</td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Item Category</td>
                                                    <td>{{ ($data->individual_item_category) ? ($data->individual_item_category) : "No Record Found" }}</td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Recovered</td>
                                                    <td>{{ ($data->individual_recovered) ? ($data->individual_recovered) : "No Record Found" }}</td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td>Damaged</td>
                                                    <td>{{ ($data->individual_damaged) ? ($data->individual_damaged) : "No Record Found" }}</td>
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
</div>

<!-- Script to print the content of a div -->
<script>
    function printDetails() {
        var divContents = document.getElementById("details_div").innerHTML;
        var a = window.open('', '', 'height=800, width=1200');
        a.document.write('<html>');
        a.document.write('<body >');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.print();
    }
</script>

<x-securityfooter/>