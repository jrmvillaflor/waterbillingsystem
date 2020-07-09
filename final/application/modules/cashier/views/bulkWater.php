<div class="card">
    <div class="card-body">
        <div class="col-md-12">
            <h1>Bulk Water</h1>
        </div>
        <div class="row mt-5 mx-2 justify-content-end">

            <div class="col-md-2">
                <button class="btn btn-primary form-control" id="addBulk">Add</button>
            </div>  
        </div>
        <div class="row mt-2 mx-2">

            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Cubic Meter</th>
                        <th>Amount</th>
                        <th width='150'>Edit</th>
                    </tr>
                </thead>
                <tbody class="tbody-light" id="bulkBody">
                
                </tbody>
            </table>
        </div>
    </div>
</div>





<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <strong>Edit Payment</strong>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" id="edit_id">
                            <label for="">Company Name</label>
                            <input type="text" class="form-control" id="edit_name" placeholder="Company Name..." >
                        </div>  
                
                    </div>
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label for="">Cubic Meter</label>
                            <input type="text" class="form-control" id="edit_cubic" placeholder="Cubic Meter..." >
                        </div>  
                    
                    </div>

                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label for="">Amount</label>
                            <input type="text" class="form-control" id="edit_amount" placeholder="Cubic Meter..." >
                        </div>  
                    
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnClose">Close</button>
                <button type="button" class="btn btn-primary" id="editBulk">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <strong>Bulk Water Payment</strong>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Company Name</label>
                            <input type="text" class="form-control" id="bulk_name" placeholder="Company Name..." >
                        </div>  
                
                    </div>
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label for="">Cubic Meter</label>
                            <input type="text" class="form-control" id="bulk_cubic" placeholder="Cubic Meter..." >
                        </div>  
                    
                    </div>

                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label for="">Amount</label>
                            <input type="text" class="form-control" id="bulk_amount" placeholder="Amount..." >
                        </div>  
                    
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnClose">Close</button>
                <button type="button" class="btn btn-primary" id="saveBulk">Save changes</button>
            </div>
        </div>
    </div>
</div>



<script>


    $( function() {
        
        getData();
    });

    $("#addBulk").on("click",function(){
        $("#showModal").modal();
    })

    function showEdit(btn){

        $("#editModal").modal();
        $("#edit_id").val($(btn).attr("bulk-id"));
        $("#edit_name").val($(btn).attr("bulk-name"));
        $("#edit_cubic").val($(btn).attr("bulk-cubic"));
        $("#edit_amount").val($(btn).attr("bulk-amount"));
    }

    $("#editBulk").on("click", function(){

        data= {

            bulk_id: $("#edit_id").val(),
            bulk_name: $("#edit_name").val(),
            bulk_cubic: $("#edit_cubic").val(),
            bulk_amount: $("#edit_amount").val(),
        }

        console.log(data);
        $.ajax({
            type:"POST",
            data: data,
            url:'<?php echo base_url('cashier/editBulk');?>',
            success: function(datas){
                var data = $.parseJSON(datas);
                
                alert(data.msg);
                // console.log(datas);
                location.reload();
                
            },
            error: function(data){
                alert(data.responseText);
                // console.log(data);
                alert("Operation Failed");
            }
        });
    })

    function getData(){
        $.ajax({
            type:"GET",
            url:'<?php echo base_url('cashier/getBulk');?>',
            success: function(datas){
                // var data = $.parseJSON(datas);
                
                console.log(datas);
                $("#bulkBody").html(datas);
                // location.reload();
                
            },
            error: function(data){
                alert(data.responseText);
                // console.log(data);
                alert("Operation Failed");
            }
        });

    }

    //save Data
    $("#saveBulk").on("click",function(){
        var name = $("#bulk_name").val();
        var cubic = $("#bulk_cubic").val();
        var amount = $("#bulk_amount").val();


        data = {
            bulk_name: name,
            bulk_cubic: cubic,
            bulk_amount: amount
        }

        // data = {
        //     bulk_name: bulk_name,
        //     bulk_cubic: bulk_cubic
        // };
        console.log(data);

        $.ajax({
            type:"POST",
            data: data,
            url:'<?php echo base_url('cashier/saveBulk');?>',
            success: function(datas){
                var data = $.parseJSON(datas);
                
                alert(data.msg);
                location.reload();
                
            },
            error: function(data){
                alert(data.responseText);
                // console.log(data);
                alert("Operation Failed");
            }
        });
    })



</script>

