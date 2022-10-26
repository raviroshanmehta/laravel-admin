@extends('layouts.admin')
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
					<i class="mdi mdi-tag-text-outline  text-white" style="background:#adadbd"></i>
				</div>
				<div>
					<h5 class="font-16">Total Admins</h5>
				</div>
				<h3 class="mt-4">10<span>
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-xl-3">
		<div class="card">
			<div class="card-heading p-4">
				<div class="mini-stat-icon float-right">
					<i class="mdi mdi-tag-text-outline bg-primary  text-white"></i>
				</div>
				<div>
					<h5 class="font-16">Balance</h5>
				</div>
				<h3 class="mt-4">$1100<span>
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-xl-3">
		<div class="card">
			<div class="card-heading p-4">
				<div class="mini-stat-icon float-right">
					<i class="mdi mdi-tag-text-outline bg-success text-white"></i>
				</div>
				<div>
					<h5 class="font-16">
					Credit cards
				</div>
				<h3 class="mt-4">50<span>
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-xl-3">
		<div class="card">
			<div class="card-heading p-4">
				<div class="mini-stat-icon float-right">
					<i class="mdi mdi-tag-text-outline bg-warning text-white"></i>
				</div>
				<div>
					<h5 class="font-16">Deposites</h5>
				</div>
				<h3 class="mt-4">$100<span>
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-xl-3">
		<div class="card">
			<div class="card-heading p-4">
				<div class="mini-stat-icon float-right">
					<i class="mdi mdi-tag-text-outline bg-danger text-white"></i>
				</div>
				<div>
					<h5 class="font-16">Loans</h5>
				</div>
				<h3 class="mt-4">$300<span>
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-xl-3">
		<div class="card">
			<div class="card-heading p-4">
				<div class="mini-stat-icon float-right">
					<i class="mdi mdi-tag-text-outline bg-danger text-white"></i>
				</div>
				<div>
					<h5 class="font-16">Account</h5>
				</div>
				<h3 class="mt-4">50<span>
			</div>
		</div>
	</div>
</div>
@endsection
