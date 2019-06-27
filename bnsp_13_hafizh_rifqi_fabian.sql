-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2019 at 12:31 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bnsp_13_hafizh_rifqi_fabian`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `search_procedure` (IN `keyword` VARCHAR(30))  NO SQL
SELECT * FROM vinventaris v WHERE v.nama LIKE keyword OR v.kode LIKE keyword OR v.kondisi LIKE keyword OR v.ruang LIKE keyword OR v.jenis LIKE keyword OR v.admin LIKE keyword OR v.keterangan LIKE keyword OR v.tanggal_register LIKE keyword$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `total` (`IDS` INT(12)) RETURNS INT(12) BEGIN
     DECLARE NM int(12);
     SELECT COUNT(*) FROM peminjamans WHERE peminjamans.peminjam_id=IDS INTO NM;
     RETURN NM;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(12) UNSIGNED NOT NULL,
  `user_id` int(12) UNSIGNED NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_id`, `nama`, `alamat`, `telepon`) VALUES
(1, 3, 'Bendy Santoso', 'Jl Pengasinan 2, Pekayon Jaya Bekasi Selatan', 85716080466);

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjamans`
--

CREATE TABLE `detail_peminjamans` (
  `id` int(12) UNSIGNED NOT NULL,
  `peminjaman_id` int(12) UNSIGNED NOT NULL,
  `inventaris_id` int(12) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_peminjamans`
--

INSERT INTO `detail_peminjamans` (`id`, `peminjaman_id`, `inventaris_id`) VALUES
(128, 5, 1),
(129, 6, 2),
(130, 7, 1),
(131, 7, 7),
(137, 9, 2),
(138, 9, 8);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penerimaans`
--

CREATE TABLE `detail_penerimaans` (
  `id` int(12) UNSIGNED NOT NULL,
  `penerimaan_id` int(12) UNSIGNED NOT NULL,
  `barang` varchar(30) NOT NULL,
  `jumlah` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventariss`
--

