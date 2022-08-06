-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Agu 2022 pada 09.23
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logistik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(3, 'supervisor', 'user yang approval');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang_request`
--

CREATE TABLE `keranjang_request` (
  `id` int(11) NOT NULL,
  `request` int(11) NOT NULL,
  `material` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `keranjang_request`
--

INSERT INTO `keranjang_request` (`id`, `request`, `material`, `jumlah`) VALUES
(2, 3, 2, 3),
(3, 3, 27, 2),
(4, 4, 1, 3),
(5, 5, 28, 2),
(6, 5, 15, 1),
(7, 6, 7, 3),
(8, 6, 4, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(4, '::1', 'hiski46@gmail.com', 1659757878);

-- --------------------------------------------------------

--
-- Struktur dari tabel `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `material` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `material`
--

INSERT INTO `material` (`id`, `material`, `stok`) VALUES
(1, 'ARESTER CONTACT FLASTRAB VAL -MS 230 ST (7POLE) PHOENIX', 15),
(2, 'ARESTER VAL-MS 230/3+1 FM PHOENIX', 0),
(3, 'ARRESTER 4P WR-C40 WRDZ', 10),
(4, 'BUS BAR 300 X 100 X 8MM (alumunium)', 19),
(5, 'COS 40 A 4 POLE SOCOMEC', 0),
(6, 'COS 63 A 4 POLE KRAUSNAIMER (KN)', 0),
(7, 'COS 63 A ABB', 0),
(8, 'GEMBOK 50 MM  KEND', 0),
(9, 'GEMBOK 50 MM MASTER PADLOCK', 0),
(10, 'GEMBOK MANUAL 40 MM  SHISUKA', 0),
(11, 'GEMBOK PADLOCK 50 MM DOORMATIC', 9),
(12, 'ISOLATOR BULAT 40 X 40 MM', 0),
(13, 'KLEM BUAYA', 5),
(14, 'KLEM KUKU MACAN 70MM', 30),
(15, 'LAMPU OBL L810 SMI POWER', 0),
(16, 'LAMPU OBL LS810 NANHUA', 0),
(17, 'MICRO SD 64GB SANDISK', 2),
(18, 'MODEM MIFI 4G MQ531 RODSON', 0),
(19, 'MOUNTING OBL NANHUA', 2),
(20, 'OL32 LED BASED LOW INTENSITY SINGLE OBSTRACTION LIGHT', 0),
(21, 'PHOTOCELL 220V 6A LUMINA', 7),
(22, 'SKUN 70 MM', 65),
(23, 'SKUN SC 50-10 MM', 97),
(24, 'SPLITZEN 3/4\" X 60 CM', 27),
(25, 'WIRELES IP CAMERA INFRARED OUTDOOR WATERPROOF / CCTV KAMERA', 2),
(26, 'LIGHT OBL-12-AL INDOLEEDS', 0),
(27, 'LAMPU OBL RE-CONDITION (REPAIR)', 0),
(28, 'COS 63 A 4 POLE SOCOMEC', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '20181211100537', 'IonAuth\\Database\\Migrations\\Migration_Install_ion_auth', '', 'IonAuth', 1659599912, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `request_by` int(11) NOT NULL,
  `tanggal` int(11) NOT NULL,
  `approval` enum('yes','no') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `request`
--

INSERT INTO `request` (`id`, `request_by`, `tanggal`, `approval`) VALUES
(3, 2, 1659758604, 'yes'),
(4, 2, 1659758728, 'no'),
(5, 4, 1659761882, 'yes'),
(6, 4, 1659769392, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$12$GhivvaTFX0ZhlIuts6IwEuwtYW9Tkx5wP29MvQhLtA.G0f6RadrpW', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1659769449, 1, 'Admin', 'istrator', 'ADMIN', '-'),
(2, '::1', 'user1@mail.com', '$2y$10$wIQ41CIDz8MVliiPXgxUqeBXfFrx/2eysOajfQXXMc/9Ce/USG2vu', 'user1@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1659665773, 1659769373, 1, 'user ', '1', '', ''),
(3, '::1', 'supervisor1@mail.com', '$2y$10$qYx/8AwUgkGW/0Cy.r60IeR2WnBA/gnUBDOaH0HTFFUpaLDMMpBbW', 'supervisor1@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1659665833, 1659769424, 1, 'Supervisor', '1', 'test', '-'),
(4, '::1', 'user2@mail.com', '$2y$10$t2xQCOvYHtm.RWt9oTnK8.QcQ0QDbXVacm5cqytm5plqNPntcgY7m', 'user2@mail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1659761860, 1659769388, 1, 'user', '2', '-', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_groups`
--

CREATE TABLE `users_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(3, 2, 2),
(5, 3, 3),
(6, 1, 1),
(7, 4, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keranjang_request`
--
ALTER TABLE `keranjang_request`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `remember_selector` (`remember_selector`);

--
-- Indeks untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_groups_user_id_foreign` (`user_id`),
  ADD KEY `users_groups_group_id_foreign` (`group_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `keranjang_request`
--
ALTER TABLE `keranjang_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `users_groups_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
