-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jun 2024 pada 05.35
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
-- Database: `kafe`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `nama`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', 'makanan', '2024-06-13 03:24:24', '2024-06-13 03:24:24'),
(2, 'Minuman', 'minuman', '2024-06-13 03:28:24', '2024-06-13 03:28:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categoryconsultations`
--

CREATE TABLE `categoryconsultations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `consultationreplies`
--

CREATE TABLE `consultationreplies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consultation_id` bigint(20) UNSIGNED NOT NULL,
  `jawaban` text NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `consultations`
--

CREATE TABLE `consultations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `categoryconsultation_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `statusconsultation_id` bigint(20) UNSIGNED DEFAULT NULL,
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
(1, 'Administrator', 'categories.destroy,categories.edit,categories.index,categories.show,categories.store,categories.update,konsultasi.create,konsultasi.destroy,konsultasi.destroy_reply,konsultasi.edit,konsultasi.index,konsultasi.store,konsultasi.update,levels.destroy,levels.edit,levels.index,levels.store,levels.update,menus.create,menus.destroy,menus.edit,menus.index,menus.show,menus.store,menus.update,orderitems.create,orderitems.destroy,orderitems.edit,orderitems.index,orderitems.show,orderitems.store,orderitems.update,orders.create,orders.destroy,orders.edit,orders.index,orders.store,orders.update,orderskasir.create,orderskasir.destroy,orderskasir.edit,orderskasir.index,orderskasir.store,orderskasir.update,pendapatans.detail,pendapatans.index,profile.index,profile.update,settings.index,settings.update,statusconsultations.destroy,statusconsultations.edit,statusconsultations.index,statusconsultations.show,statusconsultations.store,statusconsultations.update,statusorders.destroy,statusorders.edit,statusorders.index,statusorders.show,statusorders.store,statusorders.update,users.create,users.destroy,users.edit,users.index,users.store,users.update,whatsapp.auth,whatsapp.destroy,whatsapp.index,whatsapp.resend,whatsapp.reset,whatsapp.scan', NULL, '2024-06-13 03:22:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `harga` double NOT NULL DEFAULT 0,
  `diskon` double NOT NULL DEFAULT 0,
  `deskripsi` text DEFAULT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `nama`, `slug`, `photo`, `category_id`, `harga`, `diskon`, `deskripsi`, `aktif`, `created_at`, `updated_at`) VALUES
(1, 'figo', 'figo', 'uploads/VqpRsGxN44QtwGk8qgIhRnFqytC8KPCwkY1Auyje.png', 1, 10000, 10, 'enak', 1, '2024-06-13 03:25:13', '2024-06-13 03:25:13'),
(2, 'susu', 'susu', NULL, 2, 5000, 0, 'enak', 1, '2024-06-13 03:29:00', '2024-06-13 03:29:00');

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
(5, '2022_09_08_020359_create_settings_table', 1),
(6, '2022_11_05_001141_create_levels_table', 1),
(7, '2022_11_05_001337_create_categories_table', 1),
(8, '2022_11_05_001451_create_menus_table', 1),
(9, '2022_11_05_002000_create_statusorders_table', 1),
(10, '2022_11_05_002040_create_orders_table', 1),
(11, '2022_11_05_002530_create_orderitems_table', 1),
(12, '2022_11_05_002832_create_payments_table', 1),
(13, '2022_11_05_003310_create_categoryconsultations_table', 1),
(14, '2022_11_05_003738_create_consultations_table', 1),
(15, '2022_11_05_005222_create_consultationreplies_table', 1),
(16, '2022_11_05_014245_create_walogs_table', 1),
(17, '2022_11_05_014614_create_statusconsultations_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orderitems`
--

CREATE TABLE `orderitems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `qty` double NOT NULL DEFAULT 0,
  `harga` double NOT NULL DEFAULT 0,
  `diskon` double NOT NULL DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orderitems`
--

INSERT INTO `orderitems` (`id`, `order_id`, `menu_id`, `qty`, `harga`, `diskon`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 10000, 0, NULL, '2024-06-13 03:26:06', '2024-06-13 03:26:06'),
(2, 4, 1, 1, 10000, 0, NULL, '2024-06-13 03:29:30', '2024-06-13 03:29:30'),
(3, 4, 2, 1, 5000, 0, NULL, '2024-06-13 03:29:30', '2024-06-13 03:29:30'),
(4, 5, 2, 1, 5000, 0, NULL, '2024-06-13 03:34:01', '2024-06-13 03:34:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faktur` varchar(255) NOT NULL,
  `meja` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `total` double NOT NULL DEFAULT 0,
  `total_diskon` double NOT NULL DEFAULT 0,
  `total_order` double NOT NULL DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  `status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `faktur`, `meja`, `nama`, `whatsapp`, `total`, `total_diskon`, `total_order`, `keterangan`, `status_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, '00002/OD/130624', 1, 'figo', '081331562302', 10000, 0, 10000, NULL, 1, NULL, '2024-06-13 03:26:06', '2024-06-13 03:26:06'),
(4, '00003/OD/130624', 2, 'figo', '081331562302', 15000, 0, 15000, NULL, 1, NULL, '2024-06-13 03:29:30', '2024-06-13 03:32:33'),
(5, '00005/OD/130624', 3, 'suti', '081331562302', 5000, 0, 5000, NULL, 1, NULL, '2024-06-13 03:34:01', '2024-06-13 03:34:01');

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
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `bayar` double NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_company` varchar(255) NOT NULL,
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
(1, 'Layanan', 'n', 'uploads/zOgopqwvd45DX0sz6O4vSVv1glXH3UEhxbO9Xghk.png', NULL, 'uploads/Qivnd6QvFowncKoSbIe3PT9Ecpwp4cmdQON7r6ff.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-13 03:27:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `statusconsultations`
--

CREATE TABLE `statusconsultations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `statusorders`
--

CREATE TABLE `statusorders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `statusorders`
--

INSERT INTO `statusorders` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Tunggu', '2024-06-13 03:24:36', '2024-06-13 03:24:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
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

INSERT INTO `users` (`id`, `name`, `username`, `email`, `whatsapp`, `password`, `level_id`, `status`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', 'erfandibagus532@gmail.com', '081331562302', '$2y$10$gl3Xss0rKdjwuq/IxAxgP.zfGgEjrFoJ8Cd6cfH9hdBWIscH.RI1u', 1, 1, '2024-06-13 03:05:11', 'ifn37ETRwfR3x6lEDfWW2duLvs4JQ7SmAUQGl4fnPrKoMywmh771Q1OJDDg3', '2024-06-13 03:05:11', '2024-06-13 03:05:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `walogs`
--

CREATE TABLE `walogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
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
(1, 'figo', '081331562302', 'Selamat order telah kami terima, segera akan kami proses, silahkan lakukan pembayaran di kasir, berikut detail order anda :\nhttp://127.0.0.1:8000/detail/orders/2/detail', 0, 0, '2024-06-13 03:26:14', '2024-06-13 03:26:14'),
(2, 'figo', '081331562302', 'Selamat order telah kami terima, segera akan kami proses, silahkan lakukan pembayaran di kasir, berikut detail order anda :\nhttp://127.0.0.1:8000/detail/orders/4/detail', 0, 0, '2024-06-13 03:29:30', '2024-06-13 03:29:30'),
(3, 'suti', '081331562302', 'Selamat order telah kami terima, segera akan kami proses, silahkan lakukan pembayaran di kasir, berikut detail order anda :\nhttp://127.0.0.1:8000/detail/orders/5/detail', 0, 0, '2024-06-13 03:34:02', '2024-06-13 03:34:02');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_nama_unique` (`nama`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `categoryconsultations`
--
ALTER TABLE `categoryconsultations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categoryconsultations_nama_unique` (`nama`);

--
-- Indeks untuk tabel `consultationreplies`
--
ALTER TABLE `consultationreplies`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `consultations_nomor_unique` (`nomor`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `levels_nama_unique` (`nama`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_nama_unique` (`nama`),
  ADD UNIQUE KEY `menus_slug_unique` (`slug`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_faktur_unique` (`faktur`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `statusconsultations`
--
ALTER TABLE `statusconsultations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `statusorders`
--
ALTER TABLE `statusorders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `statusorders_nama_unique` (`nama`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_whatsapp_unique` (`whatsapp`);

--
-- Indeks untuk tabel `walogs`
--
ALTER TABLE `walogs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `categoryconsultations`
--
ALTER TABLE `categoryconsultations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `consultationreplies`
--
ALTER TABLE `consultationreplies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `consultations`
--
ALTER TABLE `consultations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `statusconsultations`
--
ALTER TABLE `statusconsultations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `statusorders`
--
ALTER TABLE `statusorders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `walogs`
--
ALTER TABLE `walogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
