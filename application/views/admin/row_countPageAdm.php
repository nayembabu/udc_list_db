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

        </div>
    </div>
</div>







<script>
    $('.selectUser').change(function(){
        var userId = $(this).val();
        get_user_entry_data(userId);
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
           }
        });
    }

</script>