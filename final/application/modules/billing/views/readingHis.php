<div class="card">
    <div class="card-body">
            
        <div class="row mx-2">
            <div class="col-md-5">
                
                <div class="form-group ">
                    <input type="hidden" name="" id="accountID" value="<?php echo $account_id?>">
                    <label for=""><strong>Account Type</strong></label>
                    <!-- <select name="type" id="typeID" class="form-control">
                        <?php foreach($accounts as $account):?>
                            <option value="<?php echo $account->customer_account_id?>"><?php echo $account->account_type_desc?></option>
                        <?php endforeach;?>
                    </select> -->
                </div>
            
            </div>

            <div class="col-md-12 mt-2">
                <table class="table table-stripe table-bordered" id='table'>
                    <thead class="thead-dark">
                        <tr>
                            <th>Reading Value</th>
                            <th>Date of Reading</th>
                            <th>Action</th>
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
            <div class="modal-header bg-primary">
                <strong></strong>
            </div>
            <div class="modal-body" >
                <div class="row">   
                    <div class="col-md-12">
                        
                    </div>

                    <div class="col-md-12">
                        <div class="form-group ">
                            <input type="hidden"  id="read_id" class="form-control " placeholder="">
                            <label for="readVal">Reading Value</label>
                            <input type="text"  id="read_val" class="form-control " placeholder="">
                        </div>  
                    </div>

                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="DOR">Date of Reading</label>
                            <input type="text" id="editDate" name="" class="form-control " placeholder="">
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <small class="text-danger">Note: The value of Reading Value should not be less than 0</small>
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

    
    function getData(){

        var account_ID = $('#accountID').val();

        console.log(account_ID);

        $.ajax({
            type:"POST",
            data: {'id':account_ID},
            url:'<?php echo base_url('billing/getReading');?>',
            success: function(response){
                var html = '';    
                var readings = $.parseJSON(response);
                
                console.log(response);
            
                
                $.each(readings, function(i, value){
                    var readingValue = value.reading_value;
                    var readingDate = value.date_of_reading;
                    

                    
                    html += '<tr><td>'+ readingValue +'</td><td>'+ readingDate;
                    if(readingValue == 0){
                        html += '</td><td><button class="btn btn-success disabled">Edit</button></td></tr>';
                    }
                    else{
                        html += '</td><td><button class="btn btn-success" read-id="'+ value.meter_reading_id +'" read-val="'+ readingValue +'" read-date="'+ readingDate +'" onclick="showEdit(this)">Edit</button></td></tr>';
                    } 

                })
                
                $("table#table tbody").html(html);
                
            },
            error: function(response){
                alert('Error in getting data ');
                console.log(response);

            }   
            
        });

    }

    function showEdit(btn){
        $("#editModal").modal()
        $("#read_id").val($(btn).attr("read-id"));
        $("#read_val").val($(btn).attr("read-val"));
        $("#editDate").val($(btn).attr("read-date"));
        
    }

    $("#saveEdit").on("click", function(){
        var mr_id = $("#read_id").val();
        var read_val = $("#read_val").val();
        var edit_date = $("#editDate").val();

        data = {
            mrID : mr_id,
            readVal: read_val,
            editDate: edit_date
        }

        console.log(data);

        $.ajax({
            type:"POST",
            data:data,
            url:"<?php echo base_url('billing/updateReading');?>",
            success: function(datas){
                var data = $.parseJSON(datas);
                
                alert(data.msg);
                location.reload();
                // getCubicRates($("#type_code").val());
                
            },
            error: function(data){
                alert(data.responseText);
                // console.log(data);
                // alert("Operation Failed");
            }
        });
    })
    

    $(document).ready(function(){
        
        getData();

        $('select#typeID').change(function(){
            sel = $('select#typeID').val();
            getData();
        });
        
    });

</script>