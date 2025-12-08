<?php
session_start();
require_once '../config/db_conn.php';
require_once '../helper/upload_helper.php';


if (!isset($_POST['submitBeasiswa'])) {
    header("Location: ../../public/admin/penerbitan.php");
    exit();
}

$namaBeasiswa    = $_POST['namaBeasiswa'] ?? '';
$deskripsiBeasiswa = $_POST['deskripsiBeasiswa'] ?? '';
$masaBerlakuBeasiswa = $_POST['masaBerlakuBeasiswa'] ?? '';
$linkpendaftaran = $_POST['linkBeasiswa'] ?? '';
$fotoBeasiswa = $_FILES['gambarBeasiswa'] ?? null;

$errorBeasiswa = [];
$errorSizeBeasiswa = [];
$errorTypeBeasiswa = [];
$maxSizeBeasiswa = 5 * 1024 * 1024;
$helperAlertBeasiswa = "tidak boleh kosong! Mohon isi input tersebut";
$helperAlertSizeBeasiswa = "Melebihi Batas Ukuran";
$helperAlertTypeBeasiswa = "Jenis file tidak dapat diterima";
$allowedImgBeasiswa = ['png','jpeg','jpg'];

// VALIDASI TEKS
if (empty(trim($namaBeasiswa))) $errorBeasiswa[] = "<b>Judul</b>";
if (empty(trim($deskripsiBeasiswa)))    $errorBeasiswa[] = "<b>Deskripsi</b>";
if (empty(trim($masaBerlakuBeasiswa)))  $errorBeasiswa[] = "<b>Masa Berlaku</b>";
if (empty(trim($linkpendaftaran))) $errorBeasiswa[] = "<b>Link Pendaftaran</b>";

// VALIDASI FILE
$isUploadImg = $fotoBeasiswa && $fotoBeasiswa['error'] === 0;
if ($isUploadImg) {
    if ($fotoBeasiswa['size'] > $maxSizeBeasiswa) $errorSizeBeasiswa[] = "<b>Foto Beasiswa</b>";
    $extImg = strtolower(pathinfo($fotoBeasiswa['name'], PATHINFO_EXTENSION));
    if (!in_array($extImg, $allowedImgBeasiswa)) $errorTypeBeasiswa[] = "<b>Foto Beasiswa</b>";
}

// Respond Session Error
if (!empty($errorBeasiswa)) {
    $_SESSION['msg_empty_beasiswa'] = "Input " . implode(", ", $errorBeasiswa) . " " . $helperAlertBeasiswa;
    header("Location: ../../public/admin/penerbitan.php");
    exit();
}
if ($errorSizeBeasiswa) {
    $_SESSION['msg_size_beasiswa'] = implode(", ", $errorSizeBeasiswa) . " " . $helperAlertSizeBeasiswa . "!";
    header("Location: ../../public/admin/penerbitan.php");
    exit();
}
if ($errorTypeBeasiswa) {
    $_SESSION['msg_type_beasiswa'] = implode(", ", $errorTypeBeasiswa) . " " . $helperAlertTypeBeasiswa . "!";
    header("Location: ../../public/admin/penerbitan.php");
    exit();
}

// Proses Penggantian Nama File

// File Foto (Jika Ada)
if ($isUploadImg) {
    $fotoBeasiswaNewName = uploadFile($fotoBeasiswa, "../../public/upload/beasiswa/img/", "gambarBeasiswa");
} else {
    $fotoBeasiswaNewName = null;
}

require_once '../models/upload_model.php';

$data = [
    'namabeasiswa' => $namaBeasiswa,
    'deskripsi'    => $deskripsiBeasiswa,
    'masaberlaku'  => $masaBerlakuBeasiswa,
    'linkpendaftaran' => $linkpendaftaran,
    'fotobeasiswa' => $fotoBeasiswaNewName,
];

$insertBeasiswa = storeData($conn, "beasiswa", $data);

if ($insertBeasiswa) {
    $_SESSION['msg_success_beasiswa'] = "Informasi Beasiswa Berhasil Ditambahkan.";
} else {
    $_SESSION['msg_error_beasiswa'] = "Gagal Menambahkan Informasi.";
}

header("Location: ../../public/admin/penerbitan.php");
exit();

$conn->close();
