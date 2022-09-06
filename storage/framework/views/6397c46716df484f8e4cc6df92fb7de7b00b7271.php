<label>Submission List:</label>
<table class="table" id="submission_list" align="center" style="width:100%">
    <thead>
        <th class="text-center"><input id="select_all" value="1" type="checkbox"></th>
        <th class="text-center">ID</th>
        <th class="text-center">Form Number</th>
        <th class="text-center">Received Date</th>
        <th class="text-center">Document</th>
        <th class="text-center">Crew Number</th>
        <th class="text-center">Crew Name</th>
    </thead>
    <tbody align="center">
        <?php $__currentLoopData = $submissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td></td>
                <td><?php echo e($subm->id); ?></td>
                <td><?php echo e($subm->formNumber); ?></td>
                <td>
                    <?php if(isset ($subm->revDate)): ?>
                        <?php echo e(date('d-m-Y', strtotime($subm->revDate))); ?>                        
                    <?php else: ?>
                        <?php echo e("Unidentified"); ?>

                    <?php endif; ?>
                </td>
                <td><?php echo e($subm->qtyDoc); ?></td>
                <td>
                    <?php if(isset ($subm->crewNumber)): ?>
                        <?php echo e($subm->crewNumber); ?>

                    <?php else: ?>
                        <?php echo e("Unidentified"); ?>

                    <?php endif; ?>
                </td>
                <td>
                    <?php if(isset ($subm->firstname) || isset ($subm->lastname)): ?>
                        <?php echo e($subm->firstname.' '.$subm->lastname.' '); ?>

                    <?php else: ?>
                        <?php echo e("-"); ?>

                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<label id="countSelected" style="font-weight: bold"></label>
<input type="button" class="btn btn-success" value="&#x2713; Submit" style="float: right" id="submit">

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
        var table = $('#submission_list').DataTable({
            columnDefs: [{
                orderable: false,
                targets: 0,
                render: function (data, type, full, meta){
                    return '<input type="checkbox">';
                    },
                },
                {orderable: false, visible: false, searchable: false, targets: 1},
            ],
            order: [[1, 'desc']],
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

        $('#submission_list tbody').on('click', 'input[type="checkbox"]', function(e){
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
        $('#submission_list').on('click', 'tbody td, thead th:first-child', function(e){
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

        $('#submit').on('click', function(e){
            e.preventDefault();
            if(rows_selected.length > 0){
                var idArray = JSON.stringify(rows_selected);

                $('#boxNoField').prop('disabled', false);
                $('#yearField').prop('disabled', false);
                $('#packageNoField').prop('disabled', false);
                
                var boxNo = $('#boxNoField').val();
                var year = $('#yearField').val();
                var packageNo = $('#packageNoField').val();

                $('#boxNoField').prop('disabled', true);
                $('#yearField').prop('disabled', true);
                $('#packageNoField').prop('disabled', true);

                $.ajax({
                    type:'post',
                    url : '<?php echo e(URL::to('box/assign')); ?>',
                    data : {
                        'boxNo' : boxNo,
                        'packageNo' : packageNo,
                        'idArray' : idArray,
                        'year' : year,
                    },
                    success: function(response){
                        alert(response.success);
                        if(window.location.pathname.split('/')[2] == 'create'){
                            var date = new Date();
                            var num = date.getDate();
                            var month = date.getMonth()+1;
                            if(num < 10){
                                num = '0' + num;
                            }
                            if(month < 10){
                                month = '0' + month;
                            }
                            $('#assign_form').hide();
                            $('#packingDateField').prop('disabled', false);
                            $('#boxNoField').prop('disabled', false);
                            $('#yearField').prop('disabled', false);
                            $('#packageNoField').prop('disabled', false);
                            $('#packingDateField').val(num + '-' + month + '-' + date.getFullYear());
                            $('#boxNoField').val('');
                            $('#yearField').val(date.getFullYear().toString().substr(-2));
                            $('#packageNoField').val('');
                            $('#create').show();
                            $('#packingDateField').focus();
                        }else{
                            $.ajax({
                                type: 'get',
                                url : '<?php echo e(route('box/countAssigned')); ?>',
                                data: {
                                    'id' : response.boxId
                                },
                                success: function(data){
                                    $('#countAssign').empty();
                                    $('#countAssign').append(data);
                                },
                            });
                        }
                        table.rows('.selected').remove().draw(false);
                        $('#countSelected').empty();
                        rows_selected = [];
                    }
                });
            }else{
                alert('Please select minimal one of all submissions in submission list.');
            }
        });
    })
</script>