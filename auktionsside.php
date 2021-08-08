<?php

$title = "Auktions side";
include("functions.php");
require("header.php");

$status = setStatus();
$kategori = "";
$sorting = "";

if (isset($_GET["kategori"])) {
  $kategori = $_GET["kategori"];
}

if (isset($_GET["sorting"])) {
  $sorting = $_GET["sorting"];
}

$products = getProducts($kategori, $sorting);

$kategoriString = "";

if ($kategori != "") {
  $kategoriString = "kategori=$kategori&";
}

?>
<link rel="stylesheet" href="minside.css">
<body>
           		<form method = 'GET' action  = 'search.php'>
           			<input type = 'text' name = 'produktnavn' placeholder = 'Søgefelt'>
           			<button type = 'submit' name = 'search'>Søg</button>
           		</form>
         <li>
           <a href=auktionsside.php>Alle Auktioner</a>
         </li>
         <ul>
           <?php
           $kategories = getAllkategories();
           foreach ($kategories as $kategori) {
             echo "<li>";
             echo "<a href='?kategori={$kategori['kategori']}'>{$kategori['kategori']} ({$kategori['count']})</a>";
             echo "</li>";
           }
           ?>
         </ul>

         <ul>
         <p>Sorter:</p>
           <li>
             <?php  echo "<a href='?{$kategoriString}sorting=ASC'>Pris lav-høj</a>"; ?>
           </li>
           <li>
             <?php
             echo "<a href='?{$kategoriString}sorting=DESC'>Pris høj-lav</a>";
             ?>
           </li>
         </ul>

         <table class="content-table" style="
             width: 900px;
         "><tbody><tr><th>Produkt Navn</th><th>Nuværende bud</th><th>Status</th><th>Tid tilbage</th><th>Produkt Detaljer</th>
        <?php include("auktionsprodukt.php") ?>
              </table>
</body>
