-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jun 2024 pada 05.38
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inspektorat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `abouts`
--

INSERT INTO `abouts` (`id`, `name`, `link`, `image`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Tentang Kami', '/pages/tentang-kami', 'uploads/wgxSGwpOYn5jlRY25APZWcSXSK4gL6jY2eCgIYnv.png', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(105,112,122);\">Inspektorat merupakan unsur pelaksana urusan pemerintahan dalam membina dan mengawasi pelaksanaan urusan pemerintahan yang menjadi kewenangan daerah dan tugas pembantuan oleh Perangkat Daerah.</span></p><p><br><br><br>&nbsp;</p>', NULL, '2022-09-13 22:39:28', '2022-12-28 03:06:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `call_to_actions`
--

CREATE TABLE `call_to_actions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `call_to_actions`
--

INSERT INTO `call_to_actions` (`id`, `name`, `image`, `description`, `link`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Hubungi Kami', 'uploads/8gcFKMhABQLaxAXkq1jFRZOi4MSlm24UmGqVlAUN.webp', '<div>Dengan Petugas yang Sigap dan Professional, kami sangat siap untuk melayani dengan hati yang tulus untuk semua masyarakat Jember.</div>', '/contact', NULL, '2022-09-13 22:39:28', '2022-12-05 14:29:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `program_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `program_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Berita Kejadian Bencana Jember', 'berita-kejadian-bencana-jember', 0, '2022-12-29 02:32:08', '2022-09-14 10:17:50', '2022-12-29 02:32:08'),
(2, 'Berita Aktifitas BPBD', 'berita-aktifitas-bpbd', 0, '2022-12-29 02:32:03', '2022-09-14 10:18:05', '2022-12-29 02:32:03'),
(3, 'Test1', 'test1', 0, '2022-09-25 01:48:05', '2022-09-24 23:03:38', '2022-09-25 01:48:05'),
(4, 'Ali', 'ali', 0, '2022-11-29 19:46:30', '2022-09-24 23:03:45', '2022-11-29 19:46:30'),
(5, 'Test3', 'test3', 0, '2022-11-29 19:48:02', '2022-09-24 23:03:50', '2022-11-29 19:48:02'),
(6, 'Test4', 'test4', 0, '2022-11-29 19:47:44', '2022-09-24 23:03:58', '2022-11-29 19:47:44'),
(7, 'Test5', 'test5', 0, '2022-11-29 19:46:46', '2022-09-24 23:04:04', '2022-11-29 19:46:46'),
(8, 'Test6', 'test6', 0, '2022-11-29 19:46:38', '2022-09-24 23:04:10', '2022-11-29 19:46:38'),
(9, 'Test7', 'test7', 0, '2022-11-29 19:32:41', '2022-09-24 23:04:16', '2022-11-29 19:32:41'),
(10, 'Test8', 'test8', 0, '2022-11-29 19:32:33', '2022-09-24 23:04:25', '2022-11-29 19:32:33'),
(11, 'Test9', 'test9', 0, '2022-11-29 19:32:27', '2022-09-24 23:04:34', '2022-11-29 19:32:27'),
(12, 'Slider', 'slider', 0, '2022-11-29 19:43:06', '2022-11-29 19:42:58', '2022-11-29 19:43:06'),
(13, 'Monev', 'monev', 2, NULL, '2022-12-14 04:49:33', '2022-12-14 23:41:03'),
(14, 'Sosialisasi', 'sosialisasi', 2, NULL, '2022-12-14 04:49:50', '2022-12-14 23:44:25'),
(15, 'Bimtek', 'bimtek', 2, NULL, '2022-12-14 04:50:09', '2022-12-19 03:55:37'),
(16, 'asdasd', 'asdasd', 3, '2022-12-15 00:16:07', '2022-12-14 23:44:00', '2022-12-15 00:16:07'),
(19, 'Mou dengan APH', 'mou-dengan-aph', 9, '2022-12-19 04:01:09', '2022-12-16 00:43:01', '2022-12-19 04:01:09'),
(20, 'Sk Saber Pungli', 'sk-saber-pungli', 9, '2022-12-19 04:02:39', '2022-12-16 00:43:31', '2022-12-19 04:02:39'),
(21, 'Kegiatan Saber Pungli', 'kegiatan-saber-pungli', 9, NULL, '2022-12-16 00:44:19', '2022-12-19 04:02:13'),
(22, 'Regulasi Umum', 'regulasi-umum', 6, '2022-12-19 04:03:57', '2022-12-16 00:46:29', '2022-12-19 04:03:57'),
(23, 'Sk Tim', 'sk-tim', 6, '2022-12-19 04:03:43', '2022-12-16 00:46:57', '2022-12-19 04:03:43'),
(24, 'Kegiatan Zona Integritas', 'kegiatan-zona-integritas', 6, NULL, '2022-12-16 00:47:30', '2022-12-19 04:03:34'),
(25, 'Progres Mcp Kab. Jember', 'progres-mcp-kab-jember', 10, NULL, '2022-12-16 00:51:38', '2022-12-16 00:51:38'),
(26, 'PSU', 'psu', 10, NULL, '2022-12-16 00:52:27', '2022-12-19 04:11:20'),
(27, 'Struktur Organisasi Saber Pungli', 'struktur-organisasi-saber-pungli', 9, NULL, '2022-12-19 02:51:22', '2022-12-19 02:55:19'),
(28, 'Struktur Organisasi Zona Integritas', 'struktur-organisasi-zona-integritas', 6, NULL, '2022-12-19 02:55:35', '2022-12-19 02:55:35'),
(29, 'Reguler', 'reguler', 2, NULL, '2022-12-19 03:56:57', '2022-12-19 03:56:57'),
(30, 'Pengawasan Desa', 'pengawasan-desa', 2, NULL, '2022-12-19 03:57:20', '2022-12-19 03:57:41'),
(31, 'Informasi Gratifikasi', 'informasi-gratifikasi', 11, NULL, '2022-12-19 04:22:48', '2022-12-19 04:22:48'),
(32, 'Pengumuman', 'pengumuman', NULL, NULL, '2022-12-19 17:59:42', '2022-12-19 17:59:42'),
(33, 'FOTO KEGIATAN', 'foto-kegiatan', 2, '2022-12-28 03:34:25', '2022-12-28 03:34:02', '2022-12-28 03:34:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categoriperaturans`
--

CREATE TABLE `categoriperaturans` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categoriperaturans`
--

INSERT INTO `categoriperaturans` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Peraturan Pemerintah', '2022-12-15 19:07:50', '2022-12-15 19:16:32'),
(3, 'Peraturan Menteri', '2022-12-16 07:14:30', '2022-12-16 07:14:45'),
(4, 'Peraturan Daerah', '2022-12-16 07:15:02', '2022-12-16 07:15:02'),
(5, 'Peraturan Bupati', '2022-12-16 07:15:26', '2022-12-16 07:15:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categorystatuses`
--

CREATE TABLE `categorystatuses` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `categorystatuses`
--

INSERT INTO `categorystatuses` (`id`, `name`, `created_at`, `deleted_at`, `updated_at`) VALUES
(2, 'Menunggu', '2022-10-25 03:06:32', NULL, '2022-10-28 06:15:38'),
(3, 'Proses', '2022-10-25 03:06:42', NULL, '2022-11-03 02:14:38'),
(5, 'Selesai', '2022-10-25 03:07:14', NULL, '2022-12-19 00:39:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `reply_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `comment` text NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `reply_id`, `name`, `email`, `comment`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'Test', 'coba@email.com', 'Test', '2022-12-29 02:29:56', '2022-09-17 01:39:52', '2022-12-29 02:29:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `desas`
--

CREATE TABLE `desas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `kecamatan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `desas`
--

INSERT INTO `desas` (`id`, `name`, `kecamatan_id`, `created_at`, `updated_at`) VALUES
(1, 'Ajung', 1, '2022-08-26 13:49:48', '2022-08-26 13:49:48'),
(2, 'Klompangan', 1, '2022-08-26 13:50:01', '2022-08-26 13:50:01'),
(3, 'Mangaran', 1, '2022-08-26 13:50:09', '2022-08-26 13:50:09'),
(4, 'Pancakarya', 1, '2022-08-26 13:50:23', '2022-08-26 13:50:23'),
(5, 'Rowoindah', 1, '2022-08-26 13:50:33', '2022-08-26 13:50:33'),
(6, 'Sukamakmur', 1, '2022-08-26 13:50:43', '2022-08-26 13:50:43'),
(7, 'Wirowongso', 1, '2022-08-26 13:50:51', '2022-08-26 13:50:51'),
(8, 'Ambulu', 2, '2022-08-26 13:51:03', '2022-08-26 13:51:03'),
(9, 'Andongsari', 2, '2022-08-26 13:51:14', '2022-08-26 13:51:14'),
(10, 'Karang Anyar', 2, '2022-08-26 13:51:22', '2022-08-26 13:51:22'),
(11, 'Pontang', 2, '2022-08-26 13:51:34', '2022-08-26 13:51:34'),
(12, 'Sabrang', 2, '2022-08-26 13:51:42', '2022-08-26 13:51:42'),
(13, 'Sumberejo', 2, '2022-08-26 13:51:53', '2022-08-26 13:51:53'),
(14, 'Tegalsari', 2, '2022-08-26 13:52:03', '2022-08-26 13:52:03'),
(15, 'Arjasa', 3, '2022-08-26 13:52:18', '2022-08-26 13:52:18'),
(16, 'Biting', 3, '2022-08-26 13:52:32', '2022-08-26 13:52:32'),
(17, 'Candijati', 3, '2022-08-26 13:52:39', '2022-08-26 13:52:39'),
(18, 'Darsono', 3, '2022-08-26 13:52:49', '2022-08-26 13:52:49'),
(19, 'Kamal', 3, '2022-08-26 13:52:57', '2022-08-26 13:52:57'),
(20, 'Kemuning Lor', 3, '2022-08-26 13:53:08', '2022-08-26 13:53:08'),
(21, 'Badean', 4, '2022-08-26 13:53:43', '2022-08-26 13:53:43'),
(22, 'Bangsalsari', 4, '2022-08-26 13:53:55', '2022-08-26 13:53:55'),
(23, 'Banjarsari', 4, '2022-08-26 13:54:06', '2022-08-26 13:54:06'),
(24, 'Curahkalong', 4, '2022-08-26 13:54:18', '2022-08-26 13:54:18'),
(25, 'Gambirono', 4, '2022-08-26 13:54:26', '2022-08-26 13:54:26'),
(26, 'Karangsono', 4, '2022-08-26 13:54:41', '2022-08-26 13:54:41'),
(27, 'Langkap', 4, '2022-08-26 13:54:49', '2022-08-26 13:54:49'),
(28, 'Petung', 4, '2022-08-26 13:54:58', '2022-08-26 13:54:58'),
(29, 'Sukorejo', 4, '2022-08-26 13:55:05', '2022-08-26 13:55:05'),
(30, 'Tisnogambar', 4, '2022-08-26 13:55:19', '2022-08-26 13:55:19'),
(31, 'Tugusari', 4, '2022-08-26 13:55:31', '2022-08-26 13:55:31'),
(32, 'Balung Kidul', 5, '2022-08-26 13:55:47', '2022-08-26 13:55:47'),
(33, 'Balung Kulon', 5, '2022-08-26 13:55:55', '2022-08-26 13:56:07'),
(34, 'Balung Lor', 5, '2022-08-26 13:56:14', '2022-08-26 13:56:14'),
(35, 'Curahlele', 5, '2022-08-26 13:56:33', '2022-08-26 13:56:33'),
(36, 'Gumelar', 5, '2022-08-26 13:56:45', '2022-08-26 13:56:45'),
(37, 'Karangduren', 5, '2022-08-26 13:56:57', '2022-08-26 13:56:57'),
(38, 'Karang Semanding', 5, '2022-08-26 13:57:09', '2022-08-26 13:57:09'),
(39, 'Tutul', 5, '2022-08-26 13:57:16', '2022-08-26 13:57:16'),
(40, 'Bangorejo', 6, '2022-08-26 13:57:34', '2022-08-26 13:57:34'),
(41, 'Gumukmas', 6, '2022-08-26 13:57:44', '2022-08-26 13:57:44'),
(42, 'Karangrejo', 6, '2022-08-26 13:57:51', '2022-08-26 13:57:51'),
(43, 'Kepanjen', 6, '2022-08-26 13:57:58', '2022-08-26 13:57:58'),
(44, 'Mayangan', 6, '2022-08-26 13:58:05', '2022-08-26 13:58:05'),
(45, 'Menampu', 6, '2022-08-26 13:58:11', '2022-08-26 13:58:11'),
(46, 'Purwoasri', 6, '2022-08-26 13:58:23', '2022-08-26 13:58:23'),
(47, 'Tembokrejo', 6, '2022-08-26 13:58:39', '2022-08-26 13:58:39'),
(48, 'Jelbuk', 7, '2022-08-26 13:58:50', '2022-08-26 13:58:50'),
(49, 'Panduman', 7, '2022-08-26 13:58:57', '2022-08-26 13:58:57'),
(50, 'Sucopangepok', 7, '2022-08-26 13:59:10', '2022-08-26 13:59:10'),
(51, 'Sugerkidul', 7, '2022-08-26 13:59:22', '2022-08-26 13:59:22'),
(52, 'Sukojember', 7, '2022-08-26 13:59:32', '2022-08-26 13:59:32'),
(53, 'Sukowiryo', 7, '2022-08-26 13:59:44', '2022-08-26 13:59:44'),
(54, 'Cangkring', 8, '2022-08-26 13:59:55', '2022-08-26 13:59:55'),
(55, 'Jatimulyo', 8, '2022-08-26 14:00:06', '2022-08-26 14:00:06'),
(56, 'Jatisari', 8, '2022-08-26 14:00:14', '2022-08-26 14:00:14'),
(57, 'Jenggawah', 8, '2022-08-26 14:00:22', '2022-08-26 14:00:22'),
(58, 'Kemuningsari Kidul', 8, '2022-08-26 14:00:36', '2022-08-26 14:00:36'),
(59, 'Kertonegoro', 8, '2022-08-26 14:00:46', '2022-08-26 14:00:46'),
(60, 'Sruni', 8, '2022-08-26 14:00:53', '2022-08-26 14:00:53'),
(61, 'Wonojati', 8, '2022-08-26 14:01:01', '2022-08-26 14:01:01'),
(62, 'Jombang', 9, '2022-08-26 14:01:16', '2022-08-26 14:01:16'),
(63, 'Keting', 9, '2022-08-26 14:01:23', '2022-08-26 14:01:23'),
(64, 'Ngampelrejo', 9, '2022-08-26 14:01:33', '2022-08-26 14:01:33'),
(65, 'Padomasan', 9, '2022-08-26 14:01:44', '2022-08-26 14:01:44'),
(66, 'Sarimulyo', 9, '2022-08-26 14:01:53', '2022-08-26 14:01:53'),
(67, 'Wringinagung', 9, '2022-08-26 14:02:10', '2022-08-26 14:02:10'),
(69, 'Ajung', 10, '2022-08-26 14:03:44', '2022-08-26 14:03:44'),
(70, 'Gambiran', 10, '2022-08-26 14:04:24', '2022-08-26 14:04:24'),
(71, 'Glagahwero', 10, '2022-08-26 14:04:35', '2022-08-26 14:04:35'),
(72, 'Gumuksari', 10, '2022-08-26 14:04:47', '2022-08-26 14:04:47'),
(73, 'Kalisat', 10, '2022-08-26 14:04:53', '2022-08-26 14:04:53'),
(74, 'Patempuran', 10, '2022-08-26 14:05:02', '2022-08-26 14:05:02'),
(75, 'Plalangan', 10, '2022-08-26 14:05:10', '2022-08-26 14:05:10'),
(76, 'Sebanen', 10, '2022-08-26 14:05:17', '2022-08-26 14:05:17'),
(77, 'Sukoreno', 10, '2022-08-26 14:05:25', '2022-08-26 14:05:25'),
(78, 'Sumberjeruk', 10, '2022-08-26 14:05:32', '2022-08-26 14:05:32'),
(79, 'Sumberkalong', 10, '2022-08-26 14:05:40', '2022-08-26 14:05:40'),
(80, 'Sumberketempa', 10, '2022-08-26 14:05:49', '2022-08-26 14:05:49'),
(81, 'Jember Kidul', 11, '2022-08-26 14:06:05', '2022-08-26 14:06:05'),
(82, 'Kaliwates', 11, '2022-08-26 14:06:16', '2022-08-26 14:06:16'),
(83, 'Kebon Agung', 11, '2022-08-26 14:06:28', '2022-08-26 14:06:28'),
(84, 'Kepatihan', 11, '2022-08-26 14:06:36', '2022-08-26 14:06:36'),
(85, 'Mangli', 11, '2022-08-26 14:06:44', '2022-08-26 14:06:44'),
(86, 'Sempusari', 11, '2022-08-26 14:06:58', '2022-08-26 14:06:58'),
(87, 'Tegal Besar', 11, '2022-08-26 14:07:07', '2022-08-26 14:07:07'),
(88, 'Cakru', 12, '2022-08-26 14:07:17', '2022-08-26 14:07:17'),
(89, 'Kencong', 12, '2022-08-26 14:07:24', '2022-08-26 14:07:24'),
(90, 'Kratorn', 12, '2022-08-26 14:07:30', '2022-08-26 14:07:30'),
(91, 'Paseban', 12, '2022-08-26 14:07:37', '2022-08-26 14:07:37'),
(92, 'Wonorejo', 12, '2022-08-26 14:07:45', '2022-08-26 14:07:45'),
(93, 'Karangpaiton', 13, '2022-08-26 14:09:12', '2022-08-26 14:09:12'),
(94, 'Ledokombo', 13, '2022-08-26 14:09:21', '2022-08-26 14:09:21'),
(95, 'Lumbengan', 13, '2022-08-26 14:09:35', '2022-08-26 14:09:35'),
(96, 'Slateng', 13, '2022-08-26 14:09:50', '2022-08-26 14:09:50'),
(97, 'Sukogidri', 13, '2022-08-26 14:10:11', '2022-08-26 14:10:11'),
(98, 'Sumberanget', 13, '2022-08-26 14:10:19', '2022-08-26 14:10:19'),
(99, 'Sumberbulus', 13, '2022-08-26 14:10:26', '2022-08-26 14:10:32'),
(100, 'Sumberlesung', 13, '2022-08-26 14:10:42', '2022-08-26 14:10:42'),
(101, 'Sumbersalak', 13, '2022-08-26 14:10:56', '2022-08-26 14:10:56'),
(102, 'Suren', 13, '2022-08-26 14:11:03', '2022-08-26 14:11:03'),
(103, 'Mayang', 14, '2022-08-26 14:11:13', '2022-08-26 14:11:13'),
(104, 'Mrawan', 14, '2022-08-26 14:11:21', '2022-08-26 14:11:21'),
(105, 'Seputih', 14, '2022-08-26 14:11:33', '2022-08-26 14:11:33'),
(106, 'Sidomukti', 14, '2022-08-26 14:11:42', '2022-08-26 14:11:42'),
(107, 'Sumberkajayan', 14, '2022-08-26 14:11:52', '2022-08-26 14:11:52'),
(108, 'Tegalwaru', 14, '2022-08-26 14:12:00', '2022-08-26 14:12:00'),
(109, 'Tegalrejo', 14, '2022-08-26 14:12:12', '2022-08-26 14:12:12'),
(110, 'Karang Kedawung', 15, '2022-08-26 14:12:32', '2022-08-26 14:12:32'),
(111, 'Kawangrejo', 15, '2022-08-26 14:12:42', '2022-08-26 14:12:42'),
(112, 'Lampeji', 15, '2022-08-26 14:12:55', '2022-08-26 14:12:55'),
(113, 'Lengkong', 15, '2022-08-26 14:13:02', '2022-08-26 14:13:02'),
(114, 'Mumbulsari', 15, '2022-08-26 14:13:10', '2022-08-26 14:13:10'),
(115, 'Suco', 15, '2022-08-26 14:13:17', '2022-08-26 14:13:17'),
(116, 'Tamansari', 15, '2022-08-26 14:13:27', '2022-08-26 14:13:27'),
(117, 'Glagahwero', 16, '2022-08-26 14:13:44', '2022-08-26 14:13:58'),
(118, 'Kemiri', 16, '2022-08-26 14:14:05', '2022-08-26 14:14:05'),
(119, 'Kemuningsari Lor', 16, '2022-08-26 14:14:15', '2022-08-26 14:14:15'),
(120, 'Pakis', 16, '2022-08-26 14:14:26', '2022-08-26 14:14:26'),
(121, 'Panti', 16, '2022-08-26 14:14:33', '2022-08-26 14:14:33'),
(122, 'Serut', 16, '2022-08-26 14:14:41', '2022-08-26 14:14:41'),
(123, 'Suci', 16, '2022-08-26 14:14:48', '2022-08-26 14:14:48'),
(124, 'Bedadung', 17, '2022-08-26 14:15:00', '2022-08-26 14:15:00'),
(125, 'Jatian', 17, '2022-08-26 14:15:10', '2022-08-26 14:15:10'),
(126, 'Kertosari', 17, '2022-08-26 14:15:24', '2022-08-26 14:15:24'),
(127, 'Pakusari', 17, '2022-08-26 14:15:33', '2022-08-26 14:15:33'),
(128, 'Patemon', 17, '2022-08-26 14:15:40', '2022-08-26 14:15:40'),
(129, 'Subo', 17, '2022-08-26 14:15:50', '2022-08-26 14:15:50'),
(130, 'Sumberpinang', 17, '2022-08-26 14:15:59', '2022-08-26 14:15:59'),
(131, 'Banjarsengon', 18, '2022-08-26 14:16:17', '2022-08-26 14:16:17'),
(132, 'Baratan', 18, '2022-08-26 14:16:25', '2022-08-26 14:16:25'),
(133, 'Bintoro', 18, '2022-08-26 14:16:32', '2022-08-26 14:16:32'),
(134, 'Gebang', 18, '2022-08-26 14:16:41', '2022-08-26 14:16:41'),
(135, 'Jemberlor', 18, '2022-08-26 14:16:54', '2022-08-26 14:16:54'),
(136, 'Jumerto', 18, '2022-08-26 14:17:04', '2022-08-26 14:17:04'),
(137, 'Patrang', 18, '2022-08-26 14:17:13', '2022-08-26 14:17:13'),
(138, 'Slawu', 18, '2022-08-26 14:17:20', '2022-08-26 14:17:20'),
(139, 'Bagon', 19, '2022-08-26 14:17:28', '2022-08-26 14:17:28'),
(140, 'Grenden', 19, '2022-08-26 14:17:37', '2022-08-26 14:17:37'),
(141, 'Jambearum', 19, '2022-08-26 14:17:44', '2022-08-26 14:17:44'),
(142, 'Kasiyan', 19, '2022-08-26 14:17:55', '2022-08-26 14:17:55'),
(143, 'Kasiyan Timur', 19, '2022-08-26 14:18:05', '2022-08-26 14:18:05'),
(144, 'Mlokorejo', 19, '2022-08-26 14:18:21', '2022-08-26 14:18:21'),
(145, 'Mojomulyo', 19, '2022-08-26 14:18:29', '2022-08-26 14:18:29'),
(146, 'Mojosari', 19, '2022-08-26 14:18:42', '2022-08-26 14:18:42'),
(147, 'Puger Kulon', 19, '2022-08-26 14:18:51', '2022-08-26 14:18:51'),
(148, 'Puger Wetan', 19, '2022-08-26 14:18:59', '2022-08-26 14:18:59'),
(149, 'Wonosari', 19, '2022-08-26 14:19:08', '2022-08-26 14:19:08'),
(150, 'Wringintelu', 19, '2022-08-26 14:19:24', '2022-08-26 14:19:24'),
(151, 'Curahmalang', 20, '2022-08-26 14:19:38', '2022-08-26 14:19:38'),
(152, 'Gugut', 20, '2022-08-26 14:19:45', '2022-08-26 14:19:45'),
(153, 'Kaliwining', 20, '2022-08-26 14:19:54', '2022-08-26 14:19:54'),
(154, 'Nogosari', 20, '2022-08-26 14:20:01', '2022-08-26 14:20:01'),
(155, 'Pecoro', 20, '2022-08-26 14:20:08', '2022-08-26 14:20:08'),
(156, 'Rambigundam', 20, '2022-08-26 14:20:18', '2022-08-26 14:20:18'),
(157, 'Rambipuji', 20, '2022-08-26 14:20:25', '2022-08-26 14:20:25'),
(158, 'Rowotamtu', 20, '2022-08-26 14:20:32', '2022-08-26 14:20:32'),
(159, 'Pondokdalem', 21, '2022-08-26 14:20:46', '2022-08-26 14:20:46'),
(160, 'Pondokjoyo', 21, '2022-08-26 14:20:56', '2022-08-26 14:20:56'),
(161, 'Rejoagung', 21, '2022-08-26 14:21:04', '2022-08-26 14:21:04'),
(162, 'Semboro', 21, '2022-08-26 14:21:12', '2022-08-26 14:21:12'),
(163, 'Sidomekar', 21, '2022-08-26 14:21:19', '2022-08-26 14:21:19'),
(164, 'Sidomulyo', 21, '2022-08-26 14:21:27', '2022-08-26 14:21:27'),
(165, 'Garahan', 22, '2022-08-26 14:21:39', '2022-08-26 14:21:39'),
(166, 'Harjomulyo', 22, '2022-08-26 14:21:48', '2022-08-26 14:21:48'),
(167, 'Karangharjo', 22, '2022-08-26 14:22:00', '2022-08-26 14:22:00'),
(168, 'Mulyorejo', 22, '2022-08-26 14:22:12', '2022-08-26 14:22:12'),
(169, 'Pace', 22, '2022-08-26 14:22:18', '2022-08-26 14:22:18'),
(170, 'Sempolan', 22, '2022-08-26 14:22:30', '2022-08-26 14:22:30'),
(171, 'Sidomulyo', 22, '2022-08-26 14:22:38', '2022-08-26 14:22:38'),
(172, 'Silo', 22, '2022-08-26 14:22:45', '2022-08-26 14:22:45'),
(173, 'Sumberjati', 22, '2022-08-26 14:22:53', '2022-08-26 14:22:53'),
(174, 'Dukuhmencek', 23, '2022-08-26 14:23:41', '2022-08-26 14:23:41'),
(175, 'Jubung', 23, '2022-08-26 14:23:49', '2022-08-26 14:23:49'),
(176, 'Karangpring', 23, '2022-08-26 14:24:01', '2022-08-26 14:24:01'),
(177, 'Klungkung', 23, '2022-08-26 14:24:09', '2022-08-26 14:24:09'),
(178, 'Sukorambi', 23, '2022-08-26 14:24:17', '2022-08-26 14:24:17'),
(179, 'Arjasa', 24, '2022-08-26 14:24:38', '2022-08-26 14:24:38'),
(180, 'Balet Baru', 24, '2022-08-26 14:24:47', '2022-08-26 14:24:54'),
(181, 'Dawuhanmangli', 24, '2022-08-26 14:25:11', '2022-08-26 14:25:11'),
(182, 'Mojogemi', 24, '2022-08-26 14:25:19', '2022-08-26 14:25:19'),
(183, 'Pocangan', 24, '2022-08-26 14:25:32', '2022-08-26 14:25:32'),
(184, 'Sukokerto', 24, '2022-08-26 14:25:41', '2022-08-26 14:25:41'),
(185, 'Sukorejo', 24, '2022-08-26 14:25:48', '2022-08-26 14:25:48'),
(186, 'Sukosari', 24, '2022-08-26 14:25:58', '2022-08-26 14:25:58'),
(187, 'Sukowono', 24, '2022-08-26 14:26:08', '2022-08-26 14:26:08'),
(188, 'Sumberwringin', 24, '2022-08-26 14:26:21', '2022-08-26 14:26:21'),
(189, 'Sumberdanti', 24, '2022-08-26 14:26:31', '2022-08-26 14:26:31'),
(190, 'Sumberwaru', 24, '2022-08-26 14:26:43', '2022-08-26 14:26:43'),
(191, 'Gelang', 25, '2022-08-26 14:27:04', '2022-08-26 14:27:04'),
(192, 'Jambesari', 25, '2022-08-26 14:27:13', '2022-08-26 14:27:13'),
(193, 'Jamintoro', 25, '2022-08-26 14:27:23', '2022-08-26 14:27:23'),
(194, 'Jatiroto', 25, '2022-08-26 14:27:32', '2022-08-26 14:27:32'),
(195, 'Kaliglagah', 25, '2022-08-26 14:27:40', '2022-08-26 14:27:40'),
(196, 'Karangbayat', 25, '2022-08-26 14:27:48', '2022-08-26 14:27:54'),
(197, 'Pringgowirawan', 25, '2022-08-26 14:28:20', '2022-08-26 14:28:20'),
(198, 'Rowotengah', 25, '2022-08-26 14:39:53', '2022-08-26 14:39:53'),
(199, 'Sumberagung', 25, '2022-08-26 14:40:11', '2022-08-26 14:40:11'),
(200, 'Yosorati', 25, '2022-08-26 14:40:23', '2022-08-26 14:40:23'),
(201, 'Cumedak', 26, '2022-08-26 14:40:49', '2022-08-26 14:40:49'),
(202, 'Gunungmalang', 26, '2022-08-26 14:41:04', '2022-08-26 14:41:04'),
(203, 'Jembearum', 26, '2022-08-26 14:41:15', '2022-08-26 14:41:15'),
(204, 'Plerean', 26, '2022-08-26 14:41:29', '2022-08-26 14:41:29'),
(205, 'Pringgondadi', 26, '2022-08-26 14:41:54', '2022-08-26 14:41:54'),
(206, 'Randuagung', 26, '2022-08-26 14:42:05', '2022-08-26 14:42:05'),
(207, 'Rowosari', 26, '2022-08-26 14:42:20', '2022-08-26 14:42:20'),
(208, 'Sumberjambe', 26, '2022-08-26 14:42:32', '2022-08-26 14:42:32'),
(209, 'Sumberpakem', 26, '2022-08-26 14:42:42', '2022-08-26 14:42:42'),
(210, 'Antirogo', 27, '2022-08-26 14:43:05', '2022-08-26 14:43:05'),
(211, 'Karangrejo', 27, '2022-08-26 14:43:14', '2022-08-26 14:43:14'),
(212, 'Kebonsari', 27, '2022-08-26 14:43:21', '2022-08-26 14:43:21'),
(213, 'Kranjingan', 27, '2022-08-26 14:43:33', '2022-08-26 14:43:33'),
(214, 'Sumbersari', 27, '2022-08-26 14:43:44', '2022-08-26 14:43:44'),
(215, 'Tegalgede', 27, '2022-08-26 14:43:52', '2022-08-26 14:43:52'),
(216, 'Wirolegi', 27, '2022-08-26 14:43:59', '2022-08-26 14:43:59'),
(217, 'Darungan', 28, '2022-08-26 14:44:11', '2022-08-26 14:44:11'),
(218, 'Klatakan', 28, '2022-08-26 14:44:19', '2022-08-26 14:44:19'),
(219, 'Kramat Sukoharjo', 28, '2022-08-26 14:44:29', '2022-08-26 14:44:29'),
(220, 'Manggisan', 28, '2022-08-26 14:44:41', '2022-08-26 14:44:41'),
(221, 'Patemon', 28, '2022-08-26 14:44:48', '2022-08-26 14:44:48'),
(222, 'Selodakon', 28, '2022-08-26 14:44:58', '2022-08-26 14:44:58'),
(223, 'Tanggul Kulon', 28, '2022-08-26 14:45:07', '2022-08-26 14:45:07'),
(224, 'Tanggul Wetan', 28, '2022-08-26 14:45:17', '2022-08-26 14:45:17'),
(225, 'Andongrejo', 29, '2022-08-26 14:45:29', '2022-08-26 14:45:29'),
(226, 'Curahnongko', 29, '2022-08-26 14:45:37', '2022-08-26 14:45:37'),
(227, 'Curahtakir', 29, '2022-08-26 14:45:45', '2022-08-26 14:45:45'),
(228, 'Pondokrejo', 29, '2022-08-26 14:45:52', '2022-08-26 14:45:52'),
(229, 'Sidodadi', 29, '2022-08-26 14:45:58', '2022-08-26 14:45:58'),
(230, 'Sanenrejo', 29, '2022-08-26 14:46:08', '2022-08-26 14:46:08'),
(231, 'Tempurejo', 29, '2022-08-26 14:46:21', '2022-08-26 14:46:21'),
(232, 'Wonoasri', 29, '2022-08-26 14:46:28', '2022-08-26 14:46:28'),
(233, 'Gadingrejo', 30, '2022-08-26 14:46:37', '2022-08-26 14:46:37'),
(234, 'Gunungsari', 30, '2022-08-26 14:46:45', '2022-08-26 14:46:45'),
(235, 'Mundurejo', 30, '2022-08-26 14:46:52', '2022-08-26 14:46:52'),
(236, 'Paleran', 30, '2022-08-26 14:46:59', '2022-08-26 14:46:59'),
(237, 'Sidorejo', 30, '2022-08-26 14:47:08', '2022-08-26 14:47:08'),
(238, 'Sukoreno', 30, '2022-08-26 14:47:16', '2022-08-26 14:47:16'),
(239, 'Tanjungsari', 30, '2022-08-26 14:47:29', '2022-08-26 14:47:29'),
(240, 'Tegalwangi', 30, '2022-08-26 14:47:37', '2022-08-26 14:47:37'),
(241, 'Umbulrejo', 30, '2022-08-26 14:47:46', '2022-08-26 14:47:46'),
(242, 'Umbulsari', 30, '2022-08-26 14:47:53', '2022-08-26 14:47:53'),
(243, 'Ampel', 31, '2022-08-26 14:48:01', '2022-08-26 14:48:08'),
(244, 'Dukuhdempok', 31, '2022-08-26 14:48:15', '2022-08-26 14:48:15'),
(245, 'Glundengan', 31, '2022-08-26 14:48:25', '2022-08-26 14:48:25'),
(246, 'Kesilir', 31, '2022-08-26 14:48:35', '2022-08-26 14:48:35'),
(247, 'Lojejer', 31, '2022-08-26 14:48:42', '2022-08-26 14:48:42'),
(248, 'Tamansari', 31, '2022-08-26 14:48:49', '2022-08-26 14:48:49'),
(249, 'Tanjungrejo', 31, '2022-08-26 14:49:02', '2022-08-26 14:49:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `gratifikasis`
--

CREATE TABLE `gratifikasis` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `pukul` time DEFAULT NULL,
  `hari` varchar(255) DEFAULT NULL,
  `kecamatan_id` bigint(20) DEFAULT NULL,
  `desa_id` bigint(20) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `kronologi` varchar(255) DEFAULT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `image4` varchar(255) DEFAULT NULL,
  `status_id` bigint(20) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `irbans`
--

CREATE TABLE `irbans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `inspektur` varchar(255) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `irbans`
--

INSERT INTO `irbans` (`id`, `nama`, `keterangan`, `inspektur`, `nip`, `created_at`, `updated_at`) VALUES
(1, 'IRBAN Wilayah I', '1. Bagi Perangkat Daerah yang mengelola anggaran belanja langsungnya > 16 M yaitu : Dinas Pendidikan, Dinas Kesehatan, Dinas Perumahan Rakyat, Kawasan Pemukiman dan Cipta Karya, DPU Binamarga & Sumberdaya Air, maka jumlah hari pemeriksaan reguler ditetapkan 15 (lima belas) hari kerja;\n2. Pemeriksaan Khusus SD dan SMP terkait permasalahan PP 53 tahun 2010 dan PP 10 tahun 1983 dibebankan kepada masing – masing kecamatan di wilayah Inspektur Pembantu;\n3. Pemeriksaan regular dan khusus untuk Desa/Kelurahan, UPT serta Puskesmas  dibebankan kepada masing – masing kecamatan di wilayah Inspektur Pembantu;\n4. Pemeriksaan Perusahaan Daerah/BUMD, Reviu, Monitoring, Evaluasi, Pemeriksaan dengan Tujuan Tertentu (PDTT) dapat dilaksanakan lintas Inspektur Pembantu;', 'RATNO C. SEMBODO, SH', '19740827 200501 1 006', '2022-12-19 21:06:34', '2022-12-19 21:09:55'),
(2, 'IRBAN Wilayah II', '1. Bagi Perangkat Daerah yang mengelola anggaran belanja langsungnya > 16 M yaitu : Dinas Pendidikan, Dinas Kesehatan, Dinas Perumahan Rakyat, Kawasan Pemukiman dan Cipta Karya, DPU Binamarga & Sumberdaya Air, maka jumlah hari pemeriksaan reguler ditetapkan 15 (lima belas) hari kerja;\n2. Pemeriksaan Khusus SD dan SMP terkait permasalahan PP 53 tahun 2010 dan PP 10 tahun 1983 dibebankan kepada masing – masing kecamatan di wilayah Inspektur Pembantu;\n3. Pemeriksaan regular dan khusus untuk Desa/Kelurahan, UPT serta Puskesmas  dibebankan kepada masing – masing kecamatan di wilayah Inspektur Pembantu;\n4. Pemeriksaan Perusahaan Daerah/BUMD, Reviu, Monitoring, Evaluasi, Pemeriksaan dengan Tujuan Tertentu (PDTT) dapat dilaksanakan lintas Inspektur Pembantu;', 'RATNO C. SEMBODO, SH', '19740827 200501 1 006', '2022-12-19 21:10:35', '2022-12-19 21:10:35'),
(3, 'IRBAN Wilayah III', '1. Bagi Perangkat Daerah yang mengelola anggaran belanja langsungnya > 16 M yaitu : Dinas Pendidikan, Dinas Kesehatan, Dinas Perumahan Rakyat, Kawasan Pemukiman dan Cipta Karya, DPU Binamarga & Sumberdaya Air, maka jumlah hari pemeriksaan reguler ditetapkan 15 (lima belas) hari kerja;\n2. Pemeriksaan Khusus SD dan SMP terkait permasalahan PP 53 tahun 2010 dan PP 10 tahun 1983 dibebankan kepada masing – masing kecamatan di wilayah Inspektur Pembantu;\n3. Pemeriksaan regular dan khusus untuk Desa/Kelurahan, UPT serta Puskesmas  dibebankan kepada masing – masing kecamatan di wilayah Inspektur Pembantu;\n4. Pemeriksaan Perusahaan Daerah/BUMD, Reviu, Monitoring, Evaluasi, Pemeriksaan dengan Tujuan Tertentu (PDTT) dapat dilaksanakan lintas Inspektur Pembantu;', 'RATNO C. SEMBODO, SH', '19740827 200501 1 006', '2022-12-19 21:10:41', '2022-12-19 21:10:41'),
(4, 'IRBAN Wilayah IV', '1. Bagi Perangkat Daerah yang mengelola anggaran belanja langsungnya > 16 M yaitu : Dinas Pendidikan, Dinas Kesehatan, Dinas Perumahan Rakyat, Kawasan Pemukiman dan Cipta Karya, DPU Binamarga & Sumberdaya Air, maka jumlah hari pemeriksaan reguler ditetapkan 15 (lima belas) hari kerja;\n2. Pemeriksaan Khusus SD dan SMP terkait permasalahan PP 53 tahun 2010 dan PP 10 tahun 1983 dibebankan kepada masing – masing kecamatan di wilayah Inspektur Pembantu;\n3. Pemeriksaan regular dan khusus untuk Desa/Kelurahan, UPT serta Puskesmas  dibebankan kepada masing – masing kecamatan di wilayah Inspektur Pembantu;\n4. Pemeriksaan Perusahaan Daerah/BUMD, Reviu, Monitoring, Evaluasi, Pemeriksaan dengan Tujuan Tertentu (PDTT) dapat dilaksanakan lintas Inspektur Pembantu;', 'RATNO C. SEMBODO, SH', '19740827 200501 1 006', '2022-12-19 21:10:50', '2022-12-19 21:10:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `irbanwilayahs`
--

CREATE TABLE `irbanwilayahs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `irban_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `irbanwilayahs`
--

INSERT INTO `irbanwilayahs` (`id`, `irban_id`, `nama`, `created_at`, `updated_at`) VALUES
(3, 1, 'Kecamatan Sumbersari', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(4, 1, 'Kecamatan Arjasa', '2022-12-21 17:00:00', '2022-12-21 17:00:00'),
(5, 1, 'Kecamatan Jelbuk', '2022-12-22 17:00:00', '2022-12-22 17:00:00'),
(6, 1, 'Kecamatan Wuluhan', '2022-12-23 17:00:00', '2022-12-23 17:00:00'),
(7, 1, 'Kecamatan Kencong', '2022-12-24 17:00:00', '2022-12-24 17:00:00'),
(8, 1, 'Kecamatan Sumberbaru', '2022-12-25 17:00:00', '2022-12-25 17:00:00'),
(9, 1, 'Kecamatan Umbulsari', '2022-12-26 17:00:00', '2022-12-26 17:00:00'),
(10, 1, 'Kecamatan Jombang', '2022-12-27 17:00:00', '2022-12-27 17:00:00'),
(11, 1, 'Bagian Hukum', '2022-12-28 17:00:00', '2022-12-28 17:00:00'),
(12, 1, 'Bagian Organisasi', '2022-12-29 17:00:00', '2022-12-29 17:00:00'),
(13, 1, 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia', '2022-12-30 17:00:00', '2022-12-30 17:00:00'),
(14, 1, 'Badan Pendapatan', '2022-12-31 17:00:00', '2022-12-31 17:00:00'),
(15, 1, 'Dinas Pariwisata dan Kebudayaan', '2023-01-01 17:00:00', '2023-01-01 17:00:00'),
(16, 1, 'Dinas Koperasi dan Usaha Mikro', '2023-01-02 17:00:00', '2023-01-02 17:00:00'),
(17, 1, 'Dinas Tanaman Pangan, Holtikultura dan Perkebunan', '2023-01-03 17:00:00', '2023-01-03 17:00:00'),
(18, 1, 'Dinas Perikanan', '2023-01-04 17:00:00', '2023-01-04 17:00:00'),
(19, 4, 'Dinas Perumahan Rakyat, Kawasan Pemukiman dan Cipta Karya', '2023-01-05 17:00:00', '2022-12-29 09:04:20'),
(20, 1, 'RSD dr. Soebandi', '2023-01-06 17:00:00', '2023-01-06 17:00:00'),
(21, 2, 'Kecamatan Sukorambi', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(22, 2, 'Kecamatan Balung', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(23, 2, 'Kecamatan Ambulu', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(24, 2, 'Kecamatan Jenggawah', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(25, 2, 'Kecamatan Panti', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(26, 2, 'Kecamatan Mayang', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(27, 2, 'Kecamatan Tempurejo', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(28, 2, 'Kecamatan Sumberjambe', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(29, 2, 'Bagian Umum', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(30, 2, 'Bagian Bina Mental', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(31, 2, 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(32, 2, 'Satuan Polisi Pamong Praja', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(33, 2, 'Dinas Pemberdayaan Masyarakat & Desa', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(34, 2, 'Dinas Kependudukan dan Pencatatan Sipil', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(35, 2, 'Dinas Tenaga Kerja ', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(36, 2, 'Dinas Perindustrian dan Perdagangan', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(37, 2, 'Dinas Kesehatan', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(38, 3, 'Kecamatan Patrang', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(39, 3, 'Kecamatan Rambipuji', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(40, 3, 'Kecamatan Sukowono', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(41, 3, 'Kecamatan Puger', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(42, 3, 'Kecamatan Gumukmas', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(43, 3, 'Kecamatan Semboro', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(44, 3, 'Kecamatan Silo', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(45, 3, 'Kecamatan Mumbulsari', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(46, 3, 'Bagian Tata Pemerintahan', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(47, 3, 'Bagian Pembangunan', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(48, 3, 'Badan Perencanaan Pembagunan Daerah', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(49, 3, 'Badan Pengelolaan Keuangan dan Aset Daerah', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(50, 3, 'Dinas Lingkungan Hidup', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(51, 3, 'Dinas Pemberdayaan Perempuan, Perlindungan Anak dan Keluarga Berencana', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(52, 3, 'Dinas Perpustakaan dan Kearsipan', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(53, 3, 'Dinas Ketahanan Pangan dan Peternakan ', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(54, 3, 'Dinas Pendidikan', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(55, 3, 'RSD Balung', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(56, 4, 'Kecamatan Kaliwates', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(57, 4, 'Kecamatan Ajung', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(58, 4, 'Kecamatan Bangsalsari', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(59, 4, 'Kecamatan Pakusari', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(60, 4, 'Kecamatan Ledokombo', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(61, 4, 'Kecamatan Kalisat', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(62, 4, 'Kecamatan Tanggul', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(63, 4, 'Bagian Perekonomian', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(64, 4, 'Bagian Hubungan Masyarakat dan Protokol', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(65, 4, 'Badan Kesatuan Bangsa dan Politik', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(66, 4, 'Badan Penanggulangan Bencana Daerah ', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(67, 4, 'Sekretariat Dewan Perwakilan Rakyat Daerah', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(68, 4, 'Dinas Komunikasi dan Informatika', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(69, 4, 'Dinas Sosial', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(70, 4, 'Dinas Kepemudaan dan Olahraga', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(71, 4, 'Dinas Perhubungan', '2022-12-20 17:00:00', '2022-12-20 17:00:00'),
(72, 1, 'Dinas Pekerjaan Umum Bina Marga dan Sumberdaya Air', '2022-12-20 17:00:00', '2022-12-29 09:04:29'),
(73, 4, 'RSD Kalisat', '2022-12-20 17:00:00', '2022-12-20 17:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatans`
--

CREATE TABLE `kecamatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kecamatans`
--

INSERT INTO `kecamatans` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Ajung', '2022-08-26 13:43:44', '2022-08-26 13:43:44'),
(2, 'Ambulu', '2022-08-26 13:43:51', '2022-08-26 13:43:51'),
(3, 'Arjasa', '2022-08-26 13:43:58', '2022-08-26 13:43:58'),
(4, 'Bangsalsari', '2022-08-26 13:44:04', '2022-08-26 13:44:04'),
(5, 'Balung', '2022-08-26 13:44:10', '2022-08-26 13:44:10'),
(6, 'Gumukmas', '2022-08-26 13:44:17', '2022-08-26 13:44:17'),
(7, 'Jelbuk', '2022-08-26 13:44:23', '2022-08-26 13:44:23'),
(8, 'Jenggawah', '2022-08-26 13:44:31', '2022-08-26 13:44:31'),
(9, 'Jombang', '2022-08-26 13:44:36', '2022-08-26 13:44:36'),
(10, 'Kalisat', '2022-08-26 13:44:43', '2022-08-26 13:44:43'),
(11, 'Kaliwates', '2022-08-26 13:44:51', '2022-08-26 13:44:51'),
(12, 'Kencong', '2022-08-26 13:44:59', '2022-08-26 13:45:05'),
(13, 'Ledokombo', '2022-08-26 13:45:13', '2022-08-26 13:45:13'),
(14, 'Mayang', '2022-08-26 13:45:19', '2022-08-26 13:45:19'),
(15, 'Mumbulsari', '2022-08-26 13:45:27', '2022-08-26 13:45:27'),
(16, 'Panti', '2022-08-26 13:45:33', '2022-08-26 13:45:33'),
(17, 'Pakusari', '2022-08-26 13:45:39', '2022-08-26 13:45:39'),
(18, 'Patrang', '2022-08-26 13:45:45', '2022-08-26 13:45:45'),
(19, 'Puger', '2022-08-26 13:45:50', '2022-08-26 13:45:50'),
(20, 'Rambipuji', '2022-08-26 13:46:05', '2022-08-26 13:46:05'),
(21, 'Semboro', '2022-08-26 13:46:13', '2022-08-26 13:46:13'),
(22, 'Silo', '2022-08-26 13:46:19', '2022-08-26 13:46:19'),
(23, 'Sukorambi', '2022-08-26 13:46:28', '2022-08-26 13:46:28'),
(24, 'Sukowono', '2022-08-26 13:46:35', '2022-08-26 13:46:35'),
(25, 'Sumberbaru', '2022-08-26 13:46:41', '2022-08-26 13:46:41'),
(26, 'Sumberjambe', '2022-08-26 13:46:50', '2022-08-26 13:46:50'),
(27, 'Sumbersari', '2022-08-26 13:46:56', '2022-08-26 13:46:56'),
(28, 'Tanggul', '2022-08-26 13:47:04', '2022-08-26 13:47:04'),
(29, 'Tempurejo', '2022-08-26 13:47:17', '2022-08-26 13:47:17'),
(30, 'Umbulsari', '2022-08-26 13:47:23', '2022-08-26 13:47:23'),
(31, 'Wuluhan', '2022-08-26 13:47:29', '2022-08-26 13:47:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kopijitems`
--

CREATE TABLE `kopijitems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kopij_id` bigint(20) UNSIGNED NOT NULL,
  `pesan` text NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kopijitems`
--

INSERT INTO `kopijitems` (`id`, `kopij_id`, `pesan`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Balasan keluhan Balasan keluhan Balasan keluhan Balasan keluhan Balasan keluhan Balasan keluhan', 1, '2022-12-21 14:16:24', '2022-12-21 14:16:24'),
(2, 1, 'balas 2', NULL, '2022-12-21 14:17:01', '2022-12-21 14:17:01'),
(3, 1, 'jawab 2', 1, '2022-12-21 14:17:43', '2022-12-21 14:17:43'),
(4, 2, 'dibalas oelh admin ini isis balasannya  dibalas oelh admin ini isis balasannya  dibalas oelh admin ini isis balasannya  dibalas oelh admin ini isis balasannya  dibalas oelh admin ini isis balasannya  dibalas oelh admin ini isis balasannya  dibalas oelh admin ini isis balasannya', 1, '2022-12-28 03:21:40', '2022-12-28 03:21:40'),
(5, 2, 'terimakasih sudah di layani terimakasih sudah di layani terimakasih sudah di layani terimakasih sudah di layani terimakasih sudah di layani terimakasih sudah di layani terimakasih sudah di layani', NULL, '2022-12-28 03:25:27', '2022-12-28 03:25:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kopijs`
--

CREATE TABLE `kopijs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` int(10) UNSIGNED NOT NULL,
  `nomor_wa` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `file_ktp` varchar(255) DEFAULT NULL,
  `file_kk` varchar(255) DEFAULT NULL,
  `file_lain1` varchar(255) DEFAULT NULL,
  `file_lain2` varchar(255) DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kopijs`
--

INSERT INTO `kopijs` (`id`, `nomor`, `nik`, `nama`, `jenis_kelamin`, `nomor_wa`, `judul`, `deskripsi`, `file_ktp`, `file_kk`, `file_lain1`, `file_lain2`, `status_id`, `created_at`, `updated_at`) VALUES
(1, '00001/KOPI-J/211222', '3509274109040004', 'LILIK MAKHFIYAH, S.Pd', 2, '081330034153', 'PPID Perumda Perkebunan Kahyangan Kab. Jember', 'PPID Perumda Perkebunan Kahyangan Kab. Jember PPID Perumda Perkebunan Kahyangan Kab. Jember PPID Perumda Perkebunan Kahyangan Kab. Jember PPID Perumda Perkebunan Kahyangan Kab. Jember PPID Perumda Perkebunan Kahyangan Kab. Jember', 'uploads/ErnUpfjPgwmvYUzOVvtijcc3DxttesXfswIR4DY2.jpg', NULL, NULL, NULL, 5, '2022-12-21 14:12:36', '2022-12-21 14:18:47'),
(2, '00002/KOPI-J/281222', '3509274109040004', 'NOVI', 2, '085236699879', 'Judul Konsultasi', 'Kontent Keluhan dan Konsultasi Kontent Keluhan dan Konsultasi Kontent Keluhan dan Konsultasi Kontent Keluhan dan Konsultasi Kontent Keluhan dan Konsultasi Kontent Keluhan dan Konsultasi Kontent Keluhan dan Konsultasi Kontent Keluhan dan Konsultasi Kontent Keluhan dan Konsultasi Kontent Keluhan dan Konsultasi Kontent Keluhan dan Konsultasi', 'uploads/6C6vqy26HMkSMyODtZUNGKTjK1T6JQXwGq77DvTe.jpg', NULL, 'uploads/bl36ySYOA7KHsStL9B6CrJUsw4SwiX4zTUhVv7eG.jpg', 'uploads/TahigRtt2gcUB8YaoFcBWtl9koQwQPnk6d7pPRGM.jpg', 0, '2022-12-28 03:18:58', '2022-12-28 03:18:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_darurats`
--

CREATE TABLE `laporan_darurats` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `kejadian` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `hari` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `pukul` time DEFAULT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `image4` varchar(255) DEFAULT NULL,
  `kronologi` varchar(255) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `status_id` bigint(20) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `kecamatan_id` bigint(20) DEFAULT NULL,
  `desa_id` bigint(20) DEFAULT NULL,
  `la_latitude` varchar(255) DEFAULT NULL,
  `la_longitude` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `letters`
--

CREATE TABLE `letters` (
  `id` bigint(20) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `pengirim_opd` varchar(255) DEFAULT NULL,
  `pengirim_nonopd` varchar(255) DEFAULT NULL,
  `tgl_surat` timestamp NULL DEFAULT NULL,
  `nomor_surat` varchar(355) DEFAULT NULL,
  `tgl_diterima` timestamp NULL DEFAULT NULL,
  `perihal` varchar(255) DEFAULT NULL,
  `tgl_disposisi` timestamp NULL DEFAULT NULL,
  `disposisi` varchar(255) DEFAULT NULL,
  `irban_penerima` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_penerima` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `letters`
--

INSERT INTO `letters` (`id`, `nomor`, `pengirim_opd`, `pengirim_nonopd`, `tgl_surat`, `nomor_surat`, `tgl_diterima`, `perihal`, `tgl_disposisi`, `disposisi`, `irban_penerima`, `nama_penerima`, `keterangan`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '00001/FD/251222', 'DISPENDUK', NULL, '2022-12-25 03:30:46', '234324343', '2022-12-28 03:30:46', 'Perihal', '2022-12-31 03:30:46', 'isi dari disposisi inspektur isi dari disposisi inspektur isi dari disposisi inspektur isi dari disposisi inspektur isi dari disposisi inspektur', 2, 'ERRETRT', 'Keternagan Keternagan Keternagan Keternagan', 1, '2022-12-28 03:29:01', '2022-12-28 03:30:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `access` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `levels`
--

INSERT INTO `levels` (`id`, `nama`, `access`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'IRBAN.destroy,IRBAN.index,IRBAN.show,IRBAN.store,IRBAN.update,abouts.index,abouts.update,callToActions.create,callToActions.destroy,callToActions.edit,callToActions.index,callToActions.store,callToActions.update,categories.destroy,categories.edit,categories.index,categories.show,categories.store,categories.update,categoriperaturans.destroy,categoriperaturans.edit,categoriperaturans.index,categoriperaturans.show,categoriperaturans.store,categoriperaturans.update,desas.destroy,desas.edit,desas.index,desas.show,desas.store,desas.update,front_desk.create,front_desk.destroy,front_desk.edit,front_desk.index,front_desk.store,front_desk.update,kategories.destroy,kategories.edit,kategories.index,kategories.show,kategories.store,kategories.update,kecamatans.destroy,kecamatans.edit,kecamatans.index,kecamatans.show,kecamatans.store,kecamatans.update,kopi-j.create,kopi-j.delete_item,kopi-j.destroy,kopi-j.edit,kopi-j.index,kopi-j.reply,kopi-j.show,kopi-j.show,kopi-j.store,kopi-j.update,laporandarurats.create,laporandarurats.destroy,laporandarurats.edit,laporandarurats.index,laporandarurats.store,laporandarurats.update,levels.destroy,levels.edit,levels.index,levels.store,levels.update,links.create,links.destroy,links.edit,links.index,links.store,links.update,menus.destroy,menus.index,menus.show,menus.store,menus.update,pages.create,pages.destroy,pages.edit,pages.index,pages.store,pages.update,posts.create,posts.destroy,posts.edit,posts.index,posts.store,posts.update,profile.index,profile.update,programs.destroy,programs.edit,programs.index,programs.show,programs.store,programs.update,regulasis.create,regulasis.destroy,regulasis.edit,regulasis.index,regulasis.show,regulasis.store,regulasis.update,sections.destroy,sections.index,sections.show,sections.store,sections.update,services.create,services.destroy,services.edit,services.index,services.store,services.update,settings.index,settings.update,sliders.create,sliders.destroy,sliders.edit,sliders.index,sliders.store,sliders.update,staffs.create,staffs.destroy,staffs.edit,staffs.index,staffs.show,staffs.store,staffs.update,testimonials.create,testimonials.destroy,testimonials.edit,testimonials.index,testimonials.store,testimonials.update,users.create,users.destroy,users.edit,users.index,users.store,users.update,whatsapp.destroy,whatsapp.getqr,whatsapp.index,whatsapp.resend,whatsapp.reset,whatsapp.scan,wilayah_IRBAN.destroy,wilayah_IRBAN.index,wilayah_IRBAN.show,wilayah_IRBAN.store,wilayah_IRBAN.update', '2022-11-08 02:30:07', '2022-12-23 10:55:50'),
(5, 'Irban', 'front_desk.edit,front_desk.index,front_desk.store', '2022-12-23 11:53:08', '2022-12-23 11:54:42'),
(6, 'Front Desk', 'front_desk.create,front_desk.destroy,front_desk.edit,front_desk.index,front_desk.store,front_desk.update', '2022-12-23 11:54:56', '2022-12-23 11:55:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `links`
--

CREATE TABLE `links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `links`
--

INSERT INTO `links` (`id`, `name`, `image`, `link`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'uploads/GyMIoujp2KIE4G4WVqbNunWMMIQKWSab7wPBGlVy.png', '/test', '2022-09-14 10:09:29', '2022-09-14 05:05:48', '2022-09-14 10:09:29'),
(2, 'Test2', 'uploads/BPLOVYPUniIwQrNuROMLjjKgq64eLmDQdhRx3V0p.png', '/test2', '2022-09-14 10:09:34', '2022-09-14 05:09:34', '2022-09-14 10:09:34'),
(3, 'Test3', 'uploads/HRIoxe4AQEhqMofxaH1oqrTB8OlpF6flLqRbY1BH.png', '/test3', '2022-09-20 19:19:58', '2022-09-14 05:12:27', '2022-09-20 19:19:58'),
(4, 'Test4', 'uploads/wIYldxA8Sb4gTmde5c278KkLRLAeyBoTFj9ocBwL.jpg', '/test4', '2022-09-20 19:19:54', '2022-09-14 05:12:51', '2022-09-20 19:19:54'),
(5, 'Test5', 'uploads/N3jzpetPWp3EwO2WYKRkGQOwTUb37ydlO8WG5Tgo.jpg', '/test5', '2022-11-29 08:05:18', '2022-09-14 05:14:02', '2022-11-29 08:05:18'),
(6, 'Diskominfo Kab. Jember', 'uploads/bbH1jnIHsHGBfcDjEYbCli7SkuLc8ZBWTakUxj4Q.png', 'https://diskominfo.jemberkab.go.id/', NULL, '2022-09-14 05:17:29', '2022-12-04 10:06:28'),
(7, 'PPID Kab. Jember', 'uploads/BYC3igrwTmYz1L45iwah3C9BtlwtzksemQF1Deoh.png', 'https://ppid.jemberkab.go.id/', NULL, '2022-09-22 02:28:18', '2022-12-04 10:06:10'),
(8, 'Pemkab Jember', 'uploads/Qkbt8pImwTPEXbFk0kxq2VsxFcxaK3OXpWWVVZQn.png', 'https://jemberkab.go.id/', NULL, '2022-09-22 02:28:30', '2022-12-04 10:05:53'),
(9, 'Pemprov Jatim', 'uploads/eVToSHUgqA8J8MYZOpP0R8lJfqWEVaaQ1I4o8iXZ.png', 'https://jatimprov.go.id/', NULL, '2022-09-22 02:28:47', '2022-12-04 10:05:36'),
(10, 'ffffff', 'uploads/P5g9tK8yYEtrqC9EfWh3HczPV0qlVBA2svAPYIno.jpg', '#', '2022-11-30 19:15:42', '2022-11-29 08:05:36', '2022-11-30 19:15:42'),
(11, 'WBS Inspektorat Jember', 'uploads/mMq1uL3n36zUX79HQe2RUUoX87HVJK1ZZWEItYBz.png', 'https://wbs.jemberkab.go.id/', NULL, '2022-12-28 03:05:36', '2022-12-28 03:05:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `child` int(11) DEFAULT NULL,
  `sort` double NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `name`, `link`, `child`, `sort`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Home', '/', NULL, 1, NULL, '2022-09-13 23:02:58', '2022-12-14 08:02:04'),
(5, 'Profil', '#', NULL, 2, NULL, '2022-11-29 07:31:10', '2022-12-14 07:14:47'),
(6, 'Tentang', '/pages/tentang-kami', 5, 2.1, NULL, '2022-11-30 18:57:07', '2022-12-04 11:19:26'),
(7, 'Visi Misi', '/pages/visi-dan-misi', 5, 2.2, NULL, '2022-11-30 19:00:20', '2022-12-04 10:53:39'),
(8, 'Struktur Organisasi', '/pages/struktur-organisasi', 5, 2.3, NULL, '2022-11-30 19:01:13', '2022-12-04 10:53:25'),
(9, 'Tupoksi', '/pages/tupoksi', 5, 2.4, NULL, '2022-11-30 19:01:33', '2022-12-04 10:53:12'),
(12, 'Saber Pungli', '/category/saber-pungli', NULL, 6, NULL, '2022-11-30 19:02:38', '2022-12-16 00:48:39'),
(13, 'Terbaru', '#', NULL, 5, NULL, '2022-11-30 19:02:57', '2022-12-13 02:41:46'),
(15, 'Berita Terbaru', '/posts', 13, 5.1, NULL, '2022-12-04 10:21:02', '2022-12-19 17:57:32'),
(16, 'Pengumuman', '/posts?category=pengumuman', 13, 5.3, NULL, '2022-12-04 10:21:34', '2022-12-13 23:30:36'),
(17, 'Berita PPID', '/berita-ppid', 13, 5.3, NULL, '2022-12-04 10:22:36', '2022-12-13 23:30:29'),
(18, 'Inspektur Pembantu', '/irban', 5, 2.5, NULL, '2022-12-04 10:52:57', '2022-12-21 06:22:45'),
(19, 'SKM', '/testimonials', 13, 5.6, NULL, '2022-12-05 12:01:12', '2022-12-13 02:42:45'),
(27, 'Pengawasan', '/category/pengawasan', NULL, 4, NULL, '2022-12-12 01:47:19', '2022-12-19 04:20:31'),
(29, 'Lapor', '#', NULL, 4, NULL, '2022-12-13 02:40:06', '2022-12-14 07:13:49'),
(30, 'E-Lapor', 'https://www.lapor.go.id/', 29, 4.1, NULL, '2022-12-13 02:40:50', '2022-12-14 10:39:54'),
(31, 'Wbs', 'https://wbs.jemberkab.go.id/', 29, 4.2, NULL, '2022-12-13 02:41:11', '2022-12-19 03:26:24'),
(32, 'Zona Integritas', '/category/zona-integritas', NULL, 7, NULL, '2022-12-13 02:47:04', '2022-12-18 13:36:09'),
(33, 'Gratifikasi', '/category/gratifikasi', NULL, 8, NULL, '2022-12-13 02:47:27', '2022-12-19 04:23:47'),
(34, 'Peraturan', '/regulasis', NULL, 11, NULL, '2022-12-13 02:48:13', '2022-12-19 04:10:39'),
(35, 'MCP', '/category/mcp', NULL, 10, NULL, '2022-12-13 02:49:08', '2022-12-16 00:53:18'),
(36, 'Staff', '/staff', 5, 2.6, NULL, '2022-12-13 14:40:10', '2022-12-13 14:40:10'),
(37, 'KOPI-J', '/kopij', NULL, 3, NULL, '2022-12-19 04:20:07', '2022-12-21 06:22:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `views` double NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `image`, `body`, `user_id`, `views`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'visi misi', 'visi-misi', 'uploads/sLH1NuKSSZF34nm6ptfd4S03Z1R5TRrYsuoN7Qmq.png', 'xxzcascsadasccsa', 1, 24, 1, '2022-12-04 10:35:54', '2022-09-13 23:04:30', '2022-12-04 10:35:54'),
(2, 'test612', 'test612', 'uploads/HmWQzOuEZ0UQorwx6K1wXLfWhR8Iw4so1QH3i3ki.jpg', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/a9o3fjiaCnA\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 1, 2, 1, '2022-12-04 10:22:58', '2022-09-15 09:27:06', '2022-12-04 10:22:58'),
(3, 'tentang', 'tentang', 'uploads/qcgYtdKDOyVwp3eLMEYrYwDY4nPhiRKJN4u5BVOt.png', '<p><strong>Lorem Ipsum</strong><span style=\"background-color:rgb(255,255,255);color:rgb(0,0,0);\"> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>', 1, 33, 1, '2022-12-04 10:22:53', '2022-09-15 16:58:27', '2022-12-04 10:22:53'),
(4, 'wewewew', 'wewewew', 'uploads/56qEFpvegdJgPPRyhYNOgyt4RXUvdi6FK4CFHbxg.jpg', 'sdfdsfsf', 1, 0, 1, '2022-11-29 20:17:27', '2022-11-29 20:16:59', '2022-11-29 20:17:27'),
(5, 'Test1', 'test1', 'uploads/dqrjkQELWB9asocBGT7U20SSUZMYAUJeolKPhVQs.jpg', '<p>fewfwefwefwefweefwefewwefwefwefwefwefwe</p>', 1, 6, 1, '2022-12-04 10:22:49', '2022-11-30 23:25:36', '2022-12-04 10:22:49'),
(6, 'Tentang Kami', 'tentang-kami', 'uploads/9hoTqysXxuVbhLgFCqmvdoZH1ZsJoKdaPQR2CGk9.jpg', '<p style=\"text-align:justify;\"><strong>BISMILLAHIRAHMANIRRAHIM</strong></p><p style=\"text-align:justify;\">&nbsp;</p><p style=\"text-align:justify;\">Assalamualaikum Wr. Wb.</p><p style=\"text-align:justify;\">Pada era globalisasi saat ini, kebutuhan akan informasi yang cepat - tepat - akurat - akuntabel, merupakan suatu keinginan masyarakat. Ketersediaan informasi tersebut dapat digunakan sebagaimana mestinya. Kita sadari bersama bahwa dengan teknologi yang semakin canggih ini, informasi menjadi sangat penting bahkan informasi sudah menjadi suatu kebutuhan hidup dalam menunjang kebutuhan masyarakat modern.</p><p style=\"text-align:justify;\">Sejalan dengan hal &nbsp;tersebut, dalam upaya memberikan informasi yang cepat - tepat - akurat - akuntabel, maka sejak tahun 2022 Inspektorat Kabupaten Jember merilis website yang dapat diakses masyarakat banyak di alamat <a href=\"https://inspektorat.jemberkab.go.id/\">https://inspektorat.jemberkab.go.id/</a></p><p style=\"text-align:justify;\">Diharapkan dengan adanya website &nbsp;ini, Inspektorat Kabupaten Jember lebih terbuka untuk membentuk kemitraan dan keterbukaan dalam berbagai aspek informasi sesuai dengan Undang-Undang Nomor 14 Tahun 2008 Tentang Keterbukaan Informasi Publik. Pemanfaatan website ini merupakan salah satu bukti perwujudan dari Inspektorat Kabupaten Jember untuk mendukung Visi Pembangunan Daerah Kabupaten Jember Tahun 2021-2026: <i><strong>“Wes Wayahe Mbenahi Jember dengan Berprinsip pada Kolaborasi, Sinergi, dan Akselerasi dalam Membangun Jember”</strong></i>. Inspektorat Kabupaten Jember berpedoman pada Misi II Kabupaten Jember yaitu <i><strong>“Membangun tata kelola pemerintahan yang kondusif antara eksekutif, legislatif, masyarakat, dan komponen pembangunan daerah lainnya”.</strong></i></p><p style=\"text-align:justify;\">&nbsp;</p><p style=\"text-align:justify;\">Sekian Terima Kasih,</p><p style=\"text-align:justify;\">&nbsp;</p><p style=\"text-align:justify;\">Wassalamualaikum Wr. Wb.</p><p style=\"text-align:justify;\">Inspektur Kab. Jember</p>', 1, 54, 1, NULL, '2022-12-04 10:35:38', '2024-06-06 22:24:06'),
(7, 'Visi dan Misi', 'visi-dan-misi', 'uploads/CaLQOwlbcpMow31470gaNIzXym2ORZphtUWUz2jp.jpg', '<p><strong>Visi</strong></p><p>Berdasar &nbsp; visi &nbsp; Kabupaten &nbsp; Jember &nbsp; yang tercantum &nbsp; dalam &nbsp; Rencana pembangunan Jangka menengah Daerah (RPJMD) Kabupaten Jember yaitu:</p><blockquote><p style=\"text-align:center;\"><br>“WES WAYAHE MBENAHI JEMBER DENGAN BERPRINSIP PADA KOLABORASI, SINERGI, DAN AKSELERASI DALAM MEMBANGUN JEMBER”<br>&nbsp;</p></blockquote><p><span class=\"text-huge\"><strong>Misi</strong></span></p><p>Untuk mewujudkan visi pembangunan Kabupaten Jember 5 (lima) tahun kedepan telah ditetapkan 7 (tujuh) misi pembangunan yang akan menjadi acuan dalam pembuatan program dan kegiatan. Adapun ke 7 (tujuh) misi pembangunan tersebut adalah:</p><ol><li>Meningkatkan &nbsp; pertumbuhan &nbsp; ekonomi &nbsp; dengan &nbsp; semangat &nbsp; sinergitas &nbsp; dan kolaborasi dengan semua elemen masyarakat yang berbasiskan potensi daerah.</li><li>Membangun tata kelola pemerintahan yang kondusif antara eksekutif, legislatif, masyarakat dan komponen pembangunan daerah lainnya</li><li>Menuntaskan kemiskinan struktural dan kultural di semua wilayah</li><li>Meningkatkan &nbsp;investasi &nbsp;dengan &nbsp;membangun &nbsp;dan &nbsp;mengembangkan &nbsp;sektor- sektor unggulan dengan berbasiskan kekayaan Sumber Daya Alam, Sumber Daya Manusia dan lingkungan yang lestari.&nbsp;</li><li>Meningkatkan &nbsp;pelayanan &nbsp;dasar &nbsp;berupa &nbsp;kesehatan &nbsp;dan &nbsp;pendidikan &nbsp;dengan sistem yang terintegrasi</li><li>Meningkatkan kualitas dan ketersediaan infrastruktur publik yang merata di semua wilayah Jember</li><li>Pengembangan &nbsp;potensi &nbsp;pariwisata &nbsp;dengan &nbsp;mengedepankan &nbsp;kearifan &nbsp;lokal serta pelestarian budaya</li></ol><p>&nbsp;</p><p>&nbsp;</p><p><br>&nbsp;</p>', 1, 22, 1, NULL, '2022-12-04 10:36:29', '2022-12-29 02:34:18'),
(8, 'Struktur Organisasi', 'struktur-organisasi', 'uploads/mEPqFjaKYez7qPWdPMHAyhEqvkyeget04fx7YDlw.jpg', '<h3 style=\"text-align:center;\"><strong>Struktur Organisasi Inspektorat Kabupaten Jember</strong></h3><p style=\"text-align:center;\">&nbsp;</p><figure class=\"image\"><img src=\"https://inspektorat.anmediacorp.com/storage/attachments/STRUKTUR ORGANISASI_1671628779.jpg\"></figure><p><img></p>', 1, 24, 1, NULL, '2022-12-04 10:37:30', '2022-12-29 06:39:27'),
(9, 'Tupoksi', 'tupoksi', 'uploads/V9O81s9DrFikJwYe4I8HQMoRjOr6hAdwxkyxRp62.jpg', '<p>Berdasarkan Peraturan Bupati Jember Nomor 134 Tahun 2016 Pasal 2 dan huruf ke-3 disebutkan bahwa “Inspektorat mempunyai tugas membina dan mengawasi pelaksanaan urusan pemerintahan yang menjadi kewenangan daerah serta tugas lain yang diberikan kepada Bupati\".</p><p>Untuk melaksanakan tugas tersebut di atas Berdasarkan Peraturan Bupati Jember Nomor 134 Tahun 2016 Pasal 2 dan huruf ke-4 sebagaimana yang dimaksud pada ayat (3), mempunyai fungsi:&nbsp;</p><ol><li>Perumusan kebijakan teknis bidang pengawasan dan fasilitasi pengawasan;&nbsp;</li><li>Pelaksanaan pengawasan internal terhadap kinerja dan keuangan melalui audit, reviu, evaluasi, pemantauan, dan kegiatan pengawasan lainnya;&nbsp;</li><li>pelaksanaan pengawasan untuk tujuan tertentu atas penugasan Bupati;&nbsp;</li><li>Penyusunan laporan hasil pengawasan;</li><li>Pelaksanaan administrasi Inspektorat;</li><li>Pelaksanaan koordinasi pencegahan tindak pidana korupsi;</li><li>Pengawasan pelaksanaan program reformasi birokrasi; dan</li><li>Pelaksanaan perneriksaan, pengusutan, pengujian, dan penilaian tugas pengawasan.</li></ol><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>', 1, 17, 1, NULL, '2022-12-04 10:38:19', '2022-12-29 03:27:34'),
(10, 'Bidang', 'bidang', 'uploads/M4hz3QPldy9ErTS5RrN29RHCVRWmT3zFcfIvO6P6.jpg', '<ol><li>Tulis Bidang Apa Saja Di Sini dan Item Diskripsi Tugasnya</li><li>Tulis Bidang Apa Saja Di Sini dan Item Diskripsi Tugasnya</li><li>Tulis Bidang Apa Saja Di Sini dan Item Diskripsi Tugasnya</li><li>Tulis Bidang Apa Saja Di Sini dan Item Diskripsi Tugasnya</li></ol>', 1, 12, 1, NULL, '2022-12-04 10:39:17', '2022-12-21 02:57:49'),
(11, 'PPID', 'ppid', 'uploads/kvWSohJCXzE4mwn2TqAerARA3pOecxOCwqrdRIIX.jpg', '<p>Ketahui lebih detail, PPID Inspektorat Kab. Jember dengan klik pada gambar berikut:</p><p>&nbsp;</p><figure class=\"table\"><table><tbody><tr><td><figure class=\"image image_resized\" style=\"width:84.01%;\"><a href=\"https://ppid.jemberkab.go.id/ppid-pelaksana/detail/13\"><img src=\"https://inspektorat.anmediacorp.com/storage/attachments/Slide9_1670811964.JPG\"></a></figure></td><td><figure class=\"image image_resized\" style=\"width:84.06%;\"><a href=\"https://ppid.jemberkab.go.id/permohonan-baru\"><img src=\"https://inspektorat.anmediacorp.com/storage/attachments/Slide10_1670811973.JPG\"></a></figure></td></tr></tbody></table></figure><p>&nbsp;</p>', 1, 16, 1, NULL, '2022-12-07 07:07:59', '2022-12-14 06:11:48'),
(12, 'Sekretariat', 'sekretariat', NULL, '<p>Sekretariat</p>', 1, 5, 1, '2022-12-21 13:25:10', '2022-12-19 04:32:38', '2022-12-21 13:25:10'),
(13, 'Layanan Surat Keterangan Bebas Temuan', 'layanan-surat-keterangan-bebas-temuan', NULL, '<p>Layanan Surat Keterangan Bebas Temuan adalah ____________________________</p>', 1, 5, 1, NULL, '2022-12-21 13:59:50', '2022-12-28 02:38:38'),
(14, 'Layanan LHKSN', 'layanan-lhksn', NULL, '<p>Layanan LHKSN adalah ______________________</p>', 1, 4, 1, NULL, '2022-12-21 14:00:30', '2022-12-26 02:38:37'),
(15, 'Layanan LHKPN', 'layanan-lhkpn', NULL, '<p>Layanan LHKPN adalah ______________________</p>', 1, 3, 1, NULL, '2022-12-21 14:01:08', '2022-12-28 03:09:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tag_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `views` double NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `image`, `body`, `category_id`, `program_id`, `tag_id`, `user_id`, `views`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Sampaikan Laporan Keuangan 2021, Optimistis Jember Lebih Baik', 'sampaikan-laporan-keuangan-2021-optimistis-jember-lebih-baik', 'uploads/EB1tP3190NsmvIe730DgJ2Hz9wUUCehYEGFkoarI.jpg', '<p>Jember – Wakil Bupati Jember KH. MB. Firjaun Barlaman menyerahkan laporan keuangan pemerintah Kabupaten Jember tahun anggaran 2021 unaudited di Kantor BPK Perwakilan Jatim pada Selasa (22/3/2022) sore. Tak sendirian, pria yang akrab disapa Gus Firjaun tersebut juga ditemani jajaran pimpinan OPD lain. Di antaranya, Sekretaris Daerah (Sekda) Ir. Mirfano, Kepala Inspektorat Jember Ratno C. Sembodo, serta Kepala Badan Pengelola Keuangan dan Aset Daerah (BPKAD) Kabupaten Jember Tita Fajar Ariyatiningsih.</p><p>“Laporan keuangan Jember paling berat ini,” canda Kepala Perwakilan BPK Jawa Timur Joko Agus Setyono. Mengapa demikian? Mantan Kepala Perwakilan BPK Kalimantan Barat itu menambahkan bahwa Jember menjadi beban pikiran dirinya setiap saat. Sebab, dari berbagai arahan BPK, Jember selalu tidak bisa mengikutinya. “Dulu (pemerintah sebelumnya, Red) kami arahkan begini ndak bisa, arahkan begitu juga ndak bisa,” ungkapnya kembali bercanda.</p>', 2, 0, NULL, 1, 13, 1, '2022-12-29 02:29:48', '2022-09-14 10:18:36', '2022-12-29 02:29:48'),
(2, 'Pertama Kali, Pemkab Jember Gelar Pameran Teknologi Konstruks', 'pertama-kali-pemkab-jember-gelar-pameran-teknologi-konstruks', 'uploads/peWK1iAUxzQsHZdAQu40J855WC2RcSTRxHaRDAWe.jpg', '<p>JEMBER, Untuk pertama kalinya dalam sejarah, Pemerintah Kabupaten Jember menggelar pameran teknologi konstruksi, yang bertempat di Balai Serbaguna GOR PKPSO Kaliwates Jember.</p><p>Pameran ini diikuti oleh 30 perusahaan, terdiri dari perusahaan sektor industri konstruksi, properti, pembiayaan, serta perguruan tinggi. Pameran ini berlangsung mulai tanggal 02 – 04 Desember 2022.</p><p>Bupati Jember Hendy Siswanto menyampaikan, dengan adanya pameran ini akan berkembang lagi industri konstruksi di Kabupaten Jember.</p><p>“Kegiatan ini baru pertama kali, selama saya lahir hidup di Jember baru sekarang ini ada, pameran konstruksi ini akan memacu lagi perekonomian sektor konstruksi,” ujar Bupati Jember Hendy Siswanto.</p>', 1, 0, NULL, 1, 95, 1, '2022-12-29 02:29:56', '2022-09-14 10:34:04', '2022-12-29 02:29:56'),
(3, 'sadsdfsdffsd', 'sadsdfsdffsd', 'uploads/tDyI5AsOjeH8OhoiG0FoErU5bi863hfKtBqJZlQj.jpg', 'afafafasf', 2, 0, NULL, 1, 0, 1, '2022-11-29 21:30:11', '2022-11-29 21:29:39', '2022-11-29 21:30:11'),
(4, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit', 'uploads/moMTOy3NpUNd0Ezt3LYpsbrF0y08kX1fpC9v9M4e.jpg', '<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias totam recusandae facilis aliquam porro vero, praesentium ratione assumenda laudantium blanditiis aliquid placeat, qui ea. Porro adipisci iure autem qui consequatur? Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur laboriosam ad quos alias odio eos provident similique voluptatibus, laborum distinctio velit sequi expedita aut delectus sapiente libero omnis repudiandae inventore! Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni molestiae ratione repellendus blanditiis perferendis, id, et tenetur sapiente magnam dicta sed error! Eveniet dolorum itaque, illum dolore ad neque tempora.</p><p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias totam recusandae facilis aliquam porro vero, praesentium ratione assumenda laudantium blanditiis aliquid placeat, qui ea. Porro adipisci iure autem qui consequatur? Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur laboriosam ad quos alias odio eos provident similique voluptatibus, laborum distinctio velit sequi expedita aut delectus sapiente libero omnis repudiandae inventore! Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni molestiae ratione repellendus blanditiis perferendis, id, et tenetur sapiente magnam dicta sed error! Eveniet dolorum itaque, illum dolore ad neque tempora.</p>', 13, 0, NULL, 1, 4, 1, '2022-12-29 02:30:02', '2022-12-15 08:01:28', '2022-12-29 02:30:02'),
(5, 'Porro adipisci iure autem qui consequatur? Lorem ipsum dolor', 'porro-adipisci-iure-autem-qui-consequatur-lorem-ipsum-dolor', 'uploads/OPgqefWh23bDre65vOZ1iO32xxNLemzUcuK10yKU.jpg', '<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias totam recusandae facilis aliquam porro vero, praesentium ratione assumenda laudantium blanditiis aliquid placeat, qui ea. Porro adipisci iure autem qui consequatur? Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur laboriosam ad quos alias odio eos provident similique voluptatibus, laborum distinctio velit sequi expedita aut delectus sapiente libero omnis repudiandae inventore! Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni molestiae ratione repellendus blanditiis perferendis, id, et tenetur sapiente magnam dicta sed error! Eveniet dolorum itaque, illum dolore ad neque tempora.</p><p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias totam recusandae facilis aliquam porro vero, praesentium ratione assumenda laudantium blanditiis aliquid placeat, qui ea. Porro adipisci iure autem qui consequatur? Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur laboriosam ad quos alias odio eos provident similique voluptatibus, laborum distinctio velit sequi expedita aut delectus sapiente libero omnis repudiandae inventore! Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni molestiae ratione repellendus blanditiis perferendis, id, et tenetur sapiente magnam dicta sed error! Eveniet dolorum itaque, illum dolore ad neque tempora.</p>', 14, 0, NULL, 1, 5, 1, '2022-12-29 02:30:06', '2022-12-15 08:08:08', '2022-12-29 02:30:06'),
(6, 'Magni molestiae ratione repellendus blanditiis perferendis', 'magni-molestiae-ratione-repellendus-blanditiis-perferendis', 'uploads/2fnZ0jlExAiC4fADguOi3eEjCJmvbgcJ99x6ZvY2.jpg', '<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias totam recusandae facilis aliquam porro vero, praesentium ratione assumenda laudantium blanditiis aliquid placeat, qui ea. Porro adipisci iure autem qui consequatur? Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur laboriosam ad quos alias odio eos provident similique voluptatibus, laborum distinctio velit sequi expedita aut delectus sapiente libero omnis repudiandae inventore! Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni molestiae ratione repellendus blanditiis perferendis, id, et tenetur sapiente magnam dicta sed error! Eveniet dolorum itaque, illum dolore ad neque tempora.</p><p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias totam recusandae facilis aliquam porro vero, praesentium ratione assumenda laudantium blanditiis aliquid placeat, qui ea. Porro adipisci iure autem qui consequatur? Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur laboriosam ad quos alias odio eos provident similique voluptatibus, laborum distinctio velit sequi expedita aut delectus sapiente libero omnis repudiandae inventore! Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni molestiae ratione repellendus blanditiis perferendis, id, et tenetur sapiente magnam dicta sed error! Eveniet dolorum itaque, illum dolore ad neque tempora.</p>', 30, NULL, NULL, 1, 1, 1, '2022-12-29 02:30:11', '2022-12-16 00:28:13', '2022-12-29 02:30:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `programs`
--

INSERT INTO `programs` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'Pengawasan', 'pengawasan', '2022-12-14 22:43:33', '2022-12-14 22:43:33'),
(6, 'Zona Integritas', 'zona-integritas', '2022-12-15 00:10:46', '2022-12-15 00:10:46'),
(9, 'Saber Pungli', 'saber-pungli', '2022-12-15 08:17:51', '2022-12-15 08:17:59'),
(10, 'Mcp', 'mcp', '2022-12-16 00:51:00', '2022-12-16 00:51:00'),
(11, 'Gratifikasi', 'gratifikasi', '2022-12-19 04:22:17', '2022-12-19 04:22:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `regulasis`
--

CREATE TABLE `regulasis` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `peraturan_id` bigint(20) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `unduh` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `regulasis`
--

INSERT INTO `regulasis` (`id`, `judul`, `peraturan_id`, `keterangan`, `unduh`, `created_at`, `updated_at`) VALUES
(5, 'Ex. Regulasi 2', 5, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias totam recusandae facilis', 'uploads/PuTTOu7yj8802rX3kPz9SywnsxYnGheCKjjkdtdA.pdf', '2022-12-12 22:30:38', '2022-12-19 18:32:52'),
(8, 'Ex. Regulasi 1', 2, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias totam recusandae facilis', 'uploads/cjABHWcEyif3PyHw6BtmdFfoAVFol5e5SDQFgkRz.pdf', '2022-12-15 20:04:20', '2022-12-19 18:32:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sections`
--

INSERT INTO `sections` (`id`, `name`, `slug`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Slider', 'sliders', 1, NULL, '2022-09-13 22:39:28', '2022-11-29 07:53:38'),
(2, 'Tentang Kami', 'about', 1, NULL, '2022-09-13 22:39:28', '2022-09-14 02:47:28'),
(3, 'Link Terkait', 'links', 1, NULL, '2022-09-13 22:39:28', '2022-09-14 02:47:19'),
(4, 'Layanan Kami', 'services', 1, NULL, '2022-09-13 22:39:28', '2022-09-14 02:47:14'),
(5, 'Survey Warga', 'testimonials', 1, NULL, '2022-09-13 22:39:28', '2022-12-11 15:11:16'),
(6, 'Berita PPID', 'ppid', 1, NULL, '2022-09-13 22:39:28', '2022-12-01 08:36:56'),
(7, 'Berita Terbaru', 'posts', 1, NULL, '2022-09-13 22:39:28', '2022-12-01 08:52:02'),
(9, 'Tempat Lokasi', 'lokasi', 1, NULL, '2022-08-08 01:14:12', '2022-11-29 07:53:53'),
(10, 'Poster', 'posters', 1, NULL, NULL, NULL),
(11, 'Hubungi', 'call-to-action', 1, NULL, NULL, '2022-12-12 01:36:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`id`, `name`, `link`, `image`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Test', '/test', 'uploads/vY6I7VY45s18tJ1yrlM45FjEnhml5jFpJeFhI3Iv.jpg', '<div>test</div>', '2022-09-14 02:54:36', '2022-09-14 02:52:53', '2022-09-14 02:54:36'),
(2, 'test2', '/test2', 'uploads/tauP6vHof2QfGNkNaZmC5kZa31MLvM17C70sBsCj.jpg', '<div>test2</div>', '2022-09-14 02:54:43', '2022-09-14 02:53:13', '2022-09-14 02:54:43'),
(3, 'test3', '/test3', 'uploads/UL6KWcPYhH7zqTW9BQUve1l8LYb8tzL6RP4UHnak.jpg', '<div>test3</div>', '2022-09-14 02:54:47', '2022-09-14 02:53:32', '2022-09-14 02:54:47'),
(4, 'test4', '/test4', 'uploads/lH26oS20UXITokBfHSncwbHjMAVwWN0J2QRdIYgE.jpg', '<div>test4</div>', '2022-09-14 02:54:51', '2022-09-14 02:53:47', '2022-09-14 02:54:51'),
(5, 'KOPI-J', '/kopij', 'uploads/djHm1z8zwMoIaaw9sXV8Cun1Bp3O0us3QmIjWDJV.jpg', NULL, NULL, '2022-09-14 09:46:55', '2022-12-21 14:03:51'),
(6, 'Audit', '#', 'uploads/8PvrXql74PeSr0AS6yXIhjTUmmNmIjWeWD7mlnRN.jpg', '<div>Audit</div>', '2022-12-19 02:44:13', '2022-09-14 09:47:17', '2022-12-19 02:44:13'),
(7, 'LHKPN', '/pages/layanan-lhkpn', 'uploads/XUgASSZGuaQzx6GI7VAixyTwxznAn797MIJ6QLyF.jpg', '<div>LHKPN</div>', NULL, '2022-09-14 09:47:36', '2022-12-21 14:02:55'),
(8, 'rwerwtet', '#', 'uploads/Xbh8O5VrocgHgDbt9nojFTuImD9MxHOQpxKd3kVK.jpg', '<div>erterter</div>', '2022-11-29 08:39:43', '2022-11-29 08:39:37', '2022-11-29 08:39:43'),
(9, 'LHKSN', '/pages/layanan-lhksn', 'uploads/SUtmRkLAzTOdq3eBDYewO0S0gyAGY9Z0sjn7Tyuh.jpg', NULL, NULL, '2022-12-19 04:34:52', '2022-12-21 14:03:14'),
(10, 'Surat Keterangan Bebas Temuan', '/pages/layanan-surat-keterangan-bebas-temuan', 'uploads/WaojbbStVvtp9l1WG6do2Tt2O66eNgOjr9djhjWH.jpg', '<div>Surat Keterangan Bebas Temuan</div>', NULL, '2022-12-19 04:35:09', '2022-12-21 14:03:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_company` varchar(255) DEFAULT NULL,
  `main_logo` varchar(255) DEFAULT NULL,
  `sec_logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `telegram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL,
  `map` text DEFAULT NULL,
  `code` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `name`, `name_company`, `main_logo`, `sec_logo`, `favicon`, `description`, `address`, `email`, `telp`, `facebook`, `twitter`, `instagram`, `whatsapp`, `telegram`, `youtube`, `tiktok`, `map`, `code`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Inspektorat Kabupaten Jember', 'Selamat Datang Di Kafe Jogja', 'uploads/lxxRbs4qJaOOs5ZvNVf5l30OQaqHvecRXyODEwaU.png', 'uploads/L2SuhIvqAMyv2VXd1wPKlJCVTNiYaoN8oQYiyOjz.png', 'uploads/eEifaFTQNbIF5t8fJu5ZAVm0P01OzeTg7rxbYBWt.png', 'Bagian Inspektorat Pemerintah Daerah Kabupaten Jember', 'Jalan Sudarman Nomor 1 Jember', 'inspektorat@jemberkab.go.id', '0331428823', '#', '#', '#', '6281234567890', NULL, '#', NULL, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15797.30597395032!2d113.7021741!3d-8.1698247!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3023773e2bf50336!2sInspektorat%20Daerah%20Kabupaten%20Jember!5e0!3m2!1sen!2sid!4v1670812246943!5m2!1sen!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', NULL, NULL, '2022-09-13 22:39:28', '2022-12-21 06:28:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `desktop` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `desktop`, `mobile`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(8, 'Coba', 'uploads/SWmFeOb8J2naazLJe6c7PyeuYrMNHiSQoxwrxfFe.jpg', 'uploads/TZpnESWr5g7KTNm0eay2iFPLZQaFJTzBuQ4PnKF0.jpg', 0, '2022-11-29 06:25:14', '2022-09-14 08:35:11', '2022-11-29 06:25:14'),
(9, 'coba2', 'uploads/b6gRQrnSH2Z9XQkTlUixTFZ6oJRmK0gjrpSPrfBi.jpg', 'uploads/KnGs0XBnHCTiJdO3JZqIeAqOiZQjSSvEI2pk7psu.jpg', 0, '2022-11-29 07:32:32', '2022-09-14 08:35:53', '2022-11-29 07:32:32'),
(10, 'coba3', 'uploads/WmyM8XQpEKWVopa2p7fdBCG7YVDHYcHXnXl8jVVY.jpg', 'uploads/5BUruxeaM9o8ENxF9lSPXT5nnYJ5oPJoVH4tWb3X.jpg', 0, '2022-11-29 07:37:31', '2022-09-21 05:48:01', '2022-11-29 07:37:31'),
(11, 'Slider 3', 'uploads/zdRrd3LiVKSQCpr4YPe9fL264mLTn8oFKUw4BPG2.jpg', 'uploads/VRpoSyVrs0Otyg1hhQaO68WFqonMCsO8p0CVbGXD.jpg', 0, NULL, '2022-11-29 06:24:58', '2022-12-20 05:34:48'),
(12, 'slider2', 'uploads/R27POpdBpYfb6s7QvunDt56bapprNLNNfmh5INy0.jpg', 'uploads/qx1xzONqjVcn72WXhK1M86GKEp8kmyTTh4MnzPMM.jpg', 0, '2022-12-04 03:19:30', '2022-11-30 18:55:05', '2022-12-04 03:19:30'),
(13, 'Slider 2', 'uploads/tjua7NQaGLvkVLfq2XnWRXIaN8MoaoJkTxt9KHzT.jpg', 'uploads/Y7zA975LDrLyHgyyYs4jonCvQdL3rVO7tu5HQnWt.jpg', 0, NULL, '2022-12-04 03:20:18', '2022-12-04 03:20:18'),
(14, 'Slider 1', 'uploads/wjQPlfzTCYkUeTJ8ez3tKdKCCD3rDXxM3h7ezPdE.jpg', 'uploads/Xn6u2sYJBIwwcveDMKd2oD4eR6ZfqLEJTCsP6Ebo.jpg', 0, NULL, '2022-12-04 03:21:08', '2022-12-04 10:01:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `kualifikasi` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `staff`
--

INSERT INTO `staff` (`id`, `nama`, `nip`, `jabatan`, `kualifikasi`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Ratno C. Sembodo, S.H', '197408272005011006', 'Inspektur', '<p>S1 - Ilmu Hukum</p>', 'uploads/tmM7quaTPg6rsOSJNdbUjNth2jVTCoG8CMzq2J0J.jpg', 1, '2022-12-13 07:20:13', '2022-12-29 01:09:19'),
(4, 'Siti Hersoenarsih, S.E., M.M', '196710071997032002', 'Sekretaris', '<p>S2</p>', 'uploads/cTOPUH5os6AMOFOoEyoW8wfLYFedFfC7II1H6xPM.jpg', 1, '2022-12-13 14:38:00', '2022-12-29 01:10:56'),
(5, 'Tombak Pramudya Rosa, SH, Msi', '196506121992031013', 'Inspektur Pembantu Wilayah I', '<p>S-2 /Pascasarjana</p>', NULL, 1, '2022-12-28 10:10:53', '2022-12-28 10:10:53'),
(6, 'Wiwin Puguh Prijono, SH', '196702251992021002', 'Inspektur Pembantu Wilayah II', '<p>S1 - Ilmu Hukum</p>', 'uploads/jZYqm0E3P4PfxqeTt9WH3FKBu8yzG8jRuAcAvFcb.jpg', 1, '2022-12-28 10:17:46', '2022-12-29 01:27:18'),
(7, 'Imam Ridhoi, S Sos., M.Si', '196901141990031005', 'Inspektur Pembantu Wilayah III', '<p>S-2 Ilmu Administrasi</p>', 'uploads/c1VJfSrUI3EpSuPAEbdEcU2tcMsvwW6GLe2Dix7N.jpg', 1, '2022-12-28 10:18:32', '2022-12-29 02:05:23'),
(8, 'Nurindah Kartika, S.Tp', '197604202002122003', 'Inspektur Pembantu Wilayah IV', '<p>S-1 Teknologi Hasil Pertanian</p>', 'uploads/rThYr6p17BF9QG8SD4UVmSA4STdtU4Nv4yLzUFMz.jpg', 1, '2022-12-28 10:19:16', '2022-12-29 03:50:33'),
(9, 'Endrik Wahyu Wijaya, SE', '198112082011011006', 'Perencana Muda', '<p>S-1 Ekonomi Manajemen</p>', NULL, 1, '2022-12-29 01:12:44', '2022-12-29 01:12:44'),
(10, 'Adif Chandra P, S.E', '198712222011011007', 'Ka. Sub. Bag. Administrasi dan Umum', '<p>S-1 Ekonomi Manajemen</p>', 'uploads/xeyI3cNxQ0cY73Yhrqg0ixg83ZjQkiRXwpQ3w2me.jpg', 1, '2022-12-29 01:13:35', '2022-12-29 04:36:50'),
(11, 'Nurie Hadiyatie, SE', '197105072002122006', 'Pengawas Pemerintahan Muda', '<p>S-1 Ekonomi Manajemen</p>', 'uploads/1dGL8xn1WoM2jfrDQUf0FSAW2lYkkJ0VWzhHRFeZ.jpg', 1, '2022-12-29 01:17:23', '2022-12-29 01:17:23'),
(12, 'Dedy Arif Susanto, ST', '198101092010011003', 'Pengawas Penyelenggaraan Urusan Pemerintahan Daerah Ahli Pertama', '<p>S-1 Teknik Sipil</p>', 'uploads/sZdGR2K6QUfkQLzmcwCFwtV40uhEvXZLwLk2f9fm.jpg', 1, '2022-12-29 01:19:51', '2022-12-29 01:19:51'),
(13, 'Indah Dwi Budi Artini, SP', '197312211999012001', 'Pengawas Pemerintahan Madya', '<p>S-1 Pertanian Tanah</p>', 'uploads/KsB59CKPqcSF5OEdVE0x6Jgel4HjYrJgRAzKyk5b.jpg', 1, '2022-12-29 01:23:30', '2022-12-29 01:23:30'),
(14, 'Evy Mustikasari T A, S PSi, M.Si', '197809212002122004', 'Pengawas Pemerintahan Madya', '<p>S-2 Ilmu Manajemen</p>', NULL, 1, '2022-12-29 01:26:56', '2022-12-29 01:26:56'),
(15, 'Rahmat Utomo, S.Sos', '197109171999011001', 'Auditor Muda', '<p>S-1 Administrasi Negara</p>', 'uploads/jyfkTqZFJzllah2wZY1zMmbbeQ9EuAtxjTFN8LBl.jpg', 1, '2022-12-29 01:31:25', '2022-12-29 03:23:31'),
(16, 'Soeci Hatiningsih, SE', '197102162014122002', 'Auditor Pertama', '<p>S-1 Manajemen</p>', 'uploads/kTu7YftK0q38xgK2TOZJPWn4BtXndnQQwbSYD57Y.jpg', 1, '2022-12-29 01:32:48', '2022-12-29 03:24:03'),
(17, 'Ido Tamtomo Raharjo, SE', '197208142014121002', 'Auditor Pertama', '<p>S-1 Manajemen</p>', 'uploads/RrUfCu4ykx6QoYyFe2CxCWBM2JWNiwk2BRwRJunN.jpg', 1, '2022-12-29 01:34:20', '2022-12-29 01:34:20'),
(18, 'Heru Kurniawan, ST.', '198108042011011011', 'Pengawas Pemerintahan Muda', '<p>S-1 Teknik Sipil</p>', 'uploads/z2xZtkrcU8JTJQSDKZOteoO8rpXtj8JLFJP7TPBD.jpg', 1, '2022-12-29 01:35:44', '2022-12-29 04:37:04'),
(19, 'Eko Yulianto, ST.', '197607012009011002', 'Ahli Muda Pengawas Penyelenggaraan Urusan Pemerintah Dearah', '<p>S-1 Teknik Sipil</p>', 'uploads/0mQlGOiedKsyXyYvMG440Jv3nbNjbfXAj7etb7sU.jpg', 1, '2022-12-29 01:37:35', '2022-12-29 01:37:35'),
(20, 'Eny Herawati, S.Sos', '196808031990032004', 'Pengawas Pemerintahan Muda', '<p>S-1 Ilmu Administrasi Negara</p>', 'uploads/BY4iMWYIa56khAfJUQyV0y6ccMViSvA2KNn52Vrb.jpg', 1, '2022-12-29 01:39:43', '2022-12-29 01:39:43'),
(21, 'Cuncun Eka Nurhayat, S.E', '197809122003121006', 'Ahli Pertama - Pengawas Penyelenggaraan Urusan Pemerintah Daerah', '<p>S-1 Manajemen</p>', 'uploads/YNiG6kF6KWuzkFDZMWtODarNgiIruUlJTmQNlCs2.jpg', 1, '2022-12-29 01:41:20', '2022-12-29 01:41:20'),
(22, 'Selvy Sufyany Suseno, S.E.', '198302252005012008', 'Penyusun Program Anggaran dan Pelaporan', '<p>S-1 Program Studi Manajemen</p>', 'uploads/Z1bTDTW5fDmbIMN2ni49X1cIUOGKuHU8GlAcGYvN.jpg', 1, '2022-12-29 01:46:53', '2022-12-29 01:46:53'),
(23, 'Atik Rusfiati, S.E.', '197303252014122002', 'Pengawas Pemerintahan Pertama', '<p>S-1 Manajemen</p>', 'uploads/CiqF58ka2Y2Nkq0ldOeqrVpg8a2CxbgfPmlsfbBT.jpg', 1, '2022-12-29 01:49:23', '2022-12-29 01:49:23'),
(24, 'Sutik Aspiin, S.E', '197702282010011002', 'Pengawas Penyelenggaraan Urusan Pemerintah Daerah Ahli Pertama', '<p>S1 - Manajemen</p>', 'uploads/FOaTjLPE0Y8iwR7yAUjJbgPXXSaKkU9fsrr6Lf4H.jpg', 1, '2022-12-29 01:52:08', '2022-12-29 01:52:08'),
(25, 'Adhitya Wardhana, S.A.P.', '198202152005011006', 'Pengawas Penyelenggaraan Pemerintahan Daerah - Ahli Pertama', '<p>S-1 Administrasi Publik</p>', 'uploads/a4Zb4k1S5vDMlnsz41C8wpWiWvWDEHQNaCgbhSIh.jpg', 1, '2022-12-29 01:53:51', '2022-12-29 01:53:51'),
(26, 'Siti Nurhasanah, SE', '197701202014122002', 'Pengawas Pemerintahan Pertama', '<p>S-1 Manajemen</p>', 'uploads/mjfTakZNwPPqatfnDqrQNp1miyIfr79hNxGCn5hJ.jpg', 1, '2022-12-29 02:07:45', '2022-12-29 02:07:45'),
(27, 'Ninit Dyah Pramarta Siwi,SE, MM', '198511062010012029', 'Penyusun Rencana Pengawasan', '<p>S-2 Manajemen</p>', 'uploads/3PDaEuFRoTuS235XsJz9In2wUNNkhAXD70eJPOSZ.jpg', 1, '2022-12-29 02:09:05', '2022-12-29 02:09:05'),
(28, 'Ahmad Rizqi Arief Fitriadi, A.Md.', '198108102014121003', 'Pengolah Bahan Laporan Hasil Audit', '<p>D-III &nbsp;Jaminan Mutu Pangan</p>', 'uploads/L254byn2oU910nONctq3clsxzoNsS9xNM4mJbxnG.png', 1, '2022-12-29 02:10:23', '2022-12-29 02:10:23'),
(29, 'Ira Puspita Wati, A.Md', '198210122014122005', 'Pengelola Bahan Perencanaan', '<p>D-III Ekonomi Adm Perusahaan</p>', NULL, 1, '2022-12-29 02:11:15', '2022-12-29 02:11:15'),
(30, 'Teguh Imanto', '198111292014121001', 'Pranata Teknologi Informasi Komputer', '<p>SLTA</p>', 'uploads/qA7hQ5vVS50tC5FiHxGh1jWMqHUUSgypiqlrdIkZ.jpg', 1, '2022-12-29 02:15:18', '2022-12-29 02:15:18'),
(31, 'Novie Diah Laraswatie', '198011102014122003', 'Pengadministrasi Sarana dan Prasarana', '<p>SLTA</p>', 'uploads/wL9IeKBgYOAn7ETWPVvGdSvGsWdCU2v8ASgJws8a.jpg', 1, '2022-12-29 02:16:20', '2022-12-29 02:16:20'),
(32, 'Seger Hariono', '198206262014121001', 'Pengadministrasi Perencanaan dan Program', '<p>SLTA</p>', 'uploads/TmaCgdgM4mWovcPTDSxQilmDvwri6NtZM1hCbQH3.jpg', 1, '2022-12-29 02:17:42', '2022-12-29 02:17:42'),
(33, 'Supriyadi', '197201252000101001', 'Pelaksana Sistem Pengendalian Internal', '<p>SLTA</p>', 'uploads/whO2RbDR9t2RyRFZRzgJ9BNCh4Je7ctv1p7uEwVI.jpg', 1, '2022-12-29 02:19:19', '2022-12-29 02:28:02'),
(34, 'Dessy Dwi Hertanti', '197812112010012001', 'Pengadministrasi Pengaduan Publik', '<p>SMU</p>', 'uploads/BwNoL8mYr4C8CffGLHQWlqfcFhPkUouayTnHh0KV.jpg', 1, '2022-12-29 02:20:17', '2022-12-29 02:24:31'),
(35, 'Arista Yuni Prabandari', '198206212014122004', 'Pengelola Keuangan', '<p>SLTA</p>', 'uploads/eRxJUJ7AL43zpvVZUAQMBoQCWrFOzl0atRm130T5.jpg', 1, '2022-12-29 02:25:35', '2022-12-29 02:25:35'),
(36, 'Syahrul Kumani', '198208282014121001', 'Pengadministrasi Keuangan', '<p>SLTA</p>', 'uploads/gOPbeMYREsl4IEJrNq97Ique0nE4rdOwPWVqMidw.jpg', 1, '2022-12-29 02:26:17', '2022-12-29 02:26:17'),
(37, 'Kukuh Ardhyanto Mi\'rad, S.K.M., M.kes', '198604072009031002', 'Ahli Muda - Pengawas Penyelenggaraan Urusan Pemerintahan Daerah', '<p>Megister Kesehatan</p>', 'uploads/jF3BK8j9Iodf5EqNq3anG9CWImEJ85R2IpbIfNUE.jpg', 1, '2022-12-29 03:26:26', '2022-12-29 03:26:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `star` double NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `title`, `star`, `image`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(4, 'Lorem ipsum u', 'rwerwer', 4, 'uploads/lF6vkugMEViKI5wmPHrpsKX3kofwS4Oslbnw9aon.jpg', 'Lorem ipsum is placeholder text commonly used in the graphic,', NULL, '2022-11-29 08:49:19', '2022-12-12 01:05:03'),
(5, 'Lorem ipsum is', 'wqewqewq', 3, 'uploads/qaVN7c6r32TCV7M6SIH1eD67BkKXS62leOggfep3.jpg', 'Lorem ipsum is placeholder text commonly used in the graphic,', NULL, '2022-12-05 01:47:18', '2022-12-12 01:04:38'),
(6, 'Lorem ipsumi', 'erwre', 4.5, 'uploads/7dQlkMQpIRHiHnj5fyFEGHDDhkIo6JGcwj9gpzDP.png', 'Lorem ipsum is placeholder text commonly used in the graphic,', NULL, '2022-12-05 01:57:31', '2022-12-12 01:03:38'),
(8, 'Lorem ipsum', 'Masyarakat', 5, 'uploads/gYXRW9qtIJFCAXPp4Flm3u2zjKIjXwuzSrcKfbTn.jpg', 'Lorem ipsum is placeholder text commonly used in the graphic,', NULL, '2022-12-05 02:16:51', '2022-12-12 01:09:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `hp` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `level_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `hp`, `address`, `password`, `level_id`, `status`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', 'info@anmediacorp.com', '085101698066', 'sdadsd', '$2y$10$FAC7Nxcrz4VTh9qmHmamUOn0D3O4DtDqNcZN8uslVsNC.vlvdsctq', 1, 1, '2022-11-29 03:36:47', 'zcEzi156hNnjp9VZhh9nlsDGS02aPIZwXBpe7bmHHiyRJUNUKR7rzHjij4vb', '2022-11-29 03:36:47', '2022-12-28 03:16:43'),
(2, 'IRBAN I', 'irban1', 'irban1@anmediacorp.com', '082336966714', NULL, '$2y$10$QHS/TVy/VaFDhKhvoGxu5O82aNXfGOL4JZdV./wdl3sayqdKK1ndW', 5, 1, NULL, 'wAkKwjHDXM7XbL7nqbsv82PceU4xmQIbhAGr5OsNnv2hO9jrAnVFH4KcKDbs', '2022-12-28 02:57:13', '2022-12-28 03:31:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `walogs`
--

CREATE TABLE `walogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `is_broadcast` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `walogs`
--

INSERT INTO `walogs` (`id`, `name`, `number`, `message`, `is_broadcast`, `status`, `created_at`, `updated_at`) VALUES
(1, 'LILIK MAKHFIYAH, S.Pd', '081330034153', 'Yth. *LILIK MAKHFIYAH, S.Pd*, terimakasih telah menggunakan layanan *KOPI-J*\n \n *I. PADA:*\n - Nomor: 00001/KOPI-J/211222\n - Hari: Rabu\n - Tanggal: 21\n - Bulan: December\n - Jam: 14:12:36\n \n *II. KONSULTASI:*\n PPID Perumda Perkebunan Kahyangan Kab. Jember\n \n Silahkan klik link berikut untuk melihat detail atau membalas:\n https://inspektorat.anmediacorp.com/kopij?nomor=00001/KOPI-J/211222\n \n Terimakasih. ', 0, 1, '2022-12-21 14:12:36', '2022-12-21 14:12:36'),
(2, 'LILIK MAKHFIYAH, S.Pd', '081330034153', 'Yth. *LILIK MAKHFIYAH, S.Pd*, jawaban atas konsultasi Anda\n \n *I. PADA:*\n - Nomor: 00001/KOPI-J/211222\n - Hari: Rabu\n - Tanggal: 21\n - Bulan: December\n - Jam: 14:12:36\n \n *II. KONSULTASI:*\n PPID Perumda Perkebunan Kahyangan Kab. Jember\n \n *III. JAWABAN:*\n Balasan keluhan Balasan keluhan Balasan keluhan Balasan keluhan Balasan keluhan Balasan keluhan\n \n Silahkan klik link berikut untuk melihat detail atau membalas:\n https://inspektorat.anmediacorp.com/kopij?nomor=00001/KOPI-J/211222\n \n Terimakasih. ', 0, 1, '2022-12-21 14:16:24', '2022-12-21 14:16:24'),
(3, 'Administrator', '081331562304', 'Yth. *Administrator*, jawaban atas konsultasi *KOPI-J*\n \n *I. PADA:*\n - Nomor: 00001/KOPI-J/211222\n - Hari: Rabu\n - Tanggal: 21\n - Bulan: December\n - Jam: 14:12:36\n \n *II. KONSULTASI:*\n PPID Perumda Perkebunan Kahyangan Kab. Jember\n \n *III. JAWABAN:*\n balas 2\n \n Terimakasih.', 0, 1, '2022-12-21 14:17:02', '2022-12-21 14:17:02'),
(4, 'LILIK MAKHFIYAH, S.Pd', '081330034153', 'Yth. *LILIK MAKHFIYAH, S.Pd*, jawaban atas konsultasi Anda\n \n *I. PADA:*\n - Nomor: 00001/KOPI-J/211222\n - Hari: Rabu\n - Tanggal: 21\n - Bulan: December\n - Jam: 14:12:36\n \n *II. KONSULTASI:*\n PPID Perumda Perkebunan Kahyangan Kab. Jember\n \n *III. JAWABAN:*\n jawab 2\n \n Silahkan klik link berikut untuk melihat detail atau membalas:\n https://inspektorat.anmediacorp.com/kopij?nomor=00001/KOPI-J/211222\n \n Terimakasih. ', 0, 1, '2022-12-21 14:17:44', '2022-12-21 14:17:44'),
(5, 'NOVI', '085236699879', 'Yth. *NOVI*, terimakasih telah menggunakan layanan *KOPI-J*\n \n *I. PADA:*\n - Nomor: 00002/KOPI-J/281222\n - Hari: Rabu\n - Tanggal: 28\n - Bulan: December\n - Jam: 03:18:58\n \n *II. KONSULTASI:*\n Judul Konsultasi\n \n Silahkan klik link berikut untuk melihat detail atau membalas:\n https://inspektorat.anmediacorp.com/kopij?nomor=00002/KOPI-J/281222\n \n Terimakasih. ', 0, 1, '2022-12-28 03:18:59', '2022-12-28 03:18:59'),
(6, 'NOVI', '085236699879', 'Yth. *NOVI*, jawaban atas konsultasi Anda\n \n *I. PADA:*\n - Nomor: 00002/KOPI-J/281222\n - Hari: Rabu\n - Tanggal: 28\n - Bulan: December\n - Jam: 03:18:58\n \n *II. KONSULTASI:*\n Judul Konsultasi\n \n *III. JAWABAN:*\n dibalas oelh admin ini isis balasannya  dibalas oelh admin ini isis balasannya  dibalas oelh admin ini isis balasannya  dibalas oelh admin ini isis balasannya  dibalas oelh admin ini isis balasannya  dibalas oelh admin ini isis balasannya  dibalas oelh admin ini isis balasannya\n \n Silahkan klik link berikut untuk melihat detail atau membalas:\n https://inspektorat.anmediacorp.com/kopij?nomor=00002/KOPI-J/281222\n \n Terimakasih. ', 0, 1, '2022-12-28 03:21:40', '2022-12-28 03:21:40'),
(7, 'Administrator', '085101698066', 'Yth. *Administrator*, jawaban atas konsultasi *KOPI-J*\n \n *I. PADA:*\n - Nomor: 00002/KOPI-J/281222\n - Hari: Rabu\n - Tanggal: 28\n - Bulan: December\n - Jam: 03:18:58\n \n *II. KONSULTASI:*\n Judul Konsultasi\n \n *III. JAWABAN:*\n terimakasih sudah di layani terimakasih sudah di layani terimakasih sudah di layani terimakasih sudah di layani terimakasih sudah di layani terimakasih sudah di layani terimakasih sudah di layani\n \n Terimakasih.', 0, 1, '2022-12-28 03:25:27', '2022-12-28 03:25:27'),
(8, 'IRBAN WILAYAH I', '082336966714', 'Hai *IRBAN WILAYAH I* Surat dengan Nomor Surat *234324343*  telah didisposisikan ke bagian anda, segera cek di Front Desk. \nTerimakasih !', 0, 1, '2022-12-28 03:30:46', '2022-12-28 03:30:46');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `call_to_actions`
--
ALTER TABLE `call_to_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `categoriperaturans`
--
ALTER TABLE `categoriperaturans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeks untuk tabel `categorystatuses`
--
ALTER TABLE `categorystatuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categorystatuses_name_unique` (`name`) USING BTREE;

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `desas`
--
ALTER TABLE `desas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `gratifikasis`
--
ALTER TABLE `gratifikasis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `irbans`
--
ALTER TABLE `irbans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `irbans_nama_unique` (`nama`);

--
-- Indeks untuk tabel `irbanwilayahs`
--
ALTER TABLE `irbanwilayahs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kecamatans`
--
ALTER TABLE `kecamatans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kecamatans_name_unique` (`name`);

--
-- Indeks untuk tabel `kopijitems`
--
ALTER TABLE `kopijitems`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kopijs`
--
ALTER TABLE `kopijs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kopijs_nomor_unique` (`nomor`);

--
-- Indeks untuk tabel `laporan_darurats`
--
ALTER TABLE `laporan_darurats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `letters`
--
ALTER TABLE `letters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `letters_unique_nomor` (`nomor`);

--
-- Indeks untuk tabel `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `levels_nama_unique` (`nama`);

--
-- Indeks untuk tabel `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Indeks untuk tabel `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`) USING BTREE,
  ADD UNIQUE KEY `categories_slug_unique` (`slug`) USING BTREE;

--
-- Indeks untuk tabel `regulasis`
--
ALTER TABLE `regulasis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sections_name_unique` (`name`),
  ADD UNIQUE KEY `sections_slug_unique` (`slug`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_name_unique` (`name`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Indeks untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_whatsapp_unique` (`hp`);

--
-- Indeks untuk tabel `walogs`
--
ALTER TABLE `walogs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `call_to_actions`
--
ALTER TABLE `call_to_actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `categoriperaturans`
--
ALTER TABLE `categoriperaturans`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `categorystatuses`
--
ALTER TABLE `categorystatuses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `desas`
--
ALTER TABLE `desas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gratifikasis`
--
ALTER TABLE `gratifikasis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `irbans`
--
ALTER TABLE `irbans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `irbanwilayahs`
--
ALTER TABLE `irbanwilayahs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT untuk tabel `kecamatans`
--
ALTER TABLE `kecamatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `kopijitems`
--
ALTER TABLE `kopijitems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kopijs`
--
ALTER TABLE `kopijs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `laporan_darurats`
--
ALTER TABLE `laporan_darurats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT untuk tabel `letters`
--
ALTER TABLE `letters`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `links`
--
ALTER TABLE `links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `regulasis`
--
ALTER TABLE `regulasis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `walogs`
--
ALTER TABLE `walogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
