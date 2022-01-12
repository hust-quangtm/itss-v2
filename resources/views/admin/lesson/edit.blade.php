@extends('admin.index')
@section('title','Admin-lesson-create')
@section('contents')
    <div class="hapo-admin py-3">
        <div class="hapo-admin-header d-flex justify-content-between py-3">
            <div class="d-flex">
                <div class="hapo-admin-header-name px-3 d-flex align-items-center">
                    Create Lesson
                </div>
            </div>
            <div class="hapo-admin-header-link px-5">
                <ul class="d-flex justify-content-center align-items-center m-0">
                    <li class="nav-item ml-4">
                        <a href="#"><i class="fas fa-tachometer-alt"></i> Home </a>
                    </li>
                    <span class="hapo-angle-right ml-4"><i class="fas fa-angle-right"></i></span>
                    <li class="nav-item ml-3">
                        <a href="#">Create</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="hapo-admin-body mt-1 pb-5">
            <section class="content">
                <div class="row">
                    <div class="col-md-6 offset-3">
                        <div class="box box-primary">
                            <form role="form" method="POST" action="{{ route('admin.lesson.update', [$courseId, $lessonId]) }}"  class="col-xs-8">
                                @csrf
                                @method('PUT')
                                <div class="box-body mt-4">
                                    <div class="form-group">
                                        <label for="name">Name: </label>
                                        <input type="text" class="form-control @error('lesson_name') is-invalid @enderror" id="lessonName" name="lesson_name" placeholder="Enter name" value="{{ $lesson->lesson_name }}">

                                        @error('lesson_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Time: </label>
                                        <input type="text" class="form-control @error('time') is-invalid @enderror" id="time" name="time" placeholder="Enter time" value="{{ $lesson->time }}">

                                        @error('time')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description: </label>
                                        <textarea class="form-control" rows="4" @error('description') is-invalid @enderror" name="description">{{ $lesson->description }}</textarea>

                                        @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Youtube URL: </label>
                                        <input type="text" class="form-control @error('time') is-invalid @enderror" name="video_url" placeholder="Enter embed URL code" required value="{{ $lesson->video_url }}">
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="requirement">Quizze: </label>
                                        <textarea class="form-control" rows="4" @error('requirement') is-invalid @enderror" name="requirement" placeholder="requirement">{{ $lesson->requirement }}</textarea>

                                        @error('requirement')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
