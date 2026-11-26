<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    mysqli_query($koneksi, "insert into barang VALUES ('', '$nama', '$stok', '$harga')");

    header("location:data_buku.php");
}

$data = mysqli_query($koneksi, "select * from barang");
?>

<h2>DATA BUKU</h2>

<form method="post">
    Nama Barang <input type="text" name="nama" required><br><br>
    Harga <input type="number" name="harga" required><br><br>
    Stok <input type="number" name="stok" required><br><br>
    <button name="simpan">Simpan</button>
</form>

<h3>DAFTAR BUKU</h3>

<table border="1" cellpadding="8">
<tr>
    <th>No</th>
    <th>Nama Buku</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Ubah</th>
</tr>

<?php
$no = 1;
while ($d = mysqli_fetch_array($data)) {
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $d['nama_buku']; ?></td>
    <td><?= $d['harga']; ?></td>
    <td><?= $d['stok']; ?></td>
    <td>
        <a href="update.php?id=<?= $d['barang_id']; ?>">Update</a> |
        <a href="delete.php?id=<?= $d['barang_id']; ?>">Delete</a>
    </td>
</tr>
<?php } ?>
</table>