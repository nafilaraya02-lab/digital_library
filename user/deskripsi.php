<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitur Deskripsi Buku</title>
</head>
<body>
    <header class="top-header">
        <h2>Digital School Library</h2>
    </header>
    <nav class="sub-header">
        <a href="deskripsi.php" class="active-nav">Detail dan Ulasan Buku</a>
        <a href=""></a>
        <a href=""></a>
    </nav>
    <main class="main-content">
        <div class="toolbar-top">
            <div class="section-header">
                <h3>Pilih Buku untuk Melihat Deskripsi dan Ulasan</h3>
            </div>
        </div>

        <div id="gridKatalog" class="book-grid"></div>
    </main>

    <div id="modalDetail" class="modal-overlay">
        <div class="modal-box">
            <button class="close-btn" onclick="tutupModal()">X</button>

            <div class="modal-cover">
                <img id="detImg" src="" alt="Cover Buku">
            </div>

            <div class="modal-info">
                <h4 id="detTitle"></h4>
                <p>Buku Karya <span id="detAuthor"></span></p>
                <p>Genre: <span id="detGenre"></span></p>
                <p>Penerebit: <span id="detPublisher"></span></p>
                <p>Tahun terbit: <span id="detYear"></span></p>
                <p>Jumlah halaman: <span id="detPages"></span></p>
                <p>Bahasa: <span id="detLang"></span></p>
                <p>ISBN: <span id="detIsbn"></span></p>

                <div class="rating-row">
                    <span class="star">★</span> <strong id="detRating"></strong>
                </div>

                <div class="book-description">
                    <strong>Deskripsi dan Sinopsis</strong>
                    <p id="detDesc"></p>
                </div>

                <div class="action-buttons" style="margin-top: 12px;">
                    <button class="btn-navy" onclick="pindahPinjam()">Pinjam langsung</button>
                    <button class="btn-navy" onclick="tambahKefavorit()">Favorit</button>
                </div>

                <div class="book-descriptions" style="margin-top: 12px;">
                    <strong>Tulis Ulasan Kamu:</strong>
                    <form onsubmit="simpanUlasan(event)" style="display:flex; gap:6px; margin-top:6px">
                        <input type="hidden" id="editReviesId">
                        <input type="text" id="editReviewId">
                        <button type="submit" class="btn-navy" style="padding:5px 10px;">Kirim</button>
                    </form>
                    <div id="listUlasan" style="margin-top:8px"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const katalogPerpus = [
            {
                id: 1,
                title: '',
                author: '',
                genre: '',
                publisher: '',
                year: '',
                pages: '',
                lang: '',
                isbn: '',
                rating: '',
                img: '',
                desc: '',
            }
        ];
        let bukuAktif = null;
        let dbUlasan = JSON.parse(localStorage.getItem('user_ulasan')) || [];

        function renderKatalog(){
            const grid = document.getElementById('gridKatalog');
            grid.innerHTML = '';
            katlogPerpus.forEach(buku => {
                const fallback = `https://placeholder.com{encoreURIComponent(buku.title)}`;
                grid.innerHTML += `
                    <div class="book-card" onclick="bukaDetail(${buku.id})">
                        <img src="${buku.img}" alt="${buku.title}" onerror="this.src='${fallback}'">
                        <p class="book-title">${buku.title}</p>
                        <small style="color:#1589ff; font-weight:600;">Lihat Deskripsi</small>
                    </div>
                `;
            });
        }
        function bukuDetail(id) {
            bukuAktif = katalogPerpus.find(b => b.id === id);
            document.getElementById('detTitle').innerText = bukuAktif.title;
            document.getElementById('detAuthor').innerText = bukuAktif.author;
            document.getElementById('detGenre').innerText = bukuAktif.genre;
            document.getElementById('detPublisher').innerText = bukuAktif.publisher;
            document.getElementById('detYear').innerText = bukuAktif.year;
            document.getElementById('detPages').innerText = bukuAktif.pages;
            document.getElementById('detLang').innerText = bukuAktif.lang;
            document.getElementById('detIsbn').innerText = bukuAktif.isbn;
            document.getElementById('detRating').innerText = bukuAktif.rating;
            document.getElementById('detDesc').innerText = bukuAktif.desc;

            const imgEl = document.getElementById('detImg');
            imgEl.src = bukuAktif.img;
            imgEl.onerror = function() {
                this.src = `https://place.com{encodeURIComponent(bukuAktif.title)}`;
            };
            document.getElementById('editReviewId').value= '';
            document.getElementById('inputReview').value = '';
            renderUlasan();
            document.getElementById('modalDetail').classList.add('active');
        }

        function renderUlasan() {
            const list = document.getElementById('listUlasan');
            const ulasanBukuIni = dbUlasan.filter(u => u.bookid === bukuAktif.id);
            list.innerHTML = '';

            if (ulasanBukuIni.length === 0) {
                list.innerHTML = '<small style="color:#666;">Belum ada ulasanmu</small>';
                return;
            }

            ulasanBukuIni.forEach(u => {
                list.innerHTML += `
                    <div style="display:flex; justify-content:space-between; align-items:center; background:#fff; padding:5px 8px; border-radius:4px; margin-top:4px;">
                        <span>${u.teks}</span>
                        <div style="display:flex; gap:4px;">
                            <button type="button" class="btn-edit" onclick="editUlasan(${u.id})">Edit</button>
                            <button type="button" class="btn-delete" onclick="hapusUlasan(${u.id})">Hapus</button>
                        </div>
                    </div>
                `;
            });
        }

        function simpanUlasan(e) {
            e.preventDefault();
            const editId = document.getElementById('editReviesId').value;
            const teks = document.getElementById('inputReview').value;

            if (editId) {
                const idx = dbUlasan.findIndex(u => u.id === Number(editId));
                dbUlasan[idx].teks = teks;
            } else {
                dbUlasan.push({
                    id: Date.now(),
                    bookId: bukuAktif.id,
                    teks: teks
                });
                
                localStorage.setItem('user_ulasan', JSON.stringify(dbUlasan));
                ment.getElementById('editReviewId').value='';
                ment.getElementById('inputReview').value='';
                erUlasan();

                function editUlasan(id) {
                    const u = dbUlasan.find(item => item.id === id);
                    ment.getElementById('editReviewId').value = u.id;
                    ment.getElementById('inputReview').value = u.teks;
                }
                function hapusUlasan(id) {
                    dbUlasan = dbUlasan.filter(u => u.id !== id);
                    localStorage.setItem('user_ulasan', JSON.stringify(dbUlasan));
                    renderUlasan();
                }
                function tambahKeFavorit() {
                    let favs = JSON.parse(localStorage.getItem('user_favorit')) || [];
                    if (!favs.some(f => f.title === bukuAktif.title)) {
                        favs.push({
                            id: Date.now(),
                            title: bukuAktif.title,
                            img: bukuAktif.img,
                            catatan: 'Ditambahkan dadri detail buku'
                        });
                        localStorage.setItem('user_favorit', JSON.stringify(favs));
                        alert('Buku berhasil ditambahkan ke Favorit');
                    } else {
                        alert('Buku ini sudah ada di Favoritmu')
                    }
                }
                function pindahKePinjam(){
                    localStorage.setItem('buku_akan_dipinjam', JSON.stringify(bukuAktif));
                    window.location.href='';
                }

                function tutupModal() {
                    document.getElementById('modalDetail').classList.remove('active');
                }
                renderKatalog();
                bukuDetail(1);
            }
        }
    </script>
</body>
</html>