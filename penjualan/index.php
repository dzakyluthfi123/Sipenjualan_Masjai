<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Sidebar styles */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #007BFF;
            padding-top: 20px;
            position: fixed;
            left: 0;
            top: 0;
        }

        .sidebar a {
            display: block;
            margin: 20px 0;
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            padding: 10px 20px;
            background-color: #0056b3;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #003f7f;
        }

        .sidebar a.active {
            background-color: #003f7f;
        }

        /* Main content area */
        .main-content {
            margin-left: 250px;
            /* Add space for the sidebar */
            padding: 20px;
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="tampil_brg.php" class="active">Kelola Barang</a>
        <a href="tampil_trs.php">Kelola Transaksi</a>
    </div>

    <!-- Main content area -->
    <!-- <div class="main-content">
        <h1>Welcome to the Dashboard</h1>
        <p>Content goes here...</p>
    </div> -->
    <!-- <h1>Selamat Datang Di Kasir Kami</h1> -->
</body>

</html>