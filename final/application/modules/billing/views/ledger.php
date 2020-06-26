
<div class="card">
    <div class="card-body">
        <div class="row my-1">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-5">
                        <select class="form-control">
                            <?php foreach($accounts as $account):?>
                                <option value=""><?php echo $account->account_type_desc?></option>        
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary">Meter</button>
                    </div>
                </div> 
            </div>
            <div class="col-md-6">
                <a class="" href="<?php echo base_url("billing/newAccount/").$infos[0]->customer_id;?>">
                    <span style="color: gray;">NEW ACCOUNT</span>
                </a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Basic Information</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php if($infos != null): ?>
                                <?php foreach($infos as $info):?>
                                    
                                    <div class="col-md-6">
                                        <h5>Name: <strong><?php echo $info->last_name.', '.$info->first_name?></strong></h5>
                                        <h5>Address: <strong><?php echo $info->street_building.', '.$info->brgy_name.', '.$info->municipality?></strong></h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Account Number: <strong><?php echo $info->customer_account_id?></strong></h5>
                                        <h5>Contact: <strong><?php echo $info->contactNo?></strong></h5>
                                    </div>
                                    <?php break?>
                                <?php endforeach?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th>Month</th>
                                <th>Present Reading</th>
                                <th>Previous Reading</th>
                                <th>Consumed</th>
                                <th>Bill</th>
                                <th>Overdue</th>
                                <th >Penalty<br>(<?php echo $pen = ($OP[0]->op_value * 100).'%';?>)</th>
                                <th>Total Amount</th>
                                <th>Date of Payment</th>
                                <th>O.R. Number</th>
                                <th>Amount Paid</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody class="tbody-light">
                            <?php if($records != null):?>
                                <?php foreach($records as $i => $record):?>
                                    <?php if($i == 0):?>
                                        <?php $prevReading = $record->reading_value?>
                                        <?php $balance =0;?>
                                    <?php else:?>
                                        <tr class="text-center">
                                            <td><?php echo nice_date($record->date_of_reading, 'M-Y');?></td>
                                            <td><?php echo $record->reading_value;?></td>
                                            <td><?php echo $prevReading;?></td>
                                            <td><?php echo $record->reading_value - $prevReading?></td>
                                            <td><?php echo $bill[$i-1]?></td>
                                            <td>
                                                <?php if($balance == 0):?>
                                                    ------------
                                                    <?php $overdue=0;?>
                                                <?php else:?>
                                                    <?php  
                                                    echo $overdue = round($balance,2);
                                                    
                                                    ?>
                                                <?php endif?>
                                            </td>
                                            <td>
                                                <?php if($overdue == 0):?>
                                                    ------------
                                                    <?php $penalty = 0;?>
                                                <?php else:?>
                                                    <?php 
                                        
                                                        echo $penalty = round($overdue * $OP[0]->op_value,2);
                                                    ?>
                                                <?php endif?> 
                                            </td>
                                            <td> 
                                                <?php 
                                                    
                                                    echo $total = round($bill[$i-1]+$overdue+ $penalty,2);
                                                ?>
                                            </td>
                                            <?php if($payments != null):?>
                                                <?php $k = count($payments)-1; $ammount = 0;?>
                                                <?php foreach($payments as $key => $payment):?>
                                                    <?php if($payment->date_of_reading == $record->date_of_reading):?>
                                                        <td><?php echo $payment->payment_date?></td>
                                                        <td><?php echo $payment->OR_number?></td>
                                                        <td><?php echo $amount = $payment->amount?></td>
                                                        <?php break;?>
                                                    <?php else: ?>
                                                        <?php if($k == $key):?>
                                                            <td>------------</td>
                                                            <td>------------</td>
                                                            <td>------------</td>
                                                            <?php $amount = 0?>
                                                        <?php endif;?>
                                                    <?php endif;?>
                                                <?php endforeach;?>
                                            <?php else:?>
                                                <td>------------</td>
                                                <td>------------</td>
                                                <td>------------</td>
                                                <?php $amount = 0?>
                                            <?php endif;?>
                                            <td>
                                                <?php 
                                                    echo $balance = round($total - $amount, 2);
                                                ?>
                                            </td>
                                        </tr>
                                        <?php $prevReading = $record->reading_value?>
                                    <?php endif;?>
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php if($records == null):?>
            <div class="text-center">
                <div class=" mx-auto" data-text=""><img src="<?php echo base_url('assets/images/undraw_no_data_qbuo.svg');?>" width="100"></div>
                <p class="lead text-gray-800 mb-5">No Found Data</p>
                <p class="text-gray-500 mb-0">It looks no data has been recorded.</p>
            </div>
        <?php endif;?>
    </div>
</div>
