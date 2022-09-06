@extends('layouts.appTest')

@section('title')
    Insert Submission
@endsection

@section('styles')
	<link href="http://code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css" rel="stylesheet">
<!--     <link href="{{ asset('public/css/jquery-ui.custom.v1.12.1.min.css') }}" rel="stylesheet"> -->
@endsection

@section('scripts')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><?php if (Request::segment(2) == 'edit') { ?>Edit<?php }else{ ?>Entry<?php } ?> Items Request</div>

                <div class="card-body">
                    <form name="form_input" id="form_input" <?php if (Request::segment(2) == 'edit') { ?> action="{{url('/request/edit') }}/{{$request->id}}"<?php }else{ ?> action="{{url('/request/entry') }}" <?php } ?> method="post">
                        {{csrf_field()}}
                        <table id="static_field" width="100%">
                            <tr>
                                <td><label>Employee Name</label></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="empName" id="empNameField" class="form-control" required <?php if (Request::segment(2) == 'edit') { ?> value="{{$borrower->empName}}"<?php } ?>
                                        autofocus>
                                        <span class="text-danger">{{ $errors->first('empName') }}</span>
                                    </div>
                                </td>
                                <td>&ensp;&ensp;<label>Remark</label></td>
                                <td rowspan="3">
                                    <div class="form-group">
                                        <textarea type="text" name="remark" class="form-control" style="height: 140px; width: 100%; resize: none" id="remarkField"><?php if (Request::segment(2) == 'edit') { ?>{{$borrower->remark}}<?php } ?></textarea>
                                        <span class="text-danger">{{ $errors->first('remark') }}</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Employee Unit</label></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" id="empUnitField" name="empUnit" class="form-control" required maxlength="10" <?php if (Request::segment(2) == 'edit') { ?> value="{{$borrower->empUnit}}"<?php } ?>>
                                        <span class="text-danger">{{ $errors->first('empUnit') }}</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><label>File Type</label></td>
                                <td>
                                    <input type="radio" name="fType" id="rbHc" value="hc" checked><label>Hard Copy</label>
                                    &ensp;
                                    <input type="radio" name="fType" id="rbSc" value="sc"><label>Soft Copy</label>
                                </td>
                            </tr>
                        </table>

                        <label>Borrowing option: </label>
                        <select name="role" id="formSelect" onchange="setFormChange(value);">
                            <option value="0" selected>Non AFL</option>
                            <option value="1">AFL</option>
                        </select>

                        <table class="table table-bordered" id="dynamic_field" align="center">
                            <thead>
                                <th>Form No</th>
                                <th>Identity Box</th>
                                <th>Class of Date</th>
                                <th>Box Number</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <tr id="row0">
                                    <td><input type="text" name="formNo[0]" class="form-control" maxlength="6" required pattern="([0-9]+){4,6}"></td>
                                    <td><input type="text" class="form-control" name="idtyBox[0]" disabled></td>
                                    <td><input type="text" class="form-control" name="date[0]" disabled></td>
                                    <td><input type="text" class="form-control" name="boxNo[0]" disabled></td>
                                    <td align="center"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered" id="dynamic_fieldAFL" align="center" hidden>
                            <thead>
                                <th class="text-center">AFL No</th>
                                <th class="text-center">Flight Date</th>
                                <th class="text-center">PIC</th>
                                <th class="text-center">GA Flight</th>
                                <th class="text-center">ARR</th>
                                <th class="text-center">DEP</th>
                                <th class="text-center">Action</th>
                            </thead>
                            <tbody>
                                <tr id="rowAFL0">
                                    <td><input type="text" name="AFLNo[0]" class="form-control" maxlength="9"></td>
                                    <td><input type="text" class="form-control" name="fltDate[0]" disabled></td>
                                    <td><input type="text" class="form-control" name="pic[0]" disabled></td>
                                    <td><input type="text" class="form-control" name="fltNo[0]" disabled></td>
                                    <td><input type="text" class="form-control" name="arr[0]" disabled></td>
                                    <td><input type="text" class="form-control" name="dep[0]" disabled></td>
                                    <td align="center"></td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <input type="button" name="add" id="add" class="btn btn-add" value="Add More">
                        <input type="submit" value="Submit" name="submit" id="submit" class="btn btn-success" style="float:right;">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>	

