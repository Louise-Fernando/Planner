-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.30 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk plannerin
CREATE DATABASE IF NOT EXISTS `plannerin` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `plannerin`;

-- membuang struktur untuk table plannerin.kegiatan
CREATE TABLE IF NOT EXISTS `kegiatan` (
  `idkegiatan` int NOT NULL AUTO_INCREMENT,
  `idpengguna` int NOT NULL,
  `namakegiatan` varchar(200) NOT NULL,
  `deskripsikegiatan` text NOT NULL,
  `tanggal` date NOT NULL,
  `file` text,
  PRIMARY KEY (`idkegiatan`) USING BTREE,
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `kegiatan_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel plannerin.kegiatan: ~4 rows (lebih kurang)
INSERT INTO `kegiatan` (`idkegiatan`, `idpengguna`, `namakegiatan`, `deskripsikegiatan`, `tanggal`, `file`) VALUES
	(1, 14, 'Belajar', 'Perpustakaan', '2024-04-18', NULL),
	(2, 14, 'tes', 'tes', '2024-04-19', NULL),
	(3, 17, 'Ke Bank BCA Daftar Rekening', '-', '2024-05-29', '20240528054120IndonesiaTireMidPhoto_202147101712.jpg'),
	(4, 18, 'Medikal Checkup Puskesmas Sekojo', 'Lorem ipsum doler sit amet', '2024-05-29', '20240528054846LAPORAN PEMASUKAN (7).pdf');

-- membuang struktur untuk table plannerin.keuangan
CREATE TABLE IF NOT EXISTS `keuangan` (
  `idkeuangan` int NOT NULL AUTO_INCREMENT,
  `idpengguna` int NOT NULL,
  `judul` varchar(250) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` varchar(15) NOT NULL,
  `tipe` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`idkeuangan`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `keuangan_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel plannerin.keuangan: ~3 rows (lebih kurang)
INSERT INTO `keuangan` (`idkeuangan`, `idpengguna`, `judul`, `keterangan`, `tanggal`, `jumlah`, `tipe`) VALUES
	(3, 19, 'testing', 'test', '2024-05-29', '50000', 'Pengeluaran'),
	(4, 14, 'testing', 'test', '2024-05-29', '50000', 'Pengeluaran'),
	(7, 19, 'tambahan uang buat beli hp', 'bismillah aipong 11', '2024-05-30', '250000', 'Pemasukan');

-- membuang struktur untuk table plannerin.pengguna
CREATE TABLE IF NOT EXISTS `pengguna` (
  `idpengguna` int NOT NULL AUTO_INCREMENT,
  `namapengguna` varchar(50) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`idpengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel plannerin.pengguna: ~6 rows (lebih kurang)
INSERT INTO `pengguna` (`idpengguna`, `namapengguna`, `notelp`, `email`, `password`) VALUES
	(14, 'Budi Alex', '085928521', 'budi@gmail.com', 'budi'),
	(15, 'Nathan', '085912859281', 'nathan@gmail.com', 'nathan'),
	(16, 'Jojo', '08591285912', 'jojo@gmail.com', 'jojo'),
	(17, 'Sugeng Hariyanto', '08592185921', 'sugeng@gmail.com', 'sugeng'),
	(18, 'Rina Tukiyem', '08591285921', 'rina@gmail.com', 'rina'),
	(19, 'Alex', '08591285921', 'alex@gmail.com', 'alex');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
