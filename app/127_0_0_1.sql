-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2024 at 05:30 AM
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
(81, 'Muhammad Rozakh', '-0.46531944933427', '100.38417117238', 'Jalan Lintas Padang-Bukit Tinggi, Padang Panjang Barat, Sumatera Barat, 27118', '2024-01-12 10:13:21'),
(82, 'Muhammad Rozakh', '-0.46583561065985', '100.38141266456', 'Jalan Lintas Padang-Bukit Tinggi, Padang Panjang Barat, Sumatera Barat, 27118', '2024-01-12 10:14:03'),
(83, 'Muhammad Rozakh', '-0.48811958959059', '100.56173108568', '27271, Sumatera Barat', '2024-01-12 10:16:25'),
(84, 'Muhammad Rozakh', '-0.41713678242022', '100.56830798313', '27261, Sumatera Barat', '2024-01-12 10:30:34'),
(85, 'Muhammad Rozakh', '-0.40963517086016', '100.59624170273', 'Jalan Lintau-Batu Sangkar, Sungayang, Sumatera Barat, 27294', '2024-01-12 10:31:47'),
(89, 'Muhammad Rozakh', '-0.52525280322008', '100.69575080002', '27282, Sumatera Barat', '2024-01-12 10:34:21'),
(90, 'Muhammad Rozakh', '-0.41041418667908', '100.73320990848', '27291, Sumatera Barat', '2024-01-12 10:35:19'),
(91, 'Farhan Elvado', '-0.40783308906966', '100.59707297884', 'Ikenuy Jaya Steam', '2024-01-12 10:37:18'),
(92, 'Farhan Elvado', '-0.41737970985807', '100.56841083858', '27261, Sumatera Barat', '2024-01-12 10:37:46'),
(96, 'Farhan Elvado', '-0.59221267549813', '100.73568893385', 'Jalan M Yamin, Talawi, Sumatera Barat, 27444', '2024-01-12 10:40:51'),
(98, 'Fauzi Hamdani', '-2.9492193069098', '104.76703560984', '30114, Sumatera Selatan', '2024-01-12 10:43:05'),
(99, 'Fauzi Hamdani', '-2.9517337452328', '104.69781340094', 'Jalan Soekarno Hatta, Alang Alang Lebar, Sumatera Selatan, 30159', '2024-01-12 10:44:32'),
(100, 'Fauzi Hamdani', '-0.33037205267051', '103.14967264445', '29223, Riau', '2024-01-12 10:45:26'),
(101, 'Fauzi Hamdani', '0.48176587629069', '101.45497806644', 'Jalan Datuk Setia Maharaja, Bukit Raya, Riau, 28284', '2024-01-12 10:46:08');

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
(18, 'RM Begadang', ' Jl. MP. Mangkunegara, 8 Ilir, Kec. Ilir Tim. II, Kota Palembang, Sumatera Selatan', '-2.9474369793894586', '104.76791438111438', '1702600751_9de8bb94bda681458afb.jpg'),
(20, 'Lintau', 'Lintau Buo Utara, Kecamatan Lintau Buo Utara, Tanah Datar, Sumatera Barat', '-0.41019141940902554', '100.73295648697845', '1705026083_930a08336ccb333d9cd4.png'),
(21, 'Padang Gantiang', 'Padang Ganting, Tanah Datar, Sumatera Barat', '-0.5253228155338183', '100.69582895671314', '1705026385_664bd9bd69d0f322c8d7.png'),
(22, 'Rambatan', 'Rambatan, Tanah Datar, West Sumatra', '-0.48773334520030687', '100.56124464001837', '1705026681_755782d9ede451a8f687.png'),
(23, 'Sungayang', 'Sungayang, Kecamatan Sungayang, Tanah Datar, Sumatra Barat', '-0.4097727010759938', '100.5961733664269', '1705026986_0961661eaa234ad74c63.png'),
(24, 'Sungai Tarab', 'Tarab River, Sungai Tarab, Tanah Datar Regency, West Sumatra', '-0.4168915999826936', '100.56818539394078', '1705027195_62f253f914f984c96831.png'),
(25, 'Pekanbaru', 'Jl. HOS. Cokroaminoto No.16, Sukaramai, Kec. Pekanbaru Kota, Kota Pekanbaru, Riau 28155', '0.5334882386307134', '101.44652725387157', '1705027465_ba6b24dac18d02fc7035.png'),
(26, 'Tembilahan', 'Tembilahan Kota, Kec. Tembilahan, Kabupaten Indragiri Hilir, Riau', '-0.31947035547189145', '103.1546838873975', '1705028529_f65f412b09fbfe8d3860.png');

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
(5, 'Muhammad Rozakh', 'User1@gmail.com', '08222222222222', 'user1', 2, 'user.png'),
(6, 'Farhan Elvado', 'User2@gmail.com', '08333333333333', 'user2', 2, 'user.png'),
(7, 'Fauzi Hamdani', 'User3@gmail.com', '0844444444444', 'user3', 2, 'user.png');

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
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
