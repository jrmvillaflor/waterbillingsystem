<?php if($user != null ):?>
    <?php foreach($user as $data):?>
        <tr id="trbody">
            <td class='td' id='id'><?php echo $data->customer_account_id?></td>
            <td class='td'><?php echo $data->first_name?></td>
            <td class='td'><?php echo $data->last_name?></td>
            <td class='td'><?php echo $data->account_type_desc?></td>
            <td class='td'>

                <?php if($data->account_status_desc == 'For Disconnection'):?>
            	    <a href="<?php echo base_url('admin/disconnectCustomer').'/'.$data->customer_account_id?>" class="btn btn-danger"> Disconnect </a>
                <?php elseif($data->account_status_desc == 'For Reconnection'):?>
            	    <a href="<?php echo base_url('admin/reconnectCustomer').'/'.$data->customer_account_id?>" class="btn btn-primary"> Reconnect </a>
                <?php endif;?>
            </td>
        </tr>
    <?php endforeach;?>
<?php endif?>
