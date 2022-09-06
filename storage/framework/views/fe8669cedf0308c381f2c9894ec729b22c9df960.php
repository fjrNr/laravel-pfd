<?php if(Auth::user()->group == 'ADMIN' || Auth::user()->group == 'USER'): ?>
	

    <?php $__env->startSection('title'); ?>
        <?php if (Request::segment(2) == 'edit') { ?>
            Edit Box Assignment
        <?php }else{ ?>
            Insert Box Assignment
        <?php } ?>
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
		                <div class="card-header">Box Assignment</div>

		                <div class="card-body">
                            <form method="post" id="box_form">
                                <?php echo e(csrf_field()); ?>

                                <table id="static_field" width="100%">
                                    <tr>
                                        <td><label>Packing Date</label></td>
                                        <td colspan="4">
                                            <div class="form-group">
                                                <input type="text" id="packingDateField" class="form-control text" style="width: 100%; max-width: 120px" placeholder="dd-mm-yyyy" maxlength="10" required pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-[0-9]{4}" 
                                                <?php if (Request::segment(2) == 'edit') { ?>
                                                    value="<?php echo e(date('d-m-Y', strtotime($box->packingDate))); ?>" disabled
                                                <?php }else{ ?>
                                                    value="<?php echo e(date('d-m-Y')); ?>"
                                                <?php } ?>
                                                >
                                            </div>
                                        </td>
                                        <td>&ensp;</td>
                                        <td align="center">
                                                <label>Assignment Submissions:</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Box Number</label></td>
                                        <td colspan="4">
                                            <div class="form-group">
                                                <input type="text" id="boxNoField" class="form-control text" style="width: 100%; max-width: 45px" required pattern="[1-6]" maxlength="1"
                                                <?php if (Request::segment(2) == 'edit') { ?>
                                                    value="<?php echo e($box->boxNumber); ?>" disabled
                                                <?php } ?>
                                                >
                                            </div>
                                        </td>
                                        <td>&ensp;</td>
                                        <td align="center" rowspan="2" valign="top">
                                                <label style="font-size: 50px; font-weight: bold;" id="countAssign">0</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Package Number</label></td>
                                        <td><label>PFD/</label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" id="yearField" style="width: 100%; max-width: 50px;" maxlength="2" required pattern="([0-9]+){2}" class="form-control text"
                                                <?php if (Request::segment(2) == 'edit') { ?>
                                                    value="<?php echo e(substr($box->packageNumber, 4, 2)); ?>" disabled
                                                <?php }else{ ?>
                                                    value="<?php echo e(date('y')); ?>"
                                                <?php } ?>
                                                >
                                            </div>
                                        </td>
                                        <td><label>/</label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" id="packageNoField" style="width: 100%; max-width: 70px;" maxlength="4" required pattern="([0-9]+){1,4}" class="form-control text"
                                                <?php if (Request::segment(2) == 'edit') { ?>
                                                    value="<?php echo e(substr($box->packageNumber, 7)); ?>" disabled
                                                <?php } ?>
                                                >
                                            </div>
                                        </td>
                                        <td>&ensp;</td>
                                    </tr>
                                </table>
                                <?php if(Request::segment(2) == 'create') { ?> <input type="submit" id="create" value="Create" class="btn btn-success"> <?php } ?>
                            </form>

                            <div id="assign_form">
                            </div>
		                </div>
		            </div>
	            </div>
            </div>
        </div>

        <script type="text/javascript">
        	$(document).ready(function(){
                $("#packingDateField").focus();
                var i = 1;

                <?php if (Request::segment(2) == 'edit') { ?>
                    window.onload = function() {
                        $.ajax({
                            type: 'get',
                            url : '<?php echo e(route('box/countAssigned')); ?>',
                            data: {
                                'id' : '<?php echo e($box->id); ?>'
                            },
                            success: function(data){
                                $('#countAssign').empty();
                                $('#countAssign').append(data);
                            },
                        });
                        loadSubmissionList();
                    }
                <?php } ?>

                function loadSubmissionList(){
                    $('#assign_form').show();
                    $('#assign_form').html('<div align="center">Loading submission list...</div>');
                    $.ajax({
                        type: 'get',
                        url : '<?php echo e(route('submission/getData2')); ?>',
                        success: function(data){
                            $('#assign_form').html(data);
                        }
                    })
                }

                $('#box_form').on('submit', function(e){
                    e.preventDefault();
                    $.ajax({
                        type:'post',
                        url : '<?php echo e(URL::to('box/create')); ?>',
                        data : {
                            'packingDate' : $('#packingDateField').val(),
                            'boxNo' : $('#boxNoField').val(),
                            'packageYear' : $('#yearField').val(),
                            'packageNo' : $('#packageNoField').val(),
                        },
                        success: function(response){
                            if(response.success){
                                alert(response.success);
                                $('#create').hide();
                                $('#packingDateField').prop('disabled', true);
                                $('#boxNoField').prop('disabled', true);
                                $('#yearField').prop('disabled', true);
                                $('#packageNoField').prop('disabled', true);
                                loadSubmissionList();
                            }else{
                                alert(response.error);
                            }
                        }
                    });
                });

                $(document).on('focus', '.formNo', function(){
                    var row = $(this).closest('tr'); 
                    $(this).autocomplete({
                        source: '<?php echo e(URL::to('submission/search')); ?>',
                        select:function(key, value){

                            row.find("input[id^=formNoField]").val(value.item.value);
                            row.find("input[id^=crewNoField]").val(value.item.crewNumber);
                            row.find("input[id^=crewNameField]").val(value.item.crewName);

                            if(value.item.date){
                                var date = value.item.date;
                                var num = date.substr(8, 2);
                                var mon = date.substr(5, 2);
                                var year = date.substr(0, 4);

                                row.find("input[id^=dateField]").val(num + '-' + mon + '-' + year);
                            }else{
                                row.find("input[id^=dateField]").val('');
                            }
                        }
                    });
                })

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });

            $("#packingDateField").datepicker({
                dateFormat: 'dd-mm-yy',
                onSelect:function(){
                    $(this).datepicker("hide");
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
<?php echo $__env->make('layouts.appTest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>