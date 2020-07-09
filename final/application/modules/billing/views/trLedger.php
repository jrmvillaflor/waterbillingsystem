<?php if($records != null):?>
    <?php foreach($records as $i => $record):?>
        <?php if($i == 0):?>
            <?php $prevReading = $record->reading_value?>
            <?php $balance =0;?>
        <?php else:?>
            <tr class="text-center">
                <td><?php echo nice_date($record->date_of_reading, 'M-Y');?></td>
                <td><?php echo $record->reading_value;?></td>
                <td><?php echo $prevReading;?></td>
                <td><?php echo $record->reading_value - $prevReading?></td>
                <td><?php echo $bill[$i-1]?></td>
                <td>
                    <?php if($balance == 0):?>
                        ------------
                        <?php $overdue=0;?>
                    <?php else:?>
                        <?php  
                        echo $overdue = round($balance,2);
                        
                        ?>
                    <?php endif?>
                </td>
                <td>
                    <?php if($overdue == 0):?>
                        ------------
                        <?php $penalty = 0;?>
                    <?php else:?>
                        <?php 
            
                            echo $penalty = round($overdue * $OP[0]->op_value,2);
                        ?>
                    <?php endif?> 
                </td>
                <td> 
                    <?php 
                        
                        echo $total = round($bill[$i-1]+$overdue+ $penalty,2);
                    ?>
                </td>
                <?php if($payments != null):?>
                    <?php $k = count($payments)-1; $ammount = 0;?>
                    <?php foreach($payments as $key => $payment):?>
                        <?php if($payment->date_of_reading == $record->date_of_reading):?>
                            <td><?php echo $payment->payment_date?></td>
                            <td><?php echo $payment->OR_number?></td>
                            <td>
                                <?php 
                                    if($payment->for_reconn == 1):
                                        echo $amount = $payment->amount-200;
                                    else:
                                        echo $amount = $payment->amount;
                                    endif;
                                ?>
                            </td>
                            <?php break;?>
                        <?php else: ?>
                            <?php if($k == $key):?>
                                <td>------------</td>
                                <td>------------</td>
                                <td>------------</td>
                                <?php $amount = 0?>
                            <?php endif;?>
                        <?php endif;?>
                    <?php endforeach;?>
                <?php else:?>
                    <td>------------</td>
                    <td>------------</td>
                    <td>------------</td>
                    <?php $amount = 0?>
                <?php endif;?>
                <td>
                    <?php 
                        echo $balance = round($total - $amount, 2);
                    ?>
                </td>
            </tr>
            <?php $prevReading = $record->reading_value?>
        <?php endif;?>
    <?php endforeach;?>
<?php else:?>
    <tr>
        <td colspan="12" class="text-center">
            <div class=" mx-auto" data-text=""><img src="<?php echo base_url('assets/images/undraw_no_data_qbuo.svg');?>" width="100"></div>
            <p class="lead text-gray-800 mb-5">No Found Data</p>
            <p class="text-gray-500 mb-0">It looks no data has been recorded.</p>
        </td>
    </tr>
<?php endif;?>