<?php

function imgPathFile($fileName, $pathFile) {
    if(!$fileName) {
        return '../../public/assets/placeHolderIMG.png';
    }
    $imgFile = $pathFile . $fileName;

    return $imgFile;
}

function excelPathFile($filename, $pathfile) {
    if (!$filename) {
        return 'File Excel tidak tersedia';
    }
    $excelFile = $pathfile . $filename;

    return $excelFile;
    
}

function renderJurusanSection($row) {
    if (isset($row['type']) && ($row['type'] === 'jadwalujian' || $row['type'] === 'perubahankelas')) {
        return 
        "<div class='row g-3'>
            <div class='col-sm-3 fw-semibold'>Jurusan</div>
            <div class='col-sm-9'>" . htmlspecialchars($row['jurusan'] ?? '') . "</div>
        </div>
        ";
    } else {
        return "";
    }
}

function footerCardForBeranda ($row, $excelFile) {
    if (isset($row['type']) && ($row['type'] === "jadwalujian" || $row['type'] === 'perubahankelas')) {
        return 
        "<div class='mt-4 pt-3 border-top'>
            <small class='d-block mb-1'>Download file pengumuman disini:</small>
            <a href='{$excelFile}' download class='text-decoration-underline'>
            {$row['judul']}
            </a>
        </div>";
    } elseif (isset($row['type']) && $row['type'] === 'beasiswa') {
        return "
        <div class='mt-4 pt-3 border-top'>
            <small class='d-block mb-1'>Link pendaftaran dapat di akses dibawah ini :</small>
            <a href='{$row["excel_unified"]}' class='text-decoration-underline'>
            Pendaftaran {$row['namabeasiswa']}
            </a>
        </div>";
    } else {
        return "";
    }
}