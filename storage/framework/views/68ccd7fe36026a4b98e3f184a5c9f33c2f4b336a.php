<?php $__env->startSection('title'); ?>
    
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
                <div class="card-header">Request Document Transfer</div>

                <div class="card-body">
                    <table class="table table-hover" border="1" width="100%">
                        <thead align="center">
                            <th><input type="checkbox"></th>
                            <th>Identity Number</th>
                            <th>Periode</th>
                            <th>Total Boxes</th>
                            <th>Retention Status</th>
                        </thead>
                        <tbody align="center">
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>AFL/18/0001</td>
                                <td>Januari s.d. April 2018</td>
                                <td>1</td>
                                <td>Not yet missed</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>PFD/18/0099 - 0158</td>
                                <td>Januari 2018</td>
                                <td>180</td>
                                <td>Terlewati</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>AFL/18/0002</td>
                                <td>Januari s.d. April 2018</td>
                                <td>1</td>
                                <td>Not yet missed</td>
                            </tr>
                        </tbody>
                    </table>
                    <label>181 boxes selected.</label>
                    <input type="button" class="btn btn-success" value="Submit">
                </div>
            </div>
        </div>
    </div>
</div>	

<script type="text/javascript">
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.appTest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>