-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

INSERT INTO `barang` (`id`, `kode`, `satuan`, `deskripsi`, `gambar`, `pdf`, `created_at`, `updated_at`) VALUES
(6,	'LGS1',	'PKG',	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s',	'LGS1_1490312448.jpg',	NULL,	'2017-03-23 23:40:49',	'2017-03-28 05:34:11'),
(7,	'LGS2',	'PT',	'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries',	'LGS2_1490312474.jpeg',	'LGS2_1490679324.pdf',	'2017-03-23 23:41:14',	'2017-03-28 05:35:24'),
(8,	'LGS3',	'PT',	'but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages',	'LGS3_1490312501.jpg',	NULL,	'2017-03-23 23:41:41',	'2017-03-28 05:35:33'),
(9,	'LGS4',	'PCS',	'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old',	'LGS4_1490312534.jpg',	NULL,	'2017-03-23 23:42:15',	'2017-03-28 05:35:50'),
(10,	'LGS5',	'TPM',	'Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage',	'LGS5_1490312568.jpg',	NULL,	'2017-03-23 23:42:48',	'2017-03-28 05:35:59'),
(11,	'LGS6',	'DG',	'Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC',	'LGS6_1490312599.jpg',	NULL,	'2017-03-23 23:43:19',	'2017-03-28 05:36:09'),
(12,	'LGS7',	'PT',	'Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.',	'LGS7_1490312623.jpg',	NULL,	'2017-03-23 23:43:43',	'2017-03-28 05:36:24'),
(13,	'LGS8',	'DG',	'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested',	'LGS8_1490312659.jpg',	NULL,	'2017-03-23 23:44:19',	'2017-03-28 05:36:36'),
(14,	'LGS9',	'DG',	'Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.',	'LGS9_1490312680.png',	'LGS9_1490673954.pdf',	'2017-03-23 23:44:40',	'2017-03-28 05:36:57'),
(15,	'LGS10',	'DG',	'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using',	'LGS10_1490312713.jpg',	'LGS10_1490679264.pdf',	'2017-03-23 23:45:13',	'2017-03-28 05:34:24'),
(16,	'LGS11',	'DG',	'Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English',	'LGS11_1490312822.jpg',	NULL,	'2017-03-23 23:47:02',	'2017-03-28 05:34:44'),
(17,	'LGS12',	'Biji',	'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for',	'LGS12_1490673171.jpg',	'LGS12_1490673171.pdf',	'2017-03-23 23:47:21',	'2017-03-28 05:34:55'),
(18,	'LGS13',	'PKG',	'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour',	'LGS13_1490312861.jpg',	'LGS13_1490672963.pdf',	'2017-03-23 23:47:42',	'2017-03-28 05:35:08'),
(20,	'TES',	'PCS',	'Per a eleifend a adipiscing blandit urna curae metus platea quam parturient inceptos vestibulum vestibulum suspendisse dui habitant vestibulum magna parturient placerat erat in ornare tincidunt dignissim adipiscing lorem.Inceptos et adipiscing a nisi turpis a sit scelerisque.',	'TES_1490679472.jpg',	NULL,	'2017-03-28 05:37:52',	'2017-03-28 05:37:52');


INSERT INTO `cluster` (`id`, `kode`, `nama`, `created_at`, `updated_at`) VALUES
(1,	'1',	'PIPING, VALVE AND PROPULSI',	'2017-03-22 18:31:32',	'2017-03-22 18:31:32'),
(2,	'2',	'BOTTOM CLEANING DAN REPLATING',	'2017-03-22 18:31:33',	'2017-03-22 18:31:33'),
(3,	'3',	'ELECTRIKAL DAN MECANICAL',	'2017-03-22 18:31:33',	'2017-03-22 18:31:33'),
(4,	'4',	'DT AND NDT',	'2017-03-22 18:31:33',	'2017-03-22 18:31:33'),
(5,	'5',	'GENERAL SERVICE',	'2017-03-22 18:31:33',	'2017-03-22 18:31:33');

INSERT INTO `pengumuman` (`id`, `kode`, `batas_awal_waktu_penawaran`, `batas_akhir_waktu_penawaran`, `validitas_harga`, `waktu_pengiriman`, `harga_netto`, `mata_uang`, `max_register`, `count_register`, `pemenang`, `pic`, `file_excel`, `start_auction`, `durasi`, `created_at`, `updated_at`) VALUES
(3,	'ASD',	'2017-03-31 00:00:00',	'2017-03-31 23:59:00',	'2017-03-31 00:00:00',	'2017-03-31 00:00:00',	5000000,	'IDR',	0,	1,	NULL,	21,	'ASD_1490923871.csv',	'2017-04-07 10:00:00',	60,	'2017-03-31 01:31:11',	'2017-03-31 01:37:28'),
(4,	'BSD',	'2017-04-05 19:00:00',	'2017-04-09 23:00:00',	'2017-05-09 19:00:00',	'2017-04-04 19:00:00',	1000000,	'IDR',	4,	0,	NULL,	21,	NULL,	'2017-04-05 10:00:00',	120,	'2017-04-03 22:19:52',	'2017-04-03 22:19:52');

INSERT INTO `pengumuman_barang` (`id`, `pengumuman_id`, `barang_id`, `quantity`, `created_at`, `updated_at`) VALUES
(6,	3,	6,	1,	'2017-03-31 01:31:39',	'2017-03-31 01:31:39'),
(7,	3,	8,	3,	'2017-03-31 01:31:39',	'2017-03-31 01:31:39');

INSERT INTO `pengumuman_cluster` (`id`, `pengumuman_id`, `cluster_id`, `created_at`, `updated_at`) VALUES
(3,	3,	1,	'2017-03-31 01:31:40',	'2017-03-31 01:31:40');

INSERT INTO `pengumuman_user` (`id`, `pengumuman_id`, `user_id`, `kode_masuk`, `waktu_register`, `created_at`, `updated_at`) VALUES
(13,	3,	1,	'595b66904b02194e2b3807cebeafd292',	'2017-03-31 08:37:28',	'2017-03-31 01:31:11',	'2017-03-31 01:37:28'),
(14,	3,	3,	'c618971269e8fff2094c84e97ff8e464',	NULL,	'2017-03-31 01:31:18',	'2017-03-31 01:31:18'),
(15,	3,	4,	'21fc2ec6241cb28d434ba47bd55721ba',	NULL,	'2017-03-31 01:31:21',	'2017-03-31 01:31:21'),
(16,	3,	6,	'884f5786c5c7867e19a2a6aa90d7ae50',	NULL,	'2017-03-31 01:31:27',	'2017-03-31 01:31:27'),
(17,	3,	7,	'61074902ea55a41e5bca52ce3d0015d9',	NULL,	'2017-03-31 01:31:32',	'2017-03-31 01:31:32'),
(18,	3,	9,	'778253796a76e7a6567c7fd0ec7efd1b',	NULL,	'2017-03-31 01:31:35',	'2017-03-31 01:31:35'),
(19,	4,	1,	'0b3d010342ce7dad1fc8047e04c17f88',	NULL,	'2017-04-03 22:19:52',	'2017-04-03 22:19:52');

INSERT INTO `user` (`id`, `kode`, `nama`, `email`, `password`, `telp`, `bidang_usaha`, `session_id`, `role`, `aktif`, `kadaluarsa`, `created_at`, `updated_at`) VALUES
(1,	'ADI25AS',	'ADITYA RIZKY ANUGERAH PT.',	'kontraktor1@herobimbel.id',	'12345',	'03211234561',	'KONSTRUKSI KAPAL; PIPING SYSTEM;ACCOMODATION; MEKANIKAL & ELEKTRIKAL,subkontraktor',	'',	'subkontraktor',	NULL,	NULL,	'2017-03-22 18:36:15',	'2017-03-23 01:37:18'),
(2,	'AKA02AS',	'AKASIA TEKNOLOGI PT.',	'kontraktor2@herobimbel.id',	'12345',	'3211234562',	'KONSTRUKSI DAN PERMESINAN',	'',	'subkontraktor',	NULL,	NULL,	'2017-03-22 18:38:37',	'2017-03-23 01:37:06'),
(3,	'ALR01AS',	'ALREDHO TEKNIK PT.',	'kontraktor3@herobimbel.id',	'12345',	'03211234563',	'PENGELASAN,TANK CLEANING,AKOMODASI ,PENGGERAK UTAMA,POMPA,MACHINING,BALANCING,AC,MOTOR GENERATOR',	'',	'subkontraktor',	NULL,	NULL,	'0000-00-00 00:00:00',	'2017-03-23 01:36:57'),
(4,	'AME14AS',	'AMERTA TIRTA BUWANA PT.',	'kontraktor4@herobimbel.id',	'12345',	'03211234564',	'ASIS TUG BOAT',	'',	'subkontraktor',	NULL,	NULL,	'0000-00-00 00:00:00',	'2017-03-23 01:36:47'),
(5,	'ARV01AS',	'ARVET UNGGUL JAYA PT.',	'kontraktor5@herobimbel.id',	'12345',	'03211234565',	'GENERAL SERVICE,MEKANIKAL DAN ELEKTRIKAL,PIPING VALVE DAN PROPULSI',	'',	'subkontraktor',	NULL,	NULL,	'0000-00-00 00:00:00',	'2017-03-23 01:36:34'),
(6,	'AUL03AS',	'AULIA KARYA PERDANA PT.',	'kontraktor6@herobimbel.id',	'12345',	'03211234566',	'KONSTRUKSI KAPAL, PIPING, ELECTRICAL SYSTEM',	'',	'subkontraktor',	NULL,	NULL,	'0000-00-00 00:00:00',	'2017-03-23 01:36:24'),
(7,	'BAN13AS',	'BANGUN PERKASA JAYA ENGINEERING PT.',	'kontraktor7@herobimbel.id',	'12345',	'03211234567',	'MEKANIKAL & ELEKTRIKAL, PIPING, VALVE & SYSTEM PROPULSI',	'',	'subkontraktor',	NULL,	NULL,	'0000-00-00 00:00:00',	'2017-03-23 01:36:11'),
(8,	'BDP01AS',	'BDP INDONESIA PT.',	'kontraktor8@herobimbel.id',	'12345',	'03211234568',	'PENGURUSAN TRANSPORTASI MATERIAL HANDLING LAUT & UDARA,CUTOM CLEARANCE',	'',	'subkontraktor',	NULL,	NULL,	'0000-00-00 00:00:00',	'2017-03-23 01:35:57'),
(9,	'DAL05AS',	'DALUT NUSANTARA BARU PT.',	'kontraktor9@herobimbel.id',	'12345',	'03211234569',	'NDT ( NON DESTRUCTIVE TEST) NON RADIASI',	'',	'subkontraktor',	NULL,	NULL,	'0000-00-00 00:00:00',	'2017-03-23 01:35:28'),
(10,	'DUA01AS',	'DUA-DUA KUTAI UTAMA PT.',	'kontraktor10@herobimbel.id',	'12345',	'032112345610',	'BOTTOM CLEANING & REPLATING ,PIPING,VALVE, PROPULSI',	'',	'subkontraktor',	NULL,	NULL,	'0000-00-00 00:00:00',	'2017-03-23 01:34:48'),
(11,	'KODE-0',	'Administrator',	'kurniawan@herobimbel.id',	'12345',	'03210987651',	'',	'',	'admin',	NULL,	NULL,	'2017-03-22 18:48:28',	'2017-03-22 18:48:28'),
(21,	'DEF',	'Budi Prakoso',	'budi@pal.co',	'12345',	'0812373243',	'',	'',	'pic',	NULL,	NULL,	'2017-03-27 21:27:24',	'2017-03-28 03:54:09'),
(22,	'ABC',	'Hari Kurniawan',	'hari@pal.co',	'12345',	'08712463264728',	'',	'',	'pic',	NULL,	NULL,	'2017-03-27 21:32:15',	'2017-03-28 03:53:56');

INSERT INTO `user_cluster` (`id`, `user_id`, `cluster_id`, `created_at`, `updated_at`) VALUES
(26,	10,	4,	'2017-03-23 01:34:48',	'2017-03-23 01:34:48'),
(27,	10,	5,	'2017-03-23 01:34:48',	'2017-03-23 01:34:48'),
(28,	9,	1,	'2017-03-23 01:35:28',	'2017-03-23 01:35:28'),
(29,	9,	2,	'2017-03-23 01:35:28',	'2017-03-23 01:35:28'),
(30,	9,	3,	'2017-03-23 01:35:28',	'2017-03-23 01:35:28'),
(32,	8,	3,	'2017-03-23 01:35:57',	'2017-03-23 01:35:57'),
(33,	8,	4,	'2017-03-23 01:35:57',	'2017-03-23 01:35:57'),
(34,	7,	1,	'2017-03-23 01:36:11',	'2017-03-23 01:36:11'),
(35,	7,	2,	'2017-03-23 01:36:11',	'2017-03-23 01:36:11'),
(36,	7,	5,	'2017-03-23 01:36:11',	'2017-03-23 01:36:11'),
(37,	6,	1,	'2017-03-23 01:36:24',	'2017-03-23 01:36:24'),
(38,	6,	5,	'2017-03-23 01:36:24',	'2017-03-23 01:36:24'),
(39,	5,	2,	'2017-03-23 01:36:34',	'2017-03-23 01:36:34'),
(40,	5,	3,	'2017-03-23 01:36:34',	'2017-03-23 01:36:34'),
(41,	5,	4,	'2017-03-23 01:36:34',	'2017-03-23 01:36:34'),
(42,	4,	1,	'2017-03-23 01:36:47',	'2017-03-23 01:36:47'),
(43,	4,	3,	'2017-03-23 01:36:47',	'2017-03-23 01:36:47'),
(44,	3,	1,	'2017-03-23 01:36:57',	'2017-03-23 01:36:57'),
(45,	3,	2,	'2017-03-23 01:36:57',	'2017-03-23 01:36:57'),
(46,	2,	3,	'2017-03-23 01:37:06',	'2017-03-23 01:37:06'),
(47,	2,	4,	'2017-03-23 01:37:06',	'2017-03-23 01:37:06'),
(48,	2,	5,	'2017-03-23 01:37:06',	'2017-03-23 01:37:06'),
(49,	1,	1,	'2017-03-23 01:37:18',	'2017-03-23 01:37:18'),
(50,	1,	3,	'2017-03-23 01:37:18',	'2017-03-23 01:37:18'),
(51,	1,	4,	'2017-03-23 01:37:18',	'2017-03-23 01:37:18');

-- 2017-04-03 22:25:27
