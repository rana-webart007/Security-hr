<x-securityheader/>

@php
    $data = Session::get('data');    
@endphp

<div class="page-wrapper">
    <div class="page-content">
        <div class="card radius-10">
            <div class="card-body">
                <div class="table-responsive">
                    <span class="text-success">{{ Session::get('success') }}</span>
                    
                    

                        <div id="details_div">
                           <h2> All Notifications </h2><hr>
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Guard Name</th>
                                                    <th>Message</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach ($notifications as $key => $notification)
                                                @php 
                                                        $user = App\Models\User::whereId($notification->guard_id)->first(); 
                                                @endphp

                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{!! $notification->message !!}</td>
                                                    <td><a href="#" class="btn btn-primary btn-sm">Mark As Read</a></td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

            </div>
        </div>
    </div>
</div>

<x-securityfooter/>