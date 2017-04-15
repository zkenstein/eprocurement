-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `satuan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'default.gif',
  `pdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `barang_kode_unique` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `barang` (`id`, `kode`, `satuan`, `deskripsi`, `gambar`, `pdf`, `created_at`, `updated_at`) VALUES
(6,	'LGS1',	'PKG',	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s',	'LGS1_1490312448.jpg',	NULL,	'2017-03-23 16:40:49',	'2017-03-27 22:34:11'),
(7,	'LGS2',	'PT',	'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries',	'LGS2_1490312474.jpeg',	'LGS2_1490679324.pdf',	'2017-03-23 16:41:14',	'2017-03-27 22:35:24'),
(8,	'LGS3',	'PT',	'but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages',	'LGS3_1490312501.jpg',	NULL,	'2017-03-23 16:41:41',	'2017-03-27 22:35:33'),
(9,	'LGS4',	'PCS',	'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old',	'LGS4_1490312534.jpg',	NULL,	'2017-03-23 16:42:15',	'2017-03-27 22:35:50'),
(10,	'LGS5',	'TPM',	'Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage',	'LGS5_1490312568.jpg',	NULL,	'2017-03-23 16:42:48',	'2017-03-27 22:35:59'),
(11,	'LGS6',	'DG',	'Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC',	'LGS6_1490312599.jpg',	NULL,	'2017-03-23 16:43:19',	'2017-03-27 22:36:09'),
(12,	'LGS7',	'PT',	'Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.',	'LGS7_1490312623.jpg',	NULL,	'2017-03-23 16:43:43',	'2017-03-27 22:36:24'),
(13,	'LGS8',	'DG',	'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested',	'LGS8_1490312659.jpg',	NULL,	'2017-03-23 16:44:19',	'2017-03-27 22:36:36'),
(14,	'LGS9',	'DG',	'Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.',	'LGS9_1490312680.png',	'LGS9_1490673954.pdf',	'2017-03-23 16:44:40',	'2017-03-27 22:36:57'),
(15,	'LGS10',	'DG',	'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using',	'LGS10_1490312713.jpg',	'LGS10_1490679264.pdf',	'2017-03-23 16:45:13',	'2017-03-27 22:34:24'),
(16,	'LGS11',	'DG',	'Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English',	'LGS11_1490312822.jpg',	NULL,	'2017-03-23 16:47:02',	'2017-03-27 22:34:44'),
(17,	'LGS12',	'Biji',	'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for',	'LGS12_1490673171.jpg',	'LGS12_1490673171.pdf',	'2017-03-23 16:47:21',	'2017-03-27 22:34:55'),
(18,	'LGS13',	'PKG',	'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour',	'LGS13_1490312861.jpg',	'LGS13_1490672963.pdf',	'2017-03-23 16:47:42',	'2017-03-27 22:35:08'),
(20,	'TES',	'PCS',	'Per a eleifend a adipiscing blandit urna curae metus platea quam parturient inceptos vestibulum vestibulum suspendisse dui habitant vestibulum magna parturient placerat erat in ornare tincidunt dignissim adipiscing lorem.Inceptos et adipiscing a nisi turpis a sit scelerisque.',	'TES_1490679472.jpg',	NULL,	'2017-03-27 22:37:52',	'2017-03-27 22:37:52');

DROP TABLE IF EXISTS `barang_eksternal`;
CREATE TABLE `barang_eksternal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `satuan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'default.gif',
  `pdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pengumuman_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `barang_eksternal_pengumuman_id_foreign` (`pengumuman_id`),
  CONSTRAINT `barang_eksternal_pengumuman_id_foreign` FOREIGN KEY (`pengumuman_id`) REFERENCES `pengumuman` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `cluster`;
CREATE TABLE `cluster` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cluster_kode_unique` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `cluster` (`id`, `kode`, `nama`, `created_at`, `updated_at`) VALUES
(1,	'1',	'PIPING, VALVE AND PROPULSI',	'2017-04-13 04:27:05',	'2017-04-13 04:27:05'),
(2,	'2',	'BOTTOM CLEANING DAN REPLATING',	'2017-04-13 04:27:05',	'2017-04-13 04:27:05'),
(3,	'3',	'ELECTRIKAL DAN MECANICAL',	'2017-04-13 04:27:05',	'2017-04-13 04:27:05'),
(4,	'4',	'DT AND NDT',	'2017-04-13 04:27:05',	'2017-04-13 04:27:05'),
(5,	'5',	'GENERAL SERVICE',	'2017-04-13 04:27:05',	'2017-04-13 04:27:05');

DROP TABLE IF EXISTS `extends_pengumuman`;
CREATE TABLE `extends_pengumuman` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `batas_akhir_waktu_penawaran` datetime NOT NULL,
  `validitas_harga` datetime NOT NULL,
  `waktu_pengiriman` datetime NOT NULL,
  `max_register` tinyint(4) NOT NULL,
  `start_auction` datetime NOT NULL,
  `durasi` tinyint(4) NOT NULL DEFAULT '0',
  `pengumuman_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `extends_pengumuman_pengumuman_id_foreign` (`pengumuman_id`),
  CONSTRAINT `extends_pengumuman_pengumuman_id_foreign` FOREIGN KEY (`pengumuman_id`) REFERENCES `pengumuman` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_reserved_reserved_at_index` (`queue`,`reserved`,`reserved_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved`, `reserved_at`, `available_at`, `created_at`) VALUES
(4,	'default',	'{\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"data\":{\"command\":\"O:29:\\\"App\\\\Jobs\\\\InsertPengumumanUser\\\":5:{s:13:\\\"\\u0000*\\u0000pengumuman\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":2:{s:5:\\\"class\\\";s:14:\\\"App\\\\Pengumuman\\\";s:2:\\\"id\\\";i:5;}s:16:\\\"\\u0000*\\u0000listIdCluster\\\";a:1:{i:0;s:1:\\\"1\\\";}s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:6:\\\"\\u0000*\\u0000job\\\";N;}\"}}',	0,	1,	1492072623,	1492072344,	1492072344);

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2017_03_19_212725_create_cluster_table',	1),
('2017_03_19_212726_create_user_table',	1),
('2017_03_19_213738_create_barang_table',	1),
('2017_03_19_213915_create_pengumuman_table',	1),
('2017_03_19_221808_create_pengumuman_cluster_table',	1),
('2017_03_19_222314_create_pengumuman_user_table',	1),
('2017_03_20_071652_create_pengumuman_barang_table',	1),
('2017_03_22_092414_create_user_cluster_table',	1),
('2017_03_28_162357_create_barang_eksternal_table',	1),
('2017_03_30_034715_create_jobs_table',	1),
('2017_04_07_135504_create_extends_pengumuman_table',	1);

DROP TABLE IF EXISTS `pengumuman`;
CREATE TABLE `pengumuman` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batas_awal_waktu_penawaran` datetime NOT NULL,
  `batas_akhir_waktu_penawaran` datetime NOT NULL,
  `validitas_harga` datetime NOT NULL,
  `waktu_pengiriman` datetime NOT NULL,
  `harga_netto` double NOT NULL,
  `mata_uang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `max_register` tinyint(4) NOT NULL,
  `count_register` tinyint(4) NOT NULL DEFAULT '0',
  `pemenang` int(10) unsigned DEFAULT NULL,
  `pic` int(10) unsigned NOT NULL,
  `file_excel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_auction` datetime NOT NULL,
  `durasi` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pengumuman_kode_unique` (`kode`),
  KEY `pengumuman_pemenang_foreign` (`pemenang`),
  KEY `pengumuman_pic_foreign` (`pic`),
  CONSTRAINT `pengumuman_pemenang_foreign` FOREIGN KEY (`pemenang`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pengumuman_pic_foreign` FOREIGN KEY (`pic`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `pengumuman` (`id`, `kode`, `batas_awal_waktu_penawaran`, `batas_akhir_waktu_penawaran`, `validitas_harga`, `waktu_pengiriman`, `harga_netto`, `mata_uang`, `max_register`, `count_register`, `pemenang`, `pic`, `file_excel`, `start_auction`, `durasi`, `created_at`, `updated_at`) VALUES
(3,	'ABCDE',	'2017-10-01 00:00:00',	'2017-10-07 23:00:00',	'2017-10-08 23:00:00',	'2017-10-21 16:00:00',	5000000,	'IDR',	0,	0,	NULL,	21,	NULL,	'2017-10-09 10:00:00',	120,	'2017-04-13 06:33:02',	'2017-04-13 06:33:02'),
(4,	'ZXCV',	'2017-04-12 00:00:00',	'2017-04-26 23:00:00',	'2017-04-27 19:00:00',	'2017-05-01 12:00:00',	50000000,	'SGD',	0,	1,	NULL,	21,	NULL,	'2017-04-29 10:00:00',	127,	'2017-04-13 07:06:25',	'2017-04-13 07:18:59'),
(5,	'LKJH',	'2017-04-01 00:00:00',	'2017-04-12 23:00:00',	'2017-04-13 00:00:00',	'2017-04-28 19:00:00',	4000000,	'SGD',	0,	0,	NULL,	22,	NULL,	'2017-04-13 20:30:00',	127,	'2017-04-13 08:32:24',	'2017-04-13 08:32:24');

DROP TABLE IF EXISTS `pengumuman_barang`;
CREATE TABLE `pengumuman_barang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pengumuman_id` int(10) unsigned NOT NULL,
  `barang_id` int(10) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `pengumuman_barang_pengumuman_id_foreign` (`pengumuman_id`),
  KEY `pengumuman_barang_barang_id_foreign` (`barang_id`),
  CONSTRAINT `pengumuman_barang_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pengumuman_barang_pengumuman_id_foreign` FOREIGN KEY (`pengumuman_id`) REFERENCES `pengumuman` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `pengumuman_barang` (`id`, `pengumuman_id`, `barang_id`, `quantity`, `created_at`, `updated_at`) VALUES
(4,	3,	12,	7,	'2017-04-13 06:33:03',	'2017-04-13 06:33:03'),
(5,	3,	13,	8,	'2017-04-13 06:33:03',	'2017-04-13 06:33:03'),
(6,	3,	14,	9,	'2017-04-13 06:33:03',	'2017-04-13 06:33:03'),
(7,	4,	13,	8,	'2017-04-13 07:06:25',	'2017-04-13 07:06:25'),
(8,	4,	16,	11,	'2017-04-13 07:06:25',	'2017-04-13 07:06:25'),
(9,	4,	18,	13,	'2017-04-13 07:06:25',	'2017-04-13 07:06:25'),
(10,	5,	10,	5,	'2017-04-13 08:32:24',	'2017-04-13 08:32:24'),
(11,	5,	14,	9,	'2017-04-13 08:32:24',	'2017-04-13 08:32:24'),
(12,	5,	16,	11,	'2017-04-13 08:32:24',	'2017-04-13 08:32:24');

DROP TABLE IF EXISTS `pengumuman_cluster`;
CREATE TABLE `pengumuman_cluster` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pengumuman_id` int(10) unsigned NOT NULL,
  `cluster_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `pengumuman_cluster_pengumuman_id_foreign` (`pengumuman_id`),
  KEY `pengumuman_cluster_cluster_id_foreign` (`cluster_id`),
  CONSTRAINT `pengumuman_cluster_cluster_id_foreign` FOREIGN KEY (`cluster_id`) REFERENCES `cluster` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pengumuman_cluster_pengumuman_id_foreign` FOREIGN KEY (`pengumuman_id`) REFERENCES `pengumuman` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `pengumuman_cluster` (`id`, `pengumuman_id`, `cluster_id`, `created_at`, `updated_at`) VALUES
(2,	3,	5,	'2017-04-13 06:33:03',	'2017-04-13 06:33:03'),
(3,	4,	2,	'2017-04-13 07:06:25',	'2017-04-13 07:06:25'),
(4,	5,	1,	'2017-04-13 08:32:24',	'2017-04-13 08:32:24');

DROP TABLE IF EXISTS `pengumuman_user`;
CREATE TABLE `pengumuman_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pengumuman_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `kode_masuk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `waktu_register` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `pengumuman_user_pengumuman_id_foreign` (`pengumuman_id`),
  KEY `pengumuman_user_user_id_foreign` (`user_id`),
  CONSTRAINT `pengumuman_user_pengumuman_id_foreign` FOREIGN KEY (`pengumuman_id`) REFERENCES `pengumuman` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pengumuman_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `pengumuman_user` (`id`, `pengumuman_id`, `user_id`, `kode_masuk`, `waktu_register`, `created_at`, `updated_at`) VALUES
(7,	3,	2,	'77da4fe3385fbc512cf2fd96453e68dd',	NULL,	'2017-04-13 06:33:06',	'2017-04-13 06:33:06'),
(8,	3,	6,	'e9181fb17816dbecad4c17ddff126dea',	NULL,	'2017-04-13 06:33:15',	'2017-04-13 06:33:15'),
(9,	3,	7,	'd97752b9735c978509d8106b8bcea3b2',	NULL,	'2017-04-13 06:33:34',	'2017-04-13 06:33:34'),
(10,	3,	10,	'7fcce16a91109fd6767197750b9b53bd',	NULL,	'2017-04-13 06:33:42',	'2017-04-13 06:33:42'),
(11,	4,	3,	'ea9c357b3ae3c4ad937ebf8e9dafb0ab',	NULL,	'2017-04-13 07:06:27',	'2017-04-13 07:06:27'),
(12,	4,	5,	'47feac00dbb273fc94d45ac8933a4a9f',	'2017-04-13 14:18:59',	'2017-04-13 07:06:41',	'2017-04-13 07:18:59'),
(13,	4,	7,	'fec35448f5b7e7a13e5806b075939381',	NULL,	'2017-04-13 07:06:51',	'2017-04-13 07:06:51'),
(14,	4,	9,	'059e1c3adfaa4c22c9720733c0e4454f',	NULL,	'2017-04-13 07:06:58',	'2017-04-13 07:06:58'),
(15,	5,	1,	'9b92df8ebc77dfcdb093ea9a453aa207',	NULL,	'2017-04-13 08:37:03',	'2017-04-13 08:37:03'),
(16,	5,	3,	'6699eb130e0835ca840daf3124236e9e',	NULL,	'2017-04-13 08:37:25',	'2017-04-13 08:37:25'),
(17,	5,	4,	'abcf52d48ec257e80a99fa9ecf84fe3c',	NULL,	'2017-04-13 08:37:36',	'2017-04-13 08:37:36'),
(18,	5,	6,	'e68a80dd399b21d65a45d736bff95b20',	NULL,	'2017-04-13 08:37:45',	'2017-04-13 08:37:45'),
(19,	5,	7,	'c940854d81671934c406b6810a8c02e3',	NULL,	'2017-04-13 08:37:55',	'2017-04-13 08:37:55');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bidang_usaha` text COLLATE utf8_unicode_ci NOT NULL,
  `session_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` enum('admin','subkontraktor','pic') COLLATE utf8_unicode_ci NOT NULL,
  `aktif` datetime DEFAULT NULL,
  `kadaluarsa` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_kode_unique` (`kode`),
  UNIQUE KEY `user_email_unique` (`email`),
  UNIQUE KEY `user_telp_unique` (`telp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `user` (`id`, `kode`, `nama`, `email`, `password`, `telp`, `bidang_usaha`, `session_id`, `role`, `aktif`, `kadaluarsa`, `created_at`, `updated_at`) VALUES
(1,	'KODE-0',	'Administrator',	'kurniawan@herobimbel.id',	'12345',	'03210987651',	'',	NULL,	'admin',	NULL,	NULL,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(2,	'KODE-1',	'Sub Kontraktor 1',	'kontraktor1@herobimbel.id',	'12345',	'032109877821',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(3,	'KODE-2',	'Sub Kontraktor 2',	'kontraktor2@herobimbel.id',	'12345',	'032109877822',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(4,	'KODE-3',	'Sub Kontraktor 3',	'kontraktor3@herobimbel.id',	'12345',	'032109877823',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(5,	'KODE-4',	'Sub Kontraktor 4',	'kontraktor4@herobimbel.id',	'12345',	'032109877824',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(6,	'KODE-5',	'Sub Kontraktor 5',	'kontraktor5@herobimbel.id',	'12345',	'032109877825',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(7,	'KODE-6',	'Sub Kontraktor 6',	'kontraktor6@herobimbel.id',	'12345',	'032109877826',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(8,	'KODE-7',	'Sub Kontraktor 7',	'kontraktor7@herobimbel.id',	'12345',	'032109877827',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(9,	'KODE-8',	'Sub Kontraktor 8',	'kontraktor8@herobimbel.id',	'12345',	'032109877828',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(10,	'KODE-9',	'Sub Kontraktor 9',	'kontraktor9@herobimbel.id',	'12345',	'032109877829',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(11,	'KODE-10',	'Sub Kontraktor 10',	'kontraktor10@herobimbel.id',	'12345',	'0321098778210',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(21,	'DEF',	'Budi Prakoso',	'budi@pal.co',	'12345',	'0812373243',	'',	'',	'pic',	NULL,	NULL,	'2017-03-27 14:27:24',	'2017-03-27 20:54:09'),
(22,	'ABC',	'Hari Kurniawan',	'hari@pal.co',	'12345',	'08712463264728',	'',	'',	'pic',	NULL,	NULL,	'2017-03-27 14:32:15',	'2017-03-27 20:53:56');

DROP TABLE IF EXISTS `user_cluster`;
CREATE TABLE `user_cluster` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `cluster_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_cluster_user_id_foreign` (`user_id`),
  KEY `user_cluster_cluster_id_foreign` (`cluster_id`),
  CONSTRAINT `user_cluster_cluster_id_foreign` FOREIGN KEY (`cluster_id`) REFERENCES `cluster` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_cluster_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `user_cluster` (`id`, `user_id`, `cluster_id`, `created_at`, `updated_at`) VALUES
(26,	10,	4,	'2017-03-22 18:34:48',	'2017-03-22 18:34:48'),
(27,	10,	5,	'2017-03-22 18:34:48',	'2017-03-22 18:34:48'),
(28,	9,	1,	'2017-03-22 18:35:28',	'2017-03-22 18:35:28'),
(29,	9,	2,	'2017-03-22 18:35:28',	'2017-03-22 18:35:28'),
(30,	9,	3,	'2017-03-22 18:35:28',	'2017-03-22 18:35:28'),
(32,	8,	3,	'2017-03-22 18:35:57',	'2017-03-22 18:35:57'),
(33,	8,	4,	'2017-03-22 18:35:57',	'2017-03-22 18:35:57'),
(34,	7,	1,	'2017-03-22 18:36:11',	'2017-03-22 18:36:11'),
(35,	7,	2,	'2017-03-22 18:36:11',	'2017-03-22 18:36:11'),
(36,	7,	5,	'2017-03-22 18:36:11',	'2017-03-22 18:36:11'),
(37,	6,	1,	'2017-03-22 18:36:24',	'2017-03-22 18:36:24'),
(38,	6,	5,	'2017-03-22 18:36:24',	'2017-03-22 18:36:24'),
(39,	5,	2,	'2017-03-22 18:36:34',	'2017-03-22 18:36:34'),
(40,	5,	3,	'2017-03-22 18:36:34',	'2017-03-22 18:36:34'),
(41,	5,	4,	'2017-03-22 18:36:34',	'2017-03-22 18:36:34'),
(42,	4,	1,	'2017-03-22 18:36:47',	'2017-03-22 18:36:47'),
(43,	4,	3,	'2017-03-22 18:36:47',	'2017-03-22 18:36:47'),
(44,	3,	1,	'2017-03-22 18:36:57',	'2017-03-22 18:36:57'),
(45,	3,	2,	'2017-03-22 18:36:57',	'2017-03-22 18:36:57'),
(46,	2,	3,	'2017-03-22 18:37:06',	'2017-03-22 18:37:06'),
(47,	2,	4,	'2017-03-22 18:37:06',	'2017-03-22 18:37:06'),
(48,	2,	5,	'2017-03-22 18:37:06',	'2017-03-22 18:37:06'),
(49,	1,	1,	'2017-03-22 18:37:18',	'2017-03-22 18:37:18'),
(50,	1,	3,	'2017-03-22 18:37:18',	'2017-03-22 18:37:18'),
(51,	1,	4,	'2017-03-22 18:37:18',	'2017-03-22 18:37:18');

-- 2017-04-15 00:58:52
