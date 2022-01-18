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
                    Courses List
                </div>
                {{-- <form class="form-inline col-4 text-center" method="GET" action="{{ route('admin.courses.index') }}" id="formSearchUser">
                    <input class="form-control" type="text" placeholder="Search" name="name" value="{{ request('name') }}" size="30">
                    <i class="fa fa-search"></i>
                </form> --}}
                <div class="ml-4 text-right">
                    @if(auth()->user()->role_id == 2 && auth()->user()->course_creation_times == 0)
                        <a href="{{ Route('admin.payment.index') }}" class="btn btn-danger" role="button">Create Course</a>
                    @else
                        <a href="{{ Route('admin.courses.create') }}" class="btn btn-danger" role="button">Create Course</a>                       
                    @endif
                </div>
            </div>
        </div>
        <div class="hapo-admin-body mt-1 pb-5">

            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr align="center">
                        <th>STT</th>
                        <th class="fix-witdh-name">Image</th>
                        <th class="fix-witdh-name ">Name</th>
                        <th class="fix-witdh-description">Description</th>
                        <th class="fix-witdh-Price">Price</th>
                        <th class="fix-witdh-teacher">Teacher</th>
                        <th class="fix-witdh-choice">Option</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($courses as $key => $course)
                    @if($course->teacher->name == auth()->user()->name || auth()->user()->role_id == 2)
                    <tr>
                        <td class="text-center"> {{ $courses->firstItem() + $key }} </td>
                        <td class="text-center"><img src="{{ ($course->image == null) ? '' : asset('storage/images/' . $course->image) }}" alt="" class="rounded-circle" width="65px" height="65px"></td>
                        <td>{{ $course->course_name }}</td>
                        <td>{{ $course->description }}</td>
                        <td>{{ $course->price }} $</td>
                        <td>{{ $course->teacher->name }}</td>
                        <td class="d-flex justify-content-center align-items-center border-0">
                            <a href=" {{ route('admin.test.index', $course->id) }} "  class="icon-show mx-1"  data-toggle="tooltip" data-placement="top" title="Test List"><span class="btn btn-success"><i class="fas fa-book-open" aria-hidden="true"></i></span></a>
                            <!-- show -->
                            <a href=" {{ route('admin.lesson.index', $course->id) }} "  class="icon-show mx-1" data-toggle="tooltip" data-placement="top" title="Lesson List"><span class="btn btn-info"><i class="fas fa-folder-open" aria-hidden="true"></i></span></a>
                            <!-- edit -->
                            <a href="{{ route('admin.courses.edit', $course->id) }}"  class="icon-edit mx-1" data-toggle="tooltip" data-placement="top" title="Edit Course"><span class="btn btn-primary"> <i class="fas fa-edit" aria-hidden="true"></i></span> </a>
                            <!-- delete -->
                            <form action="{{ route('admin.courses.destroy', $course->id) }}" method="post" id="delete">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger icon-delete" data-toggle="tooltip" data-placement="top" title="Delete Course" onclick="return confirm('Are you sure ?')" >
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </form>
                       </td>
                   </tr>
                    @endif
                   @endforeach
                </tbody>
            </table>
            <div class="col-12 text-right hapo-admin-pages">
                {{ $courses->appends($_GET)->links('pagination') }}
            </div>
        </div>
    </div>
</div>
@endsection
