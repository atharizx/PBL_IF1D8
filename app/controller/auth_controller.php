<?php
include '../config/db_conn.php';
session_start();

$nidn = $_POST['nidn'];
$password = $_POST['pass'];

$stmt = $conn->prepare("SELECT nidn, pw, nama FROM adminlog WHERE nidn = ?");
$stmt->bind_param("s", $nidn);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($db_nidn, $db_pw, $db_nama); 
    $stmt->fetch();

    if ($password === $db_pw) {
        $_SESSION['nidn'] = $db_nidn;
        $_SESSION['nama'] = $db_nama;

        $_SESSION['login_success'] = "Selamat Datang " . $_SESSION['nama'] ."!";

        header("Location: ../../public/admin/penerbitan.php");
        exit();
    } else {
        $_SESSION['login_error'] = "NIDN atau Password salah.";
        header("Location: ../../public/admin/loginpage.php");
        exit();
    }

}
$stmt -> close();
$conn -> close();

?>
   

