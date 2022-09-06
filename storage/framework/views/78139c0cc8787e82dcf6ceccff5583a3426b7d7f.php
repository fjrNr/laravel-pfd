<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title'); ?> - Post Flight Document</title>
    <link rel="shortcut icon" href="<?php echo e(asset('flight.png')); ?>">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/menu/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/menu/sb-admin.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <?php echo $__env->yieldContent('styles'); ?>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/jquery-2.0.3.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery-ui.custom.v1.12.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/menu/bootstrap.v4.0.0.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/menu/sb-admin.min.js')); ?>"></script>
    <?php echo $__env->yieldContent('scripts'); ?>

</head>

<body class="fixed-nav sticky-footer bg-light" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="mainNav">
        <a class="navbar-brand" href="<?php echo e(url('/home')); ?>" style="font-weight: bold;">Post Flight Document</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                <?php if(Auth::user()->group == 'ADMIN' || Auth::user()->group == 'USER X'): ?>
                <div class="dropdown-divider"></div>
                <li class="nav-item" data-toggle="tooltip" data-placement="right">
                    <a class="nav-link" href="<?php echo e(url('/submission/insert')); ?>">
                        <i class="fa fa-fw fa-plus"></i>
                        <span class="nav-link-text">Insert Submission</span>
                    </a>
                </li>
                <div class="dropdown-divider"></div>
                <?php endif; ?>
                <?php if(Auth::user()->group == 'ADMIN' || Auth::user()->group == 'USER'): ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right">
                    <a class="nav-link" href="<?php echo e(url('/submission/index')); ?>">
                        <i class="fa fa-fw fa-tag"></i>
                        <span class="nav-link-text">Index Submission</span>
                    </a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item" data-toggle="tooltip" data-placement="right">
                    <a class="nav-link" href="<?php echo e(url('/box/index')); ?>">
                        <i class="fa fa-fw fa-dropbox"></i>
                        <span class="nav-link-text">Index Box</span>
                    </a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item" data-toggle="tooltip" data-placement="right">
                    <a class="nav-link" href="<?php echo e(url('/box/create')); ?>">
                        <i class="fa fa-fw fa-pencil-square-o"></i>
                        <span class="nav-link-text">Insert Box Assignment</span>
                    </a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item" data-toggle="tooltip" data-placement="right">
                    <a class="nav-link" href="<?php echo e(url('/search')); ?>">
                        <i class="fa fa-fw fa-search"></i>
                        <span class="nav-link-text">Search</span>
                    </a>
                </li>
                <div class="dropdown-divider"></div>
<!--                 <li class="nav-item" data-toggle="tooltip" data-placement="right">
                    <a class="nav-link" href="/">
                        <i class="fa fa-fw fa-plus"></i>
                        <span class="nav-link-text">Request Movement</span>
                    </a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item" data-toggle="tooltip" data-placement="right">
                    <a class="nav-link" href="/">
                        <i class="fa fa-fw fa-newspaper-o"></i>
                        <span class="nav-link-text">View Report Movement</span>
                    </a>
                </li>
                <div class="dropdown-divider"></div> -->
                <?php endif; ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right">
                    <a class="nav-link" href="<?php echo e(url('/changePass')); ?>">
                        <i class="fa fa-fw fa-exchange"></i>
                        <span class="nav-link-text">Change Password</span>
                    </a>
                </li>
                <div class="dropdown-divider"></div>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal"><?php date_default_timezone_set("Asia/Jakarta"); echo date("l, d-m-Y"); ?></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="My Account: <?php echo e(Auth::user()->name); ?>">
                        <?php echo e(Auth::user()->name); ?>, <?php echo e(Auth::user()->group); ?>

                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
                        <a class="dropdown-item">
                            <span>
                                <strong>My Account</strong>
                            </span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="text-danger">
                                <strong>Logout</strong>
                            </span>
                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content-wrapper">
        <?php echo $__env->yieldContent('content'); ?>
        <br>
    </div>
</body>

</html>
