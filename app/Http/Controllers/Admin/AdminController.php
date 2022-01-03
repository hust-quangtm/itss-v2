<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $course = Course::get();
        $lesson = Lesson::get();
        $user = User::get();
        $learner = User::where('role_id', User::ROLE['user'])->count();
        $num_course = count($course);
        $num_lesson = count($lesson);
        $num_user = count($user);
        return view('admin.dashboard', compact('num_course', 'num_lesson', 'num_user', 'learner'));
    }
}
