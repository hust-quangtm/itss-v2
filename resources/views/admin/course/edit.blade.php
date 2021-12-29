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
                            <form role="form" method="POST" action="{{ route('admin.courses.update', $courses->id) }}" enctype="multipart/form-data" class="col-xs-8">
                                @csrf
                                @method('PUT')
                                <div class="box-body mt-4">
                                    <div class="form-group">
                                        <label for="name">Name: </label>
                                        <input type="text" class="form-control @error('course_name') is-invalid @enderror" id="courseName" name="course_name" placeholder="Enter name" value="{{ $courses->course_name }}">

                                        @error('course_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Price: </label>
                                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="100$" value=" {{ $courses->price }} ">
                                        @error('price')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description: </label>
                                        <textarea class="form-control" rows="4" @error('description') is-invalid @enderror" name="description">{{ $courses->description }}</textarea>

                                        @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="requirement">Quizze: </label>
                                        <textarea class="form-control" rows="4" @error('requirement') is-invalid @enderror" name="requirement">{{ $courses->requirement }}</textarea>

                                        @error('requirement')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                    {{-- <div class="form-group">
                                        <label for="tag" class="mr-4">Tags: </label>
                                        <div class="row ml-2">
                                            @foreach($tags as $tag)
                                            <div class="col-4">
                                                <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" id="{{ $tag->id }}" name="tagId[]"
                                                @if (count($courseTag->where('id', $tag->id)))
                                                    checked
                                                @endif>
                                                <label class="form-check-label" for="{{ $tag->id }}">
                                                    {{ $tag->tag_name }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div> --}}
                                    <div class="form-group col-xs-6">
                                        <label for="avatar">Choose image: </label>
                                        <input type="file" id="image" name="image"
                                               class="@error('image') is-invalid @enderror" value="">
                                        <p class="help-block">Please chosse file</p>

                                        @error('image')
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
