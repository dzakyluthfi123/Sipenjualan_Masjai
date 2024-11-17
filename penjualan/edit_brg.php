<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 14px;
            color: #555;
            margin-bottom: 3px;
        }

        input[type="text"] {
            width: 90%;
            padding: 8px 12px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            font-size: 14px;
            transition: border 0.3s ease;
        }

        input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
            background-color: white;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            color: #007bff;
            display: inline-block;
            margin-bottom: 20px;
        }

        a:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
        }

        table input {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <?php include 'index.php';  ?>
    <div class="container">
        <h2>Edit Data Barang</h2>

        <?php
        include "koneksi.php";
        $id = $_GET['id'];
        $data = mysqli_query($conn, "SELECT * FROM barang WHERE kode_brg='$id'");
        while ($d = mysqli_fetch_array($data)) {
        ?>
            <form action="fungsiedit.php" method="post">
                <table>
                    <tr>
                        <td><label for="kode_brg">Kode Barang:</label></td>
                        <td><input type="text" id="kode_brg" name="kode_brg" value="<?php echo $d['kode_brg']; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td><label for="nama_brg">Nama Barang:</label></td>
                        <td><input type="text" id="nama_brg" name="nama_brg" value="<?php echo $d['nama_brg']; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="merk">Merk Barang:</label></td>
                        <td><input type="text" id="merk" name="merk" value="<?php echo $d['merk']; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="harga">Harga Barang:</label></td>
                        <td><input type="text" id="harga" name="harga" value="<?php echo $d['harga']; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="jumlah">Jumlah Barang:</label></td>
                        <td><input type="text" id="jumlah" name="jumlah" value="<?php echo $d['jumlah']; ?>"></td>
                    </tr>
                </table>
                <button type="submit" name="edit">Edit</button>
            </form>
        <?php
        }
        ?>
    </div>
</body>

</html>