
<?php
    if (empty($get_user_payment)) {
        $get_user_payment = 0;
    }
    $total_entrys = count($get_user_payment);
    $total_unPay = $total_entrys - $pay_count;
?>




<div class="container">
    <div class="row">       
        <div class="col-sm-7 mx-auto my-3">
            <table class="table data_history_table">
                <tr>
                    <th scope="col"> Total Entry </th>
                    <th scope="col"> Total Payment </th>
                    <th scope="col"> Total Unpaid </th>
                </tr>
                <tr>
                    <td> <?php echo $total_entrys; ?> </td>
                    <td> <?php echo $pay_count; ?> </td>
                    <td> <?php echo $total_unPay; ?> </td>
                </tr>
            </table>
        </div>
    </div>
</div>