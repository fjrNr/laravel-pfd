<?php $__currentLoopData = $test; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php echo e($ts->password); ?> <br>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>