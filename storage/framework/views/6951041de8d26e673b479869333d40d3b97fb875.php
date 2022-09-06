<?php $__env->startSection('title'); ?>
    Insert Submission
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><?php if (Request::segment(2) == 'edit') { ?>Edit<?php }else{ ?>Entry<?php } ?> Borrowing</div>

                <div class="card-body">
                	<form name="form_input" id="form_input" <?php if (Request::segment(2) == 'edit') { ?> action="<?php echo e(url('/borrower/edit')); ?>/<?php echo e($borrower->id); ?>"<?php }else{ ?> action="<?php echo e(url('/borrower/entry')); ?>" <?php } ?> method="post">
                        <?php echo e(csrf_field()); ?>

                        <table id="static_field" width="100%">
                        	<tr>
                        		<td><label>Employee Name</label></td>
                        		<td>
                        			<div class="form-group">
                                        <input type="text" name="empName" class="form-control" required <?php if (Request::segment(2) == 'edit') { ?> value="<?php echo e($borrower->empName); ?>"<?php } ?>
                                        autofocus>
                                        <span class="text-danger"><?php echo e($errors->first('empName')); ?></span>
                                    </div>
                        		</td>
                        	</tr>
                        	<tr>
                        		<td><label>Employee Unit</label></td>
                        		<td colspan="2">
                        			<div class="form-group">
	                        			<input type="text" name="empUnit" class="form-control" required <?php if (Request::segment(2) == 'edit') { ?> value="<?php echo e($borrower->empUnit); ?>"<?php } ?> maxlength="10">
				                        <span class="text-danger"><?php echo e($errors->first('empUnit')); ?></span>
			                    	</div>
                        		</td>
                        	</tr>
                        	<tr>
                        		<td><label>Employee Number</label></td>
                        		<td colspan="2">
                        			<div class="form-group">
	                        			<input type="text" name="empNbr" class="form-control" pattern="([0-9]+){6}" <?php if (Request::segment(2) == 'edit') { ?> value="<?php echo e($borrower->empNbr); ?>"<?php } ?> maxlength="6">
				                        <span class="text-danger"><?php echo e($errors->first('empNbr')); ?></span>
			                    	</div>
                        		</td>
                        	</tr>
                        </table>

                        <input type="submit" value="Submit" name="submit" id="submit" class="btn btn-success" style="float:right;">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.appTest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>