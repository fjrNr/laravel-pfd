<?php if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Group B'): ?>
	

	<?php $__env->startSection('title'); ?>
		Change Status Box
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('styles'); ?>
		<link href="http://code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css" rel="stylesheet">
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css">
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('scripts'); ?>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('content'); ?>
		<div class="container">
		    <div class="row justify-content-center">
		        <div class="col-md-8">
		            <div class="card">
		                <div class="card-header">Change Status Box</div>

		                <div class="card-body">
		                	<div class="form-table">
                                <table border="1" class="table table-hover" id="myTable" style="width:100%;">
                                    <thead>
                                        <th class="text-center">Box Number</th>
			                			<th class="text-center">Packing Date</th>
			                			<th class="text-center">Packing Number</th>
			                			<th class="text-center">Location</th>
			                			<th class="text-center">Retention Status</th>
			                			<th class="text-center">Action</th>
                                    </thead>
                                    <tbody align="center">
                                    </tbody>
                                </table>
                            </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>

		<script type="text/javascript">
			$(document).ready(function(){
	            var oTable = $('#myTable').DataTable({
	                "processing": true,
	                "serverSide": true,
	                "ajax": "<?php echo e(route('box/getData')); ?>",
	                "columns":[
	                    { "data": "boxNumber", "name": "boxes.boxNumber"},
	                    { "data": "packingDate", "name": "boxes.packingDate", "render": function(d) {
	                        return moment(d).format("DD-MM-YYYY");
	                    }},
	                    { "data": "packageNumber" , "name": "boxes.packageNumber"},
	                    {"data": "action", "name": "action", "orderable": false, "searchable": false}
	                ],
	                "initComplete": function(settings, json) {
	                    $('#myTable_filter input').unbind();
	                    $('#myTable_filter input').bind('keyup', function(e) {
	                        if(e.keyCode == 13) {
	                            oTable.search( this.value ).draw();
	                        }
	                    }); 
	                }
	            });
	        });
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