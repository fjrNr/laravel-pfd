<?php if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Grup B'): ?>
	

	<?php $__env->startSection('styles'); ?>
		<link href="http://code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css" rel="stylesheet">
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('scripts'); ?>
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('content'); ?>
		<div class="container">
		    <div class="row justify-content-center">
		        <div class="col-md-8">
		            <div class="card">
		                <div class="card-header">Create Box</div>

		                <div class="card-body">
		                	<?php if(Session::has('message')): ?>
                            <div class="col-md-12">
                                <div class="alert alert-info alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php echo e(Session::get('message')); ?>

                                </div>
                            </div>
                        	<?php endif; ?>

	                        <form action="/box/create" method="post">
	                            <?php echo e(csrf_field()); ?>

	                            <table id="static_field" width="100%">
	                                <tr>
	                                    <td><label>Packing Date</label></td>
	                                    <td>
	                                        <div class="form-group">
	                                            <input type="text" name="packingDate" id="packingDateField" class="form-control text" placeholder="dd-mm-yyyy" style="width: 60%;" required pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-[0-9]{4}">
	                                            <span class="text-danger"><?php echo e($errors->first('packingDate')); ?></span>
	                                        </div>
	                                    </td>
	                                    <td><label>&ensp;&ensp;&ensp;Remark</label></td>
	                                    <td rowspan="3">
	                                        <div class="form-group">
	                                            <textarea type="text" name="remark" id="remarkField" class="form-control text" style="height: 150px; width: 100%; resize: none"></textarea>
	                                            
	                                        </div>
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td><label>Box Number</label></td>
	                                    <td>
	                                        <div class="form-group">
	                                            <input type="text" name="boxNo" id="boxNoField" class="form-control text" maxlength="2" style="width: 30%;" required pattern="[0-9]+">
	                                            <span class="text-danger"><?php echo e($errors->first('boxNo')); ?></span>
	                                        </div>
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td><label>Package Number</label></td>
	                                    <td rowspan="2">
	                                        <div class="form-group">
	                                            <input type="text" name="packageNo" class="form-control text" placeholder="PFD/yy/xxxx" style="width: 60%;" maxlength="11" required pattern="(PFD)\/[0-9]{2}\/[0-9]{4}">
	                                            <span class="text-danger"><?php echo e($errors->first('packageNo')); ?></span>
	                                        </div>
	                                    </td>
	                                </tr>
	                            </table>
	                            <?php if(Session::has('warning')): ?>
	                                <span class="text-danger"><?php echo e(Session::get('warning')); ?></span>
	                            <?php endif; ?>
	                            <br>
								<input type="submit" value="Submit" name="submit" id="submit" class="btn btn-success" style="float:right;">
	                        </form>
                        </div>
		            </div>
	            </div>
            </div>
        </div>

        <script type="text/javascript">
	        $(document).ready(function(){
	            $("#packingDateField").focus();
	            var i = 1;

	            $("#packingDateField").blur(function() {
	                $('#packingDateField').datepicker("hide");
	            });

	            $.ajaxSetup({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                }
	            });
	        });

	        $("#packingDateField").datepicker({
	            dateFormat: 'dd-mm-yy',
	            onSelect:function(){
	                $('#boxNoField').select();
	            }
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
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>