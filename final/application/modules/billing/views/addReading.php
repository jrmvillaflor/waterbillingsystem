<div class="card">
    <div class="card-body">
        
        <div class="card">
            <form action="<?php echo base_url('billing/addReading/').$accounts[0]->customer_id;?>" method="POST">
                <div class="card-header ">
                    <strong>Reading</strong> 
                </div>
                <div class="card-body ">
                    <div class="form-group ">
                        <input type="hidden" name="" id="accountID" value="">
                        <label for="readVal">Account Type</label>
                        <select name="type" id="typeID" class="form-control">
                            <?php foreach($accounts as $account):?>
                                <option value="<?php echo $account->customer_account_id?>"><?php echo $account->account_type_desc?></option>
                            <?php endforeach;?>
                        </select>
                        <span class=""></span>
                    </div>
                    <div class="form-group ">
                        <label for="readVal">Reading Value</label>
                        <input type="text"  name="readVal" class="form-control " placeholder="">
                        <span class="text-danger"><?php echo form_error('readVal');?></span>
                    </div>
                    <div class="form-group ">
                        <label for="DOR">Date of Reading</label>
                        <input type="password " id="datepicker" name="DOR" class="form-control " placeholder="">
                        <span class="text-danger"><?php echo form_error('DOR');?></span>
                    </div>
                </div>
                <div class="card-footer ">
                    <button type="submit " class="btn btn-sm btn-primary "><i class="fa fa-dot-circle-o "></i> Submit</button>
                </div>
            </form>
        </div>
        
        <!-- table  -->
        <!-- <div class="row mx-2">
            <table class="table table-stripe table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Reading Value</th>
                        <th>Date of Reading</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="tbody-light">
                    
                        <?php if($readings != null):?>    
                            <?php foreach($readings as $reading):?>
                                <tr>
                                    <td><?php echo $reading->reading_value?></td>
                                    <td><?php echo $reading->date_of_reading?></td>
                                    <td>
                                        <?php if($reading->reading_value == 0):?>
                                            <a href="" class="btn btn-success disabled">Update</a>
                                        <?php else:?>
                                            <a href="" class="btn btn-success">Update</a>
                                        <?php endif;?>
                                    </td>
                                </tr>            
                            <?php endforeach;?>
                        <?php endif;?>
                    
                </tbody>
            </table>
        </div>     -->

        <div class="row mx-2">
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

 <!-- <button id="btnId">sample</button> -->

<script>
    $("#datepicker").datepicker({
        dateFormat : "yy-mm-dd"
    });

    var sel = $('select#typeID').val();

    function getData(){

        $.ajax({
            type:"POST",
            data: {'id':sel},
            url:'<?php echo base_url('billing/getReading');?>',
            success: function(response){
                var html = '';    
                var readings = $.parseJSON(response);
                
                console.log(response);
                
                
                // for(i=0; i < readings.length; i++){
                //     console.log(readings[i].reading_value);

                //     html += '<tr><td>'+ readings[i].reading_value +'</td><td>'+ readings[i].date_of_reading;
                //     if(readings[i].reading_value == 0){
                //         html += '</td><td><a href="" class="btn btn-success disabled btn-sm">Update</a></td></tr>';
                //     }
                //     else{
                //         html += '</td><td><a href="" class="btn btn-success btn-sm">Update</a></td></tr>';
                //     }

                //     $("table#table tbody").html(html);
                // }
                
                $.each(readings, function(i, value){
                    var readingValue = value.reading_value;
                    var readingDate = value.date_of_reading;

                    
                    html += '<tr><td>'+ readingValue +'</td><td>'+ readingDate;
                    if(readingValue == 0){
                        html += '</td><td><a href="" class="btn btn-success disabled btn-sm">Update</a></td></tr>';
                    }
                    else{
                        html += '</td><td><a href="" class="btn btn-success btn-sm">Update</a></td></tr>';
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

    $(document).ready(function(){
        
        getData();

        $('select#typeID').change(function(){
            sel = $('select#typeID').val();
            getData();
        });
        
    });
</script>