<?php
session_start()
include "db_conn.php";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin" === true]) {
    header("Location : /Frontend/Section-dosen/penerbitan.php")
    exit;
}

$nidn = $pass = "";
$nidn_err = $pass_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")[
    if(empty(trim($_POST["nidn"]))) {
        $nidn_err = "NIDN Belum terisi";
    } else {
        $nidn = trim($_POST["nidn"]);
    }

    if(empty(trim($_POST["pw"]))) {
        $pass_err = "Password Belum terisi";
    } else {
        $pass = trim($_POST["pass"]);
    }

    if (empty($nidn_err) && empty($pass_err)) {
        $sql = "SELECT id, nidn, pw, nama FROM login_system WHERE nidn = "$nidn" AND pw = "$pass""

    }
]
?>
