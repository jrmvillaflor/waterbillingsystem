<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo base_url("admin/addHoliday")?>">Holiday</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("admin/addDue")?>">Due Dates</a>
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
                    <label for="">Holiday Name</label>
                    <input type="text" class="form-control" id="holiday" placeholder="Name of Holiday" >
                </div>  
            
            </div>
            <div class="col-md-5">
                
                <div class="form-group">
                    <label for="">Date of Holiday</label>
                    <input type="text" class="form-control" id="doh" placeholder="Name of Holiday" >
                </div>  
            
            </div>
            <div class="col-md-2 m-auto">
                <div class="form-group">
                    <button class="btn btn-success form-control" id="saveHoliday">Save</button>
                </div>
                
            
            </div>
        </div>


        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
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
                    <input type="hidden" id="holiday_id">
                    <div class="form-group">
                        <label for="">Holiday Name</label>
                        <input type="text" class="form-control" id="holiday_name" placeholder="Name of Holiday" >
                    </div>  
                
                    </div>
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label for="">Date of Holiday</label>
                            <input type="text" class="form-control" id="editDate" placeholder="Name of Holiday" >
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
                <small class="text-danger">Note: Doing this Action will PEMANENTLY DELETE the data</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnClose">Close</button>
                <button type="button" class="btn btn-primary" id="saveDelete">Delete</button>
            </div>
        </div>
    </div>
</div>


<script>
    let holiID;

    $( function() {
        $( "#doh" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#editDate" ).datepicker({ dateFormat: 'yy-mm-dd' });
        
        getHoliday();
    });


    function getHoliday(){
        $.ajax({
            type:"GET",
            url:'<?php echo base_url('admin/getHoliday');?>',
            success: function(datas){
                var data = $.parseJSON(datas);

                $.each(data, function(i, value){

                    $("table tbody").append("<tr><td>"+ value.holiday_date +"</td><td>"+ value.holiday_name +"</td><td ><button class='btn btn-success' holi-id='"+value.holiday_id+"' holi-name='"+value.holiday_name+"' holi-date='"+value.holiday_date+"' onclick='showEdit(this)'>Edit</button> <button class='btn btn-danger' holi-id='"+value.holiday_id+"' holi-name='"+value.holiday_name+"' onclick='showDelete(this)'>Delete</button></td></tr>");
                })

                
            },
            error: function(){
                alert("Operation Failed");
            }
        });
    }


    $("#saveHoliday").on("click", function(){
        
        data = {
            holiday_name: $("#holiday").val(),
            holiday_date: $("#doh").val()
        };
        
        
        
        if( $("#holiday").val() != "" && $("#doh").val() != ""){
            $.ajax({
                type:"POST",
                data:data,
                url:'<?php echo base_url('admin/saveHoliday');?>',
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
        }
        else{
            alert("Empty Fields");
        }

    });

    function showEdit(btn){
        $("#editModal").modal()

        $("#holiday_id").val($(btn).attr("holi-id"));
        $("#holiday_name").val($(btn).attr("holi-name"));
        $("#editDate").val($(btn).attr("holi-date"));
        
    }

    $("#saveEdit").on("click", function(){

        data = {
            holiday_id: $("#holiday_id").val(),
            holiday_name: $("#holiday_name").val(),
            holiday_date: $("#editDate").val()
        };

        // console.log(data);
        $.ajax({
            type:"POST",
            data:data,
            url:'<?php echo base_url('admin/updateHoliday');?>',
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
        holiID = $(btn).attr("holi-id");
        var name = $(btn).attr("holi-name");
        $("#mess").text("Do you really want to delete "+ name +"?")
    }

    $("#saveDelete").on('click', function(){

        data = {
            holiday_id: holiID
        }
        $.ajax({
            type:"POST",
            data: data,
            url:'<?php echo base_url('admin/deleteHoliday');?>',
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