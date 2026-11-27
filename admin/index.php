
<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">
    Digital School Library
</div>

<div class="sidebar">
    <h3>ADMIN</h3>
    <a href="index.php">Dashboard</a>
    <a href="pengajuan.php">Pengajuan Peminjaman</a>
    <a href="buku.php">Kelola Data Buku</a>
    <a href="pengembalian.php">Pengembalian</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h2>SELAMAT DATANG ADMIN</h2>

    <div class="dashboard">
        <div class="card">Jumlah Buku</div>
        <div class="card">Jumlah Anggota</div>
        <div class="card">Menunggu Persetujuan</div>
        <div class="card">Buku Dipinjam</div>
    </div>
</div>

</body>
</html>
