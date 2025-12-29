<?php

function editDataAccount($conn, $nama, $nidn, $pw, $id) {
    $query = "UPDATE adminlog SET nidn='$nidn', nama='$nama', pw='$pw' WHERE id='$id'";

    $queryRun = mysqli_query($conn, $query);

    return $queryRun;
}