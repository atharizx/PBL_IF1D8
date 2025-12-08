<?php
require_once '../../app/models/usercard_model.php';
require_once '../../app/helper/userCard_helper.php';

// RENDER CARD JADWAL
function renderCardJadwal($conn)
{
    $requireDataJadwal = [
        'id',
        'judul',
        'deskripsi',
        'jurusan',
        'exceljadwal',
        'fotojadwal',
        'waktupenerbitan',
    ];

    $importDataJadwal = takeData($conn, "jadwalujian", $requireDataJadwal);

    if (empty($importDataJadwal)) {
        echo "<div class='col-12 text-center py-5'><p class='text-muted fs-6'>Tidak ada informasi terbaru</p></div>";
        return;
    }

    foreach ($importDataJadwal as $row) {

        $modalId = "modalJadwal_" . $row['id'];

        $deskripsiShortVersion = substr($row['deskripsi'], 0, 70) . '...';
        $tanggalshortVersion = date('Y-m-d', strtotime($row['waktupenerbitan']));

        $imgFile = imgPathFile($row['fotojadwal'], '../../public/upload/jadwalUjian/img/');
        $excelFile = excelPathFile($row['exceljadwal'], '../../public/upload/jadwalUjian/excel/');

        echo <<<HTML
        <div class='card info-card shadow border-0 me-4 mb-4 align-item-center'>
            <img src='{$imgFile}' 
                class='card-img-top info-img' 
                alt='Foto Jadwal'>

            <div class='card-body'>
                <div class='d-flex justify-content-between align-items-start flex-nowrap mb-2'>
                    <h5 class='info-title mb-0 me-2' style='max-width: 70%;'>
                        {$row['judul']}
                    </h5>
                    <small class='text-muted text-nowrap ms-2'>
                        {$tanggalshortVersion}
                    </small>
                </div>

                <p class='info-desc text-muted fs-6 mt-1 mb-3'>
                    {$deskripsiShortVersion}
                </p>

                <button class='btn btn-primary btn-sm float-end rounded shadow' 
                    data-bs-toggle='modal'
                    data-bs-target='#{$modalId}'>
                    Detail 
                </button>
            </div>
        </div>

        <!-- MODAL DETAIL -->
        <div class='modal fade' id='{$modalId}' tabindex='-1' aria-labelledby='{$modalId}Label' aria-hidden='true'>
            <div class='modal-dialog modal-lg modal-dialog-centered'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h4 class='fw-bold mb-0'>Detail Informasi</h4>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>

                    <div class='modal-body p-4'>
                        <!-- Gambar Thumbnail -->
                        <div class='text-center mb-4'>
                            <img src='{$imgFile}' 
                                class='img-fluid rounded' 
                                alt='Foto Jadwal'
                                style='max-height: 400px; object-fit: contain; width: auto;'>
                        </div>

                        <!-- Judul & Tanggal -->
                        <div class='d-flex justify-content-between align-items-start mb-3'>
                            <h3 class='fw-semibold mb-0'>{$row['judul']}</h3>
                            <small class='text-muted text-nowrap ms-2'>{$tanggalshortVersion}</small>
                        </div>

                        <hr class='my-3'>

                        <!-- Deskripsi -->
                        <div class='content mb-4'>
                            {$row['deskripsi']}
                        </div>

                        <!-- Jurusan -->
                        <div class='row g-3'>
                            <div class='col-sm-4 fw-semibold text-nowarp'>
                                Jurusan {$row['jurusan']}
                            </div>
                        </div>

                        <!-- Footer Catatan -->
                        <div class='mt-4 pt-3 border-top'>
                            <small class='d-block mb-1'>Download file pengumuman disini:</small>
                            <a href='{$excelFile}' download class='text-decoration-underline'>
                                {$row['judul']}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        HTML;
    }
}


