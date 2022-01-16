@extends('layouts.app')
@section('title','All teachers')
@section('content')
<div class="head-detail container-fluid mt-2 d-flex align-items-center">
    <ul class="pl-5 d-flex align-content-center justify-content-center">
        <li class="mx-2"><a href=" {{ route('home') }} ">Home</a></li> >
        <li class="mx-2"><a href=" {{ route('teacher.all') }} ">All teachers</a></li> >
        <li class="mx-2"><a href="">Teacher information</a></li>
    </ul>
</div>
<div class="wrap-all-course  py-5">
    <div class="container">
        <div class="filter mb-3">
            <div class="filter-search py-2">
                <form action="{{ Route('teacher.search') }}" method="GET">
                    <div class="d-flex position-relative">
                        <div class="mx-3">
                            <input type="submit" class="btn btn-light hapo-filter-seach" value="Seach">
                        </div>
                        <div>
                            <input type="text" class="text-search" placeholder="Search teacher" name="name"
                                value="{{ request('name') }}" size="30">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="left-course col-12 my-4">
            <div class="card">
                <div class="card-body">
                    <div class="hapo-description my-3 overflow-hidden d-flex flex-wrap justify-content-around">
                        <div class="p-3 d-flex flex-column align-items-center col-3" style="border: solid 1px #EFEFEF; border-radius: 13px;">
                            <div
                                class="hapo-description-body d-flex flex-column align-items-center justify-content-center">
                                <div class="hapo-review-content-avatar">
                                    <img class="rounded-circle" style="width: 90px;height: 90px;"
                                        src="{{ asset('storage/images/user.png') }} " alt="">
                                </div>
                                <div class="hapo-review-content-username text-left font-weight-bold">
                                    <div class="m-0 p-0 mt-3 h3 font-weight-bold" style="color: #5C5C5C;">
                                        {{ $teacher->name }} </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8" style="border: solid 1px #EFEFEF; border-radius: 13px;">
                            <div class="hapo-review-content-username d-flex flex-row">
                                <div class="m-0 p-0 mt-3 h5 font-weight-bold">Phone:&nbsp</div>
                                <div class="m-0 p-0 mt-3 h5" style="color: #5C5C5C;">
                                    {{ $teacher->phone }} </div>
                            </div>
                            <div class="hapo-review-content-username d-flex flex-row">
                                <div class="m-0 p-0 mt-3 h5 font-weight-bold">Start time:&nbsp</div>
                                <div class="m-0 p-0 mt-3 h5" style="color: #5C5C5C;">
                                    {{ date('d-m-Y', strtotime($teacher->created_at)) }}
                                </div>
                            </div>
                            <div class="hapo-review-content-username d-flex flex-row">
                                <div class="m-0 p-0 mt-3 h5 font-weight-bold">all courses:&nbsp</div>
                                <div class="m-0 p-0 mt-3 h5" style="color: #5C5C5C;">
                                    {{ $count }}
                                </div>
                            </div>
                            <div class="hapo-review-content-username d-flex flex-row">
                                <div class="m-0 p-0 mt-3 h5 font-weight-bold">following students:&nbsp</div>
                                <div class="m-0 p-0 mt-3 h5" style="color: #5C5C5C;">
                                    {{ $countUser }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="course-all d-flex flex-wrap justify-content-center-space-between">
            @foreach($courses as $key => $item)
                <div class="left-course col-6 my-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="course-body d-flex ">
                                <img class="wrap-course-image ml-2"
                                    src="{{ asset('storage/images/'. $item->image) }} "
                                    alt="HTML">
                                <div class="wrap-content col-xl-9 offset-1 pl-0">
                                    <h5 class="card-title-course card-title">{{ $item->course_name }} </h5>
                                    <p class="card-text-course card-text mb-0 text-justify">{{ $item->description }}
                                    </p>
                                    <a href="{{ route('course.detail', $item->id) }}"
                                        class="card-link-more col-4 offset-8 d-block text-center py-xl-2 my-xl-3">More</a>
                                </div>
                            </div>
                            <hr>
                            <div class="wrap-course-link row">
                                <div class="wrap-learners col-xl-4 text-center">
                                    <a href="#" class="card-link mb-2 d-block">Learners</a>
                                    <p class="mb-0">{{ $item->count_user }} </p>
                                </div>
                                <div class="wrap-lessons col-xl-4 text-center">
                                    <a href="#" class="card-link mb-2 d-block">Lessons</a>
                                    <p class="mb-0">{{ $item->count_lesson }} </p>
                                </div>
                                <div class="wrap-quizes col-xl-4 text-center">
                                    <a href="#" class="card-link mb-2 d-block">Times</a>
                                    <p class="mb-0">{{ $item->time['hours'] }} (h)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
