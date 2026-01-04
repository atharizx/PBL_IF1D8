const searchBar = document.getElementById('searchBar');
const cardContainer = document.getElementById('cardContainer');

if (searchBar && cardContainer) {
    let originalContent = cardContainer.innerHTML;

    searchBar.addEventListener('input', function () {
        const q = searchBar.value.trim();
 
        if (q.length < 2) {
            cardContainer.innerHTML = originalContent;
            return;
        }

        fetch('app/controller/searchRes_controller.php?q=' + encodeURIComponent(q))
            .then(response => response.text())
            .then(html => {
                if (html.trim()) {
                    cardContainer.innerHTML = html;
                } else {
                    cardContainer.innerHTML = `
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">Tidak ada hasil untuk: <strong>${q}</strong></p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                cardContainer.innerHTML = `
                    <div class="col-12 text-center py-5 text-danger">
                        Gagal memuat hasil
                    </div>
                `;
            });
    });
}
