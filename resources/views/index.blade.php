@extends('layouts.app')
@section('title','Learn Online')
@section('content')
<section class="container-fluid hapo-wrap-banner">
    <div class="hapo-slide-dect">
        {{-- <div class="hapo-txt">
            Learn Anytime, Anywhere
        </div>
        <div class="hapo-txt-title">
            <b>at HapoLearn <img alt="hapoOw" class="hapo-ow" src="{{ asset('storage/images/ower.png') }} "> !</b>
        </div>
        <div class="hapo-txt-dect">
            <p class="">Interactive lessons, "on-the-go" <br> practice, peer support.</p>
        </div>
        <a href=" {{ route('course.all') }} " class="hapo-slide-button">
            <span class="hapo-slide-button-link" >Start Learning Now!</span>
        </a> --}}
    </div>
    <div class="block-messenger">
        <div class="toggle-class">
            <div class="block-chat row">
                <div class="col-1">
                    <img alt="" class="img-hapo" src="{{ asset('storage/images/Ellipse%207.png') }} ">
                </div>
                <div class="block-content col-9 mt-1 ml-1 d-flex flex-column">
                    <span class="web-name text-left">HapoLearn</span>
                    <div class="block-alert d-flex align-items-center justify-content-center mt-3 ml-2">
                        <p class="text-alert mt-3">HapoLearn xin chào bạn.
                        Bạn có cần chúng tôi hỗ trợ gì không?</p>
                    </div>
                    <div class="login-mess mt-3 text-center">
                        <a href="#" class="hapo-button-messager-link d-flex justify-content-center align-items-center">
                            <img src=" {{ asset('storage/images/Vector.png') }} " alt="" class="mr-2">
                            Đăng nhập vào Messager
                        </a>
                    </div>
                    <span class="txt-chat d-flex justify-content-center align-items-center">Chat với HapoLearn trong Messenger</span>
                </div>
                <span class="fa fa-times close ml-3 d-flex justify-content-center align-items-center rounded-circle"></span>
            </div>
        </div>
        <div class="messenger d-flex justify-content-center align-items-center position-fixed "><img alt="" class= "icon-mes" src="{{ asset('storage/images/icon_mes.png') }} "></div>
    </div>
</section>
<div class="color-fix"></div>
<section class="hapo-wrap-courses container">
    <div class="hapo-course-all">
        <div class="hapo-course w-100 d-md-flex flex-column flex-md-row justify-content-center">
            @foreach ($course as $item)
            <div class="card hapo-course-item col-md-4 col-12 p-0" >
                <img class="card-img-top  hapo-course-header img-fluid pt-3 px-md-5 py-md-5 mt-md-0" src="{{ asset('storage/images/allcourse.png') }} " alt="Card image cap" style="background-color: #3F6185">
                <div class="card-body pt-4 pb-lg-4 pb-0 px-0 ">
                    <h5 class="card-title text-center pt-lg-2 mb-xl-3">{{ $item->course_name }} </h5>
                    <p class="card-text text-center p-0 m-auto pl-3 pr-3">{{ $item->description }}</p>
                    <div class="text-center pb-lg-0 pb-md-2 pb-3 m-3">
                        <a href=" {{ route('course.detail', $item->id) }} " class="btn btn-light hapo-courses-btn border-0 py-lg-0 px-4 py-2 ">Take This Course</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="hapo-course-link all-courses col-12 text-center d-flex align-items-center justify-content-center">
            <a href=" {{ route('course.all') }} " class="hapo-courses-link-all">View All Other Courses <img alt="&gt;&gt;&gt;" src="{{ asset('storage/images/direct_icon.png') }}"></a>
        </div>
    </div>
