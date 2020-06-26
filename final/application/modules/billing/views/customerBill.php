<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
	<style type="text/css">
		
		body {
		  background: white; 
		}

	</style>
</head>
<body>
        <div class="col-md-12">
            <table class="table table-stripe table-bordered">
                        
                <thead>
                </thead>
                <tbody id="tableaccounts">
                    <tr>
                        <td colspan="4" class="label-bill">NAME AND ADDRESS</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="label-bill">ACCOUNT NUMBER 
                        <span class="text-gray pl-2">
                            <!-- <strong><?php echo $infos[0]->customer_account_id ?></strong> -->
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
                        <td class="label-bill">PRESENT</td>
                        <td class="label-bill">PREVIOUS</td>
                        <td class="label-bill">CONSUMED</td>
                    </tr>
                    <tr>
                        
                        <?php foreach($readings as $i => $reading):?>
                            <?php if($i == 0):?>
                                <td class="text-gray"><?php echo $pres = $reading->reading_value?></td>                                             
                            <?php else:?>
                                <td class="text-gray"><?php echo $prev = $reading->reading_value?></td>                                                
                                
                            <?php endif;?>
                        <?php endforeach;?>
                        <td class="text-gray"><?php echo $pres - $prev?></td>
                        <td class="text-gray"><?php echo $bill?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="label-bill">ARREARS</td>
                        <td class="text-gray"><?php echo $arrears?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="label-bill">AMOUNT DUE UNTIL DUE DATE</td>
                        <td class="text-gray"><?php echo $total = $bill + $arrears?></td>
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
                        <td class="text-gray"><?php echo nice_date($date, 'M-d')?></td>
                        <td class="text-gray"><?php echo nice_date($due_date, 'M-d-Y')?></td>
                        <td class="text-gray"><?php echo $total += round($total * $OP[0]->op_value,2);?></td>
                        <td class="text-gray"><?php echo nice_date($date, 'M-Y');?></td>
                    </tr>
                </tbody>
            </table>
                         
        </div>


</body>
</html>