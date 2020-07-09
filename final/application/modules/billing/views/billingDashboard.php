<div class="card">
    <div class="card-body">
        <!-- search -->
        
        <div class="input-group ">
            <input type="text" class="form-control" placeholder="Search... " id="search">
            <span class="input-group-append ">
            <button type="button " class="btn btn-primary">Search</button>
            </span>
        </div>

        <!-- bulk action -->
        <!-- <div class="card mt-5 mx-3">
            <div class="card-header">
                <strong>Bulk action</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        
                        <a href="" class="btn btn-info text-white form-control">View All Bill</a>
                        <a href="" class="btn btn-danger form-control">Print All</a>
    
                    </div>
                    <div class="col-md-8">
                        <input type="checkbox" name="" id="checkAll">
                        <button class="btn btn-light border float-right" id="selAll">Select All</button>
                    </div>
                </div> 
            </div>
        </div> -->

        <!-- table -->
        <div class="row mx-3 mt-3">
            <table class="table table-stripe table-bordered" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" width=200>Account Number</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th>Status</th>
                        <th scope="col" width=320>
                            Action 
                            <!-- <span class="float-right"><input type="checkbox" name="select-all" id="select-all"></span> -->
                        </th>
                    </tr>
                </thead>
                <tbody class="tbody-light">
                    <?php if($customers != null):?>
                        <?php foreach($customers as $customer):?>
                            <tr id="trbody">
                                <th scope="row"><a href="<?php echo base_url('billing/ledger/').$customer->customer_account_id;?>"><?php echo $customer->customer_account_id?></a></th>
                                <td><?php echo $customer->first_name?></td>
                                <td><?php echo $customer->last_name?></td>
                                <td><?php echo $customer->account_status_desc?></td>
                                <td>
                                    <?php 
                                        $dis;
                                        switch ($customer->account_status_desc):
                                        case "Deactivate":
                                            $dis="disabled";
                                            break;
                                        case "Disconnected":
                                            $dis="disabled";
                                            break;
                                        case "For Disconnection":
                                            $dis="disabled";
                                            break; 
                                        case "For Reconnection":
                                            $dis="disabled";
                                            break;
                                        default:
                                            $dis="";
                                            break;
                                                
                                        endswitch;
                                        
                                    ?>
                                    <a href="<?php echo base_url('billing/AddReading/').$customer->customer_account_id;?>" class="btn btn-primary <?php echo $dis?>">Reading</a>
                                    <a href="<?php echo base_url('billing/readingHistory/').$customer->customer_account_id;?>" class="btn btn-success <?php echo ($customer->account_status_desc=="Deactivate"?$dis:'')?>">Reading History</a>
                                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" class="btn btn-secondary text-white ">View Bill</button> -->
                                    <a href="<?php echo base_url('billing/customerBill/').$customer->customer_account_id;?>" class="btn btn-danger <?php echo ($customer->account_status_desc=="Deactivate"?$dis:'')?>">View Bill</a>
                                    <!-- <input type="checkbox" name="checkbox-1" id="checkbox-1" class="float-right" /> -->
                                </td>
                            </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
        <?php if($customers == null):?>
        <div class="text-center">
            <div class=" mx-auto" data-text=""><img src="<?php echo base_url('assets/images/undraw_no_data_qbuo.svg');?>" width="100"></div>
            <p class="lead text-gray-800 mb-5">No Found Data</p>
            <p class="text-gray-500 mb-0">It looks no data has been recorded.</p>
        </div>
        <?php endif;?>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Choose Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row" >
                            <div class="col-md-6 text-center">
                                <a href="<?php echo base_url('billing/customerBill/').$customer->customer_id;?>" id="acc1">
                                    <div class="card bg-primary" >
                                        <div class="card-body">
                                            <h3>Account 1</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                    </div>
                
                </div>
            </div>
        </div>

        

    </div>
</div>





<script>
    
    $(document).ready(function(){

        $("a#view").attr("target","_blank");

        $("a#acc1").on('click', function(){
            $(this).attr("target","_blank");
        });

        $("button#selAll").on('click', function(){
          
            if (condition) {
                
            } else {
                
            }
        });

        $('input[id=checkAll]').change(function(){
            $('input:checkbox').prop('checked', $(this).prop('checked'));
        });

        // search code
        $("input#search").keyup(function() {
            //search value
            var searchVal = $("input#search").val().toUpperCase();
            //get the data of all Table row
            var tr = $("table#table tr ");
            
            $.each(tr, function(i, value){
                
                //set each value to data
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


