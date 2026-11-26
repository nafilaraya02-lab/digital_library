<?php
include "koneksi.php";

$data = mysqli_query($koneksi, "select * from barang");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Stok Barang</title>
</head>
<body>

<h1>DIGITAL LIBRARY</h1>
<h2>DATA STOK BUKU</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Nama Buku</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Keterangan</th>
    </tr>

    <?php
    $no = 1;
    while ($d = mysqli_fetch_array($data)) {
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $d['nama_buku']; ?></td>
        <td><?php echo $d['harga']; ?></td>
        <td><?php echo $d['stok']; ?></td>
        <td>
            <?php
            if ($d['stok'] > 0) {
                echo "Tersedia";
            } else {
                echo "Habis";
            }
            ?>
        </td>
    </tr>
    <?php } ?>
</table>

<br>
<a href="backend.php">KEMBALI</a>

</body>
</html>
