<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class=" col-md-6" id="tu" style="cursor:pointer">
                    
                            <div class="card">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <i class="fa fa-cogs bg-success p-3 font-2xl mr-3"></i>
                                    <div>
                                        <div class="text-value-sm text-success" id='totalUser'>----</div>
                                        <div class="text-muted text-uppercase font-weight-bold small" >Active User</div>
                                    </div>
                                </div>
                            </div>
                        
                    </div>

                    <div class=" col-md-6" id="tu_for-reconnection" style="cursor:pointer">
                    
                            <div class="card">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <i class="fa fa-cogs bg-info p-3 font-2xl mr-3"></i>
                                    <div>
                                        <div class="text-value-sm text-info" id='forReconn'>----</div>
                                        <div class="text-muted text-uppercase font-weight-bold small">For Reconnection</div>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                    <div class=" col-md-6" id="tu_for-disconnection" style="cursor:pointer">
                    
                            <div class="card">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <i class="fa fa-cogs bg-warning p-3 font-2xl mr-3"></i>
                                    <div>
                                        <div class="text-value-sm text-warning" id='forDis'>----</div>
                                        <div class="text-muted text-uppercase font-weight-bold small">For Disconnection</div>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                    <div class=" col-md-6"  id="tu_disconnection" style="cursor:pointer" id="dis_cont">
                        
                            <div class="card">
                                <div class="card-body p-3 d-flex align-items-center">
                                    <i class="fa fa-cogs bg-danger p-3 font-2xl mr-3"></i>
                                    <div>
                                        <div class="text-value-sm text-danger" id='disconn'>---</div>
                                        <div class="text-muted text-uppercase font-weight-bold small">Disconnected</div>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div id="datepicker"></div>
    </div>
</div>
<div class="card">
    <div class="card-body">
                
        <!-- chart -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <canvas id="sampleChart" width="100%" height="30"></canvas>
                    </div>
                </div>
            </div>     
        </div>

    </div>
</div>

    <!-- modal -->
    <div class="modal fade" id="modalList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="input-group ">
                        <input type="text" class="form-control" placeholder="Search... " id="search">
                        <span class="input-group-append ">
                        <button type="button " class="btn btn-primary">Search</button>
                        </span>
                    </div>
                </div>
                <div class="modal-body" >
                    <table class="table table-stripe table-bordered" id="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" width=250>Customer Account Number</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Account Type</th>

                                <th scope="col" width=300>Action</th>  
                            </tr>
                        </thead>
                        <tbody class="tbody-light" id="table_active">
                            
                        </tbody>
                        </table>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnClose">Close</button>
                    <button type="button" class="btn btn-primary" id="save">Save changes</button>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade" id="modalList_for-reconnection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="input-group ">
                        <input type="text" class="form-control" placeholder="Search... " id="search">
                        <span class="input-group-append ">
                        <button type="button " class="btn btn-primary">Search</button>
                        </span>
                    </div>
                </div>
                <div class="modal-body" >
                    <ul class="list-group">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnClose">Close</button>
                    <button type="button" class="btn btn-primary" id="save">Save changes</button>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade" id="modalList_for-disconnection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="input-group ">
                        <input type="text" class="form-control" placeholder="Search... " id="search">
                        <span class="input-group-append ">
                        <button type="button " class="btn btn-primary">Search</button>
                        </span>
                    </div>
                </div>
                <div class="modal-body" >
                    <ul class="list-group">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnClose">Close</button>
                    <button type="button" class="btn btn-primary" id="save">Save changes</button>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade" id="modalList_disconnected" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="input-group ">
                        <input type="text" class="form-control" placeholder="Search... " id="search">
                        <span class="input-group-append ">
                        <button type="button " class="btn btn-primary">Search</button>
                        </span>
                    </div>
                </div>
                <div class="modal-body" >
                    <ul class="list-group">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnClose">Close</button>
                    <button type="button" class="btn btn-primary" id="save">Save changes</button>
                </div>
            </div>
        </div>
    </div>


