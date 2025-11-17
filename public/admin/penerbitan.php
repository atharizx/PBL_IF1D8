<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Penerbitan Informasi</title>
  <link href="https://sim.polibatam.ac.id/assets/img_sim/d8f9867f-23a7-4558-974b-d3c03a621fa3.png" rel="icon">
  <link href="../style/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap"rel="stylesheet">
  <link href="../style/icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../style/extadmin.css" rel="stylesheet">
  <script src="../Bootstrap/AlertJS/sweetalert2.all.min.js"></script>
</head>

<body class="bg-light d-flex flex-column">
  <!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid d-flex justify-content-between align-items-center px-3 px-md-5">

    <!-- Logo + Judul -->
    <div class="d-flex align-items-center">
      <img
        src="https://sim.polibatam.ac.id/assets/img_sim/d8f9867f-23a7-4558-974b-d3c03a621fa3.png"
        alt="Logo"
        width="70"
        class="me-3"
      />
      <h3 class="navbar-brand fw-bold mb-0">Penerbitan Informasi</h3>
    </div>

    <!-- Tombol Dropdown Mobile -->
    <button
      class="menu-btn d-lg-none order-lg-3"
      type="button"
      data-bs-toggle="offcanvas"
      data-bs-target="#mobileSidebar"
    >
      ☰
    </button>

    <!-- Right Navbar Content -->
    <div class="d-none d-lg-flex align-items-center gap-3 order-lg-2">
      <!-- Tombol Riwayat -->
      <a href="../admin/riwayat.php" class="text-white fw-bold" style="text-decoration: none;" id="lihatRiwayat">RIWAYAT</a>

      <!-- Dropdown -->
      <div class="dropdown">
        <button class="btn p-0 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: none;">
          <img src="../assets/Profil-Logo.png" width="50" alt="Profil">
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow text-center">
          <li><p class="mb-1 fw-semibold">Affatha Rizky Sena</p></li>
          <li><hr class="my-1 fs-1">3312501117</li>
          <li><button class="dropdown-item text-danger fw-bold">
            <i class="bi bi-box-arrow-left me-2 mt-3"></i>Keluar</button></li>
        </ul>
      </div>
    </div>

  </div>
