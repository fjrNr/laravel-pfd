<?php if(Auth::user()->group == 'ADMIN' || Auth::user()->group == 'USER'): ?>
	

	<?php $__env->startSection('title'); ?>
	Index Box
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('styles'); ?>
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('scripts'); ?>
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('content'); ?>
		<div class="container">
		    <div class="row justify-content-center">
		        <div class="col-md-8">
		            <div class="card">
		                <div class="card-header">
		                	Box List for date: Today (<?php date_default_timezone_set("Asia/Jakarta"); echo date("l, d-m-Y"); ?>)
		                	<a href="/box/create" style="font-weight: bold; float: right;" class="btn btn-success"> &#xff0b; Add New</a>
		                </div>

		                <div class="card-body">
		                	<table border="1" class="table table-hover" id="myTable" style="width:100%">
		                		<thead>
		                			<th class="text-center">Box</th>
		                			<th class="text-center">Packing Date</th>
		                			<th class="text-center">Packing Number</th>
		                			<th class="text-center">Total Submission</th>
		                			<th class="text-center">Total Document</th>
		                			<th class="text-center">Action</th>
		                		</thead>
		                		<tbody align="center">
		                			<?php if(isset ($boxes)): ?>
			                			<?php $__currentLoopData = $boxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $box): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                				<tr>
			                					<td><?php echo e($box->boxNumber); ?></td>
			                					<td><?php echo e(date('d-m-Y', strtotime($box->packingDate))); ?></td>
			                					<td><?php echo e($box->packageNumber); ?></td>
			                					<td><?php echo e($box->totalSubmission); ?></td>
			                					<td>
			                						<?php if(isset ($box->totalDocument)): ?>
			                							<?php echo e($box->totalDocument); ?>

			                						<?php else: ?>
			                							<?php echo e("0"); ?>

			                						<?php endif; ?>
			                					</td>
			                					<td><a href="/box/edit/<?php echo e($box->id); ?>" style="font-weight: bold;" class="btn btn-warning"> &#x1f589; Edit</a></td>
			                				</tr>
			                			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			                		<?php endif; ?>	
		                		</tbody>
		                	</table>
		                </div>
		            </div>
	            </div>
            </div>
        </div>
	<?php $__env->stopSection(); ?>
<?php else: ?>
    <title>Unauthorized.</title>
    <?php
    echo 'You are unauthorized to access this page';
    return back();
    ?>
<?php endif; ?>
<?php echo $__env->make('layouts.appTest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>