<?php
session_start();
require_once '../config/db_conn.php';
require_once '../helper/upload_helper.php';


if (!isset($_POST['submitKelas'])) {
    header("Location: ../../public/admin/penerbitan.php");
    exit();
}
// INPUT TEXT
$judulKelas   = $_POST['judulKelas'] ?? '';
$deskripsiKelas = $_POST['deskripsiKelas'] ?? '';
$masaBerlakuKelas = $_POST['masaBerlakuKelas'] ?? '';
$jurusanKelas = $_POST['jurusanKelas'] ?? '';
//INPUT FILE
$fotoKelas   = $_FILES['gambarKelas'] ?? null;
$excelKelas  = $_FILES['excelKelas'];

$errorKelas = [];
$errorSizeKelas = [];
$errorTypeKelas = [];
$maxSizeKelas = 5 * 1024 * 1024;
$helperAlertKelas = "tidak boleh kosong! Mohon isi input tersebut";
$helperAlertSizeKelas = "Melebihi Batas Ukuran";
$helperAlertTypeKelas = "Jenis file tidak dapat diterima";
$allowedImgKelas = ['png', 'jpeg', 'jpg'];
$allowedExlKelas = ['xls', 'xlsx'];

// VALIDASI TEKS
if (empty(trim($judulKelas))) $errorKelas[] = "<b>Judul</b>";
if (empty(trim($deskripsiKelas))) $errorKelas[] = "<b>Deskripsi</b>";
if (empty(trim($masaBerlakuKelas))) $errorKelas[] = "<b>Masa Berlaku</b>";
if (empty(trim($jurusanKelas))) $errorKelas[] = "<b>Jurusan</b>";

// VALIDASI FILE

//Validasi Excel
$extExcel = strtolower(pathinfo($excelKelas['name'], PATHINFO_EXTENSION));
if ($excelKelas['error'] === 4) $errorKelas[] = "<b>File Excel</b>";
if (!in_array($extExcel, $allowedExlKelas)) $errorTypeKelas[] = "<b>File Excel</b>";
if ($excelKelas['size'] > $maxSizeKelas) $errorSizeKelas[] = "<b>File Excel</b>";

//Validasi Foto Thumbnail
$isUploadImg = $fotoKelas && $fotoKelas['error'] === 0;
if ($isUploadImg) {
    if ($fotoKelas['size'] > $maxSizeKelas) $errorSizeKelas[] = "<b>File Foto</b>";
    $extImg = strtolower(pathinfo($fotoKelas['name'], PATHINFO_EXTENSION));
    if (!in_array($extImg, $allowedImgKelas)) $errorTypeKelas[] = "<b>File Foto</b>";
}

// LOGIC ERROR SESSION
if (!empty($errorKelas)) {
    $_SESSION['msg_empty_kelas'] = "Input " . implode(", ", $errorKelas) . " " . $helperAlertKelas;
    header("Location: ../../public/admin/penerbitan.php");
    exit();
}
if ($errorSizeKelas) {
    $_SESSION['msg_size_kelas'] = implode(", ", $errorSizeKelas) . " " . $helperAlertSizeKelas . "!";
    header("Location: ../../public/admin/penerbitan.php");
    exit();
}
if ($errorTypeKelas) {
    $_SESSION['msg_type_kelas'] = implode(", ", $errorTypeKelas) . " " . $helperAlertTypeKelas . "!";
    header("Location: ../../public/admin/penerbitan.php");
    exit();
}

// Proses Mengganti Nama File

// File Excel
$excelKelasNewName = uploadFile($excelKelas, "../../public/upload/perubahanKelas/excel/", "ExcelPerubahanKelas");

// File Foto (Jika Ada)
if ($isUploadImg) {
    $fotoKelasNewName = uploadFile($fotoKelas, "../../public/upload/perubahanKelas/img/", "FotoPerubahanKelas");
} else {
    $fotoKelasNewName = null;
}

require_once '../models/upload_model.php';

$data = [
    'judul' => $judulKelas,
    'deskripsi'    => $deskripsiKelas,
    'masaberlaku'  => $masaBerlakuKelas,
    'jurusan' => $jurusanKelas,
    'fotokelas' => $fotoKelasNewName,
    'excelkelas' => $excelKelasNewName
];

$insertKelas = storeData($conn, "perubahankelas", $data);

if ($insertKelas) {
    $_SESSION['msg_success_kelas'] = "Informasi Perubahan Kelas Berhasil Ditambahkan.";
} else {
    $_SESSION['msg_error_kelas'] = "Gagal Menambahkan Informasi.";
}

header("Location: ../../public/admin/penerbitan.php");
exit();

$conn->close();