// RENDER CARD BEASISWA
function renderCardBeasiswa($conn)
{
    $requireDataBeasiswa = [
        'id',
        'namabeasiswa',
        'deskripsi',
        'linkpendaftaran',
        'fotobeasiswa',
        'waktupenerbitan',
    ];

    $importDataBeasiswa = takeData($conn, "beasiswa", $requireDataBeasiswa);

    if (empty($importDataBeasiswa)) {
        echo "<div class='col-12 text-center py-5'><p class='text-muted fs-6'>Tidak ada informasi terbaru</p></div>";
        return;
    }

    foreach ($importDataBeasiswa as $row) {

        $modalId = "modalBeasiswa_" . $row['id'];
        $deskripsiShortVersion = substr($row['deskripsi'], 0, 70) . '...';
        $tanggalShortVersion = date('Y-m-d', strtotime($row['waktupenerbitan']));

        $imgFile = imgPathFile($row['fotobeasiswa'], '../../public/upload/beasiswa/img/');

        echo <<<HTML
        <div class='card info-card shadow border-0 me-4 mb-4 align-item-center'>
            <img src='{$imgFile}' 
                class='card-img-top info-img' 
                alt='Foto Jadwal'>

            <div class='card-body'>
                <div class='d-flex justify-content-between align-items-start flex-nowrap mb-2'>
                    <h5 class='info-title mb-0 me-2' style='max-width: 70%;'>
                        {$row['namabeasiswa']}
                    </h5>
                    <small class='text-muted text-nowrap ms-2'>
                        {$tanggalShortVersion}
                    </small>
                </div>

                <p class='info-desc text-muted fs-6 mt-1 mb-3'>
                    {$deskripsiShortVersion}
                </p>

                <button class='btn btn-primary btn-sm float-end rounded shadow' 
                    data-bs-toggle='modal'
                    data-bs-target='#{$modalId}'>
                    Detail 
                </button>
            </div>
        </div>

        <!-- MODAL DETAIL -->
        <div class='modal fade' id='{$modalId}' tabindex='-1' aria-labelledby='{$modalId}Label' aria-hidden='true'>
            <div class='modal-dialog modal-lg modal-dialog-centered'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h4 class='fw-bold mb-0'>Detail Informasi</h4>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>

                    <div class='modal-body p-4'>
                        <!-- Gambar Thumbnail -->
                        <div class='text-center mb-4'>
                            <img src='{$imgFile}' 
                                class='img-fluid rounded' 
                                alt='Foto Jadwal'
                                style='max-height: 400px; object-fit: contain; width: auto;'>
                        </div>

                        <!-- Judul & Tanggal -->
                        <div class='d-flex justify-content-between align-items-start mb-3'>
                            <h3 class='fw-semibold mb-0'>{$row['namabeasiswa']}</h3>
                            <small class='text-muted text-nowrap ms-2'>{$tanggalShortVersion}</small>
                        </div>

                        <hr class='my-3'>

                        <!-- Deskripsi -->
                        <div class='content mb-4'>
                            {$row['deskripsi']}
                        </div>

                        <!-- Footer Catatan -->
                        <div class='mt-4 pt-3 border-top'>
                            <small class='d-block mb-1'>Link pendaftaran dapat di akses dibawah ini :</small>
                            <a href='{$row["linkpendaftaran"]}' class='text-decoration-underline'>
                                Pendaftaran {$row['namabeasiswa']}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        HTML;
    }
}

