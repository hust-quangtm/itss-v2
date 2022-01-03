@extends('layouts.app')
@section('title','Course Examination')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Test</div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            </div>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('test.store', [$tests[0]->test->course_id, $exam_id]) }}">
                        <input type="hidden" name="test_id" value="{{ $exam_id }}">
                        @csrf
                        <div class="card-header">{{ $tests[0]->test['test_name'] }}</div>

                        <div class="card mb-3">
                            @foreach($tests as $test)
                                <div class="card-body">
                                    <div class="card @if(!$loop->last)mb-3 @endif">
                                        <div class="card-header">{{ $test->question_text }}</div>
                                        <input type="hidden" name="questions[{{ $test->id }}]" value="">
                                        <div class="card-body">
                                            @foreach($test->questionOptions as $option)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="questions[{{ $test->id }}]" id="option-{{ $option->id }}" value="{{ $option->id }}"@if(old("questions.$test->id") == $option->id) checked @endif>
                                                    <label class="form-check-label" for="option-{{ $option->id }}">
                                                        {{ $option->option_text }}
                                                    </label>
                                                </div>
                                            @endforeach

                                            @if($errors->has("questions.$test->id"))
                                                <span style="margin-top: .25rem; font-size: 80%; color: #e3342f;" role="alert">
                                                    <strong>{{ $errors->first("questions.$test->id") }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
