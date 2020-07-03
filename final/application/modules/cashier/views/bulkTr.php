<?php foreach($bulk as $b ):?>
    <tr>
        <td><?php echo $b->bulk_name?></td>
        <td><?php echo $b->bulk_cubic?></td>
        <!-- <td><button class="btn btn-success" bulk-id='$b->bulk_name' bulk-name ='$b->bulk_name'>Edit</button></td> -->
    </tr>
<?php endforeach;?>