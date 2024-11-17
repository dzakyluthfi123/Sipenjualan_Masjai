<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General body styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fa;
            color: #333;
        }

        /* Header section */
        h1 {
            text-align: center;
            color: #333;
            margin: 40px 0;
        }

        /* Links for actions */
        a {
            text-decoration: none;
            color: #fff;
            background-color: #28a745;
            padding: 12px 18px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            display: inline-block;
        }

        a:hover {
            background-color: #218838;
        }

        /* Table styling */
        table {
            width: 70%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            /* margin-top: 2px; */
            margin-left: 25%;
        }

        th,
        td {
            padding: 15px 20px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
            font-size: 16px;
        }

        td {
            font-size: 14px;
            color: #555;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Action links in table */
        td a {
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease;
            padding: 8px 12px;
            display: inline-block;
            border-radius: 5px;
        }

        td a:hover {
            color: white;
        }

        /* Responsive table styling */
        @media (max-width: 768px) {
            table {
                width: 100%;
                font-size: 12px;
            }

            th,
            td {
                padding: 10px;
            }
        }

        /* Icon styles */
        .btn i {
            margin-right: 5px;
        }

        /* Action button styles */
        .btn-edit {
            background-color: #ffc107;
            color: #fff;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        /* Search input and button styling */
        .search-box {
            display: inline-block;
            margin-left: 20px;
        }

        .search-box input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 400px;
        }

        .btn-search {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            margin-left: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-search:hover {
            background-color: #0056b3;
        }

        /* Icon inside search button */
        .btn-search i {
            font-size: 16px;
        }
    </style>
</head>

<body>
    <?php include "index.php"; ?>
    <h1>Data Transaksi</h1>

    <div style="text-align: center;">
        <a href="tambah_trs.php" style="margin-left: 2%">Tambah Transaksi</a>

        <!-- Add Search Box and Search Button -->
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Cari transaksi...">
            <button class="btn-search" onclick="searchTable()">
                <i class="fas fa-search"></i> <!-- Icon search -->
            </button>
        </div>
    </div>
    <br>

    <table id="dataTable">
        <thead>
            <tr>
                <th>Kode Transaksi</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah Beli</th>
                <th>Total Bayar</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "koneksi.php";

            // Query untuk mengambil data dari tabel transaksi dan tabel barang
            $join = "SELECT transaksi.kode_transaksi, transaksi.kode_brg, barang.nama_brg, barang.harga, transaksi.jumlah, transaksi.total_bayar, transaksi.tanggal FROM transaksi INNER JOIN barang ON transaksi.kode_brg = barang.kode_brg";

            $data = mysqli_query($conn, $join);

            // Tampilkan data
            while ($d = mysqli_fetch_assoc($data)) {
            ?>
                <tr>
                    <td><?php echo $d['kode_transaksi']; ?></td>
                    <td><?php echo $d['kode_brg']; ?></td>
                    <td><?php echo $d['nama_brg']; ?></td>
                    <td><?php echo number_format($d['harga'], 0, ',', '.'); ?></td>
                    <td><?php echo $d['jumlah']; ?></td>
                    <td><?php echo number_format($d['total_bayar'], 0, ',', '.'); ?></td>
                    <td><?php echo $d['tanggal']; ?></td>
                    <td>
                        <a href="edit_trs.php?id=<?= $d['kode_transaksi']; ?>" class="btn-edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <br>
                        <br>
                        <a href="hapus_trs.php?id=<?= $d['kode_transaksi']; ?>" class="btn-delete" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <script>
        function searchTable() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let table = document.getElementById("dataTable");
            let tr = table.getElementsByTagName("tr");

            for (let i = 1; i < tr.length; i++) {
                let tdArray = tr[i].getElementsByTagName("td");
                let match = false;

                for (let j = 0; j < tdArray.length; j++) {
                    if (tdArray[j].innerText.toLowerCase().indexOf(input) > -1) {
                        match = true;
                        break;
                    }
                }

                if (match || input === "") {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    </script>

</body>

</html>