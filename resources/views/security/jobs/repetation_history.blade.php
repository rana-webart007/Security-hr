<x-securityheader />

<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-md-6">
                <div class="ctpgafy">
                    <div class="dropdown mb-4 d-inline-block me-2">
                        <a class="nbbtn dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            All Categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                    <div class="dropdown mb-4 d-inline-block">
                        <a class="nbbtn dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
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
                                <th>Client Name</th>
                                <th>Security Name</th>
                                <th>Start date</th>
                                <th>End date</th>
                                <th>Extends For</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($history as $val)
                            <tr>
                                <td>{{ $client }}</td>
                                <td>{{ $security }}</td>
                                <td>{{ date('d-m-Y', strtotime($val->start_date)) }}</td>
                                <td>{{ date("d-m-Y", strtotime($val->end_date)) }}</td>
                                <td>{{ $val->repeat_for }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<x-securityfooter />