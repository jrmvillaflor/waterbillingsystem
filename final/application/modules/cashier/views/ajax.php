<div class="card">
    <div class="card-body">
        
        <table class="table table-stripe table-bordered" id="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" width=250>Customer Account Number</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Status</th>
                    <th scope="col" width=300>Action</th>  
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

        <div id='mydiv'></div>
        <button class="btn btn-info text-white" id='btnAjax'>Ajax</button>
    </div>
</div>


<script>
    $(document).ready(function(){


        $("button#btnAjax").on('click', function(){
            $.ajax({
                type:"POST",
                url:'<?php echo base_url('cashier/sampleAjax');?>',
                success: function(datas){
                    
                    var data = $.parseJSON(datas);

                    $.each(data, function(i, value){
                        var custid = value.customer_account_id;
                        var fname = value.first_name;
                        var lname = value.last_name;
                        var status = value.account_status_desc;

                        $("table#table tbody").append('<tr><td>'+ custid +'</td><td>'+ fname +'</td><td>'+ lname +'</td><td>'+ status +'</td><td><a href="" class="btn btn-success">Payment History</a> <a href="" class="btn btn-info text-white">Add Payment</a></td></tr>');

                    })
                },
                error: function(){
                    alert("nag error");
                }
            });
        });
        
    });
</script>


