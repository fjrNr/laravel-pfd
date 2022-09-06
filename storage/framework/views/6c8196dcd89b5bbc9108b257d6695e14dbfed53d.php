<?php $__env->startSection('title'); ?>
    Unauthorized
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
	You are unauthorized to access this page
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.appTest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>