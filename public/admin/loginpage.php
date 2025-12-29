<?php
session_start();
include '../../app/config/db_conn.php';
include '../../app/component/alert.php';

?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portal Login</title>
  <link rel="icon" type="png" href="../../public/assets/Logo-Poltek.png">
  <link href="../../public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../public/style/extlogin.css" rel="stylesheet">
  <link rel="stylesheet" href="../../public/vendor/bootstrap/icons/bootstrap-icons.css">
  <script src="../../public/vendor/sweetalert/sweetalert2.all.min.js"></script>
</head>

<body class="d-flex align-items-center justify-content-center py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-11 col-sm-8 col-md-6 col-lg-4">
        <div class="card p-4 text-center">
          <div class="card-body">
            <img src="../../public/assets/Logo-Poltek4.png"
              alt="Logo Polibatam" class="logo mb-3 w-50">
            <h4 class="fw-bold mb-2">Portal Penerbitan Informasi</h4>
            <p class="text-muted mb-4">Silahkan isi NIDN dan Password Anda</p>

            <form action="../../app/controller/auth_controller.php" method="POST">
              <div class="mb-3 text-start">
                <label for="nidn" class="form-label fw-semibold">NIDN</label>
                <input type="text" class="form-control" id="nidn" name="nidn" placeholder="Masukkan NIDN" required>
              </div>

              <div class="mb-4 text-start">
                <label for="pw" class="form-label fw-semibold">Password</label>

                <div class="input-group">
                  <input
                    type="password"
                    class="form-control"
                    id="pass"
                    name="pass"
                    placeholder="Masukkan Password"
                    required>

                  <span class="input-group-text" style="cursor: pointer;">
                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                  </span>
                </div>
              </div>


              <button type="submit" class="btn btn-primary w-100 fw-bold rounded" value="login">LOGIN</button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../../public/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="../../public/style/eyePass.js"></script>

  <?php
  alertWithoutBtn('login_error', 'error', 'Login gagal!'); 
  alertWithoutBtn('wrong_role_permission', 'error', "")
  ?>


</body>

</html>