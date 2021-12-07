@extends('layouts.app')
@section('title','All courses')
@section('content')
    <div class="wrap-all-course  py-5">
        <div class="container">
            <div class="filter mb-3">
                <div class="filter-search py-2">
                    <form action="{{ Route('course.search') }}" method="GET">
                        <div class="d-flex position-relative">
                            <div class="filter-icon filter-toggle col-xl-1 d-flex align-items-center py-2 mr-2">
                                <img src="{{ asset('storage/images/filter.png') }}" alt="Filter">
                                <span class="filter-text ml-xl-1">Filter</span>
                            </div>
                           <div>
                                <input type="text" class="text-search" placeholder="Search..." name="name" value="{{ request('name') }}" size="30">
                                <i class="fa fa-search"></i>
                           </div>
                           <div class="mx-3">
                               <input type="submit" class="btn btn-light hapo-filter-seach" value="Seach">
                           </div>
                        </div>
                        <div class="hapo-filter filter-show mt-2 p-4 mx-0 row ">
                            <div class="hapo-filter-title col-1 p-0">Filter By: </div>
                            <div class="hapo-filte-content col-11 p-0 d-flex flex-wrap">
                                {{-- <div class="radio-toolbar d-flex align-content-center ">
                                   <div>
                                        <input type="radio" id="newest" name="searched" checked value="1">
                                        <label for="newest">Newest</label>
                                   </div>
                                   <div>
                                        <input type="radio" id="oldest" name="searched" value="2">
                                        <label for="oldest">Oldest</label>
                                   </div>
                                </div>
                                <div class="input-group col-2 p-0 mb-3 mx-2">
                                    <select class="custom-select" name="teacher" id="teacher">
                                        <option value="">Teacher...</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group col-2 p-0 mb-3 mx-2">
                                    <select class="custom-select" name="student" id="student">
                                        <option valute="">Student</option>
                                        <option value="1">Most Student</option>
                                        <option value="2">Least Student</option>
                                    </select>
                                </div>
                                <div class="input-group col-2 p-0 mb-3 mx-2">
                                    <select class="custom-select" name="time" id="time">
                                        <option valute="">Time</option>
                                        <option value="1">Most Time</option>
                                        <option value="2">Least Time</option>
                                    </select>
                                </div>
                                <div class="input-group col-2 p-0 mb-3 mx-2">
                                    <select class="custom-select" name="lesson" id="lesson">
                                        <option valute="">Lesson</option>
                                        <option value="1">Most Lesson</option>
                                        <option value="2">Least Lesson</option>
                                    </select>
                                </div> --}}
                                <div class="input-group col-2 p-0 mb-3 mx-2">
                                    <select class="custom-select" name="tag" id="tag">
                                        <option valute="">Tag</option>
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="input-group col-2 p-0 mb-3 mx-2">
                                    <select class="custom-select" name="review" id="review">
                                        <option valute="">Review</option>
                                        <option value="1">Most Review</option>
                                        <option value="2">Least Review</option>
                                    </select>
                                </div> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="course-all row">
                @foreach ($courses as $key => $item)
                <div class="left-course col-6 my-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="course-body d-flex ">
                                <img class="wrap-course-image ml-2" src="{{asset('storage/images/'. $item->image)}} " alt="HTML">
                                <div class="wrap-content col-xl-9 offset-1 pl-0">
                                    <h5 class="card-title-course card-title">{{ $item->course_name }} </h5>
                                    <p class="card-text-course card-text mb-0 text-justify">{{ $item->description }}</p>
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
