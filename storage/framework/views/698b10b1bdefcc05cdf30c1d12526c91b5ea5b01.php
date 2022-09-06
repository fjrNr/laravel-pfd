<?php $__env->startSection('title'); ?>
Index Submission
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
	                	View Requested Items<a href="<?php echo e(url('/borrowing/entry')); ?>" style="font-weight: bold; float: right;" class="btn btn-success"> &#xff0b; Request</a>
	                </div>

                	<?php if(Session::has('message')): ?>
                    <div class="col-md-12">
                        <div class="alert alert-info alert-dismissible" group="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo e(Session::get('message')); ?>

                        </div>
                    </div>
                	<?php endif; ?>

	                <div class="card-body">
                        Option:
                        <select name="role" id="formSelect" onchange="setFormChange(value);">
                            <option value="0">Select Doc.</option>
                            <option value="1">Non AFL</option>
                            <option value="2">AFL</option>    
                        </select>
                        <br><br>
                        <div class="form-table" id="ft1" hidden>
                            <table border="1" class="table table-hover" id="myTable" style="width:100%;">
                                <thead>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Unit</th>
                                    <th class="text-center">Request Date</th>
                                    <th class="text-center">Total Document</th>
                                    <th class="text-center">Action</th>
                                </thead>
                                <tbody align="center">
                                </tbody>
                            </table>
                        </div>
                        <div class="form-table" id="ft2" hidden>
                            <table border="1" class="table table-hover" id="myTable2" style="width:100%;">
                                <thead>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Unit</th>
                                    <th class="text-center">Request Date</th>
                                    <th class="text-center">Total Document</th>
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
    	$('#formSelect').val("0");
        function setFormChange(value){
            if(value == '1'){
                $('#ft1').removeAttr('hidden');
                $('#ft2').attr('hidden',"");
            }else if(value== '2'){
                $('#ft1').attr('hidden',"");
                $('#ft2').removeAttr('hidden');
            }else if(value== '0'){
                $('#ft1').attr('hidden',"");
                $('#ft2').attr('hidden',"");
            }
        }

        $(document).ready(function(){
            var oTable = $('#myTable').DataTable({
                "bFilter" : true,
                "processing": true,
                "order": [[2, 'desc']],
                "serverSide": true,
                "ajax" : {
                    "url" : "<?php echo e(URL::to('request/getData')); ?>",
                    "data" : function (d){
                        d.role = 0;
                    },
                },
                "columns":[
                    { "data": "empName", "name": "empName","className": "text-center"},
                    { "data": "empUnit", "name": "empUnit","className": "text-center"},
                    { "data": "requestDate", "name": "requestDate","className": "text-center"},
                    { "data": "totalDoc", "name": "totalDoc","className": "text-center","searchable": false},
                    { "data": "action" , "name": "action", "orderable": false, "searchable": false},
                ],
                "initComplete": function(settings, json) {
                    $('#myTable_filter input').unbind();
                    $('#myTable_filter input').bind('keyup', function(e) {
                        if(e.keyCode == 13) {
                            oTable.search( this.value ).draw();
                        }
                    }); 
                },
            });
            
            var pTable = $('#myTable2').DataTable({
                "bFilter" : true,
                "processing": true,
                "order": [[2, 'desc']],
                "serverSide": true,
                "ajax" : {
                    "url" : "<?php echo e(URL::to('request/getData')); ?>",
                    "data" : function (d){
                        d.role = 1;
                    },
                },
                "columns":[
                    { "data": "empName", "name": "empName","className": "text-center"},
                    { "data": "empUnit", "name": "empUnit","className": "text-center"},
                    { "data": "requestDate", "name": "requestDate","className": "text-center"},
                    { "data": "totalDoc", "name": "totalDoc","className": "text-center","searchable": false},
                    { "data": "action" , "name": "action", "orderable": false, "searchable": false},
                ],
                "initComplete": function(settings, json) {
                    $('#myTable2_filter input').unbind();
                    $('#myTable2_filter input').bind('keyup', function(e) {
                        if(e.keyCode == 13) {
                            pTable.search( this.value ).draw();
                        }
                    }); 
                },
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.appTest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>