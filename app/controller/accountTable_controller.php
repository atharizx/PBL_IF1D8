<?php
include '../../app/models/accTable_model.php';

// Function Untuk Rendring Tabel Riwayat pada riwayat.php
function renderTabelAccount($conn)
{
    // Proses Mengambil data akun
    $dataAccount = takeDataAccountHandler($conn);

    // Mengurutkan data berdasarkan waktu penerbitan terbaru
    usort($dataAccount, fn($a, $b) => strtotime($b['waktupenambahan']) - strtotime($a['waktupenambahan']));

    if (empty($dataAccount)) {
        echo "<tr><td colspan='6' class='text-center text-muted py-3'>Akun Dosen belum di tambahkan.</td></tr>";
        return;
    }
    // Proses Merender Tabel Riwayat
    $nomor = 1;
    foreach ($dataAccount as $data) {
        $targetDel = "../../app/controller/deleteAcc_controller.php?id={$data['id']}";

        // Layout Tabel Riwayat
        echo <<<HTML
        <tr>
            <td class='text-center'>{$nomor}</td>
            <td class='text-center'>{$data['nidn']}</td>
            <td class='text-center'>{$data['nama']}</td>
            <td class='text-center'>
                <button class='btn btn-warning edit-button' data-bs-toggle='modal' data-bs-target='#editModal_{$data['id']}'>Edit</button>
                <button class='btn btn-sm btn-danger ms-2' id='deleteBtn_{$data['id']}'>Hapus</button>
            </td>
        </tr>
        HTML;

        $deleteId = 'deleteBtn_' . $data['id'];
        alertDelete($deleteId, $targetDel, 'Apakah Anda yakin ingin menghapus akun ini?');

        $nomor++;

        // Modal edit — pakai ID unik biar ga bentrok kalau ada banyak baris
        echo <<<HTML
        <div class="modal fade" id="editModal_{$data['id']}" tabindex="-1" aria-labelledby="editModalLabel_{$data['id']}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form method="post" action="../../app/controller/editAcc_controller.php">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="editModalLabel_{$data['id']}">Edit Akun Dosen</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body bg-white">
                            <div class="mb-3">
                                <input type="hidden" name="id" value="{$data['id']}">

                                <label for="editNidn" class="form-label"><b>NIDN:</b></label>
                                <input type="text" id="editNidn" name="nidn" class="form-control mb-3" value="{$data['nidn']}">

                                <label for="editNama_{$data['id']}" class="form-label"><b>NAMA:</b></label>
                                <input type="text" id="editNama" name="nama" class="form-control mb-3" value="{$data['nama']}">

                                <label for="editPass_{$data['id']}" class="form-label"><b>PASSWORD:</b></label>
                                <input type="password" id="editPass" name="pass" class="form-control" value="{$data['pw']}">
                            </div>
                        </div>
                        <div class="modal-footer bg-white">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        HTML;
    }
}