function renderCardKelas($conn)
{
    $requireDataKelas = [
        'id',
        'judul',
        'deskripsi',
        'jurusan',
        'excelkelas',
        'fotokelas',
        'waktupenerbitan',
    ];

    $importDataKelas = takeData($conn, "perubahankelas", $requireDataKelas);
    
    if (empty($importDataKelas)) {
        echo "<div class='col-12 text-center py-5'><p class='text-muted fs-6'>Tidak ada informasi terbaru</p></div>";
        return;
    }

    foreach ($importDataKelas as $row) {

        $modalId = "modalKelas_" . $row['id'];

        $deskripsiShortVersion = substr($row['deskripsi'], 0, 70) . '...';
        $tanggalshortVersion = date('Y-m-d', strtotime($row['waktupenerbitan']));

        $imgFile = imgPathFile($row['fotokelas'], '../../public/upload/perubahanKelas/img/');
        $excelFile = excelPathFile($row['excelkelas'], '../../public/upload/perubahanKelas/excel/');

        echo <<<HTML
        <div class='card info-card shadow border-0 me-4 mb-4 align-item-center'>
            <img src='{$imgFile}' 
                class='card-img-top info-img' 
                alt='Foto Jadwal'>

            <div class='card-body'>
                <div class='d-flex justify-content-between align-items-start flex-nowrap mb-2'>
                    <h5 class='info-title mb-0 me-2' style='max-width: 70%;'>
                        {$row['judul']}
                    </h5>
                    <small class='text-muted text-nowrap ms-2'>
                        {$tanggalshortVersion}
                    </small>
                </div>

                <p class='info-desc text-muted fs-6 mt-1 mb-3'>
                    {$deskripsiShortVersion}
                </p>

                <button class='btn btn-primary btn-sm float-end rounded shadow' 
                    data-bs-toggle='modal'
                    data-bs-target='#{$modalId}'>
                    Detail 
                </button>
            </div>
        </div>

        <!-- MODAL DETAIL -->
        <div class='modal fade' id='{$modalId}' tabindex='-1' aria-labelledby='{$modalId}Label' aria-hidden='true'>
            <div class='modal-dialog modal-lg modal-dialog-centered'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h4 class='fw-bold mb-0'>Detail Informasi</h4>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>

                    <div class='modal-body p-4'>
                        <!-- Gambar Thumbnail -->
                        <div class='text-center mb-4'>
                            <img src='{$imgFile}' 
                                class='img-fluid rounded' 
                                alt='Foto Jadwal'
                                style='max-height: 400px; object-fit: contain; width: auto;'>
                        </div>

                        <!-- Judul & Tanggal -->
                        <div class='d-flex justify-content-between align-items-start mb-3'>
                            <h3 class='fw-semibold mb-0'>{$row['judul']}</h3>
                            <small class='text-muted text-nowrap ms-2'>{$tanggalshortVersion}</small>
                        </div>

                        <hr class='my-3'>

                        <!-- Deskripsi -->
                        <div class='content mb-4'>
                            {$row['deskripsi']}
                        </div>

                        <!-- Jurusan -->
                        <div class='row g-3'>
                            <div class='col-sm-4 fw-semibold text-nowarp'>
                                Jurusan {$row['jurusan']}
                            </div>
                        </div>

                        <!-- Footer Catatan -->
                        <div class='mt-4 pt-3 border-top'>
                            <small class='d-block mb-1'>Download file pengumuman disini:</small>
                            <a href='{$excelFile}' download class='text-decoration-underline'>
                                {$row['judul']}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        HTML;
    }
}

// RenderAllCard untuk Beranda

