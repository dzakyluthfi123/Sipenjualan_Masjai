-- Login ke MySQL
-- mysql -u root -p

-- Buat database baru
CREATE DATABASE sipenjualan_zakii;

-- Gunakan database yang telah dibuat
USE sipenjualan_zakii;

-- Buat tabel `barang`
CREATE TABLE `barang` (
  `kode_brg` varchar(6) NOT NULL,
  `nama_brg` varchar(100) NOT NULL,
  `merk` varchar(30) NOT NULL,
  `harga` bigint NOT NULL,
  `jumlah` int NOT NULL,
  PRIMARY KEY (`kode_brg`)
);

-- Masukkan data ke dalam tabel `barang`
INSERT INTO `barang` (`kode_brg`, `nama_brg`, `merk`, `harga`, `jumlah`) VALUES
('BR001', 'CHITATO', 'GARUDA', 12000, 399),
('BR002', 'RINSO', 'GARUDA', 15000, 200);

-- Buat tabel `transaksi`
CREATE TABLE `transaksi` (
  `kode_transaksi` varchar(10) NOT NULL,
  `kode_brg` varchar(6) NOT NULL,
  `jumlah` int NOT NULL,
  `total_bayar` bigint NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`kode_transaksi`)
);

-- Masukkan data ke dalam tabel `transaksi`
INSERT INTO `transaksi` (`kode_transaksi`, `kode_brg`, `jumlah`, `total_bayar`, `tanggal`) VALUES
('1', 'BR0022', 1, 12000, '2024-11-13'),
('BR001', 'BR001', 2, 24000, '2024-11-14'),
('TRS002', 'BR0002', 1, 10000000, '2024-11-12'),
('TRS003', 'BR0001', 4, 2000, '2024-11-12');

-- Selesai, tabel dan data telah dibuat
