<?php if(Auth::user()->group == 'ADMIN' || Auth::user()->group == 'USER'): ?>
	

    <?php $__env->startSection('title'); ?>
    Search
    <?php $__env->stopSection(); ?>

	<?php $__env->startSection('styles'); ?>
        <link href="http://code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css" rel="stylesheet">
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('scripts'); ?>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('content'); ?>
		<div class="container">
		    <div class="row justify-content-center">
		        <div class="col-md-8">
		            <div class="card">
		                <div class="card-header">Search Submission</div>

		                <div class="card-body">
                            <div class="form-table">
                                <table>
                                    <tr>
                                        <td><label>GA Flight &ensp;</label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="text" style="width: 100%; max-width: 70px;" id="fltnbrField" maxlength="4">
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>&ensp; &ensp;<label>Flight Date &ensp;</label></td>
                                        <td>
                                            <div class="form-group ">
                                                <input type="text"class="text" maxlength="10" id="fltdateField" placeholder="dd-mm-yyyy">
                                            </div>
                                            <span class="text-danger" id="dateValid"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Depart / Arrive</label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="text" style="width: 100%; max-width: 70px;" id="depField" maxlength="3">
                                            </div>
                                        </td>
                                        <td><label>/</label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="text" style="width: 100%; max-width: 70px;" id="arrField" maxlength="3">
                                            </div>
                                        </td>
                                        <td>&ensp; &ensp;<label>PIC</label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="text" id="picField" maxlength="6">
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <div id="search_form">
                                </div>
                            </div>
                        </div>
		            </div>
	            </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function(){
                $('.text:first').focus();
                $('.text').on('keydown', function(e){
                    if((e.keyCode == 13 || e.which == 13) && $('#fltdateField').datepicker("widget").is(":visible") == false){
                        var fltDate = $('#fltdateField').val();
                        var regexDate = /^(\d{2})-(\d{2})-(\d{4})$/;

                        if(fltDate.match(regexDate) || fltDate == ''){
                            $('#search_form').html('<div align="center">Loading submission list...</div>');
                            $('#dateValid').text('');
                            $.ajax({
                                type: 'get',
                                url : '<?php echo e(URL::to('search2')); ?>',
                                data : {
                                    'depstn' : $('#depField').val(),
                                    'arrstn' : $('#arrField').val(),
                                    'fltnbr' : $('#fltnbrField').val(),
                                    'pic' : $('#picField').val(),
                                    'fltdate' : fltDate,
                                },
                                success: function(data){
                                    $('#search_form').html(data);
                                }
                            });
                        }else{
                            $('#dateValid').text('Date format must be valid.');
                        }
                    }else{
                        if($(this).is('.text:eq(2)') || $(this).is('.text:eq(3)')){
                            if((e.keyCode >= 65 && e.keyCode <= 90) || (e.which >= 65 && e.which <= 90)){
                                $(this).on('input', function(){
                                    $(this).val(function(_, val) {
                                        return val.toUpperCase();
                                    });
                                });
                            }
                        }
                    }
                });

                $('#fltdateField').datepicker({
                    dateFormat: 'dd-mm-yy',
                    onSelect:function(){
                        $(this).datepicker("hide");
                    }
                })
            })      
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