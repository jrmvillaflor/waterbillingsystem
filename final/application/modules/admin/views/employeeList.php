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
                        <th>status</th>                                     
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($employees as $emp):?>
                        <tr style="cursor:pointer" onclick="document.location='<?php echo base_url('admin/employeeDetails/').$emp->accId?>'">
                            <td><?php echo $emp->accId?></td>
                            <td><?php echo $emp->email?></td>
                            <td><?php echo $emp->password?></td>
                            <td><?php echo $emp->user_type_desc?></td>
                            <td>Active</td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>    
    </div>

    </div>
</div>