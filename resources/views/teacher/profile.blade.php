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
                        <h1 class="m-0 text-dark">{{$teacher_info->teacher_name}}'s Profile</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/teacher')}}">Home</a></li>
                            <li class="breadcrumb-item active">{{$teacher_info->teacher_name}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->



        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                {{--Image Section Starts--}}
                <div class="col-md-12">
                    <div class="image text-center">
                        @if(!empty($teacher_info->avatar))
                            <img src="{{""}}/uploads/{{$teacher_info->avatar}}" alt="">
                        @else
                            <img src="{{""}}/images/avatar-icon.png" alt="">
                        @endif

                    </div>
                </div>
                {{--Image section ends--}}

                {{--User Description Section Starts--}}
                <div class="col-md-12">
                    <div class="description text-center">
                        <h4>{{$teacher_info->teacher_name}}</h4>
                        <h4>ID: {{$teacher_info->teacher_id}}</h4>
                        <a href="{{url("teacher/$teacher_info->teacher_id/edit")}}"><i class="fas fa-circle"></i>Edit Profile</a>
                        <a href="{{url("/teacher/$teacher_info->teacher_id/change-pass")}}" class="ml-2"><i class="fas fa-circle"></i>Change Password</a>
                    </div>
                </div>
                {{--User Description Section Ends--}}
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <script !src="">
        var t = document.getElementsByTagName('title');
        document.getElementsByTagName('title').innerHTML = "Profile";
    </script>

@endsection
