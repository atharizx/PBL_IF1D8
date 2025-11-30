<?php
date_default_timezone_set('Asia/Jakarta');


function uploadFile($file, $targetDir, $prefix) {

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = $prefix . "_" . date('dmY_Hi') . "." . $ext;

    $dest = $targetDir . $newName;

    if (!move_uploaded_file($file['tmp_name'], $dest)) {
        return false;
    }

    return $newName;
}
