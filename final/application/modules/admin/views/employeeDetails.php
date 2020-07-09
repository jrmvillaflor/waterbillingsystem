<div class="card">
    <div class="card-body">

        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col-md-4">
                                <strong>Account</strong>
                            </div>
                            <!-- <div class="col-md-1">
                                <button class="btn btn-success ">Edit</button>
                            </div> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                Email: <Strong><?php echo $account[0]->email?></Strong>
                            </div>
                            <div class="col-md-4">
                                Password: <Strong><?php echo $account[0]->password?></Strong>
                            </div>
                            <div class="col-md-4">
                                Position: <Strong><?php echo $account[0]->user_type_desc?></Strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col-md-4 pt-2">
                                <strong>Profile</strong>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-success" acc-id="<?php echo $profile[0]->accId?>" emp-id="<?php echo $profile[0]->emp_id?>" onclick="editProf(this)">Edit</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-form-label">
                                First Name: <Strong id="first-name"><?php echo $profile[0]->firstname?></Strong> 
                            </div>
                            <div class="col-md-6 col-form-label">
                                Last Name: <Strong id="last-name"><?php echo ($profile==NULL?'':$profile[0]->lastname)?></Strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-form-label">
                                Gender: <Strong><?php echo ($profile==NULL?'':$profile[0]->gender)?></Strong> 
                            </div>
                            <div class="col-md-6 col-form-label">
                                Contact Number: <Strong id="contactNo"><?php echo ($profile==NULL?'':$profile[0]->contactNo)?></Strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-form-label">
                                Street: <Strong id="street"><?php echo ($profile==NULL?'':$profile[0]->emp_street)?></Strong>
                            </div>
                            <div class="col-md-6 col-form-label">
                                Barangay: <Strong id="barangay"><?php echo ($profile==NULL?'':$profile[0]->emp_barangay)?></Strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-form-label">
                                City/Province: <Strong id="city"><?php echo ($profile==NULL?'':$profile[0]->emp_city)?></Strong>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <strong>Edit Profile</strong>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <input type="hidden" id="empID" value="">
                    <div class="form-group col-md-6">
                        <label for="">First Name</label>
                        <input type="text" class="form-control" id="fname" placeholder="Enter your First Name" fname="fname">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Last Name</label>
                        <input type="text" class="form-control" id="lname" placeholder="Enter your Last Name" lname="lname">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Gender</label>
                        <select id="gender" class="form-control">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Contact Number</label>
                        <input type="text" class="form-control" placeholder="Contact Number" id="editContact">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h3>Address</h3>
                        <hr>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Street</label>
                        <input type="text" class="form-control" placeholder="Street" id="editStreet">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Barangay</label>
                        <input type="text" class="form-control" placeholder="Barangay" id="editBarangay">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">City/Province</label>
                        <input type="text" class="form-control" placeholder="City" id="editCity">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnClose">Close</button>
                <button type="button" class="btn btn-primary" id="saveProfile">Save changes</button>
            </div>
        </div>
    </div>
</div>


<script> 

    let accID;
    let empID;
    $("#modal").on("click", function(){
        $("#editProfile").modal()
    })



    function editProf(btn){

        accID = $(btn).attr("acc-id");
        empID = $(btn).attr("emp-id");
        $("#editProfile").modal();

        $("#fname").val($("#first-name").text());
        $("#lname").val($("#last-name").text());
        $("#editContact").val($("#contactNo").text());
        $("#editStreet").val($("#street").text());
        $("#editBarangay").val($("#barangay").text());
        $("#editCity").val($("#city").text());

        console.log(f);
    }

    $("#saveProfile").on("click", function(){
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var contact = $("#editContact").val();
        var gender = $("#gender").val();
        var street = $("#editStreet").val();
        var barangay = $("#editBarangay").val();
        var city = $("#editCity").val();

        data ={

            empID: empID,
            fname: fname,
            lname: lname,
            gender: gender,
            street: street,
            contact: contact,
            barangay: barangay,
            city: city,
            accID: accID,
        }

        console.log(data);
        


        // console.log(data);

        $.ajax({
            type:"POST",
            data:data,
            url:"<?php echo base_url('admin/updateProfile');?>",
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

</script>