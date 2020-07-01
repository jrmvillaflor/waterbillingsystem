<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs">

            <li class="nav-item">
                <a class="nav-link " href="<?php echo base_url("admin/addHoliday")?>">Holiday</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("admin/addDue")?>">Due Dates</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo base_url("admin/cubicRate")?>">Cubic Range And Rates</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("admin/addCustomer")?>">Add Customer</a>
            </li>
        </ul>


        <!-- <div class="row mt-4">
            <div class="col-md-5">
                
                <div class="form-group">
                    <label for="">Due Name</label>
                    <input type="text" class="form-control" id="due_name" placeholder="Due Name" >
                </div>  
            
            </div>
            <div class="col-md-5">
                
                <div class="form-group">
                    <label for="">days</label>
                    <input type="text" class="form-control" id="days" placeholder="Days Of Due" >
                </div>  
            
            </div>
            <div class="col-md-2 m-auto">
                <div class="form-group">
                    <button class="btn btn-success form-control" id="saveDue">Save</button>
                </div>
                
            
            </div>
        </div> -->
        <div class="row mt-5">
            <div class="col-md-3">
                <select name="" class="form-control"id="type">
                    <?php foreach($types as $type):?>
                        <option value="<?php echo $type->account_type_desc?>"><?php echo $type->account_type_desc?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>From</th>
                            <th>To</th>
                            <th>Rates</th>
                            <th width='150'>Edit</th>
                            
                        </tr>
                    </thead>
                    <tbody class="tbody-light">
                    </tbody>
                </table>
            </div>
        </div>

        
    </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <strong id="type_desc"></strong>
            </div>
            <div class="modal-body" >
                <div class="row">
                        
                    <div class="col-md-12">
                        <input type="hidden" id="cubic_id">
                        <input type="hidden" id="type_code">
                        <div class="form-group">
                            <label for="">From</label>
                            <input type="text" class="form-control" id="edit_from" placeholder="Range From" >
                        </div>  
                    
                    </div>

                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label for="">To</label>
                            <input type="text" class="form-control" id="edit_to" placeholder="Range To" >
                        </div>  
                    
                    </div>
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="text" class="form-control" id="edit_price" placeholder="Name of Holiday" >
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
        // console.log();
        getCubicRates($("#type").val());
    });

    $("#type").on("change",function(){
        if(refresh()){
            getCubicRates($("#type").val());
        }
    });

    function refresh(){
        $("table tbody tr").remove();
        return true
    }

    function getCubicRates(type){
        
        data = {
            acc_type: type
        }
        console.log(data);
        $.ajax({
            type:"POST",
            data: data,
            url:'<?php echo base_url('admin/getCubicRates');?>',
            success: function(datas){
                var data = $.parseJSON(datas);
                // $("table tbody").remove();
                // console.log(datas);
                // alert("data is ready");
                $("table tbody tr").remove();
                $.each(data, function(i, value){    

                    $("table tbody").append("<tr><td>"+ value.cubic_range_from +"</td><td>"+ value.cubic_range_to +"</td><td>"+ value.account_type_price +"</td><td ><button class='btn btn-primary' cubic-id='"+ value.cubic_range_id +"' cubic-from='"+ value.cubic_range_from+"' cubic-to='"+ value.cubic_range_to +"' type-code='"+ value.account_type_code +"' cubic-price='"+ value.account_type_price +"' onclick='showEdit(this)'>Edit</button></td></tr>");
                })

                
            },
            error: function(){
                alert("Operation Failed");
            }
        });
    }

    function showEdit(btn){
        $("#editModal").modal()
        $("#type_desc").text($("#type").val());
        $("#cubic_id").val($(btn).attr("cubic-id"));
        $("#type-code").val($(btn).attr("type-code"));
        $("#edit_from").val($(btn).attr("cubic-from"));
        $("#edit_to").val($(btn).attr("cubic-to"));
        $("#edit_price").val($(btn).attr("cubic-price"));
    }

    $("#saveEdit").on("click", function(){
        $("#editModal").modal("hide");
        data = {
            cubic_id: $("#edit_id").val(),
            cubic_to: $("#edit_to").val(),
            cubic_from: $("#edit_from").val(),
            cubic_price: $("#edit_price").val(),
        };

        // console.log(data);
        $.ajax({
            type:"POST",
            data:data,
            url:"<?php echo base_url('admin/updateCubicRates');?>",
            success: function(datas){
                var data = $.parseJSON(datas);
                
                alert(data.msg);
                getCubicRates($("#type").val());
                
            },
            error: function(data){
                alert(data.responseText);
                // console.log(data);
                // alert("Operation Failed");
            }
        });
        
    })
</script>
