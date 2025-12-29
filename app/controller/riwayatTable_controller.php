<?php
include '../../app/models/riwayatTable_model.php';

// Function Untuk Rendring Tabel Riwayat pada riwayat.php
function renderTabelRiwayat($conn, $filter = [])
{   
    // Mengambil user id dari session
    $currentUser_id = $_SESSION['user_id'];

    // LOGIC FILTER
    $whereJadwal = "1=1";
    $whereBeasiswa = "1=1";
    $whereKelas = "1=1";

    // Logika Filter
    if (!empty($filter['tanggal'])) {
        $tanggal= $filter['tanggal'];
        $whereJadwal .=  " AND DATE(waktupenerbitan) = '$tanggal'";
        $whereBeasiswa .= " AND DATE(waktupenerbitan) = '$tanggal'";
        $whereKelas .= " AND DATE(waktupenerbitan) = '$tanggal'";
    }

    // Proses Mengambil data berdasarkan tipe informasi dan user id
    $dataJadwal = takeDataForRiwayat($conn, "jadwalujian", $currentUser_id, $whereJadwal);
    $dataBeasiswa = takeDataForRiwayat($conn, "beasiswa", $currentUser_id, $whereBeasiswa);
    $dataKelas = takeDataForRiwayat($conn, "perubahankelas", $currentUser_id, $whereKelas);

    // Menggabungkan beberapa data menjadi satu format
    foreach ($dataJadwal as &$data) {
        $data['type'] = "jadwalUjian";
        $data['judul_tampil'] = $data['judul'];
    }
    unset($data);

    foreach ($dataBeasiswa as &$data) {
        $data['type'] = "beasiswa";
        $data['judul_tampil'] = $data['namabeasiswa'];
    }
    unset($data);

    foreach ($dataKelas as &$data) {
        $data['type'] = "perubahanKelas";
        $data['judul_tampil'] = $data['judul'];
    } 
    unset($data);

    // Menggabungkan Semua data menjadi satu variable
    $gabunganData = array_merge($dataJadwal, $dataBeasiswa, $dataKelas);
    
    // Mengurutkan data berdasarkan waktu penerbitan terbaru
    usort($gabunganData, fn($a, $b) => strtotime($b['waktupenerbitan']) - strtotime($a['waktupenerbitan']));

    // Branching jika tidak ada data yang di upload oleh admin/dosen
    if (empty($gabunganData)) {
        echo "<tr><td colspan='6' class='text-center text-muted py-3'>Anda belum menerbitkan informasi</td></tr>";
        return;
    }   

    // Proses Merender Tabel Riwayat
    $nomor = 1;
    foreach ($gabunganData as $data) {

        // Branching untuk menentukan target redirect delete dan type untuk edit
        if ($data['tabel_asal'] == 'jadwalujian') {
            $typePadaTabel = 'jadwalujian';
            $targetRedirectDel = "../../app/controller/deleteInformation_controller.php?id={$data['id']}&type={$typePadaTabel}";
        } elseif ($data['tabel_asal'] == 'beasiswa') {
            $typePadaTabel = 'beasiswa';
            $targetRedirectDel = "../../app/controller/deleteInformation_controller.php?id={$data['id']}&type={$typePadaTabel}";
        } else {
            $typePadaTabel = 'perubahankelas';
            $targetRedirectDel = "../../app/controller/deleteInformation_controller.php?id={$data['id']}&type={$typePadaTabel}";
        }

        // Memotong deskripsi jika terlalu panjang (lebih dari 40 karakter)
        $deskripsi = $data['deskripsi'];
        if (strlen($deskripsi) > 40) {
            $deskripsi = substr($deskripsi, 0, 40) . "...";
        }

        // Format waktu penerbitan
        $waktuFormatted = date('d M Y H:i', strtotime($data['waktupenerbitan']));
        $judulTampil = htmlspecialchars($data['judul_tampil']);

        // variable untuk link edit
        $linkEdit = "penerbitan.php?noinformasi=" . $data['id'] . "&type=" . $typePadaTabel;

        // Layout Tabel Riwayat
        echo <<<HTML
        <tr>
        <td class='text-center'>{$nomor}</td>
        <td class='text-center'>{$waktuFormatted}</td>
        <td class='text-center'>{$data['type']}</td>
        <td class='text-center'><strong>{$judulTampil}</strong></td>
        <td class='text-center'>{$deskripsi}</td>
        <td class='text-center'>
            <a href='$linkEdit'
                class='btn btn-warning edit-button'
                id='editBtn'>Edit
            </a>

            <button class='btn btn-sm btn-danger ms-2' id='deleteBtn_{$data['id']}'>Hapus</button>
        </td>
        </tr>
        HTML;

        $deleteId = 'deleteBtn_' . $data['id'];
        alertDelete($deleteId, $targetRedirectDel, 'Apakah anda yakin ingi menghapus akun ini?');

        $nomor++;
        
    }
}
?>