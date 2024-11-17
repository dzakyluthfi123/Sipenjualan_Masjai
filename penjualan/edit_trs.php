<?php
include "koneksi.php";

// Ambil kode transaksi dari URL
if (isset($_GET['id'])) {
    $kode_transaksi = $_GET['id'];
    $query_transaksi = "SELECT * FROM transaksi WHERE kode_transaksi='$kode_transaksi'";
    $result_transaksi = mysqli_query($conn, $query_transaksi);

    if (mysqli_num_rows($result_transaksi) == 1) {
        $data_transaksi = mysqli_fetch_assoc($result_transaksi);
    } else {
        echo "Transaksi tidak ditemukan.";
        exit; // Keluar jika transaksi tidak ditemukan
    }
}

// Proses form update
if (isset($_POST['update_transaksi'])) {
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];
    $kode_brg = $data_transaksi['kode_brg'];

    // Ambil harga barang dari database
    $query_harga = "SELECT harga FROM barang WHERE kode_brg='$kode_brg'";
    $result_harga = mysqli_query($conn, $query_harga);
    $row_harga = mysqli_fetch_assoc($result_harga);
    $harga = $row_harga['harga'];

    // Hitung total bayar
    $total_bayar = $harga * $jumlah;
    $perbedaan_jumlah_beli = $jumlah - $data_transaksi['jumlah'];

    // Update transaksi
    $query_update_transaksi = "UPDATE transaksi SET jumlah='$jumlah', total_bayar='$total_bayar', tanggal='$tanggal' WHERE kode_transaksi='$kode_transaksi'";
    $result_update_transaksi = mysqli_query($conn, $query_update_transaksi);

    if ($result_update_transaksi) {
        // Update stok barang
        $query_update_stok = "UPDATE barang SET jumlah= jumlah - $perbedaan_jumlah_beli WHERE kode_brg='$kode_brg'";
        $result_update_stok = mysqli_query($conn, $query_update_stok);

        if ($result_update_stok) {
            header("Location: tampil_trs.php");
            exit;
        } else {
            echo "Gagal update stok.";
        }
    } else {
        echo "Gagal update transaksi.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Form styling */
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Adjusted shadow for consistency */
            width: 100%;
            max-width: 600px;
            margin-left: 10%;
            margin-bottom: 30%;
            /* Centered the form with consistent width */
        }

        form h2 {
            margin-bottom: 15px;
            font-size: 1.8rem;
            /* Consistent font size */
            color: #333;
            text-align: center;
        }

        /* Label styling */
        label {
            display: block;
            font-size: 1rem;
            /* Slightly larger font size for readability */
            color: #495057;
            /* Matching color for consistency */
            margin-bottom: 6px;
            font-weight: bold;
            /* Bold text for labels */
        }

        /* Input field styling */
        input[type="text"] {
            width: 95%;
            /* Adjusted width */
            padding: 10px;
            /* Increased padding for consistent look */
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            /* Matching border */
            border-radius: 4px;
            font-size: 14px;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
        }

        /* Input focus state */
        input[type="text"]:focus {
            border-color: #80bdff;
            /* Consistent focus border color */
            background-color: white;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
            /* Blue glow on focus */
        }

        /* Button styling */
        button {
            width: 95%;
            padding: 10px;
            background-color: #007bff;
            /* Consistent primary color */
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            /* Adjusted font size */
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
            /* Darker shade on hover for consistency */
        }
    </style>
    <?php include 'index.php'; ?>

    <div class="container mt-5" style="margin-left: 30%; width: 50%;">

        <form action="" method="post">
            <h2>Edit Transaksi</h2>
            <!-- Input Jumlah -->
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" name="jumlah" style="border: 1px solid black;" class="form-control" value="<?php echo isset($data_transaksi['jumlah']) ? $data_transaksi['jumlah'] : ''; ?>" required>
            </div>
            <!-- Input Tanggal -->
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" style="border: 1px solid black;" class="form-control" value="<?php echo isset($data_transaksi['tanggal']) ? $data_transaksi['tanggal'] : ''; ?>" required>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" name="update_transaksi" class="btn btn-primary" style="width: 100%;">Update</button>
            <!-- <a href="tampil_trs.php" class="btn btn-secondary">Kembali</a> -->
        </form>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>