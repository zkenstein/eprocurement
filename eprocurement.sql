-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `auction`;
CREATE TABLE `auction` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pengumuman_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `total` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `auction_pengumuman_id_foreign` (`pengumuman_id`),
  KEY `auction_user_id_foreign` (`user_id`),
  CONSTRAINT `auction_pengumuman_id_foreign` FOREIGN KEY (`pengumuman_id`) REFERENCES `pengumuman` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auction_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `auction` (`id`, `pengumuman_id`, `user_id`, `total`, `status`, `created_at`, `updated_at`) VALUES
(1,	4,	2,	1401000,	0,	'2017-05-14 10:17:08',	'2017-05-16 04:27:51'),
(2,	4,	5,	10200,	0,	'2017-05-14 12:41:13',	'2017-05-14 12:42:45'),
(3,	4,	5,	307200,	1,	'2017-05-14 12:42:45',	'2017-05-14 12:42:45'),
(4,	4,	8,	4700,	0,	'2017-05-16 04:04:39',	'2017-05-16 04:07:05'),
(5,	4,	8,	26500,	0,	'2017-05-16 04:06:08',	'2017-05-16 04:07:05'),
(6,	4,	8,	220004500,	0,	'2017-05-16 04:06:14',	'2017-05-16 04:07:05'),
(7,	4,	8,	224500,	1,	'2017-05-16 04:07:05',	'2017-05-16 04:07:05'),
(8,	4,	2,	7440,	0,	'2017-05-16 04:23:14',	'2017-05-16 04:27:51'),
(9,	4,	2,	4007400,	0,	'2017-05-16 04:23:37',	'2017-05-16 04:27:51'),
(10,	4,	2,	7410,	0,	'2017-05-16 04:23:48',	'2017-05-16 04:27:51'),
(11,	4,	2,	100007400,	0,	'2017-05-16 04:27:29',	'2017-05-16 04:27:51'),
(12,	4,	2,	107400,	0,	'2017-05-16 04:27:38',	'2017-05-16 04:27:51'),
(13,	4,	2,	1007400,	1,	'2017-05-16 04:27:51',	'2017-05-16 04:27:51');

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
  `deskripsi` text COLLATE utf8_unicode_ci NOT NULL,
  `satuan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'default.gif',
  `pdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pengumuman_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `barang_eksternal_pengumuman_id_foreign` (`pengumuman_id`),
  CONSTRAINT `barang_eksternal_pengumuman_id_foreign` FOREIGN KEY (`pengumuman_id`) REFERENCES `pengumuman` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `barang_eksternal` (`id`, `kode`, `deskripsi`, `satuan`, `quantity`, `gambar`, `pdf`, `pengumuman_id`, `created_at`, `updated_at`) VALUES
