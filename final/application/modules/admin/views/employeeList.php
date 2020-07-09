<div class="card">
    <div class="card-body">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="<?php echo base_url("admin/employeelist")?>">Active Employees</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url("admin/pendingEmployees")?>">Pending Employees</a>
        </li>

    </ul>

    <div class="row">
        <div class="col-md-12 mt-5">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Account Number</th>                   
                        <th>Email</th>                   
                        <th>Password</th>                   
                        <th>Position</th> 
                        <th>Manage</th>                                   
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($employees as $emp):?>
                        <!-- <tr style="cursor:pointer" onclick="document.location='<?php echo base_url('admin/employeeDetails/').$emp->accId?>'"> -->
                        <tr>
                            <td><a href="<?php echo base_url('admin/employeeDetails/').$emp->accId?>"><?php echo $emp->accId?></a></td>
                            <td><?php echo $emp->email?></td>
                            <td><?php echo $emp->password?></td>
                            <td><?php echo $emp->user_type_desc?></td>
                            <td>
                                <button class="btn btn-danger" emp-id="<?php echo $emp->accId?>" emp-email="<?php echo $emp->email?>" onclick="showDelete(this)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
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

    let accID;
    
    function showDelete(btn){
        $("#deleteModal").modal();
        accID = $(btn).attr("emp-id");
        var email = $(btn).attr("emp-email");
        $("#mess").text("Do you really want to delete "+ email +" ?")
    }

    $("#doDelete").on('click', function(){

    $("#deleteModal").modal("hide");
        data = {
            acc_id: accID,
            emp_id: accID+"-emp"
        }

        console.log(data);

        $.ajax({
            type:"POST",
            data: data,
            url:'<?php echo base_url('admin/deleteEmp');?>',
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