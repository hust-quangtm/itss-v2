@extends('layouts.app')
@section('title','User profile')
@section('content')
<div class="hapo-profile-fulid">
    @if ($message = Session::get('message'))
        <div class="alert alert-success alert-block my-2" id="myAlert">
            <button type="button" class="close" data-dismiss="alert">X</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="container-fluid">
        <div class="row hapo-profile">
            <div class="col-3 ">
                <div class="hapo-profile-left-header">
                    <div class="hapo-profile-image d-flex flex-column align-items-center justify-content-center">
                        <img src=" {{ asset('storage/users/'. Auth::user()->avatar) }} " alt="">
                        <button class="btn btn-img" data-toggle="modal" data-target="#myModal"><i class="fas fa-camera"></i></button>
                    </div>
                    <div class="hapo-profile-contact mt-2 mb-3 d-flex flex-column justify-content-center align-items-center">
                        <span class="profile-name"> {{ Auth::user()->name }} </span>
                        <span class="profile-email"> {{ Auth::user()->email }} </span>
                    </div>
                </div>
                <div class="hapo-profile-left-body">
                    <div class="hapo-left-body-contact pr-3">
                        <div class="hapo-contact-text">
                            <span><i class="fas fa-birthday-cake text-danger mr-3"></i>{{ date('d-m-Y', strtotime(Auth::user()->birth_day)) }} </span>
                        </div>
                        <div class="hapo-contact-text">
                            <span><i class="fas fa-phone-alt text-orange mr-3"></i> {{ Auth::user()->phone }} </span>
                        </div>
                        <div class="hapo-contact-text">
                            <span><i class="fas fa-home text-info mr-3"></i> {{ Auth::user()->address }} </span>
                        </div>
                    </div>
                    <div class="hapo-left-body-desc mt-3 text-justify">
                        <span>
                            {{ Auth::user()->about }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-9 p-4">
                <div class="hapo-profile-right-header mt-5 mb-2">
                    <div class="hapo-profile-right-title">
                        My courses
                    </div>
                    <div class="hapo-profile-allcourse mt-3 mb-5">
                        <div class="hapo-allcourse d-flex align-items-center justify-content-center flex-wrap">
                            @foreach ($courses as $course)
                                <div class="hapo-right-imgcourse p-3 d-flex flex-column align-items-center justify-content-center flex-wrap">
                                    <img src=" {{ asset('storage/images/'. $course->image) }} " class="rounded-circle" alt="course">
                                    <br>
                                    <span> {{ $course->course_name }} </span>
                                </div>
                            @endforeach
                            <div class="hapo-right-imgcourse p-2 d-flex flex-column align-items-center justify-content-cente">
                                <a href="{{ route('course.all') }}" class="mx-auto"><img src="{{ asset('storage/images/add-course.png') }}"></a>
                                <br>
                                <span class="add-course"> Add course </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hapo-profile-right-body mt-3">
                    <div class="hapo-profile-right-title mb-4">
                        Edit profile
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <form method="post" action=" {{ route('user.profile.update', Auth::user()->id) }} " class="row">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="projectName">Name: </label>
                                <input type="text" name="profile_name" class="form-control" placeholder="Your name"  value=" {{ Auth::user()->name }} ">
                                @error('profile_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="projectName">Email:</label>
                                <input type="email" name="profile_email" class="form-control" placeholder="Your email"  value=" {{ Auth::user()->email }} ">
                                @error('profile_email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="featureImage">Date of birthday: </label>
                                <input type="date" name="birth_day" class="form-control" value="{{ Auth::user()->birth_day }}" >
                                @error('birth_day')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="videoUrl">Phone: </label>
                                <input type="text" id="phone" name="phone" class="form-control" value="{{ Auth::user()->phone }}" placeholder="Your phone" >
                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="architect">Address: </label>
                                <input type="text" id="address" name="address" class="form-control" value=" {{ Auth::user()->address }} " placeholder="Your address">
                                @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 d-flex flex-column">
                                <label for="surface">About:</label>
                                <textarea name="about" id="about" class="form-control text-justify" cols="50" rows="5"> {{ Auth::user()->about }} </textarea>
                                @error('about')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mx-auto">
                                <button type="submit" class="btn btn-success form-control right-0">Update profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form class="modal-content" method="POST" enctype="multipart/form-data" action="{{ route('user.profile.avatar', Auth::user()->id) }}">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Update Image</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="hapo-input-file">
                            <label for="avatar" class="hapo-input-label"><i class="fas fa-cloud-upload-alt hapo-icon-upload"></i></label>
                            <input type="file" name="avatar" id="avatar" class="d-none  @error('avatar') is-invalid @enderror">
                            @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center">
                            <img src="#" id="output_image" class="rounded-circle img-fluid hapo-img-upload d-none">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
