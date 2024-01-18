<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Smart Parking System</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/demo.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/ready.css') }}">
	<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    
	
    
</head>
<body>

	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
            <a class="navbar-brand" href="/"> <img src="{{ asset('assets/img/Polytechnic_University_of_the_Philippines_Biñan_Logo.svg.png') }}" width="25px" height="auto" > Smart Parking System </style></a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
			<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="la la-envelope"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<ul class="dropdown-menu notif-box" aria-labelledby="navbarDropdown">
							</ul>
						</li>
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								@if($prof_pic !== NULL)
                                            <img src="/storage/prof_pic/{{$prof_pic}}" class="img-thumbnail" alt="Responsive image" width="43px" height="auto">
                                            @else
                                            <img src="{{asset('assets/img/dummy.png') }}" class="img-thumbnail" alt="Responsive image" width="43px" height="auto">
                                            @endif
											<span >{{ $first_name}}</span></span> </a>
							<ul class="dropdown-menu dropdown-user">
								<li>
									<div class="user-box">
										<div class="u-img">
											@if ($prof_pic !== NULL)
                                            <img src="/storage/prof_pic/{{$prof_pic}}" class="img-thumbnail" alt="Responsive image" width="43px" height="auto">
                                            @else
                                            <img src="{{asset('assets/img/dummy.png') }}" class="img-thumbnail" alt="Responsive image" width="43px" height="auto">
                                            @endif
										</div>
										<div class="u-text">
											<h4>{{$first_name}} {{$middle_name}}, {{$last_name}}</h4>
											<p class="text-muted">{{ Auth::user()->email }}</p><a href="/edit_profile" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
									</div>
								</li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="/edit_profile"><i class="ti-user"></i> My Profile</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
								</ul>
								<!-- /.dropdown-user -->
							</li>
						</ul>
					</div>
				</nav>
			</div>
			<div class="sidebar">
				<div class="scrollbar-inner sidebar-wrapper">
					<div class="user">
						<div class="photo">
							@if ($prof_pic !== NULL)
                                            <img src="/storage/prof_pic/{{$prof_pic}}" class="img-thumbnail" alt="Responsive image" width="43px" height="auto">
                                            @else
                                            <img src="{{asset('assets/img/dummy.png') }}" class="img-thumbnail" alt="Responsive image" width="43px" height="auto">
                        	@endif
						</div>
						<div class="info">
							<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
								{{$first_name}} {{$middle_name}} {{$last_name}}
								<span class="user-level">
                                    @if (Auth::user()->user_type == 1)
										<center>Super Admin<br></center>
										@else
									@endif
                                    @if (Auth::user()->user_type == 2)
										<center>Admin<br></center>
										@else
									@endif
                                    @if (Auth::user()->user_type == 3)
										<center><br>Staff</center>
										@else
									@endif
                                    @if (Auth::user()->user_type == 4)
										<center>Faculty<br></center>
										@else
									@endif
                                    @if (Auth::user()->user_type == 5)
										<center>Guest<br></center>
										@else
									@endif
                                    @if (Auth::user()->user_type == 6)
										<center>Student<br></center>
										@else
									@endif
									</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample" aria-expanded="true" style="">
								<ul class="nav">
									<li>
										<a href="/edit_profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item active">
							<a href="/home">
								<i class="la la-dashboard"></i>
								<p>Dashboard</p>
								
							</a>
						</li>

						<li class="nav-item active">
							<a href="/attendance">
								<i class="la la-dashboard"></i>
								<p>Scan</p>
								
							</a>
						</li>

						
						<li class="nav-item active">
							<a href="/user-registered">
								<i class="la la-dropbox"></i>
								<p>User</p>
								
							</a>
						</li>
						
						
						@if(Auth::user()->user_type != 2 && Auth::user()->user_type != 3 && Auth::user()->user_type != 4)
						<li class="nav-item active" >
							<a href="/admin_account">
								<i class="la la-users"></i>
								<p>Create Account Admin</p>
								<span class="badge badge-danger"></span>
							</a>
						</li>
						@endif
						@if(Auth::user()->user_type != 2 && Auth::user()->user_type != 3 && Auth::user()->user_type != 4)
						<li class="nav-item active" >
							<a href="/user_account">
								<i class="la la-users"></i>
								<p>Create User Account</p>
								<span class="badge badge-danger"></span>
							</a>
						</li>
						@endif
						<li class="nav-item active">
							<a href="/user_history">
								<i class="la la-cab"></i>
								<p>See Driver's history</p>
								<span class="badge badge-danger"></span>
							</a>
						</li>
						@if(Auth::user()->user_type != 2 && Auth::user()->user_type != 3 && Auth::user()->user_type != 4)
						<li class="nav-item active">
							<a href="/receipt">
								<i class="la la-newspaper-o"></i>
								<p>Receipt Slip</p>
								<span class="badge badge-danger"></span>
								
							</a>
						</li>
						@endif
						@if(Auth::user()->user_type != 2 && Auth::user()->user_type != 3 && Auth::user()->user_type != 4)
						<li class="nav-item active">
							<a href="/parking-manag">
								<i class="la la-tasks"></i>
								<p>Parking Management</p>
								<span class="badge badge-danger"></span>
								
							</a>
						</li>
						@endif
						<!-- @if(Auth::user()->user_type != 2 && Auth::user()->user_type != 3 && Auth::user()->user_type != 4)
						<li class="nav-item active">
							<a href="/payment">
								<i class="la la-money"></i>
								<p>Payment</p>
								<span class="badge badge-danger"></span>
							</a>
						</li>
						@endif		 -->
						@if(Auth::user()->user_type != 5 && Auth::user()->user_type != 3 && Auth::user()->user_type != 4)
						<li class="nav-item active">
							<a href="/category">
								<i class="la la-feed"></i>
								<p>Category Vehicle</p>
								<span class="badge badge-danger"></span>
							</a>
						</li>
						@endif	

						@if(Auth::user()->user_type != 2 && Auth::user()->user_type != 3 && Auth::user()->user_type != 4)
						<li class="nav-item active">
							<a href="/parking-slot">
								<i class="la la-road"></i>
								<p>Parking Slot</p>
								<span class="badge badge-danger"></span>
							</a>
						</li>
						@endif	
						@if(Auth::user()->user_type != 2 && Auth::user()->user_type != 3 && Auth::user()->user_type != 4)
						<li class="nav-item active">
							<a href="/">
								<i class="la la-paper-plane"></i>
								<p>Generate Reports</p>
								<span class="badge badge-danger"></span>
								
							</a>
						</li>
						@endif	
					</ul>
				</div>
			</div>
                <main class="main-panel">
                    <div class="content">
                    @yield('content')
                </div>

        </main>

<script src="{{asset('assets/js/core/jquery.3.2.1.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
<!-- <script src="{{asset('assets/js/plugin/chartist/chartist.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script> -->
<script src="{{asset('assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/jquery-mapael/maps/world_countries.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/chart-circle/circles.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/ready.min.js')}}"></script>
<script src="{{asset('assets/js/demo.js')}}"></script>

<!-- script for datatable -->

