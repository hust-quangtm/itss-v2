@extends('admin.index')
@section('title','Admin-user-edit')
@section('contents')
    <div class="hapo-admin py-3">
        <div class="hapo-admin-header d-flex justify-content-between py-3">
            <div class="d-flex">
                <div class="hapo-admin-header-name px-3 d-flex align-items-center">
                    Edit Users
                </div>
            </div>
            <div class="hapo-admin-header-link px-5">
                <ul class="d-flex justify-content-center align-items-center m-0">
                    <li class="nav-item ml-4">
                        <a href="#"><i class="fas fa-tachometer-alt"></i> Home </a>
                    </li>
                    <span class="hapo-angle-right ml-4"><i class="fas fa-angle-right"></i></span>
                    <li class="nav-item ml-3">
                        <a href="#">edit</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="hapo-admin-body mt-1 pb-5">
            <section class="content">
                <div class="row">
                    <div class="col-md-6 offset-3">
                        <div class="box box-primary">
                            <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.users.update', $user->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="role_id">Role: </label>
                                        <input class="form-check-input ml-4" type="radio" name="role_id" id="1" value="{{ App\Models\User::ROLE['user'] }}" {{ old('role', $user->role_id) ==  App\Models\User::ROLE['user'] ? 'checked' : '' }}>
                                        <label for="1" class="ml-5">User</label>
                                        <input class="form-check-input ml-4" type="radio" name="role_id" id="2" value="{{ App\Models\User::ROLE['teacher'] }}" {{ old('role',  $user->role_id) ==  App\Models\User::ROLE['teacher'] ? 'checked' : '' }}>
                                        <label for="2" class="ml-5">Admin</label>
                                        <input class="form-check-input ml-4" type="radio" name="role_id" id="3" value="{{ App\Models\User::ROLE['system'] }}" {{ old('role',  $user->role_id) ==  App\Models\User::ROLE['system'] ? 'checked' : '' }}>
                                        <label for="2" class="ml-5">Teacher</label>
                                        @error('role_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}" readonly>
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}" readonly>
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{  $user->phone }}" readonly>
                                        @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ $user->address }}" readonly>
                                        @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="birth_day">Birth day</label>
                                        <input type="date" class="form-control @error('birth_day') is-invalid @enderror" id="birth_day" name="birth_day" value="{{ $user->birth_day }}" readonly>
                                        @error('birth_day')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="avatar">Choose avatar</label>
                                        <input type="file" id="avatar" name="avatar" class="@error('avatar') is-invalid @enderror" value="">
                                        <p class="help-block">Please chosse file</p>
                                        @error('avatar')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                              </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
