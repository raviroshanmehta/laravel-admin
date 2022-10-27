
@extends('layouts.admin')
@section('title')
    User @if($user) Update @else Add @endif
@endsection
@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">User @if($user) Update @else Add @endif</h4>
            </div>
            <div class="col-sm-6">
                
                <!-- <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Stexo</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                    <li class="breadcrumb-item active">Starter</li>
                </ol> -->
            </div>
        </div> <!-- end row -->
    </div>
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">

                <h4 class="mt-0 header-title">{{ __('Account Details') }}</h4>
                <p class="sub-title"></p>
                <form action="{{route('admin.users.add.post')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="@if($user){{ $user->id }}@endif">
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">{{ __('Enter Name') }}</label>
                        <div class="col-sm-10">
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="@if($user){{ $user->name }}@else{{ old('name') }}@endif">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">{{ __('Enter Email') }}</label>
                        <div class="col-sm-10">
                            <input class="form-control @error('name') is-invalid @enderror" type="text"  name="email" value="@if($user){{ $user->email }}@else{{ old('email') }}@endif">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">{{ __('Enter Password') }} </label>
                        <div class="col-sm-10">
                            <input class="form-control @error('password') is-invalid @enderror" type="password"  name="password">
                            @if($user) <label for="password-confirm" class="text-info">{{ __('Leave password and confirm password fields blank if do not want to update password') }}</label> @endif
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-sm-2 col-form-label">{{ __('Confirm Password') }}</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control"id="example-text-input" name="status">
                                <option value="active" @if($user && $user->status == 'active') selected @endif >Active</option>
                                <option value="inactive" @if($user && $user->status == 'inactive') selected @endif>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">@if($user) Update @else Add @endif</button>
                            <a class="btn btn-danger" href="{{ route('superadmin.admins') }}">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

