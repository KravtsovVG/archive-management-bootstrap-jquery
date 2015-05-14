-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: localhost
-- Waktu pembuatan: 12 Jan 2014 pada 21.43
-- Versi Server: 5.5.27
-- Versi PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `arsip_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id_category` bigint(12) NOT NULL AUTO_INCREMENT,
  `nama_category` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `update_by` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id_category`, `nama_category`, `datetime`, `created_by`, `tgl_update`, `update_by`) VALUES
(1, 'Linux', '2014-01-12 20:36:38', 'Muhamad Fajar', '2014-01-12 20:36:50', 'Muhamad Fajar'),
(2, 'Programing', '2014-01-12 21:29:57', 'Muhamad Fajar', '2014-01-12 21:31:01', 'Muhamad Fajar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `id_doc` bigint(12) NOT NULL AUTO_INCREMENT,
  `nama_doc` varchar(255) NOT NULL,
  `id_category` bigint(12) NOT NULL,
  `id_service_name` bigint(12) NOT NULL,
  `datetime` datetime NOT NULL,
  `created_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id_doc`),
  KEY `fk_id_doc_cat` (`id_category`),
  KEY `fk_id_doc_sub_cat` (`id_service_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `document`
--

INSERT INTO `document` (`id_doc`, `nama_doc`, `id_category`, `id_service_name`, `datetime`, `created_by`) VALUES
(1, 'Enterprise', 1, 1, '2014-01-12 20:47:17', 'Muhamad Fajar'),
(2, 'RaspianWheezy', 1, 2, '2014-01-12 21:17:04', 'Muhamad Fajar'),
(3, 'Configuration File', 1, 1, '2014-01-12 21:28:31', 'Muhamad Fajar'),
(4, 'Handbook', 2, 3, '2014-01-12 21:32:59', 'Muhamad Fajar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `document_detail`
--

CREATE TABLE IF NOT EXISTS `document_detail` (
  `id_doc_detail` bigint(12) NOT NULL AUTO_INCREMENT,
  `id_doc` bigint(12) NOT NULL,
  `nama_doc_detail` varchar(255) NOT NULL,
  `file` text NOT NULL,
  `deskripsi` text NOT NULL,
  `lokasi_fis` text NOT NULL,
  PRIMARY KEY (`id_doc_detail`),
  KEY `fk_id_doc_detail` (`id_doc`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `document_detail`
--

INSERT INTO `document_detail` (`id_doc_detail`, `id_doc`, `nama_doc_detail`, `file`, `deskripsi`, `lokasi_fis`) VALUES
(1, 1, 'Enterprise Desktop Migration', 'enterprise-desktop-migration-ebook2.pdf', 'Ebook Tentang Migrasi Desktop Untuk Enterprise Pada OS Ubuntu', '-'),
(2, 2, 'RaspberryPi Setup Using RaspianWheezy', 'rpi_raspianwheezy_setup.pdf', 'Setup Installation Raspberry Pi Using RaspianWheezy', 'Kosan'),
(3, 3, 'Resolv.conf', 'resolv.conf', 'Configuration File For DNS Server On Linux', 'Kosan'),
(4, 4, 'Rails Recipes 3rd Edition', 'rails_recipes_3_edition.pdf', 'Ruby On Rails Handbook', 'Kosan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `last_download`
--

CREATE TABLE IF NOT EXISTS `last_download` (
  `id_download` int(11) NOT NULL AUTO_INCREMENT,
  `id_doc_detail` int(11) NOT NULL,
  PRIMARY KEY (`id_download`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_data`
--

CREATE TABLE IF NOT EXISTS `master_data` (
  `id` bigint(12) NOT NULL AUTO_INCREMENT,
  `id_category` bigint(12) NOT NULL,
  `subkategori` varchar(255) NOT NULL,
  `last_update` date NOT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_cat` (`id_category`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `master_data`
--

INSERT INTO `master_data` (`id`, `id_category`, `subkategori`, `last_update`, `updated_by`) VALUES
(1, 1, 'Ubuntu', '2014-01-12', 'Muhamad Fajar'),
(2, 1, 'Journal', '2014-01-12', 'Muhamad Fajar'),
(3, 2, 'Ruby', '2014-01-12', 'Muhamad Fajar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `root`
--

CREATE TABLE IF NOT EXISTS `root` (
  `id_root` int(11) NOT NULL AUTO_INCREMENT,
  `dns_root` text NOT NULL,
  PRIMARY KEY (`id_root`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `root`
--

INSERT INTO `root` (`id_root`, `dns_root`) VALUES
(1, 'http://localhost/jamparing/');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `id_group` int(3) NOT NULL,
  `status_aktif` varchar(1) NOT NULL,
  `status_delete` varchar(1) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `fk_user_group` (`id_group`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `last_login`, `id_group`, `status_aktif`, `status_delete`) VALUES
(1, 'Root', 'root', 'root', '2013-10-14 18:56:46', 2, 'Y', 'T'),
(2, 'Muhamad Fajar', 'fajar', 'fajar', '2014-01-12 20:36:27', 1, 'Y', 'T'),
(3, 'User Biasa', 'guest', 'guest', '2014-01-12 19:15:31', 3, 'Y', 'T');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `id_group` int(3) NOT NULL AUTO_INCREMENT,
  `nama_group` varchar(50) NOT NULL,
  PRIMARY KEY (`id_group`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `user_group`
--

INSERT INTO `user_group` (`id_group`, `nama_group`) VALUES
(1, 'Administrator'),
(2, 'root'),
(3, 'Public User');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
