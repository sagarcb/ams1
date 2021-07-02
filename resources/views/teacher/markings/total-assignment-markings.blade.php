@extends('teacher.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">All Students Marks for {{$courseId}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Course List</a></li>
                            <li class="breadcrumb-item active">All Students marks</li>
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
                    <div class="col-md-12">
                        <button type="submit" id="exportBtn" class="btn btn-success">Export To Excel</button>
                        <table class="table table-striped" id="tableToExcel">
                            <thead>
                            <tr>
                                <th scope="col">Student Id</th>
                                <?php $i = 1;?>
                                @foreach($assignments as $assignment)
                                <th scope="col">Assignment {{$i}}</th>
                                 <?php $i++;?>
                                @endforeach
                                <th scope="col">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $student)
                                <?php $total = 0;?>
                            <tr>
                                <td>{{$student->student_id}}</td>
                                @foreach($assignments as $assignment)
                                    <?php $flag = 0;?>
                                    @foreach($submissions as $submit)
                                        @if($submit->course_assignment_id == $assignment->course_assignment_id && $submit->course_student_id == $student->student_id)
                                            <td>{{$submit->marks}}</td>
                                            <?php
                                                $flag = 1;
                                                $total = $total + $submit->marks;
                                                ?>
                                        @endif
                                    @endforeach
                                    @if($flag == 0)
                                        <td>0</td>
                                    @endif
                                @endforeach
                                <td><?=$total?></td>
                            </tr>
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

@section('script')
    <script src="{{asset('exportExcel/jquery.table2excel.js')}}"></script>
    <script !src="">
        $("#exportBtn").click(function(){
            $("#tableToExcel").table2excel({
                // exclude CSS class
                name: "Worksheet Name",
                filename: "Assignment_marks", //do not include extension
                fileext: ".xls", // file extension
                preserveColors:true
            });
        });
    </script>
@endsection
