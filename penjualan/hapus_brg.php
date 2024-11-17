<?php
include 'koneksi.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM barang WHERE kode_brg='$id'");
header("location:tampil_brg.php");
?>