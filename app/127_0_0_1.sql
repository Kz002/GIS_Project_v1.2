-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2024 at 02:22 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db-gisproject`
--
CREATE DATABASE IF NOT EXISTS `db-gisproject` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db-gisproject`;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-12-03-114812', 'App\\Database\\Migrations\\Users', 'default', 'App', 1701604385, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log`
--

CREATE TABLE `tbl_log` (
  `id_log` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(30) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  `tgl_log` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_log`
--

INSERT INTO `tbl_log` (`id_log`, `nama_user`, `latitude`, `longitude`, `alamat`, `tgl_log`) VALUES
(71, 'Taufiq Hidayat', '-0.45847942628927', '100.40202713222', 'Jalan M Yamin, Padang Panjang Barat, Sumatera Barat, 27115', '2024-01-09 23:38:22'),
(72, 'User 1', '-0.45847942628927', '100.40202713222', 'Jalan M Yamin, Padang Panjang Barat, Sumatera Barat, 27115', '2024-01-09 23:39:26'),
(73, 'Taufiq Hidayat', '-0.45847942628927', '100.40202713222', 'Jalan M Yamin, Padang Panjang Barat, Sumatera Barat, 27115', '2024-01-10 00:12:18'),
(74, 'Taufiq Hidayat', '-0.47216700609987', '100.37281036377', 'Jalan Lintas Padang-Bukit Tinggi, Padang Panjang Barat, Sumatera Barat, 27118', '2024-01-10 08:03:15'),
(76, 'Taufiq Hidayat', '-0.29640670844737', '100.39317473711', 'Toko Planet Shoes', '2024-01-10 08:04:09'),
(77, 'Taufiq Hidayat', '-0.29640670844737', '100.39317473711', 'Toko Planet Shoes', '2024-01-10 16:56:26'),
(78, 'Taufiq Hidayat', '-0.46532072030302', '100.38435091448', 'Pondok Ketupat Pak Met', '2024-01-10 16:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lokasi`
--

CREATE TABLE `tbl_lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `nama_lokasi` varchar(300) DEFAULT NULL,
  `alamat_lokasi` text DEFAULT NULL,
  `latitude` varchar(300) DEFAULT NULL,
  `longitude` varchar(300) DEFAULT NULL,
  `foto_lokasi` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_lokasi`
--

INSERT INTO `tbl_lokasi` (`id_lokasi`, `nama_lokasi`, `alamat_lokasi`, `latitude`, `longitude`, `foto_lokasi`) VALUES
(2, 'Mahkota Kerupuk', 'Saruaso', '-0.48070522447549324', '100.63781261179781', '1702598902_1e85f3e77db06d9a53e5.png'),
(7, 'Pasar Talawi', 'Talawi Hilir, Talawi, Sawahlunto, Sumatera Barat', '-0.5914775493319593', '100.73594026819144', '1702599069_4030c8c4fc59135c9079.png'),
(8, 'Pasar Sawahlunto', 'Pasar, Lembah Segar, Sawahlunto, Sumatera Barat', '-0.6841969536845602', '100.77813776634532', '1702599389_2c294866124f196ca19a.jpeg'),
(12, 'Sate Mak Syukur', 'Jl. Sutan Syahrir No.250, Silaing Bawah, Kec. Padang Panjang Bar., Kota Padang Panjang, Sumatera Barat', '-0.4656776432120734', '100.3816412061776', '1702599645_a72f874ef0c5b32b10f9.jpeg'),
(14, 'Sate Saiyo', 'Jl. Sutan Syahrir No.138, Silaing Bawah, Kec. Padang Panjang Bar., Kota Padang Panjang, Sumatera Barat', '-0.46527668684207485', '100.38412972191773', '1702599749_29777b22c4c69dcf7a0b.jpg'),
(16, 'RM Salero Kampuang', 'Jl. Lintas Sumatera, Saok Laweh, Kec. Kubung, Kabupaten Solok, Sumatera Barat', '-0.7859666887940943', '100.6719859643777', '1702599961_06b939033a41dc15d0af.png'),
(17, 'RM Singkarak Raya', 'Jl. Soekarno Hatta No.99, Talang Klp., Kec. Alang-Alang Lebar, Kota Palembang, Sumatera Selatan', '-2.9510589564945247', '104.69849976879918', '1702600550_e1e52c7a560c71371101.jpg'),
(18, 'RM Begadang', ' Jl. MP. Mangkunegara, 8 Ilir, Kec. Ilir Tim. II, Kota Palembang, Sumatera Selatan', '-2.9474369793894586', '104.76791438111438', '1702600751_9de8bb94bda681458afb.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level` int(1) DEFAULT NULL,
  `foto_user` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `email`, `no_hp`, `password`, `level`, `foto_user`) VALUES
(4, 'Taufiq Hidayat', 'admin@gmail.com', '08111111111111', 'admin', 1, '20101152610172.jpg'),
(5, 'User 1', 'User1@gmail.com', '08222222222222', 'user1', 2, 'a.jpg'),
(6, 'User 2', 'User2@gmail.com', '08333333333333', 'user2', 2, 'a.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
