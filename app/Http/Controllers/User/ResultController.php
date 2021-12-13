<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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

    public function resultUser()
    {
        $tests = [];
        $results = Result::whereHas('user', function ($query) {
            $query->whereId(auth()->id());
        })->get();

        foreach ($results as  $result) {
            $test = Test::where('id', $result->test_id)->get();
            array_push($tests, $test);
        }

        return view('user-result', compact('results', 'tests'));
    }
}
