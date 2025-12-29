<?php

// Function Untuk mnghaupus data informasi yang sudah expired secara otomatis
function autoDeleteExpiredInformation($conn, $table) {
    // Proses delete data informasi berdasarkan masaberlaku dan current date
    $query = "DELETE FROM `$table` WHERE masaberlaku < CURDATE()";
    // Eksekusi query
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        return true;
    }
}
