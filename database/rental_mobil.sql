-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2024 at 11:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_mobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

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
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('cNVqBMOgg0EcAX0y8ifVYv2mgRwJx55IFJyfE13i', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicGlReXBZUXluNXpZOWx5VmZtMThxN0VjZTNac3BVSEozYTF0SjBEUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1731061701);

-- --------------------------------------------------------

--
-- Table structure for table `tb_business_profiles`
--

CREATE TABLE `tb_business_profiles` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `google_maps` text NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_founding_date` date NOT NULL,
  `brand_email` varchar(255) NOT NULL,
  `brand_website` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_business_profiles`
--

INSERT INTO `tb_business_profiles` (`id`, `created_at`, `updated_at`, `uuid`, `logo`, `address`, `owner_name`, `about`, `google_maps`, `brand_name`, `brand_founding_date`, `brand_email`, `brand_website`) VALUES
(1, '2024-10-18 16:19:50', '2024-11-08 10:28:11', 'uuid1234', 'image/qxv41L5jDOP9YrBfFcPqwg6fDGA1bEIelJiLtz1r.png', 'Indonesia', 'Anonim', '<p><strong>Lorem ipsum</strong> dolor sit, amet consectetur adipisicing elit. Vitae hic totam culpa unde optio, possimus animi voluptate quia atque repudiandae, distinctio a! Nam nobis eveniet dolorum eaque natus sint eos architecto quo provident ducimus voluptatum illum repudiandae est excepturi alias officiis magnam, quasi rem iusto iste quidem? Aut perferendis facilis eius repellat, error fugiat consequatur adipisci quos eum amet nulla quaerat alias aspernatur, quo accusamus labore dolorem nisi reprehenderit ab itaque accusantium in quisquam. Autem quia voluptatem a itaque. Unde sunt consequuntur laborum explicabo quasi, expedita optio necessitatibus quod officiis a repellat beatae id soluta corrupti quidem ab inventore tempora.</p>', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7976.439948837537!2d103.5518596658181!3d-1.621851021281201!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sid!2sid!4v1730092779448!5m2!1sid!2sid\" width=\"100%\" height=\"100%\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'Persewaan Mobil', '2024-10-23', 'email@gmail.com', 'http://localhost');

-- --------------------------------------------------------

--
-- Table structure for table `tb_contacts`
--

CREATE TABLE `tb_contacts` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) NOT NULL,
  `platform` varchar(255) NOT NULL,
  `username_number` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_contacts`
--

INSERT INTO `tb_contacts` (`id`, `created_at`, `updated_at`, `uuid`, `platform`, `username_number`, `icon`, `url`) VALUES
(1, '2024-10-19 09:26:03', '2024-11-07 12:18:56', '21af80bb-2e09-473c-ad00-7c57e4bae89d', 'Telephone', '+62 000-0000-0000', 'fas fa-phone', 'tel:+6200000000000'),
(2, '2024-10-19 07:14:30', '2024-11-07 12:19:06', '40be40d2-8cfb-4bc4-8f12-43f86cfef3e8', 'Whatsapp', '+62 000-0000-0000', 'fab fa-whatsapp', 'https://wa.me/6200000000000'),
(3, '2024-10-25 06:39:09', '2024-11-07 12:18:07', 'ba83117d-7d58-47f9-8152-5b4e10447612', 'Instagram', 'instagram', 'fab fa-instagram', 'https://www.instagram.com/instagram/'),
(4, '2024-10-19 09:27:39', '2024-11-07 12:17:49', 'df2d9b90-87dd-4ddc-96b6-51a85b81622d', 'Email', 'email@gmail.com', 'fa fa-envelope', 'mailto:email@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu_accesses`
--

