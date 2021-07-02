@extends('teacher.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        {{--Flash message section--}}
        <div class="row">
            <div class="col-md-12">
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(session()->has('deleted'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('deleted') }}</strong>
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
                        <h1 class="m-0 text-dark">Assignment list of <b>{{$courseid}}</b></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/teacher')}}">Home</a></li>
                            <li class="breadcrumb-item active">Assignment List</li>
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
                        <a href="{{url("/teacher/$courseid/create-course-assignment")}}">
                            <button type="submit" class="btn btn-primary m-2">Create an Assignment</button>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Assignment Title</th>
                                <th scope="col">Teacher Course ID</th>
                                <th scope="col">Full Mark</th>
                                <th scope="col">Open Date</th>
                                <th scope="col">Last Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($courseAssignments as $row)
                                <tr>
                                    <th scope="row">{{$i}}</th>
                                    @if(strlen($row->assignment_title) > 40)
                                        <td>{{substr($row->assignment_title,0,35) . ' ....'}}</td>
                                    @else
                                        <td>{{$row->assignment_title}}</td>
                                    @endif
                                    <td>{{$row->teacher_course_id}}</td>
                                    <td>{{$row->assignment_fullmarks}}</td>
                                    <td>{{date('d M Y',strtotime($row->assignment_opendate))}}</td>
                                    <td>{{date('d M Y',strtotime($row->assignment_lastdate))}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{url("/teacher/$row->course_assignment_id/edit-assignment")}}">
                                                <button type="button" class="btn btn-sm btn-warning m-1">Edit</button>
                                            </a>
                                            <form action="{{url("/teacher/$row->course_assignment_id/delete-assignment")}}" method="post" onsubmit="return confirm('Do you really want delete this assignment??');">
                                                @csrf
                                                @method("DELETE")
                                                <button class="btn btn-sm btn-danger m-1">Delete</button>
                                            </form>
                                            <a href="{{url("/teacher/$row->course_assignment_id/$row->teacher_course_id/marking-students")}}">
                                                <button type="submit" class="btn btn-sm btn-primary m-1">Start Marking</button>
                                            </a>
                                            <a href="{{route('studentMarks',$row->course_assignment_id)}}">
                                                <button type="submit" class="btn btn-sm btn-success m-1" title="Click to export assignment marks in excel">Export Marks</button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @php($i++)
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
