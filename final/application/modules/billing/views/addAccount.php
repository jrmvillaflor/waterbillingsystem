
<div class="card ">
    <div class="card-body ">
        <div class="col-sm-10 offset-1">

            <div class="card">
                <div class="card-header">
                    <strong>Account Form</strong>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo base_url('billing/newAccount/').$id ?>">
                        <div class="form-group">
                            <label>Street</label>
                            <input type="text" name="street" class="form-control" placeholder="Enter your Street">
                        </div>

                        <div class="form-group">
                            <label>Barangay</label>
                            <select name="barangay" class="form-control">
                                <?php if($barangays != null):?>
                                    <?php foreach($barangays as $barangay):?>
                                        <option value="<?php echo $barangay->brgy_id?>"><?php echo $barangay->brgy_name?></option>
                                    <?php endforeach;?>
                                <?php else: ?>
                                    <option value="">No Available Option</option>
                                <?php endif;?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="municipality">Municipality</label>
                            <input type="text" class="form-control" name="municipality" placeholder="Enter Municipality">
                        </div>


                        <div class="form-group">
                            <label>Account Type</label>
                            <select name="type" class="form-control">
                                <?php if($types != null):?>
                                    <?php foreach($types as $type):?>
                                        <option value="<?php echo $type->account_type_code?>"><?php echo $type->account_type_desc?></option>
                                    <?php endforeach;?>
                                <?php else: ?>
                                    <option value="">No Available Option</option>
                                <?php endif;?>
                            </select>
                        </div> 
                        
                        <div class="form-group">
                            <input type="Submit" class="btn btn-primary" value="Submit">
                        </div>
                    
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
