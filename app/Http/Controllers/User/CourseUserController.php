<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseUserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $carts= session()->get('cart', []);
        foreach ($carts as $course) {
            $course = Course::findOrFail($course['course_id']);
            $course->learner()->attach(Auth::user()->id);
        }
        $carts = session()->put('cart', []);
        return redirect()->route('course.all')->with('success', 'Take the course successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        $course->learner()->detach(Auth::user()->id);
        return redirect()->back();
    }
}
