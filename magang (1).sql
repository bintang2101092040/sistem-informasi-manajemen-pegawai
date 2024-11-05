-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Nov 2024 pada 06.37
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cabang`
--

CREATE TABLE `cabang` (
  `kode_cabang` char(3) NOT NULL,
  `nama_cabang` varchar(60) DEFAULT NULL,
  `lokasi_cabang` varchar(255) DEFAULT NULL,
  `radius_cabang` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cabang`
--

INSERT INTO `cabang` (`kode_cabang`, `nama_cabang`, `lokasi_cabang`, `radius_cabang`) VALUES
('BDD', 'Bandung', '-6.880946821106568, 107.59268410681494', 30),
('BDG', 'Bandung', '-6.880946821106568, 107.59268410681494', 3000),
('pku', 'pekanbaru', '0.5206568438283486, 101.42125822670386', 3000),
('smn', 'semen padang', '-0.9438023851904619,100.47170401443731', 30000);

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
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `nama_jabatan` varchar(255) NOT NULL,
  `gaji_pokok` varchar(20) NOT NULL,
  `tunjangan_tetap` varchar(20) DEFAULT NULL,
  `tunjangan_tidak_tetap` varchar(20) NOT NULL,
  `gaji_bpjs_ketenagakerjaan` varchar(20) NOT NULL,
  `gaji_bpjs_kesehatan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`nama_jabatan`, `gaji_pokok`, `tunjangan_tetap`, `tunjangan_tidak_tetap`, `gaji_bpjs_ketenagakerjaan`, `gaji_bpjs_kesehatan`) VALUES
('kepala mekanik', '2034750', '708250', '100000', '2812000', '2812000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban`
--

