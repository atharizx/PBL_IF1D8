<?php

include '../config/db_conn.php';
include '../models/editAcc_model.php';

$id = $_POST['id'];
$nidnBaru = $_POST['nidn'];
$namaBaru = $_POST['nama'];
$pwBaru = $_POST['pass'];

$result = editDataAccount($conn, $namaBaru, $nidnBaru, $pwBaru, $id);

if ($queryRun) {
    $_SESSION['msg_success_editAcc'] = "Perubahan Data Akun berhasil disimpan!";
}
else {
    $_SESSION['msg_error_editAcc'] = "Gagal menyimoan perubahan data, harap coba lagi setelah beberapa menit.";
}

header("Location: ../../public/admin/tambahAkun.php");
exit();

mysqli_close($conn);
?>
