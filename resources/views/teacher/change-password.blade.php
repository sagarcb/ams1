@extends('teacher.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Change your password</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/teacher')}}">Home</a></li>
                            <li class="breadcrumb-item active">Change-password</li>
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
                        <form action="{{url("/teacher/update-pass/$teacher->teacher_id")}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <label for="old-pass" class="col-sm-2 col-form-label">Old Password</label>
                                <div class="col-sm-5">
                                    <input type="password" name="old_pass" class="form-control" id="old-pass" placeholder="Password" value="{{old('old_pass')}}">

                                    @error('old_pass')
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="new-pass" class="col-sm-2 col-form-label">New password</label>
                                <div class="col-sm-5">
                                    <input type="password" name="password" class="form-control" id="new-pass" placeholder="Password">
                                    @error('password')
                                    <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="confirm-pass" class="col-sm-2 col-form-label">Confirm password</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="confirm_pass" id="confirm-pass" placeholder="Password">
                                    @error('confirm_pass')
                                        <span style="color: red">{{$message}}</span>
                                    @enderror
                                    <div class="mt-2">
                                        <p style="color: red">{!! Session::has('msg') ? Session::get("msg") : '' !!}</p>
                                        <input type="checkbox" name="show-pass" id="show-pass">
                                        <label for="show-pass" class="ml-1">Show password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-5 text-center">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
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

    <script type="text/javascript">
        $('#show-pass').on('click',function () {
            if (this.checked){
                $('#new-pass').attr('type','text');
                $('#confirm-pass').attr('type','text');
            }else {
                $('#new-pass').attr('type','password');
                $('#confirm-pass').attr('type','password');
            }
        });

    </script>

@endsection
