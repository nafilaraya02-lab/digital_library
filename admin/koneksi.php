<?php

$koneksi = mysqli_connect("localhost", "root", "perpus_digital");

if (!$koneksi) {
    die("koneksi database gagal: " . mysqli_connect_error());
}

?>