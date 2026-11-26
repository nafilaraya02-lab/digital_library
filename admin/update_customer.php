<?php
include "koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($koneksi, "select * from customer where customer_id='$id'");
$d = mysqli_fetch_array($data);

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];

    mysqli_query($koneksi, "update customer set nama='$nama', alamat='$alamat', telp='$telp' where customer_id='$id'");

    header("location:customer.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Customer</title>
</head>
<body>

<h2>Update DATA CUSTOMER</h2>

<form method="post">
    <table>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="nama" value="<?php echo $d['nama']; ?>"></td>
        </tr>
        <tr>
            <td>Alamat</td>
          <td><input type="text" name="alamat" value="<?php echo $d['alamat']; ?>"></td>

        </tr>
        <tr>
            <td>Telp</td>
            <td><input type="text" name="telp" value="<?php echo $d['telp']; ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="simpan" value="SIMPAN"></td>
        </tr>
    </table>
</form>

<a href="customer.php">KEMBALI</a>

</body>
</html>
