<?php

function insertDataInformation ($conn, $data, $type) {
    if ($type == 'jadwalujian') {
        $query = "INSERT INTO $type (judul, masaberlaku, deskripsi, jurusan, exceljadwal, fotojadwal, waktupenerbitan, user_id) 
          VALUES ('{$data['judul']}', '{$data['masaberlaku']}', '{$data['deskripsi']}', '{$data['jurusan']}', '{$data['exceljadwal']}',
           '{$data['fotojadwal']}', NOW(), '{$data['user_id']}')";
    } elseif ($type == 'beasiswa') {
        $query = "INSERT INTO $type (namabeasiswa, masaberlaku, deskripsi, linkpendaftaran, fotobeasiswa, waktupenerbitan, user_id) 
          VALUES ('{$data['namabeasiswa']}', '{$data['masaberlaku']}', '{$data['deskripsi']}', '{$data['linkpendaftaran']}', '{$data['fotobeasiswa']}',
           NOW(), '{$data['user_id']}')";
    } else {
        $query = "INSERT INTO $type (judul, masaberlaku, deskripsi, jurusan, excelkelas, fotokelas, waktupenerbitan, user_id) 
          VALUES ('{$data['judul']}', '{$data['masaberlaku']}', '{$data['deskripsi']}', '{$data['jurusan']}', '{$data['excelkelas']}',
           '{$data['fotokelas']}', NOW(), '{$data['user_id']}')";
    }

    $queryRun = mysqli_query($conn, $query);
    return $queryRun;
}
?>
