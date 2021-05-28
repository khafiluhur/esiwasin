-- MariaDB dump 10.17  Distrib 10.4.7-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: esiwasin
-- ------------------------------------------------------
-- Server version	10.4.7-MariaDB

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
-- Table structure for table `anggota_tim`
--

DROP TABLE IF EXISTS `anggota_tim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anggota_tim` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ketua` int(11) NOT NULL,
  `anggota` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anggota_tim`
--

LOCK TABLES `anggota_tim` WRITE;
/*!40000 ALTER TABLE `anggota_tim` DISABLE KEYS */;
INSERT INTO `anggota_tim` VALUES (1,7,5,'2021-02-24 01:49:56','2021-02-24 01:49:56'),(2,7,6,'2021-02-24 01:49:56','2021-02-24 01:49:56'),(3,7,8,'2021-02-24 01:49:56','2021-02-24 01:49:56'),(4,7,9,'2021-02-24 01:49:56','2021-02-24 01:49:56'),(5,13,18,'2021-02-24 03:55:57','2021-02-24 03:55:57'),(6,14,19,'2021-02-24 03:57:08','2021-02-24 03:57:08'),(7,15,20,'2021-02-24 03:58:32','2021-02-24 03:58:32'),(8,16,21,'2021-02-24 03:59:19','2021-02-24 03:59:19'),(9,17,22,'2021-02-24 03:59:53','2021-02-24 03:59:53');
/*!40000 ALTER TABLE `anggota_tim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvel_audit_keuangan`
--

DROP TABLE IF EXISTS `approvel_audit_keuangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `approvel_audit_keuangan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `audit_keuangan` int(11) NOT NULL,
  `users_pembuat` int(11) NOT NULL,
  `status_pembuat` int(11) NOT NULL,
  `tanggal_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pembuat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_ketua` int(11) NOT NULL,
  `status_ketua` int(11) NOT NULL,
  `tanggal_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_ketua` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pt` int(11) NOT NULL,
  `status_pt` int(11) NOT NULL,
  `tanggal_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pm` int(11) NOT NULL,
  `status_pm` int(11) NOT NULL,
  `tanggal_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvel_audit_keuangan`
--

LOCK TABLES `approvel_audit_keuangan` WRITE;
/*!40000 ALTER TABLE `approvel_audit_keuangan` DISABLE KEYS */;
INSERT INTO `approvel_audit_keuangan` VALUES (1,1,26,1,'25/02/2121','15:02','Test',25,2,'25/02/2121','15:02','Test',2,0,'0','0','0',3,0,'0','0','0','2021-02-25 08:56:37','2021-02-25 08:57:03'),(2,2,26,1,'25/02/2121','15:02','Test',27,2,'25/02/2121','16:02','Test',2,0,'0','0','0',3,0,'0','0','0','2021-02-25 08:59:53','2021-02-25 09:01:01'),(3,3,19,1,'25/02/2121','19:02','Test',15,2,'25/02/2121','19:02','Test',2,0,'0','0','0',3,0,'0','0','0','2021-02-25 12:35:28','2021-02-25 12:37:16'),(4,4,19,1,'28/02/2121','20:02','Setuju untuk diteruskan (Data Terlampir)',15,2,'28/02/2121','20:02','KKA Audit TW IV Daniel diterima dan setuju untuk diteruskan kepada pengendali teknis',2,2,'28/02/2121','20:02','Setuju untuk diteruskan kepada pengendali mutu',3,2,'28/02/2121','20:02','Setuju','2021-02-28 13:45:53','2021-02-28 13:49:00'),(5,5,18,1,'28/02/2121','20:02','KKA Audit TW IV (Data Terlampir)',15,2,'28/02/2121','20:02','Setuju atas KKA Dian Ayu',2,2,'28/02/2121','20:02','Setuju dan teruskan kepada Pengendali Mutu',3,2,'28/02/2121','20:02','Setuju','2021-02-28 13:56:54','2021-02-28 13:58:06');
/*!40000 ALTER TABLE `approvel_audit_keuangan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvel_audit_kinerja`
--

DROP TABLE IF EXISTS `approvel_audit_kinerja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `approvel_audit_kinerja` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `audit_kinerja` int(11) NOT NULL,
  `users_pembuat` int(11) NOT NULL,
  `status_pembuat` int(11) NOT NULL,
  `tanggal_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pembuat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_ketua` int(11) NOT NULL,
  `status_ketua` int(11) NOT NULL,
  `tanggal_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_ketua` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pt` int(11) NOT NULL,
  `status_pt` int(11) NOT NULL,
  `tanggal_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pm` int(11) NOT NULL,
  `status_pm` int(11) NOT NULL,
  `tanggal_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvel_audit_kinerja`
--

LOCK TABLES `approvel_audit_kinerja` WRITE;
/*!40000 ALTER TABLE `approvel_audit_kinerja` DISABLE KEYS */;
INSERT INTO `approvel_audit_kinerja` VALUES (1,1,26,1,'28/02/2121','20:02','dasdasd',25,2,'28/02/2121','21:02','dsadsa',2,0,'0','0','0',3,0,'0','0','0','2021-02-28 13:29:31','2021-02-28 14:45:00');
/*!40000 ALTER TABLE `approvel_audit_kinerja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvel_audit_tujuan_tertentu`
--

DROP TABLE IF EXISTS `approvel_audit_tujuan_tertentu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `approvel_audit_tujuan_tertentu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `audit_tujuan_tertentu` int(11) NOT NULL,
  `users_pembuat` int(11) NOT NULL,
  `status_pembuat` int(11) NOT NULL,
  `tanggal_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pembuat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_ketua` int(11) NOT NULL,
  `status_ketua` int(11) NOT NULL,
  `tanggal_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_ketua` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pt` int(11) NOT NULL,
  `status_pt` int(11) NOT NULL,
  `tanggal_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pm` int(11) NOT NULL,
  `status_pm` int(11) NOT NULL,
  `tanggal_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvel_audit_tujuan_tertentu`
--

LOCK TABLES `approvel_audit_tujuan_tertentu` WRITE;
/*!40000 ALTER TABLE `approvel_audit_tujuan_tertentu` DISABLE KEYS */;
/*!40000 ALTER TABLE `approvel_audit_tujuan_tertentu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvel_evaluasi_iacm`
--

DROP TABLE IF EXISTS `approvel_evaluasi_iacm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `approvel_evaluasi_iacm` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `evaluasi_iacm` int(11) NOT NULL,
  `users_pembuat` int(11) NOT NULL,
  `status_pembuat` int(11) NOT NULL,
  `tanggal_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pembuat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_ketua` int(11) NOT NULL,
  `status_ketua` int(11) NOT NULL,
  `tanggal_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_ketua` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pt` int(11) NOT NULL,
  `status_pt` int(11) NOT NULL,
  `tanggal_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pm` int(11) NOT NULL,
  `status_pm` int(11) NOT NULL,
  `tanggal_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvel_evaluasi_iacm`
--

LOCK TABLES `approvel_evaluasi_iacm` WRITE;
/*!40000 ALTER TABLE `approvel_evaluasi_iacm` DISABLE KEYS */;
/*!40000 ALTER TABLE `approvel_evaluasi_iacm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvel_evaluasi_reformasi_birokrasi`
--

DROP TABLE IF EXISTS `approvel_evaluasi_reformasi_birokrasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `approvel_evaluasi_reformasi_birokrasi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `evaluasi_reformasi_birokrasi` int(11) NOT NULL,
  `users_pembuat` int(11) NOT NULL,
  `status_pembuat` int(11) NOT NULL,
  `tanggal_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pembuat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_ketua` int(11) NOT NULL,
  `status_ketua` int(11) NOT NULL,
  `tanggal_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_ketua` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pt` int(11) NOT NULL,
  `status_pt` int(11) NOT NULL,
  `tanggal_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pm` int(11) NOT NULL,
  `status_pm` int(11) NOT NULL,
  `tanggal_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvel_evaluasi_reformasi_birokrasi`
--

LOCK TABLES `approvel_evaluasi_reformasi_birokrasi` WRITE;
/*!40000 ALTER TABLE `approvel_evaluasi_reformasi_birokrasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `approvel_evaluasi_reformasi_birokrasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvel_evaluasi_sakip`
--

DROP TABLE IF EXISTS `approvel_evaluasi_sakip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `approvel_evaluasi_sakip` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `evaluasi_sakip` int(11) NOT NULL,
  `users_pembuat` int(11) NOT NULL,
  `status_pembuat` int(11) NOT NULL,
  `tanggal_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pembuat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_ketua` int(11) NOT NULL,
  `status_ketua` int(11) NOT NULL,
  `tanggal_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_ketua` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pt` int(11) NOT NULL,
  `status_pt` int(11) NOT NULL,
  `tanggal_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pm` int(11) NOT NULL,
  `status_pm` int(11) NOT NULL,
  `tanggal_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvel_evaluasi_sakip`
--

LOCK TABLES `approvel_evaluasi_sakip` WRITE;
/*!40000 ALTER TABLE `approvel_evaluasi_sakip` DISABLE KEYS */;
/*!40000 ALTER TABLE `approvel_evaluasi_sakip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvel_evaluasi_spip`
--

DROP TABLE IF EXISTS `approvel_evaluasi_spip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `approvel_evaluasi_spip` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `evaluasi_spip` int(11) NOT NULL,
  `users_pembuat` int(11) NOT NULL,
  `status_pembuat` int(11) NOT NULL,
  `tanggal_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pembuat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_ketua` int(11) NOT NULL,
  `status_ketua` int(11) NOT NULL,
  `tanggal_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_ketua` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pt` int(11) NOT NULL,
  `status_pt` int(11) NOT NULL,
  `tanggal_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pm` int(11) NOT NULL,
  `status_pm` int(11) NOT NULL,
  `tanggal_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvel_evaluasi_spip`
--

LOCK TABLES `approvel_evaluasi_spip` WRITE;
/*!40000 ALTER TABLE `approvel_evaluasi_spip` DISABLE KEYS */;
/*!40000 ALTER TABLE `approvel_evaluasi_spip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvel_kepsesjen`
--

DROP TABLE IF EXISTS `approvel_kepsesjen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `approvel_kepsesjen` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kepsesjen` int(11) NOT NULL,
  `users_pembuat` int(11) NOT NULL,
  `status_pembuat` int(11) NOT NULL,
  `tanggal_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pembuat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_ketua` int(11) NOT NULL,
  `status_ketua` int(11) NOT NULL,
  `tanggal_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_ketua` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pt` int(11) NOT NULL,
  `status_pt` int(11) NOT NULL,
  `tanggal_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pm` int(11) NOT NULL,
  `status_pm` int(11) NOT NULL,
  `tanggal_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvel_kepsesjen`
--

LOCK TABLES `approvel_kepsesjen` WRITE;
/*!40000 ALTER TABLE `approvel_kepsesjen` DISABLE KEYS */;
/*!40000 ALTER TABLE `approvel_kepsesjen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvel_konsultasi`
--

DROP TABLE IF EXISTS `approvel_konsultasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `approvel_konsultasi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `konsultasi` int(11) NOT NULL,
  `users_pembuat` int(11) NOT NULL,
  `status_pembuat` int(11) NOT NULL,
  `tanggal_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pembuat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_anggota` int(11) NOT NULL,
  `status_anggota` int(11) NOT NULL,
  `tanggal_anggota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_anggota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_anggota` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_ketua` int(11) NOT NULL,
  `status_ketua` int(11) NOT NULL,
  `tanggal_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_ketua` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pt` int(11) NOT NULL,
  `status_pt` int(11) NOT NULL,
  `tanggal_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pm` int(11) NOT NULL,
  `status_pm` int(11) NOT NULL,
  `tanggal_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvel_konsultasi`
--

LOCK TABLES `approvel_konsultasi` WRITE;
/*!40000 ALTER TABLE `approvel_konsultasi` DISABLE KEYS */;
INSERT INTO `approvel_konsultasi` VALUES (1,523037181,23,1,'24/02/2121','18:02','Terlampir',20,0,'0','0','0',0,0,'0','0','0',0,0,'0','0','0',0,0,'0','0','0','2021-02-24 11:41:39','2021-02-24 11:41:39');
/*!40000 ALTER TABLE `approvel_konsultasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvel_koordinasi`
--

DROP TABLE IF EXISTS `approvel_koordinasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `approvel_koordinasi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `koordinasi` int(11) NOT NULL,
  `users_pembuat` int(11) NOT NULL,
  `status_pembuat` int(11) NOT NULL,
  `tanggal_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pembuat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_anggota` int(11) NOT NULL,
  `status_anggota` int(11) NOT NULL,
  `tanggal_anggota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_anggota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_anggota` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_ketua` int(11) NOT NULL,
  `status_ketua` int(11) NOT NULL,
  `tanggal_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_ketua` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pt` int(11) NOT NULL,
  `status_pt` int(11) NOT NULL,
  `tanggal_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pm` int(11) NOT NULL,
  `status_pm` int(11) NOT NULL,
  `tanggal_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvel_koordinasi`
--

LOCK TABLES `approvel_koordinasi` WRITE;
/*!40000 ALTER TABLE `approvel_koordinasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `approvel_koordinasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvel_nodim`
--

DROP TABLE IF EXISTS `approvel_nodim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `approvel_nodim` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nodim` int(11) NOT NULL,
  `users_pembuat` int(11) NOT NULL,
  `status_pembuat` int(11) NOT NULL,
  `tanggal_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pembuat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_ketua` int(11) NOT NULL,
  `status_ketua` int(11) NOT NULL,
  `tanggal_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_ketua` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pt` int(11) NOT NULL,
  `status_pt` int(11) NOT NULL,
  `tanggal_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pm` int(11) NOT NULL,
  `status_pm` int(11) NOT NULL,
  `tanggal_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvel_nodim`
--

LOCK TABLES `approvel_nodim` WRITE;
/*!40000 ALTER TABLE `approvel_nodim` DISABLE KEYS */;
/*!40000 ALTER TABLE `approvel_nodim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvel_pelatihan`
--

DROP TABLE IF EXISTS `approvel_pelatihan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `approvel_pelatihan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pelatihan` int(11) NOT NULL,
  `users_pembuat` int(11) NOT NULL,
  `status_pembuat` int(11) NOT NULL,
  `tanggal_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pembuat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_anggota` int(11) NOT NULL,
  `status_anggota` int(11) NOT NULL,
  `tanggal_anggota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_anggota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_anggota` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_ketua` int(11) NOT NULL,
  `status_ketua` int(11) NOT NULL,
  `tanggal_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_ketua` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pt` int(11) NOT NULL,
  `status_pt` int(11) NOT NULL,
  `tanggal_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pm` int(11) NOT NULL,
  `status_pm` int(11) NOT NULL,
  `tanggal_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvel_pelatihan`
--

LOCK TABLES `approvel_pelatihan` WRITE;
/*!40000 ALTER TABLE `approvel_pelatihan` DISABLE KEYS */;
/*!40000 ALTER TABLE `approvel_pelatihan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvel_reviu_kegiatan_anggaran`
--

DROP TABLE IF EXISTS `approvel_reviu_kegiatan_anggaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `approvel_reviu_kegiatan_anggaran` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reviu_kegiatan_anggaran` int(11) NOT NULL,
  `users_pembuat` int(11) NOT NULL,
  `status_pembuat` int(11) NOT NULL,
  `tanggal_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pembuat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_ketua` int(11) NOT NULL,
  `status_ketua` int(11) NOT NULL,
  `tanggal_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_ketua` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pt` int(11) NOT NULL,
  `status_pt` int(11) NOT NULL,
  `tanggal_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pm` int(11) NOT NULL,
  `status_pm` int(11) NOT NULL,
  `tanggal_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvel_reviu_kegiatan_anggaran`
--

LOCK TABLES `approvel_reviu_kegiatan_anggaran` WRITE;
/*!40000 ALTER TABLE `approvel_reviu_kegiatan_anggaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `approvel_reviu_kegiatan_anggaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvel_reviu_lakip`
--

DROP TABLE IF EXISTS `approvel_reviu_lakip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `approvel_reviu_lakip` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reviu_lakip` int(11) NOT NULL,
  `users_pembuat` int(11) NOT NULL,
  `status_pembuat` int(11) NOT NULL,
  `tanggal_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pembuat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_ketua` int(11) NOT NULL,
  `status_ketua` int(11) NOT NULL,
  `tanggal_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_ketua` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pt` int(11) NOT NULL,
  `status_pt` int(11) NOT NULL,
  `tanggal_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pm` int(11) NOT NULL,
  `status_pm` int(11) NOT NULL,
  `tanggal_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvel_reviu_lakip`
--

LOCK TABLES `approvel_reviu_lakip` WRITE;
/*!40000 ALTER TABLE `approvel_reviu_lakip` DISABLE KEYS */;
INSERT INTO `approvel_reviu_lakip` VALUES (1,1,18,1,'24/02/2121','14:02','Terlampir Reviu LAKIP 2020',16,2,'01/03/2121','13:03','Setuju, namun pada permasalahan (kualitas, kompetensi dan profesional pegawai masih harus ditingkatkan) dikarenakan masih menggunakan Renstra 2015-2019, berarti tidak perlu ada perbaikan pada draft LAKIP',2,2,'01/03/2121','13:03','Setuju untuk diteruskan',3,2,'01/03/2121','13:03','Setuju','2021-02-24 07:37:52','2021-03-01 06:36:25'),(2,2,26,1,'25/02/2121','16:02','Test',25,0,'0','0','0',0,0,'0','0','0',0,0,'0','0','0','2021-02-25 09:05:52','2021-02-25 09:05:52'),(3,3,26,1,'25/02/2121','16:02','test',25,0,'0','0','0',0,0,'0','0','0',0,0,'0','0','0','2021-02-25 09:08:27','2021-02-25 09:08:27'),(4,4,26,1,'28/02/2121','21:02','dasdas',25,0,'0','0','0',0,0,'0','0','0',0,0,'0','0','0','2021-02-28 14:42:09','2021-02-28 14:42:09'),(5,5,26,1,'28/02/2121','21:02','dasdasd',25,0,'0','0','0',0,0,'0','0','0',0,0,'0','0','0','2021-02-28 14:44:27','2021-02-28 14:44:27');
/*!40000 ALTER TABLE `approvel_reviu_lakip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvel_reviu_laporan_keuangan`
--

DROP TABLE IF EXISTS `approvel_reviu_laporan_keuangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `approvel_reviu_laporan_keuangan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reviu_laporan_keuangan` int(11) NOT NULL,
  `users_pembuat` int(11) NOT NULL,
  `status_pembuat` int(11) NOT NULL,
  `tanggal_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pembuat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_ketua` int(11) NOT NULL,
  `status_ketua` int(11) NOT NULL,
  `tanggal_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_ketua` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pt` int(11) NOT NULL,
  `status_pt` int(11) NOT NULL,
  `tanggal_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pm` int(11) NOT NULL,
  `status_pm` int(11) NOT NULL,
  `tanggal_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvel_reviu_laporan_keuangan`
--

LOCK TABLES `approvel_reviu_laporan_keuangan` WRITE;
/*!40000 ALTER TABLE `approvel_reviu_laporan_keuangan` DISABLE KEYS */;
INSERT INTO `approvel_reviu_laporan_keuangan` VALUES (1,1,19,1,'24/02/2121','14:02','KKR Hibah dan Belanja telah sesuai (terlampir)',17,2,'24/02/2121','14:02','ok',2,2,'24/02/2121','14:02','Setuju',3,2,'24/02/2121','14:02','Lanjutkan','2021-02-24 07:09:10','2021-02-24 07:13:23'),(2,2,18,1,'24/02/2121','14:02','Terlampir KKR Reviu LK',17,2,'24/02/2121','14:02','Ok',2,2,'24/02/2121','14:02','KKR Bendahara Penerimaan dan Persediaan telah direviu',3,2,'24/02/2121','14:02','Tindaklanjuti','2021-02-24 07:18:15','2021-02-24 07:20:28'),(3,3,21,1,'24/02/2121','14:02','Dimohon Di koreksi',17,2,'24/02/2121','14:02','Ok',2,2,'24/02/2121','14:02','sudah di reviu, ok',3,2,'24/02/2121','14:02','Laksanakan','2021-02-24 07:25:56','2021-02-24 07:27:19'),(4,4,6,1,'24/02/2121','14:02','Terlampir Ibu Riri KKR Neraca dan Calk',17,2,'24/02/2121','14:02','Ok',2,2,'24/02/2121','14:02','KKR Neraca dan Calk Setuju',3,2,'24/02/2121','14:02','Laksanakan','2021-02-24 07:25:58','2021-02-24 07:32:55'),(5,5,20,1,'24/02/2121','14:02','Terlampir ya Ibu Riri , Terima kasih',17,0,'0','0','0',0,0,'0','0','0',0,0,'0','0','0','2021-02-24 07:31:59','2021-02-24 07:31:59');
/*!40000 ALTER TABLE `approvel_reviu_laporan_keuangan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvel_reviu_rkbmn`
--

DROP TABLE IF EXISTS `approvel_reviu_rkbmn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `approvel_reviu_rkbmn` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reviu_rkbmn` int(11) NOT NULL,
  `users_pembuat` int(11) NOT NULL,
  `status_pembuat` int(11) NOT NULL,
  `tanggal_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pembuat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pembuat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_ketua` int(11) NOT NULL,
  `status_ketua` int(11) NOT NULL,
  `tanggal_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_ketua` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pt` int(11) NOT NULL,
  `status_pt` int(11) NOT NULL,
  `tanggal_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_pm` int(11) NOT NULL,
  `status_pm` int(11) NOT NULL,
  `tanggal_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_pm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvel_reviu_rkbmn`
--

LOCK TABLES `approvel_reviu_rkbmn` WRITE;
/*!40000 ALTER TABLE `approvel_reviu_rkbmn` DISABLE KEYS */;
/*!40000 ALTER TABLE `approvel_reviu_rkbmn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit`
--

DROP TABLE IF EXISTS `audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `audit` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `nomor_st` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_audit_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_audit_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit`
--

LOCK TABLES `audit` WRITE;
/*!40000 ALTER TABLE `audit` DISABLE KEYS */;
INSERT INTO `audit` VALUES (1,418053093,26,'1234/ST/WASINT/2020','25','02/12/2020','02/12/2020',1,1,'2021-02-25 08:56:37','2021-02-25 08:56:37'),(2,1004958869,26,'1233/ST/WASINT/2020','27','12/02/2020','12/02/2020',1,1,'2021-02-25 08:59:53','2021-02-25 08:59:53'),(3,1980106091,19,'ST15/PI.01.01/2021','15','16/12/2020','16/12/2020',1,1,'2021-02-25 12:35:28','2021-02-25 12:35:28'),(4,1153396562,26,'1233/ST/WASINT/2020','25','30/12/2020','30/12/2020',1,2,'2021-02-28 13:29:31','2021-02-28 13:29:31'),(5,2023254040,19,'ST-15/PI.01.01/2021','15','27/01/2021','12/02/2021',1,1,'2021-02-28 13:45:53','2021-02-28 13:45:53'),(6,332770461,18,'ST-15/PI.01.01/2021','15','27/01/2021','12/02/2021',1,1,'2021-02-28 13:56:54','2021-02-28 13:56:54');
/*!40000 ALTER TABLE `audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_keuangan`
--

DROP TABLE IF EXISTS `audit_keuangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_keuangan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `ketua` int(11) NOT NULL,
  `nomor_st` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_audit_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_audit_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_kondisi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_kriteria` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_sebab` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_akibat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `is_status` int(11) NOT NULL,
  `is_publish` int(11) NOT NULL,
  `is_save` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_keuangan`
--

LOCK TABLES `audit_keuangan` WRITE;
/*!40000 ALTER TABLE `audit_keuangan` DISABLE KEYS */;
INSERT INTO `audit_keuangan` VALUES (1,418053093,25,'1234/ST/WASINT/2020','02/12/2020','02/12/2020','Audit Keuangan 123','Kondisi 123','Kriteria ABC','Sebab','Akibat',26,1,1,1,0,'2021-02-25 08:56:37','2021-02-25 08:56:37'),(2,1004958869,27,'1233/ST/WASINT/2020','12/02/2020','12/02/2020','Audit Keuangan 123','Kondisi 123','Kriteria ABC','Sebab','Akibat',26,1,1,1,0,'2021-02-25 08:59:53','2021-02-25 08:59:53'),(3,1980106091,15,'ST15/PI.01.01/2021','16/12/2020','16/12/2020','Audit Keuangan 123','Kondisi 123','Kriteria ABC','Sebab','Akibat',19,1,1,1,0,'2021-02-25 12:35:28','2021-02-25 12:35:28'),(4,2023254040,15,'ST-15/PI.01.01/2021','27/01/2021','12/02/2021','KKA AUDIT TW IV DANIEL','1.	Terdapat Beberapa SPM belum dilengkapi data pertanggungjawaban yang sesuai 2.	Terdapat Beberapa SPM belum dilengkapi cap dan ttd pihak yang bersangkutan  3.	Kelebihan Pembayaran uang saku diklat  (Detail terlampir dalam KKA )','1.	Undang-Undang Nomor 17 Tahun 2003 tentang Keuangan Negara Pasal 3 ayat (1) yang menyatakan bahwa Keuangan Negara dikelola secara tertib, taat pada peraturan perundang-undangan, efisien, ekonomis, efektif, transparan, dan bertanggung jawab dengan memperhatikan rasa keadilan dan kepatutan Dalam hal ini dokumen pertanggungjawaban keuangan harus mampu menggambarkan pengeluaran anggaran yang akuntabel  2.	Peraturan Menteri Keuangan Republik Indonesia Nomor 78/PMK.02/2019 tentang Standar Biaya Masukan 2020  Penggunaan APBN pada Instansi Setjen Wantannas tidak boleh melebihi standar biaya masukan yang telah ditetapkan khususnya pada pemberian uang saku diklat','1.	Tata Usaha Wabku setiap Unit belum memahami dokumen kelengkapan wabku \r\n2.	Kurangnya SDM pada Bagian Verifikasi \r\n3.	Petugas administrasi pengelola keuangan beserta PPK kurang teliti dalam menjalankan tugasnya','1.	Dokumen pertanggungjawaban dinilai kurang relevan \r\n2.	Kerugian APBN yang dikeluarkan Bendahara Pengeluaran sebesar Rp 7.000.000,-',19,2,1,1,0,'2021-02-28 13:45:53','2021-02-28 13:49:00'),(5,332770461,15,'ST-15/PI.01.01/2021','27/01/2021','12/02/2021','KKA AUDIT TW IV Dian Ayu','1.	Terdapat Beberapa SPM belum dilengkapi data pertanggungjawaban yang sesuai 2.	Terdapat Beberapa SPM belum dilengkapi cap dan ttd pihak yang bersangkutan  3.	Kelebihan Pembayaran uang saku diklat  (Detail terlampir dalam KKA )','1.	Undang-Undang Nomor 17 Tahun 2003 tentang Keuangan Negara Pasal 3 ayat (1) yang menyatakan bahwa Keuangan Negara dikelola secara tertib, taat pada peraturan perundang-undangan, efisien, ekonomis, efektif, transparan, dan bertanggung jawab dengan memperhatikan rasa keadilan dan kepatutan Dalam hal ini dokumen pertanggungjawaban keuangan harus mampu menggambarkan pengeluaran anggaran yang akuntabel  2.	Peraturan Menteri Keuangan Republik Indonesia Nomor 78/PMK.02/2019 tentang Standar Biaya Masukan 2020  Penggunaan APBN pada Instansi Setjen Wantannas tidak boleh melebihi standar biaya masukan yang telah ditetapkan khususnya pada pemberian uang saku diklat','1.	Tata Usaha Wabku setiap Unit belum memahami dokumen kelengkapan wabku \r\n2.	Kurangnya SDM pada Bagian Verifikasi \r\n3.	Petugas administrasi pengelola keuangan beserta PPK kurang teliti dalam menjalankan tugasnya','1.	Dokumen pertanggungjawaban dinilai kurang relevan \r\n2.	Kerugian APBN yang dikeluarkan Bendahara Pengeluaran sebesar Rp 7.000.000,-',18,2,1,1,0,'2021-02-28 13:56:54','2021-02-28 13:58:06');
/*!40000 ALTER TABLE `audit_keuangan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_kinerja`
--

DROP TABLE IF EXISTS `audit_kinerja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_kinerja` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `ketua` int(11) NOT NULL,
  `nomor_st` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_audit_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_audit_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_kondisi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_kriteria` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_sebab` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temuan_akibat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `is_status` int(11) NOT NULL,
  `is_publish` int(11) NOT NULL,
  `is_save` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_kinerja`
--

LOCK TABLES `audit_kinerja` WRITE;
/*!40000 ALTER TABLE `audit_kinerja` DISABLE KEYS */;
INSERT INTO `audit_kinerja` VALUES (1,1153396562,25,'1233/ST/WASINT/2020','30/12/2020','30/12/2020','dsadsa','dasdas','dsadas','dsadsa','dsadas',26,1,1,1,0,'2021-02-28 13:29:31','2021-02-28 13:29:31');
/*!40000 ALTER TABLE `audit_kinerja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_tujuan_tertentu`
--

DROP TABLE IF EXISTS `audit_tujuan_tertentu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_tujuan_tertentu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `ketua` int(11) NOT NULL,
  `nomor_st` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_audit_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_audit_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_kondisi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_kriteria` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_sebab` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_akibat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `is_status` int(11) NOT NULL,
  `is_publish` int(11) NOT NULL,
  `is_save` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_tujuan_tertentu`
--

LOCK TABLES `audit_tujuan_tertentu` WRITE;
/*!40000 ALTER TABLE `audit_tujuan_tertentu` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_tujuan_tertentu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dasar_nodins`
--

DROP TABLE IF EXISTS `dasar_nodins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dasar_nodins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_nodin` int(11) NOT NULL,
  `dasar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dasar_nodins`
--

LOCK TABLES `dasar_nodins` WRITE;
/*!40000 ALTER TABLE `dasar_nodins` DISABLE KEYS */;
/*!40000 ALTER TABLE `dasar_nodins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dokumentasi`
--

DROP TABLE IF EXISTS `dokumentasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dokumentasi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dokumentasi` int(11) NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kepada` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tentang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_nodim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `is_status` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dokumentasi`
--

LOCK TABLES `dokumentasi` WRITE;
/*!40000 ALTER TABLE `dokumentasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `dokumentasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluasi`
--

DROP TABLE IF EXISTS `evaluasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluasi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `evaluasi` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `nomor_st` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_evaluasi_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_evaluasi_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluasi`
--

LOCK TABLES `evaluasi` WRITE;
/*!40000 ALTER TABLE `evaluasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluasi_iacm`
--

DROP TABLE IF EXISTS `evaluasi_iacm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluasi_iacm` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `ketua` int(11) NOT NULL,
  `nomor_st` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_evaluasi_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_evaluasi_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_penjelasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `is_status` int(11) NOT NULL,
  `is_publish` int(11) NOT NULL,
  `is_save` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluasi_iacm`
--

LOCK TABLES `evaluasi_iacm` WRITE;
/*!40000 ALTER TABLE `evaluasi_iacm` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluasi_iacm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluasi_reformasi_birokrasi`
--

DROP TABLE IF EXISTS `evaluasi_reformasi_birokrasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluasi_reformasi_birokrasi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `ketua` int(11) NOT NULL,
  `nomor_st` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_evaluasi_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_evaluasi_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_penjelasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `is_status` int(11) NOT NULL,
  `is_publish` int(11) NOT NULL,
  `is_save` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluasi_reformasi_birokrasi`
--

LOCK TABLES `evaluasi_reformasi_birokrasi` WRITE;
/*!40000 ALTER TABLE `evaluasi_reformasi_birokrasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluasi_reformasi_birokrasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluasi_sakip`
--

DROP TABLE IF EXISTS `evaluasi_sakip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluasi_sakip` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `ketua` int(11) NOT NULL,
  `nomor_st` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_evaluasi_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_evaluasi_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_penjelasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `is_status` int(11) NOT NULL,
  `is_publish` int(11) NOT NULL,
  `is_save` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluasi_sakip`
--

LOCK TABLES `evaluasi_sakip` WRITE;
/*!40000 ALTER TABLE `evaluasi_sakip` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluasi_sakip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluasi_spip`
--

DROP TABLE IF EXISTS `evaluasi_spip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluasi_spip` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `ketua` int(11) NOT NULL,
  `nomor_st` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_evaluasi_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_evaluasi_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_penjelasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `is_status` int(11) NOT NULL,
  `is_publish` int(11) NOT NULL,
  `is_save` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluasi_spip`
--

LOCK TABLES `evaluasi_spip` WRITE;
/*!40000 ALTER TABLE `evaluasi_spip` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluasi_spip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foreign_pkpt`
--

DROP TABLE IF EXISTS `foreign_pkpt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foreign_pkpt` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `pkpt` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foreign_pkpt`
--

LOCK TABLES `foreign_pkpt` WRITE;
/*!40000 ALTER TABLE `foreign_pkpt` DISABLE KEYS */;
INSERT INTO `foreign_pkpt` VALUES (1,607324224,5,'2021-02-24 07:09:10','2021-02-24 07:09:10'),(2,1487958098,5,'2021-02-24 07:18:15','2021-02-24 07:18:15'),(3,2005830167,5,'2021-02-24 07:25:56','2021-02-24 07:25:56'),(4,206206379,5,'2021-02-24 07:25:58','2021-02-24 07:25:58'),(5,1714138254,5,'2021-02-24 07:31:59','2021-02-24 07:31:59'),(6,620318257,10,'2021-02-24 07:37:52','2021-02-24 07:37:52'),(7,523037181,32,'2021-02-24 11:41:39','2021-02-24 11:41:39'),(8,1713134185,37,'2021-02-24 11:43:29','2021-02-24 11:43:29'),(9,1010140544,23,'2021-02-24 11:48:35','2021-02-24 11:48:35'),(10,1028374248,23,'2021-02-24 11:50:27','2021-02-24 11:50:27'),(11,388337942,23,'2021-02-24 11:52:38','2021-02-24 11:52:38'),(12,418053093,2,'2021-02-25 08:56:37','2021-02-25 08:56:37'),(13,1004958869,1,'2021-02-25 08:59:53','2021-02-25 08:59:53'),(14,1349810612,10,'2021-02-25 09:05:52','2021-02-25 09:05:52'),(15,277200254,10,'2021-02-25 09:08:27','2021-02-25 09:08:27'),(16,1980106091,1,'2021-02-25 12:35:28','2021-02-25 12:35:28'),(17,2117564199,22,'2021-02-27 11:43:33','2021-02-27 11:43:33'),(18,1471587921,22,'2021-02-27 11:50:49','2021-02-27 11:50:49'),(19,2023254040,1,'2021-02-28 13:45:53','2021-02-28 13:45:53'),(20,332770461,1,'2021-02-28 13:56:54','2021-02-28 13:56:54'),(21,649990471,10,'2021-02-28 14:42:09','2021-02-28 14:42:09'),(22,1470369557,10,'2021-02-28 14:44:27','2021-02-28 14:44:27');
/*!40000 ALTER TABLE `foreign_pkpt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `golongan`
--

DROP TABLE IF EXISTS `golongan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `golongan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `golongan`
--

LOCK TABLES `golongan` WRITE;
/*!40000 ALTER TABLE `golongan` DISABLE KEYS */;
INSERT INTO `golongan` VALUES (1,'Ia','2021-02-24 01:49:56','2021-02-24 01:49:56'),(2,'Ib','2021-02-24 01:49:56','2021-02-24 01:49:56'),(3,'Ic','2021-02-24 01:49:56','2021-02-24 01:49:56'),(4,'IIa','2021-02-24 01:49:56','2021-02-24 01:49:56'),(5,'IIb','2021-02-24 01:49:56','2021-02-24 01:49:56'),(6,'IIIa','2021-02-24 01:49:56','2021-02-24 01:49:56'),(7,'IVa','2021-02-24 01:49:56','2021-02-24 01:49:56'),(8,'Va','2021-02-24 01:49:56','2021-02-24 01:49:56'),(9,'VIa','2021-02-24 01:49:56','2021-02-24 01:49:56');
/*!40000 ALTER TABLE `golongan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ketua` int(11) NOT NULL,
  `pengendali` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` VALUES (1,7,1,'2021-02-24 01:49:56','2021-02-24 01:49:56'),(2,4,2,'2021-02-24 01:49:56','2021-02-24 01:49:56'),(8,13,3,NULL,NULL),(9,14,4,NULL,NULL),(10,15,5,NULL,NULL),(11,16,6,NULL,NULL),(12,17,7,NULL,NULL),(14,13,3,NULL,NULL),(15,14,4,NULL,NULL),(16,15,5,NULL,NULL),(17,16,6,NULL,NULL),(18,17,7,NULL,NULL),(19,25,9,NULL,NULL),(20,25,9,NULL,NULL),(21,27,10,NULL,NULL);
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `input_pkpt`
--

DROP TABLE IF EXISTS `input_pkpt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `input_pkpt` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` int(11) NOT NULL,
  `biaya` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `output` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `volume` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anggaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `realisasi_output` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `realisasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saldo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `input_pkpt`
--

LOCK TABLES `input_pkpt` WRITE;
/*!40000 ALTER TABLE `input_pkpt` DISABLE KEYS */;
INSERT INTO `input_pkpt` VALUES (1,'Layanan Audit','Pemeriksaan Atas Penggunaan Dana APBN','521211',1,'8400000','4','120 OK',NULL,NULL,NULL,'8400000','21','2021-02-24 04:09:48','2021-02-24 04:09:48'),(2,'Layanan Audit','Pemeriksaan Atas Penggunaan Dana APBN','522151',1,'12800000','0','0',NULL,NULL,NULL,'12800000','21','2021-02-24 04:10:32','2021-02-24 04:10:32'),(3,'Layanan Audit','Pemeriksaan Atas BMN','521211',2,'2100000','1','30 OK',NULL,NULL,NULL,'2100000','21','2021-02-24 04:11:43','2021-02-24 04:11:43'),(4,'Layanan Audit','Pemeriksaan Atas BMN','522151',1,'6400000','0','0',NULL,NULL,NULL,'6400000','21','2021-02-24 04:13:12','2021-02-24 04:13:12'),(5,'Layanan Reviu','Reviu Laporan Keuangan','521211',4,'8400000','4','120 OK',NULL,NULL,NULL,'8400000','21','2021-02-24 04:14:24','2021-02-24 04:14:24'),(6,'Layanan Reviu','Reviu RKA-KL','521211',5,'7840000','4','112 OK',NULL,NULL,NULL,'7840000','21','2021-02-24 04:15:48','2021-02-24 04:15:48'),(7,'Layanan Reviu','Reviu RKBMN','521211',7,'2100000','1','30 OK',NULL,NULL,NULL,'2100000','21','2021-02-24 04:16:57','2021-02-24 04:16:57'),(8,'Layanan Reviu','Reviu Pengelolaan Anggaran','521211',5,'7840000','4','112 OK',NULL,NULL,NULL,'7840000','21','2021-02-24 04:17:59','2021-02-24 04:17:59'),(9,'Layanan Reviu','Reviu Pengelolaan Anggaran','522151',5,'9600000','0','0',NULL,NULL,NULL,'9600000','21','2021-02-24 04:19:31','2021-02-24 04:19:31'),(10,'Layanan Reviu','Reviu Laporan Akuntabilitas Kinerja Instansi Pemerintah (LAKIP)','521211',6,'2100000','1','2100000',NULL,NULL,NULL,'2100000','21','2021-02-24 04:20:58','2021-02-24 04:20:58'),(12,'Evaluasi','Evaluasi Penilaian Mandiri Pelaksanaan Reformasai Birokrasi (PMPRB)','521211',9,'11200000','1','160 OK',NULL,NULL,NULL,'11200000','21','2021-02-24 04:26:12','2021-02-24 04:26:12'),(13,'Evaluasi','Evaluasi Sistem Akuntabilitas Kinerja Instansi Pemerintah (SAKIP)','521211',8,'4200000','1','60 OK',NULL,NULL,NULL,'4200000','21','2021-02-24 04:26:51','2021-02-24 04:26:51'),(14,'Evaluasi','Evaluasi Sistem Akuntabilitas Kinerja Instansi Pemerintah (SAKIP)','522151',8,'6400000','0','0',NULL,NULL,NULL,'6400000','21','2021-02-24 04:27:29','2021-02-24 04:27:29'),(15,'Evaluasi','Penilaian Kapabilitas APIP Melalui Penilaian Internal Audit Capability Model) IACM','521211',11,'6720000','1','96 OK',NULL,NULL,NULL,'6720000','21','2021-02-24 04:35:36','2021-02-24 04:35:36'),(16,'Evaluasi','Penilaian Kapabilitas APIP Melalui Penilaian Internal Audit Capability Model) IACM','522151',11,'28800000','0','0',NULL,NULL,NULL,'28800000','21','2021-02-24 04:36:16','2021-02-24 04:36:16'),(17,'Evaluasi','Peningkatan Maturitas (Sistem Pengendalian Intern Pemerintah (SPIP)','521211',10,'11200000','1','160 OK',NULL,NULL,NULL,'11200000','21','2021-02-24 04:37:25','2021-02-24 04:37:25'),(18,'Evaluasi','Peningkatan Maturitas (Sistem Pengendalian Intern Pemerintah (SPIP)','522151',10,'28800000','0','0',NULL,NULL,NULL,'28800000','21','2021-02-24 04:38:11','2021-02-24 04:38:11'),(19,'Evaluasi','Penilaian Zona Integritas','521211',9,'6300000','1','90 OK',NULL,NULL,NULL,'6300000','21','2021-02-24 04:38:56','2021-02-24 04:38:56'),(20,'Evaluasi','Penilaian Zona Integritas','522151',9,'12800000','0','32 OJ',NULL,NULL,NULL,'12800000','21','2021-02-24 04:39:47','2021-02-24 04:39:47'),(21,'Evaluasi','Manajemen Risiko','521211',9,'5600000','1','80 OK',NULL,NULL,NULL,'5600000','21','2021-02-24 04:40:26','2021-02-24 04:40:26'),(22,'Pemantauan','Pemantauan Penyelenggaraan Sistem Pengendalian Intern Pemerintah (SPIP)','521211',14,'4200000','1','60 OK',NULL,NULL,NULL,'4200000','21','2021-02-24 04:41:21','2021-02-24 04:41:21'),(23,'Pemantauan','Pemantauan Rekomendasi Hasil Temuan BPK','521211',12,'2100000','1','30 OK',NULL,NULL,NULL,'2100000','21','2021-02-24 04:42:07','2021-02-24 04:42:07'),(25,'Pemantauan','Pemantuan Rekomendasi Hasil Pengawasan Internal','521211',13,'4200000','1','60 OK',NULL,NULL,NULL,'4200000','21','2021-02-24 05:13:59','2021-02-24 05:13:59'),(33,'Asistensi','Penyusunan Pedoman Pengawasan','521211',16,'8400000','4','120 OK',NULL,NULL,NULL,'8400000','21','2021-02-24 05:23:24','2021-02-24 05:23:24'),(34,'Asistensi','Penyusunan Pedoman Pengawasan','522151',16,'25600000','0','64 OJ',NULL,NULL,NULL,'25600000','21','2021-02-24 05:24:20','2021-02-24 05:24:20'),(35,'Asistensi','Evaluasi dan Pelaporan Hasil Pengawasan','522151',16,'12800000','0','32 OJ',NULL,NULL,NULL,'12800000','21','2021-02-24 05:25:15','2021-02-24 05:25:15'),(36,'Asistensi','Evaluasi dan Pelaporan Hasil Pengawasan','524113',16,'7200000','0','48 OK',NULL,NULL,NULL,'7200000','21','2021-02-24 05:26:13','2021-02-24 05:26:13'),(37,'Evaluasi','Evaluasi SAKIP','0',20,'0','0','0',NULL,NULL,NULL,'0','16','2021-02-24 11:38:35','2021-02-24 11:38:35'),(38,'Pengawasan Lainnya - Rev 1','Pengawasan Lainnya - Rev 1','521211',17,'14000000','4','200 OK',NULL,NULL,NULL,'14000000','21','2021-02-27 11:31:07','2021-02-27 11:31:07'),(39,'Pengawasan Lainnya - Rev 1','Pengawasan Lainnya - Rev 1','522151',17,'6400000','4','16 OJ',NULL,NULL,NULL,'6400000','21','2021-02-27 11:32:06','2021-02-27 11:32:06'),(40,'Pemantauan Rev 1','Pemantauan LHKASN Rev 1','521211',15,'2240000','1','32 OK',NULL,NULL,NULL,'2240000','21','2021-02-27 11:34:38','2021-02-27 11:34:38'),(41,'Asistensi','Penyusunan Dokumen Rencana Pengawasan Rev 1','521211',18,'4239000','1','60 OK',NULL,NULL,NULL,'4239000','21','2021-02-27 11:37:43','2021-02-27 11:37:43');
/*!40000 ALTER TABLE `input_pkpt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jabatan`
--

DROP TABLE IF EXISTS `jabatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jabatan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jabatan`
--

LOCK TABLES `jabatan` WRITE;
/*!40000 ALTER TABLE `jabatan` DISABLE KEYS */;
INSERT INTO `jabatan` VALUES (1,'Super Admin','2021-02-24 01:49:51','2021-02-24 01:49:51'),(2,'Sesjen','2021-02-24 01:49:52','2021-02-24 01:49:52'),(3,'Deputi  Bidang Politik dan Strategi','2021-02-24 01:49:52','2021-02-24 01:49:52'),(4,'Deputi Bidang Pengembangan','2021-02-24 01:49:52','2021-02-24 01:49:52'),(5,'Deputi Bidang Pengkajian dan Penginderaan','2021-02-24 01:49:52','2021-02-24 01:49:52'),(6,'Deputi Bidang Sistem Nasional','2021-02-24 01:49:52','2021-02-24 01:49:52'),(7,'Staf Ahli Bidang Ilmu Pengetahuan dan Teknologi','2021-02-24 01:49:52','2021-02-24 01:49:52'),(8,'Staf Ahli Bidang Ekonomi','2021-02-24 01:49:52','2021-02-24 01:49:52'),(9,'Staf Ahli Bidang Sosial Budaya','2021-02-24 01:49:52','2021-02-24 01:49:52'),(10,'Staf Ahli Bidang Pertahanan Keamanan','2021-02-24 01:49:52','2021-02-24 01:49:52'),(11,'Staf Ahli Bidang Hukum','2021-02-24 01:49:52','2021-02-24 01:49:52'),(12,'Pembantu Deputi  Urusan Lingkungan Strategis Regional','2021-02-24 01:49:52','2021-02-24 01:49:52'),(13,'Pembantu Deputi Urusan Strategi Nasional','2021-02-24 01:49:52','2021-02-24 01:49:52'),(14,'Pembantu Deputi Urusan Politik Nasional','2021-02-24 01:49:52','2021-02-24 01:49:52'),(15,'Pembantu Deputi  Urusan Lingkungan Strategis Internasional','2021-02-24 01:49:52','2021-02-24 01:49:52'),(16,'Pembantu Deputi Urusan Hukum dan Perundang-Undangan','2021-02-24 01:49:52','2021-02-24 01:49:52'),(17,'Pembantu Deputi Urusan Lingkungan Pemerintahan Negara','2021-02-24 01:49:52','2021-02-24 01:49:52'),(18,'Pembantu Deputi Urusan Ekonomi','2021-02-24 01:49:52','2021-02-24 01:49:52'),(19,'Pembantu Deputi Urusan Informasi dan Pengolahan Data','2021-02-24 01:49:52','2021-02-24 01:49:52'),(20,'Pembantu Deputi Urusan Pertahanan dan Keamanan','2021-02-24 01:49:52','2021-02-24 01:49:52'),(21,'Pembantu Deputi Urusan Lingkungan Sosial','2021-02-24 01:49:52','2021-02-24 01:49:52'),(22,'Pembantu Deputi  Urusan Lingkungan Strategis Nasional','2021-02-24 01:49:52','2021-02-24 01:49:52'),(23,'Pembantu Deputi  Urusan Perencanaan Kontinjensi','2021-02-24 01:49:52','2021-02-24 01:49:52'),(24,'Pembantu Deputi Urusan Lingkungan Alam','2021-02-24 01:49:52','2021-02-24 01:49:52'),(25,'Pembantu Deputi Urusan Sosial Budaya','2021-02-24 01:49:52','2021-02-24 01:49:52'),(26,'Kepala Biro Umum','2021-02-24 01:49:52','2021-02-24 01:49:52'),(27,'Kepala Biro Perencanaan, Organisasi dan Keuangan','2021-02-24 01:49:52','2021-02-24 01:49:52'),(28,'Kepala Biro Persidangan, Sistem Informasi, dan Pengawasan Internal','2021-02-24 01:49:52','2021-02-24 01:49:52'),(29,'Analis Kebijakan Bidang Pengembangan Keuangan dan Moneter','2021-02-24 01:49:52','2021-02-24 01:49:52'),(30,'Analis Kebijakan Bidang Pengembangan Perundang-undangan','2021-02-24 01:49:52','2021-02-24 01:49:52'),(31,'Analis Kebijakan Bidang Ekonomi Internasional','2021-02-24 01:49:52','2021-02-24 01:49:52'),(32,'Analis Kebijakan Bidang Perencanaan Strategi Pembangunan Nasional Jangka Panjang','2021-02-24 01:49:52','2021-02-24 01:49:52'),(33,'Analis Kebijakan Bidang Evaluasi dan Toleransi Risiko Pembangunan Nasional','2021-02-24 01:49:52','2021-02-24 01:49:52'),(34,'Analis Kebijakan Bidang Pengembangan Mobilisasi dan Demobilisasi','2021-02-24 01:49:52','2021-02-24 01:49:52'),(35,'Analis Kebijakan Bidang Pengumpulan dan Pengolahan Data Politik Nasional','2021-02-24 01:49:52','2021-02-24 01:49:52'),(36,'Analis Kebijakan Bidang Sumber Daya Manusia','2021-02-24 01:49:52','2021-02-24 01:49:52'),(37,'Analis Kebijakan Bidang Pengembangan Bela Negara','2021-02-24 01:49:52','2021-02-24 01:49:52'),(38,'Analis Kebijakan Bidang Pengembangan Militer dan Kepolisian','2021-02-24 01:49:52','2021-02-24 01:49:52'),(39,'Analis Kebijakan Bidang Rencana Kontinjensi Ekonomi','2021-02-24 01:49:52','2021-02-24 01:49:52'),(40,'Analis Kebijakan Bidang Sektor Riil','2021-02-24 01:49:52','2021-02-24 01:49:52'),(41,'Analis Kebijakan Bidang Sosial Budaya Regional','2021-02-24 01:49:52','2021-02-24 01:49:52'),(42,'Analis Kebijakan Bidang Pengembangan Jasa dan Pariwisata','2021-02-24 01:49:52','2021-02-24 01:49:52'),(43,'Analis Kebijakan Bidang Kelembagaan','2021-02-24 01:49:52','2021-02-24 01:49:52'),(44,'Analis Kebijakan Bidang Sumber Daya Alam','2021-02-24 01:49:52','2021-02-24 01:49:52'),(45,'Analis Kebijakan Bidang Pengembangan Hukum','2021-02-24 01:49:52','2021-02-24 01:49:52'),(46,'Analis Kebijakan Bidang Geografi','2021-02-24 01:49:52','2021-02-24 01:49:52'),(47,'Analis Kebijakan Bidang Politik Keamanan','2021-02-24 01:49:52','2021-02-24 01:49:52'),(48,'Analis Kebijakan Bidang Telematika','2021-02-24 01:49:52','2021-02-24 01:49:52'),(49,'Analis Kebijakan Bidang Sosial Ekonomi','2021-02-24 01:49:52','2021-02-24 01:49:52'),(50,'Analis Kebijakan Bidang Politik Keamanan Regional','2021-02-24 01:49:52','2021-02-24 01:49:52'),(51,'Analis Kebijakan Bidang Sosial Budaya Nasional','2021-02-24 01:49:52','2021-02-24 01:49:52'),(52,'Analis Kebijakan Bidang Rencana Kontinjensi Politik dan Keamanan','2021-02-24 01:49:52','2021-02-24 01:49:52'),(53,'Analis Kebijakan Bidang Pengembangan Penegakan Hukum','2021-02-24 01:49:52','2021-02-24 01:49:52'),(54,'Analis Kebijakan Bidang Perumusan Pengkajian Politik Nasional','2021-02-24 01:49:52','2021-02-24 01:49:52'),(55,'Analis Kebijakan Bidang Ekonomi Regional','2021-02-24 01:49:52','2021-02-24 01:49:52'),(56,'Analis Kebijakan Bidang Politik Keamanan Nasional','2021-02-24 01:49:52','2021-02-24 01:49:52'),(57,'Analis Kebijakan Bidang Ekonomi Nasional','2021-02-24 01:49:52','2021-02-24 01:49:52'),(58,'Analis Kebijakan Bidang Politik Keamanan Internasional','2021-02-24 01:49:52','2021-02-24 01:49:52'),(59,'Analis Kebijakan Bidang Rencana Pembangunan Nasional Jangka Sedang dan Pendek','2021-02-24 01:49:52','2021-02-24 01:49:52'),(60,'Analis Kebijakan Bidang Monitoring dan Evaluasi Politik Nasional','2021-02-24 01:49:52','2021-02-24 01:49:52'),(61,'Analis Kebijakan Bidang Sosial Budaya Internasional','2021-02-24 01:49:52','2021-02-24 01:49:52'),(62,'Analis Kebijakan Bidang Demografi','2021-02-24 01:49:52','2021-02-24 01:49:52'),(63,'Analis Kebijakan Bidang Sosial Budaya','2021-02-24 01:49:52','2021-02-24 01:49:52'),(64,'Analis Kebijakan Bidang Pullah Info','2021-02-24 01:49:52','2021-02-24 01:49:52'),(65,'Analis Kebijakan Bidang Rencana Kontinjensi Sosial Budaya','2021-02-24 01:49:52','2021-02-24 01:49:52'),(66,'Analis Kebijakan Bidang Keagamaan','2021-02-24 01:49:52','2021-02-24 01:49:52'),(67,'Analis Kebijakan Bidang Kesejahteraan Sosial','2021-02-24 01:49:52','2021-02-24 01:49:52'),(68,'Kabag TU dan Protokol Biro Umum','2021-02-24 01:49:52','2021-02-24 01:49:52'),(69,'Kabag Perlengkapan dan Pengadaan Barang/Jasa ','2021-02-24 01:49:52','2021-02-24 01:49:52'),(70,'Kabag Sistem Informasi Biro PSP','2021-02-24 01:49:52','2021-02-24 01:49:52'),(71,'Kabag Perencanaan Biro POK','2021-02-24 01:49:52','2021-02-24 01:49:52'),(72,'Analis Kebijakan Ahli Madya Koordinator Kelompok Organisasi dan Tata Laksana','2021-02-24 01:49:52','2021-02-24 01:49:52'),(73,'Auditor Ahli Madya  Koordinator Kelompok Pengawasan Internal Biro PSP','2021-02-24 01:49:52','2021-02-24 01:49:52'),(74,'Analis Kepegawaian Ahli Madya  Koordinator Kelompok Kepegawaian dan Hukum','2021-02-24 01:49:52','2021-02-24 01:49:52'),(75,'Analis Pengelolaan Keuangan APBN Ahli Madya  Koordinator Kelompok Keuangan','2021-02-24 01:49:52','2021-02-24 01:49:52'),(76,'Arsiparis Ahli Muda Sub Koordinator Kelompok TU ','2021-02-24 01:49:52','2021-02-24 01:49:52'),(77,'Analis Pengelolaan Keuangan APBN Ahli Muda Sub Koordinator','2021-02-24 01:49:53','2021-02-24 01:49:53'),(78,'Pengelola Pengadaan Barang dan Jasa Ahli Muda Sub Koordinator Kelompok Barang Milik Negara','2021-02-24 01:49:53','2021-02-24 01:49:53'),(79,'Pranata Humas Ahli Muda Sub Koordinator Kelompok Hubungan Media dan Publikasi','2021-02-24 01:49:53','2021-02-24 01:49:53'),(80,'Pranata Komputer Ahli Muda Sub Koordinator Kelompok Data dan Keamanan Informasi','2021-02-24 01:49:53','2021-02-24 01:49:53'),(81,'Arsiparis Ahli Muda Sub Koordinator Kelompok TU','2021-02-24 01:49:53','2021-02-24 01:49:53'),(82,'Perencana Ahli Muda Sub Koordinator Kelompok Rencana Program dan Kinerja','2021-02-24 01:49:53','2021-02-24 01:49:53'),(83,'Arsiparis Ahli Muda  Sub Koordinator','2021-02-24 01:49:53','2021-02-24 01:49:53'),(84,'Analis Pengelolaan Keuangan APBN Ahli Muda','2021-02-24 01:49:53','2021-02-24 01:49:53'),(85,'Arsiparis Ahli Muda','2021-02-24 01:49:53','2021-02-24 01:49:53'),(86,'Pengelola Pengadaan Barang dan Jasa Ahli Muda','2021-02-24 01:49:53','2021-02-24 01:49:53'),(87,'Penata Humas Ahli Muda','2021-02-24 01:49:53','2021-02-24 01:49:53'),(88,'Arsiparis Ahli Muda ','2021-02-24 01:49:53','2021-02-24 01:49:53'),(89,'Analis Kebijakan Ahli Muda','2021-02-24 01:49:53','2021-02-24 01:49:53'),(90,'Pustakawan Ahli Muda','2021-02-24 01:49:53','2021-02-24 01:49:53'),(91,'Perencana Ahli Muda','2021-02-24 01:49:53','2021-02-24 01:49:53'),(92,'Analis Kepegawaian Ahli Muda','2021-02-24 01:49:53','2021-02-24 01:49:53'),(93,'Pranata Komputer Ahli Muda','2021-02-24 01:49:53','2021-02-24 01:49:53'),(94,'Analis Pengelolaan Keuangan APBN Ahli Muda','2021-02-24 01:49:53','2021-02-24 01:49:53'),(95,'Penyuluh Kearsipan','2021-02-24 01:49:53','2021-02-24 01:49:53'),(96,'Analis Tata Usaha','2021-02-24 01:49:53','2021-02-24 01:49:53'),(97,'Analis Sistem Informasi Sub Kelompok Data dan Keamanan Informasi','2021-02-24 01:49:53','2021-02-24 01:49:53'),(98,'Analis Perbendaharaan','2021-02-24 01:49:53','2021-02-24 01:49:53'),(99,'Analis Manajemen Perkantoran','2021-02-24 01:49:53','2021-02-24 01:49:53'),(100,'Pemeriksa Pelaporan dan Transaksi Keuangan','2021-02-24 01:49:53','2021-02-24 01:49:53'),(101,'Penelaah Kebijakan Pengadaan Barang/Jasa','2021-02-24 01:49:53','2021-02-24 01:49:53'),(102,'Analis Kebijakan BMN','2021-02-24 01:49:53','2021-02-24 01:49:53'),(103,'Analis Hukum','2021-02-24 01:49:53','2021-02-24 01:49:53'),(104,'Auditor Ahli Pertama Kelompok Pengawasan Internal Biro PSP','2021-02-24 01:49:53','2021-02-24 01:49:53'),(105,'Analis Keuangan Sub Kelompok Verifikasi Kelompok Keuangan Biro POK','2021-02-24 01:49:53','2021-02-24 01:49:53'),(106,'Analis Laporan Hasil Pengawasan Sub Kelompok Tata Usaha Kelompok Pengawasan Internal Biro PSP','2021-02-24 01:49:53','2021-02-24 01:49:53'),(107,'Analis Kelembagaan','2021-02-24 01:49:53','2021-02-24 01:49:53'),(108,'Analis Persandian','2021-02-24 01:49:53','2021-02-24 01:49:53'),(109,'Analis Organisasi dan Tata Laksana','2021-02-24 01:49:53','2021-02-24 01:49:53'),(110,'Analis Rencana Program dan Kegiatan Sub Kelompok Rencana Program dan Kinerja Kelompok Perencanaan Biro POK','2021-02-24 01:49:53','2021-02-24 01:49:53'),(111,'Analis Laporan Akuntabilitas Kinerja ','2021-02-24 01:49:53','2021-02-24 01:49:53'),(112,'Analis Sistem Informasi Perbendaharaan ','2021-02-24 01:49:53','2021-02-24 01:49:53'),(113,'Analis Sumber Daya Manusia ','2021-02-24 01:49:53','2021-02-24 01:49:53'),(114,'Analis Konsultasi dan Bantuan Hukum','2021-02-24 01:49:53','2021-02-24 01:49:53'),(115,'Penyusun Norma Standar Prosedur dan Kriteria ','2021-02-24 01:49:53','2021-02-24 01:49:53'),(116,'Analis Publikasi','2021-02-24 01:49:53','2021-02-24 01:49:53'),(117,'Analis Hubungan Antar Lembaga','2021-02-24 01:49:53','2021-02-24 01:49:53'),(118,'Analis Sumber Daya Manusia Aparatur','2021-02-24 01:49:53','2021-02-24 01:49:53'),(119,'Penata Keuangan ','2021-02-24 01:49:53','2021-02-24 01:49:53'),(120,'Pengelola Layanan Pengadaan','2021-02-24 01:49:53','2021-02-24 01:49:53'),(121,'Pengelola Keuangan','2021-02-24 01:49:53','2021-02-24 01:49:53'),(122,'Bendahara','2021-02-24 01:49:53','2021-02-24 01:49:53'),(123,'Pengadministrasi Sarana dan Prasarana ','2021-02-24 01:49:53','2021-02-24 01:49:53'),(124,'Pengelola Instalasi Teknologi Informasi','2021-02-24 01:49:53','2021-02-24 01:49:53'),(125,'Pengelola Keamanan Sistem Informasi ','2021-02-24 01:49:54','2021-02-24 01:49:54'),(126,'Pranata Komputer Terampil ','2021-02-24 01:49:54','2021-02-24 01:49:54'),(127,'Pengadministrasi Persuratan','2021-02-24 01:49:54','2021-02-24 01:49:54'),(128,'Pengadministrasi Umum','2021-02-24 01:49:54','2021-02-24 01:49:54');
/*!40000 ALTER TABLE `jabatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jenis`
--

DROP TABLE IF EXISTS `jenis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jenis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jenis`
--

LOCK TABLES `jenis` WRITE;
/*!40000 ALTER TABLE `jenis` DISABLE KEYS */;
INSERT INTO `jenis` VALUES (1,'Audit Keuangan','2021-02-24 01:49:56','2021-02-24 01:49:56'),(2,'Audit Kinerja','2021-02-24 01:49:56','2021-02-24 01:49:56'),(3,'Audit Tujuan Tertentu','2021-02-24 01:49:56','2021-02-24 01:49:56'),(4,'Reviu Laporan Keuangan','2021-02-24 01:49:56','2021-02-24 01:49:56'),(5,'Reviu Kegiatan Anggaran','2021-02-24 01:49:56','2021-02-24 01:49:56'),(6,'Reviu LAKIP','2021-02-24 01:49:56','2021-02-24 01:49:56'),(7,'Reviu RKBMN','2021-02-24 01:49:56','2021-02-24 01:49:56'),(8,'Evaluasi SAKIP','2021-02-24 01:49:56','2021-02-24 01:49:56'),(9,'Evaluasi RB','2021-02-24 01:49:56','2021-02-24 01:49:56'),(10,'Maturitas SPIP','2021-02-24 01:49:56','2021-02-24 01:49:56'),(11,'IACM','2021-02-24 01:49:56','2021-02-24 01:49:56'),(12,'Pemantauan TL BPK','2021-02-24 01:49:56','2021-02-24 01:49:56'),(13,'Pemantauan TL LHA','2021-02-24 01:49:56','2021-02-24 01:49:56'),(14,'Pemantauan SPIP','2021-02-24 01:49:56','2021-02-24 01:49:56'),(15,'Pemantauan LHKASN','2021-02-24 01:49:56','2021-02-24 01:49:56'),(16,'Pengawasan Konsultasi','2021-02-24 01:49:56','2021-02-24 01:49:56'),(17,'Pengawasan Sosialisasi','2021-02-24 01:49:56','2021-02-24 01:49:56'),(18,'Pengawasan Asistensi','2021-02-24 01:49:56','2021-02-24 01:49:56'),(19,'Pengawasan RBZI','2021-02-24 01:49:56','2021-02-24 01:49:56'),(20,'Pengawasan SAKIP','2021-02-24 01:49:56','2021-02-24 01:49:56'),(21,'Dokumentasi Notulen','2021-02-24 01:49:56','2021-02-24 01:49:56');
/*!40000 ALTER TABLE `jenis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jenis_laporan`
--

DROP TABLE IF EXISTS `jenis_laporan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jenis_laporan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jenis_laporan`
--

LOCK TABLES `jenis_laporan` WRITE;
/*!40000 ALTER TABLE `jenis_laporan` DISABLE KEYS */;
INSERT INTO `jenis_laporan` VALUES (1,'Unit Pengendalian Gratifikasi','2021-02-24 01:49:55','2021-02-24 01:49:55');
/*!40000 ALTER TABLE `jenis_laporan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kertas_audit_keuangans`
--

DROP TABLE IF EXISTS `kertas_audit_keuangans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kertas_audit_keuangans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `audit_keuangan` int(11) NOT NULL,
  `kode_audit_keuangan` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kertas_audit_keuangans`
--

LOCK TABLES `kertas_audit_keuangans` WRITE;
/*!40000 ALTER TABLE `kertas_audit_keuangans` DISABLE KEYS */;
INSERT INTO `kertas_audit_keuangans` VALUES (1,0,1279933403,'ST1584331.pdf','2021-02-24 06:59:52','2021-02-24 06:59:52'),(2,0,1279933403,'KKA TWIV-daniel93685.rar','2021-02-24 06:59:52','2021-02-24 06:59:52'),(3,0,1274593812,'Kertas Kerja Audit TWIV-dian ayu92575.zip','2021-02-24 07:02:36','2021-02-24 07:02:36'),(4,0,1274593812,'ST1560930.pdf','2021-02-24 07:02:36','2021-02-24 07:02:36'),(5,0,331848768,'ST1547152.pdf','2021-02-24 07:05:17','2021-02-24 07:05:17'),(6,0,331848768,'KKA TWIV-daniel84742.rar','2021-02-24 07:05:17','2021-02-24 07:05:17'),(7,0,1904418574,'ST1536703.pdf','2021-02-24 08:17:08','2021-02-24 08:17:08'),(8,0,1904418574,'KKA TWIV-daniel73939.rar','2021-02-24 08:17:08','2021-02-24 08:17:08'),(9,1,418053093,'menu ver424052.pdf','2021-02-25 08:56:37','2021-02-25 08:56:37'),(10,2,1004958869,'menu ver411196.pdf','2021-02-25 08:59:53','2021-02-25 08:59:53'),(11,3,1980106091,'menu ver447004.pdf','2021-02-25 12:35:28','2021-02-25 12:35:28'),(12,0,809550024,'KKA TWIV-daniel78337.rar','2021-02-28 13:22:25','2021-02-28 13:22:25'),(13,0,809550024,'ST1549846.pdf','2021-02-28 13:22:25','2021-02-28 13:22:25'),(14,4,2023254040,'ST1567873.pdf','2021-02-28 13:45:53','2021-02-28 13:45:53'),(15,5,332770461,'ST1568526.pdf','2021-02-28 13:56:54','2021-02-28 13:56:54');
/*!40000 ALTER TABLE `kertas_audit_keuangans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kertas_audit_kinerjas`
--

DROP TABLE IF EXISTS `kertas_audit_kinerjas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kertas_audit_kinerjas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `audit_kinerja` int(11) NOT NULL,
  `kode_audit_kinerja` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kertas_audit_kinerjas`
--

LOCK TABLES `kertas_audit_kinerjas` WRITE;
/*!40000 ALTER TABLE `kertas_audit_kinerjas` DISABLE KEYS */;
INSERT INTO `kertas_audit_kinerjas` VALUES (1,0,1153396562,'menu ver428289.pdf','2021-02-28 13:29:31','2021-02-28 13:29:31');
/*!40000 ALTER TABLE `kertas_audit_kinerjas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kertas_audit_tujuan_tertntus`
--

DROP TABLE IF EXISTS `kertas_audit_tujuan_tertntus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kertas_audit_tujuan_tertntus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `audit_tujuan_tertentu` int(11) NOT NULL,
  `kode_audit_tujuan_tertentu` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kertas_audit_tujuan_tertntus`
--

LOCK TABLES `kertas_audit_tujuan_tertntus` WRITE;
/*!40000 ALTER TABLE `kertas_audit_tujuan_tertntus` DISABLE KEYS */;
/*!40000 ALTER TABLE `kertas_audit_tujuan_tertntus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kertas_evaluasi_iacms`
--

DROP TABLE IF EXISTS `kertas_evaluasi_iacms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kertas_evaluasi_iacms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_evaluasi_iacm` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kertas_evaluasi_iacms`
--

LOCK TABLES `kertas_evaluasi_iacms` WRITE;
/*!40000 ALTER TABLE `kertas_evaluasi_iacms` DISABLE KEYS */;
/*!40000 ALTER TABLE `kertas_evaluasi_iacms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kertas_evaluasi_reformasis`
--

DROP TABLE IF EXISTS `kertas_evaluasi_reformasis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kertas_evaluasi_reformasis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_evaluasi_reformasi` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kertas_evaluasi_reformasis`
--

LOCK TABLES `kertas_evaluasi_reformasis` WRITE;
/*!40000 ALTER TABLE `kertas_evaluasi_reformasis` DISABLE KEYS */;
/*!40000 ALTER TABLE `kertas_evaluasi_reformasis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kertas_evaluasi_sakips`
--

DROP TABLE IF EXISTS `kertas_evaluasi_sakips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kertas_evaluasi_sakips` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_evaluasi_sakip` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kertas_evaluasi_sakips`
--

LOCK TABLES `kertas_evaluasi_sakips` WRITE;
/*!40000 ALTER TABLE `kertas_evaluasi_sakips` DISABLE KEYS */;
/*!40000 ALTER TABLE `kertas_evaluasi_sakips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kertas_evaluasi_spips`
--

DROP TABLE IF EXISTS `kertas_evaluasi_spips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kertas_evaluasi_spips` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_evaluasi_spip` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kertas_evaluasi_spips`
--

LOCK TABLES `kertas_evaluasi_spips` WRITE;
/*!40000 ALTER TABLE `kertas_evaluasi_spips` DISABLE KEYS */;
/*!40000 ALTER TABLE `kertas_evaluasi_spips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kertas_reformasis`
--

DROP TABLE IF EXISTS `kertas_reformasis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kertas_reformasis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_reformasi` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kertas_reformasis`
--

LOCK TABLES `kertas_reformasis` WRITE;
/*!40000 ALTER TABLE `kertas_reformasis` DISABLE KEYS */;
/*!40000 ALTER TABLE `kertas_reformasis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kertas_reviu_anggarans`
--

DROP TABLE IF EXISTS `kertas_reviu_anggarans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kertas_reviu_anggarans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_reviu_anggaran` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kertas_reviu_anggarans`
--

LOCK TABLES `kertas_reviu_anggarans` WRITE;
/*!40000 ALTER TABLE `kertas_reviu_anggarans` DISABLE KEYS */;
/*!40000 ALTER TABLE `kertas_reviu_anggarans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kertas_reviu_keuangans`
--

DROP TABLE IF EXISTS `kertas_reviu_keuangans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kertas_reviu_keuangans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_reviu_keuangan` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kertas_reviu_keuangans`
--

LOCK TABLES `kertas_reviu_keuangans` WRITE;
/*!40000 ALTER TABLE `kertas_reviu_keuangans` DISABLE KEYS */;
INSERT INTO `kertas_reviu_keuangans` VALUES (1,607324224,'Kertas Kerja Reviu LK 2020 TW III-Daniel (1).docx60985.docx','2021-02-24 07:09:08','2021-02-24 07:09:08'),(2,607324224,'ST-25.PI.02.01.2021 Reviu LK.pdf33952.pdf','2021-02-24 07:09:09','2021-02-24 07:09:09'),(3,1487958098,'ST Reviu LK Unaudited.pdf16453.pdf','2021-02-24 07:18:14','2021-02-24 07:18:14'),(4,1487958098,'KKR Bendahara Penerimaan dan Persediaan.docx30857.docx','2021-02-24 07:18:14','2021-02-24 07:18:14'),(5,2005830167,'KKR SELURUH AKUN.docx46018.docx','2021-02-24 07:25:56','2021-02-24 07:25:56'),(6,2005830167,'ST-25.PI.02.01.2021 Reviu LK.pdf13524.pdf','2021-02-24 07:25:56','2021-02-24 07:25:56'),(7,206206379,'KKR FRida Reviu LK Unaudited.docx96755.docx','2021-02-24 07:25:58','2021-02-24 07:25:58'),(8,1714138254,'KKR FRida Reviu LK Unaudited.docx15077.docx','2021-02-24 07:31:59','2021-02-24 07:31:59'),(9,1714138254,'ST-25.PI.02.01.2021 Reviu LK.pdf32832.pdf','2021-02-24 07:31:59','2021-02-24 07:31:59');
/*!40000 ALTER TABLE `kertas_reviu_keuangans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kertas_reviu_lakips`
--

DROP TABLE IF EXISTS `kertas_reviu_lakips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kertas_reviu_lakips` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_reviu_lakip` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kertas_reviu_lakips`
--

LOCK TABLES `kertas_reviu_lakips` WRITE;
/*!40000 ALTER TABLE `kertas_reviu_lakips` DISABLE KEYS */;
INSERT INTO `kertas_reviu_lakips` VALUES (1,620318257,'ST-23.PI.02.04.2021 Reviu LAKIP 2020.pdf34030.pdf','2021-02-24 07:37:52','2021-02-24 07:37:52'),(2,620318257,'Reviu LAKIP.docx11425.docx','2021-02-24 07:37:52','2021-02-24 07:37:52'),(3,749177304,'Reviu LAKIP.docx69095.docx','2021-02-24 07:38:21','2021-02-24 07:38:21'),(4,749177304,'ST-23.PI.02.04.2021 Reviu LAKIP 2020.pdf31889.pdf','2021-02-24 07:38:21','2021-02-24 07:38:21'),(5,1349810612,'menu ver4.pdf14978.pdf','2021-02-25 09:05:52','2021-02-25 09:05:52'),(6,277200254,'menu ver4.pdf64193.pdf','2021-02-25 09:08:27','2021-02-25 09:08:27'),(7,649990471,'menu ver4.pdf40557.pdf','2021-02-28 14:42:08','2021-02-28 14:42:08'),(8,1470369557,'menu ver4.pdf60521.pdf','2021-02-28 14:44:27','2021-02-28 14:44:27');
/*!40000 ALTER TABLE `kertas_reviu_lakips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kertas_reviu_rkbmns`
--

DROP TABLE IF EXISTS `kertas_reviu_rkbmns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kertas_reviu_rkbmns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_reviu_rkbmn` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kertas_reviu_rkbmns`
--

LOCK TABLES `kertas_reviu_rkbmns` WRITE;
/*!40000 ALTER TABLE `kertas_reviu_rkbmns` DISABLE KEYS */;
/*!40000 ALTER TABLE `kertas_reviu_rkbmns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kertas_sakips`
--

DROP TABLE IF EXISTS `kertas_sakips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kertas_sakips` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_sakip` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kertas_sakips`
--

LOCK TABLES `kertas_sakips` WRITE;
/*!40000 ALTER TABLE `kertas_sakips` DISABLE KEYS */;
INSERT INTO `kertas_sakips` VALUES (1,1713134185,'LAKIP 15022021 (EDIT)28745.docx','2021-02-24 11:43:29','2021-02-24 11:43:29');
/*!40000 ALTER TABLE `kertas_sakips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ketua_tim`
--

DROP TABLE IF EXISTS `ketua_tim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ketua_tim` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ketua` int(11) NOT NULL,
  `pengendali_teknis` int(11) NOT NULL,
  `pengendali_mutu` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ketua_tim`
--

LOCK TABLES `ketua_tim` WRITE;
/*!40000 ALTER TABLE `ketua_tim` DISABLE KEYS */;
INSERT INTO `ketua_tim` VALUES (1,7,2,3,'2021-02-24 01:49:56','2021-02-24 01:49:56'),(2,4,2,3,'2021-02-24 01:49:56','2021-02-24 01:49:56'),(3,13,2,3,'2021-02-24 03:44:42','2021-02-24 03:44:42'),(4,14,2,3,'2021-02-24 03:47:09','2021-02-24 03:47:09'),(5,15,2,3,'2021-02-24 03:48:09','2021-02-24 03:48:09'),(6,16,2,3,'2021-02-24 03:51:59','2021-02-24 03:51:59'),(7,17,2,3,'2021-02-24 03:53:31','2021-02-24 03:53:31'),(9,25,2,3,'2021-02-25 08:53:47','2021-02-25 08:53:47'),(10,27,2,3,'2021-02-25 08:58:44','2021-02-25 08:58:44');
/*!40000 ALTER TABLE `ketua_tim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `konsultasi`
--

DROP TABLE IF EXISTS `konsultasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `konsultasi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `pegawai` int(11) NOT NULL,
  `nomor_st` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjelasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `is_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `konsultasi`
--

LOCK TABLES `konsultasi` WRITE;
/*!40000 ALTER TABLE `konsultasi` DISABLE KEYS */;
INSERT INTO `konsultasi` VALUES (1,523037181,23,'0','Reviu LAKIP','Mohon untuk Reviu LAKIP (Terlampir Draft LAKIP)',23,1,1,'2021-02-24 11:41:39','2021-02-24 11:41:39');
/*!40000 ALTER TABLE `konsultasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `koordinasi`
--

DROP TABLE IF EXISTS `koordinasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `koordinasi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `pegawai` int(11) NOT NULL,
  `nomor_st` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjelasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `is_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `koordinasi`
--

LOCK TABLES `koordinasi` WRITE;
/*!40000 ALTER TABLE `koordinasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `koordinasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landasan_hukum_kepsesjens`
--

DROP TABLE IF EXISTS `landasan_hukum_kepsesjens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `landasan_hukum_kepsesjens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_kepsesjen` int(11) NOT NULL,
  `landasan_hukum` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landasan_hukum_kepsesjens`
--

LOCK TABLES `landasan_hukum_kepsesjens` WRITE;
/*!40000 ALTER TABLE `landasan_hukum_kepsesjens` DISABLE KEYS */;
/*!40000 ALTER TABLE `landasan_hukum_kepsesjens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `level`
--

DROP TABLE IF EXISTS `level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `level` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `level`
--

LOCK TABLES `level` WRITE;
/*!40000 ALTER TABLE `level` DISABLE KEYS */;
INSERT INTO `level` VALUES (1,'Ketua Tim','2021-02-24 01:49:55','2021-02-24 01:49:55'),(2,'Anggota Tim','2021-02-24 01:49:55','2021-02-24 01:49:55'),(3,'Pengendali Teknis','2021-02-24 01:49:55','2021-02-24 01:49:55'),(4,'Pengendali Mutu','2021-02-24 01:49:55','2021-02-24 01:49:55'),(5,'Auditan','2021-02-24 01:49:55','2021-02-24 01:49:55'),(6,'Pegawai','2021-02-24 01:49:55','2021-02-24 01:49:55'),(7,'Sekretaris Jenderal','2021-02-24 01:49:55','2021-02-24 01:49:55'),(8,'Super Admin','2021-02-24 01:49:55','2021-02-24 01:49:55');
/*!40000 ALTER TABLE `level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `level` int(11) NOT NULL,
  `dashboard` int(11) NOT NULL,
  `penyerapan` int(11) NOT NULL,
  `penugasan` int(11) NOT NULL,
  `user_admin` int(11) NOT NULL,
  `audit` int(11) NOT NULL,
  `audit_keuangan` int(11) NOT NULL,
  `audit_kinerja` int(11) NOT NULL,
  `audit_tujuan_tertentu` int(11) NOT NULL,
  `reviu` int(11) NOT NULL,
  `reviu_laporan_keuangan` int(11) NOT NULL,
  `reviu_anggaran_kegiatan` int(11) NOT NULL,
  `reviu_lakip` int(11) NOT NULL,
  `reviu_rkbmn` int(11) NOT NULL,
  `evaluasi` int(11) NOT NULL,
  `evaluasi_sakip` int(11) NOT NULL,
  `evaluasi_rb` int(11) NOT NULL,
  `evaluasi_maturitas_spip` int(11) NOT NULL,
  `evaluasi_iacm` int(11) NOT NULL,
  `pemantauan` int(11) NOT NULL,
  `pemantauan_tl_bpk` int(11) NOT NULL,
  `pemantauan_tl_lha` int(11) NOT NULL,
  `pemantauan_spip` int(11) NOT NULL,
  `pemantauan_lhkasn` int(11) NOT NULL,
  `pengawasan_lainnya` int(11) NOT NULL,
  `pengawasan_konsultasi` int(11) NOT NULL,
  `pengawasan_sosialisasi` int(11) NOT NULL,
  `pengawasan_asistensi` int(11) NOT NULL,
  `pengawasan_rbzi` int(11) NOT NULL,
  `pengawasan_sakip` int(11) NOT NULL,
  `dokumentasi` int(11) NOT NULL,
  `dokumentasi_pengajuan_nodin` int(11) NOT NULL,
  `dokumentasi_pengajuan_kepsesjen` int(11) NOT NULL,
  `dokumentasi_input_pkpt` int(11) NOT NULL,
  `dokumentasi_input_notulen` int(11) NOT NULL,
  `laporan` int(11) NOT NULL,
  `laporan_hasil_audit` int(11) NOT NULL,
  `laporan_hasil_kolom_audit` int(11) NOT NULL,
  `laporan_hasil_laporan_audit` int(11) NOT NULL,
  `laporan_hasil_download_audit` int(11) NOT NULL,
  `laporan_hasil_reviu` int(11) NOT NULL,
  `laporan_hasil_kolom_reviu` int(11) NOT NULL,
  `laporan_hasil_laporan_reviu` int(11) NOT NULL,
  `laporan_hasil_download_reviu` int(11) NOT NULL,
  `laporan_hasil_evaluasi` int(11) NOT NULL,
  `laporan_hasil_kolom_evaluasi` int(11) NOT NULL,
  `laporan_hasil_laporan_evaluasi` int(11) NOT NULL,
  `laporan_hasil_download_evaluasi` int(11) NOT NULL,
  `laporan_hasil_pemantauan` int(11) NOT NULL,
  `laporan_hasil_kolom_pemantauan` int(11) NOT NULL,
  `laporan_hasil_laporan_pemantauan` int(11) NOT NULL,
  `laporan_hasil_download_pemantauan` int(11) NOT NULL,
  `laporan_hasil_pengawasan` int(11) NOT NULL,
  `laporan_hasil_kolom_pengawasan` int(11) NOT NULL,
  `laporan_hasil_laporan_pengawasan` int(11) NOT NULL,
  `laporan_hasil_download_pengawasan` int(11) NOT NULL,
  `laporan_hasil_notulen` int(11) NOT NULL,
  `laporan_hasil_kolom_notulen` int(11) NOT NULL,
  `laporan_hasil_laporan_notulen` int(11) NOT NULL,
  `laporan_hasil_download_notulen` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,8,1,1,1,8,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'2021-02-24 01:49:55','2021-02-24 01:49:55'),(2,7,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,7,7,7,7,7,1,1,1,1,1,1,1,1,4,1,1,1,4,1,1,1,4,1,1,1,4,1,1,1,4,1,1,1,4,1,'2021-02-24 01:49:55','2021-02-24 01:49:55'),(3,6,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,7,7,7,7,7,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'2021-02-24 01:49:55','2021-02-24 01:49:55'),(4,5,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,7,7,7,7,7,1,1,1,1,1,1,1,1,4,1,1,1,4,1,1,1,4,1,1,1,4,1,1,1,4,1,1,1,4,1,'2021-02-24 01:49:55','2021-02-24 01:49:55'),(5,2,2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-24 01:49:55','2021-02-24 01:49:55'),(6,1,2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-24 01:49:55','2021-02-24 01:49:55'),(7,3,2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,2,2,2,2,2,5,1,4,4,5,2,4,4,5,2,4,4,5,2,4,4,5,2,4,4,5,2,4,4,'2021-02-24 01:49:55','2021-02-24 01:49:55'),(8,4,2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,2,2,2,2,2,5,1,4,4,5,2,4,4,5,2,4,4,5,2,4,4,5,2,4,4,5,2,4,4,'2021-02-24 01:49:55','2021-02-24 01:49:55');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1336 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1256,'2014_10_12_000000_create_users_table',1),(1257,'2014_10_12_100000_create_password_resets_table',1),(1258,'2019_08_19_000000_create_failed_jobs_table',1),(1259,'2020_12_02_041037_create_jabatan_table',1),(1260,'2020_12_02_041109_create_level_table',1),(1261,'2020_12_02_125519_create_audit_keuangan_table',1),(1262,'2020_12_02_125559_create_audit_kinerja_table',1),(1263,'2020_12_02_125638_create_audit_tujuan_tertentu_table',1),(1264,'2020_12_02_125801_create_reviu_laporan_keuangan_table',1),(1265,'2020_12_02_125843_create_reviu_kegiatan_anggaran_table',1),(1266,'2020_12_02_125925_create_evaluasi_sakip_table',1),(1267,'2020_12_02_130009_create_evaluasi_reformasi_birokrasi_table',1),(1268,'2020_12_02_130043_create_konsultasi_table',1),(1269,'2020_12_02_130103_create_pelatihan_table',1),(1270,'2020_12_02_130119_create_koordinasi_table',1),(1271,'2020_12_02_130159_create_reformasi_birokrasi_table',1),(1272,'2020_12_02_130221_create_sakip_table',1),(1273,'2020_12_02_130245_create_pengajuan_nodim_table',1),(1274,'2020_12_02_130306_create_pengajuan_kepseajen_table',1),(1275,'2020_12_02_130330_create_input_pkpt_table',1),(1276,'2020_12_02_145957_create_approvel_audit_keuangan_table',1),(1277,'2020_12_02_150021_create_approvel_audit_kinerja_table',1),(1278,'2020_12_02_150121_create_approvel_audit_tujuan_tertentu_table',1),(1279,'2020_12_02_152039_create_status_table',1),(1280,'2020_12_05_063443_create_approvel_reviu_laporan_keuangan',1),(1281,'2020_12_05_064244_create_approvel_reviu_kegiatan_anggaran',1),(1282,'2020_12_05_073421_create_approvel_evaluasi_sakip',1),(1283,'2020_12_05_073508_create_approvel_evaluasi_reformasi_birokrasi',1),(1284,'2020_12_05_102701_create_audit',1),(1285,'2020_12_05_102715_create_reviu',1),(1286,'2020_12_05_102755_create_evaluasi',1),(1287,'2020_12_05_112937_create_approvel_konsultasi',1),(1288,'2020_12_06_110932_create_approvel_pelatiahan',1),(1289,'2020_12_06_110949_create_approvel_koordinasi',1),(1290,'2020_12_06_111004_create_approvel_nodim',1),(1291,'2020_12_06_111021_create_approvel_kepsesjen',1),(1292,'2020_12_06_124308_create_jenis_laporan',1),(1293,'2020_12_06_124329_create_priode_laporan',1),(1294,'2020_12_06_130553_create_pengawasan',1),(1295,'2020_12_06_130921_create_dokumentasi',1),(1296,'2020_12_06_132404_create_notullensi',1),(1297,'2020_12_06_132446_create_reviu_lakip',1),(1298,'2020_12_06_132509_create_reviu_rkbmn',1),(1299,'2020_12_06_132526_create_approvel_reviu_lakip',1),(1300,'2020_12_06_132542_create_approvel_reviu_rkbmn',1),(1301,'2020_12_07_120315_create_menu',1),(1302,'2020_12_07_120328_create_submenu',1),(1303,'2020_12_07_125032_create_permission',1),(1304,'2020_12_08_193653_create_evaluasi_spip',1),(1305,'2020_12_08_193720_create_approvel_evaluasi_spip',1),(1306,'2020_12_08_193754_create_approvel_evaluasi_iacm',1),(1307,'2020_12_08_193844_create_evaluasi_iacm',1),(1308,'2020_12_09_192344_create_kertas_audit_keuangans_table',1),(1309,'2020_12_09_211108_create_kertas_audit_kinerjas_table',1),(1310,'2020_12_09_211126_create_kertas_audit_tujuan_tertntus_table',1),(1311,'2020_12_09_211155_create_kertas_reviu_keuangans_table',1),(1312,'2020_12_09_211210_create_kertas_reviu_anggarans_table',1),(1313,'2020_12_09_211222_create_kertas_reviu_lakips_table',1),(1314,'2020_12_09_211243_create_kertas_reviu_rkbmns_table',1),(1315,'2020_12_09_211300_create_kertas_evaluasi_sakips_table',1),(1316,'2020_12_09_211317_create_kertas_evaluasi_reformasis_table',1),(1317,'2020_12_09_211327_create_kertas_evaluasi_spips_table',1),(1318,'2020_12_09_211338_create_kertas_evaluasi_iacms_table',1),(1319,'2020_12_09_211351_create_kertas_reformasis_table',1),(1320,'2020_12_09_211400_create_kertas_sakips_table',1),(1321,'2020_12_09_211418_create_dasar_nodins_table',1),(1322,'2020_12_09_211438_create_landasan_hukum_kepsesjens_table',1),(1323,'2020_12_09_211456_create_peserta_notulens_table',1),(1324,'2020_12_10_105122_create_pemantauan_bpk',1),(1325,'2020_12_10_105135_create_pemantauan_lha',1),(1326,'2020_12_10_105146_create_pemantauan_spip',1),(1327,'2020_12_10_105201_create_pemantauan_lhkasn',1),(1328,'2020_12_10_105655_create_pangkat',1),(1329,'2020_12_10_105708_create_golongan',1),(1330,'2020_12_23_090423_create_anggota_tim',1),(1331,'2020_12_23_090439_create_ketua_tim',1),(1332,'2020_12_23_093356_create_group',1),(1333,'2020_12_27_155035_create_pemantauan',1),(1334,'2020_12_28_084220_create_jenis',1),(1335,'2021_01_11_135322_create_foreign_pkpt_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notullensi`
--

DROP TABLE IF EXISTS `notullensi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notullensi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pukul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pimpinan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kesimpualan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `is_status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notullensi`
--

LOCK TABLES `notullensi` WRITE;
/*!40000 ALTER TABLE `notullensi` DISABLE KEYS */;
/*!40000 ALTER TABLE `notullensi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pangkat`
--

DROP TABLE IF EXISTS `pangkat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pangkat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pangkat`
--

LOCK TABLES `pangkat` WRITE;
/*!40000 ALTER TABLE `pangkat` DISABLE KEYS */;
INSERT INTO `pangkat` VALUES (1,'I','2021-02-24 01:49:55','2021-02-24 01:49:55'),(2,'II','2021-02-24 01:49:55','2021-02-24 01:49:55'),(3,'III','2021-02-24 01:49:55','2021-02-24 01:49:55'),(4,'IV','2021-02-24 01:49:55','2021-02-24 01:49:55'),(5,'V','2021-02-24 01:49:56','2021-02-24 01:49:56'),(6,'VI','2021-02-24 01:49:56','2021-02-24 01:49:56');
/*!40000 ALTER TABLE `pangkat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pelatihan`
--

DROP TABLE IF EXISTS `pelatihan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pelatihan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `pegawai` int(11) NOT NULL,
  `nomor_st` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjelasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `is_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelatihan`
--

LOCK TABLES `pelatihan` WRITE;
/*!40000 ALTER TABLE `pelatihan` DISABLE KEYS */;
/*!40000 ALTER TABLE `pelatihan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pemantauan`
--

DROP TABLE IF EXISTS `pemantauan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pemantauan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pemantauan` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `tanggal_pemantauan_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pemantauan_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pemantauan`
--

LOCK TABLES `pemantauan` WRITE;
/*!40000 ALTER TABLE `pemantauan` DISABLE KEYS */;
INSERT INTO `pemantauan` VALUES (1,1010140544,22,'29-12-2020','2020','0',1,1,NULL,NULL),(2,1028374248,22,'30-12-2019','2019','0',1,1,NULL,NULL),(3,388337942,22,'30-12-2019','2019','0',1,1,NULL,NULL),(4,2117564199,21,'20-05-2019','2019','0',1,3,NULL,NULL),(5,1471587921,21,'22-11-2021','2020','0',1,3,NULL,NULL);
/*!40000 ALTER TABLE `pemantauan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pemantauan_bpk`
--

DROP TABLE IF EXISTS `pemantauan_bpk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pemantauan_bpk` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `berkas_temuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pemantauan_bpk`
--

LOCK TABLES `pemantauan_bpk` WRITE;
/*!40000 ALTER TABLE `pemantauan_bpk` DISABLE KEYS */;
INSERT INTO `pemantauan_bpk` VALUES (1,1010140544,'Risalah Hasil Pembahasan Pemantauan Tindak Lanjut Semester II Tahun 2020 atas Hasil Pemeriksaan BPK RI atas Laporan Keuangan 2017 Pada Setjen Wantannas','Risalah PTL SMT II 2020 atas LK 2017 (2).pdf36397.pdf','29-12-2020','2020',1,22,'2021-02-24 11:48:35','2021-02-24 11:48:35'),(2,1028374248,'Risalah Hasil Pembahasan Pemantauan Tindak Lanjut Semester II Tahun 2019 Hasil Pemeriksaan BPR RI atas Laporan Keuangan Tahun 2017 Pada Setjen Wantannas','Risalah PTL LK 2017 Wantannas Smt II 2019.pdf35639.pdf','30-12-2019','2019',1,22,'2021-02-24 11:50:26','2021-02-24 11:50:26'),(3,388337942,'Risalah Hasil Pembahasan Pemantauan Tindak Lanjut Semester II Tahun 2019 Hasil Pemeriksaan BPR RI atas Laporan Keuangan Tahun 2018 Pada Setjen Wantannas','Risalah PTL LK 2018 Wantannas Smt II 2019 (1).pdf94005.pdf','30-12-2019','2019',2,22,'2021-02-24 11:52:38','2021-02-24 11:52:38');
/*!40000 ALTER TABLE `pemantauan_bpk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pemantauan_lha`
--

DROP TABLE IF EXISTS `pemantauan_lha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pemantauan_lha` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `berkas_temuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pemantauan_lha`
--

LOCK TABLES `pemantauan_lha` WRITE;
/*!40000 ALTER TABLE `pemantauan_lha` DISABLE KEYS */;
/*!40000 ALTER TABLE `pemantauan_lha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pemantauan_lhkasn`
--

DROP TABLE IF EXISTS `pemantauan_lhkasn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pemantauan_lhkasn` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `pangkat` int(11) NOT NULL,
  `golongan` int(11) NOT NULL,
  `berkas_temuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pemantauan_lhkasn`
--

LOCK TABLES `pemantauan_lhkasn` WRITE;
/*!40000 ALTER TABLE `pemantauan_lhkasn` DISABLE KEYS */;
/*!40000 ALTER TABLE `pemantauan_lhkasn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pemantauan_spip`
--

DROP TABLE IF EXISTS `pemantauan_spip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pemantauan_spip` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `berkas_temuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pemantauan_spip`
--

LOCK TABLES `pemantauan_spip` WRITE;
/*!40000 ALTER TABLE `pemantauan_spip` DISABLE KEYS */;
INSERT INTO `pemantauan_spip` VALUES (1,2117564199,'Laporan Pelaksanaan Quality Assurance (QA) atas Penilaian Mandiri Maturitas Penyelenggaraan SPIP Pada Sekretariat Jenderal Dewan Ketahanan Nasional','Hasil QA SPIP.pdf22384.pdf','20-05-2019','2019',2,21,'2021-02-27 11:43:06','2021-02-27 11:43:06'),(2,2117564199,'Laporan Pelaksanaan Quality Assurance (QA) atas Penilaian Mandiri Maturitas Penyelenggaraan SPIP Pada Sekretariat Jenderal Dewan Ketahanan Nasional','Hasil QA SPIP.pdf16485.pdf','20-05-2019','2019',2,21,'2021-02-27 11:43:33','2021-02-27 11:43:33'),(3,1471587921,'Hasil Self Assesment (SA) Penilaian Maturitas SPIP TA. 2020','rekapitulasi_8AB (1).xlsx98792.xlsx','22-11-2021','2020',2,21,'2021-02-27 11:50:49','2021-02-27 11:50:49');
/*!40000 ALTER TABLE `pemantauan_spip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengajuan_kepseajen`
--

DROP TABLE IF EXISTS `pengajuan_kepseajen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengajuan_kepseajen` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `kepada` int(11) NOT NULL,
  `dari` int(11) NOT NULL,
  `tentang` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pejabat` int(11) NOT NULL,
  `jabatan` int(11) NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_kepsesjen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `is_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengajuan_kepseajen`
--

LOCK TABLES `pengajuan_kepseajen` WRITE;
/*!40000 ALTER TABLE `pengajuan_kepseajen` DISABLE KEYS */;
/*!40000 ALTER TABLE `pengajuan_kepseajen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengajuan_nodim`
--

DROP TABLE IF EXISTS `pengajuan_nodim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengajuan_nodim` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `kepada` int(11) NOT NULL,
  `dari` int(11) NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_nodim` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_nodim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_arsip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tembusan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `is_status` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengajuan_nodim`
--

LOCK TABLES `pengajuan_nodim` WRITE;
/*!40000 ALTER TABLE `pengajuan_nodim` DISABLE KEYS */;
/*!40000 ALTER TABLE `pengajuan_nodim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengawasan`
--

DROP TABLE IF EXISTS `pengawasan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengawasan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pengawasan` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `tanggal_pengawasan_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pengawasan_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengawasan`
--

LOCK TABLES `pengawasan` WRITE;
/*!40000 ALTER TABLE `pengawasan` DISABLE KEYS */;
INSERT INTO `pengawasan` VALUES (1,523037181,23,'0','0','0',1,1,NULL,NULL),(2,1713134185,20,'1','1','0',1,5,NULL,NULL);
/*!40000 ALTER TABLE `pengawasan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dashboard` int(11) NOT NULL,
  `penyerapan` int(11) NOT NULL,
  `penugasan` int(11) NOT NULL,
  `user_admin` int(11) NOT NULL,
  `audit` int(11) NOT NULL,
  `audit_keuangan` int(11) NOT NULL,
  `audit_kinerja` int(11) NOT NULL,
  `audit_tujuan_tertentu` int(11) NOT NULL,
  `reviu` int(11) NOT NULL,
  `reviu_laporan_keuangan` int(11) NOT NULL,
  `reviu_anggaran_kegiatan` int(11) NOT NULL,
  `reviu_lakip` int(11) NOT NULL,
  `reviu_rkbmn` int(11) NOT NULL,
  `evaluasi` int(11) NOT NULL,
  `evaluasi_sakip` int(11) NOT NULL,
  `evaluasi_rb` int(11) NOT NULL,
  `evaluasi_maturitas_spip` int(11) NOT NULL,
  `evaluasi_iacm` int(11) NOT NULL,
  `pemantauan` int(11) NOT NULL,
  `pemantauan_tl_bpk` int(11) NOT NULL,
  `pemantauan_tl_lha` int(11) NOT NULL,
  `pemantauan_spip` int(11) NOT NULL,
  `pemantauan_lhkasn` int(11) NOT NULL,
  `pengawasan_lainnya` int(11) NOT NULL,
  `pengawasan_konsultasi` int(11) NOT NULL,
  `pengawasan_sosialisasi` int(11) NOT NULL,
  `pengawasan_asistensi` int(11) NOT NULL,
  `pengawasan_rbzi` int(11) NOT NULL,
  `pengawasan_sakip` int(11) NOT NULL,
  `dokumentasi` int(11) NOT NULL,
  `dokumentasi_pengajuan_nodin` int(11) NOT NULL,
  `dokumentasi_pengajuan_kepsesjen` int(11) NOT NULL,
  `dokumentasi_input_pkpt` int(11) NOT NULL,
  `dokumentasi_input_notulen` int(11) NOT NULL,
  `laporan` int(11) NOT NULL,
  `laporan_hasil_audit` int(11) NOT NULL,
  `laporan_hasil_kolom_audit` int(11) NOT NULL,
  `laporan_hasil_laporan_audit` int(11) NOT NULL,
  `laporan_hasil_download_audit` int(11) NOT NULL,
  `laporan_hasil_reviu` int(11) NOT NULL,
  `laporan_hasil_kolom_reviu` int(11) NOT NULL,
  `laporan_hasil_laporan_reviu` int(11) NOT NULL,
  `laporan_hasil_download_reviu` int(11) NOT NULL,
  `laporan_hasil_evaluasi` int(11) NOT NULL,
  `laporan_hasil_kolom_evaluasi` int(11) NOT NULL,
  `laporan_hasil_laporan_evaluasi` int(11) NOT NULL,
  `laporan_hasil_download_evaluasi` int(11) NOT NULL,
  `laporan_hasil_pemantauan` int(11) NOT NULL,
  `laporan_hasil_kolom_pemantauan` int(11) NOT NULL,
  `laporan_hasil_laporan_pemantauan` int(11) NOT NULL,
  `laporan_hasil_download_pemantauan` int(11) NOT NULL,
  `laporan_hasil_pengawasan` int(11) NOT NULL,
  `laporan_hasil_kolom_pengawasan` int(11) NOT NULL,
  `laporan_hasil_laporan_pengawasan` int(11) NOT NULL,
  `laporan_hasil_download_pengawasan` int(11) NOT NULL,
  `laporan_hasil_notulen` int(11) NOT NULL,
  `laporan_hasil_kolom_notulen` int(11) NOT NULL,
  `laporan_hasil_laporan_notulen` int(11) NOT NULL,
  `laporan_hasil_download_notulen` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` VALUES (1,'000',1,1,1,8,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'2021-02-24 01:49:56','2021-02-24 01:49:56'),(2,'8890',1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,7,7,7,7,7,1,1,1,1,1,1,1,1,4,1,1,1,4,1,1,1,4,1,1,1,4,1,1,1,4,1,1,1,4,1,'2021-02-24 01:49:56','2021-02-24 01:49:56'),(3,'198612042019021000',1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,7,7,7,7,7,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'2021-02-24 01:49:56','2021-02-24 03:11:55'),(4,'199210082019021001',1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,7,7,7,7,7,1,1,1,1,1,1,1,1,4,1,1,1,4,1,1,1,4,1,1,1,4,1,1,1,4,1,1,1,4,1,'2021-02-24 01:49:56','2021-02-24 01:49:56'),(5,'199208242019021002',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-24 01:49:56','2021-02-24 08:21:43'),(6,'198812292019022001',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-24 01:49:56','2021-02-24 08:20:36'),(7,'199207012019022000',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-24 01:49:56','2021-02-24 08:21:08'),(8,'198402122019021001',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-24 01:49:56','2021-02-24 08:21:08'),(9,'198107172008012016',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-24 01:49:56','2021-02-24 08:20:17'),(10,'199105182019022000',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-24 01:49:56','2021-02-24 08:20:55'),(11,'197502072006042001',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,2,2,2,2,2,5,1,4,4,5,2,4,4,5,2,4,4,5,2,4,4,5,2,4,4,5,2,4,4,'2021-02-24 01:49:56','2021-02-24 01:49:56'),(12,'32419',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,1,2,2,2,2,5,1,4,4,5,2,4,4,5,2,4,4,5,2,4,4,5,2,4,4,5,2,4,4,'2021-02-24 01:49:56','2021-02-24 03:11:54'),(13,'KT199105182019022001',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-24 03:44:42','2021-02-24 03:44:42'),(14,'KT198402122019021001',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-24 03:47:09','2021-02-24 03:47:09'),(15,'KT198812292019022001',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-24 03:48:09','2021-02-24 03:48:09'),(16,'KT199208242019021002',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-24 03:51:58','2021-02-24 03:51:58'),(17,'KT199207012019022003',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-24 03:53:31','2021-02-24 03:53:31'),(18,'AT199105182019022001',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-24 03:55:57','2021-02-24 03:55:57'),(19,'AT198402122019021001',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-24 03:57:06','2021-02-24 03:57:06'),(20,'AT198812292019022001',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-24 03:58:32','2021-02-24 03:58:32'),(21,'AT199208242019021002',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-24 03:59:19','2021-02-24 03:59:19'),(22,'AT199207012019022003',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-24 03:59:53','2021-02-24 03:59:53'),(23,'199506072019022004',1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,7,7,7,7,7,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'2021-02-24 11:40:17','2021-02-24 11:40:17'),(24,'1104130015',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-25 01:23:03','2021-02-25 01:23:03'),(25,'KT1104130015',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-25 08:53:47','2021-02-25 08:54:07'),(26,'AT1104130015',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-25 08:54:35','2021-02-25 08:54:35'),(27,'KT1104130016',2,2,2,1,2,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,2,7,7,7,7,7,2,6,6,6,6,2,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,5,3,4,4,'2021-02-25 08:58:43','2021-02-25 08:58:43');
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peserta_notulens`
--

DROP TABLE IF EXISTS `peserta_notulens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peserta_notulens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_notulen` int(11) NOT NULL,
  `users` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peserta_notulens`
--

LOCK TABLES `peserta_notulens` WRITE;
/*!40000 ALTER TABLE `peserta_notulens` DISABLE KEYS */;
/*!40000 ALTER TABLE `peserta_notulens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `priode_laporan`
--

DROP TABLE IF EXISTS `priode_laporan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `priode_laporan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `priode_laporan`
--

LOCK TABLES `priode_laporan` WRITE;
/*!40000 ALTER TABLE `priode_laporan` DISABLE KEYS */;
INSERT INTO `priode_laporan` VALUES (1,'TW1','2021-02-24 01:49:55','2021-02-24 01:49:55'),(2,'TW2','2021-02-24 01:49:55','2021-02-24 01:49:55'),(3,'TW3','2021-02-24 01:49:55','2021-02-24 01:49:55'),(4,'TW4','2021-02-24 01:49:55','2021-02-24 01:49:55');
/*!40000 ALTER TABLE `priode_laporan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reformasi_birokrasi`
--

DROP TABLE IF EXISTS `reformasi_birokrasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reformasi_birokrasi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `periode` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reformasi_birokrasi`
--

LOCK TABLES `reformasi_birokrasi` WRITE;
/*!40000 ALTER TABLE `reformasi_birokrasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `reformasi_birokrasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviu`
--

DROP TABLE IF EXISTS `reviu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reviu` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `nomor_st` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_reviu_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_reviu_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviu`
--

LOCK TABLES `reviu` WRITE;
/*!40000 ALTER TABLE `reviu` DISABLE KEYS */;
INSERT INTO `reviu` VALUES (1,607324224,19,'ST-25/PI.02.01/2021','17','09/02/2021','17/02/2021',1,1,'2021-02-24 07:09:11','2021-02-24 07:09:11'),(2,1487958098,18,'ST-25/PI.02.01/2021','17','09/02/2021','17/02/2021',1,1,'2021-02-24 07:18:15','2021-02-24 07:18:15'),(3,2005830167,21,'ST-25/PI.02.01/2021','17','09/02/2021','17/02/2021',1,1,'2021-02-24 07:25:56','2021-02-24 07:25:56'),(4,206206379,6,'ST-25/PI.02.01/2021','17','09/02/2021','17/02/2021',1,1,'2021-02-24 07:25:58','2021-02-24 07:25:58'),(5,1714138254,20,'ST-25/PI.02.01/2021','17','09/02/2021','17/02/2021',1,1,'2021-02-24 07:31:59','2021-02-24 07:31:59'),(6,620318257,18,'ST-23/PI.02.04/2021','16','19/02/2021','25/02/2021',1,3,'2021-02-24 07:37:52','2021-02-24 07:37:52'),(7,1349810612,26,'1234/ST/WASINT/2020','25','12/02/2020','12/02/2020',1,3,'2021-02-25 09:05:52','2021-02-25 09:05:52'),(8,277200254,26,'1233/ST/WASINT/2020','25','12/02/2020','12/02/2020',1,3,'2021-02-25 09:08:27','2021-02-25 09:08:27'),(9,649990471,26,'1233/ST/WASINT/2020','25','10/12/2020','10/12/2020',1,3,'2021-02-28 14:42:09','2021-02-28 14:42:09'),(10,1470369557,26,'1234/ST/WASINT/2020','25','05/02/2020','05/02/2020',1,3,'2021-02-28 14:44:27','2021-02-28 14:44:27');
/*!40000 ALTER TABLE `reviu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviu_kegiatan_anggaran`
--

DROP TABLE IF EXISTS `reviu_kegiatan_anggaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviu_kegiatan_anggaran` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `ketua` int(11) NOT NULL,
  `nomor_st` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_reviu_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_reviu_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_penjelasan_reviu` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `is_status` int(11) NOT NULL,
  `is_publish` int(11) NOT NULL,
  `is_save` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviu_kegiatan_anggaran`
--

LOCK TABLES `reviu_kegiatan_anggaran` WRITE;
/*!40000 ALTER TABLE `reviu_kegiatan_anggaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviu_kegiatan_anggaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviu_lakip`
--

DROP TABLE IF EXISTS `reviu_lakip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviu_lakip` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `ketua` int(11) NOT NULL,
  `nomor_st` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_reviu_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_reviu_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_penjelasan_reviu` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `is_status` int(11) NOT NULL,
  `is_publish` int(11) NOT NULL,
  `is_save` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviu_lakip`
--

LOCK TABLES `reviu_lakip` WRITE;
/*!40000 ALTER TABLE `reviu_lakip` DISABLE KEYS */;
INSERT INTO `reviu_lakip` VALUES (1,620318257,16,'ST-23/PI.02.04/2021','19/02/2021','25/02/2021','Mensinkronisasi dengan dasar Persesjen 80 Tahun 2020 tentang SOTK, Renstra 2019',18,2,1,1,0,'2021-02-24 07:37:52','2021-03-01 06:36:25'),(2,1349810612,25,'1234/ST/WASINT/2020','12/02/2020','12/02/2020','Test',26,1,1,1,0,'2021-02-25 09:05:52','2021-02-25 09:05:52'),(3,277200254,25,'1233/ST/WASINT/2020','12/02/2020','12/02/2020','test',26,1,1,1,0,'2021-02-25 09:08:27','2021-02-25 09:08:27'),(4,649990471,25,'1233/ST/WASINT/2020','10/12/2020','10/12/2020','dasdasd',26,1,1,1,0,'2021-02-28 14:42:09','2021-02-28 14:42:09'),(5,1470369557,25,'1234/ST/WASINT/2020','05/02/2020','05/02/2020','dsadas',26,1,1,1,0,'2021-02-28 14:44:27','2021-02-28 14:44:27');
/*!40000 ALTER TABLE `reviu_lakip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviu_laporan_keuangan`
--

DROP TABLE IF EXISTS `reviu_laporan_keuangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviu_laporan_keuangan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `ketua` int(11) NOT NULL,
  `nomor_st` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_reviu_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_reviu_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_penjelasan_reviu` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `is_status` int(11) NOT NULL,
  `is_publish` int(11) NOT NULL,
  `is_save` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviu_laporan_keuangan`
--

LOCK TABLES `reviu_laporan_keuangan` WRITE;
/*!40000 ALTER TABLE `reviu_laporan_keuangan` DISABLE KEYS */;
INSERT INTO `reviu_laporan_keuangan` VALUES (1,607324224,17,'ST-25/PI.02.01/2021','09/02/2021','17/02/2021','KKR Hibah = Tidak terdapat Hibah pada Tahun Anggaran 2020\r\nKKR Belanja = Telah Sesuai',19,2,1,1,0,'2021-02-24 07:09:10','2021-02-24 07:13:24'),(2,1487958098,17,'ST-25/PI.02.01/2021','09/02/2021','17/02/2021','KKR Bendahara Penerimaan dan Persediaan',18,2,1,1,0,'2021-02-24 07:18:14','2021-02-24 07:20:28'),(3,2005830167,17,'ST-25/PI.02.01/2021','09/02/2021','17/02/2021','KKR Seluruh Akun dan Akun lancar sudah Sesuai',21,2,1,1,0,'2021-02-24 07:25:56','2021-02-24 07:27:20'),(4,206206379,17,'ST-25/PI.02.01/2021','09/02/2021','17/02/2021','- revisi Tabel Perbandingan pada Calk LRA',6,2,1,1,0,'2021-02-24 07:25:58','2021-02-24 07:32:55'),(5,1714138254,17,'ST-25/PI.02.01/2021','09/02/2021','17/02/2021','Revisi pada CaLK LRA mengenai tabel perbandingan realisasi',20,1,1,1,0,'2021-02-24 07:31:59','2021-02-24 07:31:59');
/*!40000 ALTER TABLE `reviu_laporan_keuangan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviu_rkbmn`
--

DROP TABLE IF EXISTS `reviu_rkbmn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviu_rkbmn` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `ketua` int(11) NOT NULL,
  `nomor_st` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_reviu_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_reviu_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temuan_penjelasan_reviu` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `is_prosess` int(11) NOT NULL,
  `is_status` int(11) NOT NULL,
  `is_publish` int(11) NOT NULL,
  `is_save` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviu_rkbmn`
--

LOCK TABLES `reviu_rkbmn` WRITE;
/*!40000 ALTER TABLE `reviu_rkbmn` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviu_rkbmn` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sakip`
--

DROP TABLE IF EXISTS `sakip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sakip` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `periode` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sakip`
--

LOCK TABLES `sakip` WRITE;
/*!40000 ALTER TABLE `sakip` DISABLE KEYS */;
INSERT INTO `sakip` VALUES (1,1713134185,1,1,'2021-02-24 11:43:29','2021-02-24 11:43:29');
/*!40000 ALTER TABLE `sakip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'Kirim','2021-02-24 01:49:55','2021-02-24 01:49:55'),(2,'Setuju','2021-02-24 01:49:55','2021-02-24 01:49:55'),(3,'Kembali','2021-02-24 01:49:55','2021-02-24 01:49:55'),(4,'Perbaikan','2021-02-24 01:49:55','2021-02-24 01:49:55');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submenu`
--

DROP TABLE IF EXISTS `submenu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submenu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view` int(11) NOT NULL,
  `edit` int(11) NOT NULL,
  `copy` int(11) NOT NULL,
  `simpan` int(11) NOT NULL,
  `kirim` int(11) NOT NULL,
  `unduh` int(11) NOT NULL,
  `cari` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submenu`
--

LOCK TABLES `submenu` WRITE;
/*!40000 ALTER TABLE `submenu` DISABLE KEYS */;
INSERT INTO `submenu` VALUES (1,'Tidak diijinkan mengakses',0,0,0,0,0,0,0,'2021-02-24 01:49:55','2021-02-24 01:49:55'),(2,'View',1,0,0,0,0,0,0,'2021-02-24 01:49:55','2021-02-24 01:49:55'),(3,'View, Edit, dan Simpan',1,1,0,1,0,0,0,'2021-02-24 01:49:55','2021-02-24 01:49:55'),(4,'View, Edit, dan Unduh',1,1,0,0,0,1,0,'2021-02-24 01:49:55','2021-02-24 01:49:55'),(5,'View, dan Cari',1,0,0,0,0,0,1,'2021-02-24 01:49:55','2021-02-24 01:49:55'),(6,'View, Simpan, Unduh',1,0,0,1,0,1,0,'2021-02-24 01:49:55','2021-02-24 01:49:55'),(7,'View, Simpan, dan Kirim',1,0,0,1,1,0,0,'2021-02-24 01:49:55','2021-02-24 01:49:55'),(8,'View, Edit, Copy, dan Simpan',1,1,1,1,0,0,0,'2021-02-24 01:49:55','2021-02-24 01:49:55');
/*!40000 ALTER TABLE `submenu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'000','Super Admin',1,8,0,1,'$2y$10$RyhiApQ/34F0MFEfJfTcb..pF/l5FLdvvchzpMeK0IpJgTo3WjVny',NULL,'2021-02-24 01:49:54','2021-03-02 00:22:49'),(2,'197502072006042001','Titin Mardyaningsih, S.E., M.M.',73,3,0,1,'$2y$10$UHfY22tcNlthgNvya.7etOqse0FIpDdJZf/rhJBo.fKh9/NdnFswW',NULL,'2021-02-24 01:49:54','2021-03-01 06:36:05'),(3,'32419','Brigjen TNI. Drs. Haris Sarjana, M.M., M.Tr. (Han)',28,4,0,1,'$2y$10$1i8YeYkijUKrFa8bG6.jau687Jef0xIro7LVA0RqD1u6HjmYtZ1Yq',NULL,'2021-02-24 01:49:54','2021-03-01 06:38:24'),(4,'198107172008012016','Mila Purnama Yulianti, A.Md.',97,1,2,1,'$2y$10$kO5p/I7pTF7wN7CupEDLxuMWbzzGywuL/n2cDqCLM6BloVIpf2Kwm',NULL,'2021-02-24 01:49:54','2021-02-24 01:49:54'),(5,'199208242019021002','Alvin Rayinda Pramasha, S.E.',106,2,1,1,'$2y$10$pR.Vj3ksSoUZ0EeQ1i4sNuS877Aalj0UpFuS8qHabs5Bg0lI9f1Gm',NULL,'2021-02-24 01:49:54','2021-02-24 08:21:43'),(6,'198812292019022001','Helfrida Sinaga, S.E.',104,2,1,1,'$2y$10$M1eTlbqZ1M0wk7fKB90D8.aqYvCvxvYuKsMT7/972dlYAGKNft3Ji',NULL,'2021-02-24 01:49:54','2021-02-24 08:20:36'),(7,'199105182019022000','Dian Ayu Pertiwi, S.E.',104,1,1,1,'$2y$10$3lUcyjMqKtWeF.QYnwZ8iuGaiMlCN1F0srF3SNG1KUC1.P.QES/L2',NULL,'2021-02-24 01:49:54','2021-02-24 08:20:55'),(8,'199207012019022000','Riedjanti Restu Biandari, S.E.',106,2,1,1,'$2y$10$uQMIhpH/fJM3i0ivaLdwv.GEoorOMrwsw4IPdIVeBl7FYm2oOliom',NULL,'2021-02-24 01:49:54','2021-02-24 08:21:08'),(9,'198402122019021001','Daniel Maruli Tua Manik, S.E.',106,2,1,1,'$2y$10$STvVeExJSoWA7ewyOxR/EOkDxOyCA7/ixmGmPDPBxuaQj0dXfu.7i',NULL,'2021-02-24 01:49:55','2021-02-26 06:47:29'),(10,'199210082019021001','Andre Pamungkas, S.E.',105,5,0,1,'$2y$10$nEs/sPRzNAXOR9weaWoeUOhSleeUQO8mCu1g7dyZWdVOZn..1RYA6',NULL,'2021-02-24 01:49:55','2021-02-24 12:55:37'),(11,'8890','Dr. Ir. Harjo Susmoro, S.Sos., S.H., M.H.',2,7,0,1,'$2y$10$phGaMZV9huJY9Dznkzkvpef9vdakPRPTjY6zygxC.wi3W5/7H/aUe',NULL,'2021-02-24 01:49:55','2021-02-24 01:49:55'),(12,'198612042019021000','Bayu Prawiradisma Siregar, S.E.',110,6,0,0,'$2y$10$g4T9QaIXY.jgwsb.5gxEUe9RdwH57W9aAk4FBWP3K5uQKGH46OGg.',NULL,'2021-02-24 01:49:55','2021-02-24 03:11:53'),(13,'KT199105182019022001','(KT)-Dian Ayu Pertiwi, S.E.',104,1,14,1,'$2y$10$6nXOIK.kjm9Tm2kHfMvvnOWG2gDrw/HW42YQzrs2bGYZry5XgfNMa',NULL,'2021-02-24 03:44:42','2021-03-01 04:33:58'),(14,'KT198402122019021001','(KT)-Daniel Maruli Tua Manik, S.E.',104,1,15,1,'$2y$10$VzWL7eCugC44f.SH4BHXturfY746.uwT8aKpFB.Z1b3ysiX.zV2Qm',NULL,'2021-02-24 03:47:09','2021-02-24 05:43:48'),(15,'KT198812292019022001','(KT)-Helfrida Sinaga, S.E.',104,1,16,1,'$2y$10$ZYXRZFIBieNC8VvPt7nlxeBvW4Fjrhgg20n2sokdHQWvXLugJzDPm',NULL,'2021-02-24 03:48:09','2021-02-28 13:57:21'),(16,'KT199208242019021002','(KT)-Alvin Rayinda Pramasha, S.E.',106,1,17,1,'$2y$10$RrP3K61861Q4DZZS8p6ewundiyhXX2mwD18IlPhH5HUSPEePCUeea',NULL,'2021-02-24 03:51:58','2021-03-01 06:35:45'),(17,'KT199207012019022003','(KT)-Riedjanti Restu Biandari, S.E.',106,1,18,1,'$2y$10$azmBiyixK7fWJEvJG5feFO3DoHrWzTZA8Bpr7Fhwzlm0BFxX/BUC2',NULL,'2021-02-24 03:53:30','2021-02-24 07:34:49'),(18,'AT199105182019022001','(AT)-Dian Ayu Pertiwi, S.E.',104,2,14,1,'$2y$10$RmNGB.ncIQ3M1R/GsfN8sOu5/suat.W7pW3sRjoL6YsARPDMdTtJq',NULL,'2021-02-24 03:55:57','2021-03-01 08:05:45'),(19,'AT198402122019021001','(AT)-Daniel Maruli Tua Manik, S.E.',104,2,15,1,'$2y$10$2Yjq/wABYNrmSxcUoCz5y.Go3cyzilgmTYwu4LlXBAZKusowPPkvi',NULL,'2021-02-24 03:57:06','2021-02-28 13:52:20'),(20,'AT198812292019022001','(AT)-Helfrida Sinaga, S.E.',104,2,16,1,'$2y$10$AL2Ygzw3b3yATPXnB92GV.4JAIIKUOX7mMe0qFnvzwtmYgNBIVP36',NULL,'2021-02-24 03:58:32','2021-02-25 12:36:56'),(21,'AT199208242019021002','(AT)-Alvin Rayinda Pramasha, S.E.',106,2,17,1,'$2y$10$b9puM42RtTJim2JuA/NmTOBRbjAtBmLm6dH3vxic7AC9QrvQzvP5G',NULL,'2021-02-24 03:59:19','2021-02-27 11:23:44'),(22,'AT199207012019022003','(AT)-Riedjanti Restu Biandari, S.E.',106,2,18,1,'$2y$10$z62GzVXR8WkQIyCXh9dwzOQ4s60V6BYZ1t732ZnN3bIA2EMNW1fTK',NULL,'2021-02-24 03:59:53','2021-02-25 03:34:36'),(23,'199506072019022004','Afifah Fitriani, S.E.',111,6,0,1,'$2y$10$qwHYH350.MEmb/fgM7/wh.D8FyGoT8Z9nfxHYpNSEmKqa3QtI9TnS',NULL,'2021-02-24 11:40:17','2021-02-24 11:41:46'),(26,'AT1104130015','(AT)-Khafi Luhur Fajriawan',5,2,19,1,'$2y$10$g4zQuSBC/M1.dAgV0Av3vuv/lvoZNK467wiYVkHZJ1kEYAWXWUJiG',NULL,'2021-02-25 08:54:35','2021-03-01 01:55:15'),(27,'KT1104130016','(KT)-Galih Handono',4,1,21,1,'$2y$10$tFxAFQ0mWQ3bH4.TESbMpuaS6DFpZIIG05LhbcC3mT9S8IvfFA31W',NULL,'2021-02-25 08:58:43','2021-02-25 09:05:17');
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

-- Dump completed on 2021-03-02  7:33:39
