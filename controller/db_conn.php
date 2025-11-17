<?php
$server = "localhost";
$username   = "root";
$password   = "";
$db   = "login_system"; 

$conn = mysqli_connect($server, $username, $password, $db);

if (!$conn === false) {
    die("Koneksi gagal : " . mysqli_connect_error());
}

?>
