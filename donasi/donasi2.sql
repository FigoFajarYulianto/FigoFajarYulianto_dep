-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jun 2024 pada 05.41
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
-- Database: `donasi2`
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `abouts`
--

INSERT INTO `abouts` (`id`, `name`, `link`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'We\'re for social causes', '/pages/tentang-kami', 'uploads/HTE7hprcmLQ36Vgqjilj3TymCJg7sz5VL7vq39mp.jpg', '<div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro.<br><br></div><div>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</div>', '2022-11-12 02:08:11', '2022-11-13 07:30:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `banks`
--

INSERT INTO `banks` (`id`, `name`, `bank`, `nomor`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Febri Putra', 'BRI', '9798-123123-123123', 1, '2022-11-17 01:40:16', '2022-11-17 01:40:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `campaignfunditems`
--

CREATE TABLE `campaignfunditems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_transaksi` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_time` timestamp NULL DEFAULT NULL,
  `transaction_type` varchar(255) DEFAULT NULL,
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `campaign_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `gross_amount` double NOT NULL DEFAULT 0,
  `transaction_status` varchar(255) NOT NULL,
  `transaction_status_time` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL,
  `hidden_name` double DEFAULT NULL,
  `snap_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `campaignfunditems`
--

INSERT INTO `campaignfunditems` (`id`, `no_transaksi`, `name`, `user_id`, `transaction_time`, `transaction_type`, `bank_id`, `campaign_id`, `order_id`, `gross_amount`, `transaction_status`, `transaction_status_time`, `description`, `hidden_name`, `snap_token`, `created_at`, `updated_at`) VALUES
(1, '00001/DN/241122', 'Febri Putra Tris Budiono', NULL, '2022-11-24 02:39:11', 'Donasi', NULL, 2, '1669257551', 50000, 'Berhasil', '2022-11-24 02:39:16', 'Semangat', NULL, '1bf7b08a-0a4d-4733-bcf5-c1976c3d1ab5', '2022-11-24 02:39:12', '2022-11-24 02:39:51'),
(2, '00002/PN/241122', NULL, 1, '2022-11-24 02:43:25', 'Penarikan', 1, 2, '1669257805', 20000, 'Berhasil', NULL, 'sarapan pagi', NULL, NULL, '2022-11-24 02:43:25', '2022-11-25 06:19:22'),
(3, '00003/DN/241122', 'Orang Baik', NULL, '2022-11-24 11:23:00', 'Donasi', NULL, 2, '1669263780', 20000, 'Berhasil', '2022-11-24 11:23:03', 'Cepat Pulih', NULL, 'fbb936cb-0d3d-49e4-9d45-54db997fa0e1', '2022-11-24 11:23:00', '2022-11-24 11:23:39'),
(4, '00004/DN/241122', 'Orang Baik', NULL, '2022-11-24 11:26:10', 'Donasi', NULL, 2, '1669263970', 100000, 'Berhasil', '2022-11-24 11:26:12', 'Semangat', NULL, 'b59a44d9-0deb-4577-8c4a-1f2efa1bc10f', '2022-11-24 11:26:10', '2022-11-24 11:26:48'),
(5, '00005/DN/241122', 'Orang Baik', NULL, '2022-11-24 11:39:39', 'Donasi', NULL, 2, '1669264779', 30000, 'Berhasil', '2022-11-24 11:39:42', 'Semangat', NULL, '3b2c7108-0fc3-40ff-bee7-d76ffdad73bd', '2022-11-24 11:39:39', '2022-11-24 11:40:18'),
(6, '00006/DN/251122', 'Erfandi Bagus', NULL, '2022-11-25 06:10:04', 'Donasi', NULL, 2, '1669356604', 325000, 'Berhasil', '2022-11-25 13:10:06', NULL, NULL, '45054a67-a3bc-4d0f-9601-25565b865ab0', '2022-11-25 06:10:04', '2022-11-25 06:10:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `campaignfunds`
--

CREATE TABLE `campaignfunds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `campaign_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_fund` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `campaignfunds`
--

INSERT INTO `campaignfunds` (`id`, `user_id`, `campaign_id`, `total_fund`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, 505000, '2022-11-24 02:39:51', '2022-11-25 06:19:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `campaigns`
--

CREATE TABLE `campaigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `province_id` bigint(20) UNSIGNED DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subdistrict_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `nominal` double NOT NULL DEFAULT 0,
  `waktu_tenggat` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `views` double NOT NULL DEFAULT 0,
  `gallery_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `campaigns`
--

INSERT INTO `campaigns` (`id`, `user_id`, `category_id`, `province_id`, `district_id`, `subdistrict_id`, `title`, `slug`, `nominal`, `waktu_tenggat`, `description`, `image`, `views`, `gallery_id`, `status_id`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 1, 1, 1, 'Open Donasi Pembangunan Masjid Jami\' Al-Basyariyah', 'open-donasi-pembangunan-masjid-jami-al-basyariyah', 1000000, '2022-11-30', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labor et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less</p><blockquote><p>Donasi sekarang, karena semakin banyak donasi tersedia, semakin besar bantuan yang bisa disalurkan.</p></blockquote><p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labor et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>', 'uploads/mVGkGkYZglNBnBUImDEbZGzZKgxdtDoBHWEKHZIi.jpg', 449, NULL, 2, '2022-11-16 16:06:59', '2022-11-29 11:48:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Bencana Alam', 'bencana-alam', '2022-11-12 02:08:11', '2022-11-12 02:08:11'),
(2, 'Rumah Ibadah', 'rumah-ibadah', '2022-11-12 02:08:11', '2022-11-12 02:08:11'),
(3, 'Anak & Balita Sakit', 'anak-balita-sakit', '2022-11-12 02:08:11', '2022-11-12 02:08:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campaign_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `danafunditems`
--

CREATE TABLE `danafunditems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dana_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `npwp` varchar(255) DEFAULT NULL,
  `is_anonim` double NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `no_transaksi` varchar(255) DEFAULT NULL,
  `transaction_time` timestamp NULL DEFAULT NULL,
  `transaction_type` varchar(255) DEFAULT NULL,
  `penerima_dana` varchar(255) DEFAULT NULL,
  `order_id` time DEFAULT NULL,
  `gross_amount` double NOT NULL DEFAULT 0,
  `transaction_status` varchar(255) NOT NULL,
  `transaction_status_time` timestamp NULL DEFAULT NULL,
  `snap_token` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `danafunds`
--

CREATE TABLE `danafunds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dana_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_fund` double NOT NULL DEFAULT 0,
  `penarikan_fund` double NOT NULL DEFAULT 0,
  `sisa_fund` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `province_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `districts`
--

INSERT INTO `districts` (`id`, `province_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jember', '2022-11-12 02:08:11', '2022-11-12 02:08:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `donations`
--

CREATE TABLE `donations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `campaign_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nominal` double NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Struktur dari tabel `funditems`
--

CREATE TABLE `funditems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_time` timestamp NULL DEFAULT NULL,
  `transaction_type` varchar(255) DEFAULT NULL,
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `campaign_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `gross_amount` double NOT NULL DEFAULT 0,
  `transaction_status` varchar(255) NOT NULL,
  `transaction_status_time` timestamp NULL DEFAULT NULL,
  `snap_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `funditems`
--

INSERT INTO `funditems` (`id`, `user_id`, `transaction_time`, `transaction_type`, `bank_id`, `campaign_id`, `transaction_id`, `order_id`, `gross_amount`, `transaction_status`, `transaction_status_time`, `snap_token`, `created_at`, `updated_at`) VALUES
(42, 1, '2022-11-17 09:51:40', 'Topup', NULL, NULL, NULL, '1668678700', 50000, 'Berhasil', '2022-11-17 09:51:45', 'b296b356-b1f1-4947-8867-ad75d9f473b8', '2022-11-17 09:51:41', '2022-11-17 09:52:19'),
(44, 1, '2022-11-17 10:06:29', 'Topup', NULL, NULL, NULL, '1668679589', 30000, 'Berhasil', '2022-11-17 10:20:22', 'bada75ef-be60-456e-a355-1c166700db86', '2022-11-17 10:06:30', '2022-11-17 10:20:57'),
(49, 1, '2022-11-17 23:46:16', 'Donasi', NULL, 2, NULL, '1668728776', 40000, 'Berhasil', NULL, NULL, '2022-11-17 23:46:16', '2022-11-17 23:46:16'),
(51, 1, '2022-11-18 00:22:16', 'Penarikan', 1, NULL, NULL, '1668730936', 20000, 'Menunggu', NULL, NULL, '2022-11-18 00:22:16', '2022-11-18 00:22:16'),
(52, 1, '2022-11-18 15:16:34', 'Topup', NULL, NULL, NULL, '1668759394', 50, 'Berhasil', '2022-11-18 16:43:25', '9a296a15-9496-40e6-8df9-226d4744e189', '2022-11-18 15:16:34', '2022-11-18 16:44:01'),
(53, 1, '2022-11-18 15:18:43', 'Topup', NULL, NULL, NULL, '1668759523', 50000, 'Berhasil', '2022-11-18 16:42:32', 'e1167e4b-8bd3-4659-bfcd-38c31f0e0b7b', '2022-11-18 15:18:43', '2022-11-18 16:43:08'),
(54, 1, '2022-11-18 16:46:53', 'Topup', NULL, NULL, NULL, '1668764813', 100000, 'Menunggu', '2022-11-18 16:46:58', '86bd1985-c65d-491f-9af0-b90b24b22f79', '2022-11-18 16:46:53', '2022-11-18 16:47:02'),
(55, 1, '2022-11-18 19:43:17', 'Topup', NULL, NULL, NULL, '1668775397', 30000, 'Menunggu', NULL, 'e471fe51-1bc8-47b2-917a-d07958c9305d', '2022-11-18 19:43:17', '2022-11-18 19:43:17'),
(56, 1, '2022-11-19 12:35:06', 'Penarikan', 1, NULL, NULL, '1668836106', 50, 'Berhasil', NULL, NULL, '2022-11-19 12:35:06', '2022-11-19 12:36:04'),
(58, 1, '2022-11-19 14:35:20', 'Donasi', NULL, 2, NULL, '1668843320', 25000, 'Berhasil', NULL, NULL, '2022-11-19 14:35:20', '2022-11-19 14:35:20'),
(59, 1, '2022-11-22 12:50:26', 'Topup', NULL, NULL, NULL, '1669096226', 100000, 'Menunggu', '2022-11-22 12:50:37', '0cd92bd2-1bbc-4fd6-a188-84274c73f602', '2022-11-22 12:50:29', '2022-11-22 12:50:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `funds`
--

CREATE TABLE `funds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_fund` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `funds`
--

INSERT INTO `funds` (`id`, `user_id`, `total_fund`, `created_at`, `updated_at`) VALUES
(4, 1, 40000, '2022-11-17 09:51:41', '2022-11-19 14:35:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeries`
--

CREATE TABLE `galeries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `access` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `levels`
--

INSERT INTO `levels` (`id`, `name`, `access`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'Kampanye Donasi.index,Kampanye Penarikan.destroy,Kampanye Penarikan.edit,Kampanye Penarikan.index,Kampanye Penarikan.show,Kampanye Penarikan.store,Kampanye Penarikan.update,abouts.index,abouts.show,abouts.update,banks.destroy,banks.index,banks.show,banks.store,banks.update,campaigns.create,campaigns.destroy,campaigns.edit,campaigns.index,campaigns.show,campaigns.store,campaigns.update,categories.destroy,categories.edit,categories.index,categories.show,categories.store,categories.update,districts.destroy,districts.edit,districts.index,districts.show,districts.store,districts.update,levels.destroy,levels.edit,levels.index,levels.store,levels.update,menus.destroy,menus.index,menus.show,menus.store,menus.update,pages.create,pages.destroy,pages.edit,pages.index,pages.store,pages.update,postcategories.destroy,postcategories.index,postcategories.show,postcategories.store,postcategories.update,posts.create,posts.destroy,posts.edit,posts.index,posts.store,posts.update,posts.upload,provinces.destroy,provinces.edit,provinces.index,provinces.show,provinces.store,provinces.update,sections.index,sections.show,sections.update,settings.index,settings.show,settings.update,sliders.create,sliders.destroy,sliders.edit,sliders.index,sliders.store,sliders.update,statuses.destroy,statuses.edit,statuses.index,statuses.show,statuses.store,statuses.update,subdistricts.destroy,subdistricts.edit,subdistricts.index,subdistricts.show,subdistricts.store,subdistricts.update,users.create,users.destroy,users.edit,users.index,users.store,users.update,withdrawals.index,withdrawals.show,withdrawals.update,zakatcollectionunits.create,zakatcollectionunits.destroy,zakatcollectionunits.edit,zakatcollectionunits.index,zakatcollectionunits.show,zakatcollectionunits.store,zakatcollectionunits.update', '2022-11-12 02:08:11', '2022-11-29 00:43:01'),
(2, 'User', 'campaigns.create,campaigns.destroy,campaigns.edit,campaigns.index,campaigns.store,campaigns.update,funds.create,funds.destroy,funds.edit,funds.index,funds.show,funds.store,funds.update', '2022-11-15 01:59:53', '2022-11-17 02:13:39');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `name`, `link`, `child`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'Beranda', '/', NULL, 1, '2022-11-12 02:08:11', '2022-11-12 02:08:11'),
(2, 'Profil', '#', NULL, 3, '2022-11-12 02:32:07', '2022-11-22 12:23:45'),
(3, 'Jemput Zakat, Infak Shodaqoh Go Z', '/pages/jemput-zakat-infak-shodaqoh-go-z', 16, 4.1, '2022-11-12 02:32:44', '2022-11-21 09:12:44'),
(4, 'Berita', '/posts', NULL, 7, '2022-11-12 02:33:12', '2022-11-22 12:16:02'),
(6, 'Hubungi', '/contacts', NULL, 8, '2022-11-12 02:33:44', '2022-11-22 12:24:01'),
(7, 'Tentang', '/pages/tentang-kami', 2, 3.1, '2022-11-12 02:34:38', '2022-11-22 12:23:37'),
(8, 'Visi Misi', '/pages/visi-dan-misi', 2, 3.2, '2022-11-12 02:34:48', '2022-11-21 09:01:36'),
(9, 'Struktur Organisasi', '#', 2, 3.3, '2022-11-21 08:59:26', '2022-11-21 09:00:50'),
(10, 'Mitra', '#', 2, 3.4, '2022-11-21 08:59:41', '2022-11-21 09:00:55'),
(11, 'Rencana Kerja', '#', 2, 3.5, '2022-11-21 08:59:52', '2022-11-21 09:01:02'),
(12, 'Kebijakan Mutu', '#', 2, 3.6, '2022-11-21 09:00:04', '2022-11-21 09:01:06'),
(13, 'Program', '#', NULL, 5, '2022-11-21 09:02:15', '2022-11-21 09:02:15'),
(14, 'Jember Super Charity', '/campaigns', 13, 5.1, '2022-11-21 09:03:06', '2022-11-21 09:10:10'),
(15, 'Jember Sehat', '#', 13, 5.2, '2022-11-21 09:03:38', '2022-11-21 09:03:38'),
(16, 'Layanan', '#', NULL, 4, '2022-11-21 09:04:10', '2022-11-21 09:04:10'),
(17, 'Produk', '#', NULL, 6, '2022-11-21 09:05:06', '2022-11-21 09:05:06'),
(18, 'Zakat Profesi', '#', 17, 6.1, '2022-11-21 09:05:51', '2022-11-21 09:05:51'),
(19, 'Zakat Pertanian', '#', 17, 6.2, '2022-11-21 09:06:08', '2022-11-21 09:06:08'),
(20, 'Zakat Emas, Perak dan Uang', '#', 17, 6.3, '2022-11-21 09:06:28', '2022-11-21 09:06:37'),
(21, 'Zakat Perniagaan', '#', 17, 6.4, '2022-11-21 09:06:57', '2022-11-21 09:06:57'),
(22, 'Zakat Saham dan Obligasi', '#', 17, 6.5, '2022-11-21 09:07:13', '2022-11-21 09:07:13'),
(23, 'Unit Pengumpul Zakat', '/zakatcollectionunits', 16, 4.2, '2022-11-21 09:12:57', '2022-11-21 09:12:57'),
(24, 'Konsultasi online', '#', 16, 4.3, '2022-11-21 09:13:14', '2022-11-21 09:13:14'),
(25, 'Kalkulator Zakat', '/kalkulator-zakat', 16, 4.4, '2022-11-21 09:13:26', '2022-11-21 09:13:26');

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
(5, '2022_11_06_064323_create_campaigns_table', 1),
(6, '2022_11_06_065222_create_comments_table', 1),
(7, '2022_11_06_065800_create_categories_table', 1),
(8, '2022_11_06_070103_create_galeries_table', 1),
(9, '2022_11_06_070720_create_provinces_table', 1),
(10, '2022_11_06_070858_create_districts_table', 1),
(11, '2022_11_06_071021_create_donations_table', 1),
(12, '2022_11_06_071402_create_withdrawals_table', 1),
(13, '2022_11_06_071601_create_statuses_table', 1),
(14, '2022_11_06_071855_create_subdistricts_table', 1),
(15, '2022_11_06_072035_create_banks_table', 1),
(16, '2022_11_06_072144_create_funds_table', 1),
(17, '2022_11_06_080136_create_levels_table', 1),
(18, '2022_11_08_044016_create_sections_table', 1),
(19, '2022_11_08_050723_create_abouts_table', 1),
(20, '2022_11_08_050750_create_menus_table', 1),
(21, '2022_11_08_051105_create_sliders_table', 1),
(22, '2022_11_08_051123_create_settings_table', 1),
(23, '2022_11_08_100649_create_posts_table', 1),
(24, '2022_11_08_150121_create_pages_table', 1),
(25, '2022_11_08_161051_create_postcategories_table', 1),
(26, '2022_11_17_062336_create_campaignfunds_table', 2),
(31, '2022_11_17_062727_create_funditems_table', 3),
(32, '2022_11_17_062747_create_campaignfunditems_table', 3);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `image`, `body`, `user_id`, `views`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Tentang Kami', 'tentang-kami', 'uploads/JWGYZBwyHdcvYfFYjSJPpu8BPYBlRg71vfWAD3NY.jpg', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro.</p>', 1, 90, 1, '2022-11-12 03:36:09', '2022-12-01 08:55:21'),
(2, 'Visi dan Misi', 'visi-dan-misi', 'uploads/KBhWVCFttWE1qanz38JhakVZMWLzCjtwwpdVzVY3.jpg', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro.</p>', 1, 16, 1, '2022-11-12 03:36:23', '2022-11-25 15:13:49'),
(3, 'Jemput Zakat, Infak Shodaqoh Go Z', 'jemput-zakat-infak-shodaqoh-go-z', 'uploads/KWCqat68anwAGv07VmbLumDfiqtJxnc8BI6DFTXG.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labor et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less</p><blockquote><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labor et dolore magna aliqua. Ut enim ad minim veniam,</p></blockquote><p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labor et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>', 1, 18, 1, '2022-11-25 15:15:47', '2022-11-30 03:38:43');

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
-- Struktur dari tabel `postcategories`
--

CREATE TABLE `postcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `postcategories`
--

INSERT INTO `postcategories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Edukasi', 'edukasi', '2022-11-12 03:13:48', '2022-11-12 03:13:48'),
(2, 'Tips', 'tips', '2022-11-12 03:13:52', '2022-11-12 03:13:52'),
(3, 'Press Release', 'press-release', '2022-11-12 03:14:03', '2022-11-12 03:14:03'),
(4, 'Informasi', 'informasi', '2022-11-12 03:33:18', '2022-11-12 03:33:18');

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
  `postcategory_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `views` double NOT NULL DEFAULT 0,
  `status_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `image`, `body`, `postcategory_id`, `tag_id`, `user_id`, `views`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 'Donate for nutration less poor orang', 'donate-for-nutration-less-poor-orang', 'uploads/clUXvvx6N2nS6h947xwaRzOOzgLSW6fruJzqfUjz.jpg', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(117,117,117);\">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro.</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgb(117,117,117);\">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro.</span></p>', 4, NULL, 1, 6, 2, '2022-11-12 03:32:11', '2022-11-27 03:24:31'),
(2, 'Charity meetup in Berline next year', 'charity-meetup-in-berline-next-year', 'uploads/XyX0hLn5mxTmTp5RO4dAvh2bgt3ztcvjasRMeTTW.jpg', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(117,117,117);\">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro.</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgb(117,117,117);\">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro.</span></p>', 4, NULL, 1, 8, 2, '2022-11-12 03:34:12', '2022-12-01 06:23:48'),
(3, 'Donate for the poor orang to help them', 'donate-for-the-poor-orang-to-help-them', 'uploads/uH2ulmVWVGYcwP7NG9IyaElaAGXasns64PpT7gem.jpg', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(117,117,117);\">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro.</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgb(117,117,117);\">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore minima atque obcaecati deleniti tempora, cumque molestiae consectetur provident temporibus natus iste accusamus totam voluptas quas suscipit blanditiis fuga quibusdam porro.</span></p>', 4, NULL, 1, 14, 2, '2022-11-12 03:35:27', '2022-11-22 15:20:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `provinces`
--

INSERT INTO `provinces` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Jawa Timur', '2022-11-12 02:08:11', '2022-11-12 02:08:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sections`
--

INSERT INTO `sections` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Slider', 'sliders', 1, '2022-11-12 02:08:11', '2022-11-12 02:17:45'),
(2, 'Tentang Kami', 'about', 1, '2022-11-12 02:08:11', '2022-11-12 02:17:48'),
(3, 'Donasi', 'donation', 1, '2022-11-12 02:08:11', '2022-11-12 02:17:42'),
(4, 'Berita Terbaru', 'posts', 1, '2022-11-12 02:08:11', '2022-11-12 02:17:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `harga_emas` double DEFAULT NULL,
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
  `latitude` text DEFAULT NULL,
  `longitude` text DEFAULT NULL,
  `map` text DEFAULT NULL,
  `code` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `name`, `harga_emas`, `main_logo`, `sec_logo`, `favicon`, `description`, `address`, `email`, `telp`, `facebook`, `twitter`, `instagram`, `whatsapp`, `telegram`, `youtube`, `tiktok`, `latitude`, `longitude`, `map`, `code`, `created_at`, `updated_at`) VALUES
(1, 'BAZNAS JEMBER', NULL, 'uploads/DtfV12PWmeMWQYGlmDWjhjIyR3lpUiAMu2odGbMc.png', 'uploads/V49jhGMwv4QKUtxMkXeSZ7wDCI3yOvtwrTmwDhbs.png', 'uploads/W9u7whiR4bTeAse90fComHnVQPMV2abCpkVSTyhd.png', 'Fundraising for helpless and causes you care about. We exist for non-profits, social enterprises, community groups, activists,lorem politicians and individual citizens that are making.', 'Jl. Karimata No 11 Jember', 'febript@gmail.com', '033188123123', '#', '#', '#', '6282336966714', '#', '#', NULL, NULL, NULL, NULL, NULL, '2022-11-12 02:08:11', '2022-11-25 06:30:39');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `desktop`, `mobile`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Slider 3', 'uploads/U8hGbH3COTwFIYMkCJEdRHrtIhF2FbEu8difCPVW.jpg', 'uploads/XILQHRdjHzGgVfCwUSAUc3zKmaFAv928hMpKki0s.jpg', 0, '2022-11-22 13:17:52', '2022-11-22 13:17:52'),
(4, 'Slider 2', 'uploads/hQ61YOJlj4YsKCxdDuJDm3Vhco6RJBsuspJ9Cbag.jpg', 'uploads/l1sMj19WbCzM431whH1TY0xJ4bNh2lwPFpjlQ0KJ.jpg', 0, '2022-11-22 13:19:03', '2022-11-22 13:19:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Menunggu', '2022-11-12 02:08:11', '2022-11-12 02:08:11'),
(2, 'Publish', '2022-11-12 02:08:11', '2022-11-12 02:08:11'),
(3, 'Ditolak', '2022-11-12 02:08:11', '2022-11-12 02:08:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subdistricts`
--

CREATE TABLE `subdistricts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `province_id` bigint(20) UNSIGNED DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `subdistricts`
--

INSERT INTO `subdistricts` (`id`, `province_id`, `district_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Tanggul', '2022-11-12 02:08:11', '2022-11-12 02:08:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `address` text DEFAULT NULL,
  `no_phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `province_id` bigint(20) UNSIGNED DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subdistrict_id` bigint(20) UNSIGNED DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `level_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `address`, `no_phone`, `password`, `province_id`, `district_id`, `subdistrict_id`, `photo`, `level_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', 'febript@gmail.com', '2022-11-12 02:08:11', NULL, NULL, '$2y$10$nLaR.8QRTurxpPlwSDdtjOX0tku93hodpSjMpcSasL9ydA5cPBNf6', NULL, NULL, NULL, NULL, 1, 1, 'v7MetuT6fZzMwubuyM4PlSYopXZv3GZEmL8J217nwSUDkrURHiBV9je6wLeb', '2022-11-12 02:08:11', '2022-11-17 01:40:16'),
(4, 'figo', 'figo', 'febriarc1@gmail.com', NULL, 'Jember', '08123456789', '$2y$10$k8qsMmxGMJNYo/AFiG4kwOl/hCR8tfO3XrP9xu.2fAQAEkbJ9m5v.', 1, 1, 1, NULL, 2, 1, 'hr2QdPaAf8me4S02jZPM1VHxUpI2brIka0Lq2DxuNsC2qX9tOYAMQEWFCsBw', '2022-11-15 02:02:46', '2022-11-18 15:31:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_transaksi` varchar(255) DEFAULT NULL,
  `campaignfunditem_id` bigint(20) UNSIGNED DEFAULT NULL,
  `funditem_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `no_transaksi`, `campaignfunditem_id`, `funditem_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, NULL, '2022-11-24 02:43:25', '2022-11-24 02:43:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `zakatcollectionunits`
--

CREATE TABLE `zakatcollectionunits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `province_id` bigint(20) DEFAULT NULL,
  `district_id` bigint(20) DEFAULT NULL,
  `subdistrict_id` bigint(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kontak` varchar(255) DEFAULT NULL,
  `lokasi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `zakatcollectionunits`
--

INSERT INTO `zakatcollectionunits` (`id`, `user_id`, `name`, `slug`, `province_id`, `district_id`, `subdistrict_id`, `alamat`, `kontak`, `lokasi`, `created_at`, `updated_at`) VALUES
(2, 1, 'Rumah Firdis', 'rumah-firdis', NULL, NULL, NULL, 'Jalan Sriwijaya 8', '098789798797', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1363.335908331381!2d113.72055392246548!3d-8.18496140555488!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6967c85870921%3A0x4b6f8e2ec50c146b!2sJl.%20Sriwijaya%2C%20Kec.%20Kaliwates%2C%20Kabupaten%20Jember%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1669515294194!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '2022-11-26 18:40:13', '2022-11-27 18:55:29'),
(3, 1, 'nanang', 'nanang', 1, 1, 1, 'sadadsad', '65765756756', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d830.2554045032821!2d113.44854780280485!3d-8.164159324316843!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd68b2b688a45f3%3A0x7daf46cebed10b15!2sToko%20Bu%20Tris!5e0!3m2!1sid!2sid!4v1669596681373!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '2022-11-27 17:51:34', '2022-11-27 17:51:34');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `campaignfunditems`
--
ALTER TABLE `campaignfunditems`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `campaignfunds`
--
ALTER TABLE `campaignfunds`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `danafunditems`
--
ALTER TABLE `danafunditems`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `danafunds`
--
ALTER TABLE `danafunds`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `funditems`
--
ALTER TABLE `funditems`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `funds`
--
ALTER TABLE `funds`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `galeries`
--
ALTER TABLE `galeries`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `levels`
--
ALTER TABLE `levels`
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
-- Indeks untuk tabel `postcategories`
--
ALTER TABLE `postcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `postcategories_name_unique` (`name`),
  ADD UNIQUE KEY `postcategories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Indeks untuk tabel `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sections`
--
ALTER TABLE `sections`
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
-- Indeks untuk tabel `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `subdistricts`
--
ALTER TABLE `subdistricts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `zakatcollectionunits`
--
ALTER TABLE `zakatcollectionunits`
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
-- AUTO_INCREMENT untuk tabel `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `campaignfunditems`
--
ALTER TABLE `campaignfunditems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `campaignfunds`
--
ALTER TABLE `campaignfunds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `danafunditems`
--
ALTER TABLE `danafunditems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `danafunds`
--
ALTER TABLE `danafunds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `donations`
--
ALTER TABLE `donations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `funditems`
--
ALTER TABLE `funditems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `funds`
--
ALTER TABLE `funds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `galeries`
--
ALTER TABLE `galeries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `postcategories`
--
ALTER TABLE `postcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `subdistricts`
--
ALTER TABLE `subdistricts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `zakatcollectionunits`
--
ALTER TABLE `zakatcollectionunits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
