@extends('teacher.master')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Course Student</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Course Student</li>
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
                        <form action="{{url("/teacher/$studentInfo->id/update-courseStudent")}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <label for="student_name" class="col-sm-2 col-form-label">Student Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="student_name" id="student_name"
                                           placeholder="Student Name" value="{{old('student_name',$studentInfo->student_name)}}">
                                    @error('student_name')
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="student_id" class="col-sm-2 col-form-label">Student ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="student_id" id="student_id"
                                           placeholder="Student ID" value="{{old('student_id',$studentInfo->student_id)}}">
                                    @error('student_id')
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="course_id" class="col-sm-2 col-form-label">Course ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="course_id" id="course_id"
                                           value="{{$studentInfo->course_id}}" readonly>
                                    @error('course_id')
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Update Student Info</button>
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
