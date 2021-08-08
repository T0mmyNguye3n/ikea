<?php
include("functions.php");
include_once("header.php");

$byder_id = $_POST['byder_id'];
$salgs_id = $_POST['bid'];
$nyt_bud = $_POST['nyt_bud'];


$_GET['bid_ok'] = 1;




$sql = "SELECT current_bid FROM sales WHERE salgs_id = '$salgs_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$prev_top_bid = $row['current_bid'];
if($nyt_bud <= $prev_top_bid)
{
  echo "<h2>Dit bud skal være højere!</h2>";
  echo "<form method = 'post' action = 'produktdetaljer.php'><button name = 'details' type = 'submit' value = " . $salgs_id . ">Produkt detaljer</button></form>";
}
else
{
  $sql = "UPDATE sales SET current_bid = '$nyt_bud', current_bid_id = '$byder_id' WHERE salgs_id = '$salgs_id'";
  mysqli_query($conn, $sql);
  $_POST['details'] = $salgs_id;
  echo "<h2>Dit bud er regristreret!</h2>";
  echo "<form method = 'post' action = 'produktdetaljer.php'><button name = 'details' type = 'submit' value = " . $salgs_id . ">Gå tilbage</button></form>";
}
 ?>
