<br>
<table border="1" id="myTable" style="width:100%">
    <thead>
        <th class="text-center" style="width:15%;">Form Number</th>
        <th class="text-center" style="width:30%;">Package Number</th>
        <th class="text-center">Location</th>
    </thead>
    <tbody align="center">
        <?php if(isset($submissions)): ?>
            <?php $__currentLoopData = $submissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($subm->formNbr); ?></td>
                <td><?php echo e($subm->packNbr); ?></td>
                <td><?php echo e("Temporary Storage"); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <?php echo e("No data found."); ?>

        <?php endif; ?>
    </tbody>
</table>

<script type="text/javascript">
	$('#myTable').DataTable({
		"searching": false
	});
</script>