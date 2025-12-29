<?php

function editInformationData($conn, $data, $type, $id)
{
    if ($type == 'jadwalujian') {
        $query = "UPDATE $type SET judul = '{$data['judul']}', masaberlaku = '{$data['masaberlaku']}', jurusan = '{$data['jurusan']}',
         deskripsi = '{$data['deskripsi']}', exceljadwal = '{$data['exceljadwal']}', fotojadwal = '{$data['fotojadwal']}' WHERE id='$id'";
    } elseif ($type == 'beasiswa') {
        $query = "UPDATE $type SET namabeasiswa='{$data['namabeasiswa']}', masaberlaku='{$data['masaberlaku']}',
         deskripsi='{$data['deskripsi']}', linkpendaftaran='{$data['linkpendaftaran']}', fotobeasiswa ='{$data['fotobeasiswa']}' WHERE id='$id'";
    } else {
        $query = "UPDATE $type SET judul='{$data['judul']}', masaberlaku='{$data['masaberlaku']}',
         deskripsi = '{$data['deskripsi']}', excelkelas='{$data['excelkelas']}', fotokelas='{$data['fotokelas']}' WHERE id='$id'";
    }

    $queryRun = mysqli_query($conn, $query);

    return $queryRun;
}
