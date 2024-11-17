<?php
include "koneksi.php";

$kode_brg = $_POST['kode_brg'];
$nama_brg = $_POST['nama_brg'];
$merk = $_POST['merk'];
$harga = $_POST['harga'];
$jumlah = $_POST['jumlah'];

mysqli_query($conn, "UPDATE barang SET nama_brg='$nama_brg', merk='$merk', harga='$harga', jumlah='$jumlah' WHERE kode_brg='$kode_brg'");

header("location:tampil_brg.php");
exit();
