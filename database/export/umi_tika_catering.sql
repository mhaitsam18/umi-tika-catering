-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2024 at 02:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umi_tika_catering`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemesanan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `menu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga_per_item` double(8,2) DEFAULT NULL,
  `harga_total` double(8,2) DEFAULT NULL,
  `testimoni` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `pemesanan_id`, `menu_id`, `jumlah`, `harga_per_item`, `harga_total`, `testimoni`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 21000.00, 21000.00, NULL, '2023-11-16 13:12:28', '2023-11-16 13:12:28', NULL),
(2, 1, 6, 1, 21000.00, 21000.00, NULL, '2023-11-16 13:12:28', '2023-11-16 13:12:28', NULL),
(3, 1, 11, 1, 23000.00, 23000.00, NULL, '2023-11-16 13:12:28', '2023-11-16 13:12:28', NULL),
(4, 2, 11, 1, 23000.00, 23000.00, 'tes dulu', '2023-11-16 14:37:16', '2023-11-16 14:37:16', NULL),
(5, 2, 6, 1, 21000.00, 21000.00, 'asdasd', '2023-11-16 14:37:16', '2023-11-16 14:37:16', NULL),
(6, 2, 16, 1, 23000.00, 23000.00, 'cobain', '2023-11-16 14:37:16', '2023-11-16 14:37:16', NULL),
(7, 2, 21, 1, 28000.00, 28000.00, 'terakhir', '2023-11-16 14:37:16', '2023-11-16 20:09:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `alamat_kirim` varchar(255) DEFAULT NULL,
  `nomor_wa` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `user_id`, `alamat_kirim`, `nomor_wa`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Umayah 1 Kost Griya Mustika', '085846826125', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(2, 3, 'Umayah 1 Kost Griya Mustika sari', '081223219664', '2023-11-12 09:10:12', '2023-11-16 09:22:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu` varchar(255) DEFAULT NULL,
  `waktu_makan` enum('breakfast','lunch','dinner') DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `paket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu`, `waktu_makan`, `tanggal`, `paket_id`, `gambar`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Nasi Putih, Gulai udang/ayam, rendang tempe, tumis kol kacang panjang, sambal hijau', 'lunch', '2023-12-04', 1, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(2, 'Nasi Putih, Ayam Kari Crispy, Tahu Balado, Lalapan, sambal', 'lunch', '2023-12-05', 1, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(3, 'Nasi Putih, scitch beef eff, kentang saus tiram, Cah pakcoy wortel, saus sambal', 'lunch', '2023-12-06', 1, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(4, 'Nasi Putih, Telor gochujang, Gimmari, cah sawi putih, saus sambal', 'lunch', '2023-12-07', 1, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(5, 'Nasi Putih, Sate ayam maranggi, sup sayur sosis, sambal kecap, snack', 'lunch', '2023-12-08', 1, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(6, 'Nasi Putih, Semur telur, perkedel tahu, cah labusiam', 'dinner', '2023-12-04', 1, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(7, 'Nasi Putih, soto bandung daging sapi, bola-bola sayur, sambal', 'dinner', '2023-12-05', 1, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(8, 'Nasi Putih, Kuwotie ayam, kentang saus tiram, cah tauge, saus sambal', 'dinner', '2023-12-06', 1, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(9, 'Nasi Putih, ayam suwir kemangi, tempe bacem, sayur lodeh, sambal', 'dinner', '2023-12-07', 1, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(10, 'Nasi Putih, ikan kakap fillet/ayam fillet, makaroni keju, tumis buncis wortel jagung telur, saus sambal, snack', 'dinner', '2023-12-08', 1, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(11, 'Nasi Merah, Gulai udang/ayam, rendang tempe, tumis kol kacang panjang, sambal hijau', 'lunch', '2023-12-04', 2, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(12, 'Nasi Merah, Ayam Kari Crispy, Tahu Balado, Lalapan, sambal', 'lunch', '2023-12-05', 2, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(13, 'Nasi Merah, scitch beef eff, kentang saus tiram, Cah pakcoy wortel, saus sambal', 'lunch', '2023-12-06', 2, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(14, 'Nasi Merah, Telor gochujang, Gimmari, cah sawi Putih, saus sambal', 'lunch', '2023-12-07', 2, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(15, 'Nasi Merah, Sate ayam maranggi, sup sayur sosis, sambal kecap, snack', 'lunch', '2023-12-08', 2, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(16, 'Nasi Merah, Semur telur, perkedel tahu, cah labusiam', 'dinner', '2023-12-04', 2, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(17, 'Nasi Merah, soto bandung daging sapi, bola-bola sayur, sambal', 'dinner', '2023-12-05', 2, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(18, 'Nasi Merah, Kuwotie ayam, kentang saus tiram, cah tauge, saus sambal', 'dinner', '2023-12-06', 2, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(19, 'Nasi Merah, ayam suwir kemangi, tempe bacem, sayur lodeh, sambal', 'dinner', '2023-12-07', 2, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(20, 'Nasi Merah, ikan kakap fillet/ayam fillet, makaroni keju, tumis buncis wortel jagung telur, saus sambal, snack', 'dinner', '2023-12-08', 2, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(21, 'Nasi Merah, Gulai udang/ayam, rendang tempe, tumis kol kacang panjang, sambal hijau', 'lunch', '2023-12-04', 3, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(22, 'Nasi Merah, Ayam Kari Crispy, Tahu Balado, Lalapan, sambal', 'lunch', '2023-12-05', 3, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(23, 'Nasi Merah, scitch beef eff, kentang saus tiram, Cah pakcoy wortel, saus sambal', 'lunch', '2023-12-06', 3, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(24, 'Nasi Merah, Telor gochujang, Gimmari, cah sawi Putih, saus sambal', 'lunch', '2023-12-07', 3, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(25, 'Nasi Merah, Sate ayam maranggi, sup sayur sosis, sambal kecap, snack', 'lunch', '2023-12-08', 3, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(26, 'Nasi Merah, Semur telur, perkedel tahu, cah labusiam', 'dinner', '2023-12-04', 3, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(27, 'Nasi Merah, soto bandung daging sapi, bola-bola sayur, sambal', 'dinner', '2023-12-05', 3, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(28, 'Nasi Merah, Kuwotie ayam, kentang saus tiram, cah tauge, saus sambal', 'dinner', '2023-12-06', 3, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(29, 'Nasi Merah, ayam suwir kemangi, tempe bacem, sayur lodeh, sambal', 'dinner', '2023-12-07', 3, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(30, 'Nasi Merah, ikan kakap fillet/ayam fillet, makaroni keju, tumis buncis wortel jagung telur, saus sambal, snack', 'dinner', '2023-12-08', 3, 'menu/menu-default.jpg', '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_23_004220_create_member_table', 1),