<script>
    
    $( function() {
        $( "#datepicker" ).datepicker();
    } );

    $("#tu").on("click", function(){
        $("#modalList").modal()
         $.ajax({
                type:"GET",
                url:'<?php echo base_url('admin/getAllUserActive');?>',
                success: function(response){
                    $("#table_active").html(response);
                },
                error: function(){
                    alert("Operation Failed");
                }
            });
    })

    $("#tu_for-disconnection").on("click", function(){
         $("#modalList").modal()
         $.ajax({
                type:"GET",
                url:'<?php echo base_url('admin/getAllUserForDisconnection');?>',
                success: function(response){
                    $("#table_active").html(response);
                },
                error: function(){
                    alert("Operation Failed");
                }
            });
    })

    $("#tu_for-reconnection").on("click", function(){
         $("#modalList").modal()
         $.ajax({
                type:"GET",
                url:'<?php echo base_url('admin/getAllUserForReconnection');?>',
                success: function(response){
                    $("#table_active").html(response);
                },
                error: function(){
                    alert("Operation Failed");
                }
            });
    })

    $("#tu_disconnection").on("click", function(){
         $("#modalList").modal()
         $.ajax({
                type:"GET",
                url:'<?php echo base_url('admin/getAllUserDisconnection');?>',
                success: function(response){
                    $("#table_active").html(response);
                },
                error: function(){
                    alert("Operation Failed");
                }
            });
    })

    $(document).ready(function(){

        // $("div#totalUser").text('20');
        // $("div#forReconn").text('20');
        // $("div#forDis").text('20');
        // $("div#disconn").text('20');

        getTotalUser();

                checkUserActive();
                getReconnUser();
                getFordisconn();
                disconnected();


        function getTotalUser(){

            $.ajax({
                type:"GET",
                url:'<?php echo base_url('admin/countUser');?>',
                success: function(response){

                    $("div#totalUser").text(response);
                    

                },
                error: function(){
                    alert("Operation Failed");
                }
            });

        };

        function checkUserActive(){

            $.ajax({
                type:"GET",
                url:'<?php echo base_url('admin/checkUserActive');?>',
                success: function(response){

                    

                },
                error: function(){
                    alert("Operation Failed");
                }
            });

        };



      

        function getAllUser(){

            $.ajax({
                type:"GET",
                url:'<?php echo base_url('admin/countUser');?>',
                success: function(response){
                    $("#table_active").html(response);
                },
                error: function(){
                    alert("Operation Failed");
                }
            });

        };

        function getReconnUser(){

            $.ajax({
                type:"GET",
                url:'<?php echo base_url('admin/getReconnection');?>',
                success: function(response){

                    $("div#forReconn").text(response);
                },
                error: function(){
                    alert("Operation Failed");
                }
            });
        }

        function getFordisconn(){

            $.ajax({
                type:"GET",
                url:'<?php echo base_url('admin/getForDisconn');?>',
                success: function(response){

                    $("div#forDis").text(response);
                },
                error: function(){
                    alert("Operation Failed");
                }
            });
        };

        function disconnected(){

            $.ajax({
                type:"GET",
                url:'<?php echo base_url('admin/disconnected');?>',
                success: function(response){

                    $("div#disconn").text(response);
                },
                error: function(){
                    alert("Operation Failed");
                }
            });
        };



        $(document).ready(function(){

            setInterval(function () {
                getTotalUser();

                checkUserActive();
                getReconnUser();
                getFordisconn();
                disconnected();

            }, 30000);
            
        });

    });
</script>

<script>

    var utils = Samples.utils;

    var myChart = document.getElementById('sampleChart').getContext('2d'); 

    // console.log(myChart);


     $.ajax({
                type:"GET",
                url:'<?php echo base_url('admin/earnings');?>',
                success: function(response){
                    alert(response);
                    var response = JSON.parse(response);
                    var chart = new Chart(myChart, {
        type: 'bar',
        data:{
            labels:utils.months(),
            datasets:[{
                label: 'Earnings',
                data:[
                    response[0],
                      response[1],
                        response[2],
                          response[3],
                            response[4],
                              response[5],
                                response[6],
                                  response[7],
                                    response[8],
                                    response[9],
                                    response[10],
                                    response[11],
                                    
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderWidth:1,
                borderColor:'#777',
                hoverBorderWidth:3,
                hoverBorderColr:'#00000'
            }]
        },
        options:{
            legend: false,
            title:{
                display: true,
                text: "Earnings by Month in 2020",
                fontSize: 20
            }
        }
    });
                },
                error: function(){
                    alert("Operation Failed");
                }
            });
    
</script>


