@extends('teacher.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        {{--Flash message section--}}
        <div class="row">
            <div class="col-md-12">
                @if(\Illuminate\Support\Facades\Session::has('message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{\Illuminate\Support\Facades\Session::get('message')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    {{--Flash message section--}}

    <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Create Assignment for {{$courseid}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/teacher')}}">Home</a></li>
                            <li class="breadcrumb-item active">Course Assignment</li>
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
                        <form id="courseAssignment" action="{{url("/teacher/course-assignment/create")}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="assignmentTitle">Assignment Title</label>
                                <input type="text" class="form-control" name="assignment_title" id="assignmentTitle" placeholder="Title of Assignment">
                                @error('assignment_title')
                                <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="teacherCourseId">Teacher Course ID</label>
                                    <input type="text" class="form-control" id="teacherCourseId" name="teacher_course_id" value="{{$courseid}}" readonly>
                                </div>
                                <div class="col">
                                    <label for="fullMark">Full Mark</label>
                                    <input type="number" class="form-control" id="fullMark" name="assignment_fullmarks" placeholder="Assignment Full mark">
                                    @error('assignment_fullmarks')
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="openDate">Open Date</label>
                                    <input type="date" class="form-control" id="openDate" name="assignment_opendate">
                                    @error('assignment_opendate')
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="lastDate">Last Date</label>
                                    <input type="date" class="form-control" id="lastDate" name="assignment_lastdate">
                                    @error('assignment_lastdate')
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Create Assignment</button>
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
