<?php

function storeData($conn, $table, $data) {
    $columns = implode(", ", array_keys($data));

    $placeholders = implode(", ", array_fill(0, count($data), "?"));

    $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
    $stmt = $conn->prepare($query);

    $types = str_repeat("s", count($data));

    $stmt->bind_param($types, ...array_values($data));

    if ($stmt->execute()) {
        return true;
    }

    return false;
}