</nav>


  <!-- SIDEBAR MOBILE -->
  <div
    class="offcanvas offcanvas-end offcanvas-sidebar"
    tabindex="-1"
    id="mobileSidebar"
  >
    <div class="offcanvas-header">
      <h5 class="offcanvas-title fw-bold">MENU</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">  
      <div class="list-group mb-3">
        <a href="../admin/riwayat.php"
          class="list-group-item list-group-item-action fw-semibold"
          >📜 Riwayat</a>
        <button
          class="list-group-item list-group-item-action text-danger fw-bold"
          data-bs-dismiss="offcanvas"><i class="bi bi-box-arrow-left"></i> Keluar
        </button>
      </div>
      <hr />
      <h6 class="fw-bold mb-2">KATEGORI :</h6>
      <div class="list-group">
        <button
          class="list-group-item list-group-item-action fw-semibold"
          data-page="jadwalUjian"
          onclick="showPage('jadwalUjian', event)"
          data-bs-dismiss="offcanvas"
        >
          📆 Jadwal Ujian
        </button>
        <button
          class="list-group-item list-group-item-action fw-semibold"
          data-page="beasiswa"
          onclick="showPage('beasiswa', event)"
          data-bs-dismiss="offcanvas"
        >
          🎓 Beasiswa
        </button>
        <button
          class="list-group-item list-group-item-action fw-semibold"
          data-page="perubahanKelas"
          onclick="showPage('perubahanKelas', event)"
          data-bs-dismiss="offcanvas"
        >
          🔄 Perubahan Kelas
        </button>
      </div>
    </div>
  </div>

  <!-- MAIN CONTENT -->
  <main class="flex-grow-1">
    <div class="container-fluid mt-0 bg-light">
      <div class="row">
        <!-- SIDEBAR DESKTOP -->
        <aside
          class="sidebar col-md-3 col-lg-2 bg-secondary bg-opacity-5 py-3 border-end d-none d-lg-block">
          <h5 class="fw-bold mb-3">KATEGORI :</h5>
          <div class="list-group">
            <!-- Jadwal Ujian-->
            <button
              class="list-group-item list-group-item-action fw-semibold btn btn-light"
              data-page="jadwalUjian"
              onclick="showPage('jadwalUjian', event)"><i class="bi bi-calendar2-event-fill me-2"></i>Jadwal Ujian
            </button>
            <br />
            <!-- Beasiswa -->
            <button
              class="list-group-item list-group-item-action fw-semibold btn btn-light"
              data-page="beasiswa"
              onclick="showPage('beasiswa', event)"><i class="bi bi-mortarboard me-2"></i>Beasiswa 
            </button>
            <br />
            <!-- Perubahan Kelas-->
            <button
              class="list-group-item list-group-item-action fw-semibold btn btn-light"
              data-page="perubahanKelas"
              onclick="showPage('perubahanKelas', event)"><i class="bi bi-arrow-left-right me-2"></i>Perubahan Kelas
            </button>
          </div>
        </aside>

        <!-- KONTEN -->
        <div class="col-md-9 col-lg-10 p-4">
          <h3 class="mb-4 fw-bold">Upload Informasi</h3>

          <!-- JADWAL UJIAN -->
          <section id="jadwalUjian" class="active">
            <form method="post">
              <div class="mb-3">
                <label for="Judul Informasi" class="fw-semibold form-label">Judul Informasi :</label>
                <input type="text" id="judulJadwal" name="judulJadwal" class="form-control" placeholder="Masukkan Judul Informasi">
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold" for="Masa Berlaku">Masa Berlaku Informasi :</label>
                <input type="date" id="masaberlakuJadwal" name="masaberlakuJadwal" class="form-control">
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold" for="Jurusan">Pilih Jurusan</label>
                <select id="jurusanJadwal" class="form-select">
                  <option value="">-- Pilih Jurusan --</option>
                  <option value="informatika">Teknik Informatika</option>
                  <option value="elektro">Teknik Elektro</option>
                  <option value="mesin">Teknik Mesin</option>
                  <option value="bisnis">Manajemen Bisnis</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold" for="File Excel">Upload File Jadwal (Excel) :</label>
                <input type="file" id="excelJadwal" name="excelJadwal" accept=".xls,.xlsx" class="form-control">
              </div>
              <div class="mb-3">
                <label for="gambarJadwal" class="fw-semibold">Upload Foto (optional) :</label>
                <input type="file" class="form-control" id="gambarJadwal" accept=".png, .jpg">
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold" for="Deskripsi Informasi">Deskripsi :</label>
                <textarea name="deskripsiJadwal" class="form-control" rows="3" placeholder="Masukkan Deskripsi Informasi..." id="deskripsiJadwal"></textarea>
              </div>
              <div class="btn-upload">
                <button type="submit" class="btn btn-primary">UPLOAD</button>
              </div>
            </form>
          </section>

          <!-- BEASISWA -->
          <section id="beasiswa">
            <form method="post" id="formBeasiswa">
              <div class="mb-3">
                <label for="namaBeasiswa" class="fw-semibold form-label">Nama Beasiswa :</label>
                <input type="text" id="namaBeasiswa" name="namaBeasiswa" class="form-control" placeholder="Masukkan Nama Beasiswa">
              </div>
              <div class="mb-3">
                <label for="masaberlakuBeasiswa" class="fw-semibold form-label">Masa Berlaku Informasi :</label>
                <input type="date" class="form-control" name="masaberlakuBeasiswa" id="masaberlakuBeasiswa">
              </div>
              <div class="mb-3">
                <label for="linkBeasiswa" class="form-label fw-semibold">Link Pendaftaran :</label>
                <input type="url" id="linkBeasiswa" class="form-control" placeholder="Masukkan link pendaftaran" name="linkBeasiswa">
              </div>
              <div class="mb-3">
                <label for="gambarBeasiswa" class="fw-semibold">Upload Foto (optional) :</label>
                <input type="file" class="form-control" id="gambarBeasiswa" accept=".png, .jpg">
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Deskripsi :</label>
                <textarea name="deskripsiBeasiswa" class="form-control" rows="3" placeholder="Masukkan Deskripsi Informasi..." id="deskripsiBeasiswa"></textarea>
              </div>
              <div class="btn-upload">
                <button type="submit" class="btn btn-primary">UPLOAD</button>
              </div>
            </form>
          </section>

          <!-- PERUBAHAN KELAS -->
          <section id="perubahanKelas">
            <form method="post" id="formKelas">
              <div class="mb-3">
                <label for="judulKelas" class="fw-semibold form-label">Judul Informasi</label>
                <input type="text" id="judulKelas" name="judulKelas" class="form-control" placeholder="Masukkan Judul Informasi">
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Pilih Jurusan</label>
                <select id="jurusanKelas" class="form-select">
                  <option value="">-- Pilih Jurusan --</option>
                  <option value="informatika">Teknik Informatika</option>
                  <option value="elektro">Teknik Elektro</option>
                  <option value="mesin">Teknik Mesin</option>
                  <option value="bisnis">Manajemen Bisnis</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Masa Berlaku Informasi :</label>
                <input type="date" name="masaberlakuKelas" id="masaberlakuKelas" class="form-control">
              </div>
              <div class="mb-3">
                <label for="excelKelas" class="form-label fw-semibold">Upload File Perubahan Kelas (Excel)</label>
                <input type="file" id="excelKelas" name="excelKelas" class="form-control" accept=".xls,.xlsx">
              </div>
              <div class="mb-3">
                <label for="gambarKelas" class="fw-semibold">Upload Foto (optional) :</label>
                <input type="file" class="form-control" id="gambarKelas" accept=".png, .jpg">
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Deskripsi Informasi :</label>
                <textarea class="form-control" rows="3" placeholder="Masukkan Deskripsi Informasi" id="deskripsiKelas"></textarea>
              </div>
              <div class="btn-upload">
                <button type="submit" class="btn btn-primary">UPLOAD</button>
              </div>
            </form>
          </section>
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

  <script src="../style/js/bootstrap.bundle.min.js"></script>

</body>
</html>
