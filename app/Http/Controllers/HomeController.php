<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Review;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $course = Course::OrderByStudents(Course::ORDER['most'])->limit(config('variable.course'))->get();
        $courseOld = Course::orderBy('id', 'DESC')->limit(config('variable.course'))->get();
        $reviews = Review::orderBy('rating', 'DESC')->limit(config('variable.reviews'))->get();
        $fiveStar = config('variable.five_star');
        $courseCount = Course::count();
        $lessonCount = Lesson::count();
        $userCount = User::where('role_id', User::ROLE['user'])->count();
        $data = [
            'course' => $course,
            'courseOld' => $courseOld,
            'reviews' => $reviews,
            'fiveStar' => $fiveStar,
            'courseCount' => $courseCount,
            'lessonCount' => $lessonCount,
            'userCount' => $userCount,
        ];
        return view('index', $data);
    }
}
