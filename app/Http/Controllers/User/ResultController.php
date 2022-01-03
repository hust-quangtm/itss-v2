<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Result;
use App\Models\Test;

class ResultController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($result_id)
    {
        $result = Result::whereHas('user', function ($query) {
                $query->whereId(auth()->id());
            })->findOrFail($result_id);

        $tests = Test::with(['questions' => function ($query) {
            $query->inRandomOrder()
                ->with(['questionOptions' => function ($query) {
                    $query->inRandomOrder();
                }]);
        }])
        ->whereHas('questions')
        ->get();

        return view('result', compact('result', 'tests'));
    }

    public function resultUser($course_id)
    {
        $tests = [];
        $course = Course::findOrFail($course_id);
        $results = Result::whereHas('user', function ($query) {
            $query->whereId(auth()->id());
        })->orderBy('id', 'desc')->get();

        foreach ($results as $key => $result) {
            $test = Test::where('id', $result->test_id)->get();
            array_push($tests, $test);
        }

        return view('user-result', compact('results', 'tests', 'course'));
    }
}
