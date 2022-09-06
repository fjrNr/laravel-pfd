<?php if(Auth::user()->group == 'ADMIN' || Auth::user()->group == 'USER X'): ?>


<?php $__env->startSection('title'); ?>
    Insert Submission
<?php $__env->stopSection(); ?>

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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Insert Submission</div>

                <div class="card-body">
                    <?php if(Session::has('message')): ?>
                        <div class="col-md-12">
                            <div class="alert alert-info alert-dismissible" group="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo e(Session::get('message')); ?>

                            </div>
                        </div>
                        <?php endif; ?>
                	<form name="form_input" id="form_input" action="/submission/insert" method="post">
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
                                        <input type="text" name="receivedDate" id="receiveDateField" class="form-control text" style="width: 60%" tabindex="2"  placeholder="dd-mm-yyyy" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-[0-9]{4}" value="<?php echo e(date('d-m-Y')); ?>">
                                        <span class="text-danger"><?php echo e($errors->first('receivedDate')); ?></span>
                                    </div>
                                </td>
                                <td>&ensp; &ensp;<label>Remark</label></td>
                                <td rowspan="4">
                                    <div class="form-group">
                                        <textarea type="text" name="remark" id="remarkField" class="form-control text" style="height: 200px; width: 100%; resize: none" tabindex="5"></textarea>
                                        <span class="text-danger"><?php echo e($errors->first('remark')); ?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Crew Number</label></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="crewNo" id="crewNoField" class="form-control text" placeholder="Search Crew Number" style="width: 60%" maxlength="6" tabindex="3" pattern="([0-9]+){6}">
                                        <span class="text-danger"><?php echo e($errors->first('crewNumber')); ?></span>
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
                            <tr>
                                <td><label>Rank</label></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="crewName" id="rankField" class="form-control" style="width: 30%" disabled>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <br>
                        <label>AFL List:</label>
                        <table class="table table-bordered" id="dynamic_field" align="center">
                            <thead>
                            <th>AFL Number</th>
                            <th>Flight Plan</th>
                            <th>Dispatch Release</th>
                            <th>Weather Forecast</th>
                            <th>NOTAM</th>
                            <th>To/Ldg Data Card</th>
                            <th>Load Sheet</th>
                            <th>Fuel Receipt</th>
                            <th>Pax Manifest</th>
                            <th>NOTOC</th>
                            <th>Action</th>
                            </thead>
                        </table>
                        <span class="text-danger"><?php echo e($errors->first('aflNumber.*')); ?></span>
                        <br>
                        <td>
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
        $('#formNoField').focus();
        var i = 0;

        $(document).on('keydown', 'input, textarea', function(e) {
            if (e.keyCode == 13 || e.which == 13) {
                if ($(this).is('.text') || $(this).is('.checkbox')) {
                    e.preventDefault();
                    if ($(this).is('.checkbox')) {
                        this.checked = !this.checked;
                        var cp = $(this).closest('td').next().find(".checkbox").focus();
                        if (cp.length == 0) {
                            $('#add').focus();
                        }
                    }
                }
            } else if (e.keyCode == 37 || e.which == 37) {
                e.preventDefault();
                $('#receiveDateField').datepicker("hide");
                $(this).closest('td').prev().find('input, textarea').select();
                if ($(this).is('#qtyDocField')) {
                    $('#formNoField').select();
                } else if ($(this).is('#remarkField')) {
                    $('#receiveDateField').select();
                } else if ($(this).is('#add')) {
                    if ($('.btn-remove').length > 0) {
                        $('.btn-remove').last().focus();
                    }
                } else if($(this).is('#submit')){
                    $('#add').focus();
                }
            } else if (e.keyCode == 38 || e.which == 38) {
                e.preventDefault();
                $('#receiveDateField').datepicker("hide");
                $(this).closest('tr').prev().find('td:eq(' + $(this).closest('td').index() + ')').find('input, textarea').select();
                if ($(this).parent().parent().is(".baris:first")) {
                    window.scrollTo(0,0);
                    $('#remarkField').select();
                } else if ($(this).is('#add')) {
                    if ($('.btn-remove').length > 0) {
                        $('.text:last').select();
                    }else{
                        $('#remarkField').select();
                    }
                } else if ($(this).is('#submit')) {
                    if ($('.btn-remove').length > 0) {
                        $('.btn-remove').last().focus();
                    } else {
                        $('#remarkField').select();
                    }
                } else if ($(this).is('.btn-remove:first')) {
                    $('input[name^=cbNotoc]').first().focus();
                } else {
                    window.scrollBy(0,-63);
                }
            } else if (e.keyCode == 39 || e.which == 39) {
                e.preventDefault();
                $('#receiveDateField').datepicker("hide");
                $(this).closest('td').next().find('input, textarea').select();
                if ($(this).is('#formNoField')) {
                    $('#qtyDocField').select();
                } else if ($(this).is('#receiveDateField') || $(this).is('#crewNoField')) {
                    $('#remarkField').select();
                } else if ($(this).is('.btn-remove')) {
                    if($('#add').prop('disabled')) $('#submit').focus();
                    else $('#add').focus();
                } else if($(this).is('#add')){
                    $('#submit').focus();
                }
            } else if (e.keyCode == 40|| e.which == 40) {
                e.preventDefault();
                $('#receiveDateField').datepicker("hide");
                $(this).closest('tr').next().find('td:eq(' + $(this).closest('td').index() + ')').find('input, textarea').select();
                if ($(this).is('#remarkField')) {
                    if ($('.btn-remove').length > 0) {
                        $('#aflNoField1').select();
                    }else{
                        $('#add').focus();
                    }
                } else if ($(this).parent().parent().is(".baris:last")) {
                    if ( ($(this).is("input[name^='aflNumber']") || $(this).is("input[name^='cbFlightPlan']") || $(this).is("input[name^='cbDispatch']") || $(this).is("input[name^='cbWeather']") || $(this).is("input[name^='cbNotam']")) 
                        &&
                        $('tr[id^=row]').length < 15){
                        $('#add').focus();
                    } else {
                        $('#submit').focus();
                    }
                }else if($(this).parent().parent().is(".baris")){
                    window.scrollBy(0,63);
                }
            }else if(e.keyCode == 8 || e.which == 8){
                if($(this).is(".checkbox") || $(this).is(".btn-remove")){
                    e.preventDefault();
                    $(this).closest('tr').find('.text').select();
                }
            }
        });

        //for action access
        $("#add").click(function () {
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'" class="baris">\n' +
                '<td><input type="text" name="aflNumber['+i+']" id="aflNoField'+i+'" class="text form-control" style="width:95px" maxlength="8" required pattern="[0-9]{2}[A-Za-z]{2}[0-9]{4}"></td>\n' +
                '<td align="center"><input type="checkbox" class="checkbox" name="cbFlightPlan['+i+']" value="1"></td>\n' +
                '<td align="center"><input type="checkbox" class="checkbox" name="cbDispatch['+i+']"  value="1"></td>\n' +
                '<td align="center"><input type="checkbox" class="checkbox" name="cbWeather['+i+']"  value="1"></td>\n' +
                '<td align="center"><input type="checkbox" class="checkbox" name="cbNotam['+i+']"  value="1"></td>\n' +
                '<td align="center"><input type="checkbox" class="checkbox" name="cbLdgData['+i+']"  value="1"></td>\n' +
                '<td align="center"><input type="checkbox" class="checkbox" name="cbLoadSheet['+i+']"  value="1"></td>\n' +
                '<td align="center"><input type="checkbox" class="checkbox" name="cbFuel['+i+']"  value="1"></td>\n' +
                '<td align="center"><input type="checkbox" class="checkbox" name="cbPax['+i+']"  value="1"></td>\n' +
                '<td align="center"><input type="checkbox" class="checkbox" name="cbNotoc['+i+']"  value="1"></td>\n' +
                '<td align="center"><input type="button" name="remove" id="'+i+'" value="X" class="btn btn-danger btn-remove"></td>\n' +
                '</tr>'
            );
            $('#aflNoField' +i+ '').focus();
            if($('tr[id^=row]').length == 15){
                $('#add').prop('disabled', true);
            }
        });

        $(document).on('click', '.btn-remove', function(){
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
            $('#add').prop('disabled', false);
            $('#add').focus();
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
            $(this).datepicker("hide");
            $('#crewNoField').select();
        }
    });

    $("#crewNoField").autocomplete({
        source: "<?php echo e(URL::to('crew/search')); ?>",
        select:function(key, value){
            $('#crewNameField').val(value.item.name)
            $('#rankField').val(value.item.rank)
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
<?php echo $__env->make('layouts.appTest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>