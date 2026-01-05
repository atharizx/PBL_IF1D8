<?php
session_start();
include '../../app/config/db_conn.php';
include '../../app/component/alert.php';
include '../../app/helper/showalert_helper.php';
include '../../app/models/riwayatTable_model.php';
include '../../app/controller/sessionCheck_controller.php';


$nama = $_SESSION['nama'] ?? '';
$nidn = $_SESSION['nidn'] ?? '';

sessionCheckHandler();
roleCheckHandlerAtPenerbitan();

$edit_type = $_GET['type'] ?? '';
$edit_id = $_GET['noinformasi'] ?? '';

$data_lama = "";
if ($edit_id !== '' && $edit_type !== '') {
  $data_lama = takeDataLamaForInputEdit($conn, $edit_id, $edit_type, $_SESSION['user_id']);
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Penerbitan Informasi</title>
  <link href="../assets/Logo-Poltek.png" rel="icon">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto  :wght@400;500;700&display=swap" rel="stylesheet">
  <link href="../vendor/bootstrap/icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../style/extadmin.css" rel="stylesheet">

  <script src="../vendor/sweetalert/sweetalert2.all.min.js"></script>
</head>

<body class="bg-light d-flex flex-column">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-0">
    <div class="container-fluid px-4">

      <!-- KIRI: LOGO -->
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
            <a href="riwayat.php" class="nav-link fw-bold">Riwayat</a>
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
    class="offcanvas offcanvas-end offcanvas-sidebar bg-dark"
    tabindex="-1"
    id="mobileSidebar">

    <div class="offcanvas-header d-flex flex-column align-items-start">
      <h5 class="offcanvas-title fw-bold mt-2">MENU</h5>
      <div class="user-info mb-2 mt-4 form-control bg-dark text-white">
        <p class="mb-0 fw-semibold"><?php echo ($nama) ?></p>
        <p class="mb-0 fs-6"><?php echo ($nidn) ?></p>
      </div>
      <button
        type="button"
        class="btn-close position-absolute end-0 top-0 m-3 btn-close-white"
        data-bs-dismiss="offcanvas">
      </button>
    </div>

    <div class="offcanvas-body">

      <h6 class="fw-bold mb-2 text-white">KATEGORI :</h6>

      <div class="list-group mb-3">
        <button
          class="list-group-item list-group-item-action fw-semibold mb-2 text-dark rounded"
          data-page="jadwalUjian"
          onclick="showPage('jadwalUjian', event)"
          data-bs-dismiss="offcanvas">
          📆 Jadwal Ujian
        </button>

        <button
          class="list-group-item list-group-item-action fw-semibold mb-2 text-dark rounded"
          data-page="beasiswa"
          onclick="showPage('beasiswa', event)"
          data-bs-dismiss="offcanvas">
          🎓 Beasiswa
        </button>

        <button
          class="list-group-item list-group-item-action fw-semibold mb-2 text-dark rounded"
          data-page="perubahanKelas"
          onclick="showPage('perubahanKelas', event)"
          data-bs-dismiss="offcanvas">
          🔄 Perubahan Kelas
        </button>
      </div>

      <hr />

      <div class="list-group mb-3">
        <a href="../admin/riwayat.php"
          class="list-group-item list-group-item-action fw-semibold mb-2 rounded">
          <i class="bi bi-clock-history me-2"></i> Riwayat
        </a>

        <button
          class="list-group-item list-group-item-action text-danger fw-bold rounded"
          data-bs-dismiss="offcanvas"
          id="btnLogoutMobile">
          <i class="bi bi-box-arrow-left me-2"></i> Keluar
        </button>
      </div>

    </div>
  </div>

  <!-- MAIN CONTENT -->
  <main class="flex-grow-1">
    <div class="container-fluid mt-0">
      <div class="row">
        <!-- SIDEBAR DESKTOP -->
        <aside
          class="sidebar col-md-3 col-lg-2 bg-secondary bg-opacity-5 py-3 border-end d-none d-lg-block">
          <h5 class="fw-bold mb-3 text-white shadowForText">KATEGORI : </h5>
          <div class="list-group">
            <!-- Jadwal Ujian-->
            <button
              class="list-group-item list-group-item-action fw-semibold mb-4 btn"
              data-page="jadwalUjian" onclick="showPage('jadwalUjian', event)">
              <i class="bi bi-calendar2-event-fill me-2"></i>Jadwal Ujian
            </button>

            <!-- Beasiswa -->
            <button
              class="list-group-item list-group-item-action fw-semibold mb-4 btn"
              data-page="beasiswa" onclick="showPage('beasiswa', event)">
              <i class="bi bi-mortarboard me-2"></i>Beasiswa
            </button>

            <!-- Perubahan Kelas-->
            <button
              class="list-group-item list-group-item-action fw-semibold btn"
              data-page="perubahanKelas" onclick="showPage('perubahanKelas', event)">
              <i class="bi bi-arrow-left-right me-2"></i>Perubahan Kelas
            </button>
          </div>
        </aside>

        <!-- KONTEN -->
        <div class="col-md-10 col-lg-10 p-0">
          <div class="col-md-9 w-100 p-4 position-relative">
            <!-- JADWAL UJIAN -->
            <section id="jadwalUjian" class="active">
              <div class="form-card shadow-sm p-5 mb-5 bg-white rounded mt-2">
                <h3 class="mb-4 fw-bold">
                  <?php if ($data_lama && $edit_type == 'jadwalujian'): ?>
                    Edit Informasi Jadwal Ujian
                  <?php else: ?>
                    Upload Informasi Jadwal Ujian
                  <?php endif; ?>
                </h3>

                <?php if ($data_lama && $edit_type == 'jadwalujian'): ?>
                  <form method="POST" action="../../app/controller/editJadwal_controller.php" enctype="multipart/form-data">
                  <?php else: ?>
                    <form method="POST" action="../../app/controller/jadwal_controller.php" enctype="multipart/form-data">
                    <?php endif; ?>

                    <?php if ($data_lama && $edit_type == 'jadwalujian'): ?>
                      <input type="hidden" name="id" value="<?= $data_lama['id'] ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                      <label class="fw-semibold form-label">Judul Informasi :</label>
                      <input type="text" name="judulJadwal" class="form-control shadow"
                        value="<?= $data_lama['judul'] ?? '' ?>"
                        placeholder="Masukkan Judul Informasi">
                    </div>

                    <div class="mb-3">
                      <label class="form-label fw-semibold">Masa Berlaku Informasi :</label>
                      <input type="date" name="masaBerlakuJadwal" class="form-control shadow"
                        value="<?= $data_lama['masaberlaku'] ?? '' ?>">
                    </div>

                    <div class="mb-3">
                      <label class="form-label fw-semibold">Pilih Jurusan</label>
                      <select name="jurusanJadwal" class="form-select shadow">
                        <option value="" disabled selected>-- Pilih Jurusan --</option>
                        <option value="Teknik Informatika" <?= ($data_lama['jurusan'] ?? '') == 'Teknik Informatika' ? 'selected' : '' ?>>Teknik Informatika</option>
                        <option value="Teknik Elektro" <?= ($data_lama['jurusan'] ?? '') == 'Teknik Elektro' ? 'selected' : '' ?>>Teknik Elektro</option>
                        <option value="Teknik Mesin" <?= ($data_lama['jurusan'] ?? '') == 'Teknik Mesin' ? 'selected' : '' ?>>Teknik Mesin</option>
                        <option value="Manajemen Bisnis" <?= ($data_lama['jurusan'] ?? '') == 'Manajemen Bisnis' ? 'selected' : '' ?>>Manajemen Bisnis</option>
                      </select>
                    </div>

                    <div class="mb-3">
                      <label class="form-label fw-semibold">Upload File Jadwal (Excel) :</label>
                      <input type="file" name="excelJadwal" class="form-control shadow" accept=".xls,.xlsx">
                    </div>

                    <div class="mb-3">
                      <label class="form-label fw-semibold">Upload Foto (optional) :</label>
                      <input type="file" name="gambarJadwal" class="form-control shadow" accept=".png,.jpg,.jpeg">
                    </div>

                    <div class="mb-3">
                      <label class="form-label fw-semibold">Deskripsi :</label>
                      <textarea name="deskripsiJadwal" class="form-control shadow" rows="3"
                        placeholder="Masukkan Deskripsi Informasi..."><?= $data_lama['deskripsi'] ?? '' ?></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                      <button type="submit" name="submitJadwal" class="btn btn-primary shadow">
                        <?php if ($data_lama && $edit_type == 'jadwalujian'): ?>
                          Simpan Perubahan
                        <?php else: ?>
                          UPLOAD
                        <?php endif; ?>
                      </button>
                    </div>
                    </form>
              </div>
              <?php showAlertJadwal(); ?>
            </section>

            <!-- BEASISWA -->
            <section id="beasiswa">
              <div class="form-card shadow-sm p-5 mb-5 bg-white rounded flex-fill mt-2">

                <?php if ($data_lama && $edit_type == 'beasiswa'): ?>
                  <form method="POST" action="../../app/controller/editBeasiswa_controller.php" enctype="multipart/form-data">
                  <?php else: ?>
                    <form method="POST" action="../../app/controller/beasiswa_controller.php" enctype="multipart/form-data">
                    <?php endif; ?>

                    <h3 class="mb-4 fw-bold">
                      <?php if ($data_lama && $edit_type == 'beasiswa'): ?>
                        Edit Informasi Beasiswa
                      <?php else: ?>
                        Upload Informasi Beasiswa
                      <?php endif; ?>
                    </h3>

                    <?php if ($data_lama && $edit_type == 'beasiswa'): ?>
                      <input type="hidden" name="id" value="<?= $data_lama['id'] ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                      <label for="namaBeasiswa" class="fw-semibold form-label">Nama Beasiswa :</label>
                      <input type="text" id="namaBeasiswa" name="namaBeasiswa" class="form-control shadow"
                        value="<?= $data_lama['namabeasiswa'] ?? '' ?>"
                        placeholder="Masukkan Nama Beasiswa">
                    </div>

                    <div class="mb-3">
                      <label for="masaberlakuBeasiswa" class="fw-semibold form-label">Masa Berlaku Informasi :</label>
                      <input type="date" class="form-control shadow" name="masaBerlakuBeasiswa" id="masaBerlakuBeasiswa"
                        value="<?= $data_lama['masaberlaku'] ?? '' ?>">
                    </div>

                    <div class="mb-3">
                      <label for="linkBeasiswa" class="form-label fw-semibold">Link Pendaftaran :</label>
                      <input type="url" id="linkBeasiswa" class="form-control shadow"
                        value="<?= $data_lama['linkpendaftaran'] ?? '' ?>"
                        placeholder="Masukkan link pendaftaran" name="linkBeasiswa">
                    </div>

                    <div class="mb-3">
                      <label for="gambarBeasiswa" class="fw-semibold">Upload Foto (optional) :</label>
                      <input type="file" class="form-control shadow" id="gambarBeasiswa" name="gambarBeasiswa" accept=".png,.jpg,.jpeg">
                    </div>

                    <div class="mb-3">
                      <label class="form-label fw-semibold">Deskripsi :</label>
                      <textarea name="deskripsiBeasiswa" class="form-control shadow" rows="3"
                        placeholder="Masukkan Deskripsi Informasi..." id="deskripsiBeasiswa"><?= $data_lama['deskripsi'] ?? '' ?></textarea>
                    </div>

                    <div class="btn-upload">
                      <button type="submit" name="submitBeasiswa" class="btn btn-primary shadow">
                        <?php if ($data_lama && $edit_type == 'beasiswa'): ?>
                          Simpan Perubahan
                        <?php else: ?>
                          UPLOAD
                        <?php endif; ?>
                      </button>
                    </div>
                    </form>
              </div>
              <?php showAlertBeasiswa(); ?>
            </section>

            <!-- PERUBAHAN KELAS -->
            <section id="perubahanKelas">
              <div class="form-card shadow-sm p-5 mb-5 bg-white rounded flex-fill mt-2">
                <?php if ($data_lama && $edit_type == 'perubahankelas'): ?>
                  <form method="post" action="../../app/controller/editKelas_controller.php" enctype="multipart/form-data">
                  <?php else: ?>
                    <form method="post" action="../../app/controller/kelas_controller.php" enctype="multipart/form-data">
                    <?php endif; ?>

                    <?php if ($data_lama && $edit_type == 'perubahankelas'): ?>
                      <input type="hidden" name="id" value="<?= $data_lama['id'] ?>">
                    <?php endif; ?>

                    <h3 class="mb-4 fw-bold">
                      <?php if ($data_lama && $edit_type == 'perubahankelas'): ?>
                        Edit Informasi Perubahan Kelas
                      <?php else: ?>
                        Upload Informasi Perubahan Kelas
                      <?php endif; ?>
                    </h3>

                    <div class="mb-3">
                      <label for="judulKelas" class="fw-semibold form-label">Judul Informasi</label>
                      <input type="text" id="judulKelas" name="judulKelas" class="form-control shadow" placeholder="Masukkan Judul Informasi"
                        value="<?= $data_lama['judul'] ?? '' ?>">
                    </div>

                    <div class="mb-3">
                      <label class="form-label fw-semibold">Masa Berlaku Informasi :</label>
                      <input type="date" name="masaBerlakuKelas" id="masaBerlakuKelas" class="form-control shadow"
                        value="<?= $data_lama['masaberlaku'] ?? '' ?>">
                    </div>

                    <div class="mb-3">
                      <label class="form-label fw-semibold">Pilih Jurusan</label>
                      <select id="jurusanKelas" class="form-select shadow" name="jurusanKelas">
                        <option value="" disabled selected>-- Pilih Jurusan --</option>
                        <option value="Teknik Informatika" <?= ($data_lama['jurusan'] ?? '') == 'Teknik Informatika' ? 'selected' : '' ?>>Teknik Informatika</option>
                        <option value="Teknik Elektro" <?= ($data_lama['jurusan'] ?? '') == 'Teknik Elektro' ? 'selected' : '' ?>>Teknik Elektro</option>
                        <option value="Teknik Mesin" <?= ($data_lama['jurusan'] ?? '') == 'Teknik Mesin' ? 'selected' : '' ?>>Teknik Mesin</option>
                        <option value="Manajemen Bisnis" <?= ($data_lama['jurusan'] ?? '') == 'Manajemen Bisnis' ? 'selected' : '' ?>>Manajemen Bisnis</option>
                      </select>
                    </div>

                    <div class="mb-3">
                      <label for="excelKelas" class="form-label fw-semibold">Upload File Perubahan Kelas (Excel)</label>
                      <input type="file" id="excelKelas" name="excelKelas" class="form-control shadow" accept=".xls, .xlsx">
                    </div>
                    <div class="mb-3">
                      <label for="gambarKelas" class="fw-semibold">Upload Foto (optional) :</label>
                      <input type="file" class="form-control shadow" id="gambarKelas" name="gambarKelas" accept=".png, .jpg, .jpeg, .webp">
                    </div>
                    <div class="mb-3">
                      <label class="form-label fw-semibold">Deskripsi Informasi :</label>
                      <textarea class="form-control shadow" rows="3" placeholder="Masukkan Deskripsi Informasi"
                        id="deskripsiKelas" name="deskripsiKelas"><?= $data_lama['deskripsi'] ?? '' ?></textarea>
                    </div>

                    <div class="btn-upload">
                      <button type="submit" name="submitKelas" class="btn btn-primary shadow">
                        <?php if ($data_lama && $edit_type == 'perubahankelas'): ?>
                          Simpan Perubahan
                        <?php else: ?>
                          Upload
                        <?php endif; ?>
                      </button>
                    </div>
                    </form>
              </div>
              <?php
              showAlertKelas();
              ?>
            </section>
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

  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../style/extpage.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js  "></script>
  <script src="../vendor/tinymce/textarea.js"></script>

  <?php
  alertWithoutBtn('login_success', 'success', 'Berhasil Login!');
  alertLogout('btnLogoutDesktop', 'btnLogoutMobile');
  alertWithoutBtn('wrong_role_permission', 'error', "");
  ?>
</body>

</html>
