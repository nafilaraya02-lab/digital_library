<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];

    mysqli_query($koneksi, "insert into customer (nama, alamat, telp)
    VALUES ('$nama', '$alamat', '$telp')");

    header("location: data_customer.php");
    exit;
}

$data = mysqli_query($koneksi, "select * from customer");
?>

<h2>DATA CUSTOMER</h2>

<form method="post">
    Nama <input type="text" name="nama" required><br><br>
    Alamat <input type="text" name="alamat" required><br><br>
    Telp <input type="text" name="telp" required><br><br>
    <button name="simpan">Simpan</button>
</form>

<h3>DAFTAR CUSTOMER</h3>

<table border="1" cellpadding="8">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>Telp</th>
    <th>Ubah</th>
</tr>

<?php
$no = 1;
while ($d = mysqli_fetch_array($data)) {
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $d['nama']; ?></td>
    <td><?= $d['alamat']; ?></td>
    <td><?= $d['telp']; ?></td>
    <td>
        <a href="update_customer.php?id=<?= $d['customer_id']; ?>">Update</a> |
        <a href="delete_customer.php?id=<?= $d['customer_id']; ?>">Delete</a>
    </td>
</tr>
<?php } ?>
</table>
