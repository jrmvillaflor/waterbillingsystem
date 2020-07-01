<div class="card">
    <div class="card-body">
        <!-- search -->

        <div class="input-group ">
            <input type="text" class="form-control" placeholder="Search... " id="search">
            <span class="input-group-append ">
            <button type="button " class="btn btn-primary">Search</button>
            </span>
        </div>

        <div class="row mx-3 mt-3">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Account Type</th>
                        <th width="150">Permission</th>
                    </tr>
                </thead>
                <tbody class="tbody-light">
                    <?php if($customers != null):?>
                        <?php foreach($customers as $key => $customer):?>
                            <tr>
                                <td id='accId<?php echo $key?>'><?php echo $customer->customer_account_id?></td>
                                <td><?php echo $customer->first_name?></td>
                                <td><?php echo $customer->last_name?></td>
                                <td><?php echo $customer->account_type_desc?></td>
                                <td>
                                    <label class="switch switch-text switch-primary-outline-alt">
                                        <input type="checkbox" class="switch-input" id="switch<?php echo $key?>" accId="<?php echo $customer->customer_account_id?>" onChange="showModal(this)" value="<?php echo $customer->admin_permission?>">
                                        <span class="switch-label" data-on="On" data-off="Off"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                </tbody>
            </table>
        </div>

        

        <div id="dialog-message" title="">
            <p id="msg">
                
            </p>
        </div>
        
 
        <!-- Button trigger modal
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Launch demo modal
            </button>
            <button class="btn btn-danger" id="testing" onclick="testing(this)"> Javascript</button>
            <label class="switch switch-text switch-primary-outline-alt">
                <input type="checkbox" class="switch-input" id="testSwitch"  onChange="testing(this)" value="">
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
            </label> -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <button type="button" class="btn btn-primary" id="save">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



<script>

    let switchName;
    let accId;

    function showModal(e){
        switchName = '#'+$(e).attr('id');
        accId = $(e).attr('accId');
        $('#exampleModal').modal({backdrop: 'static', keyboard: false});

        if($(switchName).prop('checked') == true){
            $("#message").text("Do you want to allow to make partial payments?");
        }
        else{
            $("#message").text("dili na e allow to make partial payments?");
        }

        
    }

    //close button of modal
    $("#btnClose").on("click", function(){
        if($(switchName).prop('checked') == true){
            $(switchName).prop('checked', false)
        }
        else{
            $(switchName).prop('checked', true)
        }
    });

    //save button
    $("#save").on("click", function(){

        $('#exampleModal').modal("hide");
    
        var stat;
        var id = accId;
        if($(switchName).prop('checked') == true){
            stat = 1;
        }
        else{
            stat = 0;
        }
        
        custPermission(id,stat);


    });


    function custPermission(id,stat){
        
        var details = {
            id: id,
            stat: stat,
        };


        $.ajax({
            type:"POST",
            data:details,
            url:'<?php echo base_url('admin/customerPermission');?>',
            success: function(datas){
                var data = $.parseJSON(datas);
                
                alert(data.msg);
                
            },
            error: function(){
                alert("Operation Failed");
            }
        });

    }

    function allow(i){
        var s = '#switch'+i;
        
        console.log($(s).prop('checked'));
        if($(s).prop('checked') == true){
            $("#msg").text("Do you want to allow "+ $('td#accId'+i).text() +" to make partial payments?");
        }
        else{
            $("#msg").text("dili e allow "+ $('td#accId'+i).text() +" to make partial payments?");
        }
        // console.log($('td#accId'+i).text());
             
        $( "#dialog-message" ).dialog({
            modal: true,
            buttons: {
                OK: function() {
                    $( this ).dialog( "close" );
                    var stat;
                    var id = $('td#accId'+i).text();
                    if($(s).prop('checked') == true){
                        stat = 1;
                    }
                    else{
                        stat = 0;
                    }
                    custPermission(id,stat);
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                    
                    if($(s).prop('checked') == true){
                        $(s).prop('checked', false)
                    }
                    else{
                        $(s).prop('checked', true)
                    }
                }
            }
        });
        


    }

    function onSwitch(i){
        $('#switch' + i).prop('checked', true)
    }


    $(document).ready(function(){
        $( "#dialog-message" ).hide();

        var tr = $("tbody tr");
        $.each(tr, function(i, value){
            
            if($("#switch" + i).val() == 1){
                onSwitch(i);
            }
        })

        console.log($('td#accId0').text());

    });
    
  </script>