<table border="1" class="table table-hover" id="myTable" style="width:100%">
	<thead>
		<th class="text-center">Box</th>
		<th class="text-center">Class Of</th>
		<th class="text-center">Package Number</th>
		<th class="text-center">Total Submission</th>
		<th class="text-center">Total Document</th>
		<th class="text-center">Action</th>
	</thead>
	<tbody align="center">
		<?php if(isset ($boxes)): ?>
			<?php $__currentLoopData = $boxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $box): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($box->boxNbr); ?></td>
					<td><?php echo e(date('d-m-Y', strtotime($box->classOfDate))); ?></td>
					<td><?php echo e($box->packNbr); ?></td>
					<td><?php echo e($box->totalSubmission); ?></td>
					<td>
						<?php if(isset ($box->totalDocument)): ?>
							<?php echo e($box->totalDocument); ?>

						<?php else: ?>
							<?php echo e("0"); ?>

						<?php endif; ?>
					</td>
					<td><a href="<?php echo e(url('/box/edit/')); ?>/<?php echo e($box->id); ?>" style="font-weight: bold;" class="btn-sm btn-warning"> &#x1f589; Edit</a></td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php else: ?>
			<?php echo e("Data Not found."); ?>

		<?php endif; ?>
	</tbody>
</table>