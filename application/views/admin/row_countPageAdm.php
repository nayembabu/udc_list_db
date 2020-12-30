<div class="container">
    <div class="row">
        <div class="col-sm-7 mx-auto my-3">
            <select name="" id="" class="form-control selectUser">
                <option value="">Select a User</option>
                <?php foreach($users as $user): ?>
                <option value="<?php echo $user->id; ?>"><?php echo $user->username; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

    </div>
</div>


<script>
    $('.selectUser').change(function(){
        var userId = $(this).val();
        $.ajax({
           url: 'main/getDataAsUser',
           method: 'POST',
           dataType:'json',
           data: {
               userid: userId
           },
           success:function(res){
            
           }
        });
    });

</script>