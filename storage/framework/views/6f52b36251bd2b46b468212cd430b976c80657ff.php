<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Change Password</title>

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo e(asset('/bootstrap/css/bootstrap.min.css')); ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo e(asset('/dist/css/AdminLTE.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('/plugins/iCheck/square/blue.css')); ?>">
        <link rel="stylesheet"href="<?php echo e(asset('css/styles.css')); ?>">
        <script src="<?php echo e(asset('JavaScript/jquery-2.2.2.min.js')); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>

        <script src="<?php echo e(asset('JavaScript/Validations.js')); ?>"></script>

    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>Framework</b></a>
            </div>
            <div class="login-box-body">
                <?php if( session()->has('password_message') ): ?>
                <div class="alert alert-info"> <?php echo e(session()->get('password_message')); ?></div>
                <?php endif; ?>
                <p class="login-box-msg">Forgot Password</p>
                <form action="<?php echo e(URL::route('resetpassword')); ?>" method="post" id="Form">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"/>
                   
                    <div class='form-group has-feedback'>
                        <input type="email" class="form-control" placeholder="Email" id="UserName" name="UserName">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <label for="UserName" class="error"></label>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="Password" id="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <label for="Password" class="error"></label>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="Confirm"  id="Confirm"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <label for="Confirm" class="error"></label>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <button type="submit" name="forgot" id="forgot" class="btn btn-primary ">Change Password</button>
                        </div>

                    </div>
                </form>
            </div>

        </div>

    </body>
</html>
