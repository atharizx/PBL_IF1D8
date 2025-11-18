<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<?php
include 'db_conn.php'; 

if (isset($_POST['submit'])) {
    
    $nidn = $conn->real_escape_string($_POST['nidn']);
    $password = $_POST['password']; 

    $sql = "SELECT nidn, nama, password FROM users WHERE nidn = ?"; 

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nidn); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $nama_user = $user['nama'];
        
        if (password_verify($password, $user['password'])) {
            $alert_title = "Berhasil!";
            $alert_text = "Selamat datang, " . $nama_user . "!"; 
            $alert_icon = "success";
            
        } else {
            $alert_title = "Gagal!";
            $alert_text = "NIDN atau Password salah.";
            $alert_icon = "error";
        }
    } else {
        $alert_title = "Gagal!";
        $alert_text = "NIDN atau Password salah.";
        $alert_icon = "error";
    }

    $stmt->close();
} else {
    $alert_title = "Peringatan!";
    $alert_text = "Akses tidak sah.";
    $alert_icon = "warning";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Processing</title>
</head>
<body>
    <script>
        Swal.fire({
            title: '<?php echo $alert_title; ?>',
            text: '<?php echo $alert_text; ?>',
            icon: '<?php echo $alert_icon; ?>'
        }).then((result) => {
            window.location.href = 'login.php'; 
        });
    </script>
</body>
</html>