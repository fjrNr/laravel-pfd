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
                        <?php if(Session::has('message')): ?>
                        <div class="col-md-12">
                            <div class="alert alert-info alert-dismissible" group="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo e(Session::get('message')); ?>

                            </div>
                        </div>
                        <?php endif; ?>
                        <form method="POST" action="/post-flight - Alpha/changePass">
                            <?php echo csrf_field(); ?>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                                <div class="col-md-6">
                                    <input id="currentPassword" type="password" class="form-control<?php echo e($errors->has('currentPassword') ? ' is-invalid' : ''); ?>" name="currentPassword" required>

                                    <?php if($errors->has('currentPassword')): ?>
                                        <span class="invalid-feedback">
                                            <strong><?php echo e($errors->first('currentPassword')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                                <div class="col-md-6">
                                    <input id="newPassword" type="password" class="form-control<?php echo e($errors->has('newPassword') ? ' is-invalid' : ''); ?>" name="newPassword" required>

                                    <?php if($errors->has('newPassword')): ?>
                                        <span class="invalid-feedback">
                                            <strong><?php echo e($errors->first('newPassword')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm New Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        Change Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
	            </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.appTest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>