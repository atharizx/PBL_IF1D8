<?php
session_start();
include '../config/db_conn.php';
include '../models/deleteInformation_model.php';

// Mengambil User ID dari Session dan ID dari GET
$userId = $_SESSION['user_id'];
$id = $_GET['id'] ?? null;
$type = $_GET['type'];

$result = deleteInformation($conn, $type, $id, $userId);

if ($result) {
    $_SESSION['msg_success_delBeasiswa'] = "Berhasil menghapus informasi";
}
else {
    $_SESSION['msg_error_delBeasiswa'] = "Gagal menghapus informasi, coba ulangi setelah beberapa menit";
}

header("Location: ../../public/admin/riwayat.php");
exit();

mysqli_close($conn);

?>