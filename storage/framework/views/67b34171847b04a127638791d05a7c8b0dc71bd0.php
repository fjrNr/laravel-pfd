<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/menu/app.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldContent('styles'); ?>

    <!-- Scripts -->
<!--     <script src="<?php echo e(asset('js/jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery-ui.custom.v1.12.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/menu/bootstrap.v4.0.0.min.js')); ?>"></script>
    <?php echo $__env->yieldContent('scripts'); ?> -->

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                    <?php echo e(config('app.name', 'Laravel')); ?>

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <?php if(auth()->guard()->guest()): ?>
                            <li><a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a></li>
                            <li><a class="nav-link" href="<?php echo e(route('register')); ?>">Register</a></li>
                        <?php else: ?>
                            <li><a class="nav-link"><?php date_default_timezone_set("Asia/Jakarta"); echo date("l, d-m-Y"); ?></a></li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo e(Auth::user()->id); ?> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <?php if(Auth::user()->group == 'ADMIN' || Auth::user()->group == 'USER X'): ?>
                                    <a class="dropdown-item" href="/submission/insert">
                                        Insert Submission
                                    </a>
                                    <?php endif; ?>
                                    <?php if(Auth::user()->group == 'ADMIN' || Auth::user()->group == 'USER'): ?>
                                    <a class="dropdown-item" href="/submission/index">
                                        Index Submission
                                    </a>
                                    <a class="dropdown-item" href="/box/index">
                                        Index Box
                                    </a>
                                    <a class="dropdown-item" href="/box/create/">
                                        Insert Box Assignment
                                    </a>
                                    <a class="dropdown-item" href="/search">
                                        Search
                                    </a>
                                    <?php endif; ?>

                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</body>
</html>
