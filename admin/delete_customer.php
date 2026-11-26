<?php
include 'koneksi.php';

$customer_id = $_GET['id'];
mysqli_query($koneksi, "delete from customer where customer_id='$customer_id'");

header("location:customer.php");
exit;

?>