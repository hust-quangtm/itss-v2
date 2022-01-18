<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\CourseTag;
use App\Models\Lesson;
use App\Models\Tag;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{  
    public function paymentIndex(){
        $createCourseFee = 100;
        return view('admin.course.payment', compact('createCourseFee'));
    }

    public function payment(){
        $createCourseTime = 3;
        $user = Auth::guard('admin')->user();
        if( $user ) { 
            $user->course_creation_times = $createCourseTime; 
            $user->save(); 
        }
        return redirect()->route('admin.courses.index')->with('message', 'Payment successfully! You can create 3 course!');
    }
}