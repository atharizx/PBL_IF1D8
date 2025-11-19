function logoutconfirm() {
    Swal.fire ({
        icon : 'warning',
        title: 'Logout',
        text : 'Apakah Anda yakin ingin keluar?',
        showCancelButton : true,
        confirmButtonText : 'Keluar',
        cancelButtonText : 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../../controller/logout.php';
        }
    });
}