<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request)
    {
        $review = $request->all();
        $review['user_id'] = Auth::user()->id;
        Review::create($review);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $otherCourses = Course::query()->OrderByStudents(Course::ORDER['most'])
        ->limit(config('variable.other_course'))
        ->get();
        $lesson = Lesson::findOrfail($id);
        // dd($lesson->toArray());
        $lessonReviews = $lesson->lessonReviews;
        $courseTags = $lesson->course->tag;
        $ratingStar = [
            'five_star' => config('variable.five_star'),
            'four_star' => config('variable.four_star'),
            'three_star' => config('variable.three_star'),
            'two_star' => config('variable.two_star'),
            'one_star' => config('variable.one_star')
        ];
        return view('lesson_detail', compact(['lesson', 'otherCourses', 'lessonReviews', 'ratingStar', 'courseTags']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReviewRequest $request, $id)
    {
        $review = Review::findOrFail($id);
        $data = $request->all();
        $review->update($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Review::findOrFail($id)->delete();
        return redirect()->back();
    }
}
