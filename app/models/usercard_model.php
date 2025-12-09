<?php

function takeData($conn, $table, $data) {
    $column = implode(", ", $data);

    $query = "SELECT $column FROM $table ORDER BY id DESC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    return $rows; 
}
