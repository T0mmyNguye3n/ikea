<?php foreach ($products as $product) {
      $sales_e_time = $product['sluttid'];
      $salgs_id = $product['salgs_id'];


      $nowTime= new DateTime();
      $sales_e_time = new DateTime($sales_e_time);
      $interval = $nowTime->diff($sales_e_time);?>

       <tr>
       <td><?php echo $product['produktnavn']?></td>
       <td><?php echo $product['current_bid']?></td>
       <td><?php echo $product['status']?></td>
       <td><?php echo $interval->format('%D dage, %H timer and %I minutter') ?></td>
       <td><form method = "post" action = "produktdetaljer.php"><button name = "details" class="btn btn-warning mx-auto" type = "submit" value = " <?php echo $product['salgs_id'] ?> ">Detaljer</button></form></td>
       </tr>

    <?php } ?>
