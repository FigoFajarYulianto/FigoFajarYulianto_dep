-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jun 2024 pada 05.39
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
-- Database: `dp3akb`
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
(1, 'Tentang Kami', '/pages/tentang-kami', 'uploads/ERhA2LirxGHilpwCsp2wLx2qFTMcBNk99RLRp2FR.jpg', '<div>DP3KAB merupakan unsur pelaksana urusan pemerintahan di bidang pemberdayaan perempuan dan perlindungan anak serta urusan pemerintahan di bidang pengendalian penduduk dan keluarga berencana.&nbsp;<br><br><br><br><br></div>', '2022-11-30 02:15:29', '2022-12-04 09:56:12');

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
(1, 'Kami Siap Melayani', 'uploads/W1cKaSAFZg7nUf7RkJe6oiNv2a7G2MP87OJhmQrZ.jpg', '<div>Dengan Petugas yang Sigap dan Professional, kami sangat siap untuk melayani dengan hati yang tulus untuk semua warga&nbsp;</div>', '/contact', NULL, '2022-08-06 02:08:41', '2022-12-04 02:06:00');

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
(1, 2, NULL, 'Erfandi Bagus', 'erfandibagus532@gmail.com', 'Test komentar pertama', '2022-08-08 01:33:06', '2022-08-07 04:59:14', '2022-08-08 01:33:06'),
(2, 2, 1, 'Administrator', 'erfandibagus532@gmail.com', 'Balasan test komentar pertama', '2022-08-08 01:33:06', '2022-08-07 04:59:48', '2022-08-08 01:33:06'),
(3, 8, NULL, 'Erfandi Bagus', 'erfandibagus532@gmail.com', 'Test komentar', '2022-08-11 14:19:07', '2022-08-11 06:01:56', '2022-08-11 14:19:07'),
(4, 8, 3, 'Administrator', 'erfandibagus532@gmail.com', 'Test balas komentar', '2022-08-11 14:19:07', '2022-08-11 06:02:44', '2022-08-11 14:19:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `consultations`
--

CREATE TABLE `consultations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_konsultasi` varchar(255) DEFAULT NULL,
  `nik` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `servicecategory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jk` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `konsultasi` text NOT NULL,
  `jawaban` text DEFAULT NULL,
  `status_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `consultations`
--

INSERT INTO `consultations` (`id`, `id_konsultasi`, `nik`, `name`, `servicecategory_id`, `jk`, `email`, `phone`, `alamat`, `konsultasi`, `jawaban`, `status_id`, `created_at`, `updated_at`) VALUES
(1, '00001/KN/091222', '32498237492837', 'Rosyid', 4, 'laki-laki', NULL, '085156672438', 'jember', 'test', NULL, 1, '2022-12-09 08:49:12', '2022-12-09 09:20:19');

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
-- Struktur dari tabel `kelurahans`
--

CREATE TABLE `kelurahans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `lurah` varchar(255) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelurahans`
--

INSERT INTO `kelurahans` (`id`, `name`, `slug`, `lurah`, `nip`, `photo`, `banner`, `address`, `telp`, `email`, `about`, `lat`, `long`, `url`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'KELURAHAN SUMBERSARI', 'kelurahan-sumbersari', 'DENDHY RADIANT, S.STP', '19811220 200012 1 001', 'uploads/DLRsFOcqp8Vz9xUTFd8zxlyiJNogG1etPZA0Tg8s.jpg', 'uploads/eli6z5pHSrcdOTfJZOpdFxCMYb6U2B7x0aezuTXD.jpg', 'JL. Halmahera 49 Sumbersari Jember', NULL, NULL, 'Kelurahan Sumbersari merupakan Kelurahan Sumbersari merupakan Kelurahan Sumbersari merupakan Kelurahan Sumbersari merupakan Kelurahan Sumbersari merupakan Kelurahan Sumbersari merupakan', '-8.172598', '113.718757', NULL, '2022-08-17 08:04:29', '2022-08-08 02:36:17', '2022-08-17 08:04:29'),
(2, 'Desa Dukuhmencek', 'desa-dukuhmencek', 'NANDA SETIAWAN, SE', '-', 'uploads/7aRSekHQIEivTqBZqDisS0I8So3B6BJfXSodfDKX.jpg', 'uploads/1FjWFO6oDNqEB0vUAf3ZWVojgw32TCAlMzS9DXOU.jpg', 'Jl. Gurami 01 Desa Dukuhmencek - Sukorambi', '0331-000000', 'desadukuhmencekku@gmail.com', 'Dukuhmencek adalah sebuah desa di kecamatan Sukorambi, Jember, Jawa Timur, Indonesia. Desa Dukuhmencek terdiri dari dusun: Ampo, Botosari, Krajan, dan Tengiri.', '-8.168302', '113.648835', 'https://ppid-desa.jemberkab.go.id/pelaksana/detail/158', NULL, '2022-08-08 02:43:03', '2022-08-17 11:10:26'),
(3, 'KELURAHAN KEBONSARI', 'kelurahan-kebonsari', 'HERLAN HIDAYAT, S.Sos', '19700709 200212 1 004', 'uploads/3yM7ZP66CuxRQBie81s4xiqtOglE45Xf6LDAoLJF.jpg', 'uploads/48Gqb1NyAWpDRbgX4vhOUEnl0OkCMLVL0igXwi9z.jpg', 'Jl. Letjen Suprapto No. 99', '0331334433', 'kelkebonsari@gmail.com', 'Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan', '-8.184202', '113.703168', NULL, '2022-08-17 08:04:48', '2022-08-08 03:24:55', '2022-08-17 08:04:48'),
(4, 'KELURAHAN KRANJINGAN', 'kelurahan-kranjingan', 'HARIYANTO, S.Sos', '19690513 200701 1 024', 'uploads/AQ7yELwaiTU6BoIBzzjRluxEHAeJW2JNUDfAC3Wp.jpg', 'uploads/KHFTSMYjUqwYdRy7rVOOrReZ4mlKLbUrFvySl7Qe.jpg', 'Jl. Ajisaka 01 Kranjingan Sumbersari', NULL, NULL, 'Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan', '-8.206622', '113.723129', NULL, '2022-08-17 08:04:44', '2022-08-08 03:27:18', '2022-08-17 08:04:44'),
(5, 'KELURAHAN KARANGREJO', 'kelurahan-karangrejo', 'Drs. MOHAMAD SYAFI’I M.Si', '19660806 199312 1 004', 'uploads/qNNOpjL0Qp0L0DuPlcqr9IaZNGrBSc7m39ccMxfw.jpg', 'uploads/ysyyI8M26zsFrwDBLshIFhJeaNwQxI4R47Zh63rh.jpg', 'Jl.Kapt. Piere Tendean No. 32 Sumbersari Jember', NULL, NULL, 'Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan', '-8.194445', '113.726251', NULL, '2022-08-17 08:04:40', '2022-08-08 03:29:43', '2022-08-17 08:04:40'),
(6, 'KELURAHAN WIROLEGI', 'kelurahan-wirolegi', 'ENDRO LUKITO, S.STP', '19780506 199803 1 003', 'uploads/JWQZHuCeONkF21iZeqyXI3RnlpsKqawevJradD1s.jpg', 'uploads/Ce4mc8BrFmmhfN8kzY53ujz8Bbdv2zOFTt2MF5wP.jpg', 'Jl. MT.Haryono Gg. Mojopahit No. 63 Jember', NULL, NULL, 'Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan', '-8.187160', '113.739759', NULL, '2022-08-17 08:04:37', '2022-08-08 03:33:02', '2022-08-17 08:04:37'),
(7, 'KELURAHAN TEGALGEDE', 'kelurahan-tegalgede', 'ENI UMIATI, SP', '19700915 199802 2 003', 'uploads/oMVkxCtOqNmA9nAjxABKglbY4EKhGXqnBBBiwjLI.jpg', 'uploads/fR7clzIcpTb3xB0Cs2uvcNgDajfNCMrCTjlGFa2s.jpg', 'Jl. Tawang Mangu No. 10, Sumbersari, Jember', NULL, NULL, 'Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan Tentang Kelurahan', '-8.154419', '113.722426', NULL, '2022-08-17 08:04:33', '2022-08-08 03:38:55', '2022-08-17 08:04:33'),
(8, 'Desa Jubung', 'desa-jubung', '-', '-', 'uploads/PEGYlzMwipdhAxAsOL5PefDSeVOzCXOyfqNkjN7t.jpg', 'uploads/qcdf3R0UaDxxHlrMhnLCjG3Dvlus2mw857jQfPPw.jpg', 'Jl. Brawijaya 41 Jember', '085230661338', 'diskominfo@jemberkab.go.id', 'Jubung adalah desa di kecamatan Sukorambi, Jember, Jawa Timur, Indonesia. Desa Jubung terdiri dari dusun Darungan, Jubung Lor dan Krajan.', '-8.195338', '113.638767', 'https://ppid-desa.jemberkab.go.id/pelaksana/detail/159', NULL, '2022-08-17 10:51:46', '2022-08-17 10:51:46'),
(9, 'Desa Klungkung', 'desa-klungkung', 'ABDUL GAFUR', '-', 'uploads/vkSsdhjTaYsKOeZagsz7XeFxwqayqIsqRTRQzqUG.jpg', 'uploads/Io5CGXHOj0P2OEsIw8j8WPyujgzLtg4hPN6kF6FY.jpg', 'RT 002 RW 002 Dusun Krajan Desa Klungkung Kecamatan Sukorambi Kabupaten Jember.', '0331-000000', 'pemdesklungkung45@gmail.com', NULL, '-8.107754', '113.676787', 'https://ppid-desa.jemberkab.go.id/pelaksana/detail/161', NULL, '2022-08-17 10:55:25', '2022-08-17 10:57:04'),
(10, 'Desa Karangpring', 'desa-karangpring', 'AHMAD SAHRI, S.Pd', NULL, 'uploads/0Ljy1SvtIooGbdluzPy5bkr8KbTVFgtNANKYr3e2.jpg', 'uploads/glLnjss4vxX8GMKai1eoAmSjigTSvjdfxh74buay.jpg', 'Jl. Perkebunan Durjo RT.03 RW.03', '0331-000000', 'pemdeskarangpring.72@gmail.com', 'Tentang Kelurahan', '-8.106383', '113.658360', 'https://ppid-desa.jemberkab.go.id/pelaksana/detail/160', NULL, '2022-08-17 11:00:14', '2022-08-17 11:05:19'),
(11, 'Desa Sukorambi', 'desa-sukorambi', 'ABDUS SOIM', '-', 'uploads/et2pTQSVZxWpg4k4Ig9sDA4BrVdhkZ81OV34QH54.jpg', 'uploads/4PigOGNGcwJmWCnV33vdbPFY7J6MFYsuoBi94rNm.jpg', 'JL BRIGJEN SYARIFUDIN NO 07 TELP ( 0331 ) 35.09.15.2003/2022', '0331-000000', 'sukorambidesa@gmail.com', NULL, '-8.151703', '113.666323', 'https://ppid-desa.jemberkab.go.id/pelaksana/detail/162', NULL, '2022-08-17 11:08:07', '2022-08-17 11:14:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `access` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `levels`
--

INSERT INTO `levels` (`id`, `name`, `access`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'Data Konsultasi.destroy,Data Konsultasi.edit,Data Konsultasi.index,Data Konsultasi.show,Data Konsultasi.store,Data Konsultasi.update,Kategori Layanan.destroy,Kategori Layanan.index,Kategori Layanan.show,Kategori Layanan.store,Kategori Layanan.update,Status Layanan.destroy,Status Layanan.edit,Status Layanan.index,Status Layanan.show,Status Layanan.store,Status Layanan.update,Whatsapp.auth,Whatsapp.destroy,Whatsapp.index,Whatsapp.resend,Whatsapp.reset,Whatsapp.scan,abouts.index,abouts.show,abouts.update,calltoactions.index,calltoactions.show,calltoactions.update,levels.destroy,levels.edit,levels.index,levels.store,levels.update,links.create,links.destroy,links.edit,links.index,links.store,links.update,menus.destroy,menus.index,menus.show,menus.store,menus.update,pages.create,pages.destroy,pages.edit,pages.index,pages.store,pages.update,postcategories.destroy,postcategories.index,postcategories.show,postcategories.store,postcategories.update,posts.create,posts.destroy,posts.edit,posts.index,posts.store,posts.update,sections.index,sections.show,sections.update,services.create,services.destroy,services.edit,services.index,services.store,services.update,settings.index,settings.show,settings.update,sliders.create,sliders.destroy,sliders.edit,sliders.index,sliders.store,sliders.update,testimonials.create,testimonials.destroy,testimonials.edit,testimonials.index,testimonials.store,testimonials.update,users.create,users.destroy,users.edit,users.index,users.store,users.update', NULL, '2022-11-30 02:15:29', '2022-12-13 02:41:53'),
(2, 'FORUM ANAK', 'posts.create,posts.destroy,posts.edit,posts.index,posts.store', NULL, '2022-12-05 02:06:17', '2022-12-10 00:58:17'),
(4, 'GENRE', 'posts.create,posts.destroy,posts.edit,posts.index,posts.store', NULL, '2022-12-06 13:52:45', '2022-12-10 00:57:58');

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
(1, 'Pemkab Jember', 'uploads/owfMHQvbWDzC1MDLTpamVllj1zNYvU625s4mVutC.jpg', 'https://jemberkab.go.id/', NULL, '2022-08-06 02:34:38', '2022-12-04 08:46:01'),
(2, 'PPID Kab. Jember', 'uploads/8hzWesV0g8DQg0Oe3Qn8KZFzlGp0R8meIMFJkN8B.jpg', 'https://ppid.jemberkab.go.id/', NULL, '2022-08-06 02:36:50', '2022-12-04 08:45:24'),
(3, 'Diskominfo Kab. Jember', 'uploads/iSJDnZZyVD9x1mQM32WSBNXMukWnuRv94VJUHfUN.jpg', 'https://diskominfo.jemberkab.go.id/', NULL, '2022-08-06 02:38:24', '2022-12-04 08:44:55'),
(4, 'Pemprov Jatim', 'uploads/qfUDriGiz3Lhq635AZ7t9nyZbxDkRoViNyhGXvTu.jpg', 'https://jatimprov.go.id/', NULL, '2022-08-06 02:40:17', '2022-12-04 08:44:45');

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
(1, 'Beranda', '/', NULL, 1, NULL, '2022-08-06 02:26:18', '2022-08-06 02:26:18'),
(2, 'Profil', '#', NULL, 2, NULL, '2022-08-06 02:26:26', '2022-08-06 02:26:26'),
(3, 'Tentang Kami', '/pages/tentang-kami', 2, 2.1, NULL, '2022-08-06 02:26:39', '2022-08-06 10:47:13'),
(4, 'Hubungi Kami', '/contacts', NULL, 7, NULL, '2022-08-06 02:26:53', '2022-12-01 02:44:10'),
(5, 'Visi Misi', '/pages/visi-misi', 2, 2.2, NULL, '2022-08-07 04:34:55', '2022-08-08 01:49:39'),
(6, 'Struktur Organisasi', '/pages/struktur-organisasi', 2, 2.3, NULL, '2022-08-07 07:21:26', '2022-08-08 01:49:58'),
(10, 'Terbaru', '#', NULL, 6, NULL, '2022-08-07 07:23:36', '2022-08-07 07:24:04'),
(11, 'Berita Kegiatan', '/posts?postcategory=berita-kegiatan', 10, 6.1, '2022-08-18 10:09:35', '2022-08-07 07:24:41', '2022-12-01 03:40:49'),
(12, 'Pengumuman', '/posts?postcategory=pengumuman', 10, 6.2, NULL, '2022-08-07 07:25:01', '2022-12-01 03:40:42'),
(13, 'Link Terkait', '/#links', NULL, 4, NULL, '2022-08-07 07:27:06', '2022-08-09 21:06:38'),
(17, 'Tupoksi', '/pages/tupoksi', 2, 2.4, NULL, '2022-12-02 00:12:57', '2022-12-02 00:45:31'),
(18, 'Berita PPID', '/pages/berita-ppid', 10, 6.3, NULL, '2022-12-02 00:14:12', '2022-12-02 00:45:47'),
(19, 'Bidang', '/pages/bidang', 2, 2.5, NULL, '2022-12-02 00:38:17', '2022-12-02 00:45:40'),
(20, 'PPID', '/pages/ppid-dp3akb-kabupaten-jember', NULL, 4, NULL, '2022-12-04 08:48:09', '2022-12-04 08:48:09');

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
(5, '2022_07_25_100738_create_settings_table', 1),
(6, '2022_07_25_101405_create_categories_table', 1),
(7, '2022_07_25_101500_create_tags_table', 1),
(8, '2022_07_25_101722_create_sections_table', 1),
(9, '2022_07_25_101916_create_sliders_table', 1),
(10, '2022_07_25_102349_create_abouts_table', 1),
(11, '2022_07_25_102554_create_links_table', 1),
(12, '2022_07_25_102738_create_services_table', 1),
(13, '2022_07_25_103047_create_testimonials_table', 1),
(14, '2022_07_25_103323_create_call_to_actions_table', 1),
(15, '2022_07_25_103546_create_menus_table', 1),
(16, '2022_07_25_103907_create_pages_table', 1),
(17, '2022_07_25_104222_create_posts_table', 1),
(18, '2022_07_25_104353_create_comments_table', 1),
(19, '2022_07_25_105227_create_levels_table', 1),
(20, '2022_08_07_092348_create_kelurahans_table', 1);

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
(1, 'Tentang Kami', 'tentang-kami', 'uploads/eUkwddBYdDjr8KQAkinGJ6sL2jiuGzmcURo8zuxJ.jpg', '<p>&nbsp;</p><p><span style=\"background-color:rgb(255,255,255);color:rgb(117,117,117);\">DP3AKB merupakan unsur pelaksana urusan pemerintahan di Kabupaten Jember di bidang pemberdayaan perempuan dan perlindungan anak serta urusan pemerintahan di bidang pengendalian penduduk dan keluarga berencana.&nbsp;</span></p><p>&nbsp;</p>', 1, 128, 1, NULL, '2022-08-06 11:58:08', '2022-12-10 01:46:00'),
(2, 'Visi Misi', 'visi-misi', 'uploads/h4PIQc1SRJxuLE47eN2Rcc3nk8bTMyuqiFtxr8Oa.jpg', '<h3>Visi</h3><blockquote><p>Tulis Visi Misi DI Sini&nbsp;</p></blockquote><p>&nbsp;</p><h3>Misi</h3><ol><li>Tulis Misi Di sini</li><li>Tulis Misi Di sini</li><li>Tulis Misi Di sini</li></ol>', 1, 40, 1, NULL, '2022-08-07 04:35:25', '2022-12-04 10:36:10'),
(3, 'Struktur Organisasi', 'struktur-organisasi', 'uploads/zlkiwQZKryxMh0r6j49dmh5fo2lzfUDsFRuq2U2f.jpg', '<h3 style=\"text-align:center;\">Struktur Organisasi DP3AKB Kabupaten Jember</h3><p>&nbsp;</p><p>Paste Gmabar Bagan Struktur Organisasi Di Sini</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>', 1, 28, 1, NULL, '2022-08-07 07:16:45', '2022-12-12 01:45:08'),
(4, 'Tupoksi', 'tupoksi', 'uploads/0OFtby7nILjrz3IWzFBh8X4uzQ0vL7bErsCTeF6O.jpg', '<h3>Tupoksi DP3AKB Kab. Jember</h3><p>&nbsp;</p><ul><li>Dinas mempunyai tugas melaksanakan urusan pemerintahan yang menjadi kewenangan daerah di bidang pemberdayaan perempuan dan perlindungan anak serta di bidang pengendalian penduduk dan keluarga berencana.</li><li>Dinas dalam melaksanakan tugas, menyelenggarakan fungsi;</li></ul><ol><li>Perumusan kebijakan daerah di bidang pemberdayaan perempuan dan perlinduangan anakan serta di bidang pengendalian penduduk dan keluarga berencana;</li><li>Pelaksanaan kebijakan daerah di bidang pemberdayaan perempuan dan pelindungan anak serta di bidang pengendalian penduduk dan keluarga berencana;</li><li>Pelaksaan evaluasi dan pelaporan daerah di bidang pemberdayaan perempuan dan perlindungan anak serta di bidang pengendalian penduduk dan keluarga berencana;</li><li>Pelaksaan administrasi dinas di bidang pemberdayaan perempuan dan pelindungan anak serta di bidang pengendalian penduduk dan keluarga berencana;</li><li>Pelaksaaan fungsi lain yang diberikan oleh Bupati terkait dengan tugas dan fungsi serta tugas pembantuan</li></ol><p>&nbsp;</p>', 1, 18, 1, NULL, '2022-08-07 07:20:56', '2022-12-10 01:46:29'),
(5, 'Sambutan Kepala Dinas', 'sambutan-kepala-dinas', 'uploads/5ftoh7mXrTzWnmRXmP1crEJZGM44NN0by4QcrEv8.jpg', '<p><br><br>Sambutan Kepala Dinas</p><p>-</p><p>-</p><p>-</p><p>--</p><p>&nbsp;</p><p>&nbsp;</p>', 1, 33, 1, NULL, '2022-08-08 01:46:42', '2022-12-04 09:09:36'),
(6, 'PPID DP3AKB Kabupaten Jember', 'ppid-dp3akb-kabupaten-jember', 'uploads/UA8bZVWKhyJZDBoJcrO80kq541mGoYUgKgeroLGG.jpg', '<h4>&nbsp;</h4><h4>Yuuk ketahui lebih detail, PPID DP3AKB Kabupaten Jember dengan klik pada gambar berikut:</h4><p>&nbsp;</p><p>&nbsp;</p><figure class=\"table\"><table><tbody><tr><td><figure class=\"image\"><a href=\"https://ppid.jemberkab.go.id/ppid-pelaksana/detail/31\"><img src=\"https://dp3akb.anmediacorp.com/storage/attachments/Slide9_1670636841.JPG\"></a></figure></td><td><figure class=\"image\"><a href=\"https://ppid.jemberkab.go.id/permohonan-baru\"><img src=\"https://dp3akb.anmediacorp.com/storage/attachments/Slide10_1670636850.JPG\"></a></figure></td></tr></tbody></table></figure><p><br><br><br><br><br>&nbsp;</p><p><br><br>&nbsp;</p>', 1, 51, 1, NULL, '2022-08-08 02:03:53', '2022-12-12 12:26:08'),
(7, 'test halaman', 'test-halaman', NULL, '<p>Lorem ipsum</p><figure class=\"image\"><img src=\"http://127.0.0.1:8000/storage/attachments/jember-fashion-week_1659945381.jpeg\"></figure>', 1, 0, 1, '2022-08-08 00:59:06', '2022-08-08 00:57:54', '2022-08-08 00:59:06'),
(8, 'Berita PPID', 'berita-ppid', NULL, '<p>-</p>', 1, 7, 1, NULL, '2022-08-17 12:19:49', '2022-12-06 11:49:17'),
(9, 'Bidang', 'bidang', 'uploads/rQlRlKZXQlbVmvykhBqlPTidKKAm9Vu2zU1S0m4v.jpg', '<h4 style=\"text-align:justify;\">Sekretariat</h4><ol><li style=\"text-align:justify;\">Sub Bagian Umum dan Kepegawaian</li><li style=\"text-align:justify;\">Kelompok Jabatan Fungsional</li></ol><p style=\"text-align:justify;\">&nbsp;</p><h4 style=\"text-align:justify;\">Bidang Pemberdayaan dan Perlindungan Perempuan</h4><ol><li style=\"text-align:justify;\">Kelompok Jabatan Fungsional</li></ol><p style=\"text-align:justify;\">&nbsp;</p><h4 style=\"text-align:justify;\">Bidang Pelindungan Anak</h4><ol><li style=\"text-align:justify;\">Kelompok Jabatan Fungsional</li></ol><p style=\"text-align:justify;\">&nbsp;</p><h4 style=\"text-align:justify;\">Bidang Pengendalian Penduduk dan Advokasi, Penggerakan dan Informasi</h4><ol><li style=\"text-align:justify;\">Kelompok Jabatan Fungsional</li></ol><p style=\"text-align:justify;\">&nbsp;</p><h4 style=\"text-align:justify;\">Bidang Keluarga Berencana dan Keluarga Sejahtera</h4><ol><li style=\"text-align:justify;\">Kelompok Jabatan Fungsional</li></ol>', 1, 20, 1, NULL, '2022-12-02 00:37:20', '2022-12-06 11:31:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(9, 'App\\Models\\User', 1, 'token_access', '91a66f452a618bf7cde9bbba124f22d81776a1762bc7a33a7b0117455fa298ae', '[\"*\"]', NULL, '2022-08-10 15:04:00', '2022-08-10 15:04:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `postcategories`
--

CREATE TABLE `postcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `postcategories`
--

INSERT INTO `postcategories` (`id`, `name`, `slug`, `title`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Berita Kegiatan', 'berita-kegiatan', NULL, NULL, '2022-08-06 02:21:46', '2022-08-08 03:52:44'),
(2, 'Pengumuman', 'pengumuman', NULL, NULL, '2022-08-08 01:34:54', '2022-08-08 01:34:54'),
(3, 'Forum Anak', 'forum-anak', 'Informasi Forum Anak', NULL, '2022-12-06 14:03:01', '2022-12-12 08:09:03'),
(4, 'GENRE', 'genre', 'Informasi Generasi Berencana', NULL, '2022-12-10 00:58:27', '2022-12-12 08:09:10'),
(5, 'PUSPA', 'puspa', 'Informasi Perempuan dan Anak (PUSPA)', NULL, '2022-12-10 01:25:55', '2022-12-12 08:09:19');

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
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `image`, `body`, `postcategory_id`, `tag_id`, `user_id`, `views`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Sejarah Jember Fashion Carnaval, Pentas Sederhana Jadi Karnaval Kelas Dunia', 'sejarah-jember-fashion-carnaval-pentas-sederhana-jadi-karnaval-kelas-dunia', 'uploads/NMVVEyMbFDKDkNLfdhI7zRYBsLnYw32drEU8BN0O.jpg', '<div><strong>Jember</strong> - Jember Fashion Carnaval atau JFC merupakan karnaval yang rutin digelar di Jember. Setelah vakum selama 2 tahun akibat pandemi COVID-19, JFC kembali digelar secara luring di Alun-alun Jember pada 6-7 Agustus 2022.<br>Setiap tahun, JFC selalu menampilkan busana-busana yang menarik dan kaya akan nilai budaya. Busana-busana tersebut ditampilkan secara teatrikal dengan memadukan unsur seni tari, seni rupa, dan seni musik. Keunikan itu membuat JFC semakin terkenal di mata dunia.<br><br>Sejumlah penghargaan internasional diraih oleh JFC, termasuk menjadi Second Runner-Up pada International Carnaval de Victoria 2016 di Seychelles. Pada 2017, Jember dinobatkan sebagai Kota Karnaval pertama di Indonesia yang bertaraf nasional dan internasional oleh Kementerian Pariwisata.<br><br>Prestasi gemilang JFC tentu tidak lepas dari kerja keras sang pelopor, Dynand Fariz. Dynand begitu ulet dalam mengembangkan JFC hingga menjadi karnaval terbesar di Indonesia. Kira-kira bagaimana sejarah berdirinya JFC? Simak penjelasannya berikut ini.<br><br><strong>Berawal dari Rumah Mode</strong><br><br>Dikutip dari laman Kemendikbud, JFC bermula dari keberadaan rumah mode yang didirikan oleh Dynand Fariz pada 1998. Rumah mode yang bernama Dynand Fariz International High Fashion Center itu didirikan sebagai wujud apresiasi dan konstribusi Dynand di dunia fashion.<br><br>Pada 2001, Dynand mengadakan sebuah acara fashion week untuk mengenalkan rumah modenya ke masyarakat luas. Dynand meminta para karyawan rumah mode untuk memakai busana yang sedang tren di dunia. Busana itu harus dipakai saat bekerja selama seminggu.<br><br>Acara fashion week di tahun selanjutnya dilakukan dengan cara yang berbeda. Terdapat pawai karyawan dengan memakai busana daur ulang yang kreatif dan unik.<br><br>Pawai tersebut dilakukan di sekitar rumah mode. Rupanya, masyarakat mulai tertarik dan memberi respons positif terhadap pawai tersebut.<br><br><strong>Tercetus Ide Menggelar Karnaval yang Besar</strong><br><br>Antusiasme masyarakat terhadap pawai rumah mode membuat Dynan ingin menggelar sebuah karnaval yang besar. Tahun 2003, Dynand dan tim mulai memikirkan konsep karnaval secara matang. Itu karena Dynand berharap agar karnaval yang akan digelar dapat memberi dampak positif bagi masyarakat Jember.<br><br>Perencanaan karnaval dilakukan secara detail. Mulai dari pembuatan visi dan misi, menentukan tema busana, hingga melakukan inovasi desain busana.<br><br>Bertepatan dengan HUT Jember, JFC pertama digelar pada 1 Januari 2003 di Alun-alun Jember. Dalam sebuah penelitian dari Mudra Jurnal Seni Budaya disebutkan, JFC 2003 diikuti 50 peserta yang terdiri atas karyawan rumah mode Dynan, karyawan salon Dyfa milik Dynand, dan karyawan salon Karisma milik Suyanto, kakak DDynand. Dengan mengusung 3 defile, yakni Punk, Gipsy dan Cowboy.<br><br><strong>Sempat Ditentang Pemerintah Kabupaten Jember</strong><br><br>Saat melakukan persiapan penyelenggaraan JFC, Dynand dan tim sempat mengalami kendala. Pengajuan proposal dan surat izin penyelenggaraan acara tidak disambut baik oleh Pemerintah Kabupaten Jember.<br><br>Alasannya ialah karena acara karnaval fashion bukan budaya asli Jember. Tema busana yang diangkat juga cenderung mengarah ke budaya Amerika. Sementara waktu itu sedang terjadi penyerangan Amerika kepada Irak. Selain itu, rute karnaval yang diajukan dinilai melawan arus lalu lintas.<br><br>Meski belum mendapat izin dari pemerintah, Dynand dan tim tetap melakukan persiapan. Bahkan Dynand beberapa kali melakukan presentasi terkait visi, misi, dan konsep JFC untuk meyakinkan pihak pemerintah. Pada 31 Desember 2002, surat izin penyelenggaraan acara akhirnya disetujui oleh Bupati Jember.<br><br>Melihat sambutan baik dari masyarakat saat Jember Fashion Carnaval pertama, Dynand dan tim kemudian sepakat untuk mengadakan JFC kedua di tahun yang sama. Saat itu, JFC digelar bersamaan dengan acara gerak jalan Tanggul-Jember Tradisional pada 30 Agustus 2003. Defile yang ditampilkan yakni Arab, Maroko, India, Jepang, dan China.<br><br><strong>Terus Berkembang sampai Sekarang</strong><br><br>Seiring berjalannya waktu, JFC semakin berkembang. Dynand dan tim mulai membentuk keunikan dari JFC dan mengeksplorasi berbagai tema. Sehingga tidak ada busana yang sama dalam setiap defile. Peserta JFC juga diambil dari anak-anak dan remaja Kota Jember yang kemudian dilatih untuk merancang kostum, make up, hingga gerakan cat-walk.<br><br><strong>Jember Fashion Carnaval Sepeninggal Dynand Fariz</strong><br><br>Pada 2019, Dynand kembali mempersiapkan JFC yang akan digelar pada 31 Juli hingga 4 Agustus 2019. JFC ke-18 mengusung tema Tribal Grandeur dengan 8 defile yang terdiri dari suku-suku di dunia.<br><br>Namun, Dynand meninggal dunia pada 17 April 2019 sebelum menyaksikan pagelaran JFC ke-18. Makam mendiang Dynand terletak di Garahan, Jember.<br><br>Meski tanpa sang presiden, Jember Fashion Carnaval ke-18 tetap digelar dengan semangat dan dihadiri oleh Bupati Jember serta desainer Anne Aventie. Saat itu, Anne Aventie juga turut membawa kostum rancangannya untuk ditampilkan di JFC ke-18.<br><br>Kini, posisi Presiden JFC digantikan oleh Budi Setiawan yang sebelumnya menjabat sebagai Ketua Yayasan Jember Fashion Carnaval.</div>', 1, NULL, 1, 11, 1, '2022-08-08 01:33:09', '2022-08-06 02:49:57', '2022-08-08 01:33:09'),
(2, 'Rute Jember Fashion Carnaval 2022, Cara Akses Lokasi, & Tiket JFC', 'rute-jember-fashion-carnaval-2022-cara-akses-lokasi-tiket-jfc', 'uploads/Y3ymIveenJzi1uDoWTuAb7b2ZrnQbWD6QKSS3u76.jpg', '<div><strong>Jember Fashion Carnival (JFC)</strong> ke 20 diselenggarakan pada 6-7 Agustus 2022. Acara parade busana yang mengusung tema \"The Legacy\" ini dipusatkan di Alun-alun Kota Jember. Dalam pelaksanaanya, JFC ke 20 ini memiliki 5 rangkaian acara selama dua hari berturut-turut.<br><br>Setiap acara memiliki rute karnaval dengan jarak tempuh yang berbeda. Jenis karnavalnya pun berlainan sehingga pelaksanaan JFC makin banyak karya yang ditampilkan. Berikut daftar rangkaian acara The Second Decade of JFC: The Legacy beserta harga tiketnya: <br><br><strong>1. Pet Carnival dan Wonderful Artchipelago Carnival Indonesia</strong><br><br>Kedua karnaval tersebut dilaksanakan bersamaan pada 6 Agustus 2022 mulai pukul 13.00 WIB. Pet Carnival adalah karnaval yang dikhususkan bagi hewan peliharaan yang bergaya bersama pemiliknya. <br><br>Karnaval ini terwujud atas kerja sama dari penyelenggara JFC dengan komunitas pecinta alam, Balai konservasi Sumber daya Alam (BKSDA), dan Perhimpunan Dokter Hewan Indonesia (PDHI). Sebaliknya, Wonderful Artchipelago Carnival Indonesia (WACI) membawa konsep karnaval yang mempertontonkan busana yang mencitrakan keanekaragaman budaya khas Indonesia. <br><br>Karnaval ini bekerja sama dengan Kemenparekraf. Mengutip postingan Instagram akun Jember fashion Carnival, jarak tempuh untuk Pet Carnival dan WACI sepanjang 2,1 kilometer. Rutenya dari Alun -alun Jember menuju Mall Kota Cinema yang melewati Jalan Sudirman, Jalan Sultan Agung, dan Jalan Nasional III. <br><br>Harga tiket untuk kedua karnaval tersebut sekaligus adalah Rp50 ribu per orang. 2. Artwear Carnival (Fashion Art)<br><br><strong>2. Artwear Carnival (Fashion Art)</strong><br><br>Artwear Carnival dipusatkan pada Alun-alun Jember di Jalan Sudirman. Kegiatan ini menampilkan konten busana tematik hasil racikan desainer, komunitas, dan brand yang dikemas menjadi sebuah karnaval. <br><br>Beberapa bentuk acaranya yaitu JFC Art Wear, Batik Fashion, Moslem In Fashion, Wedding Fashion, hingga Designer Participants. <br><br>Artwear Carnival dilaksanakan 6 Agustus 2022 mulai 19.00 WIB. Tiket nontonnya dibanderol Rp50 ribu per orang. <br><br><strong>3. World Kids Carnival</strong><br><br>World Kids Carnival (WKC) diadakan 7 Agustus 2022 mulai pukul 10.00 WIB. Kegiatan ini menampilkan peragaan anak-anak dalam warna-warni koreografi karnaval yang mengenakan kostum unik dan menarik. WKC memiliki jarak tempuh untuk berkarnaval sejauh 650 meter mengitari Alun-alun Jember. Jalan yang dilewati adalah Jalan Sudirman, Jalan R.A. Kartini, dan Jalan Nasional III. Harga tiket WKC senilai Rp 50 ribu per orang. <br><br><strong>4. Grand Carnival of Jember Fashion Carnival</strong><br><br>Kegiatan ini adalah puncak acara dari JFC-20 tahun 2022. Pelaksanaannya pada 7 Agustus 2022 mulai pukul 19.00 WIB. Tiketnya memiliki dua kelas yaitu platinum seharga Rp500 ribu dan Gold Rp250 ribu. <br><br>Acara ini menampilkan ulang defile-defile terbaik yang pernah ditampilkan pada JFC periode sebelumnya. Defile tersebut terdiri dari Madurese, Mahabharata, Betawi, Majapahit, Garuda, Sriwijaya, Kujang, Aztec, Sasando, dan Poseidon. <br><br>Bintang tamu spesial yang turut diundang adalah Laksmi Shari De Neefe Suardana (Puteri Indonesia 2022), Adinda Cresheilla (Putri Indonesia Pariwisata 2022), Sarah Tumiwa (Juara 1 Indonesia\'s Next Top Model), dan Bubah Alfian (professional makeup artist). <br><br>Grand Carnival JFC-20 menempuh jarak 3,6 kilometer dari Alun-alun Jember dengan tujuan akhir Gedung Serba Guna PKPSO. Jalan yang dilewati adalah Jalan Sudirman, Jalan Sultan Agung, Jalan Gajah Mada, dan GOR Kaliwates. Acara tersebut diperkirakan selesai pukul 23.00 WIB. <br><br><strong>Tempat Beli Tiket Jember Fashion Carnival</strong><br><br>Semua tiket dari rangkaian acara JFC-20 dapat dibeli melalui situs https://ticket.jfcglobalindonesia.com. Selain itu, tiket juga disediakan di lokasi (on the spot) saat digelarnya acara pada 6-7 Agustus 2022 dengan kuota terbatas.<br><br></div>', 1, NULL, 1, 12, 1, '2022-08-08 01:33:06', '2022-08-06 02:55:59', '2022-08-08 01:33:06'),
(3, 'Pedoman Logo dan Desain Turunan HUT ke 77 Kemerdekaan Republik Indonesia, Link Download', 'pedoman-logo-dan-desain-turunan-hut-ke-77-kemerdekaan-republik-indonesia-link-download', 'uploads/zSCAR3mufN6IsQpT5cJN5J9J0IHqO38nHKhT1kND.jpg', '<div>Berdasarkan Surat Edaran Bupati Jember Nomor 180/512/35.09.1.11/2022 tentang Penyampaian Tema, Logo dan Partisipasi Menyemarakkan Peringatan HUT ke 77 Kemerdekaan Republik Indonesia, bersama ini disampaikan beberapa petunjuk sebagai berikut:<br><br></div><div>1. Tema peringatan HUT ke 77 Kemerdekaan Republik Indonesia adalah “PULIH LEBIH CEPAT, BANGKIT LEBIH KUAT”<br><br></div><div>2. Dalam rangka menyemarakkan Bulan Kemerdekaan tahun 2022, agar setiap lingkungan gedung/perkantoran pemerintah dan swasta serta tempat-tempat strategis lainnya mengibarkan bendera merah putih secara serentak di lingkungan masing-masing mulai tanggal 1 s/d 31 Agustus 2022.<br><br></div><div>3. Memasang dekorasi, umbul-umbul, poster, spanduk, baliho dan hiasan lainnya secara serentak sejak tanggal 20 Juli s/d 31 Agustus 2022.<br><br></div><div>4. Mengimplementasikan secara maksimal logo, desain turunan HUT ke 77 Kemerdekaan Republik Indonesia tahun 2022 ke dalam berbagai bentuk media, antara lain desain, tampilan website, media sosial, tayangan pada media televisi dan online, dekorasi bangunan, dekorasi alat transportasi umum dan dinas, produk, souvenir, merchandise, media publikasi cetak, elektronik, dll.<br><br></div><div>Pedoman Logo dan Desain Turunan HUT ke 77 Kemerdekaan Republik Indonesia tahun 2022 Dapat Diunduh <a href=\"https://bit.ly/DesainHUTRI77Jember\">KLIK DI SINI</a></div>', 2, NULL, 1, 6, 1, NULL, '2022-08-08 01:36:13', '2022-08-18 10:26:22'),
(4, 'Sosialisasi Gempur Rokok Ilegal Melalui Pertunjukan Wayang Kulit', 'sosialisasi-gempur-rokok-ilegal-melalui-pertunjukan-wayang-kulit', 'uploads/EwWPLOmw5KebJtSZB4iVzQv1mtOsVPjqZheI39Or.jpg', '<p>JEMBER, Wayang kulit sebagai seni pertunjukkan tradisional Indonesia dipilih sebagai media sosialisasi gempur rokok ilegal.<br><br>Sosialisasi melalui pementasan wayang ini dihadiri oleh Bupati Jember Ir. H. Hendy Siswanto, ST. IPU., camat, kepala OPD, dan beberapa kepala instansi pemerintah.<br><br>Kepala Kantor Cabang Beacukai Jember Asep Munandar, SE. M.Si menyampaikan dari total peredaran rokok di Indonesia, sebanyak 4,83 persen adalah rokok ilegal.<br><br>“Dan ini kalau dihitung dari potensi kerugian negara dari sisi penerimaan cukai lebih dari Rp. 7 triliun,” ujar Asep dalam pidatonya, Sabtu malam 30 Juli 2022.<br><br>Dia mengaku tahun ini Beacukai ditargetkan dapat mengumpulkan pemasukan negara dari cukai sebesar Rp. 299 triliun, yang di antaranya Rp. 218 triliun merupakan cukai tembakau.<br><br>“Kami minta masyarakat Jember untuk mendukung program gempur rokok ilegal dengan tidak membeli rokok ilegal tanpa disertai pita cukai, serta memberikan informasi kepada kami terkait adanya aktivitas rokok ilegal kepada kami,” ajaknya.<br><br>Dalam pementasan seni wayang kulit yang digelar di Alun-alun Jember tersebut, dalang menyampaikan beberapa lakon mengenai rokok ilegal agar tersampaikan kepada masyarakat secara keseluruhan.<br><br>Wayang kulit telah menjadi seni pertunjukan yang digemari seluruh masyarakat Indonesia, sehingga pesan-pesan yang disampaikan dalam pewayangan lebih mudah dipahami.<br><br><br>&nbsp;</p>', 1, NULL, 1, 1, 1, NULL, '2022-08-08 01:38:03', '2022-12-12 08:16:21'),
(5, 'Warga Jember Doa Bersama Sambut Tahun Baru 1.444 Hijriyah', 'warga-jember-doa-bersama-sambut-tahun-baru-1-444-hijriyah', 'uploads/okQeTgF1xmAOQc9TQ195zyaZNLvDZV7uatT74qS5.jpg', '<div>JEMBER, Bupati Jember Ir. H. Hendy Siswanto, ST. IPU. menggelar doa bersama diikuti warga Kabupaten Jember. Doa bersama dalam rangka menyambut Tahun Baru 1.444 Hijriyah tersebut berlangsung di Alun-alun Jember, Sabtu 01 Muharram tahun 1444 Hijriyah /30 Juli 2022.<br><br>Warga Jember yang hadir dalam pengajian tersebut didominasi kaum santri dari berbagai pondok pesantren di Jember.<br><br>“Saya atas nama pribadi dan atas nama Pemerintah Kabupaten Jember mengucapkan Selamat Memperingati Tahun Baru 1441 Hijriyah, semoga tahun ini warga Jember diberikan kesehatan, kelancaran usahanya, dijauhkan dari berbagai musibah, dan dimudahkan semua rezekinya, Amin Ya Robbal Alamin,” ucap Bupati Hendy Siswanto.<br><br>Bupati Hendy juga menyampaikan apresiasi setinggi-tinggi atas semua acara yang diselenggarakan dalam rangka memeriahkan Tahun Baru Hijriyah ini di berbagai Kecamatan, Desa, kantor, instansi, dan lainnya.<br><br>Ia juga berterima kasih atas peran guru agama, ustaz serta ustazah yang mengajar para generasi penerus Jember tentang ilmu agama, ilmu Qiroati di masjid, musala, madrasah diniyah serta sekolah formal. Ia menegaskan ilmu agama sangat penting sebagai pijakan kita menjalani kehidupan sehari-hari. Selain itu ilmu agama merupakan landasan moral serta budi pekerti yang wajib dimiliki semua warga negara Indonesia tanpa terkecuali.<br><br>Doa bersama dipimpin Wakil Bupati Jember KH. MB. Firjaun Barlaman, diikuti oleh Ketua DPRD Jember M. Itqon Syauqi, S.Th.I dan seluruh peserta pengajian yang hadir.<br><br>Dalam doa bersama ini, dipanjatkan doa meminta kebaikan serta keberkatan bagi semua masyarakat Jember, dijauhkan dari musibah dan meminta kemudahan untuk Kabupaten Jember lebih baik ke depannya juga salawat bersama kepada Baginda Rasulullah Muhammad Shallallahu Alaihi Wasallam.</div>', 1, NULL, 1, 4, 1, NULL, '2022-08-08 01:39:07', '2022-12-02 00:58:53'),
(6, 'Gerak Serentak Wujudkan OPOP Kabupaten Jember', 'gerak-serentak-wujudkan-opop-kabupaten-jember', 'uploads/6DzI4VK4Q04Fs6Lzky7Yq2Yr41lGBAEEKsOWVWaZ.jpg', '<div>JEMBER, Sebagai wujud peningkatan kesejahteraan masyarakat, Dinas Koperasi Pemkab Jember berkolaborasi dengan Dinas Koperasi Pemprov Jatim berkoordinasi untuk mewujudkan OPOP atau One Pesantren One Product.<br><br>OPOP menjadi wujud nyata peningkatan kesejahteraan masyarakat berbasis Pondok Pesantren melalui pemberdayaan santri, pesantren dan alumni pondok pesantren.<br><br>Kadiskop Provinsi Jatim Andromeda Qomariah menyampaikan pondok pesantren memiliki peranan vital dalam peningkatan kesejahteraan masyarakat dengan menggerakkan kaum santri.<br><br>“Ada 41 pondok pesantren yang sudah bergabung dengan program OPOP, sedangkan yang sudah mempunyai koperasi sejumlah 33 pesantren, nah sisanya itu kita dorong untuk juga mempunyai pondok pesantren,” terang Qomariah, Selasa (02 Agustus 2022).<br><br>Adapun konsep menekankan pada penciptaan santri wirausaha atau santri preneur dengan berbagai pelatihan keahlian dalam mendukung hal tersebut.<br><br>Untuk diketahui, ada 3 pilar OPOP yaitu, pertama Santripreneur, kedua Pesantrenpreneur merupakan program pemberdayaan ekonomi pesantren melalui Koperasi Pondok Pesantren yang bertujuan menghasilkan produk halal unggulan yang mampu diterima pasar lokal, nasional, dan dunia.<br><br>Kemudian ketiga Sosiopreneur merupakan program pemberdayaan alumni pesantren yang disinergikan dengan masyarakat. Pemberdayaan dilakukan dengan beragam inovasi sosial, berbasis digital teknologi dan kreativitas secara inklusif. (ipf)</div>', 1, NULL, 1, 11, 1, NULL, '2022-08-08 01:41:27', '2022-12-13 04:03:30'),
(7, 'Bupati Jember Tinjau Kesiapan Pelaksanaan JFC ke 20', 'bupati-jember-tinjau-kesiapan-pelaksanaan-jfc-ke-20', 'uploads/F7TwsVLPBLTIhtRpqi08ieP7NXFOiPR1hGk26NMy.jpg', '<div>JEMBER, Bupati Jember Ir. H. Hendy Siswanto, ST. IPU. meninjau kesiapan pelaksanaan Jember Fashion Carnaval atau JFC ke 20 pada tahun 2022.<br><br>JFC ini mengusung tema The Legacy, yang akan menampilkan 10 defile terbaik berjalan di catwalk sepanjang 4 kilometer.<br><br>Bupati Jember Hendy Siswanto didampingi Presiden JFC Budi Setiawan serta beberapa Kepala OPD terkait berkeliling ke beberapa titik penyelenggaraan JFC mulai dari Gedung Serbaguna Kaliwates hingga Jalan Sultan Agung, Jumat malam 5 Agustus 2022.<br><br>“Panitia sudah mempersiapkan dengan matang dan rapi dan kita siap mengguncang dunia melalui Jember Fashion Carnaval pada 6 dan 7 Agustus 2022, Anda semua harus hadir ke Jember nonton JFC besok,” ungkap Bupati Hendy Siswanto.<br><br>Gelaran JFC ini pula diharapkan menjadi pemicu hidupnya kembali industri seni, pertunjukan, ekonomi kreatif, serta pariwisata di Kabupaten Jember.<br><br>“Sampai jumpa besok, kita nonton bersama JFC di sini, saya tunggu!” ajak Bupati Hendy Siswanto. (ipf)</div>', 1, NULL, 1, 3, 1, '2022-08-08 03:48:45', '2022-08-08 01:42:28', '2022-12-13 04:03:42'),
(8, 'Rembuk Stunting Akbar, Bergerak Serentak Turunkan Stunting di Jember', 'rembuk-stunting-akbar-bergerak-serentak-turunkan-stunting-di-jember', 'uploads/xYFlqMdGCj4ue8vXagwhNwarvytBMdfboATpiM3P.jpg', '<p>JEMBER, Pemerintah Kabupaten Jember kembali melaksanakan rembuk stunting akbar yang melibatkan 1.075 orang dari berbagai instansi pemerintah dan perwakilan masyarakat pada Rabu (27 Juli 2022).<br><br>Plt. Kadinkes Jember dr. Lilik Lailiyah pelaksanaan rembuk ini dilaksanakan hybrid dimana 300 orang hadir offline dan sisanya hadir secara online.<br><br>Lilik menyebut rembuk stunting ini merupakan bentuk intervensi pemerintah dalam penurunan stunting yang terintegrasi, serta membangun komitmen publik untuk menyukseskannya.<br><br>Ia melaporkan balita stunting berdasarkan dari hasil operasi timbang pada Februari 2022&nbsp; dimana 90,83 persen sasaran atau sejumlah 173.043 sasaran. Dari angka tersebut diperoleh data balita stunting sejumlah 12.754 balita yang stunting atau 7,37 persen.<br><br>“Angka ini menurun dari tahun 2021,” jelas dr. Lilik.<br><br>Lilik menjabarkan berbagai upaya intervensi pencegahan dan penurunan stunting, penetapan desa locus sebanyak 34 desa lokus dan 2023 akan menggarap 40 desa lokus. Sedangkan untuk intervensi terdapat intervensi spesifik dan intervensi sensitif dimana keduanya diisi dengan berbagai kegiatan seperti pendampingan ibu hamil KEK serta Bumil Risti, pemberian MT pada Bumil, Pelayanan ANC Terpadu.<br><br>Sementara itu Wakil Bupati Jember KH. MB. Firjaun Barlaman agar seluruh elemen masyarakat dan instansi pemerintah semakin kompak dalam penanganan stunting.<br><br>“Untuk itu ada beberapa program yang harus kita sukseskan pada bulan Agustus mendatang yaitu bulan timbang, bulan vitamin A untuk balita, bulan imunisasi anak nasional. Saya berharap semua dapat berperan aktif sesuai tugas dan peran masing-masing,” pinta Wabup Jember Gus Firjaun.<br><br>Selain itu pada September mendatang akan diselenggarakan lagi survey SSGI 2022.<br>“Semoga angka stunting dapat turun lagi hingga tercapai target nasional 14 persen pada 2024,” harapnya. (ipf)</p>', 1, NULL, 1, 25, 1, '2022-08-18 10:08:18', '2022-08-08 01:43:22', '2022-12-13 04:03:22'),
(9, 'Pahala Melalui Sampah untuk Pemenuhan Gizi dan Stunting di Kelurahan Kebonsari', 'pahala-melalui-sampah-untuk-pemenuhan-gizi-dan-stunting-di-kelurahan-kebonsari', 'uploads/3ajrVXSW63nGl6ynD7x5I1Zw3NVJwkRGqCC23Fvi.jpg', '<p>Kuliah kerja nyata (KKN) merupakan bagian dari aktivitas pendidikan di mana tujuannya untuk memberikan pengalaman pengabdian masyarakat kepada mahasiswa. KKN merupakan salah satu wadah bagi mahasiswa untuk menyalurkan ide/gagasan yang kreatif secara langsung kepada masyarakat dengan memecahkan permasalahan yang ada. Baik itu permasalahan sosial, &nbsp;kesehatan, dan masalah lain yang terjadi di masyarakat.&nbsp;</p><p>Pada tahun ajaran 2021/2022 di Kabupaten Jember mengadakan KKN kolaboratif, di mana kegiatan KKN kolaboratif ini diikuti oleh 13 perguruan tinggi dengan 248 kelompok yang tersebar di seluruh kelurahan/desa yang ada di Kabupatebn Jember. Kelompok 237 yang bertempat di Kelurahan Kebonsari, Kecamatan Sumbersari dengan jumlah anggota 10 orang yang berasal dari Universitas Jember, Universitas Islam Jember, Universitas Dr.Soebandi, Universitas Muhammadiyah Jember, dan Universitas PGRI Argopuro Jember.</p><p>Pada minggu pertama KKN kolaboratif kelompok 237 memperkenalkan dan memaparkan tujuan kegiatan KKN kolaboratif dengan menemui Bapak Lurah Kebonsari dan Bapak Camat Sumbersari. Dalam pertemuan tersebut ada beberapa arahan langsung dari Bapak Lurah dan Bapak Camat yaitu mengenai permasalahan stunting, karena permasalahan stunting ini masih cukup tinggi di Kelurahan Kebonsari dan belum ada solusi untuk menurunkan masalah stunting secara tuntas. \"Permasalahan yang saat ini kami alami yaitu masih tingginya angka stunting yang ada di &nbsp;wilayah Kebonsari ini. Jika adek-adek ingin membantu dan mengatasi permasalahan tersebut itu sangat bagus,\" ujar bapak Herlan Hidajat, S.Sos., selaku lurah kebonsari. \"Berbagai upaya telah dilakukan seperti penyuluhan tentang bahaya stunting dll. Hal ini tentu menjadi PR juga bagi saya selaku Camat Sumbersari.\" Tambahnya dari Bapak Regar Jeane Dealen Nangka, S.STP, M.Si., selaku Camat Sumbersari.</p><p>Dengan adanya beberapa data seperti data stunting yang ikut mendukung serta memperkuat alasan kami, bahwa KKN kolaboratif kelompok 237 yang berada di wilayah Kelurahan Kebonsari harus ikut serta menuangkan ide-ide kreatifnya untuk mengatasi permasalahan stunting ini. Kemudian KKN kolaboratif kelompok 237 mencetuskan beberapa visi dan misi serta BMC (Business Model Canvas) yang dirancang sedemikian rupa dengan beberapa pertimbangan untuk menyelesaikan permasalahan stunting.</p><p>Salah satu yang bisa dilakukan untuk mengatasi permasalahan stunting ini yaitu dengan terpenuhinya asupan gizi oleh Ibu Hamil dan Anak. Pemenuhan gizi ini dapat dilakukan secara terus menerus jika ada dana yang mensuplai tentang hal ini. Oleh karena\" itu kami akan mengadakan kegiatan \" Pemenuhan Gizi Melalui PMS (Pahala Melalui Sampah)\" di mana kegiatan ini bekerjasama dengan &nbsp;masyarakat untuk ikut andil dalam membantu pemenuhan gizi. cara yang dilakukan yaitu dengan hadirnya bank sampah.&nbsp;</p><p>Masyarakat dapat menyisihkan sebagian dari hasil penjualan sampah untuk menyuplai pemenuhan gizi pada saat posyandu untuk ibu hamil maupun Anak yang terkena stunting. Banyak manfaat yang dapat diambil dari pembentukan bank sampah ini, selain kesadaran masyarakat akan lingkungan meningkat, jiwa sosial juga akan meningkat terutama dalam mengatasi permasalahan stunting yang ada di wilayah Kelurahan Kebonsari. Permasalahan stunting pun tidak akan menjadi beban berat yang harus diselesaikan oleh Pemerintah Kelurahan maupun Kecamatan saja, &nbsp;karena disini masyarakat juga berperan dan menyelesaikan masalahnya sendiri.&nbsp;</p>', 1, NULL, 2, 14, 1, '2022-08-11 14:18:29', '2022-08-09 20:13:58', '2022-12-03 06:10:37'),
(10, 'test123', 'test123', 'uploads/wYZEyoXLFsLY4MjqAsFULGDkMl0gvPOvKtFqYLXy.jpg', '<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto voluptates illum placeat recusandae, ducimus, ullam culpa perspiciatis libero possimus amet error, nesciunt necessitatibus doloribus animi molestiae ad cum saepe beatae!</p>', 5, NULL, 1, 1, 1, NULL, '2022-12-12 08:17:01', '2022-12-13 04:00:15');

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
(1, 'Slider', 'sliders', 1, NULL, '2022-08-06 02:08:41', '2022-08-06 10:51:44'),
(2, 'Selamat Datang', 'about', 1, NULL, '2022-08-06 02:08:41', '2022-08-08 04:23:42'),
(3, 'Link Terkait', 'links', 1, NULL, '2022-08-06 02:08:41', '2022-08-06 02:20:05'),
(4, 'Layanan', 'services', 1, NULL, '2022-08-06 02:08:41', '2022-12-04 01:33:44'),
(5, 'Survey Warga', 'testimonials', 1, NULL, '2022-08-06 02:08:41', '2022-12-12 12:30:50'),
(6, 'Jabat Erat Di Sini', 'call-to-action', 0, NULL, '2022-08-06 02:08:41', '2022-12-05 01:57:43'),
(7, 'Berita Terbaru', 'posts', 1, NULL, '2022-08-06 02:08:41', '2022-12-01 00:19:00'),
(8, 'Berita PPID', 'ppid', 1, NULL, '2022-08-08 01:12:37', '2022-08-08 01:12:37'),
(9, 'Alamat Kantor', 'kelurahan', 1, NULL, '2022-08-08 01:14:12', '2022-12-04 01:34:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `servicecategories`
--

CREATE TABLE `servicecategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `servicecategories`
--

INSERT INTO `servicecategories` (`id`, `service_id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(1, 4, 'Konsultasi Edukasi PUG Pengarus Utamaan Gender', 'konsultasi-edukasi-pug-pengarus-utamaan-gender', 'uploads/XtbAo2sv7cenDNz3HR5VxyfztNIGJbi9ZS2eQIDH.jpg', '2022-12-07 20:34:14', '2022-12-12 12:41:03'),
(4, 4, 'Konsultasi Kekerasan pada Perempuan', 'konsultasi-kekerasan-pada-perempuan', 'uploads/8TiNMKQWiIFnMKLtkrUcuEcE0MUE3kf6LrI6g9O9.jpg', '2022-12-08 20:05:27', '2022-12-12 12:41:12'),
(5, 4, 'Konsultasi Peningkatan Kapasitas Perempuan di Bidang Ekonomi, Politik Sosial Budaya dan Hukum', 'konsultasi-peningkatan-kapasitas-perempuan-di-bidang-ekonomi-politik-sosial-budaya-dan-hukum', 'uploads/zDGtalAPOawZQa3j71MS0jwGur39Lx2VNkUgHh2k.jpg', '2022-12-08 20:05:47', '2022-12-12 12:41:45'),
(6, 4, 'Konsultasi Forum Partisipasi Publik untuk Kesejahteraan', 'konsultasi-forum-partisipasi-publik-untuk-kesejahteraan', 'uploads/TCex1wtofG33h1XRZx12gtVNS41NOOMraTumVY5M.jpg', '2022-12-08 20:06:00', '2022-12-12 12:41:35'),
(7, 3, 'Konsultasi Pendidikan Sebaya', 'konsultasi-pendidikan-sebaya', 'uploads/SzyG7bvyQuIlY03SJ57wHvVP9hMWqNjCvxSMN0kF.jpg', '2022-12-10 01:29:33', '2022-12-12 12:55:38'),
(8, 3, 'Konsultasi Kekerasan pada Anak', 'konsultasi-kekerasan-pada-anak', 'uploads/jWVPsQAXrQuR9rPgDbkS7A9IVkU6SVo6XjKCl3RP.jpg', '2022-12-10 01:29:50', '2022-12-12 12:55:50'),
(9, 3, 'Konsultasi Psikologi Perempuan dan Anak', 'konsultasi-psikologi-perempuan-dan-anak', 'uploads/bfWbiklyrDbbCPRop8Pq7FucAgiwCVw7UwPkoC9g.jpg', '2022-12-10 01:30:18', '2022-12-12 12:56:03'),
(10, 3, 'Konsultasi Pendidikan', 'konsultasi-pendidikan', 'uploads/4R1PBHOqtPc2w01DvC9TwIgoV7e7CMt9CTWbdcNJ.jpg', '2022-12-10 01:30:38', '2022-12-12 12:56:12'),
(11, 2, 'Konsultasi Pendewasaan Usia Perkawinan', 'konsultasi-pendewasaan-usia-perkawinan', 'uploads/oo3Si8Ray4BriKhAhrbxxXVTPve9ELxWeyc9dZ4W.jpg', '2022-12-10 01:34:57', '2022-12-12 13:07:28'),
(12, 2, 'Konsultasi Calon Pengantin (CATIN)', 'konsultasi-calon-pengantin-catin', 'uploads/Vt0i13sNhAPk1Hss5HybH9HwsYxNDhuMMM4NDXzD.jpg', '2022-12-10 01:35:08', '2022-12-12 13:07:40'),
(13, 2, 'Konsultasi Penyiapan Kehidupan Berkeluarga Bagi Remaja (PKBR)', 'konsultasi-penyiapan-kehidupan-berkeluarga-bagi-remaja-pkbr', 'uploads/cq8btv4pCu3SQ9nbXALaIsyW0Yci9CWJQ5RnJBbJ.jpg', '2022-12-10 01:35:20', '2022-12-12 13:07:50'),
(14, 2, 'Konsultasi Pengaturan Kelahiran', 'konsultasi-pengaturan-kelahiran', 'uploads/Sib0RCxrkz1KteacSaBgu3uo6AtGLM0mdT6bcxmZ.jpg', '2022-12-10 01:35:30', '2022-12-12 13:08:01'),
(15, 2, 'Konsultasi BKB, BKR, BKL, PIK-R, UPPKS', 'konsultasi-bkb-bkr-bkl-pik-r-uppks', 'uploads/lHLehxFUg5UPpBiTa810VnLF183Iw4mDLrGtlPBN.jpg', '2022-12-10 01:35:49', '2022-12-12 13:08:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `postcategory_id` bigint(20) DEFAULT NULL,
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

INSERT INTO `services` (`id`, `name`, `slug`, `postcategory_id`, `link`, `image`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'J - Data dan Informasi', 'j-data-dan-informasi', 2, '#', 'uploads/xNmRC1aTtiPraR0gzqYZlxoJ7u1GU9Pd653vc24A.jpg', '<div>Keluarga Berencana dan Keluarga Sejahtera1<br><br></div>', NULL, '2022-08-06 02:41:48', '2022-12-12 08:12:54'),
(2, 'J - Keluarga Berkualitas', 'j-keluarga-berkualitas', 4, '#', 'uploads/AkheWgcGDWKw3FzE04Pf2aHuRORbk1IspdCB9dUy.jpg', '<div>Pengendalian Penduduk dan Advokasi, Penggerakan dan Informasi</div>', NULL, '2022-08-06 02:42:10', '2022-12-12 08:12:49'),
(3, 'J - Anak Terlindungi', 'j-anak-terlindungi', 3, '#', 'uploads/YUkvGIgvgBRM7pM4EULvxeLp6ogPHzEHgEvzuGAm.jpg', '<div>Pelindungan Anak</div>', NULL, '2022-08-07 13:17:26', '2022-12-12 08:10:05'),
(4, 'J - Perempuan Berdaya', 'j-perempuan-berdaya', 5, '#', 'uploads/h4rKWVBStckjrDLtksubPTF96o6QV8XhwjmBUAa0.jpg', '<div>Pemberdayaan dan Perlindungan Perempuan</div>', NULL, '2022-08-07 13:22:37', '2022-12-12 08:09:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
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

INSERT INTO `settings` (`id`, `name`, `main_logo`, `sec_logo`, `favicon`, `description`, `address`, `email`, `telp`, `facebook`, `twitter`, `instagram`, `whatsapp`, `telegram`, `youtube`, `tiktok`, `latitude`, `longitude`, `map`, `code`, `created_at`, `updated_at`) VALUES
(1, 'DP3AKB Kabupaten Jember', 'uploads/9UvVvRfyRI4uYTEQpNHm3i2UP9Z5t7R3z3PFSasP.png', 'uploads/4MZc4smDf5vrE7WIXGlsatDYozRwtnboWDDgUrtR.png', 'uploads/Nkgvl4UzCaASraas0RadE2gFPfP6AktlYTxeyiXZ.png', 'Website Resmi Dinas Pemberdayaan Perempuan Perlindungan Anak dan Keluarga Berencana (DPPPAKB) Kabupaten Jember - Jawa Timur', 'Jl. Jawa No.51, Tegal Boto Lor, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121', NULL, '0331422103', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.321510001437!2d113.71788951427891!3d-8.17032828414265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd695cd928db2b3%3A0xf03ce39f8a35b906!2sDinas%20Pemberdayaan%20Perempuan%20Perlindungan%20Anak%20dan%20Keluarga%20Berencana%20(PPPAKB)%20Kabupaten%20Jember!5e0!3m2!1sid!2sid!4v1669888138865!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '2022-11-30 02:15:29', '2022-12-02 02:42:22');

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
(1, 'slider 4', 'uploads/9cYxBsBEreWrPBaKaWhrz0r6QUub2F2eleIRkjc4.jpg', 'uploads/l8hC9cCHkbtJfuzYCsD0M1sqLknelgGjGgPsgsSR.jpg', 0, NULL, '2022-11-30 13:41:57', '2022-12-02 14:35:59'),
(2, 'slider 3', 'uploads/kCU8mBo2SLbSO64gqerZdkpVHr8TTjP1vOKZNl9L.jpg', 'uploads/6CsNs00PCUL98MxkjTo5J0xtIdJn6CcH4ufhymYQ.jpg', 0, NULL, '2022-11-30 13:56:40', '2022-12-02 14:36:19'),
(3, 'Slider 2', 'uploads/hkx8kbRXkVTgX5Wxs1XgCcmbt0KRQBn7UEFTazKd.jpg', 'uploads/XS8gVkDJHyoOz72QGspqZk9Xb800iQCmk7NowLxY.jpg', 0, NULL, '2022-12-02 14:36:37', '2022-12-02 14:36:37'),
(4, 'Slider 1', 'uploads/qkGP4jTwLXIhGtEmhKcB5fFDXcoxhMv6o6dxojiL.jpg', 'uploads/ElHgJXtb0s8AjWypCe31ENuU2uEcQ5wADUFfIS9Y.jpg', 0, NULL, '2022-12-02 14:36:58', '2022-12-04 08:58:51');

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
  `star` double NOT NULL DEFAULT 0,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `star`, `title`, `image`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 5, 'Developer', 'uploads/IOwF2ISQiW0uLOryixvIg2APKHzgJ6zqg4Fy1WnO.png', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.', NULL, '2022-08-06 02:44:52', '2022-12-05 05:56:09'),
(2, 'Edward Michale', 5, 'Team Support', 'uploads/aKfYIlV6kxRZgk9b1tT14fzv7CeiZGOgpV78Nqyf.jpg', 'Ad id cum deleniti explicabo provident fugiat sapiente iusto', NULL, '2022-08-06 02:46:31', '2022-12-05 05:55:58');

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
  `password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `kelurahan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `level_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `hp`, `password`, `address`, `photo`, `kelurahan_id`, `level_id`, `status`, `verified_at`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', 'erfandibagus532@gmail.com', NULL, '$2y$10$dDl8fh3oPPRCb8rPTG60N.ySepr4yLNSq2i8KmvkzYQwJ.6BYtnLW', NULL, NULL, NULL, 1, 1, '2022-08-06 02:08:41', 'SRJtgziDX1H3wafWCIADYmXccbrjdC6c4WWh6tYOlQ8hytIPrN3Wnw5ox4jh', NULL, '2022-08-06 02:08:41', '2022-08-06 02:08:41'),
(2, 'figo', 'figo', 'figofajar46@gmail.com', '081331563232', '123', NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL);

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
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `call_to_actions`
--
ALTER TABLE `call_to_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kelurahans`
--
ALTER TABLE `kelurahans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kelurahans_name_unique` (`name`),
  ADD UNIQUE KEY `kelurahans_slug_unique` (`slug`);

--
-- Indeks untuk tabel `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `levels_name_unique` (`name`);

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
-- Indeks untuk tabel `postcategories`
--
ALTER TABLE `postcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Indeks untuk tabel `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sections_name_unique` (`name`),
  ADD UNIQUE KEY `sections_slug_unique` (`slug`);

--
-- Indeks untuk tabel `servicecategories`
--
ALTER TABLE `servicecategories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
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
  ADD UNIQUE KEY `users_hp_unique` (`hp`);

--
-- Indeks untuk tabel `walogs`
--
ALTER TABLE `walogs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `call_to_actions`
--
ALTER TABLE `call_to_actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `consultations`
--
ALTER TABLE `consultations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelurahans`
--
ALTER TABLE `kelurahans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `links`
--
ALTER TABLE `links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `postcategories`
--
ALTER TABLE `postcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `servicecategories`
--
ALTER TABLE `servicecategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT untuk tabel `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `walogs`
--
ALTER TABLE `walogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
