<?php
require_once '../config/db_conn.php';
require_once '../controller/auth_controller.php';

function getAdminByNidn($conn, $nidn) {
    $query = ("SELECT nidn, pw, nama, id FROM adminlog WHERE nidn = ?");
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nidn);
    $stmt->execute();
    $stmt->store_result();
    return $stmt;
}