<?php

function alertWithoutBtn($sessionKey, $icon, $title)
{
    if (isset($_SESSION[$sessionKey])) {
        echo "
        <script>
            Swal.fire({
                icon: '$icon',
                title: '$title',
                html: " . json_encode($_SESSION[$sessionKey]) . ",
                timer: 1900,
                showConfirmButton: false
            });
        </script>
        ";
        unset($_SESSION[$sessionKey]);
    }
}

function alertWithConfirmBtn($sessionKey, $icon, $title, $confirmButtonText)
{
    if (isset($_SESSION[$sessionKey])) {
        echo "
        <script>
            Swal.fire({
                icon: '$icon',
                title: '$title',
                html: '" . $_SESSION[$sessionKey] . "',
                showConfirmButton: true,
                confirmButtonText: '$confirmButtonText',
            });
        </script>
        ";
        unset($_SESSION[$sessionKey]);
        exit();
    }
}

function alertWithCancelBtn($sessionKey, $icon, $title, $cancelButtonText)
{
    if (isset($_SESSION[$sessionKey])) {
        echo "
        <script>
            Swal.fire({
                icon: '$icon',
                title: '$title',
                html: '" . $_SESSION[$sessionKey] . "',
                showCancelButton: true,
                cancelButtonText: '$cancelButtonText',
            });
        </script>
        ";
        unset($_SESSION[$sessionKey]);
    }
}

function alertWithTwoBtn($sessionKey, $icon, $title, $confirmButtonText, $cancelButtonText)
{
    if (isset($_SESSION[$sessionKey])) {
        echo "
        <script>
            Swal.fire({
                icon: '$icon',
                title: '$title',
                html: '" . $_SESSION[$sessionKey] . "',
                showConfirmButton: true,
                confirmButtonText: '$confirmButtonText',
                showCancelButton: true,
                cancelButtonText: '$cancelButtonText'
            });
        </script>
        ";
        unset($_SESSION[$sessionKey]);
    }
}

function alertWithConfirmButtonAndResultLogic($sessionKey, $targetDest, $icon, $title, $confirmButtonText) {
    if (isset($_SESSION[$sessionKey])) {
        echo "
        <script>
            Swal.fire({
                icon: '$icon',
                title: '$title',
                html: '" . $_SESSION[$sessionKey] . "',
                showConfirmButton: true,
                confirmButtonText: '$confirmButtonText',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '$targetDest';
                }
            });
        </script>
        ";
        unset($_SESSION[$sessionKey]);
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
