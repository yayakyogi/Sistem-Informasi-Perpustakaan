-- Adminer 4.8.1-dev MySQL 5.7.24 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `tb_admin`;
CREATE TABLE `tb_admin` (
  `id` varchar(32) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(16) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(64) NOT NULL,
  `telepon` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `roles` varchar(32) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_admin` (`id`, `nama`, `jenis_kelamin`, `alamat`, `email`, `telepon`, `password`, `roles`, `photo`, `created_at`, `updated_at`, `deleted_at`) VALUES
('162c31bc17e1f1d8400b7fc245ccb2bd',	'Yayak Yogi Ginantaka',	'Laki-laki',	'Ds Bolorejo RT/RW 030/011',	'yayaktaka@gmail.com',	'+6282233863080',	'$2y$10$BJiKMQ2zmMNDYThJV3T0W.Byb1qCjVaDXC3xRcIWAf8r4kb0Wyiby',	'superadmin',	'default.svg',	'2021-06-27 06:37:55',	'2021-07-08 01:47:21',	'2021-07-09 00:34:56'),
('3e8a917a2396a29a2717afca2a035f00',	'Yayak Yogi Ginantaka',	'Laki-laki',	'Ds Bolorejo RT/RW 030/011',	'ginantaka@gmail.com',	'+6282233863080',	'$2y$10$evg5lxxkRVQKQRMYA3AyUOOFgNr.EyW4buRcx6efaGRMpjDUZ.Mju',	'superadmin',	'default.svg',	'2021-06-27 08:17:39',	'2021-06-27 08:17:39',	NULL),
('7e107783c68e1bcbbecce9bcdec576b9',	'Takabin',	'Laki-laki',	'Ds Bolorejo ',	'taka@gmail.com',	'+62812345678',	'$2y$10$puSmUoW.7v7Ok9mHwnkKueSmZL3NKPsjUAyZOhJkdBm2ZwKEyjQcy',	'admin',	'1625682456_education.png',	'2021-06-27 08:24:31',	'2021-06-27 08:24:31',	NULL);

DROP TABLE IF EXISTS `tb_anggota`;
CREATE TABLE `tb_anggota` (
  `id` varchar(32) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(16) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(64) NOT NULL,
  `telepon` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_anggota` (`id`, `nama`, `jenis_kelamin`, `alamat`, `email`, `telepon`, `created_at`, `updated_at`, `deleted_at`) VALUES
('358d192f3b3e4f585148df553c96702a',	'Tes edit',	'Laki-laki',	'Ds Bolorejo',	'tes@gmail.com',	'+6282233863080',	'2021-07-08 23:21:03',	'2021-07-08 23:21:50',	NULL),
('97f2f07c37618ac42736da98637ba6f3',	'Bentar Hazard Ginantaka',	'Laki-laki',	'Ds Bolorejo RT/RW 030/011',	'bentarhazard@gmail.com',	'+6282233863080',	'2021-06-29 21:56:32',	'2021-06-29 21:56:44',	NULL);

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `tb_buku`;
CREATE TABLE `tb_buku` (
  `id` varchar(32) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `kategori_id` varchar(64) NOT NULL,
  `kategori` varchar(32) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_buku` (`id`, `judul_buku`, `deskripsi`, `kategori_id`, `kategori`, `cover`, `created_at`, `updated_at`, `deleted_at`) VALUES
('a1fbecab47df05c0217d123ba5454ebb',	'Tes 2',	'Lorem ipsum',	'087b6ddfc34925442308788bbc0f1bf4',	'Petulangan',	'default.jpg',	'2021-07-08 23:18:25',	'2021-07-08 23:18:25',	NULL),
('adb4441e600f1e1c8bededddb788ada1',	'Dora and The Explorer',	'Buku berisi tentang petualangan dora dan boots',	'087b6ddfc34925442308788bbc0f1bf4',	'Petulangan',	'default.jpg',	'2021-06-29 19:50:19',	'2021-06-29 20:07:42',	'2021-07-03 22:28:38'),
('eeed069b49260ffe174f47f09f5777b0',	'Test 1',	'aaaaaaaaaaa',	'cb45d00969ab47ac10b790687e7c687c',	'Petulangan',	'default.jpg',	'2021-06-29 19:50:51',	'2021-07-03 23:07:09',	NULL),
('f4cd8dd2b0ae5fcad0dd39fa8635bfd7',	'Test gambar',	'Lorem ipsum dolor sit amet',	'cb45d00969ab47ac10b790687e7c687c',	'Sains',	'1625330349_Buku Matematika Kelas 4-5-6.png',	'2021-06-29 20:20:39',	'2021-07-03 22:29:10',	NULL);

DROP TABLE IF EXISTS `tb_kategori`;
CREATE TABLE `tb_kategori` (
  `id` varchar(32) NOT NULL,
  `kategori` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_kategori` (`id`, `kategori`, `created_at`, `updated_at`, `deleted_at`) VALUES
('087b6ddfc34925442308788bbc0f1bf4',	'Petulangan',	'2021-06-27 14:41:45',	'2021-06-29 19:50:34',	NULL),
('cb45d00969ab47ac10b790687e7c687c',	'Sains',	'2021-06-27 14:42:05',	'2021-06-29 19:51:07',	NULL);

DROP TABLE IF EXISTS `tb_transaksi`;
CREATE TABLE `tb_transaksi` (
  `id` varchar(32) CHARACTER SET utf8mb4 NOT NULL,
  `anggota` varchar(255) NOT NULL,
  `buku` varchar(255) NOT NULL,
  `tanggal_pinjam` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `tanggal_kembali` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `status` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tb_transaksi` (`id`, `anggota`, `buku`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
('1851206455f6254d38ce10c795c709ee',	'Tes 6',	'tes 6',	'2021-07-08',	'2021-07-10',	'Dikembalikan',	'2021-07-08 23:29:30',	'2021-07-08 23:29:30',	'2021-07-08 23:33:33'),
('2ee3e21d9e60543417170324db86cec9',	'Yayak Yogi Ginantaka',	'tes 1',	'2021-07-04',	'2021-07-06',	'Terlambat',	'2021-07-06 22:04:11',	'2021-07-06 22:04:11',	NULL),
('42a54c081d2260dc2e6542cc12a9258f',	'Takasimura',	'Harry Photter',	'2021-07-06',	'2021-07-08',	'Dikembalikan',	'2021-07-06 23:52:17',	'2021-07-07 20:26:47',	NULL),
('65348fd721436bbb8361414c235d9d3d',	'Tes 8',	'tes 8',	'2021-07-08',	'2021-07-10',	'Dikembalikan',	'2021-07-08 23:33:51',	'2021-07-08 23:33:51',	NULL),
('6c01c0f63d9215cc61c2d37df0c132c9',	'Yayak Yogi Ginantaka',	'buku',	'2021-07-05',	'2021-07-06',	'Dikembalikan',	'2021-07-06 23:41:53',	'2021-07-06 23:41:53',	NULL),
('6e66d1033b1e488daac398156c4e3544',	'Tes',	'tes 3',	'2021-07-08',	'2021-07-10',	'Dikembalikan',	'2021-07-08 23:25:25',	'2021-07-08 23:25:25',	'2021-07-08 23:27:17'),
('7c11a60eadcc87eac1e368da7f9e3acb',	'Tes 5',	'tes 5',	'2021-07-08',	'2021-07-10',	'Dikembalikan',	'2021-07-08 23:28:23',	'2021-07-08 23:28:23',	'2021-07-08 23:29:13'),
('b4fe9036547bae2d3945d633c9d75a10',	'Bentar',	'Buku 2',	'2021-07-07',	'2021-07-08',	'Dikembalikan',	'2021-07-07 21:59:20',	'2021-07-07 21:59:20',	'2021-07-08 23:23:34'),
('b9bdd8a1f5a207e5b1f73f93b2b21f48',	'Tes 4',	'tes 4',	'2021-07-08',	'2021-07-10',	'Dikembalikan',	'2021-07-08 23:27:34',	'2021-07-08 23:27:34',	'2021-07-08 23:28:07'),
('ce9cd3de08f5a9b0704242344a8eef87',	'Bentar',	'Tes 2',	'2021-07-08',	'2021-07-10',	'Dikembalikan',	'2021-07-08 23:23:49',	'2021-07-08 23:23:49',	'2021-07-08 23:24:39'),
('eb53a3d8327ddbcf11b318e1a46067b5',	'Tes 7',	'tes 7',	'2021-07-08',	'2021-07-08',	'Dikembalikan',	'2021-07-08 23:31:44',	'2021-07-08 23:31:44',	'2021-07-08 23:33:30');

-- 2021-07-08 17:53:29