@extends('layouts.app')
@section('title','Examination Result')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Results of your test</div>

                <div class="card-body">
                    <p>Total points: {{ $result->total_points }} points</p>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-8">
                        <div class="d-flex justify-content-between mb-3">
                            <a href="{{ route('test', [$tests[0]->course_id, $tests[0]->id]) }}" class="btn btn-info">Start test again</a>
                            <a href="{{ route('course.detail', [$tests[0]->course_id]) }}" class="btn btn-success">Back to course</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
