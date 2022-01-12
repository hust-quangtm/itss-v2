@extends('layouts.app')
@section('title','Lesson Detail')
@section('content')
    <div class="hapo-detail">
        <div class="container">
            <div class="row pt-5">
                <div class="col-7 p-0">
                    <div class="hapo-detail-course-header d-flex justify-content-center">
                        <div class="rick-roll">
                            <iframe width="665" height="439" src="{{ $lesson->video_url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="tab-pane" id="navReview" role="tabpanel" aria-labelledby="navReviewTab">
                        <div class="px-3">
                             <div class="hapo-review-content">
                                 @foreach ($lessonReviews as $lessonReview)
                                 <div class="hapo-review-user">
                                     <div class="hapo-review-content-header d-flex justify-content-between align-items-center mt-5">
                                         <div class="d-flex align-items-center justify-content-start">
                                             <div class="hapo-review-content-avatar mr-3">
                                                 <img class="rounded-circle" src="{{ asset('storage/images/user.png') }} " alt="">
                                             </div>
                                             <div class="hapo-review-content-username mr-3">
                                             <p class="m-0 p-0">{{ $lessonReview->user->name }} </p>
                                             </div>
                                             <div class="hapo-review-content-time">
                                                 <p class="m-0 p-0">{{ $lessonReview->format_created_at }}</p>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="hapo-review-content-body">
                                         <div class="hapo-review">
                                             <div class="hapo-form-review" id="{{ $lessonReview->id }}">
                                                 <div class="m-2 hapo-content-review w-100" id="content{{ $lessonReview->id }}">
                                                     <p class="text-justify">
                                                         {{ $lessonReview->content }}
                                                     </p>
                                                 </div>
                                                 @if(Auth::user() && Auth::user()->id == $lessonReview->user->id)
                                                     <div class="hapo-form-review-hidden" id="form{{ $lessonReview->id }}">
                                                         <form action=" {{ route('review.update.course', $lessonReview->id) }} " method="POST">
                                                             @csrf
                                                             <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                                                             <input type="text" hidden name="course_id" value="{{ $lesson->course_id }} " data-id=" {{ $lesson->course_id }} ">
                                                             <textarea name="content" cols="30" rows="3" class="form-control mb-3" placeholder="Message"> {{ $lessonReview->content }} </textarea>
                                                             @error('content')
                                                                 <div class="alert alert-danger">{{ $message }}</div>
                                                             @enderror
                                                             <div class="d-flex align-items-center justify-content-between">
                                                                 <div>
                                                                     <button class="btn btn-primary cancelLesson px-3 mr-2">Cancel</button>
                                                                     <button type="submit" class="btn btn-learn px-3" data-id=" {{ $lessonReview->course_id }} ">Update</button>
                                                                 </div>
                                                             </div>
                                                         </form>
                                                     </div>
                                                     <div class="dropleft hapo-review-drop" id="drop{{ $lessonReview->id }}">
                                                         <div id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                             <img src=" {{ asset('storage/images/more.png') }} " id="hapo-more">
                                                         </div>
                                                         <div class="dropdown-menu" aria-labelledby="dLabel">
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
                                 <div class="hapo-review-leave-comment mb-3 mt-3">
                                     <label for="form-control-label" style="font-weight: bold; font-size: 23px; color: #505353;">Leave Comment</label>
                                 </div>
                                 <form action=" {{ route('review.store.course') }} " method="POST">
                                     @csrf
                                     <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                                     <input type="hidden" name="course_id" value="{{ $lesson->course_id }}">
                                     <textarea name="content" id="content" cols="30" rows="3" class="form-control mb-3" placeholder="Message"></textarea>
                                     @error('content')
                                         <div class="alert alert-danger">{{ $message }}</div>
                                     @enderror
                                    <div class="d-flex align-items-center justify-content-between mb-5">
                                        @if(Auth::check())
                                        <button type="submit" id="submitLesson" class="btn btn-learn px-3" data-id=" {{ $lesson->course_id }} " >Send</button>
                                        @else
                                        <div  class="card-link-more btn btn-learn px-3" data-toggle=modal data-target=#exampleModal >Send</div>
                                        <input type="text" hidden value="{{ $lesson->course_id }}" class="idDirect">
                                        @endif
                                    </div>
                                 </form>
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
                        <div class="course-info-tittle d-flex justify-content-center align-items-center" style="color: #ff9500">Other Courses</div>
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
