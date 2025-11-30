<?php

function getAdminByNidn($conn, $nidn) {
    $query = ("SELECT nidn, pw, nama, id FROM adminlog WHERE nidn = ?");
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nidn);
    $stmt->execute();
    $stmt->store_result();
    return $stmt;
}