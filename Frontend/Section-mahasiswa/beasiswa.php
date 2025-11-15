<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beasiswa</title>
  <link rel="icon" href="https://sim.polibatam.ac.id/assets/img_sim/d8f9867f-23a7-4558-974b-d3c03a621fa3.png">
  <link href="/PROJEK_PBL/Frontend/Bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/PROJEK_PBL/Frontend/Bootstrap/icons/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">


  <style>
    html, body {
      height: 100%;
      font-family: 'roboto';
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    main {
      flex: 1;
    }

    /*CAROUSEL*/
    .carousel-item img {
      width: 100%;
      height: 400px;
      object-fit: cover;
      object-position: center;
    }

    /* Efek untuk navbar saat muncul */
    .navbar-collapse {
      transition: all 0.3s ease;
    }
    
    /* Gradient Background */
    .gradient-background {
      background: linear-gradient(to left, #000000, #302f2f, #929090);
    }

    .hidden {
      display: none;
    }

  </style>
</head>

<body>
  <!-- NAVBAR RESPONSIVE -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-black">
    <div class="container-fluid">
      <!-- LOGO + JUDUL -->
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="https://sim.polibatam.ac.id/assets/img_sim/d8f9867f-23a7-4558-974b-d3c03a621fa3.png"
             alt="Logo" width="60" class="me-2">
        <span class="fw-semibold">Pengumuman Akademik Online</span>
      </a>

      <!-- TOMBOL TOGGLER (HAMBURGER) UNTUK MOBILE -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
        aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- MENU NAV -->
      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-lg-center">
          <li class="nav-item">
            <a href="/PROJEK_PBL/Frontend/Section-mahasiswa/beranda.php" class="nav-link fw-semibold text-white">Beranda</a>
          </li>
          <li class="nav-item">
            <a href="/PROJEK_PBL/Frontend/Section-mahasiswa/jadwalujian.php" class="nav-link fw-semibold text-white">Jadwal Ujian</a>
          </li>
          <li class="nav-item">
            <a href="/PROJEK_PBL/Frontend/Section-mahasiswa/beasiswa.php" class="nav-link fw-semibold text-white">Beasiswa</a>
          </li>
          <li class="nav-item">
            <a href="/PROJEK_PBL/Frontend/Section-mahasiswa/perubahankelas.php" class="nav-link fw-semibold text-white">Perubahan Kelas</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- KONTEN UTAMA -->
  <main>
    <!-- BERANDA -->
    <section id="beranda" class="active">
      
    <!-- PENGUMUMAN TERBARU -->
    <section id="pengumuman-terbaru">
      <div class="container mt-5">
        <h2 class="text-center mb-3 fw-semibold">INFORMASI BEASISWA TERBARU</h2>

        <!-- Filter + Search Bar -->
        <div class="d-flex justify-content-start align-items-center mb-5 gap-2">
          <button class="btn btn-primary" id="openFilter" data-bs-toggle="modal" data-bs-target="#filterModal">
            <i class="bi bi-funnel-fill"></i>Filter
          </button>
        </div>

        <div class="row" id="cardContainer">
          
        </div>

        <!-- Detail Informasi Jadwal Ujian -->
        <div class="hidden" id="detailPage">
          <button class="btn btn-secondary" id="backBTN">
            <i class="bi bi-box-arrow-left"></i> Kembali
          </button>
          <div class="card shadow-sm">
            <div class="card-body">
              <h3 id="detailTitle"></h3>
              <p class="text-muted" id="detailDate"></p>
              <div id="detailContent">
                <!-- Konten detail akan dirender di sini -->
              </div>
            </div>
          </div>
        </div>

        <!-- BIO WEB -->
        <section id="bioweb" class="container mt-5 mb-5">
          <h3 class="fw-semibold mt-3">Tentang WEB</h3>
          <p class="fs-6">
            Web Pengumuman Akademik Online adalah platform berbasis web yang dirancang untuk mempermudah penyampaian informasi akademik kepada mahasiswa secara cepat, efisien, dan terpusat.
            Melalui sistem ini, mahasiswa dapat mengakses berbagai pengumuman penting seperti jadwal ujian, Beasiswa dan perubahan kelas kapan saja dan di mana saja.
          </p>
        </section>
      </div>
    </section>
    </main>

  <!-- FOOTER -->
  <footer class="gradient-background text-white py-2 mt-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
          <img src="https://sim.polibatam.ac.id/assets/img_sim/d8f9867f-23a7-4558-974b-d3c03a621fa3.png"
               alt="Logo" width="175">
        </div>

        <div class="col-md-4">
          <h5>Alamat & Kontak</h5>
          <p class="mb-1">Jln. Ahmad Yani Batam Kota, Kota Batam, Kepulauan Riau, Indonesia</p>
          <p class="mb-1">Email: info@polibatam.ac.id</p>
          <p class="mb-0">Telpon: +62-778-469858 Ext.1017</p>
        </div>

        <div class="col-md-4 text-center mt-0">
          <h5>Ikuti Kami</h5>
          <a href="https://www.instagram.com/polibatamofficial?igsh=eGpjZm5jZmR4NTJy" class="btn btn-success mb-2"><i class="bi bi-instagram"></i>Instagram</a><br>
          <a href="https://www.facebook.com/share/197ijZ4QfT/" class="btn btn-primary me-1"><i class="bi bi-facebook"></i>Facebook</a>
          <a href="https://www.youtube.com/@PolibatamTV" class="btn btn-danger"><i class="bi bi-youtube"></i>Youtube</a>
        </div>
      </div>
    </div>
  </footer>

  <footer class="bg-black text-white py-2">
    <div class="container text-center">
      <p class="mb-0 fs-6">© 2025 Politeknik Negeri Batam</p>
    </div>
  </footer>

  <!-- MODAL FILTER -->
  <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="filterModalLabel">Filter Pengumuman</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="categoryFilter" class="form-label">Kategori :</label>
            <select id="categoryFilter" class="form-select">
              <option value="jadwal_filter">Jadwal Ujian</option>
              <option value="beasiswa_filter">Beasiswa</option>
              <option value="kelas_filter">Perubahan Kelas</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="tanggal_publikasi_filter" class="form-label">Tanggal Publikasi :</label>
            <input type="date" id="tanggal_publikasi_filter" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="resetBtn" class="btn btn-secondary" data-bs-dismiss="modal">Reset</button>
          <button type="button" id="applyBtn" class="btn btn-primary">Terapkan</button>
        </div>
      </div>
    </div>
  </div>

  
  <!-- Modal Detail Jadwal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content bg-light border-0 shadow-lg rounded-4">
      <!-- Header -->
      <div class="modal-header border-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <!-- Gambar -->
        <div class="mb-3">
          <!-- Tempat Render Gambar -->
        </div>

        <!-- Judul & Tanggal -->
        <div class="d-flex justify-content-between align-items-start mb-3">
          <h4 class="fw-bold" id="modalTitle"></h4>
          <small class="fw-semibold text-muted" id="modalDate"></small>
        </div>

        <!-- Deskripsi -->
        <div id="isiModal" class="text-dark text-warp" style="line-height: 1.6;">
          
        </div>

        <!-- Link Download -->
        <div class="mt-4">
          <p class="fw-semibold text-danger mb-1" id="modalContent"></p>
          <a href="#" id="detailLink" target="_blank" class="text-decoration-none fw-bold text-primary"></a>
        </div>
      </div>
    </div>
  </div>
</div>

  <script src="/PROJEK_PBL/Frontend/Bootstrap/js/bootstrap.bundle.js"></script>

</body>
</html>
