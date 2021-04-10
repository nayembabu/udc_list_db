
<div class="container">

    <table>
        <?php foreach ($all_udc as $udc) { ?>
            (<?php echo $udc->udc_list_auto_p_iidd; ?>,  '<?php echo $udc->un_name; ?>', '$2y$10$5Pa5qti1/F1HBM7TFg1CTOM0D3isiLh99v7i5IhxHXMCBVWy6Vhre', '<?php echo $udc->udc_email_no; ?>'),<br>
        <?php } ?>
    </table>

</div>

