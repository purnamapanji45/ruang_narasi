-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ruang_narasi_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `buku`
--

DROP TABLE IF EXISTS `buku`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buku` (
  `id_book` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_penulis` int(11) DEFAULT NULL,
  `id_penerbit` int(11) DEFAULT NULL,
  `id_rak` int(11) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `sampul` varchar(255) DEFAULT 'default_cover.jpg',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_book`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buku`
--

LOCK TABLES `buku` WRITE;
/*!40000 ALTER TABLE `buku` DISABLE KEYS */;
INSERT INTO `buku` VALUES (5,'Atomic habit',2,1,1,2,2018,80,'1776968502_5c3d3efdd962cdb3dc8b.jpg','2026-04-21 07:25:52','2026-04-28 10:19:38'),(9,'Bandung After Rain',5,4,3,2,2017,121,'1777192645_5b5489ce27bcc2ce4e2b.jpg','2026-04-26 08:37:25','2026-04-28 10:01:37'),(11,'Petualangan di Pulau Robot',2,4,8,2,2024,10,'1777428592_435251be0f73ae349f25.png','2026-04-29 02:09:53','2026-04-29 02:09:53'),(12,'Laut Bercerita',2,1,9,2,2012,12,'1777429019_3015281748b2c01d6336.jpg','2026-04-29 02:15:14','2026-04-29 02:16:59');
/*!40000 ALTER TABLE `buku` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES (1,'Self Improvement.'),(2,'fiksi'),(5,'Novel');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peminjaman`
--

DROP TABLE IF EXISTS `peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT,
  `id_book` int(11) DEFAULT NULL,
  `nama_peminjam` varchar(100) DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('diajukan','dipinjam','kembali') DEFAULT 'dipinjam',
  `id_user` int(11) DEFAULT NULL,
  `denda` int(11) DEFAULT 0,
  `metode_bayar` enum('manual','dana','qris') DEFAULT 'manual',
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `status_bayar` enum('belum','proses','lunas') DEFAULT 'belum',
  PRIMARY KEY (`id_peminjaman`),
  KEY `fk_user` (`id_user`),
  CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peminjaman`
--

LOCK TABLES `peminjaman` WRITE;
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
INSERT INTO `peminjaman` VALUES (71,5,NULL,'2026-04-25','2026-04-30','kembali',20,0,'manual',NULL,'belum'),(72,9,NULL,'2026-04-26','2026-05-03','kembali',30,0,'manual',NULL,'belum'),(86,9,NULL,'2026-04-28','2026-05-05','kembali',27,0,'manual',NULL,'belum'),(88,9,NULL,'2026-04-28','2026-04-16','kembali',20,0,'manual',NULL,'belum'),(89,5,NULL,'2026-04-28','2026-05-05','kembali',20,0,'manual',NULL,'belum');
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penerbit`
--

DROP TABLE IF EXISTS `penerbit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penerbit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_penerbit` varchar(255) NOT NULL,
  `alamat_penerbit` text DEFAULT NULL,
  `telepon_penerbit` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penerbit`
--

LOCK TABLES `penerbit` WRITE;
/*!40000 ALTER TABLE `penerbit` DISABLE KEYS */;
INSERT INTO `penerbit` VALUES (1,'Bentang Pustaka','Yogyakarta','0858-6534-2319','2026-04-25 22:38:18','2026-04-29 01:50:19'),(3,'Kawah Media','jawah','0811-811-2131','2026-04-26 08:35:10','2026-04-29 01:51:46'),(8,'Gramedia Pustaka Utama',NULL,NULL,'2026-04-29 02:06:15','2026-04-29 02:06:15'),(9,'Kepustakaan Populer Gramedia (KPG)',NULL,NULL,'2026-04-29 02:13:50','2026-04-29 02:13:50');
/*!40000 ALTER TABLE `penerbit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penulis`
--

DROP TABLE IF EXISTS `penulis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penulis` (
  `id_penulis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_penulis` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_penulis`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penulis`
--

LOCK TABLES `penulis` WRITE;
/*!40000 ALTER TABLE `penulis` DISABLE KEYS */;
INSERT INTO `penulis` VALUES (1,'James Clear.'),(2,'Andrea Hirata'),(4,'Skysphire');
/*!40000 ALTER TABLE `penulis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rak`
--

DROP TABLE IF EXISTS `rak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rak` (
  `id_rak` int(5) NOT NULL AUTO_INCREMENT,
  `nama_rak` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  PRIMARY KEY (`id_rak`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rak`
--

LOCK TABLES `rak` WRITE;
/*!40000 ALTER TABLE `rak` DISABLE KEYS */;
INSERT INTO `rak` VALUES (2,'Rak A','Lantai 1, Samping Meja Petugas'),(3,'Rak B','Pojok kanan dekat jendela');
/*!40000 ALTER TABLE `rak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','petugas','anggota') DEFAULT 'anggota',
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (20,'beckah ','peckham@gmal.com','beckham','$2y$10$VMrKAxPCckaumLVNlLl3k.3UDk85MLZyzU9mV9B8WQAzII0Ig557W','anggota','1776715443_9e34ffb2a1484ec59eca.jpg','aktif','2026-04-20 20:04:03'),(21,'panjatjay','purnamapanji459@gmail.com','panji','$2y$10$FVCb2YD6Ye7r7ULKOmMgtOo0XE9WT9lxrezXbQEg4ycKNavzuRK.6','admin','1776968352_e6a4e7664983c8599a07.jpg','aktif','2026-04-21 04:53:30'),(22,'pedri gozales','pedri@gmail.com','pedri','$2y$10$RQiJCm6ew/MZFhiGBXH5yemStoW93ZXkCXF2QjB4vxc4gWxk1POVS','petugas','1776747389_04e65016d54268bfec02.jpg','aktif','2026-04-21 04:56:29'),(23,'pau cubarsi','cubarsi@gmail.com','cubarsi','$2y$10$9Hv3MtAGzG3YZQYeQPTneeVFv0aCvgbA6PwinNcPC/vzu2fwIiyiG','anggota','1776791161_a8a66079fda09614ac9f.jpg','aktif','2026-04-21 17:06:01'),(27,'lamine yamale','yamal@gmail.com','lamine','$2y$10$RhwPeEiBorXOV9.ojlk0eOUKXRqK/2VE5JDfEynv5W.AwxTNG6pT6','anggota','1776927324_ed3599ac79e4282a213c.jpg','aktif','2026-04-23 06:55:24'),(28,'bojan hodak','bojan@gmail.com','bojan','$2y$10$KeT7Wq.NDDVtgCyCyptCWemASLQLizwBIzBUF0nWOoNlOWyLQU72e','anggota','1776927885_89ea7c2a06b23554086b.jpg','aktif','2026-04-23 07:04:45'),(30,'roby','panji459@gmail.com','yayat','$2y$10$UcOyyqUAFjBMz3Ndk.givewK/IrhF6/FlZYOjpJgWJR4Vl/u2zXhu','petugas','1777257625_5a9824887b01e3e5d2a0.jpg','aktif','2026-04-26 09:44:46');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-29  9:18:57
