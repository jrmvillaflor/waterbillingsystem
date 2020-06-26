<form method="POST" action="<?php echo base_url('billing/application');?>">   
    <div class="card">
        <div class="card-body">       
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Customer Info</strong>

                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="FirstName">First Name</label>
                                <input type="text" class="form-control" placeholder="Enter your First Name" name="firstname">
                            </div>

                            <div class="form-group">
                                <label for="LastName">Last Name</label>
                                <input type="text" class="form-control" id="vat" placeholder="Enter your Last Name" name="lastname">
                            </div>

                            <div class="form-group">
                                <label for="contact">Contact Number</label>
                                <input type="text" class="form-control" id="street" placeholder="Enter your Contact Number" name="contact">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Account</strong>

                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Street">Street</label>
                                <input type="text" class="form-control" placeholder="Enter your Street/Purok" name="street">
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
                                <label>Municipality</label>
                                <input type="text" class="form-control" id="street" placeholder="Enter Municipality name" name="municipality">
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
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        <div class="card-footer ">
            <button type="submit " class="btn btn-sm btn-primary "><i class="fa fa-dot-circle-o "></i> Submit</button>
        </div>
    </div>
</form>