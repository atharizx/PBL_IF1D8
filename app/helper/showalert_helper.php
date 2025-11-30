<?php 
require_once 'alert_helper.php';

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
?>