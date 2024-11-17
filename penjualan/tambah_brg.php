<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
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

        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            /* max-width: 400px; */
            width: 600px;
            margin-left: 10%;
        }

        form h2 {
            margin-bottom: 15px;
            font-size: 20px;
            color: #333;
            text-align: center;
        }

        label {
            display: block;
            font-size: 13px;
            color: #555;
            margin-bottom: 6px;
        }

        input[type="text"] {
            width: 90%;
            padding: 8px 12px;
            margin-bottom: 15px;
            border: 1px solid black;
            border-radius: 4px;
            font-size: 14px;
            background-color: #f9f9f9;
            transition: border 0.3s ease;
        }

        input[type="text"]:focus {
            border-color: #007bff;
            background-color: white;
            outline: none;
        }

        button {
            width: 95%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <?php include 'index.php'; ?>
    <form action="fungsi_brg.php" method="post">
        <h2>Tambah Barang</h2>
        <label for="kode_barang">Kode Barang</label>
        <input type="text" id="kode_barang" name="kode_barang">

        <label for="nama_barang">Nama Barang</label>
        <input type="text" id="nama_barang" name="nama_barang">

        <label for="merk">Merk Barang</label>
        <input type="text" id="merk" name="merk">

        <label for="harga">Harga Barang</label>
        <input type="text" id="harga" name="harga">

        <label for="jumlah">Jumlah Barang</label>
        <input type="text" id="jumlah" name="jumlah">

        <button type="submit" name="simpan">Simpan</button>
    </form>
</body>

</html>