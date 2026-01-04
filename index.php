<?php
session_start();
include 'app/models/expiredCheck_model.php';
include 'app/config/db_conn.php';
include 'app/controller/cardMainPage_controller.php';

autoDeleteExpiredInformation($conn, "jadwalujian");
autoDeleteExpiredInformation($conn, "beasiswa");
autoDeleteExpiredInformation($conn, "perubahankelas");

$tanggal = $_GET['tanggal'] ?? '';

?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda</title>
  <link rel="icon" href="public/assets/Logo-Poltek.png">
  <link href="public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="public/vendor/bootstrap/icons/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <script src="public/vendor/sweetalert/sweetalert2.all.min.js"></script>
  <link href="public/style/extuser.css" rel="stylesheet">

</head>

<body>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-0">
    <div class="container-fluid">
      <!-- LOGO + JUDUL -->
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="public/assets/Logo-Poltek3.png"
          alt="Logo" width="150" class="me-2">
      </a>

      <!-- TOMBOL DROPDOWN MOBILE -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
        aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- MENU NAV -->
      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-lg-center gap-3">
          <li class="nav-item">
            <a href="index.php" class="nav-link fw-semibold">Beranda</a>
          </li>
          <li class="nav-item">
            <a href="public/user/jadwalujian.php" class="nav-link fw-semibold">Jadwal Ujian</a>
          </li>
          <li class="nav-item">
            <a href="public/user/beasiswa.php" class="nav-link fw-semibold">Beasiswa</a>
          </li>
          <li class="nav-item">
            <a href="public/user/perubahankelas.php" class="nav-link fw-semibold">Perubahan Kelas</a>
          </li>
          <li class="nav-item">
            <a href="public/admin/loginpage.php" class="fw-semibold btn btn-primary">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- KONTEN UTAMA -->
  <main>
    <!-- BERANDA -->
    <!-- CAROUSEL BERANDA -->
    <div id="carouselExampleAutoplaying" class="carousel slide position-relative" data-bs-ride="carousel">

      <!-- TEKS TETAP -->
      <div class="carouselText position-absolute top-50 start-50 translate-middle text-center text-white">
        <h1 class="fw-bold fs-1">PENGUMUMAN AKADEMIK</h1>
        <h5>Politeknik Negeri Batam</h5>
      </div>

      <!-- ISI CAROUSEL -->
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="public/assets/CarouselPolibatam.jpg" class="d-block w-100" alt="Gambar 1">
        </div>

        <div class="carousel-item">
          <img src="public/assets/BackgroundPOLTEK.png" class="d-block w-100" alt="Gambar 2">
        </div>

        <div class="carousel-item">
          <img src="public/assets/PolibatamCarousel3.webp" class="d-block w-100" alt="Gambar 3">
        </div>
      </div>

      <!-- TOMBOL -->
      <button class="carousel-control-prev" type="button"
        data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>

      <button class="carousel-control-next" type="button"
        data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>

    </div>


    <!-- PENGUMUMAN TERBARU -->
    <div class="container mt-5">
      <h2 class="text-center mb-3 fs-3">Pengumuman Terbaru</h2>

      <!-- Filter + Search Bar -->
      <div class="d-flex justify-content-start align-items-center mb-4 gap-2">
        <div class="input-group w-25 shadow-sm">
          <input type="search" class="form-control mobile-search" id="searchBar" name="searchBar" placeholder="Cari Informasi...">
          <span class="input-group-text" style="cursor: pointer;">
            <i class="bi bi-search"></i>
          </span>
        </div>

        <button class="btn btn-primary shadow " id="openFilter" data-bs-toggle="modal" data-bs-target="#filterModal">
          <i class="bi bi-funnel-fill"></i>Filter
        </button>
      </div>

      <div class="row">
        <div id="cardContainer" class="row card-center-mobile g-4">
          <?php
          renderAllCard($conn, $filter = [
            'tanggal' => $tanggal
          ]);
          ?>
        </div>


        <!-- BIO WEB -->
        <div class="container mt-5 mb-5">
          <h3 class="fw-semibold mt-3">Tentang WEB</h3>
          <p class="fs-6">
            Web Pengumuman Akademik Online adalah platform berbasis web yang dirancang untuk mempermudah penyampaian informasi akademik kepada mahasiswa secara cepat, efisien, dan terpusat.
            Melalui sistem ini, mahasiswa dapat mengakses berbagai pengumuman penting seperti jadwal ujian, Beasiswa dan perubahan kelas kapan saja dan di mana saja.
          </p>
        </div>
      </div>
    </div>
  </main>


  <!-- FOOTER -->
  <footer class="bg-dark text-white pt-4 pb-3">
    <div class="container">
      <!-- DESKTOP: ROW | MOBILE: COLUMN -->
      <div class="row align-items-center justify-content-between g-4">

        <!-- KOL 1: LOGO -->
        <div class="col-md-4 text-center text-md-start">
          <img src="public/assets/Logo-Poltek.png" alt="Politeknik Negeri Batam" width="200" class="mb-3 mb-md-0">
        </div>

        <!-- KOL 2: ALAMAT & KONTAK -->
        <div class="col-md-4 text-center text-md-start">
          <h5>Alamat & Kontak</h5>
          <p class="mb-1">Jl. Ahmad Yani, Batam Kota<br>Kepulauan Riau, Indonesia</p>
          <p class="mb-1">Email: info@polibatam.ac.id</p>
          <p class="mb-0">Telp: +62 778 469858 Ext.1017</p>
        </div>

        <!-- KOL 3: SOSIAL MEDIA -->
        <div class="col-md-4 text-center">
          <h5>Ikuti Kami</h5>
          <div class="d-flex justify-content-center gap-2 flex-wrap">
            <a href="https://www.instagram.com/polibatamofficial" class="btn btn-outline-light btn-sm" target="_blank" aria-label="Instagram">
              <i class="bi bi-instagram"></i>
            </a>
            <a href="https://www.facebook.com/share/197ijZ4QfT/" class="btn btn-outline-light btn-sm" target="_blank" aria-label="Facebook">
              <i class="bi bi-facebook"></i>
            </a>
            <a href="https://www.youtube.com/@PolibatamTV" class="btn btn-outline-light btn-sm" target="_blank" aria-label="YouTube">
              <i class="bi bi-youtube"></i>
            </a>
          </div>
        </div>

      </div>

      <!-- COPYRIGHT -->
      <div class="text-center border-top border-secondary mt-4">
        <p class="mb-0">&copy; 2025 Politeknik Negeri Batam</p>
      </div>
    </div>
  </footer>

  <!-- MODAL FILTER -->
  <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="GET" action="index.php">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="filterModalLabel">Filter Pengumuman</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label"><b>Tanggal Publikasi :</b></label>
              <input type="date" name="tanggal" class="form-control" value="<?= $_GET['tanggal'] ?? '' ?>">
            </div>
          </div>
          <div class="modal-footer">
            <a href="index.php" class="btn btn-secondary">Reset</a>
            <button type="submit" class="btn btn-primary">Terapkan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script src="public/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="public/style/search.js"></script>



</body>

</html>