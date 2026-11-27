<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <header class="top-header">
        <h2>Digital school library</h2>
    </header>
    <nav class="sub-header">
        <a href="fitur2-detail.html">Fitur 2: Detail & Ulasan Buku</a>
        <a href="fitur3-favorit.html">Fitur 3: Buku Favorit Saya</a>
        <a href="fitur4-pinjam.html" class="active-nav">Fitur 4: Peminjaman Saya</a>
    </nav>

        <main class="main-content">
        <div class="toolbar-top">
            <div class="section-header">
                <h3>RIWAYAT & PENGAJUAN PEMINJAMAN SAYA</h3>
            </div>
            <button class="btn-navy" onclick="bukaModalPinjam()">Lihat Form Ajukan Peminjaman</button>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Tanggal Pinjam</th>
                        <th>Durasi Pinjam</th>
                        <th>Status</th>
                        <th>Aksi User</th>
                    </tr>
                </thead>
                <tbody id="tabelPinjamUser"></tbody>
            </table>
        </div>
    </main>

    <div id="modalPinjam" class="modal-overlay active">
        <div class="modal-box">
            <button class="close-btn" onclick="tutupModalPinjam()">✕</button>
            
            <div class="modal-cover">
                <img id="pinjamImg" src="nightbooks.jpg" alt="Cover Buku" onerror="this.src='https://placeholder.com'">
            </div>

            <div class="modal-info">
                <h4 id="pinjamTitle">Nightbooks</h4>
                <p>Buku karya <span id="pinjamAuthor">J. A. White</span></p>
                <p>Genre: <span id="pinjamGenre">Fantasy, horror, mystery</span></p>
                <p>Penerbit: <span id="pinjamPublisher">Katherine Tegen Books / HarperCollins</span></p>
                <p>Tahun terbit: <span id="pinjamYear">2018</span></p>
                <p>Jumlah halaman: <span id="pinjamPages">304 halaman (edisi tertentu)</span></p>
                <p>Bahasa: <span id="pinjamLang">Inggris</span></p>
                <p>ISBN: <span id="pinjamIsbn">978-0-06-256008-7</span></p>

                <button class="btn-navy btn-full" onclick="ajukanPinjamBaru()">AJUKAN PEMINJAMAN</button>
            </div>
        </div>
    </div>

    <div id="modalEditDurasi" class="modal-overlay">
        <div class="modal-box">
            <button class="close-btn" onclick="document.getElementById('modalEditDurasi').classList.remove('active')">✕</button>
            <form class="crud-form" onsubmit="simpanPerubahanDurasi(event)">
                <h4>Ubah Durasi Peminjaman</h4>
                <input type="hidden" id="editIdPinjam">
                <p id="editNamaBuku" style="font-weight:700;"></p>
                <label style="font-size:12px;">Pilih Lama Peminjaman:</label>
                <select id="editDurasiHari">
                    <option value="3 Hari">3 Hari</option>
                    <option value="7 Hari">7 Hari (1 Minggu)</option>
                    <option value="14 Hari">14 Hari (2 Minggu)</option>
                </select>
                <button type="submit" class="btn-navy">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <script>
        const bukuDefault = {
            title: '',
            author: '',
            genre: '',
            publisher: '',
            year: '',
            pages: '',
            lang: '',
            isbn: '',
            img: ''
        };

        let bukuDipinjam = JSON.parse(localStorage.getItem('buku_akan_dipinjam')) || bukuDefault;
        let riwayatUser = JSON.parse(localStorage.getItem('user_peminjaman')) || [
            {
                id: 1,
                title: '',
                author: '',
                tanggal: '',
                durasi: '',
                status: 'Menunggu persetujuan'
            }
        ];

        function muatInfoBuku() {
            document.getElementById('pinjamTitle').innerText = bukuDipinjam.title;
            document.getElementById('pinjamAuthor').innerText = bukuDipinjam.author;
            document.getElementById('pinjamGenre').innerText = bukuDipinjam.genre;
            document.getElementById('pinjamPublisher').innerText = bukuDipinjam.publisher;
            document.getElementById('pinjamYear').innerText = bukuDipinjam.year;
            document.getElementById('pinjamPages').innerText = bukuDipinjam.pages;
            document.getElementById('pinjamLang').innerText = bukuDipinjam.lang;
            document.getElementById('pinjamIsbn').innerText = bukuDipinjam.isbn;
            document.getElementById('pinjamImg').src = bukuDipinjam.img;
        }

        function renderRiwayat() {
            const tbody = document.getElementById('tablePinjamUser');
            tbody.innerHTML = '';

            if (riwayatUser.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;">Belum ada pengajuan peminjaman</td></tr>';
                return;
            }

            riwayatUser.forEach(item => {
                tbody.innerHTML += `
                    <tr>
                        <td><strong>${item.title}</strong></td>
                        <td>${item.author}</td>
                        <td>${item.tanggal}</td>
                        <td>${item.durasi}</td>
                        <td><span style="background:#e0f2fe; color:#0369a1; padding:3px 8px; border-radius:10px; font-size:11px; font-weight:600;">${item.status}</span></td>
                        <td>
                            <button class="btn-edit" onclick="bukaEditDurasi(${item.id})">Ubah durasi</button>
                            <button class="btn-delete" onclick="batalkanPinjam(${item.id})">Batalkan</button>
                        </td>   
                    </tr>
                `;
            });
        } 

        function ajukanPinjamBaru() {
            const hariIni = new Date().toISOString.split('T');
            riwayatUser.push({
                id: Date.now(),
                title: bukuDipinjam.title,
                author: bukuDipinjam.author,
                tanggal: hariIni,
                durasi: '7 Hari',
                status: 'Menunggu Persetujuan'
            });
            localStorage.setItem('user_peminjaman', JSON.stringify(riwayatUser));
            renderRiwayat();
            tutupModalPinjam();
            alert('Peminjaman buku "' + bukuDipinjam.title + '"Berhasil diajukan!');
        } 

        function bukaEditDurasi(id) {
            const item = riwayatUser.find(r => r.id === id);
            document.getElementById('editIdPinjam').value = item.id;
            document.getElementById('editNamaBuku').innerText = 'Buku: ' + item.title;
            document.getElementById('editDurasiHari').value = item.durasi;
            document.getElementById('modalEditDurasi').classList.add('active');
        }

        function simpanPerubahanDurasi(e) {
            e.preventDefault();
            const id = Number(document.getElementById('editIdPinjam').value);
            const idx = riwayatUser.findIndex(r => r.id === id);
            riwayatUser[idx].durasi = document.getElementById('editdurasiHari');

            localStorage.setItem('user_peminjaman', JSON.stringify(riwayatUser));
            renderRiwayat();
            document.getElementById('modalEditDurasi').classList.remove('active');
        }

        function batalkanPinjam(id) {
            if (confirm('Apakah kamu yakin ingin membatalkan pengajuan peminjaman ini?')) {
                riwayatUser = riwayatUser.filter(r => r.id !== id);
                localStorage.setItem('user_peminjaman', JSON.stringify(riwayatUser));
                renderRiwayat();
            }
        }

        function bukaModalPinjam() {
            muatInfoBuku();
            document.getElementById('modalPinjam').classList.add('active');
        }

        function tutupModalPinjam() {
            document.getElementById('modalPinjam').classList.remove('active');
        }

        muatInfoBuku();
        renderRiwayat();
    </script>
</body>
</html>