<?php
include 'koneksi.php';

$query = mysqli_query($koneksi, "select * from admin");
?>

<h2>LAPORAN TRANSAKSI</h2>

<a href="backend.php">Kembali</a>

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>ID Transaksi</th>
        <th>Tanggal</th>
        <th>Customer ID</th>
        <th>Total</th>
    </tr>

    <?php
    $no = 1;
    while ($data = mysqli_fetch_array($query)) {
    ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $data['admin_id']; ?></td>
        <td><?= $data['tanggal']; ?></td>
        <td><?= $data['customer_id']; ?></td>
        <td><?= $data['total']; ?></td>
    </tr>
    <?php } ?>
</table>