function renderAllCard($conn) {
    $requireDataJadwal = [
        'id',
        'judul',
        'masaberlaku',
        'jurusan',
        'deskripsi',
        'exceljadwal as file_excel',
        'fotojadwal as file_foto',
        'waktupenerbitan'
    ];
    $importDataJadwal = takeData($conn, "jadwalujian", $requireDataJadwal);

    foreach($importDataJadwal as &$data) {
        $data['type'] = "jadwalujian";
        $data['judul_unified'] = $data['judul'];
        $data['foto_unified'] = $data['file_foto'];
        $data['excel_unified'] = $data['file_excel'];
    }

    $requireDataBeasiswa = [
        'id',
        'namabeasiswa',
        'masaberlaku',
        'deskripsi',
        'linkpendaftaran',
        'fotobeasiswa as file_foto',
        'waktupenerbitan',
    ];
    $importDataBeasiswa = takeData($conn, "beasiswa", $requireDataBeasiswa);

    foreach($importDataBeasiswa as &$data) {
        $data['type'] = "beasiswa";
        $data['judul_unified'] = $data['namabeasiswa'];
        $data['foto_unified'] = $data['file_foto'];
        $data['excel_unified'] = $data['linkpendaftaran']; 
    }

    $requireDataKelas = [
        'id',
        'judul',
        'masaberlaku',
        'jurusan',
        'deskripsi',
        'excelkelas as file_excel',
        'fotokelas as file_foto',
        'waktupenerbitan',
    ];
    $importDataKelas = takeData($conn, "perubahankelas", $requireDataKelas);

    foreach($importDataKelas as &$data) {
        $data['type'] = "perubahankelas";
        $data['judul_unified'] = $data['judul'];
        $data['foto_unified'] = $data['file_foto'];
        $data['excel_unified'] = $data['file_excel'];
    }

    $allData = array_merge($importDataJadwal, $importDataBeasiswa, $importDataKelas);
    usort($allData, fn($a, $b) => strtotime($b['waktupenerbitan']) - strtotime($a['waktupenerbitan']));

    if(empty($allData)) {
        echo "<div class='col-12 text-center py-5'><p class='text-muted fs-6'>Tidak ada informasi terbaru</p></div>";
        return;
    }

    foreach($allData as $row) {
        $modalId = "modalKelas_" . $row['id'];

        $deskripsiShortVersion = substr($row['deskripsi'], 0, 70) . '...';
        $tanggalshortVersion = date('Y-m-d', strtotime($row['waktupenerbitan']));
        
        // Branching Render File
        if ($row['type'] === 'jadwalujian') {
            $imgFile = imgPathFile($row['foto_unified'], '../../public/upload/jadwalUjian/img/');
            $excelFile = excelPathFile($row['excel_unified'], '../../public/upload/jadwalUjian/excel/');
        } elseif ($row['type'] === 'beasiswa') {
            $imgFile = imgPathFile($row['foto_unified'], '../../public/upload/beasiswa/img/');
            $excelFile = $row['excel_unified'];
        } else {
            $imgFile = imgPathFile($row['foto_unified'], '../../public/upload/perubahanKelas/img/');
            $excelFile = excelPathFile($row['excel_unified'], '../../public/upload/perubahanKelas/excel/');
        }

        echo <<<HTML
        <div class='col-md-4'>
            <div class='card info-card shadow border-0 me-4 mb-4 align-item-center'>
                <img src='{$imgFile}' 
                    class='card-img-top info-img' 
                    alt='Foto Thumbnail'>

                <div class='card-body'>
                    <div class='d-flex justify-content-between align-items-start flex-nowrap mb-2'>
                        <h5 class='info-title mb-0 me-2' style='max-width: 70%;'>
                            {$row['judul_unified']}
                        </h5>
                        <small class='text-muted text-nowrap ms-2'>
                            {$tanggalshortVersion}
                        </small>
                    </div>

                    <p class='info-desc text-muted fs-6 mt-1 mb-3'>
                        {$deskripsiShortVersion}
                    </p>

                    <button class='btn btn-primary btn-sm float-end rounded shadow' 
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
                            <h3 class='fw-semibold mb-0'>{$row['judul_unified']}</h3>
                            <small class='text-muted text-nowrap ms-2'>{$tanggalshortVersion}</small>
                        </div>

                        <hr class='my-3'>

                        <!-- Deskripsi -->
                        <div class='content mb-4'>
                            {$row['deskripsi']}
                        </div>
        HTML;
                        // Jurusan
                        echo renderJurusanSection($row);

                        // Footer
                        echo footerCardForBeranda($row, $excelFile);
        echo <<<HTML
                    </div>
                </div>
            </div>
        </div>
        HTML;
    }

}
