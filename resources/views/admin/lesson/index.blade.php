@extends('admin.index')
@section('title','Admin-course-list')
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
                    Lesson List
                </div>
                {{-- <form class="form-inline col-4 text-center" method="GET" action="{{ route('admin.lesson.index', $courseId) }}" id="formSearchUser">
                    <input class="form-control" type="text" placeholder="Search" name="name" value="{{ request('name') }}" size="30">
                    <i class="fa fa-search"></i>
                </form> --}}
                <div class="ml-4 text-right">
                    <a href="{{ Route('admin.lesson.create', $courseId) }}" class="btn btn-danger" role="button">Create Lesson</a>
                </div>

            </div>
        </div>
        <div>
            <h3 class="my-3">Lesson List Course: - {{ $courseName }}</h3>
        </div>
        <div class="hapo-admin-body mt-1 pb-5">

            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr align="center">
                        <th>STT</th>
                        <th class="fix-witdh-name">Name</th>
                        <th class="fix-witdh-description">Description</th>
                        <th class="fix-witdh-time">Time</th>
                        <th class="fix-witdh-choice">Option</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($lessons as $key => $lesson)
                   <tr>
                        <td class="text-center"> {{ $lessons->firstItem() + $key }} </td>
                        <td>{{ $lesson->lesson_name }}</td>
                        <td>{{ $lesson->description }}</td>
                        <td> {{ $lesson->time_lesson }} </td>
                        <td class="d-flex justify-content-center align-items-center">
                            {{-- show --}}
                            {{-- <a href="#"  class="icon-show mx-1" ><span class="btn btn-info"><i class="fas fa-folder-open" aria-hidden="true"></i></span></a> --}}
                            <!-- edit -->
                            <a href="{{ route('admin.lesson.edit', [ $courseId, $lesson->id]) }}"  class="icon-edit mx-1" data-toggle="tooltip" data-placement="top" title="Edit Lesson"><span class="btn btn-primary"> <i class="fas fa-edit" aria-hidden="true"></i></span> </a>
                            <!-- delete -->
                            <form action="{{ route('admin.lesson.destroy', [ $courseId, $lesson->id]) }}" method="post" id="delete" data-toggle="tooltip" data-placement="top" title="Delete Lesson">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger icon-delete" onclick="return confirm('Are you sure ?')" >
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </form>
                       </td>
                   </tr>
                   @endforeach
                </tbody>
                {{-- <tfoot>
                    <tr align="center">
                        <th>STT</th>
                        <th class="fix-witdh-name">Name</th>
                        <th class="fix-witdh-description">Description</th>
                        <th class="fix-witdh-Price">requirement</th>
                        <th class="fix-witdh-choice">Option</th>
                    </tr>
                </tfoot> --}}
            </table>
            <div class="col-12 text-right hapo-admin-pages">
                {{ $lessons->appends($_GET)->links('pagination') }}
            </div>
        </div>
    </div>
</div>
@endsection
