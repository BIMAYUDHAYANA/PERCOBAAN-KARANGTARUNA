-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jul 2026 pada 10.06
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `karangtaruna`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman_barang`
--

CREATE TABLE `pengiriman_barang` (
  `id` int(11) NOT NULL,
  `resi` varchar(30) DEFAULT NULL,
  `pengirim` varchar(100) DEFAULT NULL,
  `hppengirim` varchar(20) DEFAULT NULL,
  `alamat_pengirim` text DEFAULT NULL,
  `penerima` varchar(100) DEFAULT NULL,
  `hppenerima` varchar(20) DEFAULT NULL,
  `alamat_penerima` text DEFAULT NULL,
  `barang` varchar(100) DEFAULT NULL,
  `berat` decimal(5,2) DEFAULT NULL,
  `kurir` varchar(50) DEFAULT NULL,
  `layanan` varchar(50) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `biaya` int(11) NOT NULL DEFAULT 0,
  `bukti_bayar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengiriman_barang`
--

INSERT INTO `pengiriman_barang` (`id`, `resi`, `pengirim`, `hppengirim`, `alamat_pengirim`, `penerima`, `hppenerima`, `alamat_penerima`, `barang`, `berat`, `kurir`, `layanan`, `catatan`, `status`, `tanggal`, `biaya`, `bukti_bayar`) VALUES
(1, 'RESI20260630093712661', 'bima', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'AHMAD BIMA YUDHAYANA', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'kardus', 1.00, 'mobil pickup', 'Express', 'hbubug', 'Barang Sampai Tujuan', '2026-06-30 07:37:12', 0, NULL),
(2, 'RESI20260630095925993', 'bima', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'AHMAD BIMA YUDHAYANA', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'kardus', 2.00, 'motor', 'Express', '', 'Barang Sampai Tujuan', '2026-06-30 07:59:25', 0, NULL),
(3, 'RESI20260630100912999', 'wowo', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'AHMAD BIMA YUDHAYANA', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'kardus', 1.00, 'mobil pickup', 'Reguler', '', 'Ambil Barang', '2026-06-30 08:09:12', 0, NULL),
(4, 'RESI20260706112339552', 'wowo', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'AHMAD BIMA YUDHAYANA', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'botol', 55.00, 'mobil pickup', 'Reguler', '', 'Menunggu Pengiriman', '2026-07-06 09:23:39', 0, NULL),
(5, 'RESI20260706150525139', 'wowo', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'AHMAD BIMA YUDHAYANA', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'botol', 4.00, 'mobil pickup', '', '', 'Menunggu Pengiriman', '2026-07-06 13:05:25', 60000, NULL),
(6, 'RESI20260706150722308', 'wowo', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'AHMAD BIMA YUDHAYANA', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'kardus', 2.00, 'mobil pickup', 'Express', '', 'Menunggu Pengiriman', '2026-07-06 13:07:22', 30000, NULL),
(7, 'RESI20260706151441399', 'wowo', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'AHMAD BIMA YUDHAYANA', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'kardus', 5.00, 'mobil pickup', 'Express', '', 'Menunggu Pengiriman', '2026-07-06 13:14:41', 75000, NULL),
(8, 'RESI20260706152045608', 'wowo', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'AHMAD BIMA YUDHAYANA', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'kardus', 5.00, 'mobil pickup', 'Reguler', '', 'Menunggu Pengiriman', '2026-07-06 13:20:45', 75000, NULL),
(9, 'RESI20260706152522641', 'wowo', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'AHMAD BIMA YUDHAYANA', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'kardus', 5.00, 'mobil pickup', 'Reguler', '', 'Menunggu Pengiriman', '2026-07-06 13:25:22', 75000, NULL),
(10, 'RESI20260706153651508', 'wowo', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'AHMAD BIMA YUDHAYANA', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'kardus', 6.00, 'mobil pickup', 'Reguler', '', 'Menunggu Pengiriman', '2026-07-06 13:36:51', 90000, 'Screenshot (6).png'),
(11, 'RESI20260706154100810', 'wowo', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'AHMAD BIMA YUDHAYANA', '083148583173', 'Jl Raya Lohbener Kabupaten Indramayu RT/RW:27/006', 'botol', 88.00, 'mobil pickup', 'Express', '', 'Menunggu Pengiriman', '2026-07-06 13:41:00', 1320000, 'Screenshot (6).png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `nama_menu` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `wa` varchar(20) DEFAULT NULL,
  `metode_pembayaran` varchar(20) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Sedang Dimasak',
  `jumlah` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `username`, `nama_menu`, `harga`, `nama_pelanggan`, `alamat`, `wa`, `metode_pembayaran`, `tanggal`, `bukti_bayar`, `status`, `jumlah`) VALUES
(6, 'wowo', 'Nasi Goreng', 20000, 'ewo', 'lohbener', '083148583173', 'QRIS', '2026-06-10 08:37:38', NULL, 'Sedang Dimasak', 1),
(7, 'wowo', 'Mie Ayam', 15000, 'ewo', 'lohbener', '083148583173', 'QRIS', '2026-06-10 08:41:22', '1781080882_Screenshot (3).png', 'Sedang Dimasak', 1),
(8, 'wowo', NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-09 09:03:26', NULL, 'Menunggu', 1),
(9, 'wowo', NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-09 09:03:35', NULL, 'Menunggu', 1),
(10, 'wowo', NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-09 09:04:24', NULL, 'Menunggu', 1),
(11, 'wowo', NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-09 09:11:10', NULL, 'Menunggu', 1),
(12, 'wowo', 'Nasi Goreng', 20000, 'wowo', 'celeng', '083148583173', 'QRIS', '2026-07-09 09:17:44', NULL, 'Menunggu', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan_pariwisata`
--

CREATE TABLE `pesanan_pariwisata` (
  `id` int(11) NOT NULL,
  `nama_pemesan` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kendaraan` varchar(50) DEFAULT NULL,
  `jumlah_tiket` int(11) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL,
  `total_biaya` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan_pariwisata`
--

INSERT INTO `pesanan_pariwisata` (`id`, `nama_pemesan`, `tanggal`, `kendaraan`, `jumlah_tiket`, `hp`, `catatan`, `durasi`, `total_biaya`) VALUES
(1, 'wowo', '2026-07-09', 'pickup', 6, '083148583173', '', NULL, NULL),
(2, 'wowo', '2026-07-07', 'pickup', 7, '083148583173', '', 2, 200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','admin') DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'bima', '$2y$10$OzIICZM1i.KNA/Oubh2ktOirlZ/5vIhmWAcWOwHFQJrXwRjrCbiOW', 'admin'),
(2, 'bima', '$2y$10$Th433pgh/X/drNziEXptleCM.WpwkIdGjppBigExVAnCbIDAZNWOO', 'admin'),
(3, 'wowo', '$2y$10$YKNqauIsAXdq7hhkIqqgb.79TnLIeEKi/NY46QxDC0EoUrx4EjtCq', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pengiriman_barang`
--
ALTER TABLE `pengiriman_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan_pariwisata`
--
ALTER TABLE `pesanan_pariwisata`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengiriman_barang`
--
ALTER TABLE `pengiriman_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pesanan_pariwisata`
--
ALTER TABLE `pesanan_pariwisata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
