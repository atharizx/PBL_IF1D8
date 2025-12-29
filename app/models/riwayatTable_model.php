<?php

// Function Untuk Mengambil Data Riwayat Berdasarkan Tipe dan User ID
function takeDataForRiwayat($conn, $type, $userId, $filter) {
    // deafult value untuk variabel data
    $data = [];

    // Branching berdasarkan tipe untuk menentukan query yang akan dijalankan
    if ($type === "jadwalujian") {
        $query = "SELECT *, 'jadwalujian' AS tabel_asal, 'Jadwal Ujian' AS tipe_tampil 
                  FROM jadwalujian WHERE user_id = $userId AND $filter ORDER BY id DESC";
    } elseif ($type === "beasiswa") {
        $query = "SELECT *, 'beasiswa' AS tabel_asal, 'Beasiswa' AS tipe_tampil 
                  FROM beasiswa WHERE user_id = $userId AND $filter ORDER BY id DESC";
    } else {
        $query = "SELECT *, 'perubahankelas' AS tabel_asal, 'Perubahan Kelas' AS tipe_tampil 
                  FROM perubahankelas WHERE user_id = $userId AND $filter ORDER BY id DESC";
    }

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

// Function Untuk Mengambil Data Lama pada database untuk di tampilkan pada form edit
function takeDataLamaForInputEdit ($conn, $edit_id, $edit_type, $userId) {
    // deafult value untuk variabel data
    $data = [];

    // Branching berdasarkan edit_id dan edit_type
    if ($edit_id != '' && $edit_type != '') {
    $userId = $_SESSION['user_id'];
    
    // Branching berdasarkan edit_type untuk menentukan query yang akan dijalankan
    if ($edit_type == 'jadwalujian') {
        $query = "SELECT * FROM jadwalujian WHERE id = $edit_id AND user_id = $userId";
    } elseif ($edit_type == 'beasiswa') {
        $query = "SELECT * FROM beasiswa WHERE id = $edit_id AND user_id = $userId";
    } else {
        $query = "SELECT * FROM perubahankelas WHERE id = $edit_id AND user_id = $userId";
    }

    // Eksekusi query
    $result = mysqli_query($conn, $query);
    if ($result) {
        $data = mysqli_fetch_assoc($result);

        return $data;
    }
    }
}