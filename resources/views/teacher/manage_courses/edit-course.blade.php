@extends('teacher.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Course</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Course</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row addCourseRow">
                    <div class="col-md-12 add-course">
                        <form action="{{url("/teacher/$course->teacher_course_id/updateCourseInfo")}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <label for="courseid" class="col-sm-2 col-form-label">Course ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="teacher_course_id" id="courseid" placeholder="Course ID" value="{{old('teacher_course_id',$course->teacher_course_id)}}" readonly>
                                    @error('teacher_course_id')
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="courseTitle" class="col-sm-2 col-form-label">Course Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="course_title" id="courseTitle" placeholder="Name of the Course" value="{{old('course_title',$course->course_title)}}">
                                    @error('course_title')
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="teacher_id" class="col-sm-2 col-form-label">Teacher ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="teacher_id" id="teacher_id" placeholder="Teacher ID" value="{{session('teacherId')}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="semester" class="col-sm-2 col-form-label">Semester</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="semester" id="semester">
                                        <option>Summer</option>
                                        <option>Spring</option>
                                        <option>Fall</option>
                                    </select>
                                    @error('semester')
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="year" class="col-sm-2 col-form-label">Year</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="year" id="year" placeholder="Year" value="{{old('year',$course->year)}}">
                                    @error('year')
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Update Course Info</button>
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
