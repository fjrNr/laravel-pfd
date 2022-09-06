<?php if(Auth::user()->group == 'ADMIN' || Auth::user()->group == 'USER'): ?>
	

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
		                <div class="card-header">Index Submission</div>

	                	<?php if(Session::has('message')): ?>
                        <div class="col-md-12">
                            <div class="alert alert-info alert-dismissible" group="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo e(Session::get('message')); ?>

                            </div>
                        </div>
                    	<?php endif; ?>

		                <div class="card-body">
                            <div class="form-table">
                            	Start Received Date: <input type="text" id="startDateField" placeholder="dd-mm-yyyy" class="searchTxt date">
                            	End Received Date: <input type="text" id="endDateField" placeholder="dd-mm-yyyy" class="searchTxt date">
                            	Register: <input type="text" id="registerField" class="searchTxt">
                            	<br>
                            	<span class="text-danger" id="dateValid"></span>
                                <table border="1" class="table table-hover" id="myTable" style="width:100%;">
                                    <thead>
                                        <th class="text-center">Received Date</th>
                                        <th class="text-center">Form Number</th>
                                        <th class="text-center">Crew Number</th>
                                        <th class="text-center">Document</th>
                                        <th class="text-center">Register</th>
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
	                "bFilter" : false,
	                "processing": true,
	                "serverSide": true,
	                "ajax" : {
	                	"url" : "<?php echo e(route('submission/getData')); ?>",
	                	"data" : function (d){
	                		d.register = $('#registerField').val();
	                		d.startDate = $('#startDateField').val();
	                		d.endDate = $('#endDateField').val();
	                	},
	                },
	                "columns":[
	                    { "data": "receivedDate", "name": "submissions.receivedDate", "render": function(d) {
	                        return moment(d).format("DD-MM-YYYY");
	                    }},
	                    { "data": "formNumber", "name": "submissions.formNumber"},
	                    { "data": "empnbr" , "name": "crews.empnbr"},
	                    { "data": "quantity", "name": "submissions.quantity", "orderable": false},
	                    { "data": "register" , "name": "submissions.register"},
	                    {"data": "action", "name": "action", "orderable": false}
	                ],
	            });

	            $('.searchTxt').on('keydown',function(e){
	            	var strDate1 = $('#startDateField').val();
	            	var strDate2 = $('#endDateField').val();
	            	var regexDate = /^(\d{2})-(\d{2})-(\d{4})$/;
	            	if( (e.which == 13 || e.keyCode == 13 ) && $('.date').datepicker("widget").is(":visible") == false) {
	            		if(strDate1.match(regexDate) && strDate2.match(regexDate)) {
	            			$('#dateValid').text('');
	            			oTable.draw();
	            		} else if(strDate1.match(regexDate) && strDate2 == ''){
	            			$('#dateValid').text('');
	            			oTable.draw();
	            		} else if(strDate2.match(regexDate) && strDate1 == ''){
	            			$('#dateValid').text('');
	            			oTable.draw();
	            		} else if(strDate1 == '' && strDate2 == ''){
	            			$('#dateValid').text('');
	            			oTable.draw();
	            		} else{
	            			$('#dateValid').text('Date format must be valid.');
	            		}
	            	}
	            });

	            $('.date').datepicker({
	            	dateFormat: 'dd-mm-yy',
			        onSelect:function(){
			            $(this).datepicker("hide");
			        }
	            })

	            $('#startDateField').datepicker("show");
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