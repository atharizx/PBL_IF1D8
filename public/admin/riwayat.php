<?php
session_start();
include '../../app/config/db_conn.php';
include '../../app/controller/riwayatTable_controller.php';
include '../../app/component/alert.php';
include '../../app/helper/showalert_helper.php';

$nama = $_SESSION['nama'];
$nidn = $_SESSION['nidn'];

if (!isset($_SESSION['user_id'])) {
  header("Location: loginpage.php");
  exit();
}

$tanggal = $_GET['tanggal'] ?? '';

?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riwayat Penerbitan</title>
  <link href="../assets/Logo-Poltek.png" rel="icon">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../vendor/bootstrap/icons/bootstrap-icons.css">
  <link href="../style/extadmin.css" rel="stylesheet">

</head>

<body class="bg-light d-flex flex-column">
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-0">
    <div class="container-fluid px-4">

      <!-- KIRI: LOGO + TITLE -->
      <a class="navbar-brand d-flex align-items-center gap-2" href="#">
        <img src="../assets/Logo-Poltek3.png" alt="Logo"
          style="width:130px; height:auto; max-height:none !important;"
          class="rounded">
      </a>

      <!-- TOGGLE MOBILE -->
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- KANAN: MENU DESKTOP -->
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav align-items-center gap-3">

          <li class="nav-item">
            <a href="../admin/penerbitan.php" class="nav-link fw-bold">Beranda</a>
          </li>

          <!-- PROFILE DROPDOWN -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
              <i class="bi bi-person-circle fs-3"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-center shadow">
              <li>
                <p class="fw-semibold mb-0"><?= $nama ?></p>
              </li>
              <li>
                <p class="text-muted small"><?= $nidn ?></p>
              </li>
              <hr>
              <li>
                <button class="dropdown-item text-danger fw-bold btn btn-light" id="btnLogoutDesktop">
                  <i class="bi bi-box-arrow-left me-2"></i> Keluar
                </button>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </div>
  </nav>


  <!-- SIDEBAR MOBILE -->
  <div
    class="offcanvas offcanvas-end offcanvas-sidebar"
    tabindex="-1"
    id="mobileSidebar">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title fw-bold">MENU</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">
      <div class="list-group mb-3">
        <a href="../admin/penerbitan.php"
          class="list-group-item list-group-item-action fw-semibold mb-2 rounded">
          Beranda
        </a>
        <button
          class="list-group-item list-group-item-action text-danger fw-bold btn btn-light"
          data-bs-dismiss="offcanvas"
          id="btnLogoutMobile">
          <i class="bi bi-box-arrow-left"></i> Keluar
        </button>
      </div>
    </div>
  </div>

  <!-- MAIN CONTENT -->
  <main class="flex-grow-1">
    <div class="container-fluid mt-0 bg-light">
      <div class="row">
        <!-- ISI KONTEN -->
        <div class="mt-5">
          <h3 class="mb-4 fw-bold text-center">RIWAYAT PENERBITAN</h3>
          <div class="row mb-3 gap-2">
            <div class="col-auto">
              <button class="btn btn-primary shadow" data-bs-toggle="modal" data-bs-target="#modalFilter">Filter</button>
            </div>
          </div>

          <!-- Table Riwayat -->
          <div class="table-responsive mt-2">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-dark text-center">
                <tr>
                  <th>NO</th>
                  <th>Tanggal</th>
                  <th>Kategori</th>
                  <th>Judul</th>
                  <th>Deskripsi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="tabelInformasi">
                <?php renderTabelRiwayat($conn, $filter = ['tanggal' => $tanggal]) ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- FOOTER -->
  <footer class="bg-black bg-opacity-5 text-white py-1 mt-auto">
    <div class="container text-center">
      <p class="mb-0 fs-6">© 2025 Politeknik Negeri Batam</p>
    </div>
  </footer>

  <!-- MODAL FILTER -->
  <div class="modal fade" id="modalFilter" tabindex="-1" aria-labelledby="modalFilterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="filterModalLabel">Filter Pengumuman</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="riwayat.php" method="GET">
          <div class="modal-body bg-white">
            <div class="mb-3">
              <label for="tanggal" class="form-label"><b>Tanggal Publikasi :</b></label>
              <input type="date" id="tanggal" name="tanggal" class="form-control" value="<?= $_GET['tanggal'] ?? '' ?>">
            </div>
          </div>
          <div class="modal-footer bg-white">
            <button type="reset" id="resetBtn" class="btn btn-secondary">Reset</button>
            <button type="submit" id="applyBtn" class="btn btn-primary">Terapkan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/sweetalert/sweetalert2.all.min.js"></script>

  <?php
  alertWithConfirmButtonAndResultLogic('notLogin', '../../public/admin/loginpage.php', 'error', 'Peringatan!', 'Login');
  alertLogout('btnLogoutDesktop', 'btnLogoutMobile');
  showAlertJadwal();
  showAlertBeasiswa();
  showAlertKelas();

  ?>



</body>

</html>