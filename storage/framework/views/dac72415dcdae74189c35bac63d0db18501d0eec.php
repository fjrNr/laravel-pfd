<?php $__env->startSection('title'); ?>
Index Box
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
	<link href="http://code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header">
	                	Create Account
	                </div>

	                <div class="card-body">
	                	<?php if(Session::has('message')): ?>
                        <div class="col-md-12">
                            <div class="alert alert-info alert-dismissible" group="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo e(Session::get('message')); ?>

                            </div>
                        </div>
                        <?php endif; ?>
	                	<form method="POST" <?php if (Request::segment(1) == 'user') { ?> action="<?php echo e(url('/user')); ?>" <?php }else{?> action="<?php echo e(url('/accounts/edit')); ?>/<?php echo e($user->id); ?>" <?php }?>>
	                		<?php echo csrf_field(); ?>
	                		<div class="form-group row">
	                            <label for="id" class="col-md-4 col-form-label text-md-right">ID</label>

	                            <div class="col-md-6">
	                                <input id="id" type="text" class="form-control<?php echo e($errors->has('id') ? ' is-invalid' : ''); ?>" name="id" value="<?php echo e($user->id); ?>" <?php if (Request::segment(1) == 'user') { ?> disabled <?php }?>required autofocus>

	                                <?php if($errors->has('id')): ?>
	                                    <span class="invalid-feedback">
	                                        <strong><?php echo e($errors->first('id')); ?></strong>
	                                    </span>
	                                <?php endif; ?>
	                            </div>
	                        </div>
	                		<div class="form-group row">
	                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

	                            <div class="col-md-6">
	                                <input id="name" type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e($user->name); ?>" required autofocus>

	                                <?php if($errors->has('name')): ?>
	                                    <span class="invalid-feedback">
	                                        <strong><?php echo e($errors->first('name')); ?></strong>
	                                    </span>
	                                <?php endif; ?>
	                            </div>
	                        </div>
							<div class="form-group row">
				                <label for="role" class="col-md-4 control-label text-md-right">Role</label>

				                <div class="col-md-6">
				                    <select name="role" class="form-control" <?php if (Request::segment(1) == 'user') { ?> disabled <?php }?>>
				                        <option value="ADMIN" <?php if($user->group == 'ADMIN') {?>selected <?php } ?>>Admin</option>
				                        <option value="SUBM OFC" <?php if($user->group == 'SUBM OFC') {?>selected <?php } ?>>Submission Officer</option>
				                        <option value="BOX OFC" <?php if($user->group == 'BOX OFC') {?>selected <?php } ?>>Box Officer</option>
				                        <option value="ANALYST" <?php if($user->group == 'ANALYST') {?>selected <?php } ?>>Analyst</option>
				                    </select>
				                </div>
				                <?php if($errors->has('role')): ?>
				                    <span class="help-block">
				                        <strong><?php echo e($errors->first('role')); ?></strong>
				                    </span>
				                <?php endif; ?>
				            </div>
	                        <div class="form-group row">
	                            <label for="department" class="col-md-4 col-form-label text-md-right">Department</label>

	                            <div class="col-md-6">
	                                <input id="department" type="text" class="form-control<?php echo e($errors->has('department') ? ' is-invalid' : ''); ?>" name="department" value="<?php echo e($user->department); ?>" required autofocus>

	                                <?php if($errors->has('department')): ?>
	                                    <span class="invalid-feedback">
	                                        <strong><?php echo e($errors->first('department')); ?></strong>
	                                    </span>
	                                <?php endif; ?>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label for="homebase" class="col-md-4 col-form-label text-md-right">Homebase</label>

	                            <div class="col-md-6">
	                                <input id="homebase" type="text" class="form-control<?php echo e($errors->has('homebase') ? ' is-invalid' : ''); ?>" name="homebase" value="<?php echo e($user->homebase); ?>" required autofocus>

	                                <?php if($errors->has('homebase')): ?>
	                                    <span class="invalid-feedback">
	                                        <strong><?php echo e($errors->first('homebase')); ?></strong>
	                                    </span>
	                                <?php endif; ?>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                        	<label class="col-md-4 col-form-label text-md-right">Password</label>
	                        	<div class="col-md-6">
	                        		<a <?php if (Request::segment(1) == 'user') { ?> href="user/password" <?php }else{?> href="<?php echo e($user->id); ?>/password" <?php }?> class="btn btn-warning">Change Password</a>
	                        	</div>
	                        </div>
	                        <div class="form-group row">
	                        	<label class="col-md-4 col-form-label text-md-right"></label>
	                        	<div class="col-md-6">
									<input type="reset" class="btn btn-primary" value="Reset">
	                				<input type="submit" class="btn btn-success" value="Submit">
	                        	</div>
	                        </div>
	                	</form>
	                </div>
	            </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.appTest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>