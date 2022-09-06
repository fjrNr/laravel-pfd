<?php if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Grup A'): ?>


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
                <div class="card-header">Insert Dummy Submission</div>

                <div class="card-body">
                	<form name="form_input" id="form_input" action="/submission/insert/dummy" method="post">
                        <?php echo e(csrf_field()); ?>

                        <table id="static_field" width="100%">
                            <tr>
                                <td><label>Form Number</label></td>
                                <td>
                                    <div class="form-group" >
                                        <input type="text" name="formNumber" id="formNoField" class="form-control text" maxlength="5" style="width: 30%" tabindex="1" required pattern="([0-9]+){4,5}">
                                        <span class="text-danger"><?php echo e($errors->first('formNumber')); ?></span>
                                    </div>
                                </td>
                                <td>&ensp; &ensp;<label>Document</label></td>
                                <td>
                                    <div class="form-group ">
                                        <input type="text" name="qtyDoc" id="qtyDocField" class="form-control text" maxlength="2" style="width: 20%" tabindex="4" required pattern="[0-9]+">
                                        <span class="text-danger"><?php echo e($errors->first('qtyDoc')); ?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Received Date</label></td>
                                <td><div class="form-group">
                                        <input type="text" name="receivedDate" id="receiveDateField" class="form-control text" style="width: 45%" tabindex="2"  placeholder="dd-mm-yyyy" required pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-[0-9]{4}">
                                        <span class="text-danger"><?php echo e($errors->first('receivedDate')); ?></span>
                                    </div>
                                </td>
                                <td>&ensp; &ensp;<label>Remark</label></td>
                                <td rowspan="3">
                                    <div class="form-group">
                                        <textarea type="text" name="remark" id="remarkField" class="form-control text" style="height: 150px; width: 100%; resize: none" tabindex="5"></textarea>
                                        <span class="text-danger"><?php echo e($errors->first('remark')); ?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Crew Number</label></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="crewNo" id="crewNoField" class="form-control text" placeholder="Search Crew Number" style="width: 60%" maxlength="6" tabindex="3" required pattern="([0-9]+){6}">
                                        <input type="hidden" name="crewId" id="crewId" required>
                                        <span class="text-danger"><?php echo e($errors->first('crewNumber')); ?></span>
                                        <span class="text-danger"><?php echo e($errors->first('crewId')); ?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Crew Name</label></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="crewName" id="crewNameField" class="form-control" disabled>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <input type="hidden" name="signed" id="signedHidden" value="">
                        <input type="submit" value="Submit" name="submit" id="submit" class="btn btn-success" style="float:right;">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>	

<script type="text/javascript">
	$(document).ready(function(){
            $('#formNoField').focus();
            var i = 1;

            $(document).on('keydown', 'input, textarea', function(e) {
                if (e.keyCode == 13 || e.which == 13) {
                    if ($(this).is('.text')) {
                        e.preventDefault();
                    }
                } else if (e.keyCode == 37 || e.which == 37) {
                    e.preventDefault();
                    $(this).closest('td').prev().find('input, textarea').select();
                    if ($(this).is('#qtyDocField')) {
                        $('#formNoField').select();
                    } else if ($(this).is('#remarkField')) {
                        $('#receiveDateField').select();
                    }
                } else if (e.keyCode == 38 || e.which == 38) {
                    e.preventDefault();
                    $(this).closest('tr').prev().find('td:eq(' + $(this).closest('td').index() + ')').find('input, textarea').select();
                    if ($(this).is('#submit')) {
                    	$('#remarkField').select();
                    }
                } else if (e.keyCode == 39 || e.which == 39) {
                    e.preventDefault();
                    $(this).closest('td').next().find('input, textarea').select();
                    if ($(this).is('#formNoField')) {
                        $('#qtyDocField').select();
                    } else if ($(this).is('#receiveDateField') || $(this).is('#crewNoField')) {
                        $('#remarkField').select();
                    }
                } else if (e.keyCode == 40|| e.which == 40) {
                    e.preventDefault();
                    $(this).closest('tr').next().find('td:eq(' + $(this).closest('td').index() + ')').find('input, textarea').select();
                    if ($(this).is('#remarkField')) {
                        $('#submit').focus();
                    }
                }
            });

            $("#receiveDateField").blur(function() {
                $('#receiveDateField').datepicker("hide");
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })

        $("#receiveDateField").datepicker({
            dateFormat: 'dd-mm-yy',
            onSelect:function(){
                $('#crewNoField').select();
            }
        });

        $("#crewNoField").autocomplete({
            source: "<?php echo e(URL::to('crew/search')); ?>",
            select:function(key, value){
                console.log(value)

                $('#crewId').val(value.item.id)
                $('#crewNameField').val(value.item.name)
                $('#signedHidden').val(value.item.name)
                $('#qtyDocField').select();

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