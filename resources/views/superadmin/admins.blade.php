
@extends('layouts.admin')
@section('title')
    Admins
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
                <h4 class="page-title">Admins</h4>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-sm btn-info" href="{{ route('superadmin.admins.add') }}" style="float: right;">Add New Admin</a>
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
            @foreach($admins as $key=>$admin)
            <tr role="row" class="{{$key%2==0? 'even':'odd'}}">
                <td tabindex="0" class="sorting_1">
                    {{ \Carbon\Carbon::parse($admin->created_at)->format('d/m/Y')}}
                </td>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                <td>{{$admin->status}}</td>
                <td>
                    <a href="{{ route('superadmin.admins.update', ['id' => $admin->id ]) }}" title="edit"><i class="fa fa-edit  text-info"></i></a>
                    <a href="{{ route('superadmin.admins.update', ['id' => $admin->id ]) }}?action=delete" title="delete" onclick="return confirm('Are you sure ?')"><i class="fa fa-trash text-danger"></i></a>
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
