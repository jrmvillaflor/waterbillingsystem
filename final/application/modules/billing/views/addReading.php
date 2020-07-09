<div class="card">
    <div class="card-body">
        
        <div class="card">
            <form action="<?php echo base_url('billing/addReading/').$accounts[0]->customer_account_id;?>" method="POST">
                <div class="card-header ">
                    <strong>Reading</strong> 
                </div>
                <div class="card-body ">
                    <div class="form-group ">
                        <input type="hidden" name="" id="accountID" value="">
                        <label for="readVal">Account Type</label>
                        <select name="type" id="typeID" class="form-control">
                            <?php foreach($accounts as $account):?>
                                <option value="<?php echo $account->customer_account_id?>"><?php echo $account->account_type_desc?></option>
                            <?php endforeach;?>
                        </select>
                        <span class=""></span>
                    </div>
                    <div class="form-group ">
                        <label for="readVal">Reading Value</label>
                        <input type="text"  name="readVal" class="form-control " placeholder="">
                        <span class="text-danger"><?php echo form_error('readVal');?></span>
                    </div>
                    <div class="form-group ">
                        <label for="DOR">Date of Reading</label>
                        <input type="date" id="datepicker" name="DOR" class="form-control " placeholder="">
                        <span class="text-danger"><?php echo form_error('DOR');?></span>
                    </div>
                </div>
                <div class="card-footer ">
                    <button type="submit " class="btn btn-sm btn-primary "><i class="fa fa-dot-circle-o "></i> Submit</button>
                </div>
            </form>
        </div>
    
        
    </div>
</div>


<script>
    $("#datepicker").datepicker({
        dateFormat : "yy-mm-dd"
    });

    

    
</script>