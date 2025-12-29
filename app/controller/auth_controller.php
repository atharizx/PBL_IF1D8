<?php
session_start();
include '../config/db_conn.php';
include '../models/auth_model.php';

// Mengambil Value yang di inputkan user
$nidn = $_POST['nidn'];
$pass = $_POST['pass'];

// Mengecek Keberadaan User di Database
$result = authDataSelect($conn, $nidn, $pass);

// Branching berdasarkan hasil pengecekan
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);

    $_SESSION['nidn'] = $row['nidn'];
    $_SESSION['nama'] = $row['nama'];
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['role'] = $row['role'];
     
// Pembuatan Session untuk alert
    $_SESSION['login_success'] = "Selamat Datang " . $_SESSION['nama'] . "!";
    
    if ($_SESSION['role'] == 'dosen') {
        header("Location: ../../public/admin/penerbitan.php");
    } else {
        header("Location: ../../public/admin/tambahAkun.php");
    }
    exit();

} else {
    $_SESSION['login_error'] = "NIDN atau Password Salah.";
    header("Location: ../../public/admin/loginpage.php");
    exit();
}
