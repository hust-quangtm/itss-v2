<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\UserLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonUserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->lessonLearner()->attach(Auth::user()->id);
        return redirect()->route('lesson.detail', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $idCourse)
    {
        $lesson = Lesson::find($id);
        $lesson->lessonLearner()->detach(Auth::user()->id);
        return redirect()->route('course.detail', $idCourse);
    }
}