(6, '2023_08_24_221051_create_paket_table', 1),
(7, '2023_08_24_221103_create_menu_table', 1),
(8, '2023_08_24_221807_create_pemesanan_table', 1),
(9, '2023_08_24_221819_create_item_table', 1),
(10, '2023_11_11_154502_create_testimoni_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_paket` varchar(255) DEFAULT NULL,
  `harga` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id`, `nama_paket`, `harga`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'nasi putih', 21000.00, '2023-11-12 09:10:12', '2023-11-16 10:26:06', NULL),
(2, 'nasi merah', 23000.00, '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL),
(3, 'Diet', 28000.00, '2023-11-12 09:10:12', '2023-11-12 09:10:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` bigint(20) UNSIGNED DEFAULT NULL,
  `diskon` decimal(8,2) DEFAULT NULL,
  `total_harga` double(8,2) DEFAULT NULL,
  `harga_diskon` double(8,2) DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `status` enum('menunggu konfirmasi','proses','selesai','batal') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `member_id`, `diskon`, `total_harga`, `harga_diskon`, `bukti_bayar`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 0.00, 65000.00, 65000.00, NULL, 'proses', '2023-11-16 13:12:28', '2023-11-17 04:07:22', NULL),
(2, 1, 0.00, 95000.00, 95000.00, 'bukti-bayar/oflWXdBsi0gEY5qzO09kOtcVotBytflRgt8QndYg.png', 'selesai', '2023-11-16 14:37:16', '2023-11-16 14:37:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `member_id` bigint(20) UNSIGNED DEFAULT NULL,
  `testimoni` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimoni`
--

INSERT INTO `testimoni` (`id`, `item_id`, `member_id`, `testimoni`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'asdasd', '2023-11-16 16:57:53', '2023-11-16 16:57:53'),
(2, 4, 1, 'tes dulu', '2023-11-16 19:35:51', '2023-11-16 19:35:51'),
(3, 6, 1, 'cobain', '2023-11-16 19:43:44', '2023-11-16 19:43:44'),
(4, 7, 1, 'terakhir', '2023-11-16 20:09:50', '2023-11-16 20:09:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` enum('admin','member') DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `role`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'administrator', 'administrator@admin.com', NULL, '$2y$10$VOnSzjuAnKAV7H9tDZ/Ds.o.JqcEnhN7FezOYu59jEV4Cv1XyZ2wy', 'foto-profil/user-1.png', 'admin', NULL, '2023-11-12 09:10:12', '2023-11-16 08:58:35', NULL),
(2, 'member', 'member@member.com', NULL, '$2y$10$Wj53mxQ1xtGbH3X2pC0B2Ojhs1O5d.E.9y3VJAVwv00DgDz3EzCkC', 'foto-profil/WLrp7fEKRS7QecuEkXkeADgiN9KSdtshmHL1FtHa.png', 'member', NULL, '2023-11-12 09:10:12', '2023-11-16 09:00:17', NULL),
(3, 'viona', 'viona@member.com', NULL, '$2y$10$wWZD65blhSWk4VzFbKzulu0FSWyOSZ/1QdEHWPsNskKMY87FveQyO', 'foto-profil/I9b0vkcnTdG6IzRfkghjYCayj9Wxq97m3TRebTHO.png', 'member', NULL, '2023-11-12 09:10:12', '2023-11-16 09:22:38', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_pemesanan_id_foreign` (`pemesanan_id`),
  ADD KEY `item_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_user_id_foreign` (`user_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_paket_id_foreign` (`paket_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemesanan_member_id_foreign` (`member_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testimoni_item_id_foreign` (`item_id`),
  ADD KEY `testimoni_member_id_foreign` (`member_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `item_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD CONSTRAINT `testimoni_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `testimoni_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
