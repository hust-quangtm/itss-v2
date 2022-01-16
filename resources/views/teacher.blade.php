@extends('layouts.app')
@section('title','All teachers')
@section('content')
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

        <div class="course-all d-flex flex-wrap justify-content-center-space-between">
            @foreach($teachers as $key=>$teacher)
                <div class="hapo-description mb-3 overflow-hidden" style="width: 260px;height: 260px;">
                    <div class="p-3 d-flex flex-column align-items-center">
                        <hr>
                        <div class="hapo-description-body d-flex flex-column align-items-center justify-content-center">
                            <?php
                               $num = rand(1,5) ;
                            ?>
                            @if($num % 5 == 0)
                                <div class="hapo-review-content-avatar">
                                    <img class="" style="width: 90px;height: 90px;"
                                        src="{{ asset('storage/images/teacher3.png') }} " alt="">
                                </div>
                            @endif
                            @if($num % 5 == 1)
                                <div class="hapo-review-content-avatar">
                                    <img class="" style="width: 90px;height: 90px;"
                                        src="{{ asset('storage/images/teacher0.png') }} " alt="">
                                </div>
                            @endif
                            @if($num % 5 == 2)
                                <div class="hapo-review-content-avatar">
                                    <img class="" style="width: 90px;height: 90px;"
                                        src="{{ asset('storage/images/teacher1.png') }} " alt="">
                                </div>
                            @endif
                            @if($num % 5 == 3)
                                <div class="hapo-review-content-avatar">
                                    <img class="" style="width: 90px;height: 90px;"
                                        src="{{ asset('storage/images/teacher2.png') }} " alt="">
                                </div>
                            @endif
                            @if($num % 5 == 4)
                                <div class="hapo-review-content-avatar">
                                    <img class="" style="width: 90px;height: 90px;"
                                        src="{{ asset('storage/images/teacher4.png') }} " alt="">
                                </div>
                            @endif
                            <a href="{{ route('teacher.detail', $teacher->id) }}">
                                <div class="hapo-review-content-username text-left">
                                    <div class="m-0 p-0 mt-3 h6 font-weight-bold" style="color: #5C5C5C;">
                                        {{ $teacher->name }} </div>
                                </div>
                            </a>
                            <div class="hapo-review-content-username">
                                <div class="m-0 p-0 mt-3 h6" style="color: #5C5C5C;">{{ $teacher->email }} </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
