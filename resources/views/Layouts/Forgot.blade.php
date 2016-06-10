<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Forgot Password</title>

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{asset('/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{asset('/dist/css/AdminLTE.min.css')}}">
        <link rel="stylesheet" href="{{asset('/plugins/iCheck/square/blue.css')}}">
        <link rel="stylesheet"href="{{asset('css/styles.css')}}">
        <script src="{{asset('JavaScript/jquery-2.2.2.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>

        <script src="{{asset('JavaScript/Validations.js')}}"></script>

    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>Framework</b></a>
            </div>
            <div class="login-box-body">
                @if ( session()->has('password_message') )
                <div class="alert alert-info"> {{ session()->get('password_message') }}</div>
                @endif
                <p class="login-box-msg">Forgot Password</p>
                <form action="{{URL::route('retrivepassword')}}" method="post" id="Form">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class='form-group has-feedback'>
                        <input type="email" class="form-control" placeholder="Email" id="UserName" name="UserName">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <label for="UserName" class="error"></label>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <button type="submit" name="forgot" id="forgot" class="btn btn-primary ">Forgot Password</button>
                        </div>

                    </div>
                </form>
            </div>

        </div>

    </body>
</html>
