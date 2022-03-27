<div class="container">
    <div class="row">
        <div class="col-sm-7 mx-auto my-3">
            <select name="" id="" class="form-control selectUser">
                <option value="">Select a User</option>
                <?php foreach($users as $user): ?>
                <option value="<?php echo $user->id; ?>"><?php echo $user->u_type; ?></option>
                <?php endforeach; ?>
            </select>
                <br><br><br>

            <div class="table_data_section"> 
                <table class="table data_history_table"></table>
            </div>
            
            <div class="payment_count_entry" style="display: none;">
                <input class="form-control form-control-lg total_payment_type" type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control" placeholder=" Type Payment Count ">
                <center>
                    <button type="button" class="btn btn-outline-success mx-auto my-3 total_payment_btn"> Save Payment </button>
                </center>
            </div>

            <div class="get_total_data"></div>
            

        </div>
    </div>
    
    <div class="entry_list_udc">
        <table class="table entry_list_table"></table>
    </div>

</div>




<script>
    $('.selectUser').change(function(){
        var userId = $(this).val();
        get_user_entry_data(userId);
        $('.entry_list_table').html();
        $('.get_total_data').html();
    });

    $(document).on('click', '.get_all_data', function () {
        var user_IDD = $('.selectUser').val();
        entry_list_data(user_IDD)
    });

    $(document).on('click', '.total_payment_count_box_display', function () {
        $('.payment_count_entry').css('display', 'block');
    });

    $('.total_payment_btn').click(function () {
        var payment_count_no = $('.total_payment_type').val();
        var userId = $('.selectUser').val();
        $.ajax({
           url: 'main/entry_payment_count',
           method: 'POST',
           data: {
               payment_count_no: payment_count_no,
               userId: userId
           },
           success:function(){
               get_user_entry_data(userId);
               $('.payment_count_entry').css('display', 'none');
           }
        });
    });

    function get_user_entry_data(userId) {
        $.ajax({
           url: 'main/getDataAsUser',
           method: 'POST',
           dataType:'json',
           data: {
               userid: userId
           },
           success:function(res){
            var totalEntryData = res.counts.length;
            var totalPaymentCount;
            if (res.payment_complete == null) {
                totalPaymentCount = 0;
            }else {
                totalPaymentCount = res.payment_complete;
            }
            var unPaid = totalEntryData - totalPaymentCount;
            var tableData = '<tr>'+
                                '<th scope="col"> Total Entry </th>'+
                                '<th scope="col"> Total Payment </th>'+
                                '<th scope="col"> Total Unpaid </th>'+
                            '</tr>'+
                            '<tr>'+
                                '<td>'+totalEntryData+'</td>'+
                                '<td>'+totalPaymentCount+'</td>'+
                                '<td>'+unPaid+'</td>'+
                            '</tr>'+
                            '<tr>'+
                                '<td colspan="3">'+
                                    '<center>'+
                                        '<button type="button" class="btn btn-outline-success mx-auto total_payment_count_box_display"> Payment Form </button>'+
                                    '</center>'+
                                '</td>'+
                            '</tr>';
            $('.data_history_table').html(tableData);
            $('.get_total_data').html('<center><button type="button" class="btn btn-outline-success mx-auto my-3 get_all_data"> Show All Data </button></center>');
           }
        });
    }

    function entry_list_data(user_IDD) {
        $.ajax({
           url: 'main/getDataBYUser_idddD',
           method: 'POST',
           dataType:'json',
           data: {
               userid: user_IDD
           },
           success:function(resp){
               let html_element;
               for (let n = 0; n < resp.length; n++) {

                    if (resp[n].activity == '0') {
                        html_element += '<tr class="btn-outline-danger">'+
                                            '<td class="my-3 btn btn-outline-success btn_activity" udc_data_Idd="'+resp[n].udc_list_auto_p_iidd+'" data_activity="'+resp[n].activity+'"> Active </td>'+
                                            '<td> '+resp[n].div_bn_name+' </td>'+
                                            '<td> '+resp[n].dist_bn_name+' </td>'+
                                            '<td> '+resp[n].up_bn_name+' </td>'+
                                            '<td> '+resp[n].un_bn_name+' </td>'+
                                            '<td> '+resp[n].udc_per_name+' </td>'+
                                            '<td> '+resp[n].udc_phone_no+' </td>'+
                                            '<td> '+resp[n].udc_email_no+' </td>'+
                                        '</tr>';   
                    }else {
                        html_element += '<tr class="btn-outline-success">'+
                                            '<td class="my-3 btn btn-outline-danger btn_activity" udc_data_Idd="'+resp[n].udc_list_auto_p_iidd+'" data_activity="'+resp[n].activity+'"> Active </td>'+
                                            '<td> '+resp[n].div_bn_name+' </td>'+
                                            '<td> '+resp[n].dist_bn_name+' </td>'+
                                            '<td> '+resp[n].up_bn_name+' </td>'+
                                            '<td> '+resp[n].un_bn_name+' </td>'+
                                            '<td> '+resp[n].udc_per_name+' </td>'+
                                            '<td> '+resp[n].udc_phone_no+' </td>'+
                                            '<td> '+resp[n].udc_email_no+' </td>'+
                                        '</tr>';   
                    }
               }
               $('.entry_list_table').html('<tr>'+
                                                '<th> Activity </th>'+
                                                '<th> Div </th>'+
                                                '<th> Dist </th>'+
                                                '<th> Upazilla </th>'+
                                                '<th> Union </th>'+
                                                '<th> Name </th>'+
                                                '<th> Mobile </th>'+
                                                '<th> Email </th>'+
                                            '</tr>'+html_element);
           }
        });
    }

    $(document).on('click', '.btn_activity', function () {
        var udc_data_a_iid = $(this).attr('udc_data_Idd');
        var udc_data_activity = $(this).attr('data_activity');
        $.ajax({
           url: 'main/udc_data_activity',
           method: 'POST',
           data: {
            udc_data_a_iid: udc_data_a_iid,
            udc_data_activity: udc_data_activity
           },
           success:function(){
                var user_IDD = $('.selectUser').val();
                entry_list_data(user_IDD);
           }
        })
    });

</script>