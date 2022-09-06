<?php if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Grup B'): ?>
	

	<?php $__env->startSection('styles'); ?>
		<link href="http://code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css" rel="stylesheet">
	    <style>
	        .baris td:focus-within{
	            background-color: #98CBE8;
	        }
	    </style>
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('scripts'); ?>
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('content'); ?>
		<div class="container">
		    <div class="row justify-content-center">
		        <div class="col-md-8">
		            <div class="card">
		                <div class="card-header">Insert Box Assignment</div>

		                <div class="card-body">
		                	<?php if(Session::has('message')): ?>
                            <div class="col-md-12">
                                <div class="alert alert-info alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php echo e(Session::get('message')); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        <form action="/box/assign/insert" method="post">
                            <?php echo e(csrf_field()); ?>

                            <table id="static_field" width="100%">
                                <tr>
                                    <td><label>Packing Date</label></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="packingDate" id="packingDateField" class="form-control text" style="width: 60%" placeholder="dd-mm-yyyy" maxlength="10" required pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-[0-9]{4}">
                                            <span class="text-danger"><?php echo e($errors->first('packingDate')); ?></span>
                                        </div>
                                    </td>
                                    <td><label>&ensp;&ensp;Remark</label></td>
                                    <td rowspan="3">
                                        <div class="form-group">
                                            <textarea type="text" name="remark" id="remarkField" class="form-control text" style="width: 100%; height: 145px; resize: none"></textarea>
                                            <span class="text-danger"><?php echo e($errors->first('remark')); ?></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Box Number</label></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="boxNo" id="boxNoField" class="form-control text" maxlength="1" style="width: 20%" required="[0-9]">
                                            <span class="text-danger"><?php echo e($errors->first('boxNo')); ?></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Package Number</label></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="packageNo" class="form-control text" placeholder="PFD/yy/xxxx" style="width: 60%;" maxlength="11" pattern="(PFD)\/[0-9]{2}\/[0-9]{4}">
                                            <span class="text-danger"><?php echo e($errors->first('packageNo')); ?></span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <label>Form List:</label>
                            <table class="table table-bordered" id="dynamic_field" align="center">
                                <thead>
                                    <th>Form Number</th>
                                    <th>Crew Number</th>
                                    <th>Crew Name</th>
                                    <th>Remark</th>
                                    <th>Action</th>
                                </thead>
                                <tr id="row1">
                                    <td align="center"><input type="text" class="text form-control" id="formNoField1" name="formNo[1]"></td>
                                    <td align="center"><input type="text" class="text form-control" id="crewNoField1" disabled></td>
                                    <td align="center"><input type="text" class="text form-control" id="crewNameField1" disabled></td>
                                    <td align="center"><input type="text" class="text form-control" id="remarkField1" name="remark[1]"></td>
                                    <td></td>
                                </tr>
                            </table>
                            <?php if(Session::has('warning')): ?>
                                <span class="text-danger"><?php echo e(Session::get('warning')); ?></span>
                            <?php endif; ?>
                            <br>
                                    <td width="850px">
                                        <input type="button" name="add" id="add" class="btn btn-add" value="Add More">
                                    </td>
                                    <td>
                                        <input type="submit" value="Submit" name="submit" id="submit" class="btn btn-success" style="float:right;">
                                    </td>
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

            $(document).on('focus', "input[name^=formNo]", function(){
                var row = $(this).closest('tr');
                $(this).autocomplete({
                    source: "<?php echo e(URL::to('submission/search')); ?>",
                    select:function(key, value){
                        console.log(value);
                        row.find("input[id^=formNoField]").val(value.item.value);
                        row.find("input[id^=crewNoField]").val(value.item.crewNumber);
                        row.find("input[id^=crewNameField]").val(value.item.crewName);
                        row.find("input[id^=remarkField]").val(value.item.remark);

                        if(row.find("input[id^=remarkField]").val().toLowerCase() != 'no form') 
                            row.find("input[id^=remarkField]").val('');

                    }
                });
            })

            $("#packingDateField").blur(function() {
                $('#packingDateField').datepicker("hide");
            });

            $("#add").click(function () {
                i++;
                $('#dynamic_field').append('<tr id="row'+i+'">\n' +
                    '<td align="center"><input type="text" id="formNoField'+i+'" name="formNo['+i+']" class="text form-control"></td>\n' +
                    '<td align="center"><input type="text" id="crewNoField'+i+'" class="text form-control" disabled></td>\n' +
                    '<td align="center"><input type="text" id="crewNameField'+i+'" class="text form-control" disabled></td>\n' +
                    '<td align="center"><input type="text" id="remarkField'+i+'" class="text form-control" name="remark['+i+']"></td>\n' +
                    '<td align="center"><input type="button" name="remove" id="'+i+'" value="X" class="btn btn-danger btn-remove"></td>\n' +
                    '</tr>');
                $('#formNoField'+i+'').focus();
            });

            $(document).on('click', '.btn-remove', function(e){
                var button_id = $(this).attr("id");
                $('#add').focus();
                $('#row' + button_id + '').remove();
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