@extends('layouts.admin')
@section('title')
    Dashboard
@endsection
@section('content')
<div class="page-title-box">
	<div class="row align-items-center">
		<div class="col-sm-6">
			<h4 class="page-title">Welcome {{auth()->user()->name}}</h4>
		</div>
	</div>
	<!-- end row -->
</div>
<div class="row">
	<div class="col-sm-6 col-xl-3">
		<div class="card">
			<div class="card-heading p-4">
				<div class="mini-stat-icon float-right">
					<i class="mdi mdi-account-switch text-white" style="background:#adadbd"></i>
				</div>
				<div>
					<h5 class="font-16">Total Admins</h5>
				</div>
				<h3 class="mt-4">{{ $adminCount }}<span>
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-xl-3">
		<div class="card">
			<div class="card-heading p-4">
				<div class="mini-stat-icon float-right">
					<i class="mdi mdi-account-multiple-outline bg-primary text-white"></i>
				</div>
				<div>
					<h5 class="font-16">Total Users</h5>
				</div>
				<h3 class="mt-4">{{ $userCount }}<span>
			</div>
		</div>
	</div>
</div>
@endsection
