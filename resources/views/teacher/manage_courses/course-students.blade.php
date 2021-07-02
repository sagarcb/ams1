@extends('teacher.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

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

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Students List under {{$courseid}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Students under {{$courseid}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row" >
                    <div class="col-md-12" id="courseStudentColumn">
                        <a href="{{url("/teacher/$courseid/add-courseStudent")}}" id="addStudentBtn">
                            <button type="submit" class="btn btn-primary mb-3">Add Student</button>
                        </a>
                        <table id="courseStudentTable"  class="table table-striped table-bordered table-sm text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Student ID</th>
                                <th scope="col">Course ID</th>
                                <th scope="col">Actions</th>

                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($courseStudents as $row)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$row->student_name}}</td>
                                    <td>{{$row->student_id}}</td>
                                    <td>{{$row->course_id}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{url("/teacher/$row->id/edit-courseStudent")}}">
                                                <button type="submit" class="btn btn-warning">Edit</button>
                                            </a>
                                            <form action="{{url("/teacher/$row->id/delete-courseStudent")}}" method="post"
                                                onsubmit="return confirm('Are you sure want to delete this student?')">
                                                @csrf
                                                @method('DELETE')
                                                <input type="text" name="course_id" value="{{$row->course_id}}" hidden>
                                                <input type="text" name="course_student_id" value="{{$row->student_id}}" hidden>
                                                <button class="btn btn-danger">delete</button>
                                            </form>
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
