<div class="card px-3">
    
    <div class="row mt-3">
        <div class="col-md-12">
            <h2>Add Employee</h2>
            <hr>
        </div>
    </div>
    
    <div class="row justify-content-end mt-2">
        
        <div class="col-md-1">
            <button class="btn btn-success" id="save">Save</button>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-header">
            <Strong>Employee Account</Strong>
        </div>
        <div class="card-body mx-3">
            <div class="row">
                
                <div class="form-group col-md-4">
                    <label for="">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Enter your Email" name="email">
                </div>
                <div class="form-group col-md-4">
                    <label for="">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter your Password" name="password">
                </div>
                <div class="form-group col-md-4">
                    <label for="">Retype Password</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Retype your Password" name="pwd">
                </div>
                <div class="form-group col-md-4">
                    <label for="">Postion</label>
                    <select name="postion" id="pos" class="form-control">
                        <!-- <option value="">Select Position</option> -->
                        <?php foreach($postions as $position):?>
                            <option value="<?php echo $position->user_type_id?>"><?php echo $position->user_type_desc?></option>
                        <?php endforeach?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-2">
        <div class="card-header">
            <Strong>Employee Profile</Strong>
        </div>
        <div class="card-body mx-3">

            <div class="row">
                <input type="hidden" id="empID" value="">
                <div class="form-group col-md-6">
                    <label for="">First Name</label>
                    <input type="text" class="form-control" id="fname" placeholder="Enter your First Name" name="fname">
                </div>
                <div class="form-group col-md-6">
                    <label for="">Last Name</label>
                    <input type="text" class="form-control" id="lname" placeholder="Enter your Last Name" name="lname">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Gender</label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Contact Number</label>
                    <input type="text" class="form-control" placeholder="Contact Number" id="contact">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Address</h3>
                    <hr>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Street</label>
                    <input type="text" class="form-control" placeholder="Enter your First Name" id="street">
                </div>
                <div class="form-group col-md-4">
                    <label for="">Barangay</label>
                    <input type="text" class="form-control" placeholder="Enter your First Name" id="barangay">
                </div>
                <div class="form-group col-md-4">
                    <label for="">City/Municipality</label>
                    <input type="text" class="form-control" placeholder="Enter your Last Name" id="city">
                </div>
            </div>
        </div>
    </div>
</div>

<script>


    $("#save").on('click', function(){
        
        //account 
        var email = $("#email").val();
        var password = $("#password").val();
        var pos = $("#pos").val();
        var pwd = $("#pwd").val();

        //profile
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var gender = $("#gender").val();
        var contact = $("#contact").val();
        var street = $("#street").val();
        var barangay = $("#barangay").val();
        var city = $("#city").val();

        if(email != '' && password != '' && pwd != ''){
            if(password == pwd){
                var details = {
                    email: email,
                    password: password,
                    position: pos,
                    fname: fname,
                    lname: lname,
                    gender: gender,
                    contact: contact,
                    street: street,
                    barangay: barangay,
                    city: city
                    
                };
                saveData(details);
            }else{
                alert('password did not matched')
            }
        }else{
            alert("Please fillup all the fields");
        }

        
    });

    function saveData(data){

        console.log(data);
        $.ajax({
            type:"POST",
            data:data,
            url:'<?php echo base_url('admin/saveEmployee');?>',
            success: function(datas){

                var data = $.parseJSON(datas);
                alert(data.msg);

                location.reload();
                
            },
            error: function(){
                alert("Operation Failed");
            }
        });

    }

</script>
