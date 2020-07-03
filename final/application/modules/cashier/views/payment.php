<div class="card">
    <div class="card-body">

        <!-- <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-header">
                    <strong>Bill</strong><br>
                    <?php echo $accountStatus?>
                </div>
                <div class="card-body">
                    
                    <table class="table table-stripe table-bordered">
                        <?php if($status == 'Deactivate'):?>
                            <thead class="thead-dark">
                                <tr>
                                    <th>Application Fee</th>
                                    <th>Advance Payments</th>
                                    <th>Connection Fee</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="tbody-light">
                                <?php if($fees != null):?>
                                    <?php foreach($fees as $fee):?>
                                        <tr>
                                            <td><?php echo $app_fee = $fee->application_fee ?></td>
                                            <td><?php echo $adv_fee = $fee->advance_payments ?></td>
                                            <td><?php echo $conn_fee = $fee->connection_fee ?></td>
                                            <td><?php echo $app_fee + $adv_fee + $conn_fee?></td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        <?php endif;?>
                        <?php if($status == 'Active'):?>
                             <thead>
                             </thead>
                                <tbody id="tableaccounts">

                                    <tr>
                                      <td colspan="4" class="label-bill">ACCOUNT NUMBER 
                                        <span class="text-gray pl-2">
                                            <strong><?php echo $infos[0]->customer_account_id ?></strong>
                                        </span>
                                      </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"class="label-bill text-center">READINGS</td>
                                        <td class="label-bill">Cubic Meter</td>
                                        <td rowspan="2" class="label-bill text-center">AMOUNT
                                        <br>(PESOS)</td>
                                    </tr>
                                    <tr>
                                        <td class="label-bill">PRESENT</td>
                                        <td class="label-bill">PREVIOUS</td>
                                        <td class="label-bill">CONSUMED</td>
                                    </tr>
                                    <tr>
                                        
                                        <?php foreach($readings as $i => $reading):?>
                                            <?php if($i == 0):?>
                                               <td class="text-gray"><?php echo $pres = $reading->reading_value?></td>                                             
                                            <?php else:?>
                                               <td class="text-gray"><?php echo $prev = $reading->reading_value?></td>                                                
                                                
                                            <?php endif;?>
                                        <?php endforeach;?>
                                        <td class="text-gray"><?php echo $pres - $prev?></td>
                                        <td class="text-gray"><?php echo $bill?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="label-bill">ARREARS</td>
                                        <td class="text-gray"><?php echo $arrears?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="label-bill">AMOUNT DUE UNTIL DUE DATE</td>
                                        <td class="text-gray"><?php echo $total = $bill + $arrears?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                    </tr>
                                    

                                    <tr>
                                        <td class="label-bill">READING DATE</td>
                                        <td class="label-bill">DUE DATE</td>
                                        <td class="label-bill">AMOUNT DUE AFTER DUE DATE</td>
                                        <td class="label-bill">FOR THE MONTH OF</td>
                                    </tr>
                                    <tr>
                                        <td class="text-gray"><?php echo nice_date($date, 'M-d')?></td>
                                        <td class="text-gray"><?php echo nice_date($due_date, 'M-d-Y')?></td>
                                        <td class="text-gray"><?php echo $total += round($total * $OP[0]->op_value,2);?></td>
                                        <td class="text-gray"><?php echo nice_date($date, 'M-Y');?></td>
                                    </tr>
                                </tbody>
                          
                        <?php endif;?>



                    </table>
                    
                </div>
            </div>
        </div> -->

        <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-header">
                    <strong>Payment Form</strong>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo base_url('cashier/payment/').$infos[0]->customer_account_id;?>">
                        <div class="form-group">
                            <label for="ORnumber">O.R. Number</label>
                            <input type="text" class="form-control" placeholder="" name="ORnumber" value="<?php echo set_value('ORnumber');?>">
                            <span class="text-danger"><?php echo form_error('ORnumber'); ?></span>
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" placeholder="" name="amount" value="<?php echo set_value('amount');?>">
                            <span class="text-danger"><?php echo form_error('amount'); ?></span>
                        </div>

                        <div class="form-group">
                            <label for="DOP">Date of Payment</label>
                            <input type="text" id="paymentDate" class="form-control" id="street" placeholder="date" name="DOP" value="<?php echo set_value('DOP');?>">
                            <span class="text-danger"><?php echo form_error('DOP'); ?></span>
                        </div>


                        <div class="form-group">
                            <label for="method">Payment Method</label>
                            <select name="method" class="form-control">
                                <?php if($methods != null):?>
                                    <?php foreach($methods as $method):?>
                                        <option value="<?php echo $method->payment_method_id?>"><?php echo $method->payment_method_desc?></option>
                                    <?php endforeach;?>
                                <?php else:?>
                                    <option value="">No Avaible Option</option>
                                <?php endif;?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="type">Payment Type</label>
                            <select name="type" id="sel" class="form-control">
                                <?php if($types != null):?>
                                    <?php foreach($types as $type):?>
                                        <option value="<?php echo $type->payment_type_id?>"><?php echo $type->payment_type_desc?></option>
                                    <?php endforeach;?>
                                <?php else:?>
                                    <option value="">No Avaible Option</option>
                                <?php endif;?>
                            </select>
                        </div>

                        <div class="form-group" id="monthly" style='display:none'> 
                            <label for="month">Year and Month of Reading</label>
                            <input type="text" id="yearMonth" placeholder="ex. 2020-06" class="form-control" placeholder="" name="month" value="<?php echo set_value('month');?>" >   
                        </div>
                        <span class="text-danger"><?php echo form_error('month'); ?></span>
                        
                        <div class="form-group">
                            <input type="Submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // function show(){

    //     var select = document.getElementById('sel').value;

    //     if(select == 22){
            
    //         document.getElementById("monthly").style.display = "block"
    //     }
    //     else{
    //         document.getElementById("monthly").style.display = "none"
    //     }
    // }

    $("select#sel").change(function(){
        var select = $("select#sel").val();
        
        if(select == 22){  
            $("#monthly").show();
        }
        else{
            $("#monthly").hide();
        }
    });


    $("#yearMonth").datepicker({
        dateFormat : "yy-mm"
    });

    $("#paymentDate").datepicker({
        dateFormat : "yy-mm-dd"
    });

    

</script>
