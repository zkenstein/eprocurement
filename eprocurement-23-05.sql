-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

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
(13,	4,	2,	1007400,	1,	'2017-05-16 04:27:51',	'2017-05-16 04:27:51'),
(14,	5,	4,	17030600,	0,	'2017-05-18 22:12:04',	'2017-05-18 22:15:54'),
(15,	5,	8,	5730000,	0,	'2017-05-18 22:13:52',	'2017-05-18 22:16:21'),
(16,	5,	2,	1400000,	0,	'2017-05-18 22:14:33',	'2017-05-18 22:18:06'),
(17,	5,	8,	959000,	0,	'2017-05-18 22:15:21',	'2017-05-18 22:16:21'),
(18,	5,	2,	860000,	0,	'2017-05-18 22:15:32',	'2017-05-18 22:18:06'),
(19,	5,	4,	170306,	1,	'2017-05-18 22:15:54',	'2017-05-18 22:15:54'),
(20,	5,	2,	203000,	0,	'2017-05-18 22:16:16',	'2017-05-18 22:18:06'),
(21,	5,	8,	95900,	1,	'2017-05-18 22:16:21',	'2017-05-18 22:16:21'),
(22,	5,	2,	1049000,	0,	'2017-05-18 22:17:39',	'2017-05-18 22:18:06'),
(23,	5,	2,	14000,	0,	'2017-05-18 22:17:50',	'2017-05-18 22:18:06'),
(24,	5,	2,	338024,	1,	'2017-05-18 22:18:06',	'2017-05-18 22:18:06');

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

