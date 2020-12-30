<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 ">
            <div class="card my-3 text-center">
                <div class="card-header  bg-info">
                    <div class="card-title">Search Data</div>
                </div>
                <?php  
                    $v = 10;
                    if($v == 10) {
                        echo 'test passed';
                    } else {
                        echo 'test failed';
                    }
                
                ?>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-row">
                            <div class="col-6">
                                <label for="district">Distict Name</label>
                                <input type="text" name="district" id="district" class="form-group">
                            </div>
                            <div class="col-6">
                                <label for="union">Union Name</label>
                                <input type="text" name="district" id="district" class="form-group">
                            </div>
                        </div>
                    </form> <!-- end of form -->
                </div>
            </div>
        </div>
    </div>
</div>