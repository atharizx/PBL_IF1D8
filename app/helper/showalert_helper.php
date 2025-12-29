<?php 

// Function Pembantu Untuk Menampilkan Alert pada penerbitan.php dan riwayat.php
function showAlertJadwal() {
    alertWithoutBtn('msg_success_jadwal', 'success', 'Berhasil!');
    alertWithoutBtn('msg_error_jadwal', 'error', 'Gagal');
    alertWithoutBtn('msg_empty_jadwal', 'warning', 'Peringatan!');
    alertWithoutBtn('msg_size_jadwal', 'warning', 'Peringatan!');
    alertWithoutBtn('msg_type_jadwal', 'warning', 'Peringatan!');
}

function showAlertBeasiswa() {
    alertWithoutBtn('msg_success_beasiswa', 'success', 'Berhasil!');
    alertWithoutBtn('msg_error_beasiswa', 'error', 'Gagal');
    alertWithoutBtn('msg_empty_beasiswa', 'warning', 'Peringatan!');
    alertWithoutBtn('msg_size_beasiswa', 'warning', 'Peringatan!');
    alertWithoutBtn('msg_type_beasiswa', 'warning', 'Peringatan!');
}

function showAlertKelas() {
    alertWithoutBtn('msg_success_kelas', 'success', 'Berhasil!');
    alertWithoutBtn('msg_error_kelas', 'error', 'Gagal');
    alertWithoutBtn('msg_empty_kelas', 'warning', 'Peringatan!');
    alertWithoutBtn('msg_size_kelas', 'warning', 'Peringatan!');
    alertWithoutBtn('msg_type_kelas', 'warning', 'Peringatan!');
}

function showAlertEditAcc() {
    alertWithoutBtn('msg_success_editAcc', 'success', 'Berhasil!');
    alertWithoutBtn('msg_error_editAcc', 'error', 'Gagal');
}

function showAlertAddAcc() {
    alertWithoutBtn('msg_success_addAcc', 'success', 'Berhasil!');
    alertWithoutBtn('msg_error_addAcc', 'success', 'Gagal!');
}

function ShowAlertDelAcc() {
    alertWithoutBtn('msg_success_delAcc', 'success', 'Berhasil!');
    alertWithoutBtn('msg_error_delAcc', 'error', 'Gagal');
}

?>