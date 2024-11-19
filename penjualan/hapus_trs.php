<?php
include "koneksi.php"; // Memasukkan file koneksi database


$kode_transaksi = $_GET['id'];


$query = "SELECT kode_brg, jumlah FROM transaksi WHERE kode_transaksi = '$kode_transaksi'";
$result = mysqli_query($conn, $query);
$transaction = mysqli_fetch_assoc($result);

if ($transaction) {
    $kode_brg = $transaction['kode_brg'];
    $jumlah_beli = $transaction['jumlah'];

    
    mysqli_begin_transaction($conn);

    try {
       
        $delete_query = "DELETE FROM transaksi WHERE kode_transaksi = '$kode_transaksi'";
        mysqli_query($conn, $delete_query);

        
        $update_query = "UPDATE barang SET jumlah = jumlah + $jumlah_beli WHERE kode_brg = '$kode_brg'";
        mysqli_query($conn, $update_query);

        
        mysqli_commit($conn);

       
        header("Location: tampil_trs.php?message=success");
    } catch (Exception $e) {
       
        mysqli_rollback($conn);
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Transaksi tidak ditemukan!";
}
