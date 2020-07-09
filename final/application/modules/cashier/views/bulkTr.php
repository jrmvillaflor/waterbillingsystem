<?php foreach($bulk as $b ):?>
    <tr>
        <td><?php echo $b->bulk_name?></td>
        <td><?php echo $b->bulk_cubic?></td>
        <td><?php echo $b->bulk_amount?></td>
        <td><button class="btn btn-success" bulk-id='<?php echo $b->bulk_id?>' bulk-name ='<?php echo $b->bulk_name?>' bulk-cubic ='<?php echo $b->bulk_cubic?>' bulk-amount ='<?php echo $b->bulk_amount?>' onclick="showEdit(this)">Edit</button></td>
    </tr>
<?php endforeach;?>