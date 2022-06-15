-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jun 2022 pada 18.24
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aplikasi`
--

CREATE TABLE `aplikasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_owner` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tlp` varchar(50) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `nama_aplikasi` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `copy_right` varchar(50) DEFAULT NULL,
  `versi` varchar(20) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `aplikasi`
--

INSERT INTO `aplikasi` (`id`, `nama_owner`, `alamat`, `tlp`, `title`, `nama_aplikasi`, `logo`, `copy_right`, `versi`, `tahun`) VALUES
(1, 'AKN', 'JL. Rawabali', '085797887711', 'ABSENSI', 'ABSENSI', 'logo_akn_tulisan_putih.png', 'Copy Right © AKN', '1.0.0.0', 2022);

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_kehadiran`
--

CREATE TABLE `status_kehadiran` (
  `id` int(11) NOT NULL,
  `status_kehadiran` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `status_kehadiran`
--

INSERT INTO `status_kehadiran` (`id`, `status_kehadiran`) VALUES
(1, 'Lupa Absen'),
(2, 'Ijin Datang Terlambat'),
(3, 'Ijin Pulang Cepat'),
(4, 'Mesin Rusak'),
(5, 'Aplikasi Error'),
(6, 'Force Majeur'),
(7, 'Penugasan Kurang dari 8 Jam'),
(8, 'Keperluan Mendadak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `userlevel`
--

CREATE TABLE `userlevel` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `userlevel`
--

INSERT INTO `userlevel` (`id_level`, `nama_level`) VALUES
(1, 'Admin'),
(2, 'Pegawai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tlp` varchar(20) NOT NULL,
  `id_level` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `date_created` datetime NOT NULL,
  `update_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `email`, `username`, `password`, `tlp`, `id_level`, `image`, `is_active`, `date_created`, `update_created`) VALUES
(2, 'Ade Rohmat Maulana', 'aderohmatmaulana77@gmail.com', 'admin', '$2y$05$oDJNmsPd0unSj1xbw2qP6.oeeuDhBhi.PBrwsCD1xkkMm/Iy2D.J6', '085797887711', 1, 'admin.jpg', 'Y', '2022-06-14 23:25:15', '0000-00-00 00:00:00'),
(14, 'septian david', 'septian@gmail.com', 'septian', '$2y$05$fJNzXaWoPFlW2sWGG/1ByuyfMAKgSpCL.LVl9jTXLpJxT2qe4fMKy', '085797887711', 1, 'septian.png', 'Y', '2022-06-15 00:36:47', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `status_kehadiran`
--
ALTER TABLE `status_kehadiran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `userlevel`
--
ALTER TABLE `userlevel`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aplikasi`
--
ALTER TABLE `aplikasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `status_kehadiran`
--
ALTER TABLE `status_kehadiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `userlevel`
--
ALTER TABLE `userlevel`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
