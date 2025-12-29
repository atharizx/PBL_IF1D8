<?php
session_start();
include '../config/db_conn.php';
include '../models/editInformation_model.php';

if (!isset($_POST['submitKelas'])) {
    header("Location: ../../public/admin/penerbitan.php");
    exit();
}

$id = $_POST['id'];
$type = "perubahankelas";

// Mengambil Data yang di input oleh user
// Text
$judulKelas   = $_POST['judulKelas'] ?? '';
$deskripsiKelas = $_POST['deskripsiKelas'] ?? '';
$masaBerlakuKelas = $_POST['masaBerlakuKelas'] ?? '';
$jurusanKelas = $_POST['jurusanKelas'] ?? '';

// File
$fotoKelas   = $_FILES['gambarKelas'] ?? null;
$excelKelas  = $_FILES['excelKelas'];

// Variable Pembantu untu output validasi
$errorKelas = [];
$errorSizeKelas = [];
$errorTypeKelas = [];
$helperAlertKelas = "tidak boleh kosong! Mohon isi input tersebut";
$helperAlertSizeKelas = "Melebihi Batas Ukuran";
$helperAlertTypeKelas = "Jenis file tidak dapat diterima";

// variable Pembantu Untuk Validasi File
$strImgName = $fotoKelas['name'];
$strExcelName = $excelKelas['name'];
$isUploadImg = $fotoKelas && $fotoKelas['error'] === 0;
$xImg = explode('.', $fotoKelas['name'] ?? '');
$xExcel = explode('.', $excelKelas['name']);
$extImg = strtolower(end($xImg));
$extExcel = strtolower(end($xExcel));

// Ketentuan Penyimpanan File
$maxSizeImgKelas = 2000000;
$maxSizeExcelKelas = 3000000;
$allowedImgKelas = array('png', 'jpeg', 'jpg');
$allowedExcelKelas = array('xls', 'xlsx');

// Mengisi Data pada Array Variable Pembantu
if (empty(trim($judulKelas))) $errorKelas[] = "<b>Judul </b>";
if (empty(trim($deskripsiKelas))) $errorKelas[] = "<b>Deskripsi </b>";
if (empty(trim($masaBerlakuKelas))) $errorKelas[] = "<b>Masa Berlaku </b>";
if (empty(trim($jurusanKelas))) $errorKelas[] = "<b>Jurusan </b>";

// VALIDASI FILE
// Excel
if ($excelKelas['error'] === 4) $errorKelas[] = "<b>File Excel</b>";
if ($excelKelas['size'] > $maxSizeExcelKelas) $errorSizeKelas[] = "<b>File Excel </b>";
if(!in_array($extExcel, $allowedExcelKelas)) $errorTypeKelas[] = "<b>File Excel </b>";
move_uploaded_file($excelKelas['tmp_name'], '../../public/upload/jadwalUjian/excel/' . $strExcelName);

// Img
if ($isUploadImg) {
    if ($fotoKelas['size'] > $maxSizeKelas) $errorSizeKelas[] = "<b>Foto Jadwal </b>";
    if (!in_array($extImg, $allowedImgKelas)) $errorTypeKelas[] = "<b>Foto Jadwal </b>";
    move_uploaded_file($fotoKelas['tmp_name'], '../../public/upload/jadwalUjian/img/' . $strImgName);
}

// MAIN Branching
if (!empty($errorKelas)) {
    $_SESSION['msg_empty_kelas'] = "Input " . implode(", ", $errorKelas) . " " . $helperAlertKelas;
    header("Location: ../../public/admin/penerbitan.php?noinformasi=$id&type=$type");
    exit();
}
if ($errorSizeKelas) {
    $_SESSION['msg_size_kelas'] = implode(", ", $errorSizeKelas) . " " . $helperAlertSizeKelas . "!";
    header("Location: ../../public/admin/penerbitan.php?noinformasi=$id&type=$type");
    exit();
}

if ($errorTypeKelas) {
    $_SESSION['msg_type_kelas'] = implode(", ", $errorTypeKelas) . " " . $helperAlertTypeKelas . "!";
    header("Location: ../../public/admin/penerbitan.php?noinformasi=$id&type=$type");
    exit();
}

$data = [
    'judul' => $judulKelas, 
    'masaberlaku' => $masaBerlakuKelas, 
    'deskripsi' => $deskripsiKelas, 
    'jurusan' => $jurusanKelas, 
    'excelkelas' => $strExcelName, 
    'fotokelas' => $strImgName, 
];

$result = editInformationData($conn, $data, 'perubahankelas', $id);

if ($result) {
    $_SESSION['msg_success_kelas'] = "Perubahan Informasi Perubahan Kelas berhasil disimpan.";
} else {
    $_SESSION['msg_error_kelas'] = "Gagal menyimpan data,Harap mencoba lagi setelah beberapa menit.";
}

header("Location: ../../public/admin/riwayat.php");
exit();

mysqli_close($conn);
