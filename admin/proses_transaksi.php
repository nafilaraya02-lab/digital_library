<?php
include 'koneksi.php';

$customer = $_POST['customer_id'];
$barang = $_POST['barang_id'];
$jumlah = $_POST['jumlah'];

$data = mysqli_query($koneksi, "select * from barang WHERE barang_id='$barang'");
$b = mysqli_fetch_array($data);

$total = $b['harga'] * $jumlah;
$tanggal = date('Y-m-d');

mysqli_query($koneksi, "insert into admin (tanggal,total,customer_id)
 VALUES('$tanggal','$total','$customer')");

$id = mysqli_insert_id($koneksi);

mysqli_query($koneksi, "insert into detail (admin_id,barang_id,jumlah,total)
VALUES ('$id','$barang','$jumlah','$total')");

mysqli_query($koneksi, "update barang SET stok=stok-'$jumlah'
where barang_id='$barang'");

header("location:laporan.php");
?>
