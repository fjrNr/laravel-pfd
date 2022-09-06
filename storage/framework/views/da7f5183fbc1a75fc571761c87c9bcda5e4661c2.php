<?php $__env->startSection('title'); ?>
Index Box
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
	<link href="http://code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css" rel="stylesheet">
	<link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-12">
	            <div class="card">
	                <div class="card-header">
	                	View Accounts
	                	<a href="<?php echo e(url('/accounts/create')); ?>" style="font-weight: bold; float: right;" class="btn btn-success"> &#xff0b; Create New</a>
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
	                	<div class="form-table">
                            <table border="1" class="table table-hover" id="myTable" style="width:100%;">
                                <thead>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">User Role</th>
                                    <th class="text-center">Department</th>
                                    <th class="text-center">Homebase</th>
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
    	var oTable = $('#myTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax" : {
            	"url" : "<?php echo e(url('/accounts/getData')); ?>",
            },
            "columns":[
                { "data": "id", "name": "id"},
                { "data": "name" , "name": "name"},
                { "data": "group", "name": "group"},
                { "data": "department" , "name": "department"},
                { "data": "homebase" , "name": "homebase"},
                { "data": "action" , "name": "action", "orderable": false, "searchable": false},
            ],
    	});
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.appTest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>