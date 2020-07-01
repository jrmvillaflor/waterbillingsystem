<div class="card">
    <div class="card-body">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url("admin/employeelist")?>">Active Employees</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="<?php echo base_url("admin/pendingEmployees")?>">Pending Employees</a>
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
                        <th>status</th>                                     
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($employees as $emp):?>
                        <tr>
                            <td><?php echo $emp->accId?></td>
                            <td><?php echo $emp->email?></td>
                            <td><?php echo $emp->password?></td>
                            <td><?php echo $emp->user_type_desc?></td>
                            <td><button emp-email="<?php echo $emp->email?>" emp-id="<?php echo $emp->accId?>" onclick="approve(this)" class="btn btn-success">approve</button></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>    
    </div>

    </div>
</div>


<div class="modal fade" id="appModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            
            </div>
            <div class="modal-body" >
                <p id="message">
                    
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnClose">Close</button>
                <button type="button" class="btn btn-primary" id="save">Okay</button>
            </div>
        </div>
    </div>
</div>

<script>

    let id;

    function approve(btn){
        id = $(btn).attr("emp-id");
        email = $(btn).attr("emp-email");

        // console.log(email);
        // console.log(id);

        $("#appModal").modal();
        $("#message").text("Do you to approve "+ email +"?");
    }

    $("#save").on("click", function(){

        var details = {
            id: id,
            stat: 1,
        };

        $.ajax({
            type:"POST",
            data:details,
            url:'<?php echo base_url('admin/verify');?>',
            success: function(datas){
                // var data = $.parseJSON(datas);
                $("#appModal").modal("hide");
                alert(datas);
                
            },
            error: function(){
                alert("Operation Failed");
            }
        });

    })
</script>