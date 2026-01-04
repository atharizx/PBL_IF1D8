<?php
include '../../app/models/userCard_model.php';
include '../../app/helper/userCard_helper.php';

// Function Untuk Render Card Pada Page jadwalujian.php, beasiswa.php, perubahanKelas.php
function userCardRender($conn, $type, $filter = [])
{   
    // LOGIKA Untuk Filter
    $defaultVar = "1=1";

    // Branching Jika Filter tanggal di isi
    if (!empty($filter['tanggal'])) {
        $tanggal= $filter['tanggal'];
        $defaultVar .=  " AND DATE(waktupenerbitan) = '$tanggal'";
    }
    
    // Mengambil data berdasarkan tipe dan filter
    $importData = takeData($conn, "$type", "*", $defaultVar);

    // Proses Menyatukan beberapa data menjadi jadi satu format
    foreach ($importData as &$data) {
        $data['type'] = $type;
        
        // Branching untuk menyatukan nama field yang berbeda
        if ($type === "jadwalujian") {
            $data['judul_unified'] = $data['judul'];
        } elseif ($type === "beasiswa") {
            $data['judul_unified'] = $data['namabeasiswa'];
        } else {
            $data['judul_unified'] = $data['judul'];
        }

        if (isset($type) && $type === "jadwalujian") {
            $data['foto_unified'] = $data['fotojadwal'];
        } elseif (isset($type) && $type === "beasiswa") {
            $data['foto_unified'] = $data['fotobeasiswa'];
        } else {
            $data['foto_unified'] = $data['fotokelas'];
        }
        
        if (isset($type) && $type === "jadwalujian") {
            $data['excel_unified'] = $data['exceljadwal'];
        } elseif (isset($type) && $type === "beasiswa") {
            $data['excel_unified'] = $data['linkpendaftaran'];
        } else {
            $data['excel_unified'] = $data['excelkelas'];
        }
    }
    unset($data);

    // Branching jika tidak ada data yang di upload oleh admin
    if (empty($importData)) {
        echo "<div class='col-12 text-center py-5'><p class='text-muted fs-6'>Tidak ada informasi terbaru</p></div>";
        return;
    }

    foreach ($importData as $data) {
        $modalId = "modal_" . "$type" . $data['id'];

        // Menghilangkan Jam dari format waktu penerbitan
        $tanggalshortVersion = date('Y-m-d', strtotime($data['waktupenerbitan']));

        // Branching untuk menentukan path file gambar dan excel sesaui tipe informasi
        if ($data['type'] === 'jadwalujian') {
            $imgFile = imgPathFileForSubPage($data['foto_unified'], '../../public/upload/jadwalUjian/img/');
            $excelFile = excelPathFile($data['excel_unified'], '../../public/upload/jadwalUjian/excel/');
        } elseif ($data['type'] === 'beasiswa') {
            $imgFile = imgPathFileForSubPage($data['foto_unified'], '../../public/upload/beasiswa/img/');
            $excelFile = $data['excel_unified'];
        } else {
            $imgFile = imgPathFileForSubPage($data['foto_unified'], '../../public/upload/perubahanKelas/img/');
            $excelFile = excelPathFile($data['excel_unified'], '../../public/upload/perubahanKelas/excel/');
        }

        // Layout Card
        echo <<<HTML
        <div class='col-md-4'>
            <div class='card info-card shadow border-0 me-4 mb-4 align-item-center'>
                <!-- IMAGE -->
                <img src ='$imgFile'
                    class='card-img-top info-img' 
                    alt='Foto Thumbnail'>
                
                <!-- JUDUL & TANGGAL -->
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

                    <!-- BUTTON DETAIL -->
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
        echo renderJurusanHelper($data);

        echo footerCardForBeranda($data, $excelFile);
        echo <<<HTML
                    </div>
                </div>
            </div>
        </div>
        HTML;
    }
}
