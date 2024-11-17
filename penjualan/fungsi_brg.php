<?php
include "koneksi.php";
if (isset($_POST['simpan'])) {
    $kode = $_POST['kode_barang'];
    $nama = $_POST['nama_barang'];
    $merk = $_POST['merk'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    $simpan = mysqli_query($conn, "INSERT INTO barang VALUES ('$kode','$nama','$merk','$harga','$jumlah')");

    if ($simpan) {
        echo "Berhasil Disimpan";
    } else {
        echo "Gagal Disimpan";
    }
}

header('Location: tampil_brg.php');
exit();
