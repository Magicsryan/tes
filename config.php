<?php

$servername= "localhost";
$username = "root";
$password = "";
$database= "travelin";

$link = mysqli_connect($servername, $username, $password, $database);

if (!$link) {
    die("KONEKSI GAGAL: " .mysqli_connect_error());
  }
 
?>