CREATE TABLE `tb_menu_accesses` (
  `id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `first_menu_id` int(11) DEFAULT NULL,
  `second_menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_menu_accesses`
--

INSERT INTO `tb_menu_accesses` (`id`, `created_at`, `updated_at`, `uuid`, `role_id`, `first_menu_id`, `second_menu_id`) VALUES
(540, '2024-11-07 15:14:41', '2024-11-07 15:14:41', '3e3e336c-bb83-44f1-8cd5-5933ec8e679c', 2, 2, 2),
(541, '2024-11-07 15:14:41', '2024-11-07 15:14:41', 'c818ce51-0353-4b69-bfd7-b4cc0369b2af', 2, 1, NULL),
(542, '2024-11-07 15:14:41', '2024-11-07 15:14:41', '4400fed8-4b3f-460d-9308-67bdafb7fa70', 2, 3, 20),
(543, '2024-11-07 15:14:41', '2024-11-07 15:14:41', 'baaf614e-2c74-4a1a-b59f-b87baf82ac3b', 2, 3, 21),
(544, '2024-11-07 15:14:41', '2024-11-07 15:14:41', 'ddf86ef5-48bf-4c84-bb9a-976519ea69a2', 2, 3, 27),
(545, '2024-11-07 15:14:41', '2024-11-07 15:14:41', '72ddea76-ae64-45ea-90cc-8c0cdbfada6f', 2, 3, 3),
(546, '2024-11-07 15:14:41', '2024-11-07 15:14:41', '2bc55bd4-c3b5-44f0-aa8d-fe6b77c1860d', 2, 3, 4),
(547, '2024-11-07 15:14:41', '2024-11-07 15:14:41', 'fa15fbfb-1635-4c98-aaaa-b27a91da47a4', 2, 3, 23),
(548, '2024-11-07 15:14:41', '2024-11-07 15:14:41', '1134c857-d494-4b1e-b6fc-8970846b7a8f', 2, 27, NULL),
(549, '2024-11-07 15:14:41', '2024-11-07 15:14:41', 'ecbb0d4e-3d7d-46f7-a846-9910024879a6', 2, 4, NULL),
(550, '2024-11-08 09:37:00', '2024-11-08 09:37:00', '47959a95-f4b3-47f1-b255-201aabb32cf4', 3, 1, NULL),
(551, '2024-11-08 09:37:00', '2024-11-08 09:37:00', '9de42af7-9db0-4fc0-9d3f-de164bb03530', 3, 27, NULL),
(552, '2024-11-08 09:37:00', '2024-11-08 09:37:00', '7a386cc3-61b4-479f-8257-53dbde2b9004', 3, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu_firsts`
--

CREATE TABLE `tb_menu_firsts` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) NOT NULL,
  `first_menu_name` varchar(255) DEFAULT NULL,
  `first_menu_link` varchar(255) DEFAULT NULL,
  `first_menu_icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_menu_firsts`
--

