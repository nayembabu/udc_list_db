
<style>
    .display_none {
        display: none;
    }
</style>

<div class="container">
    <div class="card">
        <div class="card-body">

        <div class="my-3" >
            <h2 > Get UDC Mobile NO </h2>
        </div><br>

            <div class="form-row my-3">
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






            <div class="form-row my-3">
                <div class="form-group col-md-3">
                    <button type="button" class="btn btn-outline-info get_udc_by_div display_none"> Get By Divition </button>
                </div>
                <div class="form-group col-md-3">
                    <button type="button" class="btn btn-outline-info get_udc_by_dist display_none"> Get By District </button>
                </div>
                <div class="form-group col-md-3">
                    <button type="button" class="btn btn-outline-info get_udc_by_up display_none"> Get By Upazilla </button>
                </div>
                <div class="form-group col-md-3">
                    <button type="button" class="btn btn-outline-info get_udc_by_un display_none"> Get By Union </button>
                </div>
            </div>


            <table class="table table-hover table-striped table2excel table2excel_with_colors" data-tableName="Test Table 3">
                <thead>
                    <tr>
                        <th> SL </th>
                        <th> UDC Name </th>
                        <th> Phone </th>
                        <th> Email </th>
                        <th> Union </th>
                        <th> Upzilla </th>
                        <th> Dist Name </th>
                        <th> Div Name </th>
                    </tr>
                </thead>
                <tbody class="searcing_data_assign"></tbody>
            </table>

            <button class="exportToExcel">Export to XLS</button>
            
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
            
            $('.get_udc_by_div').css('display', 'block');
            $('.get_udc_by_dist').css('display', 'none');
            $('.get_udc_by_up').css('display', 'none');
            $('.get_udc_by_un').css('display', 'none');

            
            $('.select_up_opt').html('<option value=""> Select Upzila </option>');
            $('.selection_un_opt').html('<option value=""> Select Union </option>');
        }else {

            $('.dis_select_opt').html('<option value=""> Select District </option>');
            $('.get_udc_by_div').css('display', 'none');
            $('.get_udc_by_dist').css('display', 'none');
            $('.get_udc_by_up').css('display', 'none');
            $('.get_udc_by_un').css('display', 'none');

            $('.select_up_opt').html('<option value=""> Select Upzila </option>');
            $('.selection_un_opt').html('<option value=""> Select Union </option>');
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
            $('.get_udc_by_dist').css('display', 'block');
            $('.get_udc_by_up').css('display', 'none');
            $('.get_udc_by_un').css('display', 'none');

            $('.selection_un_opt').html('<option value=""> Select Union </option>');
        }else {
            $('.select_up_opt').html('<option value=""> Select Upzila </option>');
            $('.get_udc_by_dist').css('display', 'none');
            $('.get_udc_by_up').css('display', 'none');
            $('.get_udc_by_un').css('display', 'none');
            
            $('.selection_un_opt').html('<option value=""> Select Union </option>');
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
            $('.get_udc_by_up').css('display', 'block');
            $('.get_udc_by_un').css('display', 'none');
        }else {
            $('.selection_un_opt').html('<option value=""> Select Union </option>');
            $('.get_udc_by_up').css('display', 'none');
            $('.get_udc_by_un').css('display', 'none');
        }
    });

    $('.selection_un_opt').change(function () {
        var un_auto_id = $(this).val();
        if (un_auto_id != '') {
            $('.get_udc_by_un').css('display', 'block');
        }else{
            $('.get_udc_by_un').css('display', 'none');
        }
    })















    $(document).on('click', '.get_udc_by_div', function () {
        var div_selection_opt_iid = $('.div_selection_opt').val();
        $.ajax({
            url: 'main/get_un_info_by_div_a_id?auto_id=' + div_selection_opt_iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (udc_i) {
                var html_data='';
                let sl1 = 1;
                for (let n = 0; n < udc_i.length; n++) {
                    html_data += `
                                <tr>
                                    <td> ${sl1} </td>
                                    <td> ${udc_i[n].udc_per_name} </td>
                                    <td> ${udc_i[n].udc_phone_no} </td>
                                    <td> ${udc_i[n].udc_email_no} </td>
                                    <td> ${udc_i[n].un_bn_name} </td>
                                    <td> ${udc_i[n].up_bn_name} </td>
                                    <td> ${udc_i[n].dist_bn_name} </td>
                                    <td> ${udc_i[n].div_bn_name} </td>
                                </tr>`;
                                sl1+=1;
                }
                $('.searcing_data_assign').html(html_data);
            }
        })
    });
    
    $(document).on('click', '.get_udc_by_dist', function () {
        var dis_select_opt_iid = $('.dis_select_opt').val();
        $.ajax({
            url: 'main/get_un_info_by_dist_a_id?auto_id=' + dis_select_opt_iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (udc_in) {
                var html_datan='';
                let sl2=1;
                for (let n = 0; n < udc_in.length; n++) {
                    html_datan += `
                                <tr>
                                    <td> ${sl2} </td>
                                    <td> ${udc_in[n].udc_per_name} </td>
                                    <td> ${udc_in[n].udc_phone_no} </td>
                                    <td> ${udc_in[n].udc_email_no} </td>
                                    <td> ${udc_in[n].un_bn_name} </td>
                                    <td> ${udc_in[n].up_bn_name} </td>
                                    <td> ${udc_in[n].dist_bn_name} </td>
                                    <td> ${udc_in[n].div_bn_name} </td>
                                </tr>`;
                                sl2+=1;
                }
                $('.searcing_data_assign').html(html_datan);
            }
        })
    });
    
    $(document).on('click', '.get_udc_by_up', function () {
        var select_up_opt_iid = $('.select_up_opt').val();
        $.ajax({
            url: 'main/get_un_info_by_up_id?auto_id=' + select_up_opt_iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (udc_inf) {
                var html_datanf='';
                let sl3=1;
                for (let n = 0; n < udc_inf.length; n++) {
                    html_datanf += `
                                <tr>
                                    <td> ${sl3} </td>
                                    <td> ${udc_inf[n].udc_per_name} </td>
                                    <td> ${udc_inf[n].udc_phone_no} </td>
                                    <td> ${udc_inf[n].udc_email_no} </td>
                                    <td> ${udc_inf[n].un_bn_name} </td>
                                    <td> ${udc_inf[n].up_bn_name} </td>
                                    <td> ${udc_inf[n].dist_bn_name} </td>
                                    <td> ${udc_inf[n].div_bn_name} </td>
                                </tr>`;
                                sl3+=1;
                }
                $('.searcing_data_assign').html(html_datanf);
            }
        })
    });
    
    $(document).on('click', '.get_udc_by_un', function () {
        var selection_un_opt_iid = $('.selection_un_opt').val();
        $.ajax({
            url: 'main/get_un_info_by_un_id?auto_id=' + selection_un_opt_iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (udc) {
                var html_d='';
                let sl4=1;
                for (let n = 0; n < udc.length; n++) {
                    html_d += `
                                <tr>
                                    <td> ${sl4} </td>
                                    <td> ${udc[n].udc_per_name} </td>
                                    <td> ${udc[n].udc_phone_no} </td>
                                    <td> ${udc[n].udc_email_no} </td>
                                    <td> ${udc[n].un_bn_name} </td>
                                    <td> ${udc[n].up_bn_name} </td>
                                    <td> ${udc[n].dist_bn_name} </td>
                                    <td> ${udc[n].div_bn_name} </td>
                                </tr>`;
                                sl4+=1;
                }
                $('.searcing_data_assign').html(html_d);
            }
        })
    });


    $(document).on('click', '.exportToExcel', function () {
        var table = $(this).prev('.table2excel');
        if(table && table.length){
            var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
            $(table).table2excel({
                exclude: ".noExl",
                name: "Excel Document Name",
                filename: "myFileName" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
                preserveColors: preserveColors
            });
        }
    });
/* 
        $(".exportToExcel").click(function(e){
            var table = $(this).prev('.table2excel');
            if(table && table.length){
                var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
                $(table).table2excel({
                    exclude: ".noExl",
                    name: "Excel Document Name",
                    filename: "myFileName" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                    fileext: ".xls",
                    exclude_img: true,
                    exclude_links: true,
                    exclude_inputs: true,
                    preserveColors: preserveColors
                });
            }
        }); */
    
</script>