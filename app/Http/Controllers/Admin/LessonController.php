<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $courseName = $course->course_name;

        $lessonCourse = Lesson::where([
            ['course_id', '=', $id],
            ['lesson_name', 'LIKE', "%" . $request->name . "%"],
        ])->paginate(config('variable.pagination'));

        $data = [
            'lessons' => $lessonCourse,
            'courseName' => $courseName,
            'courseId' => $id
        ];
        return view('admin.lesson.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('admin.lesson.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessonRequest $request, $id)
    {
        Lesson::create([
            'lesson_name' => $request->lesson_name,
            'time'        => $request->time,
            'description' => $request->description,
            'requirement' => $request->requirement,
            'video_url' => $request->video_url,
            'course_id' => $id,
        ]);

        return redirect()->route('admin.lesson.index', $id)->with('message', __('messages.create_message'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($courseId, $lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId);
        return view('admin.lesson.edit', compact('lesson', 'courseId', 'lessonId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LessonRequest $request, $courseId, $lessonId)
    {
        $data = $request->all();
        Lesson::find($lessonId)->update($data);
        return redirect()->route('admin.lesson.index', $courseId)->with('message', __('messages.update_message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($courseId, $lessonId)
    {
        Lesson::find($lessonId)->delete();
        return redirect()->route('admin.lesson.index', $courseId)->with('message', __('messages.delete_message'));
    }
}
