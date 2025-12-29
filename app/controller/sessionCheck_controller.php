<?php

function sessionCheckHandler() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: loginpage.php");
        exit();
    }
}

function roleCheckHandlerAtPenerbitan() {
    if ($_SESSION['role'] == 'admin') {
        $_SESSION['wrong_role_permission'] = "Anda tidak diperbolehkan masuk ke halaman ini!";
        header("Location: loginpage.php");
        exit();
    }
}

function roleCheckHandlerAtTambahAkun() {
    if ($_SESSION['role'] == 'dosen') {
        $_SESSION['wrong_role_permission'] = "Anda tidak diperbolehkan masuk ke halaman ini!";
        header("Location: loginpage.php");
        exit();
    }
}