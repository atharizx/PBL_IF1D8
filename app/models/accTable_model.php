<?php

function takeDataAccountHandler($conn) {
    // deafult value untuk variabel data
    $data = [];
    $role = "dosen";

    $query = "SELECT * FROM adminlog WHERE role='$role'";

    // Eksekusi query
    $result = mysqli_query($conn, $query);

    // Mengambil data dari hasil eksekusi query
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    // Mengembalikan data yang telah diambil
    return $data;
}