INSERT INTO `tb_menu_firsts` (`id`, `created_at`, `updated_at`, `uuid`, `first_menu_name`, `first_menu_link`, `first_menu_icon`) VALUES
(1, '2024-07-27 16:12:20', '2024-07-27 16:13:18', '1', 'Dashboard', 'dashboard', 'fas fa-th'),
(2, '2024-07-04 11:07:14', '2024-11-07 11:30:39', '2', 'Aplikasi', '#', 'fas fa-cog'),
(3, '2024-07-01 09:32:11', '2024-07-26 02:56:29', '3', 'Master', '#', 'fas fa-layer-group'),
(4, '2024-10-22 06:03:49', '2024-11-07 11:30:14', '6d3ce7cf-1d9b-4e4f-bced-a526c68508d0', 'Profil', 'profiles', 'fas fa-user'),
(27, '2024-11-07 15:14:16', '2024-11-07 15:42:08', '2776cabc-3bb5-450f-a143-009df1cb4bb1', 'Penyewaan', 'penyewaan', 'fas fa-car');

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu_seconds`
--

CREATE TABLE `tb_menu_seconds` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) NOT NULL,
  `second_menu_name` varchar(255) DEFAULT NULL,
  `second_menu_link` varchar(255) DEFAULT NULL,
  `second_menu_icon` varchar(255) DEFAULT NULL,
  `first_menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_menu_seconds`
--

INSERT INTO `tb_menu_seconds` (`id`, `created_at`, `updated_at`, `uuid`, `second_menu_name`, `second_menu_link`, `second_menu_icon`, `first_menu_id`) VALUES
(1, '2024-07-04 11:07:55', '2024-07-04 11:09:41', '1', 'Menu', 'menus', NULL, 2),
(2, '2024-07-04 11:08:23', '2024-11-07 11:30:03', '2', 'Peran', 'roles', NULL, 2),
(3, '2024-07-26 02:56:51', '2024-11-07 11:30:58', '3', 'Pengguna', 'users', NULL, 3),
(4, '2024-10-22 06:04:51', '2024-11-07 11:31:17', 'e123a76d-4369-4784-9eb2-1c0072c6dfca', 'Profil Bisnis', 'business-profiles/uuid1234/edit', NULL, 3),
(20, '2024-10-23 05:07:27', '2024-11-07 12:03:44', '9ab37dc7-e358-4d4a-a47c-aa261373828b', 'Kontak', 'contacts', NULL, 3),
(21, '2024-10-23 05:09:53', '2024-11-07 12:04:13', 'b26095c0-46c2-461c-b6c6-45a5c1fd4ae4', 'Metode Pembayaran', 'metode-pembayaran', NULL, 3),
(23, '2024-10-28 05:24:38', '2024-10-28 05:24:59', '0895a591-cebf-41f5-bfdb-d6816a9dd9a4', 'Setting', 'settings/uuid1234/edit', NULL, 3),
(27, '2024-11-07 13:52:23', '2024-11-07 13:52:23', '6daadb82-edac-40c6-9798-54a7542d6c7b', 'Mobil', 'mobil', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_metode_pembayarans`
--

CREATE TABLE `tb_metode_pembayarans` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) NOT NULL,
  `nama_rekening` varchar(255) NOT NULL,
  `nomor_rekening` varchar(255) NOT NULL,
  `pemilik_rekening` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_metode_pembayarans`
--

INSERT INTO `tb_metode_pembayarans` (`id`, `created_at`, `updated_at`, `uuid`, `nama_rekening`, `nomor_rekening`, `pemilik_rekening`) VALUES
(1, '2024-10-22 08:20:25', '2024-11-07 12:40:37', 'uuid123', 'BSI', '09321423', 'Anonim'),
(2, '2024-10-22 08:20:25', '2024-11-07 12:40:31', 'uuid124', 'BRI', '09321423', 'Anonim');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mobils`
--

CREATE TABLE `tb_mobils` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) NOT NULL,
  `no_polisi` varchar(255) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `warna` varchar(255) NOT NULL,
  `harga_harian` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `foto_1` varchar(255) NOT NULL,
  `foto_2` varchar(255) DEFAULT NULL,
  `foto_3` varchar(255) DEFAULT NULL,
  `foto_4` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_mobils`
--

INSERT INTO `tb_mobils` (`id`, `created_at`, `updated_at`, `uuid`, `no_polisi`, `merk`, `model`, `tahun`, `warna`, `harga_harian`, `status`, `foto_1`, `foto_2`, `foto_3`, `foto_4`) VALUES
(7, '2024-11-07 14:20:27', '2024-11-08 04:49:08', '25278722-1d5a-46af-955e-8358fc780cb5', '01', '02', '03', '04', '05', '50000', 'Tersedia', 'mobil/zzB2KcEGtdxKyYWPpiPzgBiOLTeokRsOiLxumtEK.png', 'mobil/bMYza8QD4Xb9ilIOCWC1cRoA4Tlw6tBcZ1gMnv7U.jpg', 'mobil/h5QW9eEHo3aemA7u0rPhVarfdcHxjToGR5nhHHgH.png', 'mobil/K9AT75aNuB6NC5sIQlTBU5mrG5yX7NLMaBPbKzrI.jpg'),
(8, '2024-11-07 14:36:54', '2024-11-08 04:48:58', 'a8909702-9e15-4847-b751-31d1623465e2', '02', '123', '321', '231', '312', '100000', 'Tersedia', 'mobil/BA7jS7qIE5QYu3gyEDGMeTJc3s13JFlFSSulYFdI.jpg', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayarans`
--

