<?php
session_start();
include '../config/db_conn.php';
include '../models/editInformation_model.php';

if (!isset($_POST['submitJadwal'])) {
    header("Location: ../../public/admin/penerbitan.php");
    exit();
}

$id = $_POST['id'];
$type = "jadwalujian";
// Mengambil Data yang di input oleh user

// Text
$judulJadwal   = $_POST['judulJadwal'] ?? '';
$deskripsiJadwal = $_POST['deskripsiJadwal'] ?? '';
$masaBerlakuJadwal = $_POST['masaBerlakuJadwal'] ?? '';
$jurusanJadwal = $_POST['jurusanJadwal'] ?? '';

// File
$fotoJadwal   = $_FILES['gambarJadwal'] ?? null;
$excelJadwal  = $_FILES['excelJadwal'];

// Variable Pembantu untuk output Validasi
$errorJadwal = [];
$errorSizeJadwal = [];
$errorTypeJadwal = [];
$helperAlertJadwal = "tidak boleh kosong! Mohon isi input tersebut";
$helperAlertSizeJadwal = "Melebihi Batas Ukuran";
$helperAlertTypeJadwal = "Jenis file tidak dapat diterima";

// Ketentuan Penyimpanan File
$maxSizeImgJadwal = 2000000;
$maxSizeExlJadwal = 3000000;
$allowedImgJadwal = array('png', 'jpeg', 'jpg');
$allowedExlJadwal = array('xls', 'xlsx');

// Variable Pembantu Untuk Validasi File jika type tidak dikenal
$strImgName = $fotoJadwal['name'];
$strExcelName = $excelJadwal['name'];
$isUploadImg = $fotoJadwal && $fotoJadwal['error'] === 0;
$xImg = explode('.', $fotoJadwal['name'] ?? '');
$xExcel = explode('.', $excelJadwal['name']);
$extImg = strtolower(end($xImg));
$extExcel = strtolower(end($xExcel));

// VALIDASI TEKS
if (empty(trim($judulJadwal))) $errorJadwal[] = "<b>Judul </b>";
if (empty(trim($deskripsiJadwal)))    $errorJadwal[] = "<b>Deskripsi </b>";
if (empty(trim($masaBerlakuJadwal)))  $errorJadwal[] = "<b>Masa Berlaku </b>";
if (empty(trim($jurusanJadwal))) $errorJadwal[] = "<b>Jurusan </b>";

// VALIDASI FILE
if ($excelJadwal['error'] === 4) $errorJadwal[] = "<b>File Excel</b>";
if ($excelJadwal['size'] > $maxSizeExlJadwal) $errorSizeJadwal[] = "<b>File Excel </b>";
if (!in_array($extExcel, $allowedExlJadwal)) $errorTypeJadwal[] = "<b>File Excel </b>";
move_uploaded_file($excelJadwal['tmp_name'], '../../public/upload/jadwalUjian/excel/' . $strExcelName);

if ($isUploadImg) {
    if ($fotoJadwal['size'] > $maxSizeImgJadwal) $errorSizeJadwal[] = "<b>Foto Jadwal </b>";
    if (!in_array($extImg, $allowedImgJadwal)) $errorTypeJadwal[] = "<b>Foto Jadwal </b>" ?? null;
    move_uploaded_file($fotoJadwal['tmp_name'], '../../public/upload/jadwalUjian/img/' . $strImgName);
}

// Main branch untuk pengecekan error 
if (!empty($errorJadwal)) {
    $_SESSION['msg_empty_jadwal'] = "Input " . implode(", ", $errorJadwal) . " " . $helperAlertJadwal;
    header("Location: ../../public/admin/penerbitan.php?noinformasi=$id&type=$type");
    exit();
}
if ($errorSizeJadwal) {
    $_SESSION['msg_size_jadwal'] = implode(", ", $errorSizeJadwal) . " " . $helperAlertSizeJadwal . "!";
    header("Location: ../../public/admin/penerbitan.php?noinformasi=$id&type=$type");
    exit();
}
if ($errorTypeJadwal) {
    $_SESSION['msg_type_jadwal'] = implode(", ", $errorTypeJadwal) . " " . $helperAlertTypeJadwal . "!";
    header("Location: ../../public/admin/penerbitan.php?noinformasi=$id&type=$type");
    exit();
}

$data = [
    'judul' => $judulJadwal,
    'masaberlaku' => $masaBerlakuJadwal,
    'deskripsi' => $deskripsiJadwal,
    'jurusan' => $jurusanJadwal,
    'exceljadwal' => $strExcelName,
    'fotojadwal' => $strImgName,
];

$result = editInformationData($conn, $data, 'jadwalujian', $id);

if ($result) {
    $_SESSION['msg_success_jadwal'] = "Perubahan informasi jadwal Ujian berhasil di simpan.";
} else {
    $_SESSION['msg_error_jadwal'] = "Gagal menyimpan data, Harap mencoba lagi setelah beberapa menit.";
}

header("Location: ../../public/admin/riwayat.php");
exit();

mysqli_close($conn);
