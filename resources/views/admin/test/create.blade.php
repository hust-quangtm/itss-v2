@extends('admin.index')
@section('title','Admin-Test-Create')
@section('contents')
    <div class="hapo-admin py-3">
        <div class="hapo-admin-header d-flex justify-content-between py-3">
            <div class="d-flex">
                <div class="hapo-admin-header-name px-3 d-flex align-items-center">
                    Create Test For: {{ $course->course_name}} Course
                </div>
            </div>
        </div>
        <div class="hapo-admin-body mt-1 pb-5">
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box box-primary">
                            <form role="form" method="POST" action="{{ route('admin.test.store') }}" enctype="multipart/form-data" class="col-xs-8">
                                @csrf
                                <div class="box-body mt-4 container-fluid">
                                    <input type="hidden" name="course_id" value="{{$course->id}}">
                                    <div class="form-group">
                                        <label for="name">Name: </label>
                                        <input type="text" class="form-control @error('test_name') is-invalid @enderror" id="testName" name="test_name" placeholder="Enter name" value="{{ old('test_name') }}" required>

                                        @error('test_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description: </label>
                                        <textarea rows="4" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>

                                        @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 container-fluid">
                                    <div class="card" id="questions">
                                        <div class="question">
                                            <div class="card-header d-flex flex-row col-12">
                                                <div class="col-11 mr-3">
                                                    <label for="">Question</label>
                                                    <input type="text" class="form-control" placeholder="Enter your question" name="question_text" required>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-end">
                                                    <a type="button" class="remove-question text-danger ml-lg-5 ml-3"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex flex-column">
                                                    <div class="col-12 d-flex flex-row">
                                                        <input type="text" class="form-control col-10 mr-2" placeholder="Option 1" name="question_answer_1_text" required>
                                                        <select class="form-control" name="question_answer_1_point">
                                                            <option value = "0">0</option>
                                                            <option value = "1">1</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 d-flex flex-row">
                                                        <input type="text" class="form-control col-10 mr-2" placeholder="Option 2" name="question_answer_2_text" required>
                                                        <select class="form-control" name="question_answer_2_point">
                                                            <option value = "0">0</option>
                                                            <option value = "1">1</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 d-flex flex-row">
                                                        <input type="text" class="form-control col-10 mr-2" placeholder="Option 3" name="question_answer_3_text" required>
                                                        <select class="form-control" name="question_answer_3_point">
                                                            <option value = "0">0</option>
                                                            <option value = "1">1</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 d-flex flex-row">
                                                        <input type="text" class="form-control col-10 mr-2" placeholder="Option 4" name="question_answer_4_text" required>
                                                        <select class="form-control" name="question_answer_4_point">
                                                            <option value = "0">0</option>
                                                            <option value = "1">1</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="">
                                        <a class="btn btn-success add-question">Add Question</a>
                                    </div>
                                </div>
                                <div class="box-footer mt-5 col-12 text-center">
                                    <a href="{{route('admin.test.index', $course->id)}}" type="button" class="btn btn-info">Back To List</a>
                                    <button type="submit" class="btn btn-success">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script>
        function changeName() {
            $('.question').each(function (index) {
                $(this).find('input[name="question_text"]').attr('name', 'question[new_' + (index + 1) + '][text]');
                $(this).find('input[name="question_answer_1_text"]').attr('name', 'question[new_' + (index + 1) + '][answer_1][text]');
                $(this).find('select[name="question_answer_1_point"]').attr('name', 'question[new_' + (index + 1) + '][answer_1][point]');
                $(this).find('input[name="question_answer_2_text"]').attr('name', 'question[new_' + (index + 1) + '][answer_2][text]');
                $(this).find('select[name="question_answer_2_point"]').attr('name', 'question[new_' + (index + 1) + '][answer_2][point]');
                $(this).find('input[name="question_answer_3_text"]').attr('name', 'question[new_' + (index + 1) + '][answer_3][text]');
                $(this).find('select[name="question_answer_3_point"]').attr('name', 'question[new_' + (index + 1) + '][answer_3][point]');
                $(this).find('input[name="question_answer_4_text"]').attr('name', 'question[new_' + (index + 1) + '][answer_4][text]');
                $(this).find('select[name="question_answer_4_point"]').attr('name', 'question[new_' + (index + 1) + '][answer_4][point]');
            });
        }
        $(document).ready(function() {
            let i = 0;
            changeName();
            $('.add-question').on('click', function(){
                i += 1;
                $('#questions').append('<div class="question">'
                    + '<div class="card-header d-flex flex-row col-12">'
                        + '<div class="col-11 mr-3">'
                            + '<label for="">Question</label>'
                            + '<input type="text" class="form-control" placeholder="Enter your question" name="question_text" required>'
                        + '</div>'
                        + '<div class="d-flex align-items-center justify-content-end">'
                            + '<a type="button" class="remove-question text-danger ml-lg-5 ml-3"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>'
                        + '</div>'
                    + '</div>'
                    + '<div class="card-body">'
                        + '<div class="d-flex flex-column">'
                            + '<div class="col-12 d-flex flex-row">'
                                + '<input type="text" class="form-control col-10 mr-2" placeholder="Option 1" name="question_answer_1_text" required>'
                                + '<select class="form-control" name="question_answer_1_point">'
                                    + '<option value = "0">0</option>'
                                    + '<option value = "1">1</option>'
                                + '</select>'
                            + '</div>'
                            + '<div class="col-12 d-flex flex-row">'
                                + '<input type="text" class="form-control col-10 mr-2" placeholder="Option 2" name="question_answer_2_text" required>'
                                + '<select class="form-control" name="question_answer_2_point">'
                                    + '<option value = "0">0</option>'
                                    + '<option value = "1">1</option>'
                                + '</select>'
                            + '</div>'
                            + '<div class="col-12 d-flex flex-row">'
                                + '<input type="text" class="form-control col-10 mr-2" placeholder="Option 3" name="question_answer_3_text" required>'
                                + '<select class="form-control" name="question_answer_3_point">'
                                    + '<option value = "0">0</option>'
                                    + '<option value = "1">1</option>'
                                + '</select>'
                            + '</div>'
                            + '<div class="col-12 d-flex flex-row">'
                                + '<input type="text" class="form-control col-10 mr-2" placeholder="Option 4" name="question_answer_4_text" required>'
                                + '<select class="form-control" name="question_answer_4_point">'
                                    + '<option value = "0">0</option>'
                                    + '<option value = "1">1</option>'
                                + '</select>'
                            + '</div>'
                        + '</div>'
                    +'</div>'
                );
                changeName();
            });
            $('body').on('click', '.remove-question', function() {
                $(this).parent().parent().parent().remove();
            });
        });
    </script>
@endsection
