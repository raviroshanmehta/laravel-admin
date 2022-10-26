<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<title>@yield('title')</title>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
		<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('assets/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
		@section('css')
		@show
	</head>
	<body>
		<div id="wrapper">
			<div class="topbar">
				<!-- LOGO -->
                <div class="topbar-left">
                    <a href="{{route(''.auth()->user()->role.'.dashboard')}}" class="logo">
                        <span class="logo-light">
                            <i class="mdi mdi-camera-control"></i> ACH
                        </span>
                        <span class="logo-sm">
                            <i class="mdi mdi-camera-control"></i>
                        </span>
                    </a>
                </div>

                <nav class="navbar-custom">
                    <ul class="navbar-right list-inline float-right mb-0">
                        <li class="dropdown notification-list list-inline-item">
                            <div class="dropdown notification-list nav-pro-img">
                                <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="/assets/images/users/user-4.jpg" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <a href="javascript:;" class="dropdown-item" data-toggle="modal" data-target="#changePass"><i class="mdi mdi-lock"></i>Change Password</a>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();"><i class="mdi mdi-power text-danger"></i> Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-effect">
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </li>
                    </ul>

                </nav>
			</div>
			<div class="left side-menu">
				<div class="slimscroll-menu" id="remove-scroll">
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li>
                                <a href="{{route(''.auth()->user()->role.'.dashboard')}}" class="waves-effect">
                                    <i class="icon-accelerator"></i><span> Dashboard </span>
                                </a>
                            </li>
                            @switch(auth()->user()->role)
                                @case('superadmin')
                                    <li>
                                        <a href="{{route(''.auth()->user()->role.'.admins')}}" class="waves-effect">
                                            <i class="mdi mdi-account-multiple"></i><span> Admins </span>
                                        </a>
                                    </li>
                                @break
                                @case('admin')
                                    <li>
                                        <a href="{{route(''.auth()->user()->role.'.users')}}" class="waves-effect">
                                            <i class="mdi mdi-account-multiple"></i><span> Users </span>
                                        </a>
                                    </li>
                                @break
                            @endswitch
                        </ul>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>
                </div>
			</div>
			<div class="content-page">
				<div class="content">
					<div class="container-fluid pt-2">
						@if(count($errors) > 0 )
                            <!-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                <ul class="p-0 m-0" style="list-style: none;">
                                    @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div> -->
						@endif
						@if(session('success'))
                            <div class="alert alert-success">{{session('success')}}</div>
						@endif
						@if(session('error'))
						    <div class="alert alert-danger">{{session('error')}}</div>
						@endif
						@yield('content')
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="changePass" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Change Password</h4>
					</div>
					<div class="modal-body">
						<form action="{{ route('password.update') }}" method="post">
							@csrf
							<label for="">Old Password</label>
							<input type="password" name="oldPass" class="form-control" >
							<label for="">New Password</label>
							<input type="password" name="newPass" class="form-control" >
                            <label for="">Confirm Password</label>
							<input type="password" name="confPass" class="form-control" >
							<br>
							<button type="submit" class="btn btn-sm btn-primary mt-2">Update</button>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="{{asset('assets/js/jquery.min.js')}}"></script>
		<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
		<script src="{{asset('assets/js/metismenu.min.js')}}"></script>
		<script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
		<script src="{{asset('assets/js/waves.min.js')}}"></script>
		<!-- App js -->
		<script src="{{asset('assets/js/app.js')}}"></script>
        @section('js')
		@show
	</body>
</html>
