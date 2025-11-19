<?php
include 'db_conn.php';
session_start();

$nidn = $_POST['nidn'];
$password = $_POST['pass'];

$sql = "SELECT * FROM adminlog WHERE nidn = '$nidn' AND pw = '$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    
    $_SESSION['nidn'] = $row['nidn'];
    $_SESSION['name'] = $row['nama'];

    $_SESSION['login_success'] = "Selamat datang " . $row['nama'];

    header("Location: ../public/admin/penerbitan.php");
    exit();

} else {
    $_SESSION['login_error'] = "NIDN atau Password salah.";
    header("Location: ../public/admin/loginpage.php");
    exit();
}
?>