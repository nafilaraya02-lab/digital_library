<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header class ="top-header">Digital School Library</header>

    <div class = "container">
        <div class="search-box">
            <input type="text" placeholder="Cari judul, penulis atau kode buku...">
        </div>
        <div class="books-grid">
            <div class="book-card">
                <img src="" alt="book cover">
                <h3>Bandung After Rain</h3>
                <span class="badge-status">Tersedia</span>
            </div>
            <div class="book-card">
                <img src="" alt="book cover">
                <h3>Bandung After Rain</h3>
                <span class="badge-status">Tersedia</span>
            </div>
            <div class="book-card">
                <img src="" alt="book cover">
                <h3>Bandung After Rain</h3>
                <span class="badge-status">Tersedia</span>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="modalBuku">
        <div class="modal-box">
            <span class="close-btn" onclick="tutupDetail"></span>
            
        </div>
    </div>
</body>
</html>