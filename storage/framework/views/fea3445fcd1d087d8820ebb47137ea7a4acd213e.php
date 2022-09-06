<?php $__env->startSection('title'); ?>
    Movement Confirmation    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    View Requested Movements
                    <a href="<?php echo e(url('/movement/entry')); ?>" style="font-weight: bold; float: right;" class="btn btn-success"> &#xff0b; Request</a>
                </div>

                <div class="card-body">
                    <table class="table" border="1" width="100%" id="myTable">
                        <thead align="center">
                            <th>Request Date</th>
                            <th>Storage Date</th>
                            <th>Total Box</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>	

<script type="text/javascript">
    $(document).ready(function(){
        var oTable = $('#myTable').DataTable({
            "bFilter" : true,
            "processing": true,
            "order": [[0, 'desc']],
            "serverSide": true,
            "ajax" : {
                "url" : "<?php echo e(URL::to('movement/getData')); ?>",
            },
            "columns":[
                { "data": "created_at", "name": "movements.created_at", "className": "text-center"},
                { "data": "storageDate", "name": "storageDate","className": "text-center"},
                { "data": "totalBox", "name": "totalBox", "className": "text-center","searchable": false},
                { "data": "status" , "name": "movements.status"},
                { "data": "action" , "name": "action", "orderable": false, "searchable": false},
            ],
            "initComplete": function(settings, json) {
                $('#myTable_filter input').unbind();
                $('#myTable_filter input').bind('keyup', function(e) {
                    if(e.keyCode == 13) {
                        oTable.search( this.value ).draw();
                    }
                }); 
            }
        });

        $(document).on('click','.btn-delete',function(){
            var r = confirm("Are you sure to cancel this movement request?");
            if(r == true){
                $.ajax({
                    type:'get',
                    url : $(this).attr('href'),
                    success: function(response){
                        alert(response.success);
                        oTable.ajax.reload(null, false);
                    }
                });
            }
        });

        $(document).on('change','.form-change',function(){
            var r = confirm("The confirmed movement request cannot be changed. Procced?");
            if(r == true){
                $.ajax({
                    type:'get',
                    url : $(this).val(),
                    success: function(response){
                        alert(response.success);
                        oTable.ajax.reload(null, false);
                    }
                });
            }else{
                $(this).prop('selectedIndex', 0);
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.appTest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>