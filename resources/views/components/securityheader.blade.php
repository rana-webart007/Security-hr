<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
	<!--plugins-->
	<link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('assets/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
	<script src=" {{ asset('assets/js/jquery.min.js') }}"></script>
	<script src=" {{ asset('assets/js/drawMap.js') }}"></script>
	<title>{{ __('Security HR') }} @if($notifications_no > 0) ({{ $notifications_no }} Notifications) @endif</title>
</head>

<!-- mappp -->
@php
     $onload_segment = request()->segment(5);
	 
	 if($onload_segment == "tracking"){
           $return_fun = "mappp()";
	 }else{
		   $return_fun = "printDiv()";
	 }
@endphp

<body class="bg-theme bg-theme2" onload="{{ $return_fun }}">
@php
        $check = Session::get('dayLeft');
@endphp

<!---  For Print --->
<script>
    function printDiv() {
		setTimeout(printPage, 1000)
    }

	function printPage(){
		var details = document.getElementById("all_details").innerHTML;
		if(details != null){
			var a = window.open('', '', 'height=1500, width=1500');
			a.document.write(details);
			a.print();
		}
	}
</script>





	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			
			<div class="sidebar-header">
				<div>
					<img src="{{ asset('assets/images/icon.png') }}" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Security HR</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li class="d-none">
					<a href="{{ route('security.dashboard') }}" class="has-arrow">
						<div class="parent-icon"><i class='bx bxs-home'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
					<ul>
						<li> <a href="index.html"><i class="bx bx-right-arrow-alt"></i>eCommerce</a>
						</li>
						<li> <a href="index2.html"><i class="bx bx-right-arrow-alt"></i>Analytics</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="{{ route('security.dashboard') }}">
						<div class="parent-icon"><i class='bx bxs-home'></i>
						</div>
						<div class="menu-title">{{ __('Dashboard') }}</div>
					</a>
				</li>
				<li>
					<a href="{{ route('security.client.list') }}">
						<div class="parent-icon"><i class='bx bxs-user'></i>
						</div>
						<div class="menu-title">{{ __('Clients') }}</div>
					</a>
				</li>		

				<li>
					<a href="{{ route('security.guard.list') }}">
						<div class="parent-icon"><i class="fa-solid fa-map-location-dot"></i>
						</div>
						<div class="menu-title">{{ __('Security Guards') }}</div>
					</a>					
				</li>

				<li>
					<a href="{{ route('security.job.list') }}">
						<div class="parent-icon"><i class="fa-solid fa-map-location-dot"></i>
						</div>
						<div class="menu-title">{{ __('Job Scheduler') }}</div>
					</a>					
				</li>
				<li>
					<a href="{{ route('security.tracking.list') }}">
						<div class="parent-icon"><i class="fa-solid fa-map-location-dot"></i>
						</div>
						<div class="menu-title">{{ __('Tracker') }}</div>
					</a>
				</li>
				<li>
					<a href="{{ route('security.reports') }}">
						<div class="parent-icon"><i class='bx bx-edit'></i>
						</div>
						<div class="menu-title">{{ __('Reports') }}</div>
					</a>
				</li>
				<li>
					<a href="{{ route('security.payroll') }}">
						<div class="parent-icon"><i class="fa-solid fa-money-bill"></i>
						</div>
						<div class="menu-title">{{ __('Payroll') }}</div>
					</a>
				</li>


				<!-- Subscription for testing -->
				@if($check['guard_checking_key'] != 0)
				<li>
					<a href="{{ url('security/plans') }}">
						<div class="parent-icon"><i class="fa-solid fa-money-bill"></i>
						</div>
						<div class="menu-title">{{ __('Subscription') }}</div>
					</a>
				</li>
				@endif
				<!-- -->

				<!-- incident report -->
				<li>
					<a href="{{ url('security/incident/reports') }}">
						<div class="parent-icon"><i class="fa-solid fa-money-bill"></i>
						</div>
						<div class="menu-title">{{ __('Incident Report') }}</div>
					</a>
				</li>

				<li>
					<a href="javascript:void(0)">
						<div class="parent-icon"><i class='bx bxs-cog' ></i>
						</div>
						<div class="menu-title">{{ __('Setting') }}</div>
					</a>
				</li>
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center" id="nav_div">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="search-bar flex-grow-1">
						<div class="position-relative search-bar-box">
							<input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
							<span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
						</div>
					</div>
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center">
							<li class="nav-item mobile-search-icon">
								<a class="nav-link" href="#">	<i class='bx bx-search'></i>
								</a>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">	<i class='bx bx-category'></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<div class="row row-cols-3 g-3 p-3">
										<div class="col text-center">
											<div class="app-box mx-auto"><i class='bx bx-group'></i>
											</div>
											<div class="app-title">{{ __('Teams') }}</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto"><i class='bx bx-atom'></i>
											</div>
											<div class="app-title">{{ __('Projects') }}</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto"><i class='bx bx-shield'></i>
											</div>
											<div class="app-title">{{ __('Tasks') }}</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto"><i class='bx bx-notification'></i>
											</div>
											<div class="app-title">{{ __('Feeds') }}</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto"><i class='bx bx-file'></i>
											</div>
											<div class="app-title">{{ __('Files') }}</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto"><i class='bx bx-filter-alt'></i>
											</div>
											<div class="app-title">{{ __('Alerts') }}</div>
										</div>
									</div>
								</div>
							</li>

							<!-- notifications -->
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count"> {{ $notifications_no }} </span>
									<i class='bx bx-bell'></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a href="javascript:;">
										<div class="msg-header">
											<p class="msg-header-title">{{ __('Notifications') }}</p>
											<p class="msg-header-clear ms-auto"><a href="{{ url('security/notification/mark/all/as/read') }}" class="text-white">{{ __('Marks all as read') }}</a></p>
										</div>
									</a>
									<div class="header-notifications-list bg-dark">

                                      @foreach ($notifications as $notification)
									  @php
										  $user = App\Models\User::whereId($notification->guard_id)->first();
									  @endphp

										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify"><i class="bx bx-group"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">{{ $user->name }}
													<span class="msg-time float-end">{{ $notification->created_at->diffForHumans() }}</span></h6>
													<p class="msg-info">{{ $notification->message }}</p>
												</div>
											</div>
										</a>
									@endforeach
										
										
									</div>
									<a href="{{ url('security/view/all/notifications') }}">
										<div class="text-center msg-footer">View All Notifications</div>
									</a>
								</div>
							</li>
							<!-- -->


							<!-- message -->
							@php
							    $segment = Request::segment(2);	
							@endphp

							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">{{ $message_no }}</span>
									<i class='bx bx-comment'></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a href="javascript:;">
										<div class="msg-header">
											<p class="msg-header-title">Messages</p>
											<p class="msg-header-clear ms-auto"><a href="{{ url('security/message/mark/all/as/read') }}" class="text-white">Marks all as read</a></p>
										</div>
									</a>
									<div class="header-message-list">

										@foreach ($messages as $message)
										@php
										  $user = App\Models\User::whereId($message->guard_id)->first();
									    @endphp
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="https://via.placeholder.com/110x110" class="msg-avatar" alt="user avatar">
												</div>

												@if ($segment == "dashboard")
													
												<div class="flex-grow-1" onclick="messageView('<?php echo $message->message_id ?>', 0)">
													<h6 class="msg-name"> {{ $user->name }} <span class="msg-time float-end">{{ $message->created_at->diffForHumans() }}</span></h6>
													<p class="msg-info">{{ $message->message }}</p>
												</div>

												@else

												<div class="flex-grow-1" onclick="messageView('<?php echo $message->message_id ?>', 1)">
													<h6 class="msg-name"> {{ $user->name }} <span class="msg-time float-end">{{ $message->created_at->diffForHumans() }}</span></h6>
													<p class="msg-info">{{ $message->message }}</p>
												</div>

												@endif
											    

											</div>
										</a>
										@endforeach

									</div>
									<a href="{{ route('security.view.all.msg') }}">
										<div class="text-center msg-footer">View All Messages</div>
									</a>
								</div>
							</li>
						</ul>
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="https://via.placeholder.com/110x110" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0">
									@if(Auth::user() != null)
									{{ Auth::user()->name}}
									@endif
								</p>
								<p class="designattion mb-0">{{ __("Security Company") }}</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item" href="{{ route('security.profile') }}"><i class="bx bx-user"></i><span>Profile</span></a>
							</li>
							<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-cog"></i><span>Settings</span></a>
							</li>
							<li><a class="dropdown-item" href="{{ route('security.dashboard') }}"><i class='bx bx-home-circle'></i><span>Dashboard</span></a>
							</li>
							<li><a class="dropdown-item" href="javascript:;"><i class='bx bx-dollar-circle'></i><span>Earnings</span></a>
							</li>
							<li><a class="dropdown-item" href="javascript:;"><i class='bx bx-download'></i><span>Downloads</span></a>
							</li>
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li><a class="dropdown-item" href="{{ route('security.logout') }}"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>

		