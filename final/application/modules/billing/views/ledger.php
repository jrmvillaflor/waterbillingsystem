
<div class="card">
    <div class="card-body">
        <div class="row my-1">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-5">
                        <input type="hidden" value="<?php echo $infos[0]->customer_account_id?>" id="cust-id">
                        <select class="form-control float-left" id="type-code">
                            <?php foreach($accounts as $account):?>
                                <option value="<?php echo $account->account_type_code?>"><?php echo $account->account_type_desc?></option>        
                            <?php endforeach;?>
                        </select>
                    </div>
                    <!-- <div class="col-md-1">
                        <button class="btn btn-primary">Meter</button>
                    </div> -->
                </div> 
            </div>
            <div class="col-md-6 ">
                <a class="float-right" href="<?php echo base_url("billing/newAccount/").$infos[0]->customer_id;?>">
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
                        <tbody class="tbody-light" id="ledgerBody">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    // console.log($('select#type-code').val());

    function getLedger(code){

        data = {
            custId: $('#cust-id').val(),
            type_code: code, 
        }

        console.log(data);

        $.ajax({
            type:"POST",
            data: data,
            url:'<?php echo base_url('billing/getLedger');?>',
            success: function(datas){
                $("#ledgerBody").html(datas);
            },
            error: function(data){
                alert(data.responseText);
                // console.log(data);
                alert("Operation Failed");
            }
        });
    }

    $( function() {
        
        getLedger($('select#type-code').val());
    });
</script>