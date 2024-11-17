<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            margin: 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        a {
            text-decoration: none;
        }

        /* Style for "Tambah barang" link */
        .btn-add {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
            margin-left: 2%;
        }

        .btn-add:hover {
            background-color: #218838;
        }

        /* Table Styling */
        table {
            width: 70%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: white;
            margin-left: 25%;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Button styling */
        .btn {
            display: inline-block;
            padding: 8px 16px;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-align: center;
            cursor: pointer;
        }

        .btn-edit {
            background-color: #007bff;
        }

        .btn-edit:hover {
            background-color: #0056b3;
        }

        .btn-delete {
            background-color: #dc3545;
            margin-left: 10px;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        /* Icon styles */
        .btn i {
            margin-right: 5px;
        }

        /* Search input and button styling */
        .search-box {
            display: inline-block;
            margin-left: 9px;
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
    <?php include 'index.php'; ?>
    <br>

    <h1>Data Barang</h1>
    <br>

    <!-- Add Search Box and Search Button -->
    <div style="text-align: center;">
        <a href="tambah_brg.php" class="btn-add">Tambah barang</a>
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Cari barang...">
            <button class="btn-search" onclick="searchTable()">
                <i class="fas fa-search"></i> <!-- Icon search -->
            </button>
        </div>
    </div>

    <table id="dataTable">
        <tr>
            <th>Kode barang</th>
            <th>Nama barang</th>
            <th>Merk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
        <?php
        include 'koneksi.php';
        $data = mysqli_query($conn, "SELECT * FROM barang");
        while ($d = mysqli_fetch_array($data)) {
        ?>
            <tr>
                <td><?= $d['kode_brg']; ?></td>
                <td><?= $d['nama_brg']; ?></td>
                <td><?= $d['merk']; ?></td>
                <td><?= $d['harga']; ?></td>
                <td><?= $d['jumlah']; ?></td>
                <td>
                    <a href="edit_brg.php?id=<?= $d['kode_brg']; ?>" class="btn btn-edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="hapus_brg.php?id=<?= $d['kode_brg']; ?>" class="btn btn-delete" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
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