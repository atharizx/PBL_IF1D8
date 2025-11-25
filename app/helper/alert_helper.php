<?php

function alertSuccess()
{
    if (isset($_SESSION['login_success'])) {
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Login berhasil',
                html: '" . $_SESSION['login_success'] . "',
                timer: 1500,
                showConfirmButton: false
            });
        </script>
        ";
        unset($_SESSION['login_success']);
    }
}

function alertError()
{
    if (isset($_SESSION['login_error'])) {
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Login gagal',
            text: '" . $_SESSION['login_error'] . "',
            timer: 1500,
            showConfirmButton: false
        });
        </script>
        ";
        unset($_SESSION['login_error']);
    }
}

function alertLogout($btnDesktopID, $btnMobileID)
{
    echo "
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnDesktop = document.getElementById('$btnDesktopID');
        const btnMobile = document.getElementById('$btnMobileID');

        function setupLogout(btn) {
            if (!btn) return;

            btn.addEventListener('click', function (e) {
                e.preventDefault();

                Swal.fire({
                    icon: 'warning',
                    title: 'Logout',
                    text: 'Apakah Anda yakin ingin keluar?',
                    showCancelButton: true,
                    confirmButtonText: 'Keluar',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../../app/controller/logout_controller.php';
                    }
                });
            });
        }

        setupLogout(btnDesktop);
        setupLogout(btnMobile);
    });
    </script>
    ";
}

//Alert Input Data Jadwal
function alertInputSuccess() {
    if (isset($_SESSION['msg_success'])) {
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '" . $_SESSION['msg_success'] . "',
                timer: 1500,
                showConfirmButton: false
            });
        </script>
        ";
        unset($_SESSION['msg_success']);
    }
}

function alertInputError() {
    if (isset($_SESSION['msg_error'])) {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '" . $_SESSION['msg_error'] . "',
                timer: 1500,
                showConfirmButton: false
            });
        </script>
        ";
        unset($_SESSION['msg_error']);
    }
}

function alertInputEmpty() {
    if (isset($_SESSION['msg_empty'])) {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Input Kosong!',
                html: '" . $_SESSION['msg_empty'] . "',
                timer: 1500,
                showConfirmButton: false
            });
        </script>
        ";
        unset($_SESSION['msg_empty']);
    }
}

