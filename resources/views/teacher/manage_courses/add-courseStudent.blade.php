@extends('teacher.master')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add student under {{$courseid}} Course</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add student</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        @if(session()->has('message'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{ session()->get('message') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row addCourseRow">
                    <div class="col-md-12 add-course">
                        <form action="{{url("/teacher/$courseid/add-courseStudent")}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="student_name" class="col-sm-2 col-form-label">Student Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="student_name" id="student_name"
                                           placeholder="Student Name">
                                    @error('student_name')
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="student_id" class="col-sm-2 col-form-label">Student ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="student_id" id="student_id"
                                           placeholder="Student ID">
                                    @if(session()->has('errorMsg'))
                                    <span style="color: red">This student Id already registered for this course!!!</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="course_id" class="col-sm-2 col-form-label">Course ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="course_id" id="course_id"
                                           value="{{$courseid}}" readonly>
                                    @error('teacher_course_id')
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <input type="text" name="teacher_id" value="{{session('teacherId')}}" hidden>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Add Student</button>
                                    @foreach($errors->all() as $row)
                                        <p style="color: red">{{$row}}</p>
                                    @endforeach
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
