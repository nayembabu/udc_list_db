<br><br>






<div class="container">
    <div class="card">

        <h3 class="flashmessage flashmessage_add" style="display:none" >
            <center class="alert alert-success "> 
                Added Succesfully 
            </center> 
        </h3>
        <h3 class="flashmessage_wrong" style="display:none">
            <center class="alert alert-danger "> 
                This Phone Already added. 
            </center> 
        </h3>

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
            <div class="form-group row">
                <label  class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                <input type="text" required="required" class="form-control udc_name_info" id="name" name="udc_name">
            </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>phone 1</label>
                    <input type="text" required="required" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control udc_phone_info" name="udc_phone_no_1" maxlength="11">
                </div>
                <div class="form-group col-md-4">
                    <label>phone 2</label>
                    <input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control udc_phone_no_two" name="udc_phone_no_two">
                </div>
                <div class="form-group col-md-4">
                    <label>phone 3</label>
                    <input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control udc_phone_no_three" name="udc_phone_no_three">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                <input type="email" required="required" class="form-control udc_email_info" id="inputEmail3" name="udc_email_add">
            </div>
            </div>
            <div class="form-group  ">
                <label>remarks</label>
                <textarea class="form-control udc_remark_info" cols="4" rows="1" name="udc_remark"></textarea>
            </div>

            <button class="btn btn-success save_data_btn" type="submit">Save</button>


    <br>
    
    <table class="table table-hover table-striped searcing_data_assign"></table>
        </div>
    </div>

    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
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
        var un_bn_name_s = $('option:selected', this).attr("union_bn_name");
        if (un_bn_name_s != '') {
            $.ajax({
                url: 'main/get_udc_info_by_un_bn_name?un_bn_name=' + un_bn_name_s,
                method: 'GET',
                data: '',
                dataType: 'json',
                success: function (udc_all_info) {
                    var udc_html_data = '';
                    for (let l = 0; l < udc_all_info.length; l++) {
                        udc_html_data += '<tr class="udc_info_main_div">'+
                                            '<b><td type="button" class="btn btn-outline-success btn-sm udc_info_name">'+udc_all_info[l].udc_person_name+'</td></b>'+
                                            '<td class="udc_info_mobile">'+udc_all_info[l].udc_mobile_no+'</td>'+
                                            '<td class="udc_info_email">'+udc_all_info[l].udc_email+'</td>'+
                                            '<td>'+udc_all_info[l].union_name+'</td>'+
                                            '<td>'+udc_all_info[l].upazilla_name+'</td>'+
                                            '<td>'+udc_all_info[l].dist_name+'</td>'+
                                            '<td>'+udc_all_info[l].div_name+'</td>'+
                                         '</tr>';                    
                    }
                    $('.searcing_data_assign').html('<thead>'+
                                    '<tr>'+
                                        '<th> udc name </th>'+
                                        '<th> phone </th>'+
                                        '<th> email </th>'+
                                        '<th> Union </th>'+
                                        '<th> Upzila </th>'+
                                        '<th> Dist name </th>'+
                                        '<th> Div name </th>'+
                                    '</tr>'+
                                '</thead>'+
                                '<tbody>'+
                                    udc_html_data+
                                '</tbody>'
                                );
                }
            })
        }else {
            $('.searcing_data_assign').html('');
        }
    });

    $(document).on('click', '.udc_info_name', function () {
        var udc_info_name = $(this).parents('.udc_info_main_div').find('.udc_info_name').html();
        var udc_info_mobile = $(this).parents('.udc_info_main_div').find('.udc_info_mobile').html();
        var udc_info_email = $(this).parents('.udc_info_main_div').find('.udc_info_email').html();
        $('.udc_name_info').val(udc_info_name);
        $('.udc_phone_info').val(udc_info_mobile);
        $('.udc_email_info').val(udc_info_email);
    });

    $(document).on('click', '.save_data_btn', function () {
        let div_auto_iid        = $('.div_selection_opt').val();        
        let dis_a_iidddd        = $('.dis_select_opt').val();        
        let up_auto_iidddd      = $('.select_up_opt').val();        
        let un_a_idid           = $('.selection_un_opt').val();        
        let udc_name            = $('.udc_name_info').val();
        let udc_phone_no_1      = $('.udc_phone_info').val();
        let udc_phone_no_two    = $('.udc_phone_no_two').val();
        let udc_phone_no_three  = $('.udc_phone_no_three').val();
        let udc_email_add       = $('.udc_email_info').val();
        let udc_remark          = $('.udc_remark_info').val();


        $.ajax({
            url: 'main/udc_add_2',
            method: 'POST',
            data: {
                div_auto_iid: div_auto_iid,
                dis_a_iidddd: dis_a_iidddd,
                up_auto_iidddd: up_auto_iidddd,
                un_a_idid: un_a_idid,
                udc_name: udc_name,
                udc_phone_no_1: udc_phone_no_1,
                udc_phone_no_two: udc_phone_no_two,
                udc_phone_no_three: udc_phone_no_three,
                udc_email_add: udc_email_add,
                udc_remark: udc_remark
            },
            dataType: 'json',
            success: function (res) {
                $('.udc_name_info').val('');
                $('.udc_phone_info').val('');
                $('.udc_phone_no_two').val('');
                $('.udc_phone_no_three').val('');
                $('.udc_email_info').val('');
                $('.udc_remark_info').val('');
                let suc_msg = res.succ;
                let wrong_msg = res.wrong;
                if (suc_msg == null) {
                    $(".flashmessage_wrong").fadeIn();
                    $(".flashmessage_wrong").delay(5000).fadeOut(50);                    
                }else {
                    $(".flashmessage_add").fadeIn();
                    $(".flashmessage_add").delay(5000).fadeOut(50);
                }
            }
        })
        
    });


</script>