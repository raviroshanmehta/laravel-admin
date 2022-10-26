
@extends('layouts.admin')
@section('title')
    Users
@endsection
@section('css')
<link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Users</h4>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-sm btn-info" href="{{ route('admin.users.add') }}" style="float: right;">Add New User</a>
            </div>
        </div> <!-- end row -->
    </div>
    <div class="col-sm-12">
        <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
        <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $key=>$user)
            <tr role="row" class="{{$key%2==0? 'even':'odd'}}">
                <td tabindex="0" class="sorting_1">
                    {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}
                </td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->status}}</td>
                <td>
                    <a href="{{ route('admin.users.update', ['id' => $user->id ]) }}" title="edit"><i class="fa fa-edit  text-info"></i></a>
                    <a href="{{ route('admin.users.update', ['id' => $user->id ]) }}?action=delete" title="delete" onclick="return confirm('Are you sure ?')"><i class="fa fa-trash text-danger"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('js')
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/pages/datatables.init.js')}}"></script>
@endsection
