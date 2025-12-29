<?php
session_start();
include '../config/db_conn.php';
include '../models/editInformation_model.php';

if (!isset($_POST['submitBeasiswa'])) {
    header("Location: ../../public/admin/penerbitan.php");
    exit();
}

$id = $_POST['id'];
$type = "beasiswa";

// Mengambil Data yang di input oleh user
$namaBeasiswa    = $_POST['namaBeasiswa'] ?? '';
$deskripsiBeasiswa = $_POST['deskripsiBeasiswa'] ?? '';
$masaBerlakuBeasiswa = $_POST['masaBerlakuBeasiswa'] ?? '';
$linkpendaftaran = $_POST['linkBeasiswa'] ?? '';
$fotoBeasiswa = $_FILES['gambarBeasiswa'] ?? null;

// Variable Pembantu untuk output Validasi
$helperAlertBeasiswa = "tidak boleh kosong! Mohon isi input tersebut";
$helperAlertSizeBeasiswa = "Melebihi Batas Ukuran";
$helperAlertTypeBeasiswa = "Jenis file tidak dapat diterima";
$errorBeasiswa = [];
$errorSizeBeasiswa = [];
$errorTypeBeasiswa = [];

// Variable Pembantu Untuk Validasi File jika type tidak dikenal
$strImgName = $fotoBeasiswa['name'];
$isUploadImg = $fotoBeasiswa && $fotoBeasiswa['error'] === 0;
$xFoto = explode('.', $fotoBeasiswa['name']);
$extImg = strtolower(end($xFoto));

// Ketentuan Penyimpanan File Img
$maxSizeImgBeasiswa = 2000000;
$allowedImgBeasiswa = array('png', 'jpeg', 'jpg');

// Mengisi Array Error jika ada inputan yang kosong
if (empty(trim($namaBeasiswa))) $errorBeasiswa[] = "<b>Judul</b>";
if (empty(trim($deskripsiBeasiswa))) $errorBeasiswa[] = "<b>Deskripsi</b>";
if (empty(trim($masaBerlakuBeasiswa))) $errorBeasiswa[] = "<b>Masa Berlaku</b>";
if (empty(trim($linkpendaftaran))) $errorBeasiswa[] = "<b>Link Pendaftaran</b>";

// Mengisi Array Error untuk file img jika ada file yang diupload melebihi batas ukuran atau bukan tipe yang diijinkan
if ($isUploadImg) {
    if ($fotoBeasiswa['size'] > $maxSizeImgBeasiswa) $errorSizeBeasiswa[] = "<b>Foto Beasiswa</b>";
    if (!in_array($extImg, $allowedImgBeasiswa)) $errorTypeBeasiswa[] = "<b>Foto Beasiswa</b>";
    move_uploaded_file($fotoBeasiswa['tmp_name'], '../../public/upload/beasiswa/img/' . $strImgName);
}

// Main branching
if (!empty($errorBeasiswa)) {
    $_SESSION['msg_empty_beasiswa'] = "Input " . implode(", ", $errorBeasiswa) . " " . $helperAlertBeasiswa;
    header("Location: ../../public/admin/penerbitan.php?noinformasi=$id&type=$type");
    exit();
}
if ($errorSizeBeasiswa) {
    $_SESSION['msg_size_beasiswa'] = implode(", ", $errorSizeBeasiswa) . " " . $helperAlertSizeBeasiswa . "!";
    header("Location: ../../public/admin/penerbitan.php?noinformasi=$id&type=$type");
    exit();
}
if ($errorTypeBeasiswa) {
    $_SESSION['msg_type_beasiswa'] = implode(", ", $errorTypeBeasiswa) . " " . $helperAlertTypeBeasiswa . "!";
    header("Location: ../../public/admin/penerbitan.php?noinformasi=$id&type=$type");
    exit();
}

$data = [
    'namabeasiswa' => $namaBeasiswa, 
    'masaberlaku' => $masaBerlakuBeasiswa, 
    'deskripsi' => $deskripsiBeasiswa, 
    'linkpendaftaran' => $linkpendaftaran, 
    'fotobeasiswa' => $strImgName, 
    'user_id' => $user_id
];

$result = editInformationData($conn, $data, 'beasiswa', $id);

if ($result) {
    $_SESSION['msg_success_beasiswa'] = "Perubahan Informasi Beasiswa berhasil disimpan.";
} else {
    $_SESSION['msg_error_beasiswa'] = "Gagal menambahkan informasi, Harap mencoba lagi setelah beberapa menit.";
}

header("Location: ../../public/admin/riwayat.php");
exit();

mysqli_close($conn);