CREATE TABLE `inventariss` (
  `id` int(12) UNSIGNED NOT NULL,
  `jenis_id` int(12) UNSIGNED NOT NULL,
  `ruang_id` int(12) UNSIGNED NOT NULL,
  `admin_id` int(12) UNSIGNED NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kode` varchar(12) NOT NULL,
  `kondisi` varchar(15) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `tanggal_register` date NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventariss`
--

INSERT INTO `inventariss` (`id`, `jenis_id`, `ruang_id`, `admin_id`, `nama`, `kode`, `kondisi`, `keterangan`, `tanggal_register`, `image`) VALUES
(1, 1, 1, 1, 'Thinkpad E111', 'KBS111', 'Tersedia', 'Intel Core i7', '2019-04-01', 'laptop.jpg'),
(2, 2, 1, 1, 'Epson L300', 'KL111s', 'Tersedia', 'Printer Inkjet', '2019-04-01', 'printer.jpg'),
(3, 1, 3, 1, 'Acer Aspire', 'KLss12', 'Dipinjam', 'Intel Core i3', '2019-04-10', 'acer.jpg'),
(4, 2, 1, 1, 'Epson L100', 'PRss1', 'Rusak', 'Printer Inkjet', '2019-04-01', 'printer.jpg'),
(5, 4, 1, 1, 'Headset Gaming', 'KGH123', 'Tersedia', 'Headset Stereo', '2019-04-01', 'Headset.jpg'),
(6, 4, 2, 1, 'Proyektor Infocus', 'KKS1a', 'Dipinjam', 'Proyektor Infocus', '2019-04-01', 'Proyektor.jpg'),
(7, 4, 2, 1, 'Proyektor Sony C100', 'CaoS9', 'Tersedia', 'Proyektor Sony', '2018-10-15', 'Proyektor.jpg'),
(8, 3, 3, 1, 'Lemari Kayu', 'Cas!3', 'Tersedia', 'TIdak Untuk Dipinjam', '2017-08-05', 'Lemari.jpg'),
(9, 4, 2, 1, 'Kipas Regency', 'RHa12', 'Tersedia', 'Kipas dengan water system', '2018-09-20', 'kipas.jpg'),
(10, 3, 1, 1, 'Meja Belajar', 'sadRda1', 'Dipinjam', 'Tidak Boleh Dipinjam', '2018-10-18', 'mejaputih.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `jeniss`
--

CREATE TABLE `jeniss` (
  `id` int(12) UNSIGNED NOT NULL,
  `nama_jenis` varchar(15) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jeniss`
--

INSERT INTO `jeniss` (`id`, `nama_jenis`, `keterangan`) VALUES
(1, 'Laptop', 'Laptop'),
(2, 'Printer', 'Printer'),
(3, 'Furnitur', 'Furnitur'),
(4, 'Elektronik', 'Elektronik');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(12) UNSIGNED NOT NULL,
  `nama_level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `nama_level`) VALUES
(1, 'Admin'),
(2, 'Peminjam');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `event` varchar(50) NOT NULL,
  `tanggal` datetime NOT NULL,
  `tabel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `event`, `tanggal`, `tabel`) VALUES
(0, 'DELETE', '2019-04-04 16:34:15', 'peminjaman'),
(2, 'INSERT', '2019-04-02 12:04:46', 'peminjamans'),
(3, 'DELETE', '2019-04-02 12:05:47', 'peminjaman'),
(4, 'INSERT', '2019-04-02 13:02:12', 'peminjamans'),
(5, 'INSERT', '2019-04-02 13:11:29', 'peminjamans'),
(6, 'DELETE', '2019-04-02 13:14:39', 'peminjaman'),
(7, 'INSERT', '2019-04-02 13:19:55', 'peminjamans'),
(8, 'INSERT', '2019-04-02 13:25:33', 'peminjamans'),
(9, 'DELETE', '2019-04-02 13:25:50', 'peminjaman'),
(10, 'INSERT', '2019-04-02 14:25:12', 'peminjamans'),
(11, 'DELETE', '2019-04-02 14:43:42', 'peminjaman'),
(12, 'INSERT', '2019-04-02 15:11:15', 'peminjamans'),
(13, 'DELETE', '2019-04-02 15:56:35', 'peminjaman'),
(14, 'DELETE', '2019-04-02 15:56:38', 'peminjaman'),
(15, 'INSERT', '2019-04-02 16:03:44', 'peminjamans'),
(16, 'INSERT', '2019-04-02 17:07:33', 'peminjamans'),
(17, 'DELETE', '2019-04-02 17:07:37', 'peminjaman'),
(18, 'DELETE', '2019-04-02 17:07:39', 'peminjaman'),
(19, 'INSERT', '2019-04-02 17:07:51', 'peminjamans'),
(20, 'INSERT', '2019-04-02 17:08:06', 'peminjamans'),
(21, 'DELETE', '2019-04-02 17:09:32', 'peminjaman'),
(22, 'DELETE', '2019-04-02 17:19:02', 'peminjaman'),
(23, 'INSERT', '2019-04-02 17:19:09', 'peminjamans'),
(24, 'DELETE', '2019-04-02 17:23:24', 'peminjaman'),
(25, 'INSERT', '2019-04-02 17:23:30', 'peminjamans'),
(26, 'DELETE', '2019-04-02 17:35:29', 'peminjaman'),
(27, 'INSERT', '2019-04-02 17:35:35', 'peminjamans'),
(28, 'DELETE', '2019-04-02 17:36:04', 'peminjaman'),
(29, 'INSERT', '2019-04-02 17:36:11', 'peminjamans'),
(30, 'DELETE', '2019-04-02 17:37:20', 'peminjaman'),
(31, 'INSERT', '2019-04-02 17:37:29', 'peminjamans'),
(32, 'DELETE', '2019-04-04 07:11:02', 'peminjaman'),
(33, 'INSERT', '2019-04-04 07:14:25', 'peminjamans'),
(34, 'INSERT', '2019-04-04 07:25:18', 'peminjamans'),
(35, 'INSERT', '2019-04-04 07:25:35', 'peminjamans'),
(36, 'DELETE', '2019-04-04 07:31:31', 'peminjaman'),
(37, 'DELETE', '2019-04-04 07:31:33', 'peminjaman'),
(38, 'DELETE', '2019-04-04 07:31:34', 'peminjaman'),
(39, 'INSERT', '2019-04-04 07:38:00', 'peminjamans'),
(40, 'INSERT', '2019-04-04 07:38:20', 'peminjamans'),
(41, 'DELETE', '2019-04-04 07:46:01', 'peminjaman'),
(42, 'DELETE', '2019-04-04 08:11:15', 'peminjaman'),
(43, 'INSERT', '2019-04-04 08:11:21', 'peminjamans'),
(44, 'DELETE', '2019-04-04 08:12:51', 'peminjaman'),
(45, 'INSERT', '2019-04-04 08:15:07', 'peminjamans'),
(46, 'INSERT', '2019-04-04 08:15:20', 'peminjamans'),
(47, 'DELETE', '2019-04-04 08:18:18', 'peminjaman'),
(48, 'INSERT', '2019-04-04 08:36:33', 'peminjamans'),
(49, 'INSERT', '2019-04-04 08:36:39', 'peminjamans'),
(50, 'DELETE', '2019-04-04 08:42:59', 'peminjaman'),
(51, 'DELETE', '2019-04-04 08:43:00', 'peminjaman'),
(52, 'DELETE', '2019-04-04 08:43:01', 'peminjaman'),
(53, 'INSERT', '2019-04-04 08:43:19', 'peminjamans'),
(54, 'INSERT', '2019-04-04 08:43:59', 'peminjamans'),
(55, 'INSERT', '2019-04-04 08:49:03', 'peminjamans'),
(56, 'DELETE', '2019-04-04 09:39:30', 'peminjaman'),
(57, 'DELETE', '2019-04-04 09:47:38', 'peminjaman'),
(58, 'DELETE', '2019-04-04 09:47:40', 'peminjaman'),
(59, 'INSERT', '2019-04-04 09:47:46', 'peminjamans'),
(60, 'INSERT', '2019-04-04 09:48:38', 'peminjamans'),
(61, 'DELETE', '2019-04-04 09:51:17', 'peminjaman'),
(62, 'DELETE', '2019-04-04 09:53:09', 'peminjaman'),
(63, 'INSERT', '2019-04-04 11:32:01', 'peminjamans');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `operators`
--

CREATE TABLE `operators` (
  `id` int(12) UNSIGNED NOT NULL,
  `user_id` int(12) UNSIGNED NOT NULL,
  `nama` varchar(30) NOT NULL,
  `nip` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telefon` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjamans`
--

CREATE TABLE `peminjamans` (
  `id` int(12) UNSIGNED NOT NULL,
  `kode` varchar(30) NOT NULL,
  `peminjam_id` int(12) UNSIGNED NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status_peminjaman` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjamans`
--

INSERT INTO `peminjamans` (`id`, `kode`, `peminjam_id`, `tanggal_pinjam`, `tanggal_kembali`, `status_peminjaman`) VALUES
(1, 'asassaasfafdasfasdf', 3, '2019-04-03', '0000-00-00', 'Sedang Berjalan'),
(5, '5ca5d186d217e', 3, '2019-04-04', NULL, 'Belum Dikonfirmasi'),
(6, '5ca5d19089581', 3, '2019-04-04', NULL, 'Belum Dikonfirmasi'),
(7, '5ca5d1c07bc0f', 3, '2019-04-04', NULL, 'Belum Dikonfirmasi'),
(9, '5ca6bf3928718', 3, '2019-04-05', NULL, 'Belum Dikonfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `peminjams`
--

CREATE TABLE `peminjams` (
  `id` int(12) UNSIGNED NOT NULL,
  `user_id` int(12) UNSIGNED NOT NULL,
  `nama` varchar(30) NOT NULL,
  `no_induk` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` bigint(20) NOT NULL,
  `jabatan` varchar(15) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjams`
--

INSERT INTO `peminjams` (`id`, `user_id`, `nama`, `no_induk`, `alamat`, `telepon`, `jabatan`, `image`) VALUES
(1, 2, 'Bendy Santoso', '161710327', 'Jl Ujung Harapan', 85716080466, 'Siswa', ''),
(2, 3, 'Bendy Santoso Jr', '161710322', 'Jl Kemandoran', 85716080461, 'Siswa', ''),
(3, 4, 'Hafizh Rifqi Fabian', '161722131', 'Jl Kemandoran RT 02/022', 86716080466, 'Siswa', '');

-- --------------------------------------------------------

--
-- Table structure for table `penerimaans`
--

CREATE TABLE `penerimaans` (
  `id` int(12) UNSIGNED NOT NULL,
  `admin_id` int(12) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `dari` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ruangs`
--

CREATE TABLE `ruangs` (
  `id` int(12) UNSIGNED NOT NULL,
  `nama_ruang` varchar(15) NOT NULL,
  `kode_ruang` varchar(15) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruangs`
--

INSERT INTO `ruangs` (`id`, `nama_ruang`, `kode_ruang`, `keterangan`) VALUES
(1, 'Lab RPL', '133', 'Kaprog RPL'),
(2, 'Tata Usaha', 'TU1', 'Ruang Tata Usaha'),
(3, 'Kantor Guru', 'KGu', 'Kantor Guru');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(12) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level_id` int(12) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `level_id`) VALUES
(2, 'bendy jr', 'bendy@gmail.com', NULL, '$2y$10$CghG/bAcOVDvgYdWhfPSZ.fRhov15Z/KC.yqDvvYCO9HLO7pJ76aa', 'zWynzaDsoJWmhu3kjd09b3CyMwoGVVAYDY8OQexNp0GhwcFf4ddWXy09xCVL', '2019-03-31 19:22:17', '2019-03-31 19:22:17', 1),
(3, 'bendy', 'a@a.com', NULL, '$2y$10$iObosPDBhHaZtpav8oS3Y.wa1BP.8PwRMJjuvfCRVqtoRYp9kuvQe', '9ZB1WNeReJOv8Q4QyIYq5Sfp0q6k9XW9hx6z8HHavBiUMAmS6R5Pc3pUMVVA', '2019-03-31 19:37:58', '2019-03-31 19:37:58', 1),
(4, 'Hafizh RF', 'hafizhrf@gmail.com', NULL, '$2y$10$bM.8xJ29R2Ohic7XkH.qZ.iNYHx7KkrkZ9s0D1Ie15wsPBzXmnR42', 'umkmu4nDN46f5PlFUQsWyLStum5H7onc9a1ibkttXHTOV6CkYptxVhiMnerO', '2019-04-01 20:13:51', '2019-04-01 20:13:51', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vdetail`
-- (See below for the actual view)
--
CREATE TABLE `vdetail` (
`id` int(12) unsigned
,`peminjaman_id` int(12) unsigned
,`kode` varchar(12)
,`nama` varchar(30)
,`keterangan` varchar(50)
,`image` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vinventaris`
-- (See below for the actual view)
--
CREATE TABLE `vinventaris` (
`id` int(12) unsigned
,`nama` varchar(30)
,`kode` varchar(12)
,`kondisi` varchar(15)
,`keterangan` varchar(50)
,`admin_id` int(12) unsigned
,`tanggal_register` date
,`nama_jenis` varchar(15)
,`nama_ruang` varchar(15)
,`image` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vpeminjaman`
-- (See below for the actual view)
--
CREATE TABLE `vpeminjaman` (
`id` int(12) unsigned
,`kode` varchar(30)
,`peminjam_id` int(12) unsigned
,`peminjam` varchar(30)
,`tanggal_pinjam` date
,`tanggal_kembali` date
,`status_peminjaman` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure for view `vdetail`
--
DROP TABLE IF EXISTS `vdetail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vdetail`  AS  select `d`.`id` AS `id`,`d`.`peminjaman_id` AS `peminjaman_id`,`i`.`kode` AS `kode`,`i`.`nama` AS `nama`,`i`.`keterangan` AS `keterangan`,`i`.`image` AS `image` from (`inventariss` `i` join `detail_peminjamans` `d`) where (`d`.`inventaris_id` = `i`.`id`) ;

-- --------------------------------------------------------

--
-- Structure for view `vinventaris`
--
DROP TABLE IF EXISTS `vinventaris`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vinventaris`  AS  select `i`.`id` AS `id`,`i`.`nama` AS `nama`,`i`.`kode` AS `kode`,`i`.`kondisi` AS `kondisi`,`i`.`keterangan` AS `keterangan`,`i`.`admin_id` AS `admin_id`,`i`.`tanggal_register` AS `tanggal_register`,`j`.`nama_jenis` AS `nama_jenis`,`r`.`nama_ruang` AS `nama_ruang`,`i`.`image` AS `image` from ((`inventariss` `i` join `ruangs` `r`) join `jeniss` `j`) where ((`r`.`id` = `i`.`ruang_id`) and (`j`.`id` = `i`.`jenis_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `vpeminjaman`
--
DROP TABLE IF EXISTS `vpeminjaman`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vpeminjaman`  AS  select `s`.`id` AS `id`,`s`.`kode` AS `kode`,`s`.`peminjam_id` AS `peminjam_id`,`p`.`nama` AS `peminjam`,`s`.`tanggal_pinjam` AS `tanggal_pinjam`,`s`.`tanggal_kembali` AS `tanggal_kembali`,`s`.`status_peminjaman` AS `status_peminjaman` from (`peminjamans` `s` join `peminjams` `p`) where (`s`.`peminjam_id` = `p`.`id`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `detail_peminjamans`
--
ALTER TABLE `detail_peminjamans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_id` (`peminjaman_id`),
  ADD KEY `inventaris_id` (`inventaris_id`);

--
-- Indexes for table `detail_penerimaans`
--
ALTER TABLE `detail_penerimaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penerimaan_id` (`penerimaan_id`);

--
-- Indexes for table `inventariss`
--
ALTER TABLE `inventariss`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_id` (`jenis_id`),
  ADD KEY `ruang_id` (`ruang_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `jeniss`
--
ALTER TABLE `jeniss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operators`
--
ALTER TABLE `operators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjam_id` (`peminjam_id`);

--
-- Indexes for table `peminjams`
--
ALTER TABLE `peminjams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `penerimaans`
--
ALTER TABLE `penerimaans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `ruangs`
--
ALTER TABLE `ruangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `level_id` (`level_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_peminjamans`
--
ALTER TABLE `detail_peminjamans`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `detail_penerimaans`
--
ALTER TABLE `detail_penerimaans`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventariss`
--
ALTER TABLE `inventariss`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jeniss`
--
ALTER TABLE `jeniss`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peminjamans`
--
ALTER TABLE `peminjamans`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `peminjams`
--
ALTER TABLE `peminjams`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penerimaans`
--
ALTER TABLE `penerimaans`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ruangs`
--
ALTER TABLE `ruangs`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_peminjamans`
--
ALTER TABLE `detail_peminjamans`
  ADD CONSTRAINT `fkinv` FOREIGN KEY (`inventaris_id`) REFERENCES `inventariss` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkpem` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjamans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_penerimaans`
--
ALTER TABLE `detail_penerimaans`
  ADD CONSTRAINT `fk_pen` FOREIGN KEY (`penerimaan_id`) REFERENCES `penerimaans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventariss`
--
ALTER TABLE `inventariss`
  ADD CONSTRAINT `fk_admin` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jenis` FOREIGN KEY (`jenis_id`) REFERENCES `jeniss` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ruang` FOREIGN KEY (`ruang_id`) REFERENCES `ruangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `operators`
--
ALTER TABLE `operators`
  ADD CONSTRAINT `sddsd` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD CONSTRAINT `fk_peminjam` FOREIGN KEY (`peminjam_id`) REFERENCES `peminjams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjams`
--
ALTER TABLE `peminjams`
  ADD CONSTRAINT `fkuserid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_lvl` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
