<?php

date_default_timezone_set("Europe/Copenhagen");

function connect() {
    global $conn;
    $conn = mysqli_connect(DBHOST, DBUSER, DBPASS);

    if(!$conn) {
        die(mysqli_error($conn));
    }
    mysqli_select_db($conn, DBNAME);
}


function getUsers($email) {
    global $conn;
    $sql = 'SELECT * FROM users where email = "'. $email .'"';
    $result = mysqli_query($conn, $sql);
    $user = [];
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)) {
            $user[] = $row;
        }
    }
    return $user;
}


function setStatus(){
global $conn;
$sql = "SELECT * FROM sales, time_track  WHERE time_track.track_id = sales.tid_id";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
    $sales_s_time = $row['starttid'];
    $sales_e_time = $row['sluttid'];
    $salgs_id = $row['salgs_id'];

    $sales_s_datetime = new DateTime($sales_s_time);
    $sales_e_datetime = new DateTime($sales_e_time);
    $now_datetime = new DateTime();

    if($sales_s_datetime <= $now_datetime && $now_datetime <= $sales_e_datetime)
    {
        $sql = "UPDATE sales SET status = 'Igangværende' WHERE salgs_id = '$salgs_id'";
        mysqli_query($conn, $sql);
    }
    else if($now_datetime < $sales_s_datetime)
    {
        $sql = "UPDATE sales SET status = 'yet to bid' WHERE salgs_id = '$salgs_id'";
        mysqli_query($conn, $sql);
    }
    else
    {
        $sql = "UPDATE sales SET status = 'finished' WHERE salgs_id = '$salgs_id'";
        mysqli_query($conn, $sql);
    }
}
}

function getProducts($kategori, $sorting) {
global $conn;
$sql = "SELECT product.produktnavn, sales.current_bid, sales.status, time_track.starttid, time_track.sluttid, sales.salgs_id
			  FROM product, sales, time_track
				WHERE product.product_id = sales.salgs_id
        AND time_track.track_id = sales.tid_id AND sales.status IN ('Igangværende', 'yet to bid')";

        if ($kategori != "") {
          $sql = $sql . "AND product.kategori = '$kategori'";
        }

        if ($sorting != "") {
          $sql = $sql . "ORDER BY sales.current_bid $sorting";
        }

    $result = mysqli_query($conn, $sql);
		$products =	[];

    if(mysqli_num_rows($result)>0){
      while($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
      }
	  }

    return $products;
}


function getIdetails($salgs_id) {
global $conn;
$sql = "SELECT product.product_id, product.produktnavn, product.kategori, product.beskrivelse, product.seller_id,
        product.startbud, product.startbud, sales.status, sales.salgs_id, sales.current_bid, sales.current_bid_id, time_track.starttid, time_track.sluttid,
        users.usersid, users.usersName, users.usersUid
			  FROM product, sales, time_track, users
				WHERE salgs_id = '$salgs_id' AND product.product_id = sales.salgs_id
        AND time_track.track_id = sales.tid_id AND sales.current_bid_id = users.usersid";
$result = mysqli_query($conn, $sql);
$details =	[];

if(mysqli_num_rows($result)>0){
  while($row = mysqli_fetch_assoc($result)) {
        $details[] = $row;
  }
}

return $details;
}


function getAllkategories() {
  global $conn;
  $sql = "SELECT kategori, COUNT(kategori) AS count FROM product INNER JOIN sales ON product.product_id = sales.product_id where status != 'finished' GROUP BY kategori";
  $result = mysqli_query($conn, $sql);
  $kategories = [];
  if(mysqli_num_rows($result)>0) {
    while($row = mysqli_fetch_assoc($result)) {
      $kategories[] = $row;
    }
  }

  return $kategories;
}

function getUserAuctions($user) {
global $conn;
$sql = "SELECT product.produktnavn, sales.current_bid, sales.status, time_track.starttid, time_track.sluttid, sales.salgs_id, product.seller_id
			  FROM product
        INNER JOIN sales ON product.product_id = sales.product_id
        INNER JOIN time_track ON sales.tid_id = time_track.track_id
        WHERE sales.seller_id = '$user'";

    $result = mysqli_query($conn, $sql);
		$userAuctions =	[];

    if(mysqli_num_rows($result)>0){
      while($row = mysqli_fetch_assoc($result)) {
            $userAuctions[] = $row;
      }
	  }

    return $userAuctions;
}

function getUserBidAuctions($user) {
global $conn;
$sql = "SELECT product.produktnavn, sales.current_bid, sales.status, time_track.starttid, time_track.sluttid, sales.salgs_id, product.seller_id
			  FROM product
        INNER JOIN sales ON product.product_id = sales.product_id
        INNER JOIN time_track ON sales.tid_id = time_track.track_id
        WHERE sales.current_bid_id = '$user' AND sales.seller_id != '$user'";


    $result = mysqli_query($conn, $sql);
		$userBidAuctions =	[];

    if(mysqli_num_rows($result)>0){
      while($row = mysqli_fetch_assoc($result)) {
            $userBidAuctions[] = $row;
      }
	  }

    return $userBidAuctions;
}
