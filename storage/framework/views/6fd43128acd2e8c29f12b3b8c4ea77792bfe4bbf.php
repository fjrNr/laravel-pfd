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
	        <div class="col-md-10">
	            <div class="card">
	                <div class="card-header">Entry AFLs Box</div>

	                <div class="card-body">
                        <form method="post" id="box_form">
                            <?php echo e(csrf_field()); ?>

                            <table id="static_field" width="100%">
                                <tr>
                                    <td><label>Package Number</label></td>
                                    <td><label>AFL/</label></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" style="width: 100%; max-width: 50px;" maxlength="2" required pattern="([0-9]+){2}" class="form-control" name="packY" id="field1"
                                            <?php if (Request::segment(2) == 'edit') { ?>
                                                value="<?php echo e(substr($box->packNbr, 4, 2)); ?>" disabled
                                            <?php }else{ ?>
                                                value="<?php echo e(date('y')); ?>"
                                            <?php } ?>
                                            >
                                        </div>
                                    </td>
                                    <td><label>/</label></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" style="width: 100%; max-width: 70px;" maxlength="4" required pattern="([0-9]+){1,4}" class="form-control" name="packNo" id="field2"
                                            <?php if (Request::segment(2) == 'edit') { ?>
                                                value="<?php echo e(substr($box->packNbr, 7)); ?>" disabled
                                            <?php } ?>
                                            >
                                        </div>
                                    </td>
                                    <td>&ensp;</td>
                                </tr>
                            </table>

                            <label style="font-weight: bold">AFL List:</label>
                            <br>
                            <table id="dynamic_table" class="table" align="center" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"><input id="select_all" value="1" type="checkbox"></th>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">AFL No</th>
                                        <th class="text-center">Flight Date</th>
                                        <th class="text-center">PIC</th>
                                        <th class="text-center">GA Flight</th>
                                        <th class="text-center">ARR</th>
                                        <th class="text-center">DEP</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td></td>
                                            <td><?php echo e($lg->id); ?></td>
                                            <td><?php echo e($lg->aflNbr); ?></td>
                                            <td><?php echo e(date('d-m-Y', strtotime($lg->arrdate))); ?></td>
                                            <td><?php echo e($lg->picnew); ?></td>
                                            <td><?php echo e($lg->fltnbr); ?></td>
                                            <td><?php echo e($lg->arrstn); ?></td>
                                            <td><?php echo e($lg->depstn); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <!-- <tfoot>
                                    <th class="text-center"></th>
                                    <th class="text-center"></th>
                                    <th class="text-center"><input type="text" placeholder="AFL No" style="width:100%"></th>
                                    <th class="text-center"><input type="text" placeholder="Flight Date" style="width:100%"></th>
                                    <th class="text-center"><input type="text" placeholder="PIC" style="width:100%"></th>
                                    <th class="text-center"><input type="text" placeholder="GA Flight" style="width:100%"></th>
                                    <th class="text-center"><input type="text" placeholder="ARR" style="width:100%"></th>
                                    <th class="text-center"><input type="text" placeholder="DEP" style="width:100%"></th>
                                </tfoot> -->
                            </table>
                            <label id="countSelected" style="font-weight: bold"></label>
                            <input type="button" id="create" value="Create" style="float: right" class="btn btn-success">
                        </form>
	                </div>
	            </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    	function updateDataTableSelectAllCtrl(table){
            var $table             = table.table().node();
            var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
            var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
            var chkbox_select_all  = $('thead #select_all', $table).get(0);

            // If none of the checkboxes are checked
            if($chkbox_checked.length === 0){
                chkbox_select_all.checked = false;
                if('indeterminate' in chkbox_select_all){
                    chkbox_select_all.indeterminate = false;
                }
            // If all of the checkboxes are checked
            }else if($chkbox_checked.length === $chkbox_all.length){
                chkbox_select_all.checked = true;
                if('indeterminate' in chkbox_select_all){
                    chkbox_select_all.indeterminate = false;
                }
            // If some of the checkboxes are checked
            }else{
                chkbox_select_all.checked = true;
                if('indeterminate' in chkbox_select_all){
                    chkbox_select_all.indeterminate = true;
                }
            }
        }

        $(document).ready(function(){
            var rows_selected = [];

            $('#dynamic_table thead tr').clone().appendTo( '#dynamic_table thead');
            
            $('#dynamic_table tr:eq(1) th').each( function (i) {    
                var title = $(this).text();

                $(this).html( '<input type="text" placeholder="'+title+'" style="width:100%"/>' );
                $( 'input', this ).on( 'keyup change', function () {
                    if ( table.column(i).search() !== this.value ) {
                        table
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                });
            } );

            $('#dynamic_table tr:eq(1) th:eq(0)').empty();

            var table = $('#dynamic_table').DataTable({
                columnDefs: [{
                    orderable: false,
                    searchable: false,
                    targets: 0,
                    render: function (data, type, full, meta){
                        return '<input type="checkbox">';
                        },
                    },
                    {orderable: false, visible: false, searchable: false, targets: 1},
                ],
                order: [[2, 'desc']],
                orderCellsTop: true,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                rowCallback: function(row, data, dataIndex){
                    // Get row form Number
                    var rowId = data[1];

                    // If row form number is in the list of selected row form numbers
                    if($.inArray(rowId, rows_selected) !== -1){
                       $(row).find('input[type="checkbox"]').prop('checked', true);
                       $(row).addClass('selected');
                    }
                },
            });

            $('.dataTables_filter').hide();

            $('#dynamic_table tbody').on('click', 'input[type="checkbox"]', function(e){
                var $row = $(this).closest('tr');

                // Get row data
                var data = table.row($row).data();

                // Get row id
                var rowId = data[1];

                // Determine whether row id is in the list of selected row form numbers 
                var index = $.inArray(rowId, rows_selected);

                // If checkbox is checked and row id is not in list of selected row form numbers
                if(this.checked && index === -1){
                    rows_selected.push(rowId);
                }else if(!this.checked && index !== -1){
                    rows_selected.splice(index, 1);
                }

                console.log(rows_selected);
                
                if(this.checked){
                    $row.addClass('selected');
                }else{
                    $row.removeClass('selected');
                }

                // Update state of "Select all" control
                updateDataTableSelectAllCtrl(table);

                // Prevent click event from propagating to parent
                e.stopPropagation();
                $('#countSelected').empty();
                if(rows_selected.length > 1){
                    $('#countSelected').append(rows_selected.length + ' items selected.');
                }else if(rows_selected.length == 1){
                    $('#countSelected').append(rows_selected.length + ' item selected.');
                }
            });

            // Handle click on table cells with checkboxes
            $('#dynamic_table').on('click', 'tbody td, thead th:first-child', function(e){
                $(this).parent().find('input[type="checkbox"]').trigger('click');
            });

            // Handle click on "Select all" control
            $('thead #select_all', table.table().container()).on('click', function(e){
                if(this.checked){
                    $('tbody input[type="checkbox"]:not(:checked)', table.table().container()).trigger('click');
                }else{
                    $('tbody input[type="checkbox"]:checked', table.table().container()).trigger('click');
                }

                // Prevent click event from propagating to parent
                e.stopPropagation();
            });

            // Handle table draw event
            table.on('draw', function(){
                // Update state of "Select all" control
                updateDataTableSelectAllCtrl(table);
            });

            $('#create').on('click', function(){
                if(table.rows().count() > 0 && rows_selected.length > 0){
                    var idArray = JSON.stringify(rows_selected);
                    
                    $.ajax({
                        type:'POST',
                        url : '<?php echo e(URL::to('box/entry/afl')); ?>',
                        data : {
                            'packY' : $('#field1').val(),
                            'packNo' : $('#field2').val(),
                            'idArray' : idArray,
                        },
                        success:function(response){
                            if(response.success){
                                alert(response.success);
                                table.rows('.selected').remove().draw(false);
                                rows_selected=[];
                                $('#field1').val('');
                                $('#field2').val('');
                                $('#countSelected').empty();
                            }else{
                                alert(response.error);
                            }
                        },
                    });
                }else{
                    alert('Please select the AFL.');
                }
            })

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>	
<?php echo $__env->make('layouts.appTest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>