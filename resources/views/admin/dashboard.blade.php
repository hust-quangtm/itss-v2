@extends('admin.index')
@section('title','Admin-DashBoard')
@section('contents')
    <div class="row container-fluid">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
            <div class="inner ml-5">
                <h3>{{$num_course}}</h3>

                <p>Coures</p>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
            <div class="inner ml-5">
                <h3>{{$num_lesson}}</h3>

                <p>Lesson</p>
            </div>
            <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
            <div class="inner ml-5">
                <h3>{{$num_user}}</h3>

                <p>User</p>
            </div>
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
            <div class="inner ml-5">
                <h3>{{$learner}}</h3>

                <p>Learners</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            </div>
        </div>
        <!-- ./col -->
    </div>
@endsection
