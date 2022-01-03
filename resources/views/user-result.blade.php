@extends('layouts.app')
@section('title','User Result')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Results of your examination</div>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Test Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Result</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($tests as $key1 => $test)
                            @foreach($test as $key => $data)
                                @if($data->course_id == $course->id)
                                    <tr>
                                        <th scope="row">{{$key1 + 1}}</th>
                                        <td>{{$data->test_name}}</td>
                                        <td>{{$results[$key1]->created_at}}</td>
                                        <td>{{$results[$key1]->total_points}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                  </table>
            </div>
            <div class="d-flex justify-content-end">
                <div class="">
                    <div class="mb-3">
                        <button onclick="history.back()" class="btn btn-info">Back to course</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
