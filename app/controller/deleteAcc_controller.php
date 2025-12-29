<?php
session_start();
include '../config/db_conn.php';
include '../models/deleteAcc_model.php';

$id = $_GET['id'];

$result = deleteAcc($conn, $id);

if ($result) {
    $_SESSION['msg_success_delAcc'] = "Berhasil menghapus akun!";
}
else {
    $_SESSION['msg_error_delAcc'] = "Gagal Menghapus akun, coba lagi setelah beberapa menit";
}

header("Location: ../../public/admin/tambahAkun.php");
exit();

mysqli_close($conn);

?>