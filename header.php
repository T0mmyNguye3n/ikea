<?php
  session_start();
  include_once 'includes/functions.inc.php';
  include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ikea</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
</html>

    <nav>
      <div class="wrapper">
        <a href="index.php"><img src="img/ikealogo.png" alt="Ikea logo"></a>
        <ul>
          <li><a href="index.php">Hjem</a></li>
          <li><a href="omos.php">Om Os</a></li>
          <?php
            if (isset($_SESSION["userid"])) {
              echo "<li><a href='auktionsside.php'>Auktions side</a></li>";
              echo "<li><a href='tauktion.php'>Tilføj auktion</a></li>";
              echo "<li><a href='minside.php'>Min side</a></li>";
              echo "<li><a href='logout.php'>Log Ud</a></li>";
            }
            else {
              echo "<li><a href='signup.php'>Opret</a></li>";
              echo "<li><a href='login.php'>Log ind</a></li>";
            }
          ?>
        </ul>
    </nav>

<div class="wrapper">
