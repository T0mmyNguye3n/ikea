<?php
$title = "Produkt detaljer";
include("functions.php");
require("header.php");
$status = setStatus();
$salgs_id = $_POST['details'];

$details =  getIdetails($salgs_id);
foreach ($details as $detail)
$sales_e_time = $detail['sluttid'];
$nowTime= new DateTime();
$sales_e_time = new DateTime($sales_e_time);
if($nowTime < $sales_e_time) {
  $timeLeft = $interval = $nowTime->diff($sales_e_time);
  $timeLeft = $interval->format('Auktioner slutter om: %D dage, %H timer and %I minutter');
 } else {
   $timeLeft =  "Auction: done";
}

?>


  <image src = 'img/stol1.png'>
<div>
  <h5>Salgs ID: <?php echo $detail['salgs_id'];?> </h5><br></br>
  <h4>Produkt Navn : <?php echo $detail['produktnavn'];?> </h4>
  <h4>Kategori : <?php echo $detail['kategori'];?> </h4>
  <h4><?php echo $timeLeft ?> </h4>
  <h4>Start pris : <?php echo $detail['startbud'];?> </h4>
  <h4>Status : <?php echo $detail['status'];?> </h4>
  <h4>Beskrivelse : <?php echo $detail['beskrivelse'];?> </h4>
</div>

<div>
<?php
  if(strcmp($detail['status'], "Igangværende") == 0){
    echo "<h2 >Status : Aktiv</h2>";
    echo "<table class='table'><tr><th>Top Byder</th><th>Top Bud</th></tr>";
      if($detail['current_bid_id'] == $detail['seller_id'])
        echo "<td><b>Ingen bud.</b></td><td></td>";
      else
        echo "<td>" . $detail['current_bid'] . "</td>";
    echo "</table>";
    echo "<br><br>";
    echo "<h2>Byd nu!</h2>";

    echo "<form action = 'bydupdate.php' method = 'post'>";
          echo "<input type = 'text' name = 'nyt_bud' placeholder = 'Dit bud'<br>";
            echo "<button type = 'submit' name = 'bid' value = " . $salgs_id . ">BYD</button>";
          echo "<input type = 'hidden' name = 'byder_id' value = " . $_SESSION['userid'] . " <br>";
        echo "</form>";

  }
  else if(strcmp($detail['status'], "Ingen bud") == 0)
    echo "<h2>Ingen bud</h2>";
  else
  {
    echo "<h2>Status : Slut</h2>";
    echo "<table class='table'><tr><th>Top Byder</th><th>Vinder Bud</th></tr>";
      if($detail['current_bid_id'] == $detail['seller_id'])
        echo "<td><b>Ingen bud</b></td><td><b>Ingen vinder</b></td>";
      else
        echo "<td>" . $detail['current_bid'] . "</td>";
  }?>
</div>
