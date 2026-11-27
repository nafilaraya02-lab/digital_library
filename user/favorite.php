<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorites</title>
</head>
<body>
    <header class="top-header">
        <h2>Digital school library</h2>
    </header>
    <nav class="sub-header">
        <a href="fitur2-detail.html">Fitur 2: Detail & Ulasan Buku</a>
        <a href="fitur3-favorit.html" class="active-nav">Fitur 3: Buku Favorit Saya</a>
        <a href="fitur4-pinjam.html">Fitur 4: Peminjaman Saya</a>
    </nav>

    <main class="main-content">
        <div class="toolbar-top">
            <div class="section-header">
                <span class="heart-main">♡</span>
                <h3>BUKU FAVORIT</h3>
            </div>
            <button class="btn-navy" onclick="bukaModalTambahFav()">+ Tambah ke Favorit</button>
        </div>


        <div id="gridFavorit" class="book-grid"></div>
    </main>

    <div id="modalFav" class="modal-overlay">
        <div class="modal-box">
            <button class="close-btn" onclick="tutupModalFav()">✕</button>
            <form class="crud-form" onsubmit="simpanFavorit(event)">
                <h4 id="favModalHeading">Tambah Buku ke Favorit</h4>
                <input type="hidden" id="favId">
                
                <label style="font-size:12px; font-weight:600;">Pilih Buku Perpustakaan:</label>
                <select id="pilihBukuPerpus">
                    <option value="bandung after rain|bandung.jpg">bandung after rain</option>
                    <option value="harry potter|hp1.jpg">harry potter</option>
                    <option value="nightbooks|nightbooks.jpg">nightbooks</option>
                    <option value="cantik itu luka|cantik.jpg">cantik itu luka</option>
                </select>

                <label style="font-size:12px; font-weight:600;">Catatan / Alasan Favorit (Opsional):</label>
                <input type="text" id="favCatatan" placeholder="Contoh: Mau dibaca pas liburan">

                <button type="submit" class="btn-navy">Simpan ke Favorit</button>
            </form>
        </div>
    </div>

    <script>
        const defaultFavUser = [
            { id: 1, title: '', img: '', catatan: ''}
        ];
        let daftarFav = JSON.parse(localStorage.getItem('user_favorite')) || defaultFavUser;

        function renderFavorite() {
            const grid = document.getElementById('gridFavorite');
            grid.innerHTML = '';

            if (daftarFav.length === 0) {
                grid.innerHTML = '<p>Belum ada buku favorit. Klik "+ Tambahkan ke Favorite" untuk menambahkan</p>';
                return;
            }

            daftarFav.forEach(item => {
                const fallback = 'https://via.placeholder.com/150x215/1589ff/ffffff?text=${encoreURIComponent(item.title)}';
                grid.innerHTML +=
                    <div class="book-card">
                        <button class="fav-bagde" title="Hapus dari Favorite" onclick="hapusFavorite(${item.id})">♡</button>
                        <img src="${item.img}" alt="${item.title}" onerror="this.src='${fallback}'" />
                        <p class="book-title">${item.title}</p>
                        ${item.catatan ? `<small style="color:#555; margin-bottom:10px;">"${item.catatan}"</small>` : ''}
                        <div class="card-crud-actions">
                        <button class="btn-edit"  onclick="editFavorite(${item.id})">Edit Catatan</button>
                        <button class="btn-delete" onclick="hapusFavorite(${item.id})">Hapus</button>
                        </div>
                    </div>
                ;
            });
        }

        function bukaModalTambahFav(){
            document.getElementById('favModalHeading').innerText = 'Tambah Buku ke Favorite';
            document.getElementById('favId').value = '';
            document.getElementById('pilihBukuPerpus').disabled = false;
            document.getElementById('favCatatan').value = '';
            document.getElementById('modalFav').classList.add('active');
        }

        function editFavorite(id) {
            const item = daftarFav.find(f => f.id === id);
            document.getElemenById('favoriteModalHeading').innerText = 'Edit Catatan Favorite: ' + item.title;
            document.getElementById('favId').value = item.id;
            document.getElementById('pilihBukuPerpus').disabled = true;
            document.getElementById('favCatatan').value = item.catatan || '';
            document.getElementById('modalFav').classList.add('active');
        }

        function simpanFavorite(e) {
            e.preventDefault();
            const id = document.getElementById('favId').value;
            const catatan = document.getElementById('favCatatan').value;

            if (id) {
                const idx = daftarFav.findIndex(f => f.id === Number(id));
                daftarFav[idx].catatan = catatan;
            } else {
                const pilihan = document.getElementById('pilihBukuPerpus').value.split('|');
                daftarFav.push({
                    id: Date.now(),
                    title: pilihan,
                    img: pilihan,
                    catatan: catatan
                });
            }

            localStorage.setItem('user_favorite', JSON.stringify(daftarFav));
            renderFavorite();
            tutupModalFav();
        }

        function hapusFavorite(id) {
            if (confirm('Hapus buku ini dari daftar favoritmu?')) {
                daftarFav = daftarFav.filter(f => f.id !== id);
                localStorage.setItem('user_favorite', JSON.stringify(daftarFav));
                renderFavorite();
            }
        }

        function tutupModalFav() {
            document.getElementById('modalFav').classList.remove('active');
        }
        renderFavorite();
    </script>
</body>
</html>