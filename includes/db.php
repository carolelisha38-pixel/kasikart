<?php

$host = "sql203.infinityfree.com";
$username = "if0_42015267";
$password = "MICasa200531";
$database = "if0_42015267_kasikart";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Database connection failed " . mysqli_connect_error());

}

?>