<script type="text/javascript">
	$('#formSelect').val("0");
    function setFormChange(value){
        if(value == '0'){
            $('#dynamic_field').removeAttr('hidden');
            $("input[name^='formNo']").attr('pattern',"([0-9]+){4,6}");
            $("input[name^='formNo']").attr('required',"");
            $("input[name^='AFLNo']").removeAttr('pattern');
            $("input[name^='AFLNo']").removeAttr('required');
            $('#dynamic_fieldAFL').attr('hidden',"");
        }else{
            $('#dynamic_field').attr('hidden',"");
            $("input[name^='formNo']").removeAttr('pattern');
            $("input[name^='formNo']").removeAttr('required');
            $("input[name^='AFLNo']").attr('pattern',"[0-9]{2}[A-Za-z]{2}[0-9]{4}[A-Z]?");
            $("input[name^='AFLNo']").attr('required',"");
            $('#dynamic_fieldAFL').removeAttr('hidden');
        }
    }

    $(document).ready(function(){
        var i = 0, j = 0;

        $("#add").click(function () {
            if($('#formSelect').val() == '0'){
                i++;
                $('#dynamic_field').append('<tr id="row'+i+'">\n' +
                    '<td><input type="text" name="formNo['+i+']" class="form-control" maxlength="6" required pattern="([0-9]+){4,6}"></td>\n' +
                    '<td><input type="text" class="form-control" name="idtyBox['+i+']" disabled></td>\n' +
                    '<td><input type="text" class="form-control" name="date['+i+']" disabled></td>\n' +
                    '<td><input type="text" class="form-control" name="boxNo['+i+']" disabled></td>\n' +
                    '<td align="center"><input type="button" name="remove" id="'+i+'" value="X" class="btn btn-danger btn-remove"></td>\n' +
                    '</tr>'
                );
            }else{
                j++;
                $('#dynamic_fieldAFL').append('<tr id="rowAFL'+j+'">' +
                    '<td><input type="text" name="AFLNo['+j+']" class="form-control" maxlength="9" required pattern="[0-9]{2}[A-Za-z]{2}[0-9]{4}[A-Z]?"></td>'+
                    '<td><input type="text" class="form-control" name="fltDate['+j+']" disabled></td>'+
                    '<td><input type="text" class="form-control" name="pic['+j+']" disabled></td>'+
                    '<td><input type="text" class="form-control" name="fltNo['+j+']" disabled></td>'+
                    '<td><input type="text" class="form-control" name="arr['+j+']" disabled></td>'+
                    '<td><input type="text" class="form-control" name="dep['+j+']" disabled></td>'+
                    '<td align="center"><input type="button" name="remove" id="AFL'+j+'" value="X" class="btn btn-danger btn-remove"></td>\n' +
                    '</tr>'
                );
            }
        });

        $(document).on('click', '.btn-remove', function(){
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

        $(document).on('keydown', "input[name^='formNo']", function(){
            $(this).autocomplete({
                source: "{{URL::to('submission/search')}}",
                select:function(key, value){
                    $(this).closest('td').next().find('input').val(value.item.idtyBox).closest('td').next().find('input').val(value.item.classOfDate).closest('td').next().find('input').val(value.item.boxNo);
                }
            });
        });

        $(document).on('keydown', "input[name^='AFLNo']", function(){
            $(this).autocomplete({
                source: "{{URL::to('log/search')}}",
                select:function(key, value){
                    $(this).closest('td').next().find('input').val(value.item.date).closest('td').next().find('input').val(value.item.pic).closest('td').next().find('input').val(value.item.nbr).closest('td').next().find('input').val(value.item.arr).closest('td').next().find('input').val(value.item.dep);
                }
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
@endsection
