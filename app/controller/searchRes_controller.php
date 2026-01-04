<?php
include '../../app/config/db_conn.php';
include '../../app/models/userCard_model.php';
include '../../app/helper/userCard_helper.php';

$keyword = $_GET['q'] ?? '';

function searchResult ($conn, $keyword) {
    $found = false;

    // Mengambil Data dari database
    $importDataJadwal = searchDataHandler($conn, "jadwalujian", "*", "judul LIKE '%$keyword%'");
    $importDataBeasiswa = searchDataHandler($conn, "beasiswa", "*", "namabeasiswa LIKE '%$keyword%'");
    $importDataKelas = searchDataHandler($conn, "perubahankelas", "*", "judul LIKE '%$keyword%'");

    // Proses Menyatukan beberapa data menjadi jadi satu format 
    foreach($importDataJadwal as &$data) {
        $found = true;
        $data['type'] = "jadwalujian";
        $data['judul_unified'] = $data['judul'];
        $data['foto_unified'] = $data['fotojadwal']; 
        $data['excel_unified'] = $data['exceljadwal'];
    }

    foreach($importDataBeasiswa as &$data) {
        $found = true;
        $data['type'] = "beasiswa";
        $data['judul_unified'] = $data['namabeasiswa'];
        $data['foto_unified'] = $data['fotobeasiswa'];
        $data['excel_unified'] = $data['linkpendaftaran']; 
    }

    foreach($importDataKelas as &$data) {
        $found = true;
        $data['type'] = "perubahankelas";
        $data['judul_unified'] = $data['judul'];
        $data['foto_unified'] = $data['fotokelas'];
        $data['excel_unified'] = $data['excelkelas'];
    }

    // Proses Menggabungkan semua data menjadi 1 variable
    $allData = array_merge($importDataJadwal, $importDataBeasiswa, $importDataKelas);
    
    // Menyorting sesuai tanggal penerbitan terbaru
    usort($allData, fn($a, $b) => strtotime($b['waktupenerbitan']) - strtotime($a['waktupenerbitan']));

    // Keadaan Jika informasi tidak ditemukan
    if(empty($allData)) {
        echo "<div class='col-12 text-center py-5'><p class='text-muted fs-6'>informasi yang anda cari tidak ditemukan</p></div>";
        return;
    }

    // Proses Merender Card untuk setiap data yang ditemukan
    foreach($allData as $data) {
        $modalId = "modalKelas_" . $data['id'];
        
        // Menghilangkan Jam dari format waktu penerbitan
        $tanggalshortVersion = date('Y-m-d', strtotime($data['waktupenerbitan']));
        
        // Branching untuk menentukan path file gambar dan excel sesaui tipe informasi
        if ($data['type'] === 'jadwalujian') {
            $imgFile = imgPathFileForMainPage($data['foto_unified'], 'public/upload/jadwalUjian/img/');
            $excelFile = excelPathFile($data['excel_unified'], 'public/upload/jadwalUjian/excel/');
        } elseif ($data['type'] === 'beasiswa') {
            $imgFile = imgPathFileForMainPage($data['foto_unified'], 'public/upload/beasiswa/img/');
            $excelFile = $data['excel_unified'];
        } else {
            $imgFile = imgPathFileForMainPage($data['foto_unified'], 'public/upload/perubahanKelas/img/');
            $excelFile = excelPathFile($data['excel_unified'], 'public/upload/perubahanKelas/excel/');
        }

        // Layout Card
        echo <<<HTML
        <div class='col-md-4'>
            <div class='card info-card shadow border-0 me-4 mb-4 align-item-center'>
                <img src ='$imgFile'
                    class='card-img-top info-img' 
                    alt='Foto Thumbnail'>

                <div class='card-body'>
                    <div class='d-flex justify-content-between align-items-start flex-nowrap mb-2'>
                        <h5 class='info-title mb-0 me-2' style='max-width: 70%;'>
                            {$data['judul_unified']}
                        </h5>
                        <small class='text-muted text-nowrap ms-2'>
                            {$tanggalshortVersion}
                        </small>
                    </div>
                    <div class="text-warp">
        HTML;           
                        echo renderJurusanHelper($data);
        echo <<<HTML
                    </div>

                    <button class='btn btn-primary btn-sm float-end rounded shadow mt-2' 
                        data-bs-toggle='modal'
                        data-bs-target='#{$modalId}'>
                        Detail
                    </button>
                </div>
            </div>
        </div>

        <!-- MODAL DETAIL -->
        <div class='modal fade' id='{$modalId}' tabindex='-1' aria-labelledby='{$modalId}Label' aria-hidden='true'>
            <div class='modal-dialog modal-lg modal-dialog-centered'>
                <div class='modal-content'>
                    <!-- Header -->
                    <div class='modal-header'>
                        <h4 class='fw-bold mb-0'>Detail Informasi</h4>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>

                    <!-- Body -->
                    <div class='modal-body p-4'>
                        <!-- Gambar Thumbnail -->
                        <div class='text-center mb-4'>
                            <img src='{$imgFile}' 
                                class='img-fluid rounded' 
                                alt='Foto Thumbnail informasi'
                                style='max-height: 400px; object-fit: contain; width: auto;'>
                        </div>

                        <!-- Judul & Tanggal -->
                        <div class='d-flex justify-content-between align-items-start mb-3'>
                            <h3 class='fw-semibold mb-0'>{$data['judul_unified']}</h3>
                            <small class='text-muted text-nowrap ms-2'>{$tanggalshortVersion}</small>
                        </div>

                        <hr class='my-3'>

                        <!-- Deskripsi -->
                        <div class='content mb-4 text-break'>
                            {$data['deskripsi']}
                        </div>
        HTML;
                        // Jurusan
                        echo renderJurusanHelper($data);
                        // Footer
                        echo footerCardForBeranda($data, $excelFile);
        echo <<<HTML
                    </div>
                </div>
            </div>
        </div>
        HTML;
    }
}

searchResult($conn, $keyword);
