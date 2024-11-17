<?php
include "koneksi.php"; // Memasukkan file koneksi database

// Mendapatkan ID transaksi dari URL
$kode_transaksi = $_GET['id'];

// Pertama, ambil detail transaksi (terutama kode_brg dan jumlah) sebelum dihapus
$query = "SELECT kode_brg, jumlah FROM transaksi WHERE kode_transaksi = '$kode_transaksi'";
$result = mysqli_query($conn, $query);
$transaction = mysqli_fetch_assoc($result);

if ($transaction) {
    $kode_brg = $transaction['kode_brg'];
    $jumlah_beli = $transaction['jumlah'];

    // Mulai transaksi database untuk memastikan atomicity
    mysqli_begin_transaction($conn);

    try {
        // Menghapus data transaksi dari tabel transaksi
        $delete_query = "DELETE FROM transaksi WHERE kode_transaksi = '$kode_transaksi'";
        mysqli_query($conn, $delete_query);

        // Menambah jumlah stok barang di tabel barang sesuai dengan jumlah yang dihapus
        $update_query = "UPDATE barang SET jumlah = jumlah + $jumlah_beli WHERE kode_brg = '$kode_brg'";
        mysqli_query($conn, $update_query);

        // Commit transaksi
        mysqli_commit($conn);

        // Redirect ke halaman kelola transaksi dengan pesan sukses
        header("Location: tampil_trs.php?message=success");
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        mysqli_rollback($conn);
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Transaksi tidak ditemukan!";
}