INSERT INTO `barang_eksternal` (`id`, `kode`, `deskripsi`, `satuan`, `quantity`, `gambar`, `pdf`, `pengumuman_id`, `created_at`, `updated_at`) VALUES
(1353,	'1AV-001',	'GLOBE VALVE TYPE \"F\"',	'25A',	'30K',	'default.gif',	NULL,	4,	'2017-05-13 15:50:13',	'2017-05-13 15:50:13'),
(1354,	'7LV-006',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 10',	'M20x1.5',	'16K',	'default.gif',	NULL,	4,	'2017-05-13 15:50:13',	'2017-05-13 15:50:13'),
(1355,	'7LV-007',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 10',	'M20x1.5',	'16K',	'default.gif',	NULL,	4,	'2017-05-13 15:50:13',	'2017-05-13 15:50:13'),
(1356,	'7WV-020',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 15',	'M30x2',	'16K',	'default.gif',	NULL,	4,	'2017-05-13 15:50:13',	'2017-05-13 15:50:13'),
(1357,	'7WV-021',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 15',	'M30x2',	'16K',	'default.gif',	NULL,	4,	'2017-05-13 15:50:13',	'2017-05-13 15:50:13'),
(1358,	'7WV-068',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 15',	'M30x2',	'16K',	'default.gif',	NULL,	4,	'2017-05-13 15:50:13',	'2017-05-13 15:50:13'),
(1359,	'1AV-001',	'GLOBE VALVE TYPE \"F\"',	'25A',	'30K',	'default.gif',	NULL,	5,	'2017-05-18 20:24:02',	'2017-05-18 20:24:02'),
(1360,	'7LV-006',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 10',	'M20x1.5',	'16K',	'default.gif',	NULL,	5,	'2017-05-18 20:24:02',	'2017-05-18 20:24:02'),
(1361,	'7LV-007',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 10',	'M20x1.5',	'16K',	'default.gif',	NULL,	5,	'2017-05-18 20:24:02',	'2017-05-18 20:24:02'),
(1362,	'7WV-020',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 15',	'M30x2',	'16K',	'default.gif',	NULL,	5,	'2017-05-18 20:24:02',	'2017-05-18 20:24:02'),
(1363,	'7WV-021',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 15',	'M30x2',	'16K',	'default.gif',	NULL,	5,	'2017-05-18 20:24:02',	'2017-05-18 20:24:02'),
(1364,	'7WV-068',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 15',	'M30x2',	'16K',	'default.gif',	NULL,	5,	'2017-05-18 20:24:02',	'2017-05-18 20:24:02'),
(1365,	'1AV-001',	'GLOBE VALVE TYPE \"F\"',	'25A',	'30K',	'default.gif',	NULL,	6,	'2017-05-18 22:26:57',	'2017-05-18 22:26:57'),
(1366,	'7LV-006',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 10',	'M20x1.5',	'16K',	'default.gif',	NULL,	6,	'2017-05-18 22:26:57',	'2017-05-18 22:26:57'),
(1367,	'7LV-007',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 10',	'M20x1.5',	'16K',	'default.gif',	NULL,	6,	'2017-05-18 22:26:58',	'2017-05-18 22:26:58'),
(1368,	'7WV-020',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 15',	'M30x2',	'16K',	'default.gif',	NULL,	6,	'2017-05-18 22:26:58',	'2017-05-18 22:26:58'),
(1369,	'7WV-021',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 15',	'M30x2',	'16K',	'default.gif',	NULL,	6,	'2017-05-18 22:26:58',	'2017-05-18 22:26:58'),
(1370,	'7WV-068',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 15',	'M30x2',	'16K',	'default.gif',	NULL,	6,	'2017-05-18 22:26:58',	'2017-05-18 22:26:58'),
(1371,	'1AV-001',	'GLOBE VALVE TYPE \"F\"',	'25A',	'30K',	'default.gif',	NULL,	7,	'2017-05-19 02:06:29',	'2017-05-19 02:06:29'),
(1372,	'7LV-006',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 10',	'M20x1.5',	'16K',	'default.gif',	NULL,	7,	'2017-05-19 02:06:29',	'2017-05-19 02:06:29'),
(1373,	'7LV-007',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 10',	'M20x1.5',	'16K',	'default.gif',	NULL,	7,	'2017-05-19 02:06:29',	'2017-05-19 02:06:29'),
(1374,	'7WV-020',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 15',	'M30x2',	'16K',	'default.gif',	NULL,	7,	'2017-05-19 02:06:29',	'2017-05-19 02:06:29'),
(1375,	'7WV-021',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 15',	'M30x2',	'16K',	'default.gif',	NULL,	7,	'2017-05-19 02:06:29',	'2017-05-19 02:06:29'),
(1376,	'7WV-068',	'16K COCK VALVE \"S\" TYPE FOR OD. PIPE COOPER 15',	'M30x2',	'16K',	'default.gif',	NULL,	7,	'2017-05-19 02:06:29',	'2017-05-19 02:06:29');

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
(78,	1358,	2,	200,	1,	'2017-05-16 04:27:51',	'2017-05-16 04:27:51'),
(79,	1359,	4,	1200000,	0,	'2017-05-18 22:12:04',	'2017-05-18 22:15:53'),
(80,	1360,	4,	4560000,	0,	'2017-05-18 22:12:04',	'2017-05-18 22:15:53'),
(81,	1361,	4,	3250000,	0,	'2017-05-18 22:12:04',	'2017-05-18 22:15:54'),
(82,	1362,	4,	1234000,	0,	'2017-05-18 22:12:04',	'2017-05-18 22:15:54'),
(83,	1363,	4,	4320000,	0,	'2017-05-18 22:12:04',	'2017-05-18 22:15:54'),
(84,	1364,	4,	2466600,	0,	'2017-05-18 22:12:04',	'2017-05-18 22:15:54'),
(85,	1359,	8,	1000000,	0,	'2017-05-18 22:13:52',	'2017-05-18 22:16:20'),
(86,	1360,	8,	1300000,	0,	'2017-05-18 22:13:52',	'2017-05-18 22:16:20'),
(87,	1361,	8,	500000,	0,	'2017-05-18 22:13:52',	'2017-05-18 22:16:20'),
(88,	1362,	8,	690000,	0,	'2017-05-18 22:13:52',	'2017-05-18 22:16:21'),
(89,	1363,	8,	900000,	0,	'2017-05-18 22:13:52',	'2017-05-18 22:16:21'),
(90,	1364,	8,	1340000,	0,	'2017-05-18 22:13:52',	'2017-05-18 22:16:21'),
(91,	1359,	2,	100000,	0,	'2017-05-18 22:14:33',	'2017-05-18 22:18:05'),
(92,	1360,	2,	200000,	0,	'2017-05-18 22:14:33',	'2017-05-18 22:18:05'),
(93,	1361,	2,	300000,	0,	'2017-05-18 22:14:33',	'2017-05-18 22:18:05'),
(94,	1362,	2,	100000,	0,	'2017-05-18 22:14:33',	'2017-05-18 22:18:05'),
(95,	1363,	2,	300000,	0,	'2017-05-18 22:14:33',	'2017-05-18 22:18:05'),
(96,	1364,	2,	400000,	0,	'2017-05-18 22:14:33',	'2017-05-18 22:18:05'),
(97,	1359,	8,	100000,	0,	'2017-05-18 22:15:19',	'2017-05-18 22:16:20'),
(98,	1360,	8,	130000,	0,	'2017-05-18 22:15:19',	'2017-05-18 22:16:20'),
(99,	1361,	8,	200000,	0,	'2017-05-18 22:15:20',	'2017-05-18 22:16:20'),
(100,	1362,	8,	190000,	0,	'2017-05-18 22:15:20',	'2017-05-18 22:16:21'),
(101,	1363,	8,	205000,	0,	'2017-05-18 22:15:20',	'2017-05-18 22:16:21'),
(102,	1364,	8,	134000,	0,	'2017-05-18 22:15:20',	'2017-05-18 22:16:21'),
(103,	1359,	2,	100000,	0,	'2017-05-18 22:15:32',	'2017-05-18 22:18:05'),
(104,	1360,	2,	20000,	0,	'2017-05-18 22:15:32',	'2017-05-18 22:18:05'),
(105,	1361,	2,	30000,	0,	'2017-05-18 22:15:32',	'2017-05-18 22:18:05'),
(106,	1362,	2,	10000,	0,	'2017-05-18 22:15:32',	'2017-05-18 22:18:05'),
(107,	1363,	2,	300000,	0,	'2017-05-18 22:15:32',	'2017-05-18 22:18:05'),
(108,	1364,	2,	400000,	0,	'2017-05-18 22:15:32',	'2017-05-18 22:18:05'),
(109,	1359,	4,	12000,	1,	'2017-05-18 22:15:53',	'2017-05-18 22:15:53'),
(110,	1360,	4,	45600,	1,	'2017-05-18 22:15:54',	'2017-05-18 22:15:54'),
(111,	1361,	4,	32500,	1,	'2017-05-18 22:15:54',	'2017-05-18 22:15:54'),
(112,	1362,	4,	12340,	1,	'2017-05-18 22:15:54',	'2017-05-18 22:15:54'),
(113,	1363,	4,	43200,	1,	'2017-05-18 22:15:54',	'2017-05-18 22:15:54'),
(114,	1364,	4,	24666,	1,	'2017-05-18 22:15:54',	'2017-05-18 22:15:54'),
(115,	1359,	2,	100000,	0,	'2017-05-18 22:16:15',	'2017-05-18 22:18:05'),
(116,	1360,	2,	20000,	0,	'2017-05-18 22:16:15',	'2017-05-18 22:18:05'),
(117,	1361,	2,	30000,	0,	'2017-05-18 22:16:15',	'2017-05-18 22:18:05'),
(118,	1362,	2,	10000,	0,	'2017-05-18 22:16:16',	'2017-05-18 22:18:05'),
(119,	1363,	2,	3000,	0,	'2017-05-18 22:16:16',	'2017-05-18 22:18:05'),
(120,	1364,	2,	40000,	0,	'2017-05-18 22:16:16',	'2017-05-18 22:18:05'),
(121,	1359,	8,	10000,	1,	'2017-05-18 22:16:20',	'2017-05-18 22:16:20'),
(122,	1360,	8,	13000,	1,	'2017-05-18 22:16:20',	'2017-05-18 22:16:20'),
(123,	1361,	8,	20000,	1,	'2017-05-18 22:16:20',	'2017-05-18 22:16:20'),
(124,	1362,	8,	19000,	1,	'2017-05-18 22:16:21',	'2017-05-18 22:16:21'),
(125,	1363,	8,	20500,	1,	'2017-05-18 22:16:21',	'2017-05-18 22:16:21'),
(126,	1364,	8,	13400,	1,	'2017-05-18 22:16:21',	'2017-05-18 22:16:21'),
(127,	1359,	2,	1000000,	0,	'2017-05-18 22:17:38',	'2017-05-18 22:18:05'),
(128,	1360,	2,	2000,	0,	'2017-05-18 22:17:38',	'2017-05-18 22:18:05'),
(129,	1361,	2,	3000,	0,	'2017-05-18 22:17:38',	'2017-05-18 22:18:05'),
(130,	1362,	2,	1000,	0,	'2017-05-18 22:17:39',	'2017-05-18 22:18:05'),
(131,	1363,	2,	3000,	0,	'2017-05-18 22:17:39',	'2017-05-18 22:18:05'),
(132,	1364,	2,	40000,	0,	'2017-05-18 22:17:39',	'2017-05-18 22:18:05'),
(133,	1359,	2,	1000,	0,	'2017-05-18 22:17:49',	'2017-05-18 22:18:05'),
(134,	1360,	2,	2000,	0,	'2017-05-18 22:17:49',	'2017-05-18 22:18:05'),
(135,	1361,	2,	3000,	0,	'2017-05-18 22:17:49',	'2017-05-18 22:18:05'),
(136,	1362,	2,	1000,	0,	'2017-05-18 22:17:50',	'2017-05-18 22:18:05'),
(137,	1363,	2,	3000,	0,	'2017-05-18 22:17:50',	'2017-05-18 22:18:05'),
(138,	1364,	2,	4000,	0,	'2017-05-18 22:17:50',	'2017-05-18 22:18:05'),
(139,	1359,	2,	10002,	1,	'2017-05-18 22:18:05',	'2017-05-18 22:18:05'),
(140,	1360,	2,	20002,	1,	'2017-05-18 22:18:05',	'2017-05-18 22:18:05'),
(141,	1361,	2,	300020,	1,	'2017-05-18 22:18:05',	'2017-05-18 22:18:05'),
(142,	1362,	2,	1000,	1,	'2017-05-18 22:18:05',	'2017-05-18 22:18:05'),
(143,	1363,	2,	3000,	1,	'2017-05-18 22:18:05',	'2017-05-18 22:18:05'),
(144,	1364,	2,	4000,	1,	'2017-05-18 22:18:06',	'2017-05-18 22:18:06');

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

INSERT INTO `divisi` (`id`, `kode`, `nama`, `direktur`, `email_direktur`, `keterangan`, `created_at`, `updated_at`) VALUES
(1,	'ABC',	'Departemen Satu',	'Direktur Departemen 1',	'divisi1@pal.co.id',	'',	'2017-05-22 18:14:52',	'2017-05-22 18:14:52'),
(2,	'ABE',	'Departemen dua',	'Direktur Departemen 2',	'divisi2@pal.co.id',	'',	'2017-05-22 18:22:04',	'2017-05-22 18:22:04');



INSERT INTO `pengumuman` (`id`, `kode`, `batas_awal_waktu_penawaran`, `batas_akhir_waktu_penawaran`, `validitas_harga`, `waktu_pengiriman`, `harga_netto`, `mata_uang`, `max_register`, `count_register`, `pemenang`, `pic`, `file_excel`, `start_auction`, `durasi`, `created_at`, `updated_at`) VALUES
(4,	'ABC',	'2017-05-12 00:00:00',	'2017-05-12 00:00:01',	'2017-05-26 00:00:00',	'2017-06-10 00:00:00',	0,	'IDR',	0,	3,	8,	21,	'ABC_1494690599.csv',	'2017-05-16 10:58:00',	120,	'2017-05-13 15:49:59',	'2017-05-18 19:15:15'),
(5,	'W00029',	'2017-05-18 00:00:00',	'2017-05-19 05:04:00',	'2017-05-24 00:00:00',	'2017-06-10 00:00:00',	0,	'IDR',	0,	3,	8,	21,	'W00029_1495138951.csv',	'2017-05-19 05:17:00',	2,	'2017-05-18 20:22:31',	'2017-05-18 22:19:21'),
(6,	'POPI',	'2017-05-17 00:00:00',	'2017-05-19 05:30:00',	'2017-05-25 00:00:00',	'2017-05-31 00:00:00',	0,	'IDR',	0,	1,	NULL,	21,	'POPI_1495146416.csv',	'2017-05-26 00:00:00',	120,	'2017-05-18 22:26:56',	'2017-05-18 22:28:22'),
(7,	'ABCDE',	'2017-05-19 00:00:00',	'2017-05-24 23:00:00',	'2017-05-31 00:00:00',	'2017-06-09 18:00:00',	0,	'IDR',	0,	1,	NULL,	22,	'ABCDE_1495159586.csv',	'2017-06-01 10:00:00',	90,	'2017-05-19 02:06:26',	'2017-05-19 03:13:38');



INSERT INTO `pengumuman_cluster` (`id`, `pengumuman_id`, `cluster_id`, `created_at`, `updated_at`) VALUES
(5,	4,	4,	'2017-05-13 15:49:59',	'2017-05-13 15:49:59'),
(6,	5,	3,	'2017-05-18 20:22:31',	'2017-05-18 20:22:31'),
(7,	5,	4,	'2017-05-18 20:22:31',	'2017-05-18 20:22:31'),
(8,	6,	1,	'2017-05-18 22:26:56',	'2017-05-18 22:26:56'),
(9,	7,	1,	'2017-05-19 02:06:28',	'2017-05-19 02:06:28');

INSERT INTO `pengumuman_user` (`id`, `pengumuman_id`, `user_id`, `kode_masuk`, `waktu_register`, `total_auction`, `created_at`, `updated_at`) VALUES
(17,	4,	1,	'42307d',	NULL,	0,	'2017-05-13 15:50:15',	'2017-05-13 15:50:15'),
(18,	4,	2,	'2f5244',	'2017-05-13 22:52:28',	1007400,	'2017-05-13 15:50:15',	'2017-05-16 04:27:51'),
(19,	4,	5,	'1d3e92',	'2017-05-13 22:56:21',	307200,	'2017-05-13 15:50:15',	'2017-05-14 12:42:45'),
(20,	4,	8,	'7e6529',	'2017-05-13 22:57:03',	224500,	'2017-05-13 15:50:16',	'2017-05-16 04:07:05'),
(21,	4,	10,	'd59d89',	NULL,	0,	'2017-05-13 15:50:16',	'2017-05-13 15:50:16'),
(22,	5,	1,	'f67b5d',	NULL,	0,	'2017-05-18 20:24:02',	'2017-05-18 20:24:02'),
(23,	5,	2,	'fba89d',	'2017-05-19 03:35:08',	338024,	'2017-05-18 20:24:03',	'2017-05-18 22:18:06'),
(24,	5,	4,	'0b3ec8',	'2017-05-19 03:36:46',	170306,	'2017-05-18 20:24:03',	'2017-05-18 22:15:54'),
(25,	5,	5,	'4f2706',	NULL,	0,	'2017-05-18 20:24:03',	'2017-05-18 20:24:03'),
(26,	5,	8,	'6dbb0d',	'2017-05-19 03:38:35',	95900,	'2017-05-18 20:24:03',	'2017-05-18 22:16:21'),
(27,	5,	9,	'196549',	NULL,	0,	'2017-05-18 20:24:03',	'2017-05-18 20:24:03'),
(28,	5,	10,	'536f99',	NULL,	0,	'2017-05-18 20:24:03',	'2017-05-18 20:24:03'),
(29,	6,	1,	'aa3069',	NULL,	0,	'2017-05-18 22:26:59',	'2017-05-18 22:26:59'),
(30,	6,	3,	'9cfa19',	'2017-05-19 05:28:21',	0,	'2017-05-18 22:27:01',	'2017-05-18 22:28:21'),
(31,	6,	4,	'e95153',	NULL,	0,	'2017-05-18 22:27:01',	'2017-05-18 22:27:01'),
(32,	6,	6,	'e28093',	NULL,	0,	'2017-05-18 22:27:01',	'2017-05-18 22:27:01'),
(33,	6,	7,	'2c8f05',	NULL,	0,	'2017-05-18 22:27:01',	'2017-05-18 22:27:01'),
(34,	6,	9,	'b9ea46',	NULL,	0,	'2017-05-18 22:27:02',	'2017-05-18 22:27:02'),
(35,	7,	1,	'280d77',	NULL,	0,	'2017-05-19 02:06:32',	'2017-05-19 02:06:32'),
(36,	7,	3,	'c8edb7',	'2017-05-19 10:13:38',	0,	'2017-05-19 02:06:33',	'2017-05-19 03:13:38'),
(37,	7,	4,	'd3cb68',	NULL,	0,	'2017-05-19 02:06:34',	'2017-05-19 02:06:34'),
(38,	7,	6,	'78cd69',	NULL,	0,	'2017-05-19 02:06:34',	'2017-05-19 02:06:34'),
(39,	7,	7,	'fdb98c',	NULL,	0,	'2017-05-19 02:06:34',	'2017-05-19 02:06:34'),
(40,	7,	9,	'97a82f',	NULL,	0,	'2017-05-19 02:06:34',	'2017-05-19 02:06:34');

INSERT INTO `user` (`id`, `kode`, `nama`, `email`, `password`, `telp`, `bidang_usaha`, `session_id`, `role`, `aktif`, `kadaluarsa`, `cluster`, `divisi_id`, `created_at`, `updated_at`) VALUES
(1,	'KODE-0',	'Administrator',	'kurniawan@herobimbel.id',	'12345',	'03210987651',	'',	NULL,	'admin',	NULL,	NULL,	NULL,	0,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(2,	'KODE-1',	'Sub Kontraktor 1',	'kontraktor1@herobimbel.id',	'12345',	'032109877821',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	NULL,	0,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(3,	'KODE-2',	'Sub Kontraktor 2',	'kontraktor2@herobimbel.id',	'12345',	'032109877822',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	NULL,	0,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(4,	'KODE-3',	'Sub Kontraktor 3',	'kontraktor3@herobimbel.id',	'12345',	'032109877823',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	NULL,	0,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(5,	'KODE-4',	'Sub Kontraktor 4',	'kontraktor4@herobimbel.id',	'12345',	'032109877824',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	NULL,	0,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(6,	'KODE-5',	'Sub Kontraktor 5',	'kontraktor5@herobimbel.id',	'12345',	'032109877825',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	NULL,	0,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(7,	'KODE-6',	'Sub Kontraktor 6',	'kontraktor6@herobimbel.id',	'12345',	'032109877826',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	NULL,	0,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(8,	'KODE-7',	'Sub Kontraktor 7',	'kontraktor7@herobimbel.id',	'12345',	'032109877827',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	NULL,	0,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(9,	'KODE-8',	'Sub Kontraktor 8',	'kontraktor8@herobimbel.id',	'12345',	'032109877828',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	NULL,	0,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(10,	'KODE-9',	'Sub Kontraktor 9',	'kontraktor9@herobimbel.id',	'12345',	'032109877829',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	NULL,	0,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(11,	'KODE-10',	'Sub Kontraktor 10',	'kontraktor10@herobimbel.id',	'12345',	'0321098778210',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	NULL,	0,	'2017-04-13 04:27:09',	'2017-04-13 04:27:09'),
(21,	'DEF',	'Budi Prakoso',	'budi@pal.co',	'12345',	'0812373243',	'',	'',	'pic',	NULL,	NULL,	1,	1,	'2017-03-27 14:27:24',	'2017-03-27 20:54:09'),
(22,	'ABC',	'Hari Kurniawan',	'hari@pal.co',	'12345',	'08712463264728',	'',	'',	'pic',	NULL,	NULL,	2,	2,	'2017-03-27 14:32:15',	'2017-05-23 01:17:15'),
(23,	'KODE-11',	'Sub Kontraktor 11',	'kontraktor11@herobimbel.id',	'12345',	'0321098778211',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	NULL,	0,	'2017-05-11 15:35:07',	'2017-05-11 15:35:07'),
(24,	'KODE-12',	'Sub Kontraktor 12',	'kontraktor12@herobimbel.id',	'12345',	'0321098778212',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	NULL,	0,	'2017-05-11 15:35:07',	'2017-05-11 15:35:07'),
(25,	'KODE-13',	'Sub Kontraktor 13',	'kontraktor13@herobimbel.id',	'12345',	'0321098778213',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	NULL,	0,	'2017-05-11 15:35:07',	'2017-05-11 15:35:07'),
(26,	'KODE-14',	'Sub Kontraktor 14',	'kontraktor14@herobimbel.id',	'12345',	'0321098778214',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	NULL,	0,	'2017-05-11 15:35:07',	'2017-05-11 15:35:07'),
(27,	'KODE-15',	'Sub Kontraktor 15',	'kontraktor15@herobimbel.id',	'12345',	'0321098778215',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	NULL,	0,	'2017-05-11 15:35:07',	'2017-05-11 15:35:07'),
(28,	'KODE-16',	'Sub Kontraktor 16',	'kontraktor16@herobimbel.id',	'12345',	'0321098778216',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	NULL,	0,	'2017-05-11 15:35:07',	'2017-05-11 15:35:07'),
(29,	'KODE-17',	'Sub Kontraktor 17',	'kontraktor17@herobimbel.id',	'12345',	'0321098778217',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	NULL,	0,	'2017-05-11 15:35:07',	'2017-05-11 15:35:07'),
(30,	'KODE-18',	'Sub Kontraktor 18',	'kontraktor18@herobimbel.id',	'12345',	'0321098778218',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	NULL,	0,	'2017-05-11 15:35:07',	'2017-05-11 15:35:07'),
(31,	'KODE-19',	'Sub Kontraktor 19',	'kontraktor19@herobimbel.id',	'12345',	'0321098778219',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod',	NULL,	'subkontraktor',	NULL,	NULL,	NULL,	0,	'2017-05-11 15:35:07',	'2017-05-11 15:59:58');

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

-- 2017-05-23 01:19:52
