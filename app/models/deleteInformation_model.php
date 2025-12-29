<?php

function deleteInformation($conn, $type, $id, $userId)
{
    // Branching untuk menentukan query yang dijalankan sesuai type informasi
    if ($type == 'jadwalujian') {
        $query = "DELETE FROM $type WHERE id = $id AND user_id = $userId";
    } elseif ($type == 'beasiswa') {
        $query = "DELETE FROM $type WHERE id = $id AND user_id = $userId";
    } else {
        $query = "DELETE FROM $type WHERE id = $id AND user_id = $userId";
    }
    
    // Eksekusi Query
    $queryRun = mysqli_query($conn, $query);

    // Mengembalikan nilai dengan value dari variable $queryRun
    return $queryRun;
}
