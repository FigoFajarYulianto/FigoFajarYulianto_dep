-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jun 2024 pada 06.37
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
-- Database: `apkwp`
--

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
-- Struktur dari tabel `kandidats`
--

CREATE TABLE `kandidats` (
  `id` int(10) UNSIGNED NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kandidats`
--

INSERT INTO `kandidats` (`id`, `siswa_id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 40, 'figo', '2023-06-11 03:26:38', '2023-06-11 03:26:38'),
(2, 41, 'suti', '2023-06-11 03:51:17', '2023-06-11 03:51:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(4, 'Calon Penyidik', '2023-03-13 04:08:19', '2023-03-16 08:23:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriterias`
--

CREATE TABLE `kriterias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `atribut` varchar(255) DEFAULT NULL,
  `bobot` double DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kriterias`
--

INSERT INTO `kriterias` (`id`, `nama`, `atribut`, `bobot`, `keterangan`, `created_at`, `updated_at`) VALUES
(34, 'UUD KUHAP', 'benefit', 5, NULL, '2023-04-01 07:45:10', '2023-04-01 12:37:43'),
(35, 'PENYIDIKAN', 'benefit', 4, NULL, '2023-04-01 07:55:38', '2023-04-01 12:37:57'),
(36, 'PENYELIDIKAN', 'benefit', 4, NULL, '2023-04-01 07:56:30', '2023-04-01 12:38:08'),
(37, 'KOMPUTER', 'benefit', 3, NULL, '2023-04-01 07:57:30', '2023-04-01 12:47:22');

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
(1, 'Administrator', 'abouts.index,abouts.update,callToActions.create,callToActions.destroy,callToActions.edit,callToActions.index,callToActions.store,callToActions.update,categories.destroy,categories.edit,categories.index,categories.show,categories.store,categories.update,kandidats.create,kandidats.destroy,kandidats.edit,kandidats.index,kandidats.show,kandidats.store,kandidats.update,kriterasoals.destroy,kriterasoals.edit,kriterasoals.index,kriterasoals.show,kriterasoals.store,kriterasoals.update,kriterias.create,kriterias.destroy,kriterias.edit,kriterias.index,kriterias.show,kriterias.store,kriterias.update,laporan.index,levels.destroy,levels.edit,levels.index,levels.store,levels.update,links.create,links.destroy,links.edit,links.index,links.store,links.update,menus.destroy,menus.index,menus.show,menus.store,menus.update,nilais.create,nilais.destroy,nilais.edit,nilais.index,nilais.show,nilais.store,nilais.update,pages.create,pages.destroy,pages.edit,pages.index,pages.store,pages.update,paketSoals.dataTable,paketSoals.destroy,paketSoals.edit,paketSoals.show,paketSoals.store,paketSoals.update,posts.create,posts.destroy,posts.edit,posts.index,posts.store,posts.update,profile.index,profile.update,sections.destroy,sections.index,sections.show,sections.store,sections.update,services.create,services.destroy,services.edit,services.index,services.store,services.update,settings.index,settings.update,sliders.create,sliders.destroy,sliders.edit,sliders.index,sliders.store,sliders.update,soals.create,soals.dataTable,soals.destroy,soals.edit,soals.show,soals.store,soals.update,testimonials.create,testimonials.destroy,testimonials.edit,testimonials.index,testimonials.store,testimonials.update,users.create,users.destroy,users.edit,users.index,users.store,users.update', '2022-11-08 02:30:07', '2023-03-11 17:49:54'),
(5, 'Irban', 'front_desk.edit,front_desk.index,front_desk.store', '2022-12-23 11:53:08', '2022-12-23 11:54:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `atribut` enum('benefit','cost') NOT NULL,
  `bobot` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id`, `kode`, `nama`, `atribut`, `bobot`, `created_at`, `updated_at`) VALUES
(10, 'UUD', 'UUD KHUP', 'benefit', 5, '2023-03-13 10:18:35', '2023-03-14 02:05:16'),
(11, 'PNK', 'PENYIDIKAN', 'benefit', 4, '2023-03-13 10:18:59', '2023-03-14 02:05:03'),
(12, 'PNL', 'PENYELIDIKAN', 'benefit', 4, '2023-03-13 10:19:26', '2023-03-14 02:05:26'),
(13, 'KOM', 'KOMPUTER', 'cost', 3, '2023-03-13 10:19:59', '2023-03-14 02:05:33');

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_09_25_061849_create_pengaturan_table', 1),
(6, '2021_09_25_173314_create_kelas_table', 1),
(7, '2021_09_25_173327_create_rombel_table', 1),
(8, '2021_09_25_173339_create_siswa_table', 1),
(9, '2021_09_25_173815_create_mapel_table', 1),
(10, '2021_09_28_013905_create_paket_soal_table', 1),
(11, '2021_09_28_050717_create_soal_table', 1),
(12, '2021_09_28_050739_create_soal_pilihan_table', 1),
(13, '2021_10_20_091210_create_ujian_table', 1),
(14, '2021_10_30_165624_create_ujian_siswa_table', 1),
(15, '2021_11_01_111826_create_ujian_hasil_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id` int(10) UNSIGNED NOT NULL,
  `ujian_siswa_id` int(11) DEFAULT NULL,
  `kriteria_id` int(11) DEFAULT NULL,
  `kandidat_id` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id`, `ujian_siswa_id`, `kriteria_id`, `kandidat_id`, `nilai`, `created_at`, `updated_at`) VALUES
(1, 96, 34, 1, 60, '2023-06-11 03:29:50', '2023-06-11 03:29:50'),
(2, 97, 35, 1, 80, '2023-06-11 03:32:18', '2023-06-11 03:32:18'),
(3, 98, 36, 1, 100, '2023-06-11 03:33:57', '2023-06-11 03:33:57'),
(4, 99, 37, 1, 80, '2023-06-11 03:34:58', '2023-06-11 03:34:58'),
(5, 100, 34, 2, 60, '2023-06-11 03:53:14', '2023-06-11 03:53:14'),
(6, 101, 35, 2, 40, '2023-06-11 03:54:42', '2023-06-11 03:54:42'),
(7, 102, 36, 2, 60, '2023-06-11 03:55:45', '2023-06-11 03:55:45'),
(8, 103, 37, 2, 60, '2023-06-11 03:57:05', '2023-06-11 03:57:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_soal`
--

CREATE TABLE `paket_soal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `mapel_id` bigint(20) UNSIGNED NOT NULL,
  `kode_paket` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `paket_soal`
--

INSERT INTO `paket_soal` (`id`, `kelas_id`, `mapel_id`, `kode_paket`, `nama`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, 4, 10, 'UUD', 'UUD', 'UDD', '2023-03-13 10:30:37', '2023-03-25 07:51:10'),
(4, 4, 11, 'PNK', 'PENYIDIKAN', 'PENYIDIKAN', '2023-03-14 08:06:07', '2023-04-01 01:07:48'),
(5, 4, 13, 'KOM', 'KOMPUTER', 'KOMPUTER', '2023-03-14 08:56:02', '2023-03-14 08:56:02'),
(6, 4, 12, 'PENYELIDIKAN', 'PENYELIDIKAN', 'PENYELIDIKAN', '2023-03-17 02:52:10', '2023-03-17 02:52:10');

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
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_institusi` varchar(255) NOT NULL,
  `tagline` varchar(255) NOT NULL,
  `logo` text DEFAULT NULL,
  `slug_admin` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `nama_institusi`, `tagline`, `logo`, `slug_admin`, `created_at`, `updated_at`) VALUES
