<?php
session_start();
include '../config/db_conn.php';
include '../models/addAcc_model.php';

// Mengambil Value dari input admin
$nidn = $_POST['nidn'];
$nama = $_POST['nama'];
$pw = $_POST['pass'];
$role = "dosen";

// Query untuk mengecek nama dan nidn yang sudah di pakai
$checkResult = checkAccountData($conn, $nama, $nidn);

// Default value untuk variable pengecekan nama dan nidn yang sudah dipakai
$nidnUsed = false;
$namaUsed = false;

// Branching menghitung jumlah karakter pada nidn(10 Char)
if (strlen($nidn) > 10 ) {
    $_SESSION['nidn_too_much'] = "NIDN Tidak boleh melebihi 10 karakter";
    header("Location: ../../public/admin/tambahAkun.php");
    exit();
} elseif (strlen($nidn) < 10) {
    $_SESSION['nidn_less_than_10'] = "NIDN Tidak boleh kurang dari 10 karakter";
    header("Location: ../../public/admin/tambahAkun.php");
    exit();
}

// Branching menghitung jumlah karakter pada password
if (strlen($pw) < 8) {
    $_SESSION['pw_less_than_8'] = "Password harus melebihi 8 karakter";
    header("Location: ../../public/admin/tambahAkun.php");
    exit();
}

// Branching Proses pengecekan nama dan nidn
while ($row = mysqli_fetch_assoc($checkResult)) {
    if ($row['nidn'] == $nidn) {
        $nidnUsed = true;
    }
    if ($row['nama'] == $nama) {
        $namaUsed = true;
    }
}

// Pembuatan session untuk alert
if ($nidnUsed) {
    $_SESSION['nidn_already_used'] = "NIDN sudah pernah digunakan pada akun yang lain!";
    header("Location: ../../public/admin/tambahAkun.php");
    exit();
} elseif ($namaUsed) {
    $_SESSION['nama_already_used'] = "Nama sudah pernah digunakan pada akun yang lain!";
    header("Location: ../../public/admin/tambahAkun.php");
    exit();
// Proses pembuatan akun jika akun lolos dari pengecekan nama dan nidn
} else {
    $result = addAccountHandler($conn, $nama, $nidn, $pw, $role);
    if ($result) {
        $_SESSION['msg_success_addAcc'] = "Berhasil menambahkan Akun Baru!";
    } else {
        $_SESSION['msg_error_addAcc'] = "Gagal menambahkan Akun baru, coba lagi setelah beberapa menit!";
    }
    header("Location: ../../public/admin/tambahAkun.php");
    exit();
}

mysqli_close($conn);
?>
