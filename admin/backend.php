<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location:index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Admin</title>
</head>
<body>

<h1>TANTICA KASIR</h1>
<h2>SELAMAT DATANG DI HALAMAN ADMIN</h2>

<p>Halo, <?php echo $_SESSION['username']; ?></p>

<h3>MENU UTAMA</h3>

<ul>
    <li><a href="barang.php">Data Barang</a></li>
    <li><a href="customer.php">Data Customer</a></li>
    <li><a href="stok.php">Stok Barang</a></li>
    <li><a href="transaksi.php">Transaksi</a></li>
    <li><a href="laporan.php">Laporan</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

</body>
</html>