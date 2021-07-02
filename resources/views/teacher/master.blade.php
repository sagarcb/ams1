<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>Dashboard</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{url("")}}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url("")}}/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    {{--Teacher Profile design stylesheet--}}
    <link rel="stylesheet" href="{{url("")}}/css/teacher-profile.css">

    {{--Teacher add course design--}}
    <link rel="stylesheet" href="{{url("")}}/css/add-course.css">

    {{--Student marking page style--}}
    <link rel="stylesheet" href="{{url("")}}/css/assignment-student.css">

    {{--jquery data table--}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

    @yield('stylesheet')
    <!-- jQuery -->
    <script src="{{url("")}}/plugins/jquery/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{url('/teacher')}}" class="nav-link">Home</a>
            </li>
        </ul>


        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Logout -->
            <li class="nav-item dropdown">
                <a href="{{url('teacher/logout')}}" class="nav-link">Logout</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                        class="fas fa-th-large"></i></a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{url('/teacher')}}" class="brand-link">
                <img src="{{url("")}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                     style="opacity: .8">
            <span class="brand-text font-weight-light">Teacher Dashboard</span>
        </a>
        <?php $id = session('teacherId');?>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    @if(!empty(session('teacherImage')))
                        <img src="{{asset("uploads/".session('teacherImage')."")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                             style="opacity: .8">
                    @else
                        <img src="{{url("")}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                             style="opacity: .8">
                    @endif
                    <a href="{{"/teacher/profile/$id"}}" class="d-block float-right ml-2"><b>{{explode(' ',session('teacherName'))[0]}}</b></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-open">
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                    <li class="nav-item has-treeview menu-open">
                                        <a href="#" class="nav-link">
                                            <p>
                                                Manage Courses
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="{{url('/teacher/add-course')}}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Add New Course</p>
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="{{url('/teacher/course-list')}}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>My Courses</p>
                                                </a>
                                            </li>

                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    {{--maiin contentes--}}
    @yield('content')
    {{--main contents--}}

<!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2020-2021 <a href="https://sub.edu.bd">State University Of Bangladesh</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<!-- Bootstrap 4 -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script src="{{url("")}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url("")}}/dist/js/adminlte.min.js"></script>
@yield('script')
{{--jquery data table--}}

</body>
</html>
