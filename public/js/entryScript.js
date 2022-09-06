$(document).ready(function(){
        // <?php if (Request::segment(2) == 'edit') { ?>
        //     var i = {{count($logs)}};
        // <?php }else{ ?>
        //     var i = 0;
        // <?php } ?>

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
                '<td><input type="text" name="aflNbr['+i+']" id="aflNoField'+i+'" class="text form-control" style="width:95px" maxlength="9" required pattern="[0-9]{2}[A-Za-z]{2}[0-9]{4}[A-Z]?"></td>\n' +
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

        // <?php if (Request::segment(2) == 'edit') { ?>
        //     $('#submit').click(function(){
        //         return confirm("Are you sure to change this submisssion?");
        //     });
        // <?php } ?>

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
        source: "{{URL::to('crew/search')}}",
        select:function(key, value){
            $('#crewNameField').val(value.item.name)
            $('#rankField').val(value.item.rank)
            $('#qtyDocField').select();
        }
    });