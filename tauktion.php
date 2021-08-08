<?php
$title = "Tilføj auktion";
include("functions.php");
require("header.php");
 ?>

<body>
        <h1>Tilføj et produkt</h1>
  			<hr>
  			<div>
<form method = "post" action = "auktionssidedb.php">
		<p>produktnavn	: <input type = "text" name = "pname"  ></p>
		<p>Minimumspris		: <input type = "text" name = "startbud" ></p>
		<p>kategori		: <select name = "kategori">
						<option value = "Stol">Stol</option>
						<option value = "Bord">Bord</option>
						<option value = "Lampe">Lampe</option>
					</select></p>
		<p>Starttid på auktion 	: <input type = "datetime-local" name = "starttime"></p>
		<p>Sluttid på auktion 	: <input type = "datetime-local" name = "endtime"></p>
		<p>Beskrivelse		: <textarea rows = "4" cols = "20"  name = "beskrivelse"></textarea></p>
  <input hidden type = "text" name = "usersid" value = <?php echo $_SESSION['userid']; ?>>
	<input type = "submit" value = "Tilføj produkt">
  </div>

</form>

</body>
</html>
