@extends('layouts.app')
@section('title','Course Detail')
@section('content')

<div class="head-detail container-fluid mt-2 d-flex align-items-center">
    <ul class="pl-5 d-flex align-content-center justify-content-center">
        <li class="mx-2"><a href=" {{ route('home') }} ">Home</a></li> >
        <li class="mx-2"><a href=" {{ route('course.all') }} ">All courses</a></li> >
        <li class="mx-2"><a href="">Courses detail</a></li>
    </ul>
</div>

<br/>
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
        {{ session('success') }}
        </div>
    @endif
</div>

    <div class="hapo-detail">
        <div class="container">
            <div class="row pt-5">
                <div class="col-7 p-0">
                    <div class="hapo-detail-course-header d-flex justify-content-center align-content-center">
                        <img src="{{ asset('storage/images/allcourse.png') }} " alt="" class="img-fluid pt-3 px-md-5 py-md-5 mt-md-0">
                    </div>
                    <div class="hapo-detail-content-left mt-3 mb-5">
                        <nav class="hapo-nav-detail">
                            <div class="nav nav-tabs nav-fill " id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active col-3" id="navLessonTab" data-toggle="tab" href="#navLesson" role="tab" aria-controls="nav-login" aria-selected="true">Lesson</a>
                                <a class="nav-item nav-link col-3" id="navCourseInfoTab" data-toggle="tab" href="#navCourseInfo" role="tab" aria-controls="nav-register" aria-selected="false">Description</a>
                                <a class="nav-item nav-link col-3" id="navReviewTab" data-toggle="tab" href="#navReview" role="tab" aria-controls="nav-register" aria-selected="false">Review</a>

                                @if($course->check_user_course)
                                    <a class="nav-item nav-link col-3" id="navTeacherTab" data-toggle="tab" href="#navTeacher" role="tab" aria-controls="nav-register" aria-selected="false">Exam</a>
                                @endif

                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade" id="navCourseInfo" role="tabpanel"
                                aria-labelledby="navCourseInfo">
                                <div class="px-3 mx-3 py-4">
                                    <h4>{{$course->description}}</h4>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="navLesson" role="tabpanel" aria-labelledby="navLessonTab">
                                <div class="hapo-header-filter d-flex align-items-center justify-content-between my-3 mx-3">
                                    <div class="hapo-header-form d-flex align-items-center justify-content-between">
                                        <form action="{{ route('course.detail', $course->id) }}" method="GET" class="d-flex">
                                            <input type="text" class="hapo-search py-2 mr-3" name="name" value="{{ request('name') }}" placeholder="Search for names.." size="25px">
                                            <i class="fa fa-search"></i>
                                            <input type="submit" value="Search" class="btn btn-search py-2">
                                        </form>
                                    </div>
                                    <div class="text-center pb-lg-0 pb-md-2 pb-3 m-3">
                                        @if ($course->check_user_course)
                                            <div class="w-100 text-center">
                                                <a href="{{ route('course.user.destroy', $course->id) }}" class="btn btn-light hapo-lesson-btn border-0 py-lg-0 px-4 py-2"  onclick="return confirm('Are you sure you want to leave this course?');" >Leave this Course</a>
                                            </div>
                                        @else
                                            {{-- <form action="{{ route('course.user.store', $course->id) }}" method="post" class="text-center">
                                                @csrf
                                                @if (Auth::user())
                                                    <input type="submit" value="Take This Course" class="btn btn-light hapo-courses-btn border-0 py-lg-0 px-4 py-2"  onclick="return confirm('Take This Course?');">
                                                @else
                                                    <a href="{{ route('course.detail', $course->id) }}" class="card-link-more btn btn-light hapo-courses-btn border-0 py-lg-0 px-4 py-2" {{ Auth::check() ? '' : 'data-toggle=modal data-target=#exampleModal' }}>Take This Course</a>
                                                    <input type="text" hidden value="{{ $course->id }}" class="idDirect">
                                                @endif
                                            </form> --}}
                                            {{-- @if ($cart->check_user_cart)
                                                <div class="w-100 text-center">
                                                    <a href="{{ route('cart.user.destroy', $course->id) }}"
                                                        class="btn btn-light hapo-lesson-btn border-0 py-lg-0 px-4 py-2">
                                                            Payment
                                                    </a>
                                                </div>
                                            @else --}}
                                            {{-- <form action="{{ route('cart.user.store', $course->id) }}" method="post" class="text-center">
                                                @csrf --}}
                                                @if (Auth::user())
                                                    {{-- <input type="submit"
                                                        value="Add To Cart"
                                                        class="btn btn-light hapo-courses-btn border-0 py-lg-0 px-4 py-2"> --}}
                                                    <p class="btn-holder"><a href="{{ route('add.to.cart', $course->id) }}" class="btn btn-light hapo-courses-btn border-0 py-lg-0 px-4 py-2" role="button">Add to cart</a> </p>
                                                    {{-- <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addToCart">
                                                        Launch demo modal
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="addToCartTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="addToCartTitle">The course has been added to your cart</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Your course has been added to the cart, you can now view the cart to continue checkout
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary">See your shopping cart</button>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div> --}}
                                                @else
                                                    <a href="{{ route('course.detail', $course->id) }}" class="addToCartBtn card-link-more btn btn-light hapo-courses-btn border-0 py-lg-0 px-4 py-2" {{ Auth::check() ? '' : 'data-toggle=modal data-target=#exampleModal' }}>Add To Cart</a>
                                                    <input type="text" hidden value="{{ $course->id }}" class="idDirect">
                                                @endif
                                            {{-- @endif --}}
                                        @endif
                                    </div>
                                </div>
                                <div class="course-lesson-detail" >
                                    <table class="table">
                                        <tbody id="myTable">
                                            @if (count($lessonCourse) > 0)
                                                @foreach ($lessonCourse as $key => $item)
                                                    <tr>
                                                        <td class="text-justify d-flex justify-content-between">
                                                            @if ($course->check_user_course)
                                                                @if ($item->check_user_lesson)
                                                                    <a href="{{ route('lesson.detail', $item->id) }}" class="course-other-item">{{ $key+1 . ".  " . $item->lesson_name }}</a>
                                                                    <a href="{{ route('lesson.detail', $item->id) }}"><button class="btn btn-light btn-learn">Continue</button></a>
                                                                @else
                                                                    <p class="course-other-item">{{ $lessonCourse->firstItem() + $key . ".  " . $item->lesson_name }}</p>
                                                                    <form action="{{ route('lesson.user.store', $item->id ) }}" method="post" class="text-center">
                                                                        @csrf
                                                                        <input type="submit" value="Learn" class="btn btn-learn">
                                                                    </form>
                                                                @endif
                                                            @else
                                                                <p class="course-other-item">{{ $lessonCourse->firstItem() + $key . ".  " . $item->lesson_name }}</p>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td class="text-center"> "Not found lesson !!!"</td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                    <div class="pagination col-12 mt-5 d-flex justify-content-end mt-4 ">
                                        {{ $lessonCourse->appends($_GET)->links('pagination') }}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navTeacher" role="tabpanel" aria-labelledby="navTeacherTab">
                                <div class="d-flex flex-row">
                                    <h4 class="hapo-teacher-header mt-2 p-3 col-10">
                                        Course's Examination
                                    </h4>
                                    <a href="{{ route('test.result', $course->id) }}" class="btn btn-learn mt-4 col-2 h-25">Your Result</a>
                                </div>
                                <div class="course-lesson-detail" >
                                    <table class="table">
                                        <tbody id="myTable">
                                            @foreach ($tests as $key => $item)
                                                <tr>
                                                    <td class="text-justify d-flex justify-content-between">
                                                        <p class="course-other-item">{{$key + 1}}. {{$item->test_name}}</p>
                                                        <a href="{{ route('test', [ $course->id, $item->id]) }}"><button class="btn btn-light btn-learn">Do Now</button></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="pagination col-12 mt-5 d-flex justify-content-end mt-4 ">
                                        {{ $lessonCourse->appends($_GET)->links('pagination') }}
                                    </div>
                                </div>
                                 <hr>
                            </div>
                            <div class="tab-pane fade" id="navReview" role="tabpanel" aria-labelledby="navReviewTab">
                               <div class="px-3">
                                    <div class="hapo-review-content">
                                        @foreach ($courReviews as $courseReview)
                                        <div class="hapo-review-user">
                                            <div class="hapo-review-content-header d-flex justify-content-between align-items-center mt-5">
                                                <div class="d-flex align-items-center justify-content-start">
                                                    <div class="hapo-review-content-avatar mr-3">
                                                        <img class="rounded-circle" src="{{ asset('storage/images/user.png') }} " alt="">
                                                    </div>
                                                    <div class="hapo-review-content-username mr-3">
                                                    <p class="m-0 p-0">{{ $courseReview->user->name }} </p>
                                                    </div>
                                                    <div class="hapo-review-content-time">
                                                        <p class="m-0 p-0">{{ $courseReview->format_created_at }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hapo-review-content-body">
                                                <div class="hapo-review">
                                                    <div class="hapo-form-review" id="{{ $courseReview->id }}">
                                                        <div class="m-2 hapo-content-review w-100" id="content{{ $courseReview->id }}">
                                                            <p class="text-justify">
                                                                {{ $courseReview->content }}
                                                            </p>
                                                        </div>
                                                        @if(Auth::user() && Auth::user()->id == $courseReview->user->id)
                                                            <div class="hapo-form-review-hidden" id="form{{ $courseReview->id }}">
                                                                <form action=" {{ route('review.update.course', $courseReview->id) }} " method="POST">
                                                                    @csrf
                                                                    <input type="text" hidden name="course_id" value="{{ $course->id }} " data-id=" {{ $course->id }} ">
                                                                    <textarea name="content" cols="30" rows="3" class="form-control mb-3" placeholder="Message"> {{ $courseReview->content }} </textarea>
                                                                    @error('content')
                                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                                    @enderror
                                                                    <div class="d-flex align-items-center justify-content-between">
                                                                        <div>
                                                                            <button class="btn btn-primary cancelLesson px-3 mr-2">Cancel</button>
                                                                            <button type="submit" class="btn btn-learn px-3" data-id=" {{ $course->id }} ">Update</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="dropleft hapo-review-drop" id="drop{{ $courseReview->id }}">
                                                                <div id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <img src=" {{ asset('storage/images/more.png') }} " id="hapo-more">
                                                                </div>
                                                                <div class="dropdown-menu" aria-labelledby="dLabel">
                                                                    <div class="dropdown-divider"></div>
                                                                    <div class="btn btn-edit-mess dropdown-item">Edit message</div>
                                                                    <a href=" {{ route('review.destroy.lessson', $courseReview->id) }} " class="dropdown-item">Delete message</a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                 </div>
                                            </div>
                                        </div>
                                        <hr>
                                        @endforeach
                                    </div>
                                    @if ($course->check_user_course)

                                    <div class="leave-commnent">
                                        <div class="hapo-review-leave-comment mb-3">Leave a Comment</div>
                                        <form action=" {{ route('review.store.course') }} " method="POST">
                                            @csrf
                                            <input type="text" hidden name="course_id" id="courseId" value="{{ $course->id }} " data-id=" {{ $course->id }} ">
                                            <textarea name="content" id="content" cols="30" rows="3" class="form-control mb-3" placeholder="Message"></textarea>
                                            @error('content')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                           <div class="d-flex align-items-center justify-content-between">
                                               @if(Auth::check())
                                               <button type="submit" id="submitLesson" class="btn btn-learn px-3" data-id=" {{ $course->id }} " >Send</button>
                                               @else
                                               <div  class="card-link-more btn btn-learn px-3" data-toggle=modal data-target=#exampleModal >Send</div>
                                               <input type="text" hidden value="{{ $course->id }}" class="idDirect">
                                               @endif
                                           </div>
                                        </form>
                                    </div>

                                    @endif
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 course-info h-50 ml-5 w-100 px-0 ">
                    <div class="hapo-description mb-3 overflow-hidden">
                       <div class="p-3 d-flex flex-column align-items-center">
                            <div class="hapo-description-header text-warning">Teacher</div>
                            <hr>
                            <div class="hapo-description-body d-flex flex-column align-items-center justify-content-center">
                                <div class="hapo-review-content-avatar">
                                    <img class="rounded-circle" style="width: 90px;height: 90px;"
                                        src="{{ asset('storage/images/user.png') }} " alt="">
                                </div>
                                <div class="hapo-review-content-username text-left">
                                    <div class="m-0 p-0 mt-3 h5" style="color: #5C5C5C;">name: {{ $courseTeacher->name }} </div>
                                </div>
                                <div class="hapo-review-content-username">
                                    <div class="m-0 p-0 mt-3 h5" style="color: #5C5C5C;">email: {{ $courseTeacher->email }} </div>
                                </div>
                                <div class="hapo-review-content-username">
                                    <div class="m-0 p-0 mt-3 h5" style="color: #5C5C5C;">phone: {{ $courseTeacher->phone }} </div>
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="hapo-data-lesson-detail">
                        <div class="course-info-text row m-0">
                            <div class="col-6 m-0 p-0">
                               <div class="row m-0">
                                    <div class="col-10 m-0 p-0">
                                        <i class="fas fa-users"></i> Learners
                                    </div>
                                    <div class="col-2 m-0 p-0 "> : </div>
                               </div>
                            </div>
                            <div class="col-6 m-0 p-0 hapo-text">{{ $course->count_user }}</div>
                        </div>
                        <div class="course-info-text row m-0">
                            <div class="col-6 m-0 p-0">
                               <div class="row m-0">
                                    <div class="col-10 m-0 p-0">
                                        <i class="far fa-list-alt"></i> Lessons
                                    </div>
                                    <div class="col-2 m-0 p-0 "> : </div>
                               </div>
                            </div>
                            <div class="col-6 m-0 p-0 hapo-text">{{ $course->count_lesson }} lessons</div>
                        </div>
                        <div class="course-info-text row m-0">
                            <div class="col-6 m-0 p-0">
                                <div class="row m-0">
                                    <div class="col-10 m-0 p-0">
                                        <i class="far fa-clock"></i> Times
                                    </div>
                                    <div class="col-2 m-0 p-0 "> : </div>
                                </div>
                            </div>
                            <div class="col-6 m-0 p-0 hapo-text">
                                @if ($course->time['minutes'] == 0)
                                {{ $course->time['hours'] }} h
                                @else
                                {{ $course->time['hours'] }} h {{ $course->time['minutes'] }} m
                                @endif
                            </div>
                        </div>
                        {{-- <div class="course-info-text d-flex align-content-center flex-wrap">
                            <i class="fas fa-hashtag mr-2"></i> Tags :
                            @foreach ($tags as $tag)
                                <form action="{{ route('tag.search', $tag->id) }}" class="mx-1">
                                    <label for="{{ $tag->id }}"><span class="badge badge-light badge-custom ">{{ $tag->tag_name }}</span></label>
                                    <input type="submit" hidden id="{{ $tag->id }}">
                                </form>
                            @endforeach
                        </div> --}}
                        <div class="course-info-text row m-0">
                            <div class="col-6 m-0 p-0">
                                <div class="row m-0">
                                    <div class="col-10 m-0 p-0">
                                        <i class="far fa-money-bill-alt"></i> Price
                                    </div>
                                    <div class="col-2 m-0 p-0 "> : </div>
                                </div>
                            </div>
                            <div class="col-6 m-0 p-0 hapo-text">{{ number_format($course->price) }} $</div>
                        </div>
                    </div>
                    <div class="mt-3 mb-5">
                        <div class="course-info-tittle d-flex justify-content-center align-items-center">Other Courses</div>
                        <div class="other-list">
                            @foreach ($otherCourses as $key => $other)
                                <div class="other-list-item py-3 row mx-0 ">
                                  <a href="{{ route('course.detail', $other->id) }}" class="col-10 no-gutters-custom"><strong>{{ ++$key }}.</strong> {{ $other->course_name }}.</a>
                                </div>
                            @endforeach
                            <div class="text-center p-4">
                                <a href=" {{ route('course.all') }}" class="btn btn-learn p-2 px-4">View all ours courses</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('scripts')
<script>
    $(doccument).ready(function() {
        $('.addToCartBtn').click(function(e) {
            e.preventDefault();
        });
    });
</script>
@endsection --}}
