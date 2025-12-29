<?php

function authDataSelect ($conn, $nidn, $pw) {
    $query = "SELECT * FROM adminlog WHERE nidn = '$nidn' AND pw = '$pw'";

    $queryRun = mysqli_query($conn, $query);

    return $queryRun;
}
?>
