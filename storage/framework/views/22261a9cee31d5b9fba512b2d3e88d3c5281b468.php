<?php $__env->startSection('title'); ?>
    Insert Submission
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
	<link href="http://code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css" rel="stylesheet">
<!--     <link href="<?php echo e(asset('public/css/jquery-ui.custom.v1.12.1.min.css')); ?>" rel="stylesheet"> -->
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
                <div class="card-header"><?php if (Request::segment(2) == 'edit') { ?>Edit<?php }else{ ?>Insert<?php } ?> Submission</div>

                <div class="card-body">
                    <?php if(Session::has('message')): ?>
                        <div class="col-md-12">
                            <div class="alert alert-info alert-dismissible" group="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo e(Session::get('message')); ?>

                            </div>
                        </div>
                        <?php endif; ?>
                	<form name="form_input" id="form_input" <?php if (Request::segment(2) == 'edit') { ?> action="<?php echo e(url('/submission/edit')); ?>/<?php echo e($submission->id); ?>"<?php }else{ ?> action="<?php echo e(url('/submission/insert')); ?>" <?php } ?> method="post">
                        <?php echo e(csrf_field()); ?>

                        <table id="static_field" width="100%">
                            <tr>
                                <td><label>Form Number</label></td>
                                <td>
                                    <div class="form-group" >
                                        <input type="text" name="formNbr" id="formNoField" class="form-control text" maxlength="5" style="width: 30%" tabindex="1" required pattern="([0-9]+){4,5}" <?php if (Request::segment(2) == 'edit') { ?>
                                                    value="<?php echo e($submission->formNbr); ?>"
                                            <?php } ?>
                                        >
                                        <span class="text-danger"><?php echo e($errors->first('formNbr')); ?></span>
                                    </div>
                                </td>
                                <td>&ensp; &ensp;<label>Document</label></td>
                                <td>
                                    <div class="form-group ">
                                        <input type="text" name="qtyDoc" id="qtyDocField" class="form-control text" maxlength="2" style="width: 20%" tabindex="4" required pattern="[0-9]+" 
                                        <?php if (Request::segment(2) == 'edit') { ?>
                                                value="<?php echo e($submission->quantity); ?>"
                                        <?php } ?>
                                        >
                                        <span class="text-danger"><?php echo e($errors->first('qtyDoc')); ?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Received Date</label></td>
                                <td><div class="form-group">
                                        <input type="text" name="receivedDate" id="receiveDateField" class="form-control text" style="width: 60%" tabindex="2"  placeholder="dd-mm-yyyy" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-[0-9]{4}"
                                        <?php if (Request::segment(2) == 'edit') { ?>
                                                value="<?php echo e(date('d-m-Y',strtotime($submission->receivedDate))); ?>"
                                        <?php }else{ ?>
                                            value="<?php echo e(date('d-m-Y')); ?>"
                                        <?php } ?>
                                        >
                                        <span class="text-danger"><?php echo e($errors->first('receivedDate')); ?></span>
                                    </div>
                                </td>
                                <td>&ensp; &ensp;<label>Remark</label></td>
                                <td rowspan="4">
                                    <div class="form-group">
                                        <textarea type="text" name="remark" id="remarkField" class="form-control text" style="height: 200px; width: 100%; resize: none" tabindex="5" value="test"><?php if (Request::segment(2) == 'edit') { ?><?php echo e($submission->remark); ?><?php } ?></textarea>
                                        <span class="text-danger"><?php echo e($errors->first('remark')); ?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Crew Number</label></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="empNbr" id="crewNoField" class="form-control text" placeholder="Search Crew Number" style="width: 60%" maxlength="6" tabindex="3" pattern="([0-9]+){6}" <?php if (Request::segment(2) == 'edit') { ?>value="<?php echo e($submission->empNbr); ?>"<?php } ?>>
                                        <span class="text-danger"><?php echo e($errors->first('empNbr')); ?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Crew Name</label></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="crewName" id="crewNameField" class="form-control" disabled <?php if (Request::segment(2) == 'edit') { ?>value="<?php echo e($submission->signed); ?>"<?php } ?>>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Rank</label></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="crewName" id="rankField" class="form-control" style="width: 30%" disabled <?php if (Request::segment(2) == 'edit') { ?>value="<?php echo e($submission->empRank); ?>"<?php } ?>>
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
                            <th colspan="2">Action</th>
                            </thead>
                            <?php if (Request::segment(2) == 'edit') { ?>
                            <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="row<?php echo e($loop->iteration); ?>" class="baris">
                                <td><input type="text" name="aflNbr[<?php echo e($loop->iteration); ?>]" id="aflNoField<?php echo e($loop->iteration); ?>" class="text form-control" style="width:95px" maxlength="8" required pattern="[0-9]{2}[A-Za-z]{2}[0-9]{4}" value="<?php echo e($lg->aflNbr); ?>" ></td>
                                <td align="center"><input type="checkbox" class="checkbox" name="cbFlightPlan[<?php echo e($loop->iteration); ?>]" value="1"
                                    <?php if($lg->flightPlan == 1) {?>
                                        checked
                                    <?php } ?>
                                ></td>
                                <td align="center"><input type="checkbox" class="checkbox" name="cbDispatch[<?php echo e($loop->iteration); ?>]"  value="1"
                                    <?php if($lg->dispatchRelease == 1) {?>
                                        checked
                                    <?php } ?>
                                ></td>
                                <td align="center"><input type="checkbox" class="checkbox" name="cbWeather[<?php echo e($loop->iteration); ?>]"  value="1"
                                    <?php if($lg->weatherForecast == 1) {?>
                                        checked
                                    <?php } ?>
                                ></td>
                                <td align="center"><input type="checkbox" class="checkbox" name="cbNotam[<?php echo e($loop->iteration); ?>]"  value="1"
                                    <?php if($lg->notam == 1) {?>
                                        checked
                                    <?php } ?>
                                ></td>
                                <td align="center"><input type="checkbox" class="checkbox" name="cbLdgData[<?php echo e($loop->iteration); ?>]"  value="1"
                                    <?php if($lg->toLdgDataCard == 1) {?>
                                        checked
                                    <?php } ?>
                                ></td>
                                <td align="center"><input type="checkbox" class="checkbox" name="cbLoadSheet[<?php echo e($loop->iteration); ?>]"  value="1"
                                    <?php if($lg->loadSheet == 1) {?>
                                        checked
                                    <?php } ?>
                                ></td>
                                <td align="center"><input type="checkbox" class="checkbox" name="cbFuel[<?php echo e($loop->iteration); ?>]"  value="1"
                                    <?php if($lg->fuelReceipt == 1) {?>
                                        checked
                                    <?php } ?>
                                ></td>
                                <td align="center"><input type="checkbox" class="checkbox" name="cbPax[<?php echo e($loop->iteration); ?>]"  value="1"
                                    <?php if($lg->paxManifest == 1) {?>
                                        checked
                                    <?php } ?>
                                ></td>
                                <td align="center"><input type="checkbox" class="checkbox" name="cbNotoc[<?php echo e($loop->iteration); ?>]"  value="1"
                                    <?php if($lg->notoc == 1) {?>
                                        checked
                                    <?php } ?>
                                ></td>
                                <td align="center"><input type="button" name="remove" id="<?php echo e($loop->iteration); ?>" value="X" class="btn btn-danger btn-remove"></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                            <?php } ?>
                        </table>
                        <span class="text-danger"><?php echo e($errors->first('aflNbr.*')); ?></span>
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

        <?php if (Request::segment(2) == 'edit') { ?>
            var i = <?php echo e(count($logs)); ?>;
        <?php }else{ ?>
            var i = 0;
        <?php } ?>

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
                if ($(this).is('#qtyDocField')) {
                    $('#formNoField').select();
                } else if ($(this).is('#remarkField')) {
                    $('#receiveDateField').select();
                } else if ($(this).is("input[name^='cbFlightPlan']")){
                    $(this).closest('td').prev().find('input').select();                    
                } else if($(this).is('.checkbox') || $(this).is('.btn-remove')){
                    $(this).closest('td').prev().find('.checkbox').focus();
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
                if ($(this).parent().parent().is(".baris:first")) {
                    window.scrollTo(0,0);
                    $('#remarkField').select();
                } else if ($(this).is("input[name^='aflNbr']") || $(this).is('.checkbox') || $(this).is('.btn-remove')){
                    window.scrollBy(0,-63);
                    if($(this).is("input[name^='aflNbr']")){
                        $(this).closest('tr').prev().find('td:eq(' + $(this).closest('td').index() + ')').find("input[name^='aflNbr']").select();    
                    }else{
                        $(this).closest('tr').prev().find('td:eq(' + $(this).closest('td').index() + ')').find('.checkbox, .btn-remove').focus();
                    }
                } else if ($(this).is('#add') || $(this).is('#submit')) {
                    if ($('.btn-remove').length > 0) {
                        if($(this).is('#add')) $('.text:last').select();
                        else $('.btn-remove').last().focus(); 
                    }else{
                        window.scrollTo(0,0);
                        $('#remarkField').select();
                    }
                } else{
                    $(this).closest('tr').prev().find('td:eq(' + $(this).closest('td').index() + ')').find('.text').select();
                }
            } else if (e.keyCode == 39 || e.which == 39) {
                e.preventDefault();
                $('#receiveDateField').datepicker("hide");
                if ($(this).is('#formNoField')) {
                    $('#qtyDocField').select();
                } else if ($(this).is('#receiveDateField') || $(this).is('#crewNoField')) {
                    $('#remarkField').select();
                } else if ($(this).is("input[name^='aflNbr']")){
                    $(this).closest('td').next().find('.checkbox').focus();
                } else if ($(this).is("input[name^='cbNotoc']")){
                    $(this).closest('td').next().find('input').focus();
                } else if ($(this).is('.checkbox')){
                    $(this).closest('td').next().find('.checkbox').focus();
                } else if ($(this).is('.btn-remove')) {
                    if($('#add').prop('disabled')) $('#submit').focus();
                    else $('#add').focus();
                } else if($(this).is('#add')){
                    $('#submit').focus();
                }
            } else if (e.keyCode == 40|| e.which == 40) {
                e.preventDefault();
                $('#receiveDateField').datepicker("hide");
                if ($(this).is('#remarkField')) {
                    if ($('.btn-remove').length > 0) {
                        $('input[id^=aflNoField]:first').select();
                    }else{
                        $('#add').focus();
                    }
                } else if ($(this).parent().parent().is(".baris:last")) {
                    if ( ($(this).is("input[name^='aflNbr']") || $(this).is("input[name^='cbFlightPlan']") || $(this).is("input[name^='cbDispatch']") || $(this).is("input[name^='cbWeather']") || $(this).is("input[name^='cbNotam']")) 
                        &&
                        $('tr[id^=row]').length < 15){
                        $('#add').focus();
                    } else {
                        $('#submit').focus();
                    }
                } else if ($(this).is("input[name^='aflNbr']") || $(this).is('.checkbox') || $(this).is('.btn-remove')){
                    window.scrollBy(0,63);
                    if($(this).is("input[name^='aflNbr']")){
                        $(this).closest('tr').next().find('td:eq(' + $(this).closest('td').index() + ')').find("input[name^='aflNbr']").select();    
                    }else{
                        $(this).closest('tr').next().find('td:eq(' + $(this).closest('td').index() + ')').find('.checkbox, .btn-remove').focus();
                    }
                } else{
                    $(this).closest('tr').next().find('td:eq(' + $(this).closest('td').index() + ')').find('.text').select();
                }
            }else if(e.keyCode == 8 || e.which == 8){
                if($(this).is(".checkbox") || $(this).is(".btn-remove")){
                    e.preventDefault();
                    $(this).closest('tr').find('.text').select();
                }
            }else{
                if($(this).is('#formNoField') || $(this).is('#qtyDocField') || $(this).is('#crewNoField')){
                    if(!(e.keyCode >= 48 && e.keyCode <= 57) || !(e.which >= 48 && e.which <= 57)){
                        e.preventDefault();
                    }
                }else if($(this).is('input[id^=aflNoField]')){
                    $(this).on('input', function(){
                        $(this).val(function(_, val) {
                            return val.toUpperCase();
                        });
                    });
                }
            }
        });

        //for action access
        $("#add").click(function () {
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'" class="baris">\n' +
                '<td><input type="text" name="aflNbr['+i+']" id="aflNoField'+i+'" class="text form-control" style="width:95px" maxlength="8" required pattern="[0-9]{2}[A-Za-z]{2}[0-9]{4}"></td>\n' +
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

        <?php if (Request::segment(2) == 'edit') { ?>
            $('#submit').click(function(){
                return confirm("Are you sure to change this submisssion?");
            });
        <?php } ?>

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
<?php echo $__env->make('layouts.appTest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>