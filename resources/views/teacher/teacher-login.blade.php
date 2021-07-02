<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teacher Login</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <link rel="stylesheet" href="{{url("")}}/css/teacher-login.css">

</head>
<body>

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
            <h5 style="color: #757575; margin-top: 5px">Teachher Login</h5>
        </div>

        <!-- Login Form -->
        <form action="{{url('/')}}" method="post">
            @csrf
            <input type="text" id="login" class="fadeIn second" name="teacherid" placeholder="Teacher ID">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
            <input type="submit" class="fadeIn fourth" value="Log In">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            {{--<a class="underlineHover" href="#">Forgot Password?</a>--}}
            @if (Session::has('error'))
                <p style="color: red">{{Session('error')}}</p>
            @endif
        </div>

    </div>
</div>

</body>
</html>
