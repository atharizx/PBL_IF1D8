<?php
session_start();
require_once '../config/db_conn.php';
require_once '../helper/upload_helper.php';


if (!isset($_POST['submitJadwal'])) {
    header("Location: ../../public/admin/penerbitan.php");
    exit();
}

$judulJadwal   = $_POST['judulJadwal'] ?? '';
$deskripsiJadwal = $_POST['deskripsiJadwal'] ?? '';
$masaBerlakuJadwal = $_POST['masaBerlakuJadwal'] ?? '';
$jurusanJadwal = $_POST['jurusanJadwal'] ?? '';
$fotoJadwal   = $_FILES['gambarJadwal'] ?? null;
$excelJadwal  = $_FILES['excelJadwal'];

$errorJadwal = [];
$errorSizeJadwal = [];
$errorTypeJadwal = [];
$maxSizeJadwal = 5 * 1024 * 1024;
$helperAlertJadwal = "tidak boleh kosong! Mohon isi input tersebut";
$helperAlertSizeJadwal = "Melebihi Batas Ukuran";
$helperAlertTypeJadwal = "Jenis file tidak dapat diterima";
$allowedImgJadwal = ['png', 'jpeg', 'jpg'];
$allowedExlJadwal = ['xls', 'xlsx'];

// VALIDASI TEKS
if (empty(trim($judulJadwal))) $errorJadwal[] = "<b>Judul </b>";
if (empty(trim($deskripsiJadwal)))    $errorJadwal[] = "<b>Deskripsi </b>";
if (empty(trim($masaBerlakuJadwal)))  $errorJadwal[] = "<b>Masa Berlaku </b>";
if (empty(trim($jurusanJadwal))) $errorJadwal[] = "<b>Jurusan </b>";

// VALIDASI FILE
if ($excelJadwal['error'] === 4) $errorJadwal[] = "<b>File Excel</b>";

$extExcel = strtolower(pathinfo($excelJadwal['name'], PATHINFO_EXTENSION));
if (!in_array($extExcel, $allowedExlJadwal)) $errorTypeJadwal[] = "<b>File Excel </b>";
if ($excelJadwal['size'] > $maxSizeJadwal) $errorSizeJadwal[] = "<b>File Excel </b>";


$isUploadImg = $fotoJadwal && $fotoJadwal['error'] === 0;
if ($isUploadImg) {
    if ($fotoJadwal['size'] > $maxSizeJadwal) $errorSizeJadwal[] = "<b>Foto Jadwal </b>";
    $extImg = strtolower(pathinfo($fotoJadwal['name'], PATHINFO_EXTENSION));
    if (!in_array($extImg, $allowedImgJadwal)) $errorTypeJadwal[] = "<b>Foto Jadwal </b>";
}

// RESPOND ERROR SESSION
if (!empty($errorJadwal)) {
    $_SESSION['msg_empty_jadwal'] = "Input " . implode(", ", $errorJadwal) . " " . $helperAlertJadwal;
    header("Location: ../../public/admin/penerbitan.php");
    exit();
}
if ($errorSizeJadwal) {
    $_SESSION['msg_size_jadwal'] = implode(", ", $errorSizeJadwal) . " " . $helperAlertSizeJadwal . "!";
    header("Location: ../../public/admin/penerbitan.php");
    exit();
}
if ($errorTypeJadwal) {
    $_SESSION['msg_type_jadwal'] = implode(", ", $errorTypeJadwal) . " " . $helperAlertTypeJadwal . "!";
    header("Location: ../../public/admin/penerbitan.php");
    exit();
}
$excelJadwalNewName = uploadFile($excelJadwal, "../../public/upload/jadwalUjian/excel/", "ExceljadwalUjian");
// UPLOAD FILE (HANYA JIKA ADA)
if ($isUploadImg) {
    $fotoJadwalNewName = uploadFile($fotoJadwal, "../../public/upload/jadwalUjian/img/", "gambarJadwal");
} else {
    $fotoJadwalNewName = null;
}

require_once '../models/upload_model.php';

$data = [
    'judul' => $judulJadwal,
    'deskripsi'    => $deskripsiJadwal,
    'masaberlaku'  => $masaBerlakuJadwal,
    'jurusan' => $jurusanJadwal,
    'fotojadwal' => $fotoJadwalNewName,
    'exceljadwal' => $excelJadwalNewName
];

$insertJadwal = storeData($conn, "jadwalujian", $data);

if ($insertJadwal) {
    $_SESSION['msg_success_jadwal'] = "Informasi jadwal Berhasil Ditambahkan.";
} else {
    $_SESSION['msg_error_jadwal'] = "Gagal Menambahkan Informasi.";
}

header("Location: ../../public/admin/penerbitan.php");
exit();

$conn->close();