</section>
{{-- <section class="hapo-wrap-inf container-fluid">
    <img class="hapo-inf-topleft" src="{{ asset('storage/images/mbwhy.png') }}">
    <div class="container hapo-inf-content">
        <span class="hapo-inf-heading text-fix col-sm-12 col-1 offset-sm-0 offset-4">Why HapoLearn?</span>
        <div class="row hapo-inf-body align-items-center">
            <ul class="col-md-7 col-xl-6 col-12 px-md-4 p-0 hapo-content align-self-end">
                <li class="ml-0 text-center">
                    <img src="{{ asset('storage/images/icon_V.png') }}" alt=""> Interactive lessons, "on-the-go" practice, peer
                    support.
                </li>
                <li class="ml-0 text-center">
                    <img src="{{ asset('storage/images/icon_V.png') }}" alt=""> Interactive lessons, "on-the-go" practice, peer
                    support.
                </li>
                <li class="ml-0 text-center">
                    <img src="{{ asset('storage/images/icon_V.png') }}" alt=""> Interactive lessons, "on-the-go" practice, peer
                    support.
                </li>
                <li class="ml-0 text-center">
                    <img src="{{ asset('storage/images/icon_V.png') }}" alt=""> Interactive lessons, "on-the-go" practice, peer
                    support.
                </li>
                <li class="ml-0 text-center">
                    <img src="{{ asset('storage/images/icon_V.png') }}" alt=""> Interactive lessons, "on-the-go" practice, peer
                    support.
                </li>
            </ul>
            <img class="col-xl-6 col-md-5 hapo-inf-right pr-xl-0 pl-xl-5 hapo-inf-image-md" src="{{ asset('storage/images/image_inf_2.png') }}" >
        </div>
    </div>
</section> --}}
{{-- <section class="hapo-feedback container pb-lg-4">
    <div class="hapo-title-feedback mt-5 pt-lg-5 text-center">
        <span class="hapo-txt-title">Feedback</span>
        <hr/>
        <span class="hapo-txt-decs">
            What other students turned professionals have to say about us
            <br class="d-md-block d-none">
            after learning with us and reaching their goals
        </span>
    </div>
    <div class="hapo-slide-block row mt-5">
        @foreach ($reviews as $review)
        <div class="hapo-block-cmt d-flex flex-column col-12">
            <div class="hapo-element-cmt d-flex flex-row mx-auto">
                <div class="pt-4">
                    <img class="hapo-boder-left ml-4" src="{{ asset('storage/images/border-left.png') }}" alt="">
                </div>
                <div class="hapo-cmt ml-2">
                    <p> {{ $review->content}}
                    </p>
                </div>
            </div>
            <div class="hapo-element-account d-flex flex-row">
                <img class="img-fluid img-account ml-lg-3 rounded-circle" src="{{ asset('storage/users/'. $review->user->avatar) }}" alt="">
                <div class="hapo-block-infor ml-2 d-flex flex-column">
                    <span class="hapo-txt-name">{{ $review->user->name }}</span>
                    <span class="hapo-txt-lang">PHP</span>
                    <span>
                        @for ($i = 0; $i < $fiveStar; $i++)
                            @if ($i < $review->rating)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="controls-top row d-flex justify-content-between position-relative">
      <a class="btn-sm prev"><i class="fas fa-chevron-left"></i></a>
      <a class="btn-sm next"><i class="fas fa-chevron-right"></i></a>
    </div>
</section> --}}
<section class="hapo-wrap-learn container-fluid">
    <div class="container hapo-learn-content d-flex  flex-column justify-content-center align-items-center p-0 m-auto">
        <div class="hapo-content-learn text-center">
          <span>Become a member of our <br> growing community!</span>
        </div>
        <div class="hapo-learn-link p-3">
            <a class="btn btn-learn-link border-0  px-md-5 py-md-3 px-4 py-2 " href="{{ route('course.all') }}">Start Learning Now!</a>
        </div>
    </div>
</section>
<section class="hapo-wrap-statistic container">
    <div class="hapo-content-statistic p-4">
        <div class="hapo-statistic-header d-flex justify-content-center align-items-center">
            <p class="text-center pt-2">Statistic</p>
        </div>
        <div class="hapo-statistic-body row d-flex justify-content-center pl-0 pr-0">
            <div class="hapo-statistic-count col-md-4 pl-0 pr-0">
                <div class="hapo-statistic-name">
                    Courses
                </div>
                <div class="hapo-statistic-data">
                    {{ $courseCount }}
                </div>
            </div>
            <div class="hapo-statistic-count col-md-4 pl-0 pr-0">
                <div class="hapo-statistic-name">
                    Lessons
                </div>
                <div class="hapo-statistic-data">
                    {{ $lessonCount }}
                </div>
            </div>
            <div class="hapo-statistic-count col-md-4 pl-0 pr-0">
                <div class="hapo-statistic-name">
                    Learners
                </div>
                <div class="hapo-statistic-data">
                    {{ $userCount }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
