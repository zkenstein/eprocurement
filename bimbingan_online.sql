-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `bimbingan`;
CREATE TABLE `bimbingan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` int(10) unsigned NOT NULL,
  `dosen_id` int(10) unsigned NOT NULL,
  `waktu` datetime NOT NULL,
  `via` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'offline',
  `status` tinyint(4) NOT NULL COMMENT '0=belum dilihat,1=diterima,2=ditolak',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `bimbingan_mahasiswa_id_foreign` (`mahasiswa_id`),
  KEY `bimbingan_dosen_id_foreign` (`dosen_id`),
  CONSTRAINT `bimbingan_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bimbingan_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` int(10) unsigned NOT NULL,
  `dosen_id` int(10) unsigned NOT NULL,
  `chat` text COLLATE utf8_unicode_ci NOT NULL,
  `by` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=mahasiswa;1=dosen',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `chat_mahasiswa_id_foreign` (`mahasiswa_id`),
  KEY `chat_dosen_id_foreign` (`dosen_id`),
  CONSTRAINT `chat_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE,
  CONSTRAINT `chat_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `coba`;
CREATE TABLE `coba` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `dosen`;
CREATE TABLE `dosen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nip` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `dosen` (`id`, `nip`, `email`, `password`, `token`, `nama`, `created_at`, `updated_at`) VALUES
(1,	'2103141042',	'dosen1@pens.ac.id',	'$2a$10$DttBhtDdtrRoKcPamLkISOKS6xBUG2xosrvj6bw9L/lAynttjVdry',	'S1wemBnJW',	'dosen1',	'2017-05-07 00:43:36',	'2017-05-07 06:47:11'),
(2,	'2103141043',	'dosen2@pens.ac.id',	'$2a$10$Ara7g0eDnSNWSif7qH3IF./A8o6Tw/Bu1IO/MZG7herSQNxQMoW4e',	'rkxwxXB31-',	'dosen2',	'2017-05-07 00:43:43',	'2017-05-07 06:47:11'),
(3,	'2103141044',	'dosen3@pens.ac.id',	'$2a$10$OjbK6viMTpS34P4AGWESHeIN.Wsgf.cK0y9vzR.iwOtReCioFUVJi',	'SyWwx7rh1Z',	'dosen3',	'2017-05-07 00:44:32',	'2017-05-07 06:47:11');

DROP TABLE IF EXISTS `file_sharing`;
CREATE TABLE `file_sharing` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` int(10) unsigned NOT NULL,
  `dosen_id` int(10) unsigned NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `by` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=mahasiswa;1=dosen',
  `nama_asli` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_encode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `file_sharing_mahasiswa_id_foreign` (`mahasiswa_id`),
  KEY `file_sharing_dosen_id_foreign` (`dosen_id`),
  CONSTRAINT `file_sharing_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE,
  CONSTRAINT `file_sharing_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE `mahasiswa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nrp` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `judul_ta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dosen1` int(10) unsigned NOT NULL,
  `dosen2` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `mahasiswa_dosen1_foreign` (`dosen1`),
  KEY `mahasiswa_dosen2_foreign` (`dosen2`),
  CONSTRAINT `mahasiswa_dosen1_foreign` FOREIGN KEY (`dosen1`) REFERENCES `dosen` (`id`) ON DELETE CASCADE,
  CONSTRAINT `mahasiswa_dosen2_foreign` FOREIGN KEY (`dosen2`) REFERENCES `dosen` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `mahasiswa` (`id`, `nrp`, `email`, `password`, `token`, `judul_ta`, `dosen1`, `dosen2`, `created_at`, `updated_at`) VALUES
(1,	'2103141042',	'mahasiswa1@it.student.pens.ac.id',	'$2a$10$DttBhtDdtrRoKcPamLkISOKS6xBUG2xosrvj6bw9L/lAynttjVdry',	'rJKRfHh1-',	'judul ta mahasiswa 1',	1,	2,	'2017-05-07 00:55:17',	'2017-05-07 06:46:41'),
(2,	'2103141043',	'mahasiswa2@it.student.pens.ac.id',	'$2a$10$DttBhtDdtrRoKcPamLkISOKS6xBUG2xosrvj6bw9L/lAynttjVdry',	'BygKCGrn1W',	'judul ta mahasiswa 2',	2,	3,	'2017-05-07 00:55:42',	'2017-05-07 06:46:41');

DROP TABLE IF EXISTS `pemberitahuan_dosen`;
CREATE TABLE `pemberitahuan_dosen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dosen_id` int(10) unsigned NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci NOT NULL,
  `lihat` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `pemberitahuan_dosen_dosen_id_foreign` (`dosen_id`),
  CONSTRAINT `pemberitahuan_dosen_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- 2017-05-09 02:44:01
