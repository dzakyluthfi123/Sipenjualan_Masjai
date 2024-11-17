<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-left: 30%;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Form styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 14px;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            width: 90%;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus,
        select:focus {
            border-color: #007bff;
            outline: none;
            background-color: #fff;
        }

        button[type="submit"] {
            padding: 12px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
                width: 90%;
            }

            h2 {
                font-size: 24px;
            }

            input[type="text"],
            input[type="number"],
            input[type="date"],
            select {
                font-size: 14px;
            }

            button[type="submit"] {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <?php include 'index.php'; ?>

    <div class="container">
        <h2>Tambah Transaksi</h2>
        <form action="" method="post">
            <label for="kodetrs">Kode Transaksi:</label>
            <input type="text" name="kodetrs" id="kodetrs" required style="border: 1px solid black;">

            <label for="kodebrg">Nama Barang:</label>
            <select name="kodebrg" id="kodebrg" required style="border: 1px solid black; width: 93%;">
                <option value="">--Pilih Barang--</option>
                <?php
                include "koneksi.php";
                $tampil = mysqli_query($conn, "SELECT * FROM barang");
                while ($a = mysqli_fetch_array($tampil)) {
                ?>
                    <option value="<?= $a['kode_brg'] ?>"><?= $a['nama_brg'] ?></option>
                <?php
                }
                ?>
            </select>

            <label for="jumlah">Jumlah:</label>
            <input type="number" name="jumlah" id="jumlah" required style="border: 1px solid black;">

            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal" id="tanggal" required style="border: 1px solid black;">

            <button type="submit" name="simpan" style="width: 94%;">Simpan</button>
        </form>
    </div>

    <?php
    include "koneksi.php";

    if (isset($_POST['simpan'])) {
        $kode_transaksi = $_POST['kodetrs'];
        $kode_barang = $_POST['kodebrg'];
        $jumlahbrg = $_POST['jumlah']; //jumlah dari form transaksi
        $tanggal = $_POST['tanggal'];

        // mengambil data barang berdasarkan kode_barang
        $tampil_barang = mysqli_query($conn, "SELECT * FROM barang WHERE kode_brg = '$kode_barang'");
        $data = mysqli_fetch_array($tampil_barang);
        $nama_barang = $data['nama_brg'];
        $harga = $data['harga'];
        $jumlah = $data['jumlah'];

        $total_harga = $jumlahbrg * $harga;

        if ($jumlahbrg > $jumlah) { //jika jumlah yang diinput lebih besar dari jumlah yang ada di tabel barang
            echo "<script>alert('Stok tidak cukup')</script>";
        } else {
            // Insert data ke tabel transaksi
            $simpan = mysqli_query($conn, "INSERT INTO transaksi VALUES ('$kode_transaksi','$kode_barang', '$jumlahbrg','$total_harga','$tanggal')");
            if ($simpan) {
                // jika berhasil disimpan, update tabel barang
                $update_barang = mysqli_query($conn, "UPDATE barang SET jumlah = jumlah - $jumlahbrg WHERE kode_brg = '$kode_barang'");
                echo "<script>alert('Berhasil Disimpan')</script>";
            } else {
                echo "gagal";
            }
        }
        header("Location:tampil_trs.php");
    }
    ?>
</body>

</html>