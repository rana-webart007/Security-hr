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
                        <a class="mbnbtn dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false"><i class='bx bxs-note'></i> Export
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                    <a href="{{ route('security.job.add') }}" class="mbnbtn"><i class='bx bx-plus me-2'></i>New
                        Schedule</a>
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
                                <th>Client name</th>
                                <th>Security guard</th>
                                <th>Date</th>
                                <th>Start time</th>
                                <th>End time</th>
                                <th>Extends For</th>
                                <th>Extention History</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $val)
                            @if($val->client != null && $val->user != null)

                            @php
                                $days_for_show = ["1", "7", "15", "30", "45"];  // This array is for no. of days of repetation.
 
                                $job_repeat_hisory = App\Models\JobsRepeateHistory::where('job_id', $val->id)
                                ->orderBy('id', 'desc')->first();
                            @endphp

                            <tr>
                                <td>{{ $val->client->name }}</td>
                                <td>{{ $val->user->name }}</td>
                                <td>{{ date('d-m-Y', strtotime($val -> date)) }}</td>
                                <td>{{ date("h:i a", strtotime($val -> start_time)) }}</td>
                                <td>{{ date("h:i a", strtotime($val -> end_time)) }}</td>
                                <td>

                                    <select name="extend_for" id="extend_for" onchange="return exchange()">
                                        @if($job_repeat_hisory == null)
                                        <option value="Extends For">Extends For</option>
                                            @foreach($days_for_show as $day)
                                            <option value="{{$val->id}}/{{ $day }}">{{ $day }} Days</option>
                                            @endforeach
                                        @else
                                        <option value="{{$val->id}}/{{ explode(' ', $job_repeat_hisory->repeat_for)[0]}}">{{ $job_repeat_hisory->repeat_for }}</option>
                                            @foreach($days_for_show as $day)
                                            @if($day != explode(' ', $job_repeat_hisory->repeat_for)[0])
                                                <option value="{{$val->id}}/{{ $day }}">{{ $day }} Days</option>
                                            @endif
                                            @endforeach
                                        @endif
                                    </select>

                                </td>

                                <td>
                                    <div class="text-center">
                                    <a href="{{ route('security.job.repetation.history', ['client' => $val->client->name, 'security' => $val->user->name, 'job_id' => $val->id]) }}" class="btn btn-dark">check</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex order-actions"> <a
                                            href="{{ route('security.job.update', ['updateid'=> $val -> id]) }}"
                                            class=""><i class="bx bx-cog"></i></a>
                                        <a href="{{ route('security.job.delete', ['deleteid'=> $val -> id ]) }}"
                                            onclick="return confirm('Do you really want to delete this data?')"
                                            class="ms-4"><i class='bx bx-down-arrow-alt'></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<x-securityfooter />


<script>
$("[name='extend_for']").on("change", function(e) {
    let extension = $(this).val();

    if (extension != "Extends For") {
        window.location.href = window.location.origin + '/security/repeat-job/' + extension;
    }
});
</script>