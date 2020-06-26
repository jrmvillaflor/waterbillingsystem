
<div class="card">
    <div class="card-body">
        <!-- search -->
        <div class="input-group ">
            <input type="text" class="form-control" placeholder="Search... ">
            <span class="input-group-append ">
            <button type="button " class="btn btn-primary">Search</button>
            </span>
        </div>

        <div class="row my-4">
            <!-- basic info table -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Basic Information</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php foreach($infos as $info):?>    
                                <div class="col-md-6">
                                    <h5>Name: <strong><?php echo $info->last_name.', '.$info->first_name?></strong></h5>
                                    <h5>Address: <strong><?php echo $info->street_building.', '.$info->brgy_name.', '.$info->municipality?></strong></h5>
                                </div>
                                <div class="col-md-6">
                                    <h5>Contact Number: <strong><?php echo $info->contactNo?></strong></h5>
                                    <h5>Type: <strong><?php echo $info->account_type_desc?></strong></h5>
                                    
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- payment history -->
            <div class="col-md-12">
                <table class="table table-stripe table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">O.R. Number</th>
                            <th scope="col">Type of Payment</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>  
                        </tr>
                    </thead>
                    <tbody class="tbody-light">
                        <?php if($payments != null ):?>
                            <?php foreach($payments as $payment):?>
                                <tr>
                                    <th scope="row"><?php echo $payment->OR_number?></th>
                                    <td><?php echo $payment->payment_type_desc?></td>
                                    <td><?php echo $payment->amount?></td>
                                    <td><?php echo $payment->payment_date?></td>
                                    <td>
                                        <a href="#" class="btn btn-success">Update</a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        <?php endif?>
                    </tbody>
                </table>
                
                <?php if($payments == null):?>
                    <div class="text-center">
                        <div class=" mx-auto" data-text=""><img src="<?php echo base_url('assets/images/undraw_no_data_qbuo.svg');?>" width="100"></div>
                        <p class="lead text-gray-800 mb-5">No Found Data</p>
                        <p class="text-gray-500 mb-0">It looks no data has been recorded.</p>
                    </div>
                <?php endif;?>
                
            </div>
        </div>
    </div>
</div>
