<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs">

            <li class="nav-item">
                <a class="nav-link " href="<?php echo base_url("admin/addHoliday")?>">Holiday</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo base_url("admin/addDue")?>">Due Dates</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("admin/cubicRate")?>">Cubic Range And Rates</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("admin/addCustomer")?>">Add Customer</a>
            </li>
        </ul>

        <div class="row mt-4">
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
        </div>

   
        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>days</th>
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
            
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" id="due_id">
                        <div class="form-group">
                            <label for="">Due Name</label>
                            <strong><p id="edit_name"></p></strong>
                        </div>  
                
                    </div>
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label for="">Days</label>
                            <input type="text" class="form-control" id="edit_days" placeholder="Name of Holiday" >
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

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            
            </div>
            <div class="modal-body text-center" >
                <p id="mess" class="h5"></p>
                <small class="text-danger">Note: Doing this Action will PEMANENTLY delete the data</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnClose">Close</button>
                <button type="button" class="btn btn-danger" id="doDelete">Delete</button>
            </div>
        </div>
    </div>
</div>



<script>
    let dueID;

    $( function() {
        
        getDueDays();
    });


    function getDueDays(){
        $.ajax({
            type:"GET",
            url:'<?php echo base_url('admin/getDue');?>',
            success: function(datas){
                var data = $.parseJSON(datas);

                $.each(data, function(i, value){

                    $("table tbody").append("<tr><td>"+ value.due_desc +"</td><td>"+ value.due_days +"</td><td ><button class='btn btn-primary' due-id='"+value.due_id+"' due-name='"+value.due_desc+"' due-date='"+value.due_days+"' onclick='showEdit(this)'>Edit</button> <button class='btn btn-danger' due-id='"+value.due_id+"' due-name='"+value.due_desc+"' onclick='showDelete(this)'>Delete</button></td></tr>");
                })

                
            },
            error: function(){
                alert("Operation Failed");
            }
        });
    }


    $("#saveDue").on("click", function(){
        
        data = {
            due_desc: $("#due_name").val(),
            due_days: $("#days").val()
        };

        console.log(data);
        $.ajax({
            type:"POST",
            data:data,
            url:'<?php echo base_url('admin/saveDue');?>',
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

    });

    function showEdit(btn){
        $("#editModal").modal()

        $("#due_id").val($(btn).attr("due-id"));
        $("#edit_name").text($(btn).attr("due-name"));
        $("#edit_days").val($(btn).attr("due-date"));

        console.log($("#due_name").val($(btn).attr("due-name")));    
    }


    $("#saveEdit").on("click", function(){
        $("#editModal").modal("hide");
        data = {
            due_id: $("#due_id").val(),
            due_days: $("#edit_days").val()
        };

        console.log(data);
        $.ajax({
            type:"POST",
            data:data,
            url:"<?php echo base_url('admin/updateDue');?>",
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

    function showDelete(btn){
        $("#deleteModal").modal();
        dueID = $(btn).attr("due-id");
        var name = $(btn).attr("due-name");
        $("#mess").text("Do you really want to delete "+ name +"?")
    }

    $("#doDelete").on('click', function(){

        $("#deleteModal").modal("hide");
        data = {
            due_id: dueID
        }

        console.log(data);
        
        $.ajax({
            type:"POST",
            data: data,
            url:'<?php echo base_url('admin/deleteDue');?>',
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