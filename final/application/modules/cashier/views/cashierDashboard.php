
<div class="card">
    <div class="card-body">
        <!-- search -->
        <div class="input-group ">
            <input id="search" type="text" class="form-control" placeholder="Search... ">
            <span class="input-group-append ">
            <button type="button " class="btn btn-primary">Search</button>
            </span>
        </div>

        <!-- table -->
        
        <div class="row mt-5 mx-3">
            <table class="table table-stripe table-bordered" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" width=250>Customer Account Number</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Account Type</th>
                        <th scope="col">Status</th>
                        <th scope="col" width=300>Action</th>  
                    </tr>
                </thead>
                <tbody class="tbody-light" id="customerList">
                    <?php if($customers != null ):?>
                        <?php foreach($customers as $customer):?>
                            <tr id="trbody">
                                <td class='td' id='id'><?php echo $customer->customer_account_id?></td>
                                <td class='td'><?php echo $customer->first_name?></td>
                                <td class='td'><?php echo $customer->last_name?></td>
                                <td><?php echo $customer->account_type_desc?></td>
                                <td class='td'><?php echo $customer->account_status_desc?></td>
                                <td>
                                    <a href="<?php echo base_url('cashier/history').'/'.$customer->customer_account_id?>" class="btn btn-success">Payment History</a>
                                    <a href="<?php echo base_url('cashier/payment').'/'.$customer->customer_account_id?>" class="btn btn-info text-white">Add Payment</a>
                                </td>
                            </tr>
                        <?php endforeach;?>

                    <?php else:?>
                        <tr>
                            <td colspan="6" class="text-center">
                                <div class=" mx-auto" data-text=""><img src="<?php echo base_url('assets/images/undraw_no_data_qbuo.svg');?>" width="100"></div>
                                <p class="lead text-gray-800 mb-5">No Found Data</p>
                                <p class="text-gray-500 mb-0">It looks no data has been recorded.</p>
                            </td>
                        </tr>

                    <?php endif?>
                </tbody>
            </table>
        </div>
        <!-- <?php if($customers == null):?>
            <div class="text-center">
                
            </div>
        <?php endif;?> -->

    </div>
</div>


<script>

    $(document).ready(function(){
        
        // search code
        $("input#search").keyup(function() {
            //search value
            var searchVal = $("input#search").val().toUpperCase();
            //get the data of all Table row
            var tr = $("#table tr#trbody ");
            
            
            $.each(tr, function(i, value){
                
                var data = value.innerText.toUpperCase();

                if(data.includes(searchVal)){
                    $(this).closest("tr#trbody").show();
                }else{
                    $(this).closest("tr#trbody").hide(); 
                }
            })
        }); 
    });

    

</script>
