<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Option;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($course_id)
    {
        $tests = Test::where('course_id', $course_id)->with('questions')->get();
        $course = Course::findOrFail($course_id);

        return view('admin.test.index', compact('tests', 'course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($course_id)
    {
        $course = Course::findOrFail($course_id);

        return view('admin.test.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $test['test_name'] = $request->test_name;
        $test['description'] = $request->description;
        $test['course_id'] = $request->course_id;

        $data_test = Test::create($test);

        if ($request->question) {
            foreach ($request->question as $key => $question) {
                $data['test_id'] = $data_test->id;
                $data['question_text'] = $question['text'];
                $data_question = Question::create($data);

                if($question['answer_1'])
                {
                    $option['question_id'] = $data_question->id;
                    $option['option_text'] = $question['answer_1']['text'];
                    $option['points'] = $question['answer_1']['point'];
                    Option::create($option);
                }

                if($question['answer_2'])
                {
                    $option['question_id'] = $data_question->id;
                    $option['option_text'] = $question['answer_2']['text'];
                    $option['points'] = $question['answer_2']['point'];
                    Option::create($option);
                }

                if($question['answer_3'])
                {
                    $option['question_id'] = $data_question->id;
                    $option['option_text'] = $question['answer_3']['text'];
                    $option['points'] = $question['answer_3']['point'];
                    Option::create($option);
                }

                if($question['answer_4'])
                {
                    $option['question_id'] = $data_question->id;
                    $option['option_text'] = $question['answer_4']['text'];
                    $option['points'] = $question['answer_4']['point'];
                    Option::create($option);
                }
            }
        }

        return redirect()->route('admin.test.index', $request->course_id)
            ->with('message', __('messages.create_message'));
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
    public function edit($course_id, $test_id)
    {
        $test = Test::findOrFail($test_id);
        $questions = Question::where('test_id', $test->id)->with('questionOptions')->get();
        // dd($questions->toArray());

        return view('admin.test.edit', compact('test', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $course_id, $id)
    {

        $request_question = [];
        $question_all = Question::where('test_id', $id)->get();
        $test['test_name'] = $request->test_name;
        $test['description'] = $request->description;

        Test::findOrFail($id)->update($test);

        foreach ($request->question as $key => $question) {
            if (isset($question['id'])) {
                array_push($request_question, $question['id']);
                $question['question_text'] = $question['text'];

                Question::findOrFail($question['id'])->update($question);

                foreach ($question['answer'] as $key => $data) {
                    if ($data['option_id']) {
                        $option['option_text'] = $data['text'];
                        $option['points'] = $data['point'];

                        Option::findOrFail($data['option_id'])->update($option);
                    } else {
                        $option['option_text'] = $data['text'];
                        $option['points'] = $data['point'];
                        $option['question_id'] = $question['id'];
                        Option::create($option);
                    }
                }
            } else {
                $new_question['test_id'] = $id;
                $new_question['question_text'] = $question['text'];

                $data_question = Question::create($new_question);

                foreach ($question['answer'] as $data) {
                    $option['question_id'] = $data_question->id;
                    $option['option_text'] = $data['text'];
                    $option['points'] = $data['point'];

                    Option::create($option);
                }
            }
        }

        foreach ($question_all as $key => $data) {
            # code...
            if(!in_array($data->id, $request_question)) {
                Question::destroy($data->id);
            }
        }

        return redirect()->route('admin.test.edit', ['course_id'=>$course_id, 'test_id'=>$id])
                ->with('message', __('messages.update_message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($course_id, $test_id)
    {
        //
        Test::destroy($test_id);

        return redirect()->route('admin.test.index', $course_id)
            ->with('message', __('messages.delete_message'));
    }
}
