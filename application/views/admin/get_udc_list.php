
<div class="container">
    <div class="card">
        <?php if (!empty($add_messege)) { ?>
            <h3 class="flashmessage"><center class="alert alert-success"> <?php echo $add_messege; ?> </center> </h3>
        <?php } ?>
        <?php if (!empty($wrong_messege)) { ?>
            <h3 class="flashmessage"><center class="alert alert-danger"> <?php echo $wrong_messege; ?> </center> </h3>
        <?php } ?>
        <div >
            <h2 >Add UDC</h2>
        </div>

        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <select name="div_auto_iid" required="required" id="" class="form-control div_selection_opt">
                        <option value=""> Select Division </option>
                        <?php foreach ($all_div as $div) { ?>
                            <option value="<?php echo $div->div_id; ?>"> <?php echo $div->div_bn_name; ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <select name="dis_a_iidddd" required="required" id="" class="form-control dis_select_opt">
                        <option value="">Select District</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <select name="up_auto_iidddd" required="required" id="" class="form-control select_up_opt">
                        <option value="">Select Upzila</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <select name="un_a_idid" id="" required="required" class="form-control selection_un_opt">
                        <option value="">Select Union</option>
                    </select>
                </div>
            </div>
            
    <table class="table table-hover table-striped searcing_data_assign"></table>

        </div>
    </div>

</div>







<script type="text/javascript">

    $('.div_selection_opt').change(function () {
        var div_auto_iidd = $(this).val();
        if (div_auto_iidd != '') {
            $.ajax({
                url: 'main/get_dis_info_by_div_a_id?div_auto_iid=' + div_auto_iidd,
                method: 'GET',
                data: '',
                dataType: 'json',
                success: function (dis_all_info) {
                    var dis_html_data = '';
                    for (let l = 0; l < dis_all_info.length; l++) {
                        dis_html_data += '<option value="'+dis_all_info[l].dist_id+'">'+dis_all_info[l].dist_bn_name+'</option>';                    
                    }
                    $('.dis_select_opt').html('<option value=""> Select District </option>'+dis_html_data);
                }
            })
        }else {
            $('.dis_select_opt').html('<option value=""> Select District </option>');
        }
    });

    $('.dis_select_opt').change(function () {
        var dis_auto_iid = $(this).val();
        if (dis_auto_iid != '') {
            $.ajax({
                url: 'main/get_up_info_by_dis_a_id?dis_auto_iid=' + dis_auto_iid,
                method: 'GET',
                data: '',
                dataType: 'json',
                success: function (up_all_info) {
                    var up_html_data = '';
                    for (let l = 0; l < up_all_info.length; l++) {
                        up_html_data += '<option value="'+up_all_info[l].up_id+'">'+up_all_info[l].up_bn_name+'</option>';                    
                    }
                    $('.select_up_opt').html('<option value=""> Select Upzila </option>'+up_html_data);
                }
            })
        }else {
            $('.select_up_opt').html('<option value=""> Select Upzila </option>');
        }
    });

    $('.select_up_opt').change(function () {
        var up_auto_id = $(this).val();
        if (up_auto_id != '') {
            $.ajax({
                url: 'main/get_un_info_by_up_a_id?up_auto_id=' + up_auto_id,
                method: 'GET',
                data: '',
                dataType: 'json',
                success: function (un_all_info) {
                    var un_html_data = '';
                    for (let l = 0; l < un_all_info.length; l++) {
                        un_html_data += '<option union_bn_name="'+un_all_info[l].un_bn_name+'" value="'+un_all_info[l].un_id+'">'+un_all_info[l].un_bn_name+'</option>';                    
                    }
                    $('.selection_un_opt').html('<option value=""> Select Union </option>'+un_html_data);
                }
            })
        }else {
            $('.selection_un_opt').html('<option value=""> Select Union </option>');
        }
    });




    $(document).on('change', '.selection_un_opt', function () {
        var un_auto_iddd = $('option:selected', this).val();
        
        $.ajax({
            url: 'main/get_udc_info_by_un_auto_id?un_auto_iddd=' + un_auto_iddd,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (udc_all_info) {
                let udc_html_data;
                for (let l = 0; l < udc_all_info.length; l++) {
                    
                    udc_html_data += '<tr class="udc_info_main_div">'+
                                            '<td><b>'+udc_all_info[l].udc_per_name+'</b></td>'+
                                            '<td class="udc_info_mobile">'+udc_all_info[l].udc_phone_no+'</td>'+
                                            '<td class="udc_info_mobile">'+udc_all_info[l].udc_phone_no_2+'</td>'+
                                            '<td class="udc_info_mobile">'+udc_all_info[l].udc_phone_no_3+'</td>'+
                                            '<td class="udc_info_email">'+udc_all_info[l].udc_email_no+'</td>'+
                                            '<td>'+udc_all_info[l].un_bn_name+'</td>'+
                                            '<td>'+udc_all_info[l].up_bn_name+'</td>'+
                                            '<td>'+udc_all_info[l].dist_bn_name+'</td>'+
                                            '<td>'+udc_all_info[l].div_bn_name+'</td>'+
                                         '</tr>';                    
                    }
                    $('.searcing_data_assign').html('<thead>'+
                                                        '<tr>'+
                                                            '<th> UDC Name </th>'+
                                                            '<th> Phone </th>'+
                                                            '<th> Phone 2 </th>'+
                                                            '<th> Phone 3 </th>'+
                                                            '<th> Email </th>'+
                                                            '<th> Union </th>'+
                                                            '<th> Upzila </th>'+
                                                            '<th> Dist Name </th>'+
                                                            '<th> Div Name </th>'+
                                                        '</tr>'+
                                                    '</thead>'+
                                                    '<tbody>'+
                                                        udc_html_data+
                                                    '</tbody>'
                                                    );
                    
                
            }
        })        
    });
    
</script>