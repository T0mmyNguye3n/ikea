<?php
$title = "Min side";
include("functions.php");
include("header.php");
$user =  $_SESSION['userid'];
$userAuctions = getUserAuctions($user);
$userBidAuctions = getUserBidAuctions($user);
?>

<link rel="stylesheet" href="minside.css">
<div class="container">
  <h2>Dine auktioner</h2>
  <table class="content-table" style="
      width: 900px;
  "><tbody><tr><th>Produkt Navn</th><th>Nuværende bud</th><th>Status</th><th>Tid tilbage</th><th>Produkt Detaljer</th>
    <?php if (empty($userAuctions)) { ?>
      <tr><td>Du har ingen auktioner.</td><td></td><td></td><td></td><td></td></tr>
    <?php
    }
    else {
          foreach ($userAuctions as $userAuction) {
          $sales_e_time = $userAuction['sluttid'];
          $salgs_id = $userAuction['salgs_id'];


          $nowTime = new DateTime();
          $sales_e_time = new DateTime($sales_e_time);
          if($nowTime < $sales_e_time) {
            $timeLeft = $interval = $nowTime->diff($sales_e_time);
            $timeLeft = $interval->format('%D dage, %H timer and %I minutter');
           } else {
             $timeLeft =  "done";
          }  ?>

           <tr>
           <td><?php echo $userAuction['produktnavn']?></td>
           <td><?php echo $userAuction['current_bid']?></td>
           <td><?php echo $userAuction['status']?></td>
           <td><?php echo $timeLeft ?></td>
           <td><form method = "post" action = "produktdetaljer.php"><button name = "details" class="btn btn-warning mx-auto" type = "submit" value = " <?php echo $userAuction['salgs_id'] ?> ">Detaljer</button></form></td>
           </tr>
        <?php } ?>
    <?php } ?>
        </table>
</div>

  <h2>Førende auktioner</h2>
  <table class="content-table" style="
      width: 900px;
  "><tbody><tr><th>Produkt Navn</th><th>Nuværende bud</th><th>Status</th><th>Tid tilbage</th><th>Produkt Detaljer</th>
    <?php if (empty($userBidAuctions)) { ?>
      <tr><td>Du fører ingen auktioner.</td><td></td><td></td><td></td><td></td></tr>
    <?php
    }
    else {
          foreach ($userBidAuctions as $userBidAuction) {
          $sales_e_time = $userBidAuction['sluttid'];
          $salgs_id = $userBidAuction['salgs_id'];


          $nowTime= new DateTime();
          $sales_e_time = new DateTime($sales_e_time);
          if($nowTime < $sales_e_time) {
            $timeLeft = $interval = $nowTime->diff($sales_e_time);
            $timeLeft = $interval->format('%D dage, %H timer and %I minutter');
           } else {
             $timeLeft =  "done";
          }  ?>

           <tr>
           <td><?php echo $userBidAuction['produktnavn']?></td>
           <td><?php echo $userBidAuction['current_bid']?></td>
           <td><?php echo $userBidAuction['status']?></td>
           <td><?php echo $timeLeft ?></td>
           <td><form method = "post" action = "produktdetaljer.php"><button name = "details" class="btn btn-warning mx-auto" type = "submit" value = " <?php echo $userBidAuction['salgs_id'] ?> ">Detaljer</button></form></td>
           </tr>
        <?php } ?>
    <?php } ?>