(1353,	'1AV-001',	'GLOBE VALVE TYPE \"F\"',	'25A',	'30K',	'default.gif',	NULL,	4,	'2017-05-13 15:50:13',	'2017-05-13 15:50:13'),
(1354,	'7LV-006',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 10',	'M20x1.5',	'16K',	'default.gif',	NULL,	4,	'2017-05-13 15:50:13',	'2017-05-13 15:50:13'),
(1355,	'7LV-007',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 10',	'M20x1.5',	'16K',	'default.gif',	NULL,	4,	'2017-05-13 15:50:13',	'2017-05-13 15:50:13'),
(1356,	'7WV-020',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 15',	'M30x2',	'16K',	'default.gif',	NULL,	4,	'2017-05-13 15:50:13',	'2017-05-13 15:50:13'),
(1357,	'7WV-021',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 15',	'M30x2',	'16K',	'default.gif',	NULL,	4,	'2017-05-13 15:50:13',	'2017-05-13 15:50:13'),
(1358,	'7WV-068',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 15',	'M30x2',	'16K',	'default.gif',	NULL,	4,	'2017-05-13 15:50:13',	'2017-05-13 15:50:13');

DROP TABLE IF EXISTS `barang_eksternal_user`;
CREATE TABLE `barang_eksternal_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `barang_eksternal_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `harga` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `barang_eksternal_user_barang_eksternal_id_foreign` (`barang_eksternal_id`),
  KEY `barang_eksternal_user_user_id_foreign` (`user_id`),
  CONSTRAINT `barang_eksternal_user_barang_eksternal_id_foreign` FOREIGN KEY (`barang_eksternal_id`) REFERENCES `barang_eksternal` (`id`) ON DELETE CASCADE,
  CONSTRAINT `barang_eksternal_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `barang_eksternal_user` (`id`, `barang_eksternal_id`, `user_id`, `harga`, `status`, `created_at`, `updated_at`) VALUES
(1,	1353,	2,	1000,	0,	'2017-05-14 10:17:07',	'2017-05-16 04:27:49'),
(2,	1354,	2,	200000,	0,	'2017-05-14 10:17:07',	'2017-05-16 04:27:50'),
(3,	1355,	2,	400000,	0,	'2017-05-14 10:17:07',	'2017-05-16 04:27:50'),
(4,	1356,	2,	200000,	0,	'2017-05-14 10:17:07',	'2017-05-16 04:27:50'),
(5,	1357,	2,	400000,	0,	'2017-05-14 10:17:07',	'2017-05-16 04:27:51'),
(6,	1358,	2,	200000,	0,	'2017-05-14 10:17:07',	'2017-05-16 04:27:51'),
(7,	1353,	5,	1000,	0,	'2017-05-14 12:41:12',	'2017-05-14 12:42:44'),
(8,	1354,	5,	2000,	0,	'2017-05-14 12:41:12',	'2017-05-14 12:42:44'),
(9,	1355,	5,	3000,	0,	'2017-05-14 12:41:12',	'2017-05-14 12:42:44'),
(10,	1356,	5,	1000,	0,	'2017-05-14 12:41:13',	'2017-05-14 12:42:44'),
(11,	1357,	5,	200,	0,	'2017-05-14 12:41:13',	'2017-05-14 12:42:45'),
(12,	1358,	5,	3000,	0,	'2017-05-14 12:41:13',	'2017-05-14 12:42:45'),
(13,	1353,	5,	1000,	1,	'2017-05-14 12:42:44',	'2017-05-14 12:42:44'),
(14,	1354,	5,	2000,	1,	'2017-05-14 12:42:44',	'2017-05-14 12:42:44'),
(15,	1355,	5,	300000,	1,	'2017-05-14 12:42:44',	'2017-05-14 12:42:44'),
(16,	1356,	5,	1000,	1,	'2017-05-14 12:42:45',	'2017-05-14 12:42:45'),
(17,	1357,	5,	200,	1,	'2017-05-14 12:42:45',	'2017-05-14 12:42:45'),
(18,	1358,	5,	3000,	1,	'2017-05-14 12:42:45',	'2017-05-14 12:42:45'),
(19,	1353,	8,	1000,	0,	'2017-05-16 04:04:38',	'2017-05-16 04:07:03'),
(20,	1354,	8,	200,	0,	'2017-05-16 04:04:38',	'2017-05-16 04:07:03'),
(21,	1355,	8,	300,	0,	'2017-05-16 04:04:38',	'2017-05-16 04:07:04'),
(22,	1356,	8,	200,	0,	'2017-05-16 04:04:38',	'2017-05-16 04:07:04'),
(23,	1357,	8,	1000,	0,	'2017-05-16 04:04:38',	'2017-05-16 04:07:04'),
(24,	1358,	8,	2000,	0,	'2017-05-16 04:04:38',	'2017-05-16 04:07:05'),
(25,	1353,	8,	1000,	0,	'2017-05-16 04:06:06',	'2017-05-16 04:07:03'),
(26,	1354,	8,	200,	0,	'2017-05-16 04:06:06',	'2017-05-16 04:07:03'),
(27,	1355,	8,	300,	0,	'2017-05-16 04:06:07',	'2017-05-16 04:07:04'),
(28,	1356,	8,	22000,	0,	'2017-05-16 04:06:07',	'2017-05-16 04:07:04'),
(29,	1357,	8,	1000,	0,	'2017-05-16 04:06:07',	'2017-05-16 04:07:04'),
(30,	1358,	8,	2000,	0,	'2017-05-16 04:06:07',	'2017-05-16 04:07:05'),
(31,	1353,	8,	1000,	0,	'2017-05-16 04:06:12',	'2017-05-16 04:07:03'),
(32,	1354,	8,	200,	0,	'2017-05-16 04:06:12',	'2017-05-16 04:07:03'),
(33,	1355,	8,	300,	0,	'2017-05-16 04:06:13',	'2017-05-16 04:07:04'),
(34,	1356,	8,	220000000,	0,	'2017-05-16 04:06:13',	'2017-05-16 04:07:04'),
(35,	1357,	8,	1000,	0,	'2017-05-16 04:06:13',	'2017-05-16 04:07:04'),
(36,	1358,	8,	2000,	0,	'2017-05-16 04:06:13',	'2017-05-16 04:07:05'),
(37,	1353,	8,	1000,	1,	'2017-05-16 04:07:03',	'2017-05-16 04:07:03'),
(38,	1354,	8,	200,	1,	'2017-05-16 04:07:04',	'2017-05-16 04:07:04'),
(39,	1355,	8,	300,	1,	'2017-05-16 04:07:04',	'2017-05-16 04:07:04'),
(40,	1356,	8,	220000,	1,	'2017-05-16 04:07:04',	'2017-05-16 04:07:04'),
(41,	1357,	8,	1000,	1,	'2017-05-16 04:07:04',	'2017-05-16 04:07:04'),
(42,	1358,	8,	2000,	1,	'2017-05-16 04:07:05',	'2017-05-16 04:07:05'),
(43,	1353,	2,	1000,	0,	'2017-05-16 04:23:12',	'2017-05-16 04:27:49'),
(44,	1354,	2,	2000,	0,	'2017-05-16 04:23:13',	'2017-05-16 04:27:50'),
(45,	1355,	2,	4000,	0,	'2017-05-16 04:23:13',	'2017-05-16 04:27:50'),
(46,	1356,	2,	200,	0,	'2017-05-16 04:23:13',	'2017-05-16 04:27:50'),
(47,	1357,	2,	40,	0,	'2017-05-16 04:23:14',	'2017-05-16 04:27:51'),
(48,	1358,	2,	200,	0,	'2017-05-16 04:23:14',	'2017-05-16 04:27:51'),
(49,	1353,	2,	1000,	0,	'2017-05-16 04:23:35',	'2017-05-16 04:27:49'),
(50,	1354,	2,	2000,	0,	'2017-05-16 04:23:35',	'2017-05-16 04:27:50'),
(51,	1355,	2,	4000,	0,	'2017-05-16 04:23:36',	'2017-05-16 04:27:50'),
(52,	1356,	2,	200,	0,	'2017-05-16 04:23:36',	'2017-05-16 04:27:50'),
(53,	1357,	2,	4000000,	0,	'2017-05-16 04:23:36',	'2017-05-16 04:27:51'),
(54,	1358,	2,	200,	0,	'2017-05-16 04:23:36',	'2017-05-16 04:27:51'),
(55,	1353,	2,	1000,	0,	'2017-05-16 04:23:46',	'2017-05-16 04:27:49'),
(56,	1354,	2,	2000,	0,	'2017-05-16 04:23:46',	'2017-05-16 04:27:50'),
(57,	1355,	2,	4000,	0,	'2017-05-16 04:23:46',	'2017-05-16 04:27:50'),
(58,	1356,	2,	200,	0,	'2017-05-16 04:23:47',	'2017-05-16 04:27:50'),
(59,	1357,	2,	10,	0,	'2017-05-16 04:23:47',	'2017-05-16 04:27:51'),
(60,	1358,	2,	200,	0,	'2017-05-16 04:23:47',	'2017-05-16 04:27:51'),
(61,	1353,	2,	1000,	0,	'2017-05-16 04:27:27',	'2017-05-16 04:27:49'),
(62,	1354,	2,	2000,	0,	'2017-05-16 04:27:27',	'2017-05-16 04:27:50'),
(63,	1355,	2,	4000,	0,	'2017-05-16 04:27:28',	'2017-05-16 04:27:50'),
(64,	1356,	2,	200,	0,	'2017-05-16 04:27:28',	'2017-05-16 04:27:50'),
(65,	1357,	2,	100000000,	0,	'2017-05-16 04:27:28',	'2017-05-16 04:27:51'),
(66,	1358,	2,	200,	0,	'2017-05-16 04:27:28',	'2017-05-16 04:27:51'),
(67,	1353,	2,	1000,	0,	'2017-05-16 04:27:37',	'2017-05-16 04:27:49'),
(68,	1354,	2,	2000,	0,	'2017-05-16 04:27:37',	'2017-05-16 04:27:50'),
(69,	1355,	2,	4000,	0,	'2017-05-16 04:27:37',	'2017-05-16 04:27:50'),
(70,	1356,	2,	200,	0,	'2017-05-16 04:27:37',	'2017-05-16 04:27:50'),
(71,	1357,	2,	100000,	0,	'2017-05-16 04:27:38',	'2017-05-16 04:27:51'),
(72,	1358,	2,	200,	0,	'2017-05-16 04:27:38',	'2017-05-16 04:27:51'),
(73,	1353,	2,	1000,	1,	'2017-05-16 04:27:49',	'2017-05-16 04:27:49'),
(74,	1354,	2,	2000,	1,	'2017-05-16 04:27:50',	'2017-05-16 04:27:50'),
(75,	1355,	2,	4000,	1,	'2017-05-16 04:27:50',	'2017-05-16 04:27:50'),
(76,	1356,	2,	200,	1,	'2017-05-16 04:27:50',	'2017-05-16 04:27:50'),
(77,	1357,	2,	1000000,	1,	'2017-05-16 04:27:51',	'2017-05-16 04:27:51'),
(78,	1358,	2,	200,	1,	'2017-05-16 04:27:51',	'2017-05-16 04:27:51');

DROP TABLE IF EXISTS `cluster`;
CREATE TABLE `cluster` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cluster_kode_unique` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `cluster` (`id`, `kode`, `nama`, `jenis`, `created_at`, `updated_at`) VALUES
(1,	'1',	'PIPING, VALVE AND PROPULSI',	'barang',	'2017-04-13 04:27:05',	'2017-04-13 04:27:05'),
(2,	'2',	'BOTTOM CLEANING DAN REPLATING',	'barang',	'2017-04-13 04:27:05',	'2017-04-13 04:27:05'),
(3,	'3',	'ELECTRIKAL DAN MECANICAL',	'barang',	'2017-04-13 04:27:05',	'2017-04-13 04:27:05'),
(4,	'4',	'DT AND NDT',	'barang',	'2017-04-13 04:27:05',	'2017-04-13 04:27:05'),
(5,	'5',	'GENERAL SERVICE',	'barang',	'2017-04-13 04:27:05',	'2017-05-11 16:09:44'),
(6,	'6',	'PIPING, VALVE AND PROPULSI',	'jasa',	'2017-04-12 21:27:05',	'2017-04-12 21:27:05'),
(7,	'7',	'BOTTOM CLEANING DAN REPLATING',	'jasa',	'2017-04-12 21:27:05',	'2017-04-12 21:27:05'),
(8,	'8',	'ELECTRIKAL DAN MECANICAL',	'jasa',	'2017-04-12 21:27:05',	'2017-04-12 21:27:05'),
(9,	'9',	'DT AND NDT',	'jasa',	'2017-04-12 21:27:05',	'2017-05-11 16:18:39'),
(10,	'10',	'GENERAL SERVICE',	'jasa',	'2017-04-12 21:27:05',	'2017-04-12 21:27:05');

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
(4830,	'default',	'{\"job\":\"mailer@handleQueuedMessage\",\"data\":{\"view\":\"mail_undangan\",\"data\":{\"nama_perusahaan\":\"Sub Kontraktor 17\",\"pengumuman\":\"::entity::|App\\\\Pengumuman|2\",\"kode_registrasi\":\"724704088f40cdb2e6427759e7bdf3fb\"},\"callback\":\"C:32:\\\"SuperClosure\\\\SerializableClosure\\\":2135:{a:5:{s:4:\\\"code\\\";s:260:\\\"function ($message) use($user, $file) {\\n    $message->to($user->email, $user->nama)->subject(\\\"PAL Tender Invitation\\\");\\n    $message->from(env(\'MAIL_USERNAME\'), \\\"PT.PAL\\\");\\n    if ($file != null) {\\n        $message->attach(storage_path(\'app\\/\' . $file));\\n    }\\n};\\\";s:7:\\\"context\\\";a:2:{s:4:\\\"user\\\";O:8:\\\"App\\\\User\\\":23:{s:8:\\\"\\u0000*\\u0000table\\\";s:4:\\\"user\\\";s:11:\\\"\\u0000*\\u0000fillable\\\";a:10:{i:0;s:4:\\\"kode\\\";i:1;s:4:\\\"nama\\\";i:2;s:5:\\\"email\\\";i:3;s:8:\\\"password\\\";i:4;s:4:\\\"telp\\\";i:5;s:12:\\\"bidang_usaha\\\";i:6;s:5:\\\"aktif\\\";i:7;s:10:\\\"kadaluarsa\\\";i:8;s:10:\\\"session_id\\\";i:9;s:4:\\\"role\\\";}s:9:\\\"\\u0000*\\u0000hidden\\\";a:1:{i:0;s:8:\\\"password\\\";}s:13:\\\"\\u0000*\\u0000connection\\\";N;s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:12:\\\"incrementing\\\";b:1;s:10:\\\"timestamps\\\";b:1;s:13:\\\"\\u0000*\\u0000attributes\\\";a:13:{s:2:\\\"id\\\";i:29;s:4:\\\"kode\\\";s:7:\\\"KODE-17\\\";s:4:\\\"nama\\\";s:17:\\\"Sub Kontraktor 17\\\";s:5:\\\"email\\\";s:26:\\\"kontraktor17@herobimbel.id\\\";s:8:\\\"password\\\";s:5:\\\"12345\\\";s:4:\\\"telp\\\";s:13:\\\"0321098778217\\\";s:12:\\\"bidang_usaha\\\";s:72:\\\"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\\\";s:10:\\\"session_id\\\";N;s:4:\\\"role\\\";s:13:\\\"subkontraktor\\\";s:5:\\\"aktif\\\";N;s:10:\\\"kadaluarsa\\\";N;s:10:\\\"created_at\\\";s:19:\\\"2017-05-11 22:35:07\\\";s:10:\\\"updated_at\\\";s:19:\\\"2017-05-11 22:35:07\\\";}s:11:\\\"\\u0000*\\u0000original\\\";a:13:{s:2:\\\"id\\\";i:29;s:4:\\\"kode\\\";s:7:\\\"KODE-17\\\";s:4:\\\"nama\\\";s:17:\\\"Sub Kontraktor 17\\\";s:5:\\\"email\\\";s:26:\\\"kontraktor17@herobimbel.id\\\";s:8:\\\"password\\\";s:5:\\\"12345\\\";s:4:\\\"telp\\\";s:13:\\\"0321098778217\\\";s:12:\\\"bidang_usaha\\\";s:72:\\\"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\\\";s:10:\\\"session_id\\\";N;s:4:\\\"role\\\";s:13:\\\"subkontraktor\\\";s:5:\\\"aktif\\\";N;s:10:\\\"kadaluarsa\\\";N;s:10:\\\"created_at\\\";s:19:\\\"2017-05-11 22:35:07\\\";s:10:\\\"updated_at\\\";s:19:\\\"2017-05-11 22:35:07\\\";}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:1:\\\"*\\\";}s:8:\\\"\\u0000*\\u0000dates\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:8:\\\"\\u0000*\\u0000casts\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:13:\\\"\\u0000*\\u0000morphClass\\\";N;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:0;}s:4:\\\"file\\\";s:18:\\\"ABC_1494521980.csv\\\";}s:7:\\\"binding\\\";N;s:5:\\\"scope\\\";s:29:\\\"App\\\\Jobs\\\\InsertPengumumanUser\\\";s:8:\\\"isStatic\\\";b:0;}}\"}}',	255,	0,	NULL,	1495109480,	1495109480);

DROP TABLE IF EXISTS `pengumuman`;
CREATE TABLE `pengumuman` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batas_awal_waktu_penawaran` datetime NOT NULL,
  `batas_akhir_waktu_penawaran` datetime NOT NULL,
  `validitas_harga` datetime NOT NULL,
  `waktu_pengiriman` datetime NOT NULL,
  `harga_netto` double NOT NULL DEFAULT '0',
  `mata_uang` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '-',
  `max_register` int(11) NOT NULL,
  `count_register` int(11) NOT NULL DEFAULT '0',
  `pemenang` int(10) unsigned DEFAULT NULL,
  `pic` int(10) unsigned NOT NULL,
  `file_excel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_auction` datetime NOT NULL,
  `durasi` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pengumuman_kode_unique` (`kode`),
  KEY `pengumuman_pemenang_foreign` (`pemenang`),
  KEY `pengumuman_pic_foreign` (`pic`),
  CONSTRAINT `pengumuman_pemenang_foreign` FOREIGN KEY (`pemenang`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pengumuman_pic_foreign` FOREIGN KEY (`pic`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `pengumuman` (`id`, `kode`, `batas_awal_waktu_penawaran`, `batas_akhir_waktu_penawaran`, `validitas_harga`, `waktu_pengiriman`, `harga_netto`, `mata_uang`, `max_register`, `count_register`, `pemenang`, `pic`, `file_excel`, `start_auction`, `durasi`, `created_at`, `updated_at`) VALUES
(4,	'ABC',	'2017-05-12 00:00:00',	'2017-05-12 00:00:01',	'2017-05-26 00:00:00',	'2017-06-10 00:00:00',	0,	'-',	0,	3,	8,	21,	'ABC_1494690599.csv',	'2017-05-16 10:58:00',	120,	'2017-05-13 15:49:59',	'2017-05-18 03:06:08');

DROP TABLE IF EXISTS `pengumuman_barang`;
CREATE TABLE `pengumuman_barang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pengumuman_id` int(10) unsigned NOT NULL,
  `barang_id` int(10) unsigned NOT NULL,
  `quantity` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `pengumuman_barang_pengumuman_id_foreign` (`pengumuman_id`),
  KEY `pengumuman_barang_barang_id_foreign` (`barang_id`),
  CONSTRAINT `pengumuman_barang_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pengumuman_barang_pengumuman_id_foreign` FOREIGN KEY (`pengumuman_id`) REFERENCES `pengumuman` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `pengumuman_barang_user`;
CREATE TABLE `pengumuman_barang_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pengumuman_barang_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `harga` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `pengumuman_barang_user_pengumuman_barang_id_foreign` (`pengumuman_barang_id`),
  KEY `pengumuman_barang_user_user_id_foreign` (`user_id`),
  CONSTRAINT `pengumuman_barang_user_pengumuman_barang_id_foreign` FOREIGN KEY (`pengumuman_barang_id`) REFERENCES `pengumuman_barang` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pengumuman_barang_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


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
(5,	4,	4,	'2017-05-13 15:49:59',	'2017-05-13 15:49:59');

DROP TABLE IF EXISTS `pengumuman_user`;
CREATE TABLE `pengumuman_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pengumuman_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `kode_masuk` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `waktu_register` datetime DEFAULT NULL,
  `total_auction` double DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `pengumuman_user_pengumuman_id_foreign` (`pengumuman_id`),
  KEY `pengumuman_user_user_id_foreign` (`user_id`),
  CONSTRAINT `pengumuman_user_pengumuman_id_foreign` FOREIGN KEY (`pengumuman_id`) REFERENCES `pengumuman` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pengumuman_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `pengumuman_user` (`id`, `pengumuman_id`, `user_id`, `kode_masuk`, `waktu_register`, `total_auction`, `created_at`, `updated_at`) VALUES
(17,	4,	1,	'42307d',	NULL,	0,	'2017-05-13 15:50:15',	'2017-05-13 15:50:15'),
(18,	4,	2,	'2f5244',	'2017-05-13 22:52:28',	1007400,	'2017-05-13 15:50:15',	'2017-05-16 04:27:51'),
(19,	4,	5,	'1d3e92',	'2017-05-13 22:56:21',	307200,	'2017-05-13 15:50:15',	'2017-05-14 12:42:45'),
(20,	4,	8,	'7e6529',	'2017-05-13 22:57:03',	224500,	'2017-05-13 15:50:16',	'2017-05-16 04:07:05'),
(21,	4,	10,	'd59d89',	NULL,	0,	'2017-05-13 15:50:16',	'2017-05-13 15:50:16');

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
(22,	'ABC',	'Hari Kurniawan',	'hari@pal.co',	'12345',	'08712463264728',	'',	'',	'pic',	NULL,	NULL,	'2017-03-27 14:32:15',	'2017-03-27 20:53:56'),
(23,	'KODE-11',	'Sub Kontraktor 11',	'kontraktor11@herobimbel.id',	'12345',	'0321098778211',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	'2017-05-11 15:35:07',	'2017-05-11 15:35:07'),
(24,	'KODE-12',	'Sub Kontraktor 12',	'kontraktor12@herobimbel.id',	'12345',	'0321098778212',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	'2017-05-11 15:35:07',	'2017-05-11 15:35:07'),
(25,	'KODE-13',	'Sub Kontraktor 13',	'kontraktor13@herobimbel.id',	'12345',	'0321098778213',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	'2017-05-11 15:35:07',	'2017-05-11 15:35:07'),
(26,	'KODE-14',	'Sub Kontraktor 14',	'kontraktor14@herobimbel.id',	'12345',	'0321098778214',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	'2017-05-11 15:35:07',	'2017-05-11 15:35:07'),
(27,	'KODE-15',	'Sub Kontraktor 15',	'kontraktor15@herobimbel.id',	'12345',	'0321098778215',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	'2017-05-11 15:35:07',	'2017-05-11 15:35:07'),
(28,	'KODE-16',	'Sub Kontraktor 16',	'kontraktor16@herobimbel.id',	'12345',	'0321098778216',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	'2017-05-11 15:35:07',	'2017-05-11 15:35:07'),
(29,	'KODE-17',	'Sub Kontraktor 17',	'kontraktor17@herobimbel.id',	'12345',	'0321098778217',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	'2017-05-11 15:35:07',	'2017-05-11 15:35:07'),
(30,	'KODE-18',	'Sub Kontraktor 18',	'kontraktor18@herobimbel.id',	'12345',	'0321098778218',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	'2017-05-11 15:35:07',	'2017-05-11 15:35:07'),
(31,	'KODE-19',	'Sub Kontraktor 19',	'kontraktor19@herobimbel.id',	'12345',	'0321098778219',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	'2017-05-11 15:35:07',	'2017-05-11 15:59:58');

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
(51,	1,	4,	'2017-03-22 18:37:18',	'2017-03-22 18:37:18'),
(52,	23,	6,	'2017-05-11 15:38:04',	'2017-05-11 15:38:04'),
(53,	23,	7,	'2017-05-11 15:41:14',	'2017-05-11 15:41:14'),
(54,	24,	6,	'2017-05-11 15:41:14',	'2017-05-11 15:41:14'),
(55,	24,	9,	'2017-05-11 15:41:14',	'2017-05-11 15:41:14'),
(56,	24,	10,	'2017-05-11 15:41:14',	'2017-05-11 15:41:14'),
(57,	24,	9,	'2017-05-11 15:41:14',	'2017-05-11 15:41:14'),
(58,	25,	8,	'2017-05-11 15:41:14',	'2017-05-11 15:41:14'),
(59,	25,	7,	'2017-05-11 15:41:14',	'2017-05-11 15:41:14'),
(60,	25,	6,	'2017-05-11 15:41:14',	'2017-05-11 15:41:14'),
(61,	26,	7,	'2017-05-11 15:41:14',	'2017-05-11 15:41:14'),
(62,	26,	9,	'2017-05-11 15:41:14',	'2017-05-11 15:41:14'),
(63,	27,	10,	'2017-05-11 15:41:14',	'2017-05-11 15:41:14'),
(64,	27,	6,	'2017-05-11 15:41:14',	'2017-05-11 15:41:14'),
(65,	28,	9,	'2017-05-11 15:41:14',	'2017-05-11 15:41:14'),
(66,	29,	10,	'2017-05-11 15:41:14',	'2017-05-11 15:41:14'),
(67,	30,	7,	'2017-05-11 15:41:14',	'2017-05-11 15:41:14'),
(70,	30,	8,	'2017-05-11 15:41:14',	'2017-05-11 15:41:14'),
(75,	31,	8,	'2017-05-11 15:59:58',	'2017-05-11 15:59:58'),
(76,	31,	9,	'2017-05-11 15:59:58',	'2017-05-11 15:59:58');

-- 2017-05-18 12:11:30
