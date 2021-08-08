<?php
include("functions.php");
include_once("auktionsdb.php");

	date_default_timezone_set("Europe/Copenhagen");
	$produktnavn = $_POST['pname'];
	$seller_id = $_POST['usersid'];
	$startbud = $_POST['startbud'];
	$kategori = $_POST['kategori'];
	$sales_s_time = $_POST['starttid'];
	$sales_e_time = $_POST['sluttid'];
	$beskrivelse = $_POST['beskrivelse'];

	global $conn;
	$conn = $conn;

	$time_trackID = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM time_track")) + 1;
	echo "$time_trackID"."<br>";
	$sql = "INSERT INTO time_track VALUES ('$time_trackID', '$sales_s_time', '$sales_e_time')";
	$sql_exec = mysqli_query($conn, $sql);

	$product_id = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product")) + 1;
	echo "$product_id"."<br>";
	$sql = "INSERT INTO product VALUES ('$product_id', '$produktnavn', '$kategori', '$beskrivelse', '$seller_id', '$startbud')";
	$sql_exec = mysqli_query($conn, $sql);

	$salgs_id = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM sales")) + 1;

	$sales_s_datetime = new DateTime($sales_s_time);
  $sales_e_datetime = new DateTime($sales_e_time);
  $now_datetime = new DateTime();

	$sales_s_datetime = $sales_s_datetime->format('%H:%I:%S');
	$sales_e_datetime = $sales_e_datetime->format('%H:%I:%S');
	$now_datetime = $now_datetime->format('%H:%I:%S');


	echo "$sales_s_time"." "."$sales_e_time "."$now_datetime"."<br>";
	if($sales_s_time > $now_datetime)
	{
		$status = "Ingen bud";
	}
	else if($sales_s_time <= $date && $sales_e_time >= $now_datetime)
	{
		$status = "Igangværende";
	}
	else if($sales_e_time < $now_datetime)
	{
		$status = "Slut";
	}
	$sql1 = "INSERT INTO sales VALUES ('$salgs_id', '$status', '$startbud', '$seller_id', '$product_id', '$seller_id', '$time_trackID')";
	$sql_exec1 = mysqli_query($conn, $sql1);
	if($sql_exec && $sql_exec1)
	{
		echo "Tilføjet";
		header("Location: auktionsside.php");
	}

?>
