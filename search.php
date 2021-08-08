<?php
$title = "IKEA Auction - Search";
 include("functions.php");
 include("header.php");

	$sql = $_GET['produktnavn'];

	$min_length = 3;

	if(strlen($sql) >= $min_length){

		$sql = mysqli_real_escape_string($conn , $sql);

		$raw_results = mysqli_query($conn , "SELECT product.produktnavn, product.beskrivelse, product.product_id, sales.salgs_id FROM product , sales
			WHERE (`produktnavn` LIKE '%".$sql."%' AND product.product_id = sales.salgs_id) OR (`beskrivelse` LIKE '%".$sql."%' AND product.product_id = sales.salgs_id)");


		if(mysqli_num_rows($raw_results) > 0){

			while($results = mysqli_fetch_array($raw_results)){

				echo "<p class='ml-4'><h3 class='ml-4'>".$results['produktnavn']."</h3><p class='ml-4'>" .$results['beskrivelse'] . "</p>" .'<form method = "post" action = "produktdetaljer.php"><button name = "details" class="btn btn-warning ml-4" type = "submit" value = ' . $results['salgs_id'] . '>Details</button></form></p>';
			}

		}
		else{
			echo "No results";
		}

	}
	else{
		echo "Minimum length is ".$min_length;
	}
  echo "<form method = 'post' action = 'auktionsside.php'><button name = 'details' class='btn btn-warning ml-4 my-4' type = 'submit'>Go back</button></form>";
?>
