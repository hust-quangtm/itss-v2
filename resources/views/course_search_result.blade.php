@extends('layouts.app')
@section('title','All courses')
@section('content')
<div class="wrap-all-course  py-5">
    <div class="container">
        <div class="filter mb-3">
            <div class="filter-search py-2">
                <form action="{{ Route('course.search') }}" method="GET">
                    <div class="d-flex position-relative">
                        <div class="mx-3">
                            <input type="submit" class="btn btn-light hapo-filter-seach" value="Seach">
                        </div>
                        <div>
                            <input type="text" class="text-search" placeholder="Search by course name" name="name"
                                value="{{ request('name') }}" size="30">
                        </div>
                    </div>
                </form>
            </div>
        </div>
      
        <div class="course-all row">
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
        <div class="pagination col-12 mt-5 d-flex justify-content-end">
            {{ $courses->appends($_GET)->links('pagination') }}
        </div>
    </div>
</div>
@endsection
