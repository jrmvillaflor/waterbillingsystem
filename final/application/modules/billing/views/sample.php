<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo ($title==NULL?'Alubijib Water Billing System':$title) ?></title>
        <!-- CORE UI  -->
        <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css');?>">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- js -->
        <!-- <script src="<?php echo base_url('assets/js/main.js');?>"></script> -->

        <!-- CHART -->
        <!-- <script src="<?php echo base_url('assets/js/Chart/Chart.js');?>"></script>
        <script src="<?php echo base_url('assets/js/Chart/samples/utils.js');?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/Chart/samples/style.css');?>"> -->
        
        <!-- jquery and jquery UI -->
        <link type="text/css" rel="stylesheet" href="<?php echo base_url("assets/main/jquery/jqueryUI/jquery-ui.css")?>" >
        <script type="text/javascript" src="<?php echo base_url("assets/main/jquery/jquery-3.5.1.min.js")?>"></script>
        <script type="text/javascript" src="<?php echo base_url("assets/main/jquery-ui.js")?>"></script>

    </head>
    <body>
        <div class="container">
        <table class="table table-striped table-bordered" style="font-size: 12px;">
                             <thead>
                             </thead>
                                <tbody id="tableaccounts">
                                  <tr>
                                    <td colspan="4" class="label-bill">NAME AND ADDRESS</td>
                                  </tr>
                                    <tr>
                                     <td colspan="4" class="pl-5 text-gray">$NAME AND ADDRESS</td>
                                    </tr>
                                    <tr>
                                      <td colspan="4" class="label-bill">ACCOUNT NUMBER 
                                        <span class="text-gray pl-2">
                                          1234567890
                                        </span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="2"class="label-bill text-center">READINGS</td>
                                      <td class="label-bill">Cubic Meter</td>
                                      <td rowspan="2" class="label-bill text-center">AMOUNT
                                        <br>(PESOS)</td>
                                    </tr>
                                    <tr>
                                      <td class="label-bill">PREVIOUS</td>
                                      <td class="label-bill">PRESENT</td>
                                      <td class="label-bill">CONSUMED</td>
                                    </tr>
                                    <tr>
                                      <td class="text-gray">130</td>
                                      <td class="text-gray">145</td>
                                      <td class="text-gray">15</td>
                                      <td class="text-gray">1,000.00</td>
                                    </tr>
                                    <tr>
                                      <td colspan="3" class="label-bill">ARREARS</td>
                                      <td class="text-gray">12124.23</td>
                                    </tr>
                                    <tr>
                                      <td colspan="3" class="label-bill">AMOUNT DUE UNTIL DUE DATE</td>
                                      <td class="text-gray">13944.94</td>
                                    </tr>
                                    <tr>
                                      <td colspan="4"></td>
                                    </tr>
                                    

                                    <tr>
                                      <td class="label-bill">READING DATE</td>
                                      <td class="label-bill">DUE DATE</td>
                                      <td class="label-bill">AMOUNT DUE AFTER DUE DATE</td>
                                      <td class="label-bill">FOR THE MONTH OF</td>
                                    </tr>
                                    <tr>
                                      <td class="text-gray">1-23</td>
                                      <td class="text-gray">2-12</td>
                                      <td class="text-gray">14141</td>
                                      <td class="text-gray">Jan 2020</td>
                                    </tr>
                                </tbody>
                          </table>
        </div>
    </body>
    <footer class="app-footer">
        <div>
        <a href="https://coreui.io">CoreUI</a>
        <span>© 2018 creativeLabs.</span>
        </div>
        <div class="ml-auto">
        <span>Powered by</span>
        <a href="https://coreui.io">CoreUI</a>
        </div>
    </footer>
</html>