<?php $__env->startSection('title'); ?>
Change Password
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <link href="http://code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header">Change Password</div>

	                <div class="card-body">
                        <div class="form-table">
                        </div>
                    </div>
	            </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">     
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.appTest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>