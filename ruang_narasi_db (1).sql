-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2026 at 07:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ruang_narasi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_book` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_penulis` int(11) DEFAULT NULL,
  `id_penerbit` int(11) DEFAULT NULL,
  `id_rak` int(11) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `sampul` varchar(255) DEFAULT 'default_cover.jpg',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_book`, `judul`, `id_kategori`, `id_penulis`, `id_penerbit`, `id_rak`, `tahun_terbit`, `stok`, `sampul`, `created_at`, `updated_at`) VALUES
(5, 'Atomic habit', 2, 1, 1, 2, '2018', 82, '1776963986_49465aa1e485a3f4bffd.jpg', '2026-04-21 07:25:52', '2026-04-23 17:21:14'),
(6, '99 Azab Kubur Indosiar', 1, 1, 1, 3, '2011', 20, '1776964061_7861226a119469d2c540.jpg', '2026-04-23 17:02:54', '2026-04-23 17:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Self Improvement.'),
(2, 'fiksi');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_book` int(11) DEFAULT NULL,
  `nama_peminjam` varchar(100) DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('diajukan','dipinjam','kembali') DEFAULT 'dipinjam',
  `id_user` int(11) DEFAULT NULL,
  `denda` int(11) DEFAULT 0,
  `metode_bayar` enum('manual','dana','qris') DEFAULT 'manual',
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `status_bayar` enum('belum','proses','lunas') DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_book`, `nama_peminjam`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `id_user`, `denda`, `metode_bayar`, `bukti_bayar`, `status_bayar`) VALUES
(58, 5, NULL, '2026-04-22', '2026-04-23', 'kembali', 21, 0, 'manual', NULL, 'belum'),
(62, 5, NULL, '2026-04-22', '2026-04-01', 'kembali', 21, 0, 'manual', NULL, 'belum'),
(63, 5, NULL, '2026-04-22', '2026-04-08', 'kembali', 21, 0, 'manual', NULL, 'belum'),
(64, 5, NULL, '2026-04-22', '2026-04-09', 'kembali', 26, 26000, 'manual', NULL, 'belum'),
(65, 5, NULL, '2026-04-23', '2026-04-25', 'kembali', 28, 0, 'manual', NULL, 'belum'),
(66, 5, NULL, '2026-04-23', '2026-04-30', 'kembali', 28, 0, 'manual', NULL, 'belum');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `nama_penerbit` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`) VALUES
(1, 'Bukutama'),
(2, 'Cipta Buku');

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `id_penulis` int(11) NOT NULL,
  `nama_penulis` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`id_penulis`, `nama_penulis`) VALUES
(1, 'James Clear.');

-- --------------------------------------------------------

--
-- Table structure for table `rak`
--

CREATE TABLE `rak` (
  `id_rak` int(5) NOT NULL,
  `nama_rak` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rak`
--

INSERT INTO `rak` (`id_rak`, `nama_rak`, `keterangan`) VALUES
(2, 'Rak A', 'SDAFDSFAS'),
(3, 'Rak B', 'SDFSDFF');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','petugas','anggota') DEFAULT 'anggota',
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `username`, `password`, `role`, `foto`, `status`, `created_at`) VALUES
(20, 'beckah ', 'peckham@gmal.com', 'beckham', '$2y$10$t3dE4fZKKXbmZVPl2Q3SmuyWSDu6eMAM1Wao.OOa6hs9tvTWOWM6a', 'anggota', '1776715443_9e34ffb2a1484ec59eca.jpg', 'aktif', '2026-04-20 20:04:03'),
(21, 'panjatjay', 'purnamapanji459@gmail.com', 'panji', '$2y$10$piaBnqsjh8HhDufc9oZZHu5i20WcnE2oRVFg.DPHv3.13UomsofSG', 'admin', '1776964410_4ded8256b6ff75205a8f.png', 'aktif', '2026-04-21 04:53:30'),
(22, 'pedri gozales', 'pedri@gmail.com', 'pedri', '$2y$10$RQiJCm6ew/MZFhiGBXH5yemStoW93ZXkCXF2QjB4vxc4gWxk1POVS', 'petugas', '1776747389_04e65016d54268bfec02.jpg', 'aktif', '2026-04-21 04:56:29'),
(23, 'pau cubarsi', 'cubarsi@gmail.com', 'cubarsi', '$2y$10$9Hv3MtAGzG3YZQYeQPTneeVFv0aCvgbA6PwinNcPC/vzu2fwIiyiG', 'anggota', '1776791161_a8a66079fda09614ac9f.jpg', 'aktif', '2026-04-21 17:06:01'),
(25, 'panjatjay', 'owo@gmail.com', 'panji', '$2y$10$q07X1rxCgTjRh/cneEtew.5nQhQG4w3Gh73VyQCvz3fMJR9CYSGR6', 'anggota', '1776875404_7a1473f0db5fc7c92656.jpg', 'aktif', '2026-04-22 07:43:41'),
(26, 'prabowo', 'owo@gmail.com', 'paowo', '$2y$10$G2VknuvyHG3DaSUf1I.Q5uoK3XF6HgKvBI/5Ybnrq6ug9YEjF.Tg2', 'anggota', '1776875429_f30411052154ecad7feb.png', 'aktif', '2026-04-22 15:54:14'),
(27, 'lamine yamale', 'yamal@gmail.com', 'lamine', '$2y$10$RhwPeEiBorXOV9.ojlk0eOUKXRqK/2VE5JDfEynv5W.AwxTNG6pT6', 'anggota', '1776927324_ed3599ac79e4282a213c.jpg', 'aktif', '2026-04-23 06:55:24'),
(28, 'bojan hodak', 'bojan@gmail.com', 'bojan', '$2y$10$KeT7Wq.NDDVtgCyCyptCWemASLQLizwBIzBUF0nWOoNlOWyLQU72e', 'anggota', '1776927885_89ea7c2a06b23554086b.jpg', 'aktif', '2026-04-23 07:04:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_book`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `fk_user` (`id_user`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id_penulis`);

--
-- Indexes for table `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id_rak`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id_penulis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rak`
--
ALTER TABLE `rak`
  MODIFY `id_rak` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
