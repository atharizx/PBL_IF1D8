<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portal Login</title>
  <link rel="icon" type="png" href="https://sim.polibatam.ac.id/assets/img_sim/d8f9867f-23a7-4558-974b-d3c03a621fa3.png">
  <link href="../style/css/bootstrap.min.css" rel="stylesheet">
  <link href="../style/extlogin.css" rel="stylesheet">
  <script src="../style/sweetalert/sweetalert2.all.min.js"></script>
</head>

<body class="d-flex align-items-center justify-content-center py-5">
  <form class="container" method="post" action="#">
    <div class="row justify-content-center">
      <div class="col-11 col-sm-8 col-md-6 col-lg-4">
        <div class="card p-4 text-center">
          <div class="card-body">
            <img src="https://sim.polibatam.ac.id/assets/img_sim/d8f9867f-23a7-4558-974b-d3c03a621fa3.png" 
                 alt="Logo Polibatam" class="logo mb-3 w-50">
            <h4 class="fw-bold mb-2">Portal Penerbitan Informasi</h4>
            <p class="text-muted mb-4">Silahkan isi NIDN dan Password Anda</p>

            <form action="../login_system.php" method="POST">
              <div class="mb-3 text-start">
                <label for="nidn" class="form-label fw-semibold">NIDN</label>
                <input type="text" class="form-control" id="nidn" name="nidn" placeholder="Masukkan NIDN" required>
              </div>

              <div class="mb-4 text-start">
                <label for="pw" class="form-label fw-semibold">Password</label>
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Masukkan Password" required>
              </div>

              <input type="submit" class="btn btn-primary w-100 fw-bold rounded-pill" value="LOGIN">
            </form>
          </div>
        </div>
      </div>
    </div>
  </form>

  <script src="../style/js/bootstrap.bundle.js"></script>
</body>
</html>

