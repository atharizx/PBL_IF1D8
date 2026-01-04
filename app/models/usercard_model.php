<?php

// Function Untuk Mengambil Data dari database berdasarkan tabel, data yang diperlukan, dan filter tertentu
function takeData($conn, $table, $data, $filter) {
    // Menyiapkan query untuk mengambil data
    $query = "SELECT $data FROM $table WHERE $filter ORDER BY id DESC";
    
    // Eksekusi query
    $queryRun = mysqli_query($conn, $query);
    $rows = [];
    
    // Mengambil data dari hasil eksekusi query
    if ($queryRun) {
        while ($row = mysqli_fetch_assoc($queryRun)) {
            $rows[] = $row;
        }
    }
    
    return $rows;
}

// Function Untuk mengambil data berdasarkan pencarian yang di input user
function searchDataHandler($conn, $table, $data, $value) {
    // menyiapkan query untuk mengambil data berdasarkan pencarian
    $query = "SELECT $data FROM $table WHERE $value";
    // Eksekusi query
    $queryRun = mysqli_query($conn, $query);

    // Mengambil data dari hasil eksekusi query
    $result = [];
    if ($queryRun) {
        while ($row = mysqli_fetch_assoc($queryRun)) {
            $result[] = $row;
        }
    }
    return $result;
}
