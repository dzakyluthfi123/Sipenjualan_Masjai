-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 14, 2024 at 01:08 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipenjualan_zakii`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_brg` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_brg` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `merk` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `harga` bigint NOT NULL,
  `jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_brg`, `nama_brg`, `merk`, `harga`, `jumlah`) VALUES
('BR001', 'CHITATO', 'GARUDA', 12000, 399),
('BR002', 'RINSO', 'GARUDA', 15000, 200);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `kode_transaksi` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_brg` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah` int NOT NULL,
  `total_bayar` bigint NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`kode_transaksi`, `kode_brg`, `jumlah`, `total_bayar`, `tanggal`) VALUES
('1', 'BR0022', 1, 12000, '2024-11-13'),
('BR001', 'BR001', 2, 24000, '2024-11-14'),
('TRS002', 'BR0002', 1, 10000000, '2024-11-12'),
('TRS003', 'BR0001', 4, 2000, '2024-11-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_brg`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kode_transaksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
