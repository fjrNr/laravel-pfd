<?php if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Group B'): ?>
	

	<?php $__env->startSection('styles'); ?>
		<link href="http://code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('scripts'); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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
                                                <input type="text" id="packingDateField" class="form-control text" style="width: 100%; max-width: 100px" placeholder="dd-mm-yyyy" maxlength="10" required pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-[0-9]{4}" value="<?php echo e($date); ?>">
                                            </div>
                                        </td>
                                        <td>&ensp;</td>
                                        <td align="center"><label>Assignment Submissions:</label></td>
                                    </tr>
                                    <tr>
                                        <td><label>Box Number</label></td>
                                        <td colspan="4">
                                            <div class="form-group">
                                                <input type="text" id="boxNoField" class="form-control text" style="width: 100%; max-width: 45px" required pattern="[1-6]" maxlength="1">
                                            </div>
                                        </td>
                                        <td>&ensp;</td>
                                        <td align="center" rowspan="2" valign="top"><label style="font-size: 50px; font-weight: bold;" id="countAssign">0</label></td>
                                    </tr>
                                    <tr>
                                        <td><label>Package Number</label></td>
                                        <td><label>PFD/</label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" id="yearField" style="width: 100%; max-width: 45px;" maxlength="2" required pattern="([0-9]+){2}" class="form-control text">
                                            </div>
                                        </td>
                                        <td><label>/</label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" id="packageNoField" style="width: 100%; max-width: 70px;" maxlength="4" required pattern="([0-9]+){4}" class="form-control text">
                                            </div>
                                        </td>
                                        <td>&ensp;</td>
                                    </tr>
                                </table>
                                <input type="submit" id="create" value="Create">
                            </form>

                            <div id="assign_form">
                                <label>Submission List:</label>
                                <table class="table table-bordered" id="dynamic_field" align="center">
                                    <thead>
                                        <th class="text-center" width="5%"><input type="checkbox" id="cbAssignAll"></th>
                                        <th class="text-center" width="15%">Form Number</th>
                                        <th class="text-center" width="20%">Received Date</th>
                                        <th class="text-center" width="15%">Crew Number</th>
                                        <th class="text-center">Crew Name</th>
                                        <th class="text-center" width="8%">Action</th>
                                    </thead>
                                    <tr id="row1">
                                        <td align="center"><input type="checkbox" class="cb-assign" name="cbAssign"></td>
                                        <!-- <td align="center"><input type="text" class="formNo form-control" id="formNoField1" name="formNo"></td> -->
                                        <td align="center"><select class="formNo form-control" id="formNoField1" name="formNo"></select></td>

                                        <td align="center"><input type="text" class="form-control" id="dateField1" disabled></td>
                                        <td align="center"><input type="text" class="form-control" id="crewNoField1" disabled></td>
                                        <td align="center"><input type="text" class="form-control" id="crewNameField1" disabled></td>
                                        <td align="center"><input type="button" value="&#xff0b;" style="font-weight: bold;" class="btn btn-success btn-add"></td>
                                    </tr>
                                </table>
                                <label style="float: left; display: none;" id="countSelected"></label>
                                <label style="float: right;">Non-Assignment Submissions: <label id="countNotAssign"></label></label>
                                <br><br>
                                <input type="button" class="btn btn-success" value="&#x2713; Submit" style="float: right" id="submit">
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
                                $.ajax({
                                    type:'get',
                                    url : '<?php echo e(URL::to('submission/countData')); ?>',
                                    success: function(data){
                                        $('#countNotAssign').append(data);   
                                    }
                                });
                                $('#create').hide();
                                $('#packingDateField').prop('readonly', true);
                                $('#boxNoField').prop('readonly', true);
                                $('#yearField').prop('readonly', true);
                                $('#packageNoField').prop('readonly', true);
                                $('#assign_form').show();
                            }else{
                                alert(response.error);
                            }
                        }
                    });
                });

                $(document).on('click', '.cb-assign', function(){
                    var row = $('tr[id^=row]');
                    var checked = $('.cb-assign:checked');

                    if($(this).is(':checked')){
                        $(this).prop('checked', true);
                        $(this).closest('tr').css('background-color', 'yellow');
                        console.log($(this).closest('tr').find('.formNo').val());
                    }else{
                        $(this).prop('checked', false);
                        $(this).closest('tr').css('background-color', '');
                    }

                    if(checked.length == row.length){
                        $('#cbAssignAll').prop('checked', true);
                    }else{
                        $('#cbAssignAll').prop('checked', false);
                    }

                    if(checked.length > 0){
                        $('#countSelected').show();
                        $('#countSelected').empty();
                        $('#countSelected').append('Items selected: ');
                        $('#countSelected').append(checked.length);
                    }else{
                        $('#countSelected').empty();
                        $('#countSelected').hide();
                    }
                })

                $('.formNo').select2();

                $(document).on('click', '.btn-add', function(){
                    i++;
                    $(this).hide();
                    $('#dynamic_field').append('<tr id="row'+i+'">\n' +
                        '<td align="center"><input type="checkbox" class="cb-assign" name="cbAssign"></td>\n' +
                        '<td align="center"><select class="formNo form-control" id="formNoField'+i+'" name="formNo"></select></td>\n' +
                        '<td align="center"><input type="text" class="form-control" id="dateField'+i+'" disabled></td>\n' + 
                        '<td align="center"><input type="text" id="crewNoField'+i+'" class="form-control" disabled></td>\n' +
                        '<td align="center"><input type="text" id="crewNameField'+i+'" class="form-control" disabled></td>\n' +
                        '<td align="center"><input type="button" value="&#xff0b;" style="font-weight: bold;" class="btn btn-success btn-add"></td>\n' +
                        '</tr>');
                    $('#cbAssignAll').prop('checked', false);
                    $('#formNoField'+i+'').focus();
                })

                $('#cbAssignAll').click(function(){
                    if($(this).is(':checked')){
                        $('.cb-assign').prop('checked', true);
                        $('.cb-assign').closest('tr').css('background-color', 'yellow');
                        $('#countSelected').show();
                        $('#countSelected').empty();
                        $('#countSelected').append('Items selected: ');
                        $('#countSelected').append($('.cb-assign:checked').length);
                    }else{
                        $('.cb-assign').prop('checked', false);
                        $('.cb-assign').closest('tr').css('background-color', '');
                        $('#countSelected').empty();
                        $('#countSelected').hide();
                    }
                })

                $('#submit').on('click', function(e){
                    e.preventDefault();
                    if($('.cb-assign:checked').length > 0){
                        var identityNo = [];
                        $('.cb-assign:checked').each(function(){
                            identityNo.push($(this).closest('tr').find('.formNo').val());
                        });
                        var formNo = JSON.stringify(identityNo);
                        console.log(formNo);
                        $.ajax({
                            type:'post',
                            url : '<?php echo e(URL::to('box/assign')); ?>',
                            data : {
                                'boxNo' : $('#boxNoField').val(),
                                'packageNo' : $('#packageNoField').val(),
                                'formNo' : formNo,
                                'year' : $('#yearField').val(),
                            },
                            success: function(response){
                                alert(response.message);
                                $('.cb-assign:checked').each(function(){
                                    $(this).closest('tr').remove();
                                });
                                if($('.btn-add').length == 0){
                                    $('#dynamic_field').append('<tr id="row'+i+'">\n' +
                                    '<td align="center"><input type="checkbox" class="cb-assign" name="cbAssign"></td>\n' +
                                    '<td align="center"><input type="text" id="formNoField'+i+'" name="formNo" class="formNo form-control"></td>\n' +
                                    '<td align="center"><input type="text" class="form-control" id="dateField'+i+'" disabled></td>\n' + 
                                    '<td align="center"><input type="text" id="crewNoField'+i+'" class="form-control" disabled></td>\n' +
                                    '<td align="center"><input type="text" id="crewNameField'+i+'" class="form-control" disabled></td>\n' +
                                    '<td align="center"><input type="button" value="&#xff0b;" style="font-weight: bold;" class="btn btn-success btn-add"></td>\n' +
                                    '</tr>');
                                }else{
                                    $('.btn-add:last').show();
                                }
                                $('#cbAssignAll').prop('checked', false);
                                $('#countSelected').empty();
                                $('#countSelected').append('Items selected: 0');
                            },
                        });
                    }else{
                        alert('Please select minimal one of all submissions in submission list.');
                    }
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