<?php
  include_once 'header.php';
?>

<section class="signup-form">
  <h2>Sign Up</h2>
  <div class="signup-form-form">
    <form action="includes/signup.inc.php" method="post">
      <input type="text" name="name" placeholder="Full name...">
      <input type="text" name="email" placeholder="Email...">
      <input type="text" name="uid" placeholder="Username...">
      <input type="password" name="pwd" placeholder="Password...">
      <input type="password" name="pwdrepeat" placeholder="Repeat password...">
      <button type="submit" name="submit">Opret</button>
    </form>
  </div>
  <?php

    if (isset($_GET["error"])) {
      if ($_GET["error"] == "emptyinput") {
        echo "<p>Udfyld alle felter!</p>";
      }

      else if ($_GET["error"] == "invaliduid") {
        echo "<p>Vælg et andet username!</p>";
      }

      else if ($_GET["error"] == "invalidemail") {
        echo "<p>Vælg et andet email!</p>";
      }

      else if ($_GET["error"] == "passwordsdontmatch") {
        echo "<p>Password matcher ikke!</p>";
      }

      else if ($_GET["error"] == "stmtfailed") {
        echo "<p>Noget gik galt!</p>";
      }

      else if ($_GET["error"] == "usernametaken") {
        echo "<p>Username er taget!</p>";
      }

      else if ($_GET["error"] == "none") {
        echo "<p>Du er oprettet!</p>";
      }
    }
  ?>
</section>

<?php
  include_once 'footer.php';
?>
