function applyFilter () {
    const tanggal = document.getElementById['tanggal'];

    let url = "beranda.php?";

    if (tanggal) url += `tanggal=${tanggal}`;

    url = url.replace(/&$/, '');

    window.location.href = url;
}

function resetFilter () {
    window.location.href = 'beranda.php';
}