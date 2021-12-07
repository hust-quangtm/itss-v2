@extends('layouts.app')
@section('title','Lesson Detail')
@section('content')
<div class="head-detail container-fluid mt-2 d-flex align-items-center">
    <ul class="pl-5 d-flex align-content-center justify-content-center">
        <li class="mx-2"><a href=" {{ route('home') }} ">Home</a></li> >
        <li class="mx-2"><a href=" {{ route('course.all') }} ">All courses</a></li> >
        <li class="mx-2"><a href=" {{ route('course.detail', $lesson->course->id) }} ">Courses detail</a></li> >
        <li class="mx-2"><a href="#">Lesson detail</a></li>
    </ul>
</div>
    <div class="hapo-detail">
        <div class="container">
            <div class="row pt-5">
                <div class="col-7 p-0">
                    <div class="hapo-detail-course-header d-flex justify-content-center">
                        {{-- <img src="{{ asset('storage/images/'.$lesson->course->image) }} " alt=""> --}}
                        <video controls width="665" height="439">
                            <source src="{{ asset('storage/images/php-intro.mp4') }}">
                        </video>
                    </div>
                    <div class="hapo-detail-content-left mt-3 mb-5">
                        <nav class="hapo-nav-detail">
                            <div class="nav nav-tabs nav-fill hapo-nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="navLessonTab" data-toggle="tab" href="#navLesson" role="tab" aria-controls="nav-login" aria-selected="true">Description</a>
                                <a class="nav-item nav-link" id="navTeacherTab" data-toggle="tab" href="#navTeacher" role="tab" aria-controls="nav-register" aria-selected="false">Teachers</a>
                                <a class="nav-item nav-link" id="navProgramTab" data-toggle="tab" href="#navProgram" role="tab" aria-controls="nav-program" aria-selected="false">Program</a>
                                <a class="nav-item nav-link" id="navReviewTabLeson" data-toggle="tab" href="#navReviewLesson" role="tab" aria-controls="nav-review" aria-selected="false">Review</a>
                            </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="navLesson" role="tabpanel" aria-labelledby="navLessonTab">
                                <div class="hapo-lesson-description px-3 mt-3">
                                        <h4 class="hapo-description-header">
                                            Descriptions Lesson
                                        </h4>
                                        <div class="hapo-lesson-contentdes text-justify">
                                            {{ $lesson->description }}
                                        </div>
                                </div>
                                <div class="hapo-lesson-requirement px-3 mt-3">
                                        <h4 class="hapo-requirement-header">
                                            Requirements
                                        </h4>
                                        <div class="hapo-lesson-requicontent text-justify">
                                            {{ $lesson->description }}
                                        </div>
                                </div>
                                <div class="hapo-tag px-3 mt-5 mb-3 d-flex">
                                       <div class="d-flex justify-content-center">
                                            <h4>Tag: </h4>
                                            @foreach ($courseTags as $tag)
                                                <form action="{{ route('tag.search', $tag->id) }}" class="mx-1">
                                                    <label for="{{ $tag->id }}"><span class="tag-item ml-2 d-block btn btn-light badge-custom ">{{ $tag->tag_name }}</span></label>
                                                    <input type="submit" hidden id="{{ $tag->id }}">
                                                </form>
                                            @endforeach
                                       </div>
                                    </div>
                            </div>
                            <div class="tab-pane fade" id="navTeacher" role="tabpanel" aria-labelledby="navTeacherTab">
                               <h4 class="hapo-teacher-header mt-4">
                                   Main Teachers
                               </h4>
                               <div class="hapo-teacher-body d-flex align-items-center ml-2 mt-4">
                                    <div class="hapo-teacher-image">
                                        <img src="{{ asset('storage/images/teacher.png') }} " alt="">
                                    </div>
                                    <div class="hapo-teacher-content ml-3 d-flex flex-column ">
                                        <span class="hapo-teacher-name"> {{ $lesson->course->teacher->name }} </span>
                                        <span class="hapo-teacher-experience">Second Year Teacher</span>
                                        <span class="hapo-teacher-contact mt-2">
                                            <i class="fab fa-google-plus-g"></i>
                                            <i class="fab fa-facebook-f"></i>
                                            <i class="fab fa-slack"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="hapo-teacher-description mt-3">
                                    <p class="text-justify">
                                        {{ $lesson->course->teacher->about }}
                                    </p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navProgram" role="tabpanel" aria-labelledby="navProgramTab">
                                <h4 class="hapo-program-header mt-4 mb-5">
                                    Program
                                </h4>
                                <table class="table">
                                    <tbody>
                                        @for ($i = 0; $i < 10; $i++)
                                            <tr>
                                                <td class="text-justify d-flex justify-content-between align-items-center">
                                                    <div class="d-flex justify-content-between hapo-program-image">
                                                        <img src="{{ asset('storage/images/pdf.png') }} " alt="">
                                                        <p class="hapo-program-lesson my-0 ml-3 d-flex align-items-center justify-content-center">Lesson</p>
                                                    </div>
                                                    <p class="hapo-program-name m-0 text-left d-flex align-items-center justify-content-center">Program learn HTML/CSS Program learn HTML/CSS </p>
                                                    <a href="" class="course-other-item-button px-3 py-2 btn-learn">Preview</a>
                                                </td>
                                            </tr>
                                        @endfor
                                        <tr>
                                            <td class="text-center"> "Not found lesson !!!"</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="navReviewLesson" role="tabpanel" aria-labelledby="navReviewTabLeson">
                                <h4 class="hapo-review-header mt-2 px-3">
                                    {{ $lesson->lesson_review_count }} Reviews
                                </h4>
                                <hr>
                                <div class="hapo-review-body px-3 d-flex">
                                    <div class="hapo-review-bodyleft d-flex justify-content-center align-items-center flex-column">
                                       <p class="hapo-review-star m-0">{{ $lesson->lesson_avg_star }}/5</p>
                                       <span>
                                        @for ($i = 0; $i < $ratingStar['five_star']; $i++)
                                            @if ($i < $lesson->lesson_avg_star)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                        </span>
                                        <p class="hapo-review-rating">{{ $lesson->lesson_review_count }} Ratings</p>
                                    </div>
                                    <div class="hapo-review-bodyright ml-4">
                                       <div class="mt-3 d-flex align-items-center justify-content-between px-3 ">
                                            <div class="pr-0">5 star</div>
                                            <div class="progress w-75">
                                                <input type="text" value="{{ $lesson->getLessonPrecentRating($ratingStar['five_star']) }}%" hidden id="fiveStarVal">
                                                <div class="progress-bar" id="fiveStar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                              </div>
                                            <div class="">{{ $lesson->getLessonRatingCount($ratingStar['five_star']) }}</div>
                                       </div>
                                       <div class="mt-3 d-flex align-items-center justify-content-between px-3 ">
                                            <div class="pr-0">4 star</div>
                                            <div class="progress w-75">
                                                <input type="text" value="{{ $lesson->getLessonPrecentRating($ratingStar['four_star']) }}%" hidden id="fourStarVal">
                                                <div class="progress-bar" id="fourStar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="">{{ $lesson->getLessonRatingCount($ratingStar['four_star']) }}</div>
                                        </div>
                                        <div class="mt-3 d-flex align-items-center justify-content-between px-3 ">
                                            <div class="pr-0">3 star</div>
                                            <div class="progress w-75">
                                                <input type="text" value="{{ $lesson->getLessonPrecentRating($ratingStar['three_star']) }}%" hidden id="threeStarVal">
                                                <div class="progress-bar" id="threeStar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="">{{ $lesson->getLessonRatingCount($ratingStar['three_star']) }}</div>
                                        </div>
                                        <div class="mt-3 d-flex align-items-center justify-content-between px-3 ">
                                            <div class="pr-0">2 star</div>
                                            <div class="progress w-75">
                                                <input type="text" value="{{ $lesson->getLessonPrecentRating($ratingStar['two_star']) }}%" hidden id="twoStarVal">
                                                <div class="progress-bar" id="twoStar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="">{{ $lesson->getLessonRatingCount($ratingStar['two_star']) }}</div>
                                        </div>
                                        <div class="mt-3 d-flex align-items-center justify-content-between px-3 ">
                                            <div class="pr-0">1 star</div>
                                            <div class="progress w-75">
                                                <input type="text" value="{{ $lesson->getLessonPrecentRating($ratingStar['one_star']) }}%" hidden id="oneStarVal">
                                                <div class="progress-bar" id="oneStar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="">{{ $lesson->getLessonRatingCount($ratingStar['one_star']) }}</div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="hapo-review-content">
                                    <div class="hapo-review-showall">Show all review <i class="fas fa-sort-down"></i></div>
                                    @foreach ($lessonReviews as $lessonReview)
                                    <div class="hapo-review-user">
                                        <div class="hapo-review-content-header d-flex justify-content-between mt-5">
                                           <div class="d-flex justify-content-start align-items-center">
                                                <div class="hapo-review-content-avatar mr-3">
                                                    <img class="rounded-circle" src="{{ asset('storage/images/user.png') }} " alt="">
                                                </div>
                                                <div class="hapo-review-content-username mr-3">
                                                    <p class="m-0 p-0">{{ $lessonReview->user->name }} </p>
                                                </div>
                                                <?php $star = $lessonReview->rating ?>
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
                                                    <p class="m-0 p-0">{{ $lessonReview->format_created_at }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hapo-review-content-body">
                                            <div class="hapo-review">
                                               <div class="hapo-form-review" id="{{ $lessonReview->id }}">
                                                    <div class="m-2 hapo-content-review w-100" id="content{{ $lessonReview->id }}">
                                                        <p class="text-justify d-flex align-content-center flex-wrap">
                                                            {{ $lessonReview->content }}
                                                        </p>
                                                        <div class="hapo-review-footer">
                                                            <a href="#" class="course-other-item-button px-3 py-2 btn-learn hapo-review-reply">Reply</a>
                                                        </div>
                                                    </div>
                                                    @if(Auth::user() && Auth::user()->id == $lessonReview->user->id)
                                                    <div class="hapo-form-review-hidden" id="form{{ $lessonReview->id }}">
                                                        <form action=" {{ route('review.update.lesson', $lessonReview->id) }} " method="POST">
                                                            @csrf
                                                            <input type="text" hidden name="lesson_id"  value="{{ $lesson->id }} " data-id=" {{ $lesson->id }} ">
                                                            <textarea name="content"  cols="30" rows="3" class="form-control mb-3" placeholder="Message"> {{ $lessonReview->content }} </textarea>
                                                            @error('content')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                           <div class="d-flex align-items-center justify-content-between">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="mr-3 hapo-review-leave-comment">Vote:</div>
                                                                    <div class="rating">
                                                                        <input type="radio" class="rating" id="starFive{{ $lessonReview->id }}" name="rating" value="5" /><label for="starFive{{ $lessonReview->id }}" title="Rocks!">5 stars</label>
                                                                        <input type="radio" class="rating" id="starFour{{ $lessonReview->id }}" name="rating" value="4" /><label for="starFour{{ $lessonReview->id }}" title="Pretty good">4 stars</label>
                                                                        <input type="radio" class="rating" id="starThree{{ $lessonReview->id }}" name="rating" value="3" /><label for="starThree{{ $lessonReview->id }}" title="Meh">3 stars</label>
                                                                        <input type="radio" class="rating" id="starTwo{{ $lessonReview->id }}" name="rating" value="2" /><label for="starTwo{{ $lessonReview->id }}" title="Kinda bad">2 stars</label>
                                                                        <input type="radio" class="rating" id="starOne{{ $lessonReview->id }}" name="rating" value="1" /><label for="starOne{{ $lessonReview->id }}" title="Sucks big time">1 star</label>
                                                                    </div>
                                                                </div>
                                                               <div>
                                                                    <button class="btn btn-info cancelLesson px-3 mr-2">Cancel</button>
                                                                    <button type="submit" class="btn btn-learn px-3" data-id=" {{ $lesson->id }} ">Update</button>
                                                               </div>
                                                           </div>
                                                        </form>
                                                    </div>
                                                    <div class="dropleft hapo-review-drop" id="drop{{ $lessonReview->id }}">
                                                        <div id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <img src=" {{ asset('storage/images/more.png') }} " id="hapo-more">
                                                        </div>
                                                        <div class="dropdown-menu" aria-labelledby="dLabel">
                                                            <div class="dropdown-item">Unfollow message</div>
                                                            <div class="dropdown-divider"></div>
                                                            <div class="btn btn-edit-mess dropdown-item">Edit message</div>
                                                            <a href=" {{ route('review.destroy.lessson', $lessonReview->id) }} " class="dropdown-item">Delete message</a>
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
                                    <form action=" {{ route('review.store.lesson') }} " method="POST">
                                        @csrf
                                        <input type="text" hidden name="lesson_id" id="lessonId" value="{{ $lesson->id }} " data-id=" {{ $lesson->id }} ">
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
                                            <button type="submit" id="submitLesson" class="btn btn-learn px-3" data-id=" {{ $lesson->id }} ">Send</button>
                                       </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 course-info h-50 ml-5 w-100 px-0">
                    <div class="hapo-data-lesson-detail">
                        <div class="course-info-text row m-0">
                            <div class="col-6 m-0 p-0">
                                <div class="row m-0">
                                    <div class="col-10 m-0 p-0">
                                        <i class="fas fa-book"></i> Course
                                    </div>
                                    <div class="col-2 m-0 p-0 "> : </div>
                                    </div>
                                </div>
                            <div class="col-6 m-0 p-0 hapo-text">{{ $lesson->course->course_name }}</div>
                        </div>
                        <div class="course-info-text row m-0">
                            <div class="col-6 m-0 p-0">
                                <div class="row m-0">
                                    <div class="col-10 m-0 p-0">
                                        <i class="fas fa-users"></i> Learners
                                    </div>
                                    <div class="col-2 m-0 p-0 "> : </div>
                                    </div>
                                </div>
                            <div class="col-6 m-0 p-0 hapo-text">{{ $lesson->count_user_lesson }}</div>
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
                            <div class="col-6 m-0 p-0 hapo-text"> {{ $lesson->time_lesson }}</div>
                        </div>
                        <div class="course-info-text d-flex align-content-center  flex-wrap">
                            <i class="fas fa-hashtag mr-2"></i> Tags :
                            @foreach ($courseTags as $tag)
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
                            <div class="col-6 m-0 p-0 hapo-text">{{ number_format($lesson->price) }} $</div>
                        </div>
                        <div class="course-info-text">
                            <div class="text-center pb-lg-0 pb-md-2 pb-3 m-3">
                                <a href="{{ route('lesson.user.destroy', [$lesson->id, $lesson->course->id]) }} " class="btn btn-light hapo-lesson-btn border-0 py-lg-0 px-4 py-2"  onclick="return confirm('Are you sure you want to leave this lesson?');" >Leave this Lesson</a>
                            </div>
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
