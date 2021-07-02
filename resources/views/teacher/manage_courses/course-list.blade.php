@extends('teacher.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">My Course List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/teacher')}}">Home</a></li>
                            <li class="breadcrumb-item active">My Course List</li>
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
                        @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session()->get('success') }}</strong>
                                <button type="button" class="close" id="closeBtn" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(session()->has('deleted'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session()->get('deleted') }}</strong>
                                <button type="button" class="close" id="closeBtn" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                <div class="col-md-12 text-center">
                    <table id="tableID" class='table table-bordered table-condensed table-striped table-hover table-sm display'>
                        <tr>
                            <th>Course ID</th>
                            <th>Course Title</th>
                            <th>Teacher ID</th>
                            <th>Semester</th>
                            <th>Year</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        @foreach($courses as $row)
                            <tr>
                                <td>{{$row->teacher_course_id}}</td>
                                <td>{{$row->course_title}}</td>
                                <td>{{$row->teacher_id}}</td>
                                <td>{{$row->semester}}</td>
                                <td>{{$row->year}}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{url("/teacher/$row->teacher_course_id/edit-course")}}">
                                            <button type="button" class="btn btn-sm btn-warning p-1 m-1">Edit</button>
                                        </a>
                                        <form action="{{url("/teacher/$row->teacher_course_id/delete-course")}}" method="post" onsubmit="return confirm('Do you really want to submit the form?');">
                                            @csrf
                                            @method("DELETE")
                                         <button class="btn btn-sm btn-danger p-1 m-1">Delete</button>
                                        </form>
                                        <a href="{{url("/teacher/$row->teacher_course_id/course-assignments")}}">
                                            <button type="submit" class="btn btn-sm btn-primary p-1 m-1">Assignments</button>
                                        </a>
                                        <a href="{{url("/teacher/$row->teacher_course_id/course-students")}}">
                                            <button type="submit" class="btn btn-sm btn-info p-1 m-1">Students List</button>
                                        </a>
                                        <a href="{{route('allMarks',$row->teacher_course_id)}}">
                                            <button type="submit" class="btn btn-sm btn-success p-1 m-1" title="To see all assignment Marking">All Marks</button>
                                        </a>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>


                </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <script>
        $(document).ready(function () {
            $('#tableID').dataTable();
        });
    </script>
@endsection









