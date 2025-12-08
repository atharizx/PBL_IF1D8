<?php
require_once '../config/db_conn.php';
session_start();

$nidn = $_POST['nidn'];
$password = $_POST['pass'];

require_once '../models/auth_model.php';

$stmt = getAdminByNidn($conn, $nidn);

if ($stmt->num_rows === 1) {
    $stmt->bind_result($db_nidn, $db_pw, $db_nama, $db_id);
    $stmt->fetch();

    // Braching
    if ($password === $db_pw) {
        $_SESSION['nidn'] = $db_nidn;
        $_SESSION['nama'] = "<b>" . $db_nama . "</b>";
        $_SESSION['user_id'] = $db_id;

        $_SESSION['login_success'] = "Selamat Datang " . $_SESSION['nama'] . "!";
        header("Location: ../../public/admin/penerbitan.php");
        exit();
    } else {
        $_SESSION['login_error'] = "NIDN atau Password Salah.";
        header("Location: ../../public/admin/loginpage.php");
        exit();
    }
} else {
    $_SESSION['login_error'] = "NIDN atau Password Salah.";
    header("Location: ../../public/admin/loginpage.php");
    exit();
}

$stmt->close();
$conn->close();
