
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
                                        <button class="btn btn-success" OR="<?php echo $payment->OR_number?>" p-type="<?php echo $payment->payment_type_desc?>" p-amount="<?php echo $payment->amount?>" p-date="<?php echo $payment->payment_date?>" onclick="showModal(this)">Edit</button>
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


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" id="due_id">
                        <div class="form-group">
                            <label for="">OR Number</label>
                            <input type="text" name="" class="form-control" id="or-num">
                        </div>  
                
                    </div>
                    <!-- <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Type of Payment</label>
                            <input type="text" name="" class="form-control" id="p-type">
                        </div>  
                
                    </div> -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Amount</label>
                            <input type="text" name="" class="form-control" id="p-amount">
                        </div>  
                
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="text" name="" class="form-control" id="pdate">
                        </div>  
                
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnClose">Close</button>
                <button type="button" class="btn btn-primary" id="saveEdit">Save changes</button>
            </div>
        </div>
    </div>
</div>


<script>

    $( function() {
        $( "#pdate" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });

    function showModal(btn){
        $("#editModal").modal();
        $("#or-num").val( $(btn).attr("OR"));
        $("#p-type").val( $(btn).attr("p-type"));
        $("#p-amount").val( $(btn).attr("p-amount"));
        $("#pdate").val( $(btn).attr("p-date"));
  
    }


    $("#saveEdit").on("click", function(){
        var or_num = $("#or-num").val();
        var p_type = $("#p-type").val();
        var p_amount = $("#p-amount").val();
        var p_date = $("#pdate").val();

        data = {
            or_num: or_num,
            p_amount: p_amount,
            p_date: p_date,

        }

        $.ajax({
            type:"POST",
            data:data,
            url:'<?php echo base_url('cashier/updateOr');?>',
            success: function(datas){
                var data = $.parseJSON(datas);
                
                alert(data.msg);
                location.reload();
                
            },
            error: function(data){
                alert(data.responseText);
                // console.log(data);
                // alert("Operation Failed");
            }
        });

    })
</script>