CREATE TABLE `jawaban` (
  `jawaban_id` int(11) NOT NULL,
  `kode_kategori` char(4) DEFAULT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pertanyaan_id` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jawaban`
--

INSERT INTO `jawaban` (`jawaban_id`, `kode_kategori`, `nik`, `pertanyaan_id`, `nilai`, `created_at`) VALUES
(25, NULL, '1', 1, 5, '2024-08-01'),
(26, NULL, '1', 4, 5, '2024-08-01'),
(27, NULL, '1', 3, 4, '2024-08-01'),
(28, NULL, '1', 2, 5, '2024-08-01'),
(29, NULL, '123', 1, 2, '2024-08-01'),
(30, NULL, '123', 4, 3, '2024-08-01'),
(31, NULL, '123', 3, 2, '2024-08-01'),
(32, NULL, '123', 2, 4, '2024-08-01'),
(33, NULL, '123422', 1, 5, '2024-08-01'),
(34, NULL, '123422', 4, 5, '2024-08-01'),
(35, NULL, '123422', 3, 5, '2024-08-01'),
(36, NULL, '123422', 2, 5, '2024-08-01'),
(37, NULL, '12345', 1, 4, '2024-08-01'),
(38, NULL, '12345', 4, 3, '2024-08-01'),
(39, NULL, '12345', 3, 3, '2024-08-01'),
(40, NULL, '12345', 2, 4, '2024-08-01'),
(41, NULL, '1', 1, 5, '2024-09-01'),
(42, NULL, '1', 4, 2, '2024-09-01'),
(43, NULL, '1', 3, 3, '2024-09-01'),
(44, NULL, '1', 2, 4, '2024-09-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `nik` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nama_jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_hp` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `kode_cabang` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `tempat_tgl_lahir` varchar(50) DEFAULT NULL,
  `no_kk` varchar(20) DEFAULT NULL,
  `alamat_ktp` text DEFAULT NULL,
  `alamat_domisili` text DEFAULT NULL,
  `nik_karyawan` varchar(20) DEFAULT NULL,
  `tanggal_gabung` date DEFAULT NULL,
  `bpjs_kesehatan` varchar(20) DEFAULT NULL,
  `bpjs_ketenagakerjaan` varchar(20) DEFAULT NULL,
  `rek_mandiri` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `npwp` varchar(20) DEFAULT NULL,
  `golongan_darah` varchar(5) DEFAULT NULL,
  `data_keluarga` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`nik`, `nama_lengkap`, `nama_jabatan`, `no_hp`, `foto`, `kode_cabang`, `jenis_kelamin`, `tempat_tgl_lahir`, `no_kk`, `alamat_ktp`, `alamat_domisili`, `nik_karyawan`, `tanggal_gabung`, `bpjs_kesehatan`, `bpjs_ketenagakerjaan`, `rek_mandiri`, `email`, `npwp`, `golongan_darah`, `data_keluarga`, `status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
('1', 'coba', NULL, '1', '1.jpg', 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'resign', '$2y$12$d211xxbYJSMfLu6lbmMnUeTV62ljrihc5mIzDJ5yqZlxJV2oEoyzq', NULL, NULL, NULL),
('1111', 'hahaha', 'kepala mekanik', '0098979087', NULL, 'smn', 'laki laki', NULL, NULL, NULL, NULL, NULL, '2024-08-19', NULL, NULL, NULL, 'gilan@gmail.com', NULL, NULL, NULL, 'akttiv', '$2y$12$3B3tkx/4f.qCFurlFfNGWuIMdIhORiDN/.pRD.Hn0LzQS4hV8MRTq', NULL, NULL, NULL),
('123', 'ashj', 'kepala mekanik', '2138279', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$0nJfnXCjXb4nhTP9AZI/SuYvlJKEciijX45l3benqSKTFSiCaZZnO', NULL, NULL, NULL),
('123422', 'ash', 'djf', '81387', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', '$2y$12$.Cut54R4bSYDE.0NMvFpbec9mdBBNv0sCniKWcM6EgW2SerV0xdSi', NULL, NULL, NULL),
('12345', 'karyawan 1', 'kepala mekanik', '08199999', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', '$2y$12$bi90oYffSgLso4eri7o7juGXqTmB2UY6Fecq3Gz4QMRf1EA3gVHd6', NULL, NULL, NULL),
('1234512165', 'randa', 'tets', '91289389', '1234512165.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kutch.vernon@example.neta', NULL, NULL, NULL, 'aktif', '$2y$12$NqtIVAOM4cEjlRdixuVTseQrJSMLxACrZYJWNPMR6khN0SuZhUaHe', NULL, NULL, NULL),
('123456', 'bintang', 'kepala mekanik', '0819903015', '123456.jpg', 'smn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gilanghandevis03@gmail.com', NULL, NULL, NULL, 'akttiv', '$2y$12$IweNY/K9ACEYbKJ54Zkoiui/AQrCTJr4ZQuSz6qyKDFrGcdEQavSu', NULL, NULL, NULL),
('2378324827', 'gabbung', 'ggabung', '908298079', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-08', NULL, NULL, NULL, 'rina@gmail.com', NULL, NULL, NULL, 'akttiv', '$2y$12$9P07y5Rjzgf3LIClqQiTnOL3DdLDGueyPdTOPQ8aYFrSgplYNZFtK', NULL, NULL, NULL),
('43253265', 'dsgsdfg', 'suahgfuhgb', '89453875', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-19', NULL, NULL, NULL, 'adhfbhads@sdfhju.vocm', NULL, NULL, NULL, 'akttiv', '$2y$12$Fj6gjebeB.OiKfBADPqgHOY0qz/z8iPd2zqHP7AvOJa57biUXhd0i', NULL, NULL, NULL),
('4325326534', 'dsgsdfg', 'suahgfuhgb', '89453875', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-19', NULL, NULL, NULL, 'adhfbhads@sdfhju.vocme', NULL, NULL, NULL, 'akttiv', '$2y$12$fBgVj2s2drzHlIGO/XbqGeZbw//8yqotamhU2/DPh.uLTVBjuhGCG', NULL, NULL, NULL),
('556263', 'arras', NULL, '09012903', '556263.jpg', 'smn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'arras@gmail.com', NULL, NULL, NULL, 'aktiv', '$2y$12$dUUZq17/cW97p4.cp4YZPO4J2/wDKX8I0i2jifZcfjwDwYIT8M1ZK', NULL, NULL, NULL),
('5688', 'aliff', 'kepala mekanik', '089089', NULL, 'smn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kutch.vernon@example.net', NULL, NULL, NULL, 'akttiv', '$2y$12$Jp5FKkOp3AOIc4GvqTvx4.nDZeNaKTFRe1pMkQR/lFlgbYo2mjRGC', NULL, NULL, NULL),
('657217581678', 'asdhfvgjvasdjhb', 'kepala mekanik', '090283489', NULL, 'smn', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-28', NULL, NULL, NULL, 'rina@gmail.comhaah', NULL, NULL, NULL, 'akttiv', '$2y$12$kvIOE1L50lDizTsZ4Rm9v.4KXvivNsIB3pv2byq7vzw.1rzBYLcCG', NULL, NULL, NULL),
('8237187', 'gilang purnama', 'mekanik', '092038878', '8237187.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kutch.vernon@example.netaaa', NULL, NULL, NULL, 'aktiv', '$2y$12$SA5O/WwTWQuQjx4eaaQieuUPoCU.ThTSjqzmfy4YfDMXiauudWYSm', NULL, NULL, NULL),
('99999', 'test cabang', 'kepala mekanik', '092308', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-18', NULL, NULL, NULL, 'rina@gmaill.com', NULL, NULL, NULL, 'akttiv', '$2y$12$/DEKrXtzkg8FnHPmvoYVd.bmn62wF57gemJCQLO1D1kKTPNTER//O', NULL, NULL, NULL),
('999998', 'test cabang', 'hsgajdjh', '092308', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-19', NULL, NULL, NULL, 'rina@gmailll.com', NULL, NULL, NULL, 'akttiv', '$2y$12$dnaCR3nYBcWC46SE8rO4Ou8vvByJPF5tuwL9Si74tkBS9zpgRgmAG', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_pertanyaan`
--

CREATE TABLE `kategori_pertanyaan` (
  `kode_kategori` char(4) NOT NULL,
  `nama_kategori` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori_pertanyaan`
--

INSERT INTO `kategori_pertanyaan` (`kode_kategori`, `nama_kategori`) VALUES
('dede', 'aktivitassss'),
('haaa', 'depart'),
('hah', 'disiplin'),
('kat', 'tet');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfigurasi_lokasi`
--

CREATE TABLE `konfigurasi_lokasi` (
  `id` int(11) NOT NULL,
  `lokasi_kantor` varchar(255) DEFAULT NULL,
  `radius` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `konfigurasi_lokasi`
--

INSERT INTO `konfigurasi_lokasi` (`id`, `lokasi_kantor`, `radius`) VALUES
(1, '-0.9491571644235496, 100.44978700116609', 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_cuti`
--

CREATE TABLE `master_cuti` (
  `kode_cuti` char(3) NOT NULL,
  `nama_cuti` varchar(30) NOT NULL,
  `jml_hari` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `master_cuti`
--

INSERT INTO `master_cuti` (`kode_cuti`, `nama_cuti`, `jml_hari`) VALUES
('C01', 'Tahunan', 90),
('c02', 'holiday', 10);

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_28_013408_create_karyawan_table', 1),
(6, '2024_03_28_013650_create_presensi_table', 1),
(7, '2024_04_21_222011_add_foto_to_karyawan_table', 2),
(8, '2024_04_23_105021_create_pengajuan_izin_table', 3),
(9, '2024_04_23_105206_create_pengajuan_izin_table', 4),
(10, '2024_06_08_204144_create_sessions_table', 5),
(11, '2024_07_08_150635_create_permission_tables', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_izin`
--

CREATE TABLE `pengajuan_izin` (
  `izin_id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) NOT NULL,
  `tgl_izin_dari` date DEFAULT NULL,
  `tgl_izin_sampai` date DEFAULT NULL,
  `kode_cuti` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_izin` char(1) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status_approved` char(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foto_izin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengajuan_izin`
--

INSERT INTO `pengajuan_izin` (`izin_id`, `nik`, `tgl_izin_dari`, `tgl_izin_sampai`, `kode_cuti`, `status_izin`, `keterangan`, `status_approved`, `created_at`, `updated_at`, `foto_izin`) VALUES
(14, '123456', '2024-07-18', '2024-07-19', '', 'i', 'ubah pertama', '1', NULL, NULL, NULL),
(22, '1', '2024-06-10', '2024-06-10', NULL, 'i', 'izin dulu bang', '0', NULL, NULL, NULL),
(26, '556263', '2024-06-18', '2024-06-18', 'C01', 'c', 'cutiii cuyy', '0', NULL, NULL, NULL),
(27, '123456', '2024-07-06', '2024-07-06', NULL, 's', 'sakitt banget', '1', NULL, NULL, '123456_1720085164.png'),
(28, '123456', '2024-07-08', '2024-07-08', 'C01', 'c', 'cutti dulu bbos', '1', NULL, NULL, NULL),
(29, '123456', '2024-07-20', '2024-07-22', NULL, 'i', 'cobba', '0', NULL, NULL, NULL),
(30, '123456', '2024-08-01', '2024-08-12', 'C01', 'c', 'jjhh', '2', NULL, NULL, NULL),
(31, '123456', '2024-08-16', '2024-08-19', 'c02', 'c', 'sdgsd', '0', NULL, NULL, NULL),
(32, '123456', '2024-07-27', '2024-07-27', NULL, 'i', 'eefaa', '1', NULL, NULL, NULL),
(33, '556263', '2024-08-20', '2024-08-22', NULL, 's', 'izin dulu', '1', NULL, NULL, '556263_1724038889.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `penilaian_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`penilaian_id`, `start_date`, `end_date`) VALUES
(1, '2024-03-01', '2025-06-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view-karyawan', 'web', '2024-07-08 10:20:41', '2024-07-08 10:20:41'),
(2, 'view-cuti', 'web', '2024-07-08 10:20:41', '2024-07-08 10:20:41');

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
-- Struktur dari tabel `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `pertanyaan_id` int(11) NOT NULL,
  `kode_kategori` char(4) DEFAULT NULL,
  `pertanyaan` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pertanyaan`
--

INSERT INTO `pertanyaan` (`pertanyaan_id`, `kode_kategori`, `pertanyaan`) VALUES
(1, 'dede', 'inisiatif'),
(2, 'kat', 'pertanyaan 2'),
(3, 'hah', 'kategori 2'),
(4, 'dede', 'disiplin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensi`
--

CREATE TABLE `presensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) NOT NULL,
  `tgl_presensi` date NOT NULL,
  `jam_in` time DEFAULT NULL,
  `jam_out` time DEFAULT NULL,
  `foto_in` varchar(255) DEFAULT NULL,
  `foto_out` varchar(255) DEFAULT NULL,
  `status_presensi` char(1) NOT NULL,
  `izin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lokasi_in` varchar(255) DEFAULT NULL,
  `lokasi_out` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `presensi`
--

INSERT INTO `presensi` (`id`, `nik`, `tgl_presensi`, `jam_in`, `jam_out`, `foto_in`, `foto_out`, `status_presensi`, `izin_id`, `lokasi_in`, `lokasi_out`, `created_at`, `updated_at`) VALUES
(30, '12345', '2024-05-08', '14:22:23', NULL, '12345-2024-05-08-in.png', NULL, '', 0, '0.5144576,101.4595584', NULL, NULL, NULL),
(31, '12345', '2024-05-11', '15:38:18', NULL, '12345-2024-05-11-in.png', NULL, '', 0, '0.5341184,101.4595584', NULL, NULL, NULL),
(32, '12345', '2024-05-14', '23:19:56', '23:32:47', '12345-2024-05-14-in.png', '12345-2024-05-14-out.png', '', 0, '0.5144576,101.4431744', '0.5070677,101.4477793', NULL, NULL),
(34, '12345', '2024-05-20', '15:26:41', '15:29:59', '12345-2024-05-20-in.png', '12345-2024-05-20-out.png', '', 0, '0.4980736,101.4366208', '0.4980736,101.4366208', NULL, NULL),
(35, '12345', '2024-05-25', '19:00:56', NULL, '12345-2024-05-25-in.png', NULL, '', 0, '0.4714162,101.3731246', NULL, NULL, NULL),
(36, '12345', '2024-05-27', '08:21:45', '09:41:59', '12345-2024-05-27-in.png', '12345-2024-05-27-out.png', '', 0, '0.4636777,101.3987291', '0.463666,101.3987316', NULL, NULL),
(40, '12345', '2024-05-30', '18:59:00', '18:59:18', '12345-2024-05-30-in.png', '12345-2024-05-30-out.png', '', 0, '0.5177344,101.4300672', '0.5177344,101.4300672', NULL, NULL),
(45, '123456', '2024-06-09', '18:33:05', NULL, '123456-2024-06-09-in.png', NULL, 'h', 0, '0.5070677,101.4477793', NULL, NULL, NULL),
(64, '123456', '2024-06-11', '08:02:20', NULL, '123456-2024-06-11-in.png', NULL, 'h', NULL, '0.4980736,101.4104064', NULL, NULL, NULL),
(81, '123456', '2024-06-14', '11:00:14', NULL, '123456-2024-06-14-in.png', NULL, 'h', NULL, '0.5144576,101.4464512', NULL, NULL, NULL),
(82, '556263', '2024-06-14', '11:15:26', NULL, '556263-2024-06-14-in.png', NULL, 'h', NULL, '0.5144576,101.4464512', NULL, NULL, NULL),
(84, '5688', '2024-06-26', '05:55:03', NULL, '5688-2024-06-26-in.png', NULL, 'h', NULL, '-0.9563874,100.4509066', NULL, NULL, NULL),
(101, '123456', '2024-07-04', '15:02:07', NULL, '123456-2024-07-04-in.png', NULL, 'h', NULL, '-0.9563874,100.4509066', NULL, NULL, NULL),
(102, '123456', '2024-07-18', NULL, NULL, NULL, NULL, 'i', 14, NULL, NULL, NULL, NULL),
(103, '123456', '2024-07-19', NULL, NULL, NULL, NULL, 'i', 14, NULL, NULL, NULL, NULL),
(104, '123456', '2024-07-08', NULL, NULL, NULL, NULL, 'c', 28, NULL, NULL, NULL, NULL),
(105, '123456', '2024-07-06', NULL, NULL, NULL, NULL, 's', 27, NULL, NULL, NULL, NULL),
(106, '1', '2024-07-08', '03:03:18', '03:03:31', '1-2024-07-08-in.png', '1-2024-07-08-out.png', 'h', NULL, '-0.9393763,100.4319406', '-0.9393763,100.4319406', NULL, NULL),
(107, '123456', '2024-07-27', NULL, NULL, NULL, NULL, 'i', 32, NULL, NULL, NULL, NULL),
(108, '123456', '2024-07-20', '02:36:42', NULL, '123456-2024-07-20-in.png', NULL, 'h', NULL, '-0.9558184,100.4509066', NULL, NULL, NULL),
(128, '123456', '2024-07-31', '22:39:08', NULL, '123456-2024-07-31-in.png', NULL, 'h', NULL, '-0.9237956,100.3589234', NULL, NULL, NULL),
(129, '123456', '2024-08-03', '14:57:31', NULL, '123456-2024-08-03-in.png', NULL, 'h', NULL, '-0.9566629,100.3610289', NULL, NULL, NULL),
(142, '123456', '2024-07-31', '16:58:14', NULL, '123456-2024-08-18-in.png', NULL, 'h', NULL, '-0.9393756,100.4200011', NULL, NULL, NULL),
(143, '123456', '2024-07-30', '16:59:16', NULL, '123456-2024-08-18-in.png', NULL, 'h', NULL, '-0.9393756,100.4200011', NULL, NULL, NULL),
(144, '123456', '2024-07-29', '17:02:26', NULL, '123456-2024-08-18-in.png', NULL, 'h', NULL, '-0.9393756,100.4200011', NULL, NULL, NULL),
(145, '556263', '2024-08-19', '10:40:27', NULL, '556263-2024-08-19-in.png', NULL, 'h', NULL, '-0.9130742,100.4670608', NULL, NULL, NULL),
(146, '556263', '2024-08-20', NULL, NULL, NULL, NULL, 's', 33, NULL, NULL, NULL, NULL),
(147, '556263', '2024-08-21', NULL, NULL, NULL, NULL, 's', 33, NULL, NULL, NULL, NULL),
(148, '556263', '2024-08-22', NULL, NULL, NULL, NULL, 's', 33, NULL, NULL, NULL, NULL),
(149, '123456', '2024-09-03', '15:19:35', NULL, '123456-2024-09-03-in.png', NULL, 'h', NULL, '-0.9506287,100.4462757', NULL, NULL, NULL),
(150, '123456', '2024-10-03', '15:11:58', NULL, '123456-2024-10-03-in.png', NULL, 'h', NULL, '-0.917504,100.3814912', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-07-08 10:20:41', '2024-07-08 10:20:41'),
(2, 'HRD', 'web', '2024-07-12 13:24:56', '2024-07-12 13:24:56'),
(3, 'Owner', 'web', '2024-09-09 06:50:46', '2024-09-09 06:50:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Gilang', 'gilanghandevis03@gmail.com', NULL, '$2y$12$kEn/QijRGMvprNJtXpy/We8zwF1AdEGu51bf3CxtYC/HhUDDQyW7.', NULL, NULL, NULL),
(2, 'test user', 'user@testgmail.com', NULL, '$2y$12$WvrEzm4wdoHInrApgP..g.YIJl9XhvOtUMa/sLNVsh0vJ7CsdTLky', NULL, '2024-07-12 15:05:08', '2024-07-12 15:05:08'),
(3, 'test user', 'adhfbhads@sdfhju.vocm', NULL, '$2y$12$90Ym/7p7J7/wgusMHf5.Uuyzv1HojORQb8ginJInO2/m22OBTVOQ2', NULL, '2024-07-29 15:07:09', '2024-07-29 15:07:09'),
(4, 'bintang', 'bintanghandevis03@gmail.com', NULL, '$2y$12$xTw81HPR9rU3dAVzXcMchOX9yMMopypAF92lfIiQRsMEymwDHOHDG', NULL, '2024-09-13 09:17:29', '2024-09-13 09:17:29');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`kode_cabang`),
  ADD KEY `kode_cabang` (`kode_cabang`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`nama_jabatan`),
  ADD KEY `nama_jabatan` (`nama_jabatan`);

--
-- Indeks untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`jawaban_id`),
  ADD KEY `penilaian_id` (`kode_kategori`,`pertanyaan_id`),
  ADD KEY `nik` (`nik`),
  ADD KEY `kode_kategori` (`kode_kategori`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nik`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `nama_jabatan` (`nama_jabatan`,`kode_cabang`);

--
-- Indeks untuk tabel `kategori_pertanyaan`
--
ALTER TABLE `kategori_pertanyaan`
  ADD PRIMARY KEY (`kode_kategori`),
  ADD KEY `kode_kategori` (`kode_kategori`);

--
-- Indeks untuk tabel `konfigurasi_lokasi`
--
ALTER TABLE `konfigurasi_lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_cuti`
--
ALTER TABLE `master_cuti`
  ADD PRIMARY KEY (`kode_cuti`),
  ADD KEY `kode_cuti` (`kode_cuti`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pengajuan_izin`
--
ALTER TABLE `pengajuan_izin`
  ADD PRIMARY KEY (`izin_id`),
  ADD KEY `kode_cuti` (`kode_cuti`);

--
-- Indeks untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`penilaian_id`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`pertanyaan_id`),
  ADD KEY `kode_kategori` (`kode_kategori`);

--
-- Indeks untuk tabel `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presensi_nik_foreign` (`nik`),
  ADD KEY `izin_id` (`izin_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `jawaban_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `konfigurasi_lokasi`
--
ALTER TABLE `konfigurasi_lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pengajuan_izin`
--
ALTER TABLE `pengajuan_izin`
  MODIFY `izin_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `penilaian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `pertanyaan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`model_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `presensi_nik_foreign` FOREIGN KEY (`nik`) REFERENCES `karyawan` (`nik`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
