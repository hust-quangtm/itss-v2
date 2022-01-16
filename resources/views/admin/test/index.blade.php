@extends('admin.index')
@section('title','Admin-test-list')
@section('contents')
<div class="container-fluid">
    @if ($message = Session::get('message'))
        <div class="alert alert-success alert-block my-2" id="myAlert">
            <button type="button" class="close" data-dismiss="alert">X</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="hapo-admin py-3">
        <div class="hapo-admin-header d-flex justify-content-between py-3">
            <div class="d-flex col-12">
                <div class="hapo-admin-header-name px-3 d-flex align-items-center col-10">
                    Tests List
                </div>
                <div class="ml-4 text-right">
                    <a href="{{ route('admin.test.create', $course->id) }}" class="btn btn-danger" role="button">Create Test</a>
                </div>

            </div>
        </div>
        <div>
            <h3 class="my-3">Test List Course: - {{ $course->course_name }}</h3>
        </div>
        <div class="hapo-admin-body mt-1 pb-5">

            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr align="center">
                        <th>No.</th>
                        <th class="fix-witdh-name">Name</th>
                        <th class="fix-witdh-description">Description</th>
                        <th class="col-1">Question</th>
                        <th class="fix-witdh-choice">Option</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($tests as $key => $test)
                   <tr>
                        <td class="text-center"> {{ $key + 1 }} </td>
                        <td>{{ $test->test_name }}</td>
                        <td>{{ $test->description }}</td>
                        <td class="text-center">{{ count($test->questions) }}</td>
                        <td class="d-flex justify-content-center align-items-center">
                            <!-- edit -->
                            <a href="{{ route('admin.test.edit', ['course_id'=>$test->course_id, 'test_id'=>$test->id])}}"  class="icon-edit mx-1" data-toggle="tooltip" data-placement="top" title="Edit Test"><span class="btn btn-primary"> <i class="fas fa-edit" aria-hidden="true"></i></span> </a>
                            <!-- delete -->
                            <form action="{{ route('admin.test.delete', ['course_id'=>$test->course_id, 'test_id'=>$test->id])}}" method="post" id="delete">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger icon-delete" data-toggle="tooltip" data-placement="top" title="Delete Test" onclick="return confirm('Are you sure ?')" >
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </form>
                       </td>
                   </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