(1, 'SPKP TUGU', 'Lorem ipsum dolor sit amet', 'logo/sSPQWyK0mMs0AouHj7dyCkcDlWZq9ZHbEg86XxkR.png', 'admin', '2023-03-08 11:01:59', '2023-03-29 04:27:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap_kandidat`
--

CREATE TABLE `rekap_kandidat` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `periode` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekap_kandidat`
--

INSERT INTO `rekap_kandidat` (`id`, `siswa_id`, `nama`, `periode`, `created_at`, `updated_at`) VALUES
(1, 40, 'figo', '2023', '2023-06-11 03:26:38', '2023-06-11 03:26:38'),
(2, 41, 'suti', '2023', '2023-06-11 03:51:17', '2023-06-11 03:51:17'),
(21, 34, 'Kuwat Gianto', '2023', '2023-06-11 02:14:34', '2023-03-31 17:59:20'),
(22, 35, 'Abdul Muntholib', '2023', '2023-06-11 02:14:37', '2023-04-01 00:46:42'),
(23, 36, 'Masduki', '2023', '2023-06-11 02:14:40', '2023-04-01 00:47:42'),
(24, 37, 'Kukuh Yudi Wiyono', '2023', '2023-06-11 02:14:42', '2023-04-01 00:48:48'),
(25, 38, 'Imam Mahdi', '2023', '2023-06-11 02:14:45', '2023-04-01 00:49:42'),
(26, 39, 'Andriono Susanto', '2024', '2023-06-11 02:14:48', '2023-04-01 00:52:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap_nilai`
--

CREATE TABLE `rekap_nilai` (
  `id` int(10) UNSIGNED NOT NULL,
  `ujian_siswa_id` int(11) DEFAULT NULL,
  `kriteria_id` int(11) DEFAULT NULL,
  `kandidat_id` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rekap_nilai`
--

INSERT INTO `rekap_nilai` (`id`, `ujian_siswa_id`, `kriteria_id`, `kandidat_id`, `nilai`, `created_at`, `updated_at`) VALUES
(1, 96, 34, 1, 60, '2023-06-11 03:29:50', '2023-06-11 03:29:50'),
(2, 97, 35, 1, 80, '2023-06-11 03:32:18', '2023-06-11 03:32:18'),
(3, 98, 36, 1, 100, '2023-06-11 03:33:57', '2023-06-11 03:33:57'),
(4, 99, 37, 1, 80, '2023-06-11 03:34:58', '2023-06-11 03:34:58'),
(5, 100, 34, 2, 60, '2023-06-11 03:53:14', '2023-06-11 03:53:14'),
(6, 101, 35, 2, 40, '2023-06-11 03:54:42', '2023-06-11 03:54:42'),
(7, 102, 36, 2, 60, '2023-06-11 03:55:45', '2023-06-11 03:55:45'),
(8, 103, 37, 2, 60, '2023-06-11 03:57:05', '2023-06-11 03:57:05'),
(75, 72, 34, 21, 80, '2023-04-01 01:13:21', '2023-04-01 01:13:21'),
(76, 73, 35, 21, 100, '2023-04-01 01:25:07', '2023-04-01 01:25:07'),
(77, 74, 36, 21, 100, '2023-04-01 01:31:45', '2023-04-01 01:31:45'),
(78, 75, 37, 21, 100, '2023-04-01 01:33:17', '2023-04-01 01:33:17'),
(79, 76, 34, 22, 80, '2023-04-01 04:07:01', '2023-04-01 04:07:01'),
(80, 77, 35, 22, 100, '2023-04-01 04:15:29', '2023-04-01 04:15:29'),
(81, 78, 36, 22, 80, '2023-04-01 04:17:20', '2023-04-01 04:17:20'),
(82, 79, 37, 22, 60, '2023-04-01 04:18:53', '2023-04-01 04:18:53'),
(83, 80, 34, 23, 100, '2023-04-01 04:22:17', '2023-04-01 04:22:17'),
(84, 81, 35, 23, 100, '2023-04-01 04:24:15', '2023-04-01 04:24:15'),
(85, 82, 36, 23, 80, '2023-04-01 04:25:40', '2023-04-01 04:25:40'),
(86, 83, 37, 23, 80, '2023-04-01 04:27:03', '2023-04-01 04:27:03'),
(87, 84, 34, 24, 80, '2023-04-01 04:32:05', '2023-04-01 04:32:05'),
(88, 85, 35, 24, 80, '2023-04-01 04:33:57', '2023-04-01 04:33:57'),
(89, 86, 36, 24, 80, '2023-04-01 04:34:49', '2023-04-01 04:34:49'),
(90, 87, 37, 24, 80, '2023-04-01 04:35:52', '2023-04-01 04:35:52'),
(91, 88, 34, 25, 100, '2023-04-01 04:37:33', '2023-04-01 04:37:33'),
(92, 89, 35, 25, 100, '2023-04-01 04:38:40', '2023-04-01 04:38:40'),
(93, 90, 36, 25, 100, '2023-04-01 04:39:48', '2023-04-01 04:39:48'),
(94, 91, 37, 25, 60, '2023-04-01 04:41:19', '2023-04-01 04:41:19'),
(95, 92, 34, 26, 100, '2023-04-01 05:34:02', '2023-04-01 05:34:02'),
(96, 93, 35, 26, 80, '2023-04-01 05:34:56', '2023-04-01 05:34:56'),
(97, 94, 36, 26, 100, '2023-04-01 05:36:07', '2023-04-01 05:36:07'),
(98, 95, 37, 26, 60, '2023-04-01 05:37:16', '2023-04-01 05:37:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayats`
--

CREATE TABLE `riwayats` (
  `id` int(11) UNSIGNED NOT NULL,
  `ujian_siswa_id` int(11) DEFAULT NULL,
  `kriteria_id` int(11) DEFAULT NULL,
  `kandidat_id` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rombel`
--

CREATE TABLE `rombel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rombel`
--

INSERT INTO `rombel` (`id`, `kelas_id`, `nama`, `created_at`, `updated_at`) VALUES
(10, 4, 'PENYIDIK', '2023-03-13 04:08:34', '2023-03-13 04:08:34');

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
(1, 'SPKP', NULL, 'uploads/W9lWztuEPiq35jqWCZtD811w1xq5ZvQpHfKs9VMB.png', 'uploads/HPJDdFSixkg9MPRmYTLEHn4qubgUJpEHZnKyIMkG.png', 'uploads/H8CSEfk3Q33y2k4doFTjYDEPOTqG7fpyVi6YtcvV.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-21 18:34:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rombel_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `nis` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `jk` enum('L','P') NOT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id`, `rombel_id`, `nama`, `tanggal_lahir`, `nis`, `password`, `jenis_kelamin`, `foto`, `jk`, `telp`, `alamat`, `created_at`, `updated_at`) VALUES
(34, 10, 'Kuwat Gianto', NULL, '100001', '$2y$10$Ql6WO6lEGroMAYImdoqrLuA6J.hB9neDun3lwz2UuP1eOSkKN5jKW', 'L', NULL, 'L', NULL, NULL, '2023-04-01 00:59:20', '2023-04-01 00:59:30'),
(35, 10, 'Abdul Muntholib', NULL, '100002', '$2y$10$7dMUjI02n5hCy53VjWf6iO/9ItU5vHaVSku3J5pwhpyzFPR585SOi', 'L', NULL, 'L', NULL, NULL, '2023-04-01 07:46:42', '2023-04-01 07:46:53'),
(36, 10, 'Masduki', NULL, '100003', '$2y$10$EbV74Otr96nW0rHckX.eWOA3I18bKUtBu6X9t9snLcXMPX1nKAqta', 'L', NULL, 'L', NULL, NULL, '2023-04-01 07:47:42', '2023-04-01 07:47:51'),
(37, 10, 'Kukuh Yudi Wiyono', NULL, '100004', '$2y$10$O/dnAwuqtQvK/Q7uM96AWOsMqC60kEv.emXcrsXZCmwPowo75PbI2', 'L', NULL, 'L', NULL, NULL, '2023-04-01 07:48:48', '2023-04-01 07:48:56'),
(38, 10, 'Imam Mahdi', NULL, '100005', '$2y$10$Q0qOAuWb.RvjWRd010qOtef5vP9AbbiHh33cgpdvP9Gb2iZSzkO7m', 'L', NULL, 'L', NULL, NULL, '2023-04-01 07:49:42', '2023-04-01 07:49:50'),
(39, 10, 'Andriono Susanto', NULL, '100006', '$2y$10$VNIC/DC9GGnFjGOifSXczet9BzKeGn4WdE.jO1qozUFn1Gx8fCUaa', 'L', NULL, 'L', NULL, NULL, '2023-04-01 07:52:51', '2023-04-01 07:53:01'),
(40, 10, 'figo', NULL, '100007', '$2y$10$BqpghSgCaO/V4hjjcWpTduhO5yKNnaM8/dxl1R/dpwRWLD4zJ2n3O', 'L', NULL, 'L', NULL, NULL, '2023-06-11 03:26:38', '2023-06-11 03:26:48'),
(41, 10, 'suti', NULL, '100008', '$2y$10$DgkxIxFMOqgIKorR0aLGlOrYovzHaDNgR51rafXAZsBs7fUoqLPku', 'L', NULL, 'L', NULL, NULL, '2023-06-11 03:51:17', '2023-06-11 03:51:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paket_soal_id` bigint(20) UNSIGNED NOT NULL,
  `jenis` enum('pilihan_ganda','essai') NOT NULL,
  `pertanyaan` text NOT NULL,
  `media` text DEFAULT NULL,
  `ulang_media` int(11) NOT NULL DEFAULT 1 COMMENT 'putar ulang media',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `soal`
--

INSERT INTO `soal` (`id`, `paket_soal_id`, `jenis`, `pertanyaan`, `media`, `ulang_media`, `created_at`, `updated_at`) VALUES
(18, 3, 'pilihan_ganda', '<p>Undang-undang yang mengatur hukum acara pidana adalah...............</p>', NULL, 1, '2023-04-01 02:14:34', '2023-04-01 02:14:34'),
(19, 3, 'pilihan_ganda', '<p>Yang dimaksud dengan istilah tertangkap tangan (opheerterdaad) menurut KUHP adalah.........</p>', NULL, 1, '2023-04-01 02:34:17', '2023-04-01 02:34:17'),
(20, 3, 'pilihan_ganda', 'Saat ini ketentuan mengenai Advokat diatur dalam undang-undang nomor........', NULL, 1, '2023-04-01 02:57:20', '2023-04-01 02:57:20'),
(21, 3, 'pilihan_ganda', '<p><span style=\"color: rgb(0, 0, 0);\">Penasehat hukum berhak menghubungi tersangka sejak saat ditangkap atau ditahan. Dalam pasal berapa hal ini diatur KUHAP</span><br></p>', NULL, 1, '2023-04-01 03:07:26', '2023-04-01 03:07:26'),
(22, 3, 'pilihan_ganda', 'Suatu keadaan diri yang menyebabkan penghapusan, pengurangan atau penambahan hukumannya hanya boleh dipertimbangkan terhadap yang mengenai diri orang yang melakukan perbuatan itu atau diri si pembantu saja. hal tersebut merupakan ketentuan KUHP yang terdapat pada Pasal ...', NULL, 1, '2023-04-01 03:18:12', '2023-04-01 03:18:12'),
(23, 4, 'pilihan_ganda', '<p>Penyidik dapat menahan tersangka tanpa perpanjangan paling lama.........</p>', NULL, 1, '2023-04-01 03:43:12', '2023-04-01 03:43:12'),
(24, 4, 'pilihan_ganda', 'Berapa lama waktu diperlukan bagi penyidik untuk menentukan sikap apakah seorang tersangka yang ditangkap, akan diteruskan dengan penahanan atau tidak........', NULL, 1, '2023-04-01 03:46:34', '2023-04-01 03:46:34'),
(25, 4, 'pilihan_ganda', 'Penyidik telah selesai menyidik suatu perkara selanjutnya berkas perkara diserahkan kepada..........', NULL, 1, '2023-04-01 04:01:10', '2023-04-01 04:01:10'),
(26, 4, 'pilihan_ganda', 'Dalam hal penyidikan sudah dianggap selesai penyidik menyerahkan..........', NULL, 1, '2023-04-01 04:13:25', '2023-04-01 04:13:25'),
(27, 4, 'pilihan_ganda', 'Peran penasehat hukum, mendampingi tersangka pada pemeriksaan penyidikan adalah........', NULL, 1, '2023-04-01 04:24:05', '2023-04-01 04:24:05'),
(28, 6, 'pilihan_ganda', '<p>Pasal 1 angka 4 KUHAP menyatakan bahwa penyelidik adalah pejabat polisi negara Republik Indonesia yang diberi wewenang oleh Undang-undang ini untuk melakukan ....<br></p>', NULL, 1, '2023-04-01 07:02:20', '2023-04-01 07:02:20'),
(29, 6, 'pilihan_ganda', 'Berapa hari paling lama penangkapan terhadap seorang yang diduga keras melakukan tindak pidana berdasarkan bukti permulaan yang cukup?<br>', NULL, 1, '2023-04-01 07:07:33', '2023-04-01 07:07:33'),
(30, 6, 'pilihan_ganda', '<span style=\"color: rgb(87, 87, 87); font-family: Roboto, Arial, sans-serif; font-size: 16px;\">Dalam hukum pidana untuk dapat di pidana tidaknya seseorang selain harus memenuhi unsur actus reus selain itu juga orang tersebut juga harus…..</span>', NULL, 1, '2023-04-01 07:08:40', '2023-04-01 07:08:40'),
(31, 6, 'pilihan_ganda', '<span style=\"color: rgb(87, 87, 87); font-family: Roboto, Arial, sans-serif; font-size: 16px;\">Penderitaan yang sengaja diberikan oleh negara pada seseorang atau beberapa orang sebagai akibat atas perbuatan-perbuatan yang mana menurut aturah hukum pidana adalah perbuatan yang dilarang, penderitaan tersebut diberikan oleh lembaga negara yang diberikan wewenang untuk memberikan penderitaan, hal merupakan unsur-unsur perngertian dari</span>', NULL, 1, '2023-04-01 07:11:16', '2023-04-01 07:11:16'),
(32, 6, 'pilihan_ganda', 'Yang dapat dijadikan alasan penangguhan penahanan, kecuali..............', NULL, 1, '2023-04-01 07:23:24', '2023-04-01 07:23:24'),
(33, 5, 'pilihan_ganda', '<p>Perhatikan urutan langkah membuat folder dibawah ini !\r\n</p><p>1. Klik file\r\n</p><p>2. Pilih New – klik folder </p><p>\r\n3. Pastikan dimana folder akan disimpan\r\n</p><p>4. Ketik nama folder\r\n</p><p>Urutan yang tepat adalah …..<br></p>', NULL, 1, '2023-04-01 07:32:02', '2023-04-01 07:32:02'),
(34, 5, 'pilihan_ganda', '<p>Perhatikan langkah mengcopy folder dibawah ini\r\n</p><p>1. Klik/ tandai folder yang akan dicopy\r\n</p><p>2. Klik kanan mouse\r\n</p><p>3. Klik copy\r\n</p><p>4. Tentukan alamat dimana salinan folder akan disimpan\r\n</p><p>5. Klik kanan mouse\r\n</p><p>6. Klik paste\r\n</p><p>Urutan yang tepat adalah …</p>', NULL, 1, '2023-04-01 07:35:06', '2023-04-01 07:35:06'),
(35, 5, 'pilihan_ganda', 'Di bawah ini yang termasuk program pengolah kata adalah .....&nbsp;', NULL, 1, '2023-04-01 07:36:36', '2023-04-01 07:36:36'),
(36, 5, 'pilihan_ganda', 'Untuk mencari kata/ kalimat/ paragraph kita dapat menggunakan icon …..', NULL, 1, '2023-04-01 07:38:28', '2023-04-01 07:38:28'),
(37, 5, 'pilihan_ganda', 'Dalam penulisan rumus pada Ms Excel harus diawali dengan tanda......', NULL, 1, '2023-04-01 07:40:28', '2023-04-01 07:40:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_pilihan`
--

CREATE TABLE `soal_pilihan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `soal_id` bigint(20) UNSIGNED NOT NULL,
  `jawaban` text NOT NULL,
  `media` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `soal_pilihan`
--

INSERT INTO `soal_pilihan` (`id`, `soal_id`, `jawaban`, `media`, `status`, `created_at`, `updated_at`) VALUES
(69, 18, '<p>UU No. 18 Tahun 1981</p>', NULL, 0, '2023-04-01 02:14:34', '2023-04-01 02:14:34'),
(70, 18, '<p>UU No. 15 Tahun 1991<br></p>', NULL, 0, '2023-04-01 02:14:34', '2023-04-01 02:14:34'),
(71, 18, '<p>UU No. 8 Tahun 1981<br></p>', NULL, 1, '2023-04-01 02:14:34', '2023-04-01 02:14:34'),
(72, 18, '<p>UU No. 5 Tahun 1985<br></p>', NULL, 0, '2023-04-01 02:14:34', '2023-04-01 02:14:34'),
(73, 19, '<p>Tertangkapnya seseorang pada waktu sedang melakukan kejahatan</p>', NULL, 0, '2023-04-01 02:34:17', '2023-04-01 02:34:17'),
(74, 19, '<p>Tertangkapnya seseorang beberapa saat sesudah ia melakukan kejahatan<br></p>', NULL, 0, '2023-04-01 02:34:17', '2023-04-01 02:34:17'),
(75, 19, '<p>Jawaban A dan B benar</p>', NULL, 1, '2023-04-01 02:34:17', '2023-04-01 02:34:17'),
(76, 19, '<p>Jawaban A dan B salah<br></p>', NULL, 0, '2023-04-01 02:34:17', '2023-04-01 02:34:17'),
(77, 20, '<p>undang-undang nomor 8 tahun 2002</p>', NULL, 0, '2023-04-01 02:57:20', '2023-04-01 02:57:20'),
(78, 20, '<p>undang-undang nomor 8 tahun 2003<br></p>', NULL, 0, '2023-04-01 02:57:20', '2023-04-01 02:57:20'),
(79, 20, '<p>undang-undang nomor 18 tahun 2002<br></p>', NULL, 0, '2023-04-01 02:57:20', '2023-04-01 02:57:20'),
(80, 20, '<p>undang-undang nomor 18 tahun 2003<br></p>', NULL, 1, '2023-04-01 02:57:20', '2023-04-01 02:57:20'),
(81, 21, '<p>Pasal 20 KUHAP</p>', NULL, 0, '2023-04-01 03:07:26', '2023-04-01 03:07:26'),
(82, 21, '<p>Pasal 69 KUHAP</p>', NULL, 1, '2023-04-01 03:07:26', '2023-04-01 03:07:26'),
(83, 21, '<p>Pasal 197 KUHAP</p>', NULL, 0, '2023-04-01 03:07:26', '2023-04-01 03:07:26'),
(84, 21, '<p>Pasal 244 KUHAP</p>', NULL, 0, '2023-04-01 03:07:26', '2023-04-01 03:07:26'),
(85, 22, '<p><span style=\"color: rgb(87, 87, 87); font-family: Roboto, Arial, sans-serif; font-size: 16px;\">57</span><br></p>', NULL, 0, '2023-04-01 03:18:12', '2023-04-01 03:18:12'),
(86, 22, '<p><span style=\"color: rgb(87, 87, 87); font-family: Roboto, Arial, sans-serif; font-size: 16px;\">58</span><br></p>', NULL, 1, '2023-04-01 03:18:12', '2023-04-01 03:18:12'),
(87, 22, '<p><span style=\"color: rgb(87, 87, 87); font-family: Roboto, Arial, sans-serif; font-size: 16px;\">59</span><br></p>', NULL, 0, '2023-04-01 03:18:12', '2023-04-01 03:18:12'),
(88, 22, '<p>60</p>', NULL, 0, '2023-04-01 03:18:12', '2023-04-01 03:18:12'),
(89, 23, '<p>20 Hari</p>', NULL, 1, '2023-04-01 03:43:12', '2023-04-01 03:43:12'),
(90, 23, '<p>30 Hari</p>', NULL, 0, '2023-04-01 03:43:12', '2023-04-01 03:43:12'),
(91, 23, '<p>60 Hari</p>', NULL, 0, '2023-04-01 03:43:12', '2023-04-01 03:43:12'),
(92, 23, '<p>90 Hari</p>', NULL, 0, '2023-04-01 03:43:12', '2023-04-01 03:43:12'),
(93, 24, '<p>2 hari</p>', NULL, 0, '2023-04-01 03:46:34', '2023-04-01 03:46:34'),
(94, 24, '<p>1 hari</p>', NULL, 1, '2023-04-01 03:46:34', '2023-04-01 03:46:34'),
(95, 24, '<p>1 minggu</p>', NULL, 0, '2023-04-01 03:46:34', '2023-04-01 03:46:34'),
(96, 24, '<p>2 minggu</p>', NULL, 0, '2023-04-01 03:46:34', '2023-04-01 03:46:34'),
(97, 25, '<p>Pengadilan negeri</p>', NULL, 0, '2023-04-01 04:01:10', '2023-04-01 04:01:10'),
(98, 25, '<p>Tersangka</p>', NULL, 0, '2023-04-01 04:01:10', '2023-04-01 04:01:10'),
(99, 25, '<p>Kejaksaan/penuntut umum</p>', NULL, 1, '2023-04-01 04:01:10', '2023-04-01 04:01:10'),
(100, 25, '<p>Menunggu keputusan pengadilan</p>', NULL, 0, '2023-04-01 04:01:10', '2023-04-01 04:01:10'),
(101, 26, '<p>Tersangka</p>', NULL, 0, '2023-04-01 04:13:25', '2023-04-01 04:13:25'),
(102, 26, '<p>Tanggung jawab tersangka dan barang bukti kepada kejaksaan/penuntut umum</p>', NULL, 1, '2023-04-01 04:13:25', '2023-04-01 04:13:25'),
(103, 26, '<p>Barang bukti</p>', NULL, 0, '2023-04-01 04:13:25', '2023-04-01 04:13:25'),
(104, 26, '<p>Menunggu keputusan jaksa penuntut umum</p>', NULL, 0, '2023-04-01 04:13:25', '2023-04-01 04:13:25'),
(105, 27, '<p>Ikut menentukan jalannya pemeriksaan</p>', NULL, 0, '2023-04-01 04:24:05', '2023-04-01 04:24:05'),
(106, 27, '<p>Bekerjasama dengan penyidik</p>', NULL, 0, '2023-04-01 04:24:05', '2023-04-01 04:24:05'),
(107, 27, '<p>Melihat dan mendengar jalannya pemeriksaan</p>', NULL, 1, '2023-04-01 04:24:05', '2023-04-01 04:24:05'),
(108, 27, '<p>Memberikan jawaban kepada penyidik</p>', NULL, 0, '2023-04-01 04:24:05', '2023-04-01 04:24:05'),
(109, 28, '<p>Penuntutan</p>', NULL, 0, '2023-04-01 07:02:20', '2023-04-01 07:02:20'),
(110, 28, '<p>Pemeriksaan</p>', NULL, 0, '2023-04-01 07:02:20', '2023-04-01 07:02:20'),
(111, 28, '<p>Penyelidikan</p>', NULL, 1, '2023-04-01 07:02:20', '2023-04-01 07:02:20'),
(112, 28, '<p>Penyidikan</p>', NULL, 0, '2023-04-01 07:02:20', '2023-04-01 07:02:20'),
(113, 29, '<p>4</p>', NULL, 0, '2023-04-01 07:07:33', '2023-04-01 07:07:33'),
(114, 29, '<p>3</p>', NULL, 0, '2023-04-01 07:07:33', '2023-04-01 07:07:33'),
(115, 29, '<p>2</p>', NULL, 0, '2023-04-01 07:07:33', '2023-04-01 07:07:33'),
(116, 29, '<p>1</p>', NULL, 1, '2023-04-01 07:07:33', '2023-04-01 07:07:33'),
(117, 30, '<p><span style=\"color: rgb(87, 87, 87); font-family: Roboto, Arial, sans-serif; font-size: 16px;\">Berada di luar negeri</span><br></p>', NULL, 0, '2023-04-01 07:08:40', '2023-04-01 07:08:40'),
(118, 30, '<p><span style=\"color: rgb(87, 87, 87); font-family: Roboto, Arial, sans-serif; font-size: 16px;\">Dapat bertanggung jawab (means rea)</span><br></p>', NULL, 1, '2023-04-01 07:08:40', '2023-04-01 07:08:40'),
(119, 30, '<p><span style=\"color: rgb(87, 87, 87); font-family: Roboto, Arial, sans-serif; font-size: 16px;\">Terdapat rasa bersalahnya</span><br></p>', NULL, 0, '2023-04-01 07:08:40', '2023-04-01 07:08:40'),
(120, 30, '<p><span style=\"color: rgb(87, 87, 87); font-family: Roboto, Arial, sans-serif; font-size: 16px;\">Warga negara Indonesia</span><br></p>', NULL, 0, '2023-04-01 07:08:40', '2023-04-01 07:08:40'),
(121, 31, '<p><span style=\"color: rgb(87, 87, 87); font-family: Roboto, Arial, sans-serif; font-size: 16px;\">&nbsp;Hukum pidana formil</span><br></p>', NULL, 0, '2023-04-01 07:11:16', '2023-04-01 07:11:16'),
(122, 31, '<p><span style=\"color: rgb(87, 87, 87); font-family: Roboto, Arial, sans-serif; font-size: 16px;\">&nbsp;Hukum pidana materiel</span><br></p>', NULL, 0, '2023-04-01 07:11:16', '2023-04-01 07:11:16'),
(123, 31, '<p><span style=\"color: rgb(87, 87, 87); font-family: Roboto, Arial, sans-serif; font-size: 16px;\">Hukum pidana</span><br></p>', NULL, 0, '2023-04-01 07:11:16', '2023-04-01 07:11:16'),
(124, 31, '<p><span style=\"color: rgb(87, 87, 87); font-family: Roboto, Arial, sans-serif; font-size: 16px;\">Pidana</span><br></p>', NULL, 1, '2023-04-01 07:11:16', '2023-04-01 07:11:16'),
(125, 32, '<p>Tidak akan menghilangkan barang bukti</p>', NULL, 0, '2023-04-01 07:23:25', '2023-04-01 07:23:25'),
(126, 32, '<p>Tidak akan melarikan diri</p>', NULL, 0, '2023-04-01 07:23:25', '2023-04-01 07:23:25'),
(127, 32, '<p>Tidak akan mengulangi lagi tindak pidana</p>', NULL, 0, '2023-04-01 07:23:25', '2023-04-01 07:23:25'),
(128, 32, '<p>Atas permintaan keluarga terdakwa</p>', NULL, 1, '2023-04-01 07:23:25', '2023-04-01 07:23:25'),
(129, 33, '<p>1-2-3-4<br></p>', NULL, 0, '2023-04-01 07:32:02', '2023-04-01 07:32:02'),
(130, 33, '<p>2-1-3-4<br></p>', NULL, 0, '2023-04-01 07:32:02', '2023-04-01 07:32:02'),
(131, 33, '<p>3-1-2-4<br></p>', NULL, 1, '2023-04-01 07:32:02', '2023-04-01 07:32:02'),
(132, 33, '<p>1-3-2-4<br></p>', NULL, 0, '2023-04-01 07:32:02', '2023-04-01 07:32:02'),
(133, 34, '<p>1-2-3-4-5-6<br></p>', NULL, 1, '2023-04-01 07:35:06', '2023-04-01 07:35:06'),
(134, 34, '<p>4-1-2-3-5-6<br></p>', NULL, 0, '2023-04-01 07:35:06', '2023-04-01 07:35:06'),
(135, 34, '<p>5-1-2-3-4-6<br></p>', NULL, 0, '2023-04-01 07:35:06', '2023-04-01 07:35:06'),
(136, 34, '<p>2-1-3-4-5-6<br></p>', NULL, 0, '2023-04-01 07:35:06', '2023-04-01 07:35:06'),
(137, 35, '<p>Microsoft Word<br></p>', NULL, 1, '2023-04-01 07:36:36', '2023-04-01 07:36:36'),
(138, 35, '<p>Microsoft Excel<br></p>', NULL, 0, '2023-04-01 07:36:36', '2023-04-01 07:36:36'),
(139, 35, '<p>Photoshop&nbsp;<br></p>', NULL, 0, '2023-04-01 07:36:36', '2023-04-01 07:36:36'),
(140, 35, '<p>CorellDraw<br></p>', NULL, 0, '2023-04-01 07:36:36', '2023-04-01 07:36:36'),
(141, 36, '<p>Find<br></p>', NULL, 1, '2023-04-01 07:38:28', '2023-04-01 07:38:28'),
(142, 36, '<p>Replace<br></p>', NULL, 0, '2023-04-01 07:38:28', '2023-04-01 07:38:28'),
(143, 36, '<p>Select<br></p>', NULL, 0, '2023-04-01 07:38:28', '2023-04-01 07:38:28'),
(144, 36, '<p>Change Styles&nbsp;<br></p>', NULL, 0, '2023-04-01 07:38:28', '2023-04-01 07:38:28'),
(145, 37, '<p>#<br></p>', NULL, 0, '2023-04-01 07:40:28', '2023-04-01 07:40:28'),
(146, 37, '<p>/<br></p>', NULL, 0, '2023-04-01 07:40:28', '2023-04-01 07:40:28'),
(147, 37, '<p>=&nbsp;<br></p>', NULL, 1, '2023-04-01 07:40:28', '2023-04-01 07:40:28'),
(148, 37, '<p>( )&nbsp;<br></p>', NULL, 0, '2023-04-01 07:40:28', '2023-04-01 07:40:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `terpilihs`
--

CREATE TABLE `terpilihs` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tahun` varchar(255) DEFAULT NULL,
  `nilai` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `terpilihs`
--

INSERT INTO `terpilihs` (`id`, `nama`, `tahun`, `nilai`, `created_at`, `updated_at`) VALUES
(2, 'Kuwat Gianto', '2023-03-25', '0.1790', '2023-03-25 01:23:50', '2023-04-02 03:12:10'),
(3, 'Imam Mahdi', '2023-03-25', '0.1744', '2023-03-27 02:06:59', '2023-04-02 03:12:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujian`
--

CREATE TABLE `ujian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paket_soal_id` bigint(20) UNSIGNED NOT NULL,
  `rombel_id` bigint(20) UNSIGNED NOT NULL,
  `kriteria_id` int(11) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `waktu_mulai` datetime NOT NULL,
  `durasi` int(11) NOT NULL,
  `tampil_hasil` int(11) DEFAULT NULL,
  `detail_hasil` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ujian`
--

INSERT INTO `ujian` (`id`, `paket_soal_id`, `rombel_id`, `kriteria_id`, `nama`, `keterangan`, `waktu_mulai`, `durasi`, `tampil_hasil`, `detail_hasil`, `token`, `created_at`, `updated_at`) VALUES
(65, 3, 10, 34, 'UUD KUHAP', NULL, '2023-04-01 14:44:00', 60, 1, 1, NULL, '2023-04-01 07:45:10', '2023-04-01 07:45:10'),
(66, 4, 10, 35, 'PENYIDIKAN', NULL, '2023-04-01 14:54:00', 60, 1, 1, NULL, '2023-04-01 07:55:38', '2023-04-01 07:55:38'),
(67, 6, 10, 36, 'PENYELIDIKAN', NULL, '2023-04-01 14:55:00', 60, 1, 1, NULL, '2023-04-01 07:56:30', '2023-04-01 07:56:30'),
(68, 5, 10, 37, 'KOMPUTER', NULL, '2023-04-01 14:56:00', 60, 1, 1, NULL, '2023-04-01 07:57:30', '2023-04-01 07:57:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujian_hasil`
--

CREATE TABLE `ujian_hasil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ujian_siswa_id` bigint(20) UNSIGNED NOT NULL,
  `soal_id` bigint(20) UNSIGNED NOT NULL,
  `jawaban` varchar(255) DEFAULT NULL,
  `ragu` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ujian_hasil`
--

INSERT INTO `ujian_hasil` (`id`, `ujian_siswa_id`, `soal_id`, `jawaban`, `ragu`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '5', NULL, 1, '2023-03-09 01:51:39', '2023-03-09 01:51:46'),
(2, 1, 1, NULL, NULL, 0, '2023-03-09 01:51:39', '2023-03-09 01:51:39'),
(3, 2, 4, '15', NULL, 1, '2023-03-09 02:01:22', '2023-03-09 02:01:31'),
(4, 2, 3, '9', NULL, 1, '2023-03-09 02:01:22', '2023-03-09 02:01:36'),
(5, 3, 4, '15', NULL, 1, '2023-03-13 04:04:25', '2023-03-13 04:04:40'),
(6, 3, 3, '9', NULL, 1, '2023-03-13 04:04:25', '2023-03-13 04:04:51'),
(7, 3, 5, '18', NULL, 0, '2023-03-13 04:04:25', '2023-03-13 04:04:57'),
(8, 4, 6, '21', NULL, 1, '2023-03-13 04:21:33', '2023-03-13 04:21:38'),
(9, 5, 9, '34', NULL, 1, '2023-03-14 08:09:05', '2023-03-14 08:09:09'),
(10, 6, 9, '34', NULL, 1, '2023-03-14 08:14:05', '2023-03-14 08:14:09'),
(11, 7, 9, '34', NULL, 1, '2023-03-14 08:15:57', '2023-03-14 08:16:01'),
(12, 8, 9, '34', NULL, 1, '2023-03-14 08:18:12', '2023-03-14 08:18:17'),
(13, 9, 9, '34', NULL, 1, '2023-03-14 08:18:27', '2023-03-14 08:18:30'),
(14, 10, 10, '40', NULL, 1, '2023-03-14 08:57:39', '2023-03-14 08:57:42'),
(15, 11, 8, NULL, NULL, 0, '2023-03-15 04:19:06', '2023-03-15 04:19:06'),
(16, 12, 8, NULL, NULL, 0, '2023-03-15 04:29:04', '2023-03-15 04:29:04'),
(17, 13, 9, '34', NULL, 1, '2023-03-15 13:09:11', '2023-03-15 13:09:14'),
(18, 14, 9, '34', NULL, 1, '2023-03-15 13:12:50', '2023-03-15 13:12:53'),
(19, 15, 9, '34', NULL, 1, '2023-03-15 13:14:49', '2023-03-15 13:14:51'),
(20, 16, 9, '34', NULL, 1, '2023-03-15 13:16:22', '2023-03-15 13:16:25'),
(21, 17, 9, '36', NULL, 0, '2023-03-15 13:17:37', '2023-03-15 13:17:39'),
(22, 18, 9, '33', NULL, 0, '2023-03-15 13:18:48', '2023-03-15 13:18:51'),
(23, 19, 9, '34', NULL, 1, '2023-03-15 13:19:06', '2023-03-15 13:19:40'),
(32, 28, 8, NULL, NULL, 0, '2023-03-16 02:15:38', '2023-03-16 02:15:38'),
(33, 29, 8, NULL, NULL, 0, '2023-03-16 02:44:19', '2023-03-16 02:44:19'),
(34, 30, 8, NULL, NULL, 0, '2023-03-16 02:51:36', '2023-03-16 02:51:36'),
(35, 31, 8, NULL, NULL, 0, '2023-03-16 03:04:30', '2023-03-16 03:04:30'),
(36, 32, 8, NULL, NULL, 0, '2023-03-16 03:05:20', '2023-03-16 03:05:20'),
(37, 33, 8, NULL, NULL, 0, '2023-03-16 03:07:00', '2023-03-16 03:07:00'),
(38, 34, 8, NULL, NULL, 0, '2023-03-16 03:07:17', '2023-03-16 03:07:17'),
(39, 35, 8, NULL, NULL, 0, '2023-03-16 03:07:48', '2023-03-16 03:07:48'),
(40, 36, 8, NULL, NULL, 0, '2023-03-16 03:08:23', '2023-03-16 03:08:23'),
(41, 37, 8, NULL, NULL, 0, '2023-03-16 03:11:51', '2023-03-16 03:11:51'),
(42, 38, 8, NULL, NULL, 0, '2023-03-16 03:15:01', '2023-03-16 03:15:01'),
(43, 39, 8, NULL, NULL, 0, '2023-03-16 03:18:31', '2023-03-16 03:18:31'),
(44, 40, 9, '34', NULL, 1, '2023-03-16 03:38:25', '2023-03-16 03:38:28'),
(45, 41, 11, '41', NULL, 1, '2023-03-16 04:41:32', '2023-03-16 04:41:36'),
(46, 41, 12, '46', NULL, 1, '2023-03-16 04:41:32', '2023-03-16 04:41:52'),
(47, 42, 9, '34', NULL, 1, '2023-03-16 04:43:17', '2023-03-16 04:43:20'),
(48, 43, 12, '46', NULL, 1, '2023-03-16 04:44:52', '2023-03-16 04:44:56'),
(49, 43, 11, '41', NULL, 1, '2023-03-16 04:44:52', '2023-03-16 04:45:01'),
(50, 44, 9, '33', NULL, 0, '2023-03-16 04:45:26', '2023-03-16 04:45:37'),
(51, 45, 9, '34', NULL, 1, '2023-03-16 04:48:52', '2023-03-16 04:48:58'),
(52, 46, 12, '46', NULL, 1, '2023-03-16 04:49:11', '2023-03-16 04:49:15'),
(53, 46, 11, '41', NULL, 1, '2023-03-16 04:49:11', '2023-03-16 04:49:19'),
(54, 47, 12, '46', NULL, 1, '2023-03-17 01:10:55', '2023-03-17 01:11:03'),
(55, 47, 11, '41', NULL, 1, '2023-03-17 01:10:55', '2023-03-17 01:11:08'),
(56, 48, 11, '41', NULL, 1, '2023-03-17 01:11:25', '2023-03-17 01:11:29'),
(57, 48, 12, NULL, NULL, 0, '2023-03-17 01:11:25', '2023-03-17 01:11:25'),
(58, 49, 13, '49', NULL, 1, '2023-03-17 02:56:39', '2023-03-17 02:56:43'),
(59, 49, 15, '59', NULL, 1, '2023-03-17 02:56:39', '2023-03-17 02:56:48'),
(60, 49, 14, '53', NULL, 0, '2023-03-17 02:56:39', '2023-03-17 02:56:53'),
(61, 50, 15, '59', NULL, 1, '2023-03-17 02:59:13', '2023-03-17 02:59:16'),
(62, 50, 14, '54', NULL, 1, '2023-03-17 02:59:13', '2023-03-17 02:59:20'),
(63, 50, 13, '50', NULL, 0, '2023-03-17 02:59:13', '2023-03-17 02:59:23'),
(64, 51, 13, '49', NULL, 1, '2023-03-17 03:02:12', '2023-03-17 03:02:16'),
(65, 51, 14, '54', NULL, 1, '2023-03-17 03:02:12', '2023-03-17 03:02:21'),
(66, 51, 15, '59', NULL, 1, '2023-03-17 03:02:12', '2023-03-17 03:02:28'),
(67, 52, 12, '46', NULL, 1, '2023-03-17 03:03:03', '2023-03-17 03:03:08'),
(68, 52, 11, '42', NULL, 0, '2023-03-17 03:03:03', '2023-03-17 03:03:13'),
(69, 53, 9, '34', NULL, 1, '2023-03-17 03:03:32', '2023-03-17 03:03:37'),
(70, 54, 10, '40', NULL, 1, '2023-03-17 05:32:38', '2023-03-17 05:32:43'),
(71, 54, 16, '61', NULL, 1, '2023-03-17 05:32:38', '2023-03-17 05:32:49'),
(72, 55, 10, '40', NULL, 1, '2023-03-17 05:34:05', '2023-03-17 05:34:11'),
(73, 55, 16, '61', NULL, 1, '2023-03-17 05:34:05', '2023-03-17 05:34:19'),
(74, 56, 12, '46', NULL, 1, '2023-03-17 05:47:56', '2023-03-17 05:48:00'),
(75, 56, 11, '41', NULL, 1, '2023-03-17 05:47:56', '2023-03-17 05:48:04'),
(76, 57, 9, '34', NULL, 1, '2023-03-17 05:48:25', '2023-03-17 05:48:30'),
(77, 58, 13, '49', NULL, 1, '2023-03-17 05:48:50', '2023-03-17 05:48:54'),
(78, 58, 15, '58', NULL, 0, '2023-03-17 05:48:50', '2023-03-17 05:49:01'),
(79, 58, 14, '54', NULL, 1, '2023-03-17 05:48:50', '2023-03-17 05:49:05'),
(80, 59, 10, '40', NULL, 1, '2023-03-17 05:49:22', '2023-03-17 05:49:28'),
(81, 59, 16, '61', NULL, 1, '2023-03-17 05:49:22', '2023-03-17 05:49:36'),
(82, 60, 11, '41', NULL, 1, '2023-03-17 05:51:28', '2023-03-17 05:51:34'),
(83, 60, 12, '46', NULL, 1, '2023-03-17 05:51:28', '2023-03-17 05:51:37'),
(84, 61, 9, '34', NULL, 1, '2023-03-17 05:52:12', '2023-03-17 05:52:16'),
(85, 62, 14, '54', NULL, 1, '2023-03-17 05:52:40', '2023-03-17 05:52:51'),
(86, 62, 13, '49', NULL, 1, '2023-03-17 05:52:40', '2023-03-17 05:52:58'),
(87, 62, 15, '59', NULL, 1, '2023-03-17 05:52:40', '2023-03-17 05:53:04'),
(88, 63, 10, '40', NULL, 1, '2023-03-17 05:53:21', '2023-03-17 05:53:26'),
(89, 63, 16, '61', NULL, 1, '2023-03-17 05:53:21', '2023-03-17 05:53:29'),
(90, 64, 11, '41', NULL, 1, '2023-03-17 05:54:57', '2023-03-17 05:55:01'),
(91, 64, 12, '46', NULL, 1, '2023-03-17 05:54:57', '2023-03-17 05:55:07'),
(92, 65, 9, '34', NULL, 1, '2023-03-17 05:55:26', '2023-03-17 05:55:31'),
(93, 66, 14, '54', NULL, 1, '2023-03-17 05:55:53', '2023-03-17 05:55:58'),
(94, 66, 13, '49', NULL, 1, '2023-03-17 05:55:53', '2023-03-17 05:56:02'),
(95, 66, 15, '59', NULL, 1, '2023-03-17 05:55:53', '2023-03-17 05:56:06'),
(96, 67, 16, '61', NULL, 1, '2023-03-17 05:56:33', '2023-03-17 05:56:37'),
(97, 67, 10, '40', NULL, 1, '2023-03-17 05:56:33', '2023-03-17 05:56:42'),
(98, 68, 17, '65', NULL, 1, '2023-03-18 05:29:48', '2023-03-18 05:29:52'),
(99, 69, 17, '65', NULL, 1, '2023-03-18 05:30:33', '2023-03-18 05:30:37'),
(100, 70, 17, '65', NULL, 1, '2023-03-18 05:31:11', '2023-03-18 05:31:15'),
(101, 71, 17, '65', NULL, 1, '2023-03-18 05:32:29', '2023-03-18 05:32:40'),
(102, 72, 20, '79', NULL, 0, '2023-04-01 07:58:53', '2023-04-01 08:00:09'),
(103, 72, 18, '71', NULL, 1, '2023-04-01 07:58:53', '2023-04-01 08:00:21'),
(104, 72, 19, '75', NULL, 1, '2023-04-01 07:58:53', '2023-04-01 08:01:03'),
(105, 72, 21, '82', NULL, 1, '2023-04-01 07:58:53', '2023-04-01 08:01:21'),
(106, 72, 22, '86', NULL, 1, '2023-04-01 07:58:53', '2023-04-01 08:01:35'),
(107, 73, 27, '107', NULL, 1, '2023-04-01 08:20:01', '2023-04-01 08:23:58'),
(108, 73, 25, '99', NULL, 1, '2023-04-01 08:20:01', '2023-04-01 08:21:18'),
(109, 73, 26, '102', NULL, 1, '2023-04-01 08:20:01', '2023-04-01 08:21:56'),
(110, 73, 24, '94', NULL, 1, '2023-04-01 08:20:01', '2023-04-01 08:22:12'),
(111, 73, 23, '89', NULL, 1, '2023-04-01 08:20:01', '2023-04-01 08:22:37'),
(112, 74, 29, '116', NULL, 1, '2023-04-01 08:26:00', '2023-04-01 08:26:07'),
(113, 74, 28, '111', NULL, 1, '2023-04-01 08:26:00', '2023-04-01 08:26:18'),
(114, 74, 31, '124', NULL, 1, '2023-04-01 08:26:00', '2023-04-01 08:26:28'),
(115, 74, 30, '118', NULL, 1, '2023-04-01 08:26:00', '2023-04-01 08:26:35'),
(116, 74, 32, '128', NULL, 1, '2023-04-01 08:26:00', '2023-04-01 08:26:57'),
(117, 75, 35, '137', NULL, 1, '2023-04-01 08:32:13', '2023-04-01 08:32:18'),
(118, 75, 37, '147', NULL, 1, '2023-04-01 08:32:13', '2023-04-01 08:32:26'),
(119, 75, 36, '141', NULL, 1, '2023-04-01 08:32:13', '2023-04-01 08:32:32'),
(120, 75, 33, '131', NULL, 1, '2023-04-01 08:32:13', '2023-04-01 08:32:51'),
(121, 75, 34, '133', NULL, 1, '2023-04-01 08:32:13', '2023-04-01 08:32:59'),
(122, 76, 20, '77', NULL, 0, '2023-04-01 11:05:52', '2023-04-01 11:06:04'),
(123, 76, 19, '75', NULL, 1, '2023-04-01 11:05:52', '2023-04-01 11:06:19'),
(124, 76, 21, '82', NULL, 1, '2023-04-01 11:05:52', '2023-04-01 11:06:24'),
(125, 76, 18, '71', NULL, 1, '2023-04-01 11:05:52', '2023-04-01 11:06:39'),
(126, 76, 22, '86', NULL, 1, '2023-04-01 11:05:52', '2023-04-01 11:06:48'),
(127, 77, 26, '102', NULL, 1, '2023-04-01 11:14:43', '2023-04-01 11:14:54'),
(128, 77, 27, '107', NULL, 1, '2023-04-01 11:14:43', '2023-04-01 11:15:00'),
(129, 77, 23, '89', NULL, 1, '2023-04-01 11:14:43', '2023-04-01 11:15:07'),
(130, 77, 24, '94', NULL, 1, '2023-04-01 11:14:43', '2023-04-01 11:15:20'),
(131, 77, 25, '99', NULL, 1, '2023-04-01 11:14:43', '2023-04-01 11:15:24'),
(132, 78, 30, '118', NULL, 1, '2023-04-01 11:16:05', '2023-04-01 11:16:16'),
(133, 78, 28, '111', NULL, 1, '2023-04-01 11:16:05', '2023-04-01 11:16:24'),
(134, 78, 29, '116', NULL, 1, '2023-04-01 11:16:05', '2023-04-01 11:16:35'),
(135, 78, 31, '123', NULL, 0, '2023-04-01 11:16:05', '2023-04-01 11:17:13'),
(136, 78, 32, '128', NULL, 1, '2023-04-01 11:16:05', '2023-04-01 11:17:08'),
(137, 79, 35, '137', NULL, 1, '2023-04-01 11:17:57', '2023-04-01 11:18:05'),
(138, 79, 34, '134', NULL, 0, '2023-04-01 11:17:57', '2023-04-01 11:18:14'),
(139, 79, 33, '131', NULL, 1, '2023-04-01 11:17:57', '2023-04-01 11:18:29'),
(140, 79, 37, '146', NULL, 0, '2023-04-01 11:17:57', '2023-04-01 11:18:33'),
(141, 79, 36, '141', NULL, 1, '2023-04-01 11:17:57', '2023-04-01 11:18:40'),
(142, 80, 20, '80', NULL, 1, '2023-04-01 11:20:38', '2023-04-01 11:21:10'),
(143, 80, 18, '71', NULL, 1, '2023-04-01 11:20:38', '2023-04-01 11:21:33'),
(144, 80, 22, '86', NULL, 1, '2023-04-01 11:20:38', '2023-04-01 11:21:51'),
(145, 80, 19, '75', NULL, 1, '2023-04-01 11:20:38', '2023-04-01 11:21:57'),
(146, 80, 21, '82', NULL, 1, '2023-04-01 11:20:38', '2023-04-01 11:22:04'),
(147, 81, 24, '94', NULL, 1, '2023-04-01 11:23:17', '2023-04-01 11:23:28'),
(148, 81, 25, '99', NULL, 1, '2023-04-01 11:23:17', '2023-04-01 11:23:33'),
(149, 81, 26, '102', NULL, 1, '2023-04-01 11:23:17', '2023-04-01 11:23:41'),
(150, 81, 27, '107', NULL, 1, '2023-04-01 11:23:17', '2023-04-01 11:23:47'),
(151, 81, 23, '89', NULL, 1, '2023-04-01 11:23:17', '2023-04-01 11:23:52'),
(152, 82, 32, '128', NULL, 1, '2023-04-01 11:24:41', '2023-04-01 11:24:53'),
(153, 82, 29, '116', NULL, 1, '2023-04-01 11:24:41', '2023-04-01 11:25:03'),
(154, 82, 30, '118', NULL, 1, '2023-04-01 11:24:41', '2023-04-01 11:25:11'),
(155, 82, 28, '111', NULL, 1, '2023-04-01 11:24:41', '2023-04-01 11:25:18'),
(156, 82, 31, '123', NULL, 0, '2023-04-01 11:24:41', '2023-04-01 11:25:28'),
(157, 83, 34, '133', NULL, 1, '2023-04-01 11:26:00', '2023-04-01 11:26:24'),
(158, 83, 37, '148', NULL, 0, '2023-04-01 11:26:00', '2023-04-01 11:26:37'),
(159, 83, 36, '141', NULL, 1, '2023-04-01 11:26:00', '2023-04-01 11:26:41'),
(160, 83, 33, '131', NULL, 1, '2023-04-01 11:26:00', '2023-04-01 11:26:48'),
(161, 83, 35, '137', NULL, 1, '2023-04-01 11:26:00', '2023-04-01 11:26:54'),
(162, 84, 19, '75', NULL, 1, '2023-04-01 11:30:16', '2023-04-01 11:30:23'),
(163, 84, 18, '71', NULL, 1, '2023-04-01 11:30:16', '2023-04-01 11:30:51'),
(164, 84, 21, '81', NULL, 0, '2023-04-01 11:30:16', '2023-04-01 11:31:03'),
(165, 84, 22, '86', NULL, 1, '2023-04-01 11:30:16', '2023-04-01 11:31:07'),
(166, 84, 20, '80', NULL, 1, '2023-04-01 11:30:16', '2023-04-01 11:31:42'),
(167, 85, 23, '90', NULL, 0, '2023-04-01 11:32:37', '2023-04-01 11:33:43'),
(168, 85, 27, '107', NULL, 1, '2023-04-01 11:32:37', '2023-04-01 11:33:17'),
(169, 85, 26, '102', NULL, 1, '2023-04-01 11:32:37', '2023-04-01 11:33:25'),
(170, 85, 24, '94', NULL, 1, '2023-04-01 11:32:37', '2023-04-01 11:33:29'),
(171, 85, 25, '99', NULL, 1, '2023-04-01 11:32:37', '2023-04-01 11:33:37'),
(172, 86, 28, '111', NULL, 1, '2023-04-01 11:34:16', '2023-04-01 11:34:21'),
(173, 86, 29, '116', NULL, 1, '2023-04-01 11:34:16', '2023-04-01 11:34:27'),
(174, 86, 32, '128', NULL, 1, '2023-04-01 11:34:16', '2023-04-01 11:34:31'),
(175, 86, 31, '123', NULL, 0, '2023-04-01 11:34:16', '2023-04-01 11:34:41'),
(176, 86, 30, '118', NULL, 1, '2023-04-01 11:34:16', '2023-04-01 11:34:45'),
(177, 87, 37, '148', NULL, 0, '2023-04-01 11:35:09', '2023-04-01 11:35:25'),
(178, 87, 35, '137', NULL, 1, '2023-04-01 11:35:09', '2023-04-01 11:35:29'),
(179, 87, 34, '133', NULL, 1, '2023-04-01 11:35:09', '2023-04-01 11:35:33'),
(180, 87, 33, '131', NULL, 1, '2023-04-01 11:35:09', '2023-04-01 11:35:39'),
(181, 87, 36, '141', NULL, 1, '2023-04-01 11:35:09', '2023-04-01 11:35:43'),
(182, 88, 19, '75', NULL, 1, '2023-04-01 11:36:53', '2023-04-01 11:36:58'),
(183, 88, 21, '82', NULL, 1, '2023-04-01 11:36:53', '2023-04-01 11:37:05'),
(184, 88, 22, '86', NULL, 1, '2023-04-01 11:36:53', '2023-04-01 11:37:10'),
(185, 88, 18, '71', NULL, 1, '2023-04-01 11:36:53', '2023-04-01 11:37:20'),
(186, 88, 20, '80', NULL, 1, '2023-04-01 11:36:53', '2023-04-01 11:37:30'),
(187, 89, 26, '102', NULL, 1, '2023-04-01 11:37:55', '2023-04-01 11:37:59'),
(188, 89, 25, '99', NULL, 1, '2023-04-01 11:37:55', '2023-04-01 11:38:05'),
(189, 89, 23, '89', NULL, 1, '2023-04-01 11:37:55', '2023-04-01 11:38:10'),
(190, 89, 27, '107', NULL, 1, '2023-04-01 11:37:55', '2023-04-01 11:38:19'),
(191, 89, 24, '94', NULL, 1, '2023-04-01 11:37:55', '2023-04-01 11:38:25'),
(192, 90, 28, '111', NULL, 1, '2023-04-01 11:39:03', '2023-04-01 11:39:15'),
(193, 90, 31, '124', NULL, 1, '2023-04-01 11:39:03', '2023-04-01 11:39:22'),
(194, 90, 32, '128', NULL, 1, '2023-04-01 11:39:03', '2023-04-01 11:39:27'),
(195, 90, 29, '116', NULL, 1, '2023-04-01 11:39:03', '2023-04-01 11:39:32'),
(196, 90, 30, '118', NULL, 1, '2023-04-01 11:39:03', '2023-04-01 11:39:38'),
(197, 91, 36, '143', NULL, 0, '2023-04-01 11:40:10', '2023-04-01 11:40:26'),
(198, 91, 33, '131', NULL, 1, '2023-04-01 11:40:10', '2023-04-01 11:40:39'),
(199, 91, 34, '133', NULL, 1, '2023-04-01 11:40:10', '2023-04-01 11:40:56'),
(200, 91, 35, '137', NULL, 1, '2023-04-01 11:40:10', '2023-04-01 11:41:00'),
(201, 91, 37, '145', NULL, 0, '2023-04-01 11:40:10', '2023-04-01 11:41:09'),
(202, 92, 18, '71', NULL, 1, '2023-04-01 12:33:12', '2023-04-01 12:33:27'),
(203, 92, 21, '82', NULL, 1, '2023-04-01 12:33:12', '2023-04-01 12:33:36'),
(204, 92, 19, '75', NULL, 1, '2023-04-01 12:33:12', '2023-04-01 12:33:40'),
(205, 92, 20, '80', NULL, 1, '2023-04-01 12:33:12', '2023-04-01 12:33:48'),
(206, 92, 22, '86', NULL, 1, '2023-04-01 12:33:12', '2023-04-01 12:33:57'),
(207, 93, 23, '89', NULL, 1, '2023-04-01 12:34:26', '2023-04-01 12:34:32'),
(208, 93, 24, '94', NULL, 1, '2023-04-01 12:34:26', '2023-04-01 12:34:37'),
(209, 93, 26, '102', NULL, 1, '2023-04-01 12:34:26', '2023-04-01 12:34:42'),
(210, 93, 27, '106', NULL, 0, '2023-04-01 12:34:26', '2023-04-01 12:34:48'),
(211, 93, 25, '99', NULL, 1, '2023-04-01 12:34:26', '2023-04-01 12:34:52'),
(212, 94, 32, '128', NULL, 1, '2023-04-01 12:35:37', '2023-04-01 12:35:45'),
(213, 94, 30, '118', NULL, 1, '2023-04-01 12:35:37', '2023-04-01 12:35:49'),
(214, 94, 28, '111', NULL, 1, '2023-04-01 12:35:37', '2023-04-01 12:35:54'),
(215, 94, 29, '116', NULL, 1, '2023-04-01 12:35:37', '2023-04-01 12:35:59'),
(216, 94, 31, '124', NULL, 1, '2023-04-01 12:35:37', '2023-04-01 12:36:04'),
(217, 95, 33, '131', NULL, 1, '2023-04-01 12:36:27', '2023-04-01 12:36:35'),
(218, 95, 35, '137', NULL, 1, '2023-04-01 12:36:27', '2023-04-01 12:36:40'),
(219, 95, 36, '142', NULL, 0, '2023-04-01 12:36:27', '2023-04-01 12:36:47'),
(220, 95, 37, '145', NULL, 0, '2023-04-01 12:36:27', '2023-04-01 12:36:53'),
(221, 95, 34, '133', NULL, 1, '2023-04-01 12:36:27', '2023-04-01 12:36:59'),
(222, 96, 20, '79', NULL, 0, '2023-06-11 03:29:11', '2023-06-11 03:29:17'),
(223, 96, 19, '75', NULL, 1, '2023-06-11 03:29:11', '2023-06-11 03:29:29'),
(224, 96, 22, '86', NULL, 1, '2023-06-11 03:29:11', '2023-06-11 03:29:36'),
(225, 96, 18, '69', NULL, 0, '2023-06-11 03:29:11', '2023-06-11 03:29:41'),
(226, 96, 21, '82', NULL, 1, '2023-06-11 03:29:11', '2023-06-11 03:29:46'),
(227, 97, 27, '107', NULL, 1, '2023-06-11 03:31:46', '2023-06-11 03:31:56'),
(228, 97, 26, '102', NULL, 1, '2023-06-11 03:31:46', '2023-06-11 03:32:02'),
(229, 97, 24, '94', NULL, 1, '2023-06-11 03:31:46', '2023-06-11 03:32:07'),
(230, 97, 23, '91', NULL, 0, '2023-06-11 03:31:46', '2023-06-11 03:32:11'),
(231, 97, 25, '99', NULL, 1, '2023-06-11 03:31:46', '2023-06-11 03:32:15'),
(232, 98, 28, '111', NULL, 1, '2023-06-11 03:33:10', '2023-06-11 03:33:23'),
(233, 98, 32, '128', NULL, 1, '2023-06-11 03:33:10', '2023-06-11 03:33:34'),
(234, 98, 30, '118', NULL, 1, '2023-06-11 03:33:10', '2023-06-11 03:33:39'),
(235, 98, 31, '124', NULL, 1, '2023-06-11 03:33:10', '2023-06-11 03:33:50'),
(236, 98, 29, '116', NULL, 1, '2023-06-11 03:33:10', '2023-06-11 03:33:54'),
(237, 99, 36, '142', NULL, 0, '2023-06-11 03:34:26', '2023-06-11 03:34:33'),
(238, 99, 37, '147', NULL, 1, '2023-06-11 03:34:26', '2023-06-11 03:34:39'),
(239, 99, 33, '131', NULL, 1, '2023-06-11 03:34:26', '2023-06-11 03:34:44'),
(240, 99, 34, '133', NULL, 1, '2023-06-11 03:34:26', '2023-06-11 03:34:49'),
(241, 99, 35, '137', NULL, 1, '2023-06-11 03:34:26', '2023-06-11 03:34:55'),
(242, 100, 22, '86', NULL, 1, '2023-06-11 03:52:21', '2023-06-11 03:52:26'),
(243, 100, 20, '80', NULL, 1, '2023-06-11 03:52:21', '2023-06-11 03:52:30'),
(244, 100, 19, '74', NULL, 0, '2023-06-11 03:52:21', '2023-06-11 03:52:35'),
(245, 100, 18, '69', NULL, 0, '2023-06-11 03:52:21', '2023-06-11 03:53:07'),
(246, 100, 21, '82', NULL, 1, '2023-06-11 03:52:21', '2023-06-11 03:53:11'),
(247, 101, 26, '102', NULL, 1, '2023-06-11 03:54:09', '2023-06-11 03:54:18'),
(248, 101, 23, '90', NULL, 0, '2023-06-11 03:54:09', '2023-06-11 03:54:23'),
(249, 101, 24, '94', NULL, 1, '2023-06-11 03:54:09', '2023-06-11 03:54:27'),
(250, 101, 25, '100', NULL, 0, '2023-06-11 03:54:09', '2023-06-11 03:54:33'),
(251, 101, 27, '106', NULL, 0, '2023-06-11 03:54:09', '2023-06-11 03:54:39'),
(252, 102, 30, '118', NULL, 1, '2023-06-11 03:55:10', '2023-06-11 03:55:16'),
(253, 102, 31, '124', NULL, 1, '2023-06-11 03:55:10', '2023-06-11 03:55:28'),
(254, 102, 32, '128', NULL, 1, '2023-06-11 03:55:10', '2023-06-11 03:55:34'),
(255, 102, 28, '109', NULL, 0, '2023-06-11 03:55:10', '2023-06-11 03:55:38'),
(256, 102, 29, '115', NULL, 0, '2023-06-11 03:55:10', '2023-06-11 03:55:42'),
(257, 103, 36, '141', NULL, 1, '2023-06-11 03:56:35', '2023-06-11 03:56:40'),
(258, 103, 34, '134', NULL, 0, '2023-06-11 03:56:35', '2023-06-11 03:56:46'),
(259, 103, 33, '131', NULL, 1, '2023-06-11 03:56:35', '2023-06-11 03:56:53'),
(260, 103, 37, '145', NULL, 0, '2023-06-11 03:56:35', '2023-06-11 03:56:57'),
(261, 103, 35, '137', NULL, 1, '2023-06-11 03:56:35', '2023-06-11 03:57:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujian_siswa`
--

CREATE TABLE `ujian_siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ujian_id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `mulai` datetime NOT NULL,
  `selesai` datetime NOT NULL,
  `nilai` decimal(8,2) DEFAULT NULL,
  `user_agent` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ujian_siswa`
--

INSERT INTO `ujian_siswa` (`id`, `ujian_id`, `siswa_id`, `mulai`, `selesai`, `nilai`, `user_agent`, `status`, `created_at`, `updated_at`) VALUES
(6, 28, 12, '2023-03-14 15:14:05', '2023-03-14 15:24:05', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-14 08:14:05', '2023-03-14 08:14:12'),
(7, 29, 12, '2023-03-14 15:15:57', '2023-03-14 15:25:57', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-14 08:15:57', '2023-03-14 08:16:05'),
(8, 28, 13, '2023-03-14 15:18:12', '2023-03-14 15:28:12', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-14 08:18:12', '2023-03-14 08:18:19'),
(9, 29, 13, '2023-03-14 15:18:27', '2023-03-14 15:28:27', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-14 08:18:27', '2023-03-14 08:18:34'),
(10, 30, 12, '2023-03-14 15:57:39', '2023-03-14 16:07:39', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-14 08:57:39', '2023-03-14 08:57:45'),
(11, 31, 12, '2023-03-15 11:19:06', '2023-03-15 11:29:06', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-15 04:19:06', '2023-03-15 04:19:23'),
(12, 32, 12, '2023-03-15 11:29:04', '2023-03-15 11:39:04', NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-15 04:29:04', '2023-03-15 04:29:16'),
(18, 28, 26, '2023-03-15 20:18:48', '2023-03-15 20:28:48', '0.00', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-15 13:18:48', '2023-03-15 13:18:54'),
(19, 29, 26, '2023-03-15 20:19:06', '2023-03-15 20:29:06', '100.00', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-15 13:19:06', '2023-03-15 13:19:43'),
(39, 56, 26, '2023-03-16 10:18:31', '2023-03-16 10:28:31', '0.00', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-16 03:18:31', '2023-03-16 03:18:33'),
(40, 57, 26, '2023-03-16 10:38:25', '2023-03-16 12:18:25', '100.00', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-16 03:38:25', '2023-03-16 03:38:57'),
(41, 58, 13, '2023-03-16 11:41:32', '2023-03-16 11:51:32', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-16 04:41:32', '2023-03-16 04:42:21'),
(42, 59, 13, '2023-03-16 11:43:17', '2023-03-16 11:53:17', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-16 04:43:17', '2023-03-16 04:43:23'),
(43, 58, 28, '2023-03-16 11:44:52', '2023-03-16 11:54:52', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-16 04:44:52', '2023-03-16 04:45:04'),
(44, 59, 28, '2023-03-16 11:45:26', '2023-03-16 11:55:26', '0.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-16 04:45:26', '2023-03-16 04:45:40'),
(45, 59, 29, '2023-03-16 11:48:52', '2023-03-16 11:58:52', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-16 04:48:52', '2023-03-16 04:49:04'),
(46, 58, 29, '2023-03-16 11:49:11', '2023-03-16 11:59:11', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-16 04:49:11', '2023-03-16 04:49:21'),
(47, 60, 29, '2023-03-17 08:10:55', '2023-03-17 08:20:55', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 01:10:55', '2023-03-17 01:11:10'),
(48, 61, 29, '2023-03-17 08:11:25', '2023-03-17 08:21:25', '50.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 01:11:25', '2023-03-17 01:11:34'),
(49, 62, 29, '2023-03-17 09:56:39', '2023-03-17 10:06:39', '66.67', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 02:56:39', '2023-03-17 02:57:03'),
(50, 62, 28, '2023-03-17 09:59:13', '2023-03-17 10:09:13', '66.67', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 02:59:13', '2023-03-17 02:59:26'),
(51, 62, 30, '2023-03-17 10:02:12', '2023-03-17 10:12:12', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 03:02:12', '2023-03-17 03:02:31'),
(52, 58, 30, '2023-03-17 10:03:03', '2023-03-17 10:13:03', '50.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 03:03:03', '2023-03-17 03:03:15'),
(53, 59, 30, '2023-03-17 10:03:32', '2023-03-17 10:13:32', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 03:03:32', '2023-03-17 03:03:39'),
(54, 63, 30, '2023-03-17 12:32:38', '2023-03-17 12:42:38', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 05:32:38', '2023-03-17 05:32:52'),
(55, 63, 28, '2023-03-17 12:34:05', '2023-03-17 12:44:05', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 05:34:05', '2023-03-17 05:34:23'),
(56, 58, 31, '2023-03-17 12:47:56', '2023-03-17 12:57:56', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 05:47:56', '2023-03-17 05:48:09'),
(57, 59, 31, '2023-03-17 12:48:25', '2023-03-17 12:58:25', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 05:48:25', '2023-03-17 05:48:34'),
(58, 62, 31, '2023-03-17 12:48:50', '2023-03-17 12:58:50', '66.67', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 05:48:50', '2023-03-17 05:49:08'),
(59, 63, 31, '2023-03-17 12:49:22', '2023-03-17 12:59:22', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 05:49:22', '2023-03-17 05:49:40'),
(60, 58, 32, '2023-03-17 12:51:28', '2023-03-17 13:01:28', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 05:51:28', '2023-03-17 05:51:40'),
(61, 59, 32, '2023-03-17 12:52:12', '2023-03-17 13:02:12', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 05:52:12', '2023-03-17 05:52:19'),
(62, 62, 32, '2023-03-17 12:52:40', '2023-03-17 13:02:40', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 05:52:40', '2023-03-17 05:53:07'),
(63, 63, 32, '2023-03-17 12:53:21', '2023-03-17 13:03:21', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 05:53:21', '2023-03-17 05:53:32'),
(64, 58, 33, '2023-03-17 12:54:57', '2023-03-17 13:04:57', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 05:54:57', '2023-03-17 05:55:09'),
(65, 59, 33, '2023-03-17 12:55:26', '2023-03-17 13:05:26', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 05:55:26', '2023-03-17 05:55:36'),
(66, 62, 33, '2023-03-17 12:55:53', '2023-03-17 13:05:53', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 05:55:53', '2023-03-17 05:56:09'),
(67, 63, 33, '2023-03-17 12:56:33', '2023-03-17 13:06:33', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-17 05:56:33', '2023-03-17 05:56:45'),
(68, 64, 28, '2023-03-18 12:29:48', '2023-03-18 12:39:48', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-18 05:29:48', '2023-03-18 05:29:54'),
(69, 64, 31, '2023-03-18 12:30:33', '2023-03-18 12:40:33', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-18 05:30:33', '2023-03-18 05:30:39'),
(70, 64, 32, '2023-03-18 12:31:11', '2023-03-18 12:41:11', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-18 05:31:11', '2023-03-18 05:31:20'),
(71, 64, 33, '2023-03-18 12:32:29', '2023-03-18 12:42:29', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 1, '2023-03-18 05:32:29', '2023-03-18 05:32:42'),
(72, 65, 34, '2023-04-01 14:58:53', '2023-04-01 15:58:53', '80.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 07:58:53', '2023-04-01 08:13:21'),
(73, 66, 34, '2023-04-01 15:20:01', '2023-04-01 16:20:01', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 08:20:01', '2023-04-01 08:25:07'),
(74, 67, 34, '2023-04-01 15:26:00', '2023-04-01 16:26:00', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 08:26:00', '2023-04-01 08:31:45'),
(75, 68, 34, '2023-04-01 15:32:13', '2023-04-01 16:32:13', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 08:32:13', '2023-04-01 08:33:17'),
(76, 65, 35, '2023-04-01 18:05:52', '2023-04-01 19:05:52', '80.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 11:05:52', '2023-04-01 11:07:01'),
(77, 66, 35, '2023-04-01 18:14:43', '2023-04-01 19:14:43', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 11:14:43', '2023-04-01 11:15:29'),
(78, 67, 35, '2023-04-01 18:16:05', '2023-04-01 19:16:05', '80.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 11:16:05', '2023-04-01 11:17:20'),
(79, 68, 35, '2023-04-01 18:17:56', '2023-04-01 19:17:56', '60.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 11:17:56', '2023-04-01 11:18:53'),
(80, 65, 36, '2023-04-01 18:20:38', '2023-04-01 19:20:38', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 11:20:38', '2023-04-01 11:22:17'),
(81, 66, 36, '2023-04-01 18:23:17', '2023-04-01 19:23:17', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 11:23:17', '2023-04-01 11:24:15'),
(82, 67, 36, '2023-04-01 18:24:41', '2023-04-01 19:24:41', '80.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 11:24:41', '2023-04-01 11:25:40'),
(83, 68, 36, '2023-04-01 18:26:00', '2023-04-01 19:26:00', '80.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 11:26:00', '2023-04-01 11:27:03'),
(84, 65, 37, '2023-04-01 18:30:16', '2023-04-01 19:30:16', '80.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 11:30:16', '2023-04-01 11:32:05'),
(85, 66, 37, '2023-04-01 18:32:37', '2023-04-01 19:32:37', '80.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 11:32:37', '2023-04-01 11:33:57'),
(86, 67, 37, '2023-04-01 18:34:16', '2023-04-01 19:34:16', '80.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 11:34:16', '2023-04-01 11:34:49'),
(87, 68, 37, '2023-04-01 18:35:09', '2023-04-01 19:35:09', '80.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 11:35:09', '2023-04-01 11:35:52'),
(88, 65, 38, '2023-04-01 18:36:53', '2023-04-01 19:36:53', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 11:36:53', '2023-04-01 11:37:33'),
(89, 66, 38, '2023-04-01 18:37:55', '2023-04-01 19:37:55', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 11:37:55', '2023-04-01 11:38:40'),
(90, 67, 38, '2023-04-01 18:39:03', '2023-04-01 19:39:03', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 11:39:03', '2023-04-01 11:39:48'),
(91, 68, 38, '2023-04-01 18:40:10', '2023-04-01 19:40:10', '60.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 11:40:10', '2023-04-01 11:41:19'),
(92, 65, 39, '2023-04-01 19:33:12', '2023-04-01 20:33:12', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 12:33:12', '2023-04-01 12:34:02'),
(93, 66, 39, '2023-04-01 19:34:26', '2023-04-01 20:34:26', '80.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 12:34:26', '2023-04-01 12:34:56'),
(94, 67, 39, '2023-04-01 19:35:37', '2023-04-01 20:35:37', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 12:35:37', '2023-04-01 12:36:07'),
(95, 68, 39, '2023-04-01 19:36:27', '2023-04-01 20:36:27', '60.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 1, '2023-04-01 12:36:27', '2023-04-01 12:37:16'),
(96, 65, 40, '2023-06-11 10:29:11', '2023-06-11 11:29:11', '60.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, '2023-06-11 03:29:11', '2023-06-11 03:29:50'),
(97, 66, 40, '2023-06-11 10:31:46', '2023-06-11 11:31:46', '80.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, '2023-06-11 03:31:46', '2023-06-11 03:32:18'),
(98, 67, 40, '2023-06-11 10:33:10', '2023-06-11 11:33:10', '100.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, '2023-06-11 03:33:10', '2023-06-11 03:33:57'),
(99, 68, 40, '2023-06-11 10:34:26', '2023-06-11 11:34:26', '80.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, '2023-06-11 03:34:26', '2023-06-11 03:34:58'),
(100, 65, 41, '2023-06-11 10:52:21', '2023-06-11 11:52:21', '60.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, '2023-06-11 03:52:21', '2023-06-11 03:53:14'),
(101, 66, 41, '2023-06-11 10:54:09', '2023-06-11 11:54:09', '40.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, '2023-06-11 03:54:09', '2023-06-11 03:54:42'),
(102, 67, 41, '2023-06-11 10:55:10', '2023-06-11 11:55:10', '60.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, '2023-06-11 03:55:10', '2023-06-11 03:55:45'),
(103, 68, 41, '2023-06-11 10:56:35', '2023-06-11 11:56:35', '60.00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 1, '2023-06-11 03:56:35', '2023-06-11 03:57:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `level_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `photo` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `hp` int(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `level_id`, `status`, `photo`, `address`, `hp`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@gmail.com', 1, 1, '', NULL, NULL, NULL, '$2y$10$ZZHgqxGyoDEN9/XAK9nlzuWfOSYQ1yT4L/73TLTtZnJFkzG.B1Ktm', '7gCISBwl8tojBJvw9aianc7tcVweF8sDTognQHD4C4sCpbauhZHTz21ksqWb', '2023-03-08 11:01:59', '2023-03-25 02:37:11');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kandidats`
--
ALTER TABLE `kandidats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kriterias`
--
ALTER TABLE `kriterias`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `levels_nama_unique` (`nama`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `paket_soal`
--
ALTER TABLE `paket_soal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paket_soal_kelas_id_foreign` (`kelas_id`),
  ADD KEY `paket_soal_mapel_id_foreign` (`mapel_id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `rekap_kandidat`
--
ALTER TABLE `rekap_kandidat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekap_nilai`
--
ALTER TABLE `rekap_nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `riwayats`
--
ALTER TABLE `riwayats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rombel`
--
ALTER TABLE `rombel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rombel_kelas_id_foreign` (`kelas_id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_rombel_id_foreign` (`rombel_id`);

--
-- Indeks untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `soal_paket_soal_id_foreign` (`paket_soal_id`);

--
-- Indeks untuk tabel `soal_pilihan`
--
ALTER TABLE `soal_pilihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `soal_pilihan_soal_id_foreign` (`soal_id`);

--
-- Indeks untuk tabel `terpilihs`
--
ALTER TABLE `terpilihs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ujian_hasil`
--
ALTER TABLE `ujian_hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ujian_siswa`
--
ALTER TABLE `ujian_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `hp` (`hp`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kandidats`
--
ALTER TABLE `kandidats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `kriterias`
--
ALTER TABLE `kriterias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `paket_soal`
--
ALTER TABLE `paket_soal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `riwayats`
--
ALTER TABLE `riwayats`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rombel`
--
ALTER TABLE `rombel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `soal`
--
ALTER TABLE `soal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `soal_pilihan`
--
ALTER TABLE `soal_pilihan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT untuk tabel `terpilihs`
--
ALTER TABLE `terpilihs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `ujian_hasil`
--
ALTER TABLE `ujian_hasil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT untuk tabel `ujian_siswa`
--
ALTER TABLE `ujian_siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `paket_soal`
--
ALTER TABLE `paket_soal`
  ADD CONSTRAINT `paket_soal_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paket_soal_mapel_id_foreign` FOREIGN KEY (`mapel_id`) REFERENCES `mapel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rombel`
--
ALTER TABLE `rombel`
  ADD CONSTRAINT `rombel_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_rombel_id_foreign` FOREIGN KEY (`rombel_id`) REFERENCES `rombel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `soal_paket_soal_id_foreign` FOREIGN KEY (`paket_soal_id`) REFERENCES `paket_soal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `soal_pilihan`
--
ALTER TABLE `soal_pilihan`
  ADD CONSTRAINT `soal_pilihan_soal_id_foreign` FOREIGN KEY (`soal_id`) REFERENCES `soal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
