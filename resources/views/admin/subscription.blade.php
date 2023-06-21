<x-adminheader />
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">

            <div class="col-md-12 text-end">
                <div class="ctpgbfy mb-3">
                    <a href="{{ route('admin.subscription.add') }}" class="mbnbtn"><i class='bx bx-plus me-2'></i>New
                        Subscription</a>

                    <a href="{{ route('admin.settings.update', 'security-free-trial-days') }}" class="mbnbtn"><i class='bx bx-plus me-2'></i>Manage Free Trial Days</a>
                    <a href="#" class="mbnbtn"><i class='bx bx-plus me-2'></i>Manage Guards (For Free Trial) </a>

                </div>
            </div>
		</div>

            <div class="card radius-10">
                <div class="card-body">
                    <div class="table-responsive">
                        <span class="text-success">{{ Session::get('success') }}</span>
                        <span class="text-danger">{{ Session::get('errmsg') }}</span>
                        <table class="table align-middle mb-0" id="example2">
                            <thead class="table-light">
                                <tr>
                                    <th>Subscription Name</th>
                                    <th>Details</th>
                                    <th>Valid For</th>
                                    <th>Max. Guards</th>
                                    <th>Amount</th>
                                    <th>Extra Amount</th>
                                    <th>Total Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $val)
                                <tr>
                                    <td>{{ $val -> name }}</td>
                                    <td>{{ $val -> details }}</td>

                                    <!--<td>{{ $val -> valid_for > 1?$val -> valid_for." Months": $val -> valid_for." Month" }}</td>-->
                                    <td>{{ $val -> valid_for }} {{$val->valid_type}}</td>
                                    <td> {{ $val->max_guards }} </td>
                                    <td>${{ number_format($val -> amount, 2) }}</td>
                                    <td>${{ number_format($val -> extra_charge, 2) }}</td>
                                    <td>${{ number_format($val -> total_amount, 2) }}</td>
                                    <td>
                                        <div class="d-flex order-actions"> <a
                                                href="{{ route('admin.subscription.update', ['updateid'=> $val -> id]) }}"
                                                class=""><i class="bx bx-cog"></i></a>
                                            <a href="{{ route('admin.subscription.delete', ['deleteid'=> $val -> id]) }}"
                                                class="ms-4"><i class='bx bx-down-arrow-alt'></i></a>
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
    <x-adminfooter />