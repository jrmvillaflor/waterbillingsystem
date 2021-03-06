
<div class="card">
    <div class="card-body">
        <div class="input-group ">
            <input type="text" class="form-control" placeholder="Search... ">
            <span class="input-group-append ">
            <button type="button " class="btn btn-primary">Search</button>
            </span>
        </div>

        <div class="row mt-5 mx-3">
            <table class="table table-stripe table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" width="150">Customer Number</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col" width="200">Address</th>
                        <th scope="col" width="150">Account Type</th>
                        <th scope="col">Action</th> 
                    </tr>
                </thead>
                <tbody class="tbody-light">
                    <?php if($accounts != null):?>
                        <?php foreach($accounts as $account):?>
                            <tr>
                                <td><?php echo $account->customer_id?></td>
                                <td><?php echo $account->first_name?></td>
                                <td><?php echo $account->last_name?></td>
                                <td><?php echo $account->street.', '.$account->brgy_name.', '.$account->municipality?></td>
                                <td><?php echo $account->account_type_desc?></td>
                                <td>
                                    <form method="POST" action="<?php echo base_url('accounts/accReview');?>">
                                        <input type="hidden" value='<?php echo $account->review_account_id ?>' name='id'>
                                        <select class="form-control" name='status' id="mySelect">
                                            <option value="2" >
                                            Approve 
                                            
                                            </option>
                                            <option value="3">
                                            Deny
                                            </option>
                                        </select>
                                        <!-- <input type="submit" name="btn" class="btn-primary btn form-control" value="OK" > -->
                                        <input type="submit" name="btn" class="btn-success btn form-control" value="OK">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach?>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
        <?php if($accounts == null):?>
            <div class="text-center">
                <div class=" mx-auto" data-text=""><img src="<?php echo base_url('assets/images/undraw_no_data_qbuo.svg');?>" width="100"></div>
                <p class="lead text-gray-800 mb-5">No Found Data</p>
                <p class="text-gray-500 mb-0">It looks no data has been recorded.</p>
            </div>
        <?php endif;?>
    </div>
</div>
