<?php

function addAccountHandler($conn, $nama, $nidn, $pw, $role) {
    $query = "INSERT INTO adminlog (nidn, nama, pw, role, waktupenambahan)
     VALUES ('$nidn', '$nama', '$pw', '$role', NOW())";

    $queryRun = mysqli_query($conn, $query);

    return $queryRun;
}

function checkAccountData($conn, $nama, $nidn) {
    $query = "SELECT nama, nidn FROM adminlog WHERE nama = '$nama' OR nidn = '$nidn'";

    $queryRun = mysqli_query($conn, $query);

    return $queryRun;
}

?>
