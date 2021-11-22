@extends('admin.index')
@section('title','Admin-course-edit')
@section('contents')
    <div class="hapo-admin py-3">
        <div class="hapo-admin-header d-flex justify-content-between py-3">
            <div class="d-flex">
                <div class="hapo-admin-header-name px-3 d-flex align-items-center">
                    Edit Course
                </div>
            </div>
            <div class="hapo-admin-header-link px-5">
                <ul class="d-flex justify-content-center align-items-center m-0">
                    <li class="nav-item ml-4">
                        <a href="#"><i class="fas fa-tachometer-alt"></i> Home </a>
                    </li>
                    <span class="hapo-angle-right ml-4"><i class="fas fa-angle-right"></i></span>
                    <li class="nav-item ml-3">
                        <a href="#">Edit</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="hapo-admin-body mt-1 pb-5">
            <section class="content">
                <div class="row">
                    <div class="col-md-6 offset-3">
                        <div class="box box-primary">
                            <form role="form" method="POST" action="{{ route('admin.tags.update', $tags->id) }}" enctype="multipart/form-data" class="col-xs-8">
                                @csrf
                                @method('PUT')
                                <div class="box-body mt-4">
                                    <div class="form-group">
                                        <label for="name">Name: </label>
                                        <input type="text" class="form-control @error('tag_name') is-invalid @enderror" id="tagName" name="tag_name" placeholder="Enter name" value="{{ $tags->tag_name }}">

                                        @error('course_name')
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
