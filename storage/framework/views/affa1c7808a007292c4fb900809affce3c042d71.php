<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Registration Page</title>

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link rel="stylesheet" href="<?php echo e(asset('/bootstrap/css/bootstrap.min.css')); ?>">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo e(asset('/dist/css/AdminLTE.min.css')); ?>">

        <link rel="stylesheet" href="<?php echo e(asset('/plugins/iCheck/square/blue.css')); ?>">
        <link rel="stylesheet"href="<?php echo e(asset('css/styles.css')); ?>">
        <script src="<?php echo e(asset('JavaScript/jquery-2.2.2.min.js')); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>

        <script src="<?php echo e(asset('JavaScript/Validations.js')); ?>"></script>
    </head>
    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="register-logo">
                <a href="#"><b>Framework</b></a>
            </div>

            <?php if(isset($message)): ?>
            <div class="alert alert-info"><?php echo e($message); ?></div>
            <?php endif; ?>

            <div class="register-box-body">
                <p class="login-box-msg">Register a new membership</p>

                <form action="<?php echo e(URL::route('Register')); ?>" method="post" id="Form">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"/>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Full name" id="FirstName" name="FirstName">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <label for="FirstName" class="error"></label>

                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Last name" id="LastName" name="LastName">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <label for="LastName" class="error"></label>
                    </div>
                    <div class="form-group has-feedback" id="gender" >
                        <label for="gender_male">
                            <input  type="radio" id="gender_male" value="Male" name="gender" />
                            Male
                        </label>
                        <label for="gender_female">
                            <input  type="radio" id="gender_female" value="Female" name="gender"/>
                            Female
                        </label>
                        <br/>
                        <label for="gender" class="error"></label>

                    </div>

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
                            <button type="submit" id="register" class="btn btn-primary btn-block btn-flat">Registry</button>
                        </div>

                    </div>
                </form>


            </div>

            <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach($errors->all() as $error): ?>
                    <li><?php echo e($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

        </div>

    </script>
</body>
</html>