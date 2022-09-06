<table border="1" id="myTable" style="width:100%">
    <thead>
        <th class="text-center" style="width:15%;">Form Number</th>
        <th class="text-center" style="width:30%;">Package Number</th>
        <th class="text-center">Location</th>
    </thead>
    <tbody align="center">
        <?php $__currentLoopData = $submissions2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($subm->formNumber); ?></td>
            <td><?php echo e($subm->packageNumber); ?></td>
            <td><?php echo e($subm->location); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<script type="text/javascript">
	$('#myTable').DataTable({
		"searching": false
	});
</script>