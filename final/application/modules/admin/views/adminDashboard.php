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
                                        <div class="text-muted text-uppercase font-weight-bold small">Total Active Users</div>
                                    </div>
                                </div>
                            </div>
                        
                    </div>

                    <div class=" col-md-6" style="cursor:pointer">
                    
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
                    <div class=" col-md-6" style="cursor:pointer">
                    
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
                    <div class=" col-md-6" style="cursor:pointer" id="dis_cont">
                        
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
                <div class="modal-body" id="modalBody">
                    
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
            url:'<?php echo base_url('admin/viewUser');?>',
            success: function(response){

                // var data = $.parseJSON(response);

                console.log(response);
                // console.log(data);
                $("div#modalBody").html(response);
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
                getReconnUser();
                getFordisconn();
                disconnected();

            }, 2000);
            
        });

    });
</script>

<script>

    var utils = Samples.utils;

    var myChart = document.getElementById('sampleChart').getContext('2d'); 

    // console.log(myChart);

    var chart = new Chart(myChart, {
        type: 'bar',
        data:{
            labels:utils.months(),
            datasets:[{
                label: 'Earnings',
                data:[
                    5000,
                    2307,
                    3890,
                    7000,
                    8023,
                    6230,
                    5000,
                    2307,
                    3890,
                    7000,
                    8023,
                    6230,
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
</script>


