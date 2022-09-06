<?php $__env->startSection('title'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <link href="http://code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css">
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
                <div class="card-header">Entry Movement Request</div>

                <div class="card-body">
                    <div class="tab-pane active in" id="inputForm">
                        <table class="table table-hover" border="1" width="100%" id="formTable">
                            <thead align="center">
                                <th>ID</th>
                                <th>Package Box</th>
                                <th>Periode</th>
                                <th>Box Number</th>
                                <th>Total Document</th>
                            </thead>
                            <tbody align="center">
                                <?php $__currentLoopData = $aflBoxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $box): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($box->id); ?></td>
                                        <td><?php echo e($box->packNbr); ?></td>
                                        <td><?php echo e(date('F Y', strtotime($box->startDateOf))); ?> - <?php echo e(date('F Y', strtotime($box->endDateOf))); ?></td>
                                        <td><?php echo e("-"); ?></td>
                                        <td><?php echo e($box->totalDoc); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $submBoxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $box): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($box->id); ?></td>
                                        <td><?php echo e($box->packNbr); ?></td>
                                        <td><?php echo e(date('d F Y', strtotime($box->classOf))); ?></td>
                                        <td><?php echo e($box->boxNbr); ?></td>
                                        <td><?php echo e($box->totalDoc); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <input type="button" class="btn btn-success" value="Submit" id="submit">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>	

<script type="text/javascript">
    $(document).ready(function(){
        var idArrayTemp = [];

        var fTable = $('#formTable').DataTable({
            columnDefs: [
                {orderable: false, visible: false, searchable: false, targets: 0},
                {orderable: false, searchable: false, targets: 3},
                {orderable: false, searchable: false, targets: 4},
            ],
            oLanguage: { "sSearch": "<span>Search: PFD,AFL/</span>" },
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        });

        $('#formTable_filter label').append("<select>"+
            "<option value=''>Month</option>"+
            "<option value='Jan'>Jan</option>"+
            "<option value='Feb'>Feb</option>"+
            "<option value='Mar'>Mar</option>"+
            "<option value='Apr'>Apr</option>"+
            "<option value='May'>May</option>"+
            "<option value='Jun'>Jun</option>"+
            "<option value='Jul'>Jul</option>"+
            "<option value='Aug'>Aug</option>"+
            "<option value='Sep'>Sep</option>"+
            "<option value='Oct'>Oct</option>"+
            "<option value='Nov'>Nov</option>"+
            "<option value='Dec'>Dec</option>"+
            "</select>");

        $('#formTable_filter input').attr('placeholder', 'yy/xxxx');

        $('#formTable_filter input').on('keyup', function () {
            fTable.column(1).search( this.value ).draw();
        });
        
        $('#formTable_filter label select').on('change', function () {
            fTable.column(2).search( this.value ).draw();
        });

        $('#submit').on('click', function(){
            if(fTable.rows().count() > 0){
                for(var i = 0; i < fTable.rows().count(); i++){
                    idArrayTemp.push(fTable.row(i).data()[0]);
                }
                var idArray = JSON.stringify(idArrayTemp);
                
                $.ajax({
                    type:'POST',
                    url : '<?php echo e(URL::to('movement/entry')); ?>',
                    data : {
                        'idArray' : idArray,
                    },
                    success:function(response){
                        if(response.success){
                            alert(response.success);
                            fTable.rows().remove().draw(false);
                            idArrayTemp=[];
                            window.location.href = '<?php echo e(URL::to('movement/index')); ?>';
                        }else{
                            alert(response.error);    
                        }
                    },
                });
            }else{
                alert('Tidak');
            }
        })

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    $("#stoDateField").datepicker({
        dateFormat: 'dd-mm-yy',
        onSelect:function(){
            $(this).datepicker("hide");
            $('#crewNoField').select();
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.appTest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>