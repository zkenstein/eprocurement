-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

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

INSERT INTO `cluster` (`id`, `kode`, `nama`, `created_at`, `updated_at`) VALUES
(1,	'1',	'PIPING, VALVE AND PROPULSI',	'2017-04-13 04:27:05',	'2017-04-13 04:27:05'),
(2,	'2',	'BOTTOM CLEANING DAN REPLATING',	'2017-04-13 04:27:05',	'2017-04-13 04:27:05'),
(3,	'3',	'ELECTRIKAL DAN MECANICAL',	'2017-04-13 04:27:05',	'2017-04-13 04:27:05'),
(4,	'4',	'DT AND NDT',	'2017-04-13 04:27:05',	'2017-04-13 04:27:05'),
(5,	'5',	'GENERAL SERVICE',	'2017-04-13 04:27:05',	'2017-04-13 04:27:05');

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

-- 2017-04-22 11:27:51
