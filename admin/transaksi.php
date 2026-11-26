<?php
include 'koneksi.php';
?>

<h2>TRANSAKSI</h2>

<form action="proses_transaksi.php" method="post">

    Customer:
    <select name="customer_id">
        <?php
        $c = mysqli_query($koneksi, "select * from customer");
        while ($data = mysqli_fetch_array($c)) {
        ?>
            <option value="<?= $data['customer_id']; ?>">
                <?= $data['nama']; ?>
            </option>
        <?php } ?>
    </select>

    <br><br>

    Barang:
    <select name="barang_id">
        <?php
        $b = mysqli_query($koneksi, "select * from barang");
        while ($data = mysqli_fetch_array($b)) {
        ?>
            <option value="<?= $data['barang_id']; ?>">
                <?= $data['nama_barang']; ?>
            </option>
        <?php } ?>
    </select>

    <br><br>
    Jumlah:
    <input type="number" name="jumlah">

    <br><br>

    <button type="submit">Simpan</button>

</form>
