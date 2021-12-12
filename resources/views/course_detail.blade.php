@extends('layouts.app')
@section('title','Course Detail')
@section('content')
<div class="head-detail container-fluid mt-2 d-flex align-items-center">
    <ul class="pl-5 d-flex align-content-center justify-content-center">
        <li class="mx-2"><a href=" {{ route('home') }} ">Trang  chủ</a></li> >
        <li class="mx-2"><a href=" {{ route('course.all') }} ">All courses</a></li> >
        <li class="mx-2"><a href="">Courses detail</a></li>
    </ul>
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
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="navLessonTab" data-toggle="tab" href="#navLesson" role="tab" aria-controls="nav-login" aria-selected="true">Lesson</a>
                                <a class="nav-item nav-link" id="navTeacherTab" data-toggle="tab" href="#navTeacher" role="tab" aria-controls="nav-register" aria-selected="false">Examination</a>
                                {{-- <a class="nav-item nav-link" id="navReviewTab" data-toggle="tab" href="#navReview" role="tab" aria-controls="nav-register" aria-selected="false">Review</a> --}}
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
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
                                                <a href="{{ route('course.user.destroy', $course->id) }} " class="btn btn-light hapo-lesson-btn border-0 py-lg-0 px-4 py-2"  onclick="return confirm('Bạn chắn chắn muốn rời khỏi khóa học này chứ?');" >Rời khóa học</a>
                                            </div>
                                        @else
                                            <form action="{{ route('course.user.store', $course->id) }}" method="post" class="text-center">
                                                @csrf
                                                @if (Auth::user())
                                                    <input type="submit" value="Thêm khóa học" class="btn btn-light hapo-courses-btn border-0 py-lg-0 px-4 py-2"  onclick="return confirm('Thêm vào giỏ hàng?');">
                                                @else
                                                    <a href="{{ route('course.detail', $course->id) }}" class="card-link-more btn btn-light hapo-courses-btn border-0 py-lg-0 px-4 py-2" {{ Auth::check() ? '' : 'data-toggle=modal data-target=#exampleModal' }}>Thêm vào giỏ hàng</a>
                                                    <input type="text" hidden value="{{ $course->id }}" class="idDirect">
                                                @endif
                                            </form>
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
                                <h4 class="hapo-teacher-header mt-2 p-3">
                                    Course's Examination
                                </h4>
                                {{-- <div class="hapo-teacher-body d-flex align-items-center ml-2 mt-4 p-3">
                                     <div class="hapo-teacher-image">
                                         <img src="{{ asset('storage/images/teacher.png') }} " alt="">
                                     </div>
                                     <div class="hapo-teacher-content ml-3 d-flex flex-column ">
                                         <span class="hapo-teacher-name">{{ $course->teacher->name }} </span>
                                         <span class="hapo-teacher-experience">Second Year Teacher</span>
                                         <span class="hapo-teacher-contact mt-2">
                                            <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-slack"></i></a>
                                         </span>
                                     </div>
                                 </div>
                                 <div class="hapo-teacher-description  p-3">
                                     <p class="text-justify">
                                        {{ $course->teacher->description }}
                                     </p>
                                 </div> --}}
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
                                    <h4 class="hapo-review-header mt-2 px-3">
                                        {{ $course->course_review_count }} Reviews
                                    </h4>
                                    <hr>
                                    <div class="hapo-review-body px-3 d-flex">
                                        <div class="hapo-review-bodyleft d-flex justify-content-center align-items-center flex-column">
                                           <p class="hapo-review-star m-0">{{ $course->course_avg_star }}/5</p>
                                           <span>
                                            @for ($i = 0; $i < $ratingStar['five_star']; $i++)
                                                @if ($i < $course->course_avg_star)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                            </span>
                                            <p class="hapo-review-rating">{{ $course->course_review_count }} Ratings</p>
                                        </div>
                                        <div class="hapo-review-bodyright ml-4">
                                           <div class="mt-3 d-flex align-items-center justify-content-between px-3 ">
                                                <div class="pr-0">5 star</div>
                                                <div class="progress w-75">
                                                    <input type="text" value="{{ $course->getCoursePrecentRating($ratingStar['five_star']) }}%" hidden id="fiveStarVal">
                                                    <div class="progress-bar" id="fiveStar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                  </div>
                                                <div class="">{{ $course->getCourseRatingCount($ratingStar['five_star']) }}</div>
                                           </div>
                                           <div class="mt-3 d-flex align-items-center justify-content-between px-3 ">
                                                <div class="pr-0">4 star</div>
                                                <div class="progress w-75">
                                                    <input type="text" value="{{ $course->getCoursePrecentRating($ratingStar['four_star']) }}%" hidden id="fourStarVal">
                                                    <div class="progress-bar" id="fourStar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="">{{ $course->getCourseRatingCount($ratingStar['four_star']) }}</div>
                                            </div>
                                            <div class="mt-3 d-flex align-items-center justify-content-between px-3 ">
                                                <div class="pr-0">3 star</div>
                                                <div class="progress w-75">
                                                    <input type="text" value="{{ $course->getCoursePrecentRating($ratingStar['three_star']) }}%" hidden id="threeStarVal">
                                                    <div class="progress-bar" id="threeStar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="">{{ $course->getCourseRatingCount($ratingStar['three_star']) }}</div>
                                            </div>
                                            <div class="mt-3 d-flex align-items-center justify-content-between px-3 ">
                                                <div class="pr-0">2 star</div>
                                                <div class="progress w-75">
                                                    <input type="text" value="{{ $course->getCoursePrecentRating($ratingStar['two_star']) }}%" hidden id="twoStarVal">
                                                    <div class="progress-bar" id="twoStar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="">{{ $course->getCourseRatingCount($ratingStar['two_star']) }}</div>
                                            </div>
                                            <div class="mt-3 d-flex align-items-center justify-content-between px-3 ">
                                                <div class="pr-0">1 star</div>
                                                <div class="progress w-75">
                                                    <input type="text" value="{{ $course->getCoursePrecentRating($ratingStar['one_star']) }}%" hidden id="oneStarVal">
                                                    <div class="progress-bar" id="oneStar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="">{{ $course->getCourseRatingCount($ratingStar['one_star']) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="hapo-review-content">
                                        <div class="hapo-review-showall">Show all review <i class="fas fa-sort-down"></i></div>
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
                                                    <?php $star = $courseReview->rating ?>
                                                    <div class="hapo-review-content-rating mr-3">
                                                        @for ($i = 0; $i < $ratingStar['five_star']; $i++)
                                                            @if ($i < $star)
                                                                <i class="fas fa-star"></i>
                                                            @else
                                                                <i class="far fa-star"></i>
                                                            @endif
                                                        @endfor
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
                                                            <div class="hapo-review-footer">
                                                                <a href="#" class="course-other-item-button px-3 py-2 btn-learn hapo-review-reply">Reply</a>
                                                            </div>
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
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="mr-3 hapo-review-leave-comment">Vote:</div>
                                                                            <div class="rating">
                                                                                <input type="radio" class="rating" id="starFive{{ $courseReview->id }}" name="rating" value="5" /><label for="starFive{{ $courseReview->id }}" title="Rocks!">5 stars</label>
                                                                                <input type="radio" class="rating" id="starFour{{ $courseReview->id }}" name="rating" value="4" /><label for="starFour{{ $courseReview->id }}" title="Pretty good">4 stars</label>
                                                                                <input type="radio" class="rating" id="starThree{{ $courseReview->id }}" name="rating" value="3" /><label for="starThree{{ $courseReview->id }}" title="Meh">3 stars</label>
                                                                                <input type="radio" class="rating" id="starTwo{{ $courseReview->id }}" name="rating" value="2" /><label for="starTwo{{ $courseReview->id }}" title="Kinda bad">2 stars</label>
                                                                                <input type="radio" class="rating" id="starOne{{ $courseReview->id }}" name="rating" value="1" /><label for="starOne{{ $courseReview->id }}" title="Sucks big time">1 star</label>
                                                                            </div>
                                                                        </div>
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
                                                                    <div class="dropdown-item">Unfollow message</div>
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
                                               <div class="d-flex align-items-center">
                                                    <div class="mr-3 hapo-review-leave-comment">Vote:</div>
                                                    <div class="rating">
                                                        <input type="radio" class="rating" id="starFive" name="rating" value="5" /><label for="starFive" title="Rocks!">5 stars</label>
                                                        <input type="radio" class="rating" id="starFour" name="rating" value="4" /><label for="starFour" title="Pretty good">4 stars</label>
                                                        <input type="radio" class="rating" id="starThree" name="rating" value="3" /><label for="starThree" title="Meh">3 stars</label>
                                                        <input type="radio" class="rating" id="starTwo" name="rating" value="2" /><label for="starTwo" title="Kinda bad">2 stars</label>
                                                        <input type="radio" class="rating" id="starOne" name="rating" value="1" /><label for="starOne" title="Sucks big time">1 star</label>
                                                    </div>
                                               </div>
                                               @if(Auth::check())
                                               <button type="submit" id="submitLesson" class="btn btn-learn px-3" data-id=" {{ $course->id }} " >Send</button>
                                               @else
                                               <div  class="card-link-more btn btn-learn px-3" data-toggle=modal data-target=#exampleModal >Send</div>
                                               <input type="text" hidden value="{{ $course->id }}" class="idDirect">
                                               @endif
                                           </div>
                                        </form>
                                    </div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 course-info h-50 ml-5 w-100 px-0">
                    <div class="hapo-description mb-3 overflow-hidden">
                       <div class="p-3">
                            <div class="hapo-description-header">Description course</div>
                            <hr>
                            <div class="hapo-description-body">
                                <p class="text-justify">
                                    {{ $course->description }}
                                </p>
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
                        <div class="course-info-text d-flex align-content-center flex-wrap">
                            <i class="fas fa-hashtag mr-2"></i> Tags :
                            @foreach ($tags as $tag)
                                <form action="{{ route('tag.search', $tag->id) }}" class="mx-1">
                                    <label for="{{ $tag->id }}"><span class="badge badge-light badge-custom ">{{ $tag->tag_name }}</span></label>
                                    <input type="submit" hidden id="{{ $tag->id }}">
                                </form>
                            @endforeach
                        </div>
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
