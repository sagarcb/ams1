@extends('teacher.master')

@section('stylesheet')
    <link rel="stylesheet" href="{{asset('toast-notification/js-snackbar.css')}}">
@endsection

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
                        <h1 class="m-0 text-dark">Marking Students For <b><span id="course_id">{{$courseid}}</span></b></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/teacher')}}">Home</a></li>
                            <li class="breadcrumb-item active">Student List</li>
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
                    <div class="col-md-10 ml-2 mb-3">
                        <h4> <b>Assignment Title:</b>  {{$assignmentTitle->assignment_title}}</h4>
                        <h4> <b>Full Mark:</b>  <span id="fullMark">{{$assignmentTitle->assignment_fullmarks}}</span></h4>
                        <input type="text" id="assignmentId" value="{{$courseAssignmentId}}" hidden>
                        <input type="text" id="courseId" value="{{$courseid}}" hidden>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <form action="" id="markSubmitForm" class="ml-auto mr-auto m-5">
                            <div class="form-row ml-auto mr-auto">
                                <div class="col-2">
                                    <label for="studentId">Select Student Id</label>
                                    <select name="" id="studentId" class="form-control">
                                        <option value="">Select Student Id</option>
                                        @foreach($data as $student)
                                            <option value="{{$student->student_id}}">{{$student->student_id}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-1">
                                    <label for="status">Status</label>
                                    <input type="checkbox" id="status" class="form-control text-center">
                                </div>
                                <div class="col-1">
                                    <label for="mark">Mark</label>
                                    <input type="number" id="mark" class="form-control" placeholder="Mark">
                                </div>
                                <div class="col">
                                    <label for="comment">Comment</label>
                                    <input type="text" id="comment" class="form-control" placeholder="Comment">
                                </div>
                                <div class="col-2">
                                    <label for="submitBtn">Take Action</label>
                                    <button class="form-control btn btn-primary" style="width: 80%" id="submitBtn" type="submit">Save/Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table id="table_id"  class="table table-bordered display">
                            <thead>
                            <tr>
                                <th scope="col">Student ID</th>
                                <th scope="col">Submission Status</th>
                                <th scope="col">Mark</th>
                                <th scope="col">Comment</th>
                                <th class=".noExl" scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($assignmentSubmission as $row)
                                <tr data-id="{{$row->course_assignment_submission_id}}">
                                    <td class="student_id">{{$row->course_student_id}}</td>
                                    @if($row->submission_status == 0)
                                    <td class=".noExl" style="width: 30px"><span class="badge badge-warning t-status">Not Submitted</span></td>
                                    @else
                                    <td class=".noExl" style="width: 30px"><span class="badge badge-success t-status">Submitted</span></td>
                                    @endif
                                    <td><h4 class="t-marks">{{$row->marks}}</h4></td>
                                    <td><input type="text" class="form-control t-comment" value="{{$row->comments}}" readonly></td>
                                    <td class=".noExl">
                                        <button class="btn btn-warning editBtn">Edit</button>
{{--                                        <button data-id="{{$row->course_assignment_submission_id}}" class="btn btn-danger deleteBtn">Delete</button>--}}
                                    </td>
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


    <script type="text/javascript">

        const courseId = $('#courseId').val();
        const assignmentId = $('#assignmentId').val();


        $(document).ready( function () {
            $('#table_id').DataTable();
        });

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        //Check if the given mark is greater than Full Mark
        $(document).on('keyup','#mark',function () {
            const fullMark = $('#fullMark').text();
            if (parseInt($(this).val()) > parseInt(fullMark))
            {
                alert('Assignment Mark Cannot Be Greater Than Full Mark!!!');
                $(this).val('');
            }
        });

        $(document).ready(function () {
            if ($('#status').prop('checked') == true){
                $('#submitBtn').attr('disabled',false);
            }else {
                $('#submitBtn').attr('disabled',true);
            }

            $('#status').on('change',function () {
                if ($(this).prop('checked') == true){
                    $('#submitBtn').attr('disabled',false);
                }else {
                    $('#submitBtn').attr('disabled',true);
                }
            });
        });

        $(document).ready(function () {
            $(document).on('submit','#markSubmitForm',function (e) {
                e.preventDefault();
                let studentId = $('#studentId').val();
                let mark = $('#mark').val();
                let comment = $('#comment').val();

                if (studentId == ''){
                    e.preventDefault();
                    alert('Student Id field is required!!!');
                }
                if (mark == ''){
                    e.preventDefault();
                    alert('Mark Field is Required!!!');
                }

                if (studentId != '' && mark != ''){
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: '/teacher/assignmentSubmission',
                        data: {
                            course_student_id: studentId,
                            course_assignment_id: assignmentId,
                            teacher_course_id: courseId,
                            submission_status: 1,
                            marks: mark,
                            comments: comment
                        },
                        success: function (data) {
                            console.log(data);
                            $('#studentId option:selected').remove();
                            $('#status').prop('checked',false);
                            $('#mark').val('');
                            $('#comment').val('');
                            $('#submitBtn').attr('disabled',true);
                            if (data.submission_status == 0){
                                status = ` <td style="width: 30px"><span class="badge badge-warning t-status">Not Submitted</span></td>`;
                            }else {
                                status = `<td style="width: 30px"><span class="badge badge-success t-status">Submitted</span></td>`
                            }

                            const dataRow = $('tbody').find('tr[data-id='+data.course_assignment_submission_id+']');

                            if (dataRow.length > 0){
                                $(dataRow).children().children('.t-comment').val(data.comments);
                                $(dataRow).children().children('.t-marks').text(data.marks);
                            }else {
                                $('tbody').prepend(`
                            <tr data-id="${data.course_assignment_submission_id}">
                                    <td class="student_id">${data.course_student_id}</td>

                                     ${status}
                                    <td><h4 class="t-marks">${data.marks}</h4></td>
                                    <td><input type="text" class="form-control t-comment" value="${data.comments}" readonly></td>
                                    <td>
                                        <button class="btn btn-warning editBtn">Edit</button>
                                    </td>
                            </tr>`);
                            }
                            new SnackBar({
                                message: 'Data Added Successfully',
                                timeout: 3500,
                                status: 'success',
                                position: 'br'
                            });

                        },
                        error: function (error) {
                            console.log(error);
                        }
                    })

                }

            })
        });


        //Deleting option is removed at present
        // $(document).ready(function () {
        //     $(document).on('click','.deleteBtn',function () {
        //         let id = $(this).attr('data-id');
        //         let tableRow = $('tbody').find('tr[data-id="'+id+'"]');
        //
        //         if (confirm('Are you sure want to delete this Row?')){
        //             $.ajax({
        //                 type: 'POST',
        //                 url: '/teacher/deleteAssignmentSubmission',
        //                 data: {
        //                     id: id
        //                 },
        //                 success: function (data) {
        //                     $('tbody').find('tr[data-id="'+id+'"]').remove();
        //                     new SnackBar({
        //                         message: 'Data Successfully Deleted',
        //                         timeout: 3500,
        //                         status: 'danger',
        //                         position: 'br'
        //                     })
        //                 }
        //             })
        //         }
        //     });
        // });

    </script>
@endsection

@section('script')
    <script src="{{asset('toast-notification/js-snackbar.js')}}"></script>
    <script src="{{asset('js/assignment-student.js')}}"></script>
    <script src="{{asset('exportExcel/jquery.table2excel.js')}}"></script>
    <script !src="">
        $("#exportBtn").click(function(){
            $("#table_id").table2excel({
                // exclude CSS class
                exclude:".noExl",
                name: "Worksheet Name",
                filename: "Assignment_marks", //do not include extension
                fileext: ".xls", // file extension
                preserveColors:false

            });
        });
    </script>

@endsection
