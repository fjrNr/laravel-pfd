<?php if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Group B'): ?>
	

	<?php $__env->startSection('title'); ?>
	Index Box
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('styles'); ?>
		<link href="<?php echo e(asset('css/menu/tab.css')); ?>" rel="stylesheet">
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('scripts'); ?>
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('content'); ?>
		<div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
              <div class="card-header">Request Shiftting</div>

              <div class="card-body">
                <table class="table" id="submission_list" align="center" style="width:100%">
                  <thead>
                    <th class="text-center"><input id="select_all" value="1" type="checkbox"></th>
                    <th class="text-center">ID</th>
                    <th class="text-center">Box Number</th>
                    <th class="text-center">Package Number</th>
                    <th class="text-center">Packing Date</th>
                    <th class="text-center">End of Retention Date</th>
                    <th class="text-center">Status Retention</th>
                  </thead>
                  <tbody align="center">
                  </tbody>
                </table>
                <input type="button" class="btn btn-success" value="&#x2713; Submit" style="float: right" id="submit">
              </div>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
    </script>
	<?php $__env->stopSection(); ?>
<?php else: ?>
    <title>Unauthorized.</title>
    <?php
    echo 'You are unauthorized to access this page';
    return back();
    ?>
<?php endif; ?>
<?php echo $__env->make('layouts.appTest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>