CREATE TABLE `tb_pembayarans` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) NOT NULL,
  `id_penyewaan` int(11) NOT NULL,
  `kode_pembayaran` varchar(255) NOT NULL,
  `total_harga` varchar(255) NOT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penyewaans`
--

CREATE TABLE `tb_penyewaans` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `tgl_mulai` varchar(255) NOT NULL,
  `tgl_selesai` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `id_pelanggan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `tb_penyewaans`
--
DELIMITER $$
CREATE TRIGGER `after_delete_penyewaan` AFTER DELETE ON `tb_penyewaans` FOR EACH ROW BEGIN
    -- Jika status penyewaan yang dihapus adalah 'Aktif', 'Proses', 'Gagal', atau 'Pending'
    IF OLD.status IN ('Pending', 'Proses', 'Aktif', 'Gagal') THEN
        UPDATE tb_mobils
        SET status = 'Tersedia'
        WHERE id = OLD.id_mobil;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_penyewaan` AFTER INSERT ON `tb_penyewaans` FOR EACH ROW BEGIN
    -- Jika status penyewaan adalah 'Aktif', 'Proses', 'Gagal', atau 'Pending'
    IF NEW.status IN ('Pending', 'Proses', 'Aktif', 'Gagal') THEN
        UPDATE tb_mobils
        SET status = 'Tidak Tersedia'
        WHERE id = NEW.id_mobil;
    ELSE
        UPDATE tb_mobils
        SET status = 'Tersedia'
        WHERE id = NEW.id_mobil;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_penyewaan` AFTER UPDATE ON `tb_penyewaans` FOR EACH ROW BEGIN
    -- Jika status penyewaan baru adalah 'Aktif', 'Proses', 'Gagal', atau 'Pending'
    IF NEW.status IN ('Pending', 'Proses', 'Aktif', 'Gagal') THEN
        UPDATE tb_mobils
        SET status = 'Tidak Tersedia'
        WHERE id = NEW.id_mobil;
    ELSE
        UPDATE tb_mobils
        SET status = 'Tersedia'
        WHERE id = NEW.id_mobil;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_roles`
--

CREATE TABLE `tb_roles` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `button_access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_roles`
--

INSERT INTO `tb_roles` (`id`, `created_at`, `updated_at`, `uuid`, `role_name`, `button_access`) VALUES
(2, '2024-09-24 12:38:00', '2024-10-18 17:16:01', '72bd2d28-9152-46d2-9ef0-7a8524e6ca5e', 'Admin', 1),
(3, '2024-10-18 17:16:15', '2024-11-08 07:36:40', 'efb502e8-8678-45c4-a7b9-85ddf63e7961', 'User', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_settings`
--

CREATE TABLE `tb_settings` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) NOT NULL,
  `home_cover_image` varchar(255) NOT NULL,
  `home_cover_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_settings`
--

INSERT INTO `tb_settings` (`id`, `created_at`, `updated_at`, `uuid`, `home_cover_image`, `home_cover_text`) VALUES
(1, '2024-10-19 11:59:45', '2024-11-08 10:14:48', 'uuid1234', 'image/spm7SpJ3Jd5c78QFyIqfMtV5lr3pzsZER19WVTHc.svg', '<p>Text cover beranda…</p>');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `uuid`, `no_hp`, `address`, `role_id`) VALUES
(7, 'Anonim', 'admin@gmail.com', NULL, '$2y$12$pntYSW7YPU/PovqtGa3BU.krPhQIL1SqeDnumzRiwHNijMi66n1aC', NULL, '2024-11-07 11:12:09', '2024-11-07 11:12:09', 'e6aac4ed-487c-4fcf-9c07-8b9c198e87d2', '083131321312', 'Jl. Mawar', 2),
(10, 'Anonim User', 'user@gmail.com', NULL, '$2y$12$Uy2nKPygxV3zpzfUbl7q.ORsJfLAfK9rkqKSzWsI2bo2qYUdZ6s3q', NULL, '2024-11-08 10:24:06', '2024-11-08 10:24:06', '1469b388-f42a-47c7-a0af-d253d8a6bb75', '000', 'Jl. Patimura', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tb_business_profiles`
--
ALTER TABLE `tb_business_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`) USING BTREE;

--
-- Indexes for table `tb_contacts`
--
ALTER TABLE `tb_contacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`) USING BTREE;

--
-- Indexes for table `tb_menu_accesses`
--
ALTER TABLE `tb_menu_accesses`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `uuid` (`uuid`) USING BTREE,
  ADD KEY `tb_menu_accesses_role_id` (`role_id`),
  ADD KEY `tb_menu_accesses_second_menu_id` (`second_menu_id`),
  ADD KEY `tb_menu_accesses_first_menu_id` (`first_menu_id`);

--
-- Indexes for table `tb_menu_firsts`
--
ALTER TABLE `tb_menu_firsts`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `uuid` (`uuid`) USING BTREE;

--
-- Indexes for table `tb_menu_seconds`
--
ALTER TABLE `tb_menu_seconds`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `uuid` (`uuid`) USING BTREE,
  ADD KEY `tb_menu_seconds_first_menu_id` (`first_menu_id`);

--
-- Indexes for table `tb_metode_pembayarans`
--
ALTER TABLE `tb_metode_pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`) USING BTREE;

--
-- Indexes for table `tb_mobils`
--
ALTER TABLE `tb_mobils`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`) USING BTREE;

--
-- Indexes for table `tb_pembayarans`
--
ALTER TABLE `tb_pembayarans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`) USING BTREE;

--
-- Indexes for table `tb_penyewaans`
--
ALTER TABLE `tb_penyewaans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`) USING BTREE;

--
-- Indexes for table `tb_roles`
--
ALTER TABLE `tb_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`) USING BTREE;

--
-- Indexes for table `tb_settings`
--
ALTER TABLE `tb_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `uuid` (`uuid`) USING BTREE,
  ADD KEY `users_role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_business_profiles`
--
ALTER TABLE `tb_business_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_contacts`
--
ALTER TABLE `tb_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_menu_accesses`
--
ALTER TABLE `tb_menu_accesses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=553;

--
-- AUTO_INCREMENT for table `tb_menu_firsts`
--
ALTER TABLE `tb_menu_firsts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_menu_seconds`
--
ALTER TABLE `tb_menu_seconds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_metode_pembayarans`
--
ALTER TABLE `tb_metode_pembayarans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_mobils`
--
ALTER TABLE `tb_mobils`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_pembayarans`
--
ALTER TABLE `tb_pembayarans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_penyewaans`
--
ALTER TABLE `tb_penyewaans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_roles`
--
ALTER TABLE `tb_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_settings`
--
ALTER TABLE `tb_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_menu_accesses`
--
ALTER TABLE `tb_menu_accesses`
  ADD CONSTRAINT `tb_menu_accesses_first_menu_id` FOREIGN KEY (`first_menu_id`) REFERENCES `tb_menu_firsts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_menu_accesses_role_id` FOREIGN KEY (`role_id`) REFERENCES `tb_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_menu_accesses_second_menu_id` FOREIGN KEY (`second_menu_id`) REFERENCES `tb_menu_seconds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_menu_seconds`
--
ALTER TABLE `tb_menu_seconds`
  ADD CONSTRAINT `tb_menu_seconds_first_menu_id` FOREIGN KEY (`first_menu_id`) REFERENCES `tb_menu_firsts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
