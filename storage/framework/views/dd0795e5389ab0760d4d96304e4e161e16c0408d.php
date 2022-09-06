<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Post Flight Document</title>
    <link rel="shortcut icon" href="<?php echo e(asset('flight.png')); ?>">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="<?php echo e(asset('css/menu/sb-admin-2.css')); ?>" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <center><b>Post Flight Document</b></center>
                    <div class="panel-heading">Please Login</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="login">
                            <?php echo e(csrf_field()); ?>


                            <div class="form-group<?php echo e($errors->has('id') ? ' has-error' : ''); ?>">
                                <div class="col-md-12">
                                    <input id="text" type="id" class="form-control" name="id" value="<?php echo e(old('id')); ?>" placeholder="ID" required autofocus>

                                    <?php if($errors->has('id')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('id')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                                    <?php if($errors->has('password')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('password')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" style="width: 100%">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>