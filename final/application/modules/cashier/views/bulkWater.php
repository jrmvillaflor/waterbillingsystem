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
                        <!-- <th width='150'>Edit</th> -->
                    </tr>
                </thead>
                <tbody class="tbody-light" id="bulkBody">
                
                </tbody>
            </table>
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

        data = {
            bulk_name: name,
            bulk_cubic: cubic
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

