-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: db_showroom
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
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
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_08_01_122836_create_motors_table',1),(5,'2026_08_07_170303_create_transaksis_table',1),(6,'2026_08_21_163246_create_personal_access_tokens_table',2),(7,'2026_09_30_114507_add_foto_2_and_foto_3_to_motors_table',3),(8,'2026_10_28_000001_add_detail_bekas_to_motors_table',4),(9,'2026_10_28_000002_add_pembayaran_and_leasing_to_transaksis_table',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `motors`
--

DROP TABLE IF EXISTS `motors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `motors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_motor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cc` int NOT NULL,
  `warna` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transmisi` enum('Matic','Manual','Kopling') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` enum('Baru','Bekas') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kilometer` int DEFAULT NULL,
  `plat_nomor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pemilik_sebelumnya` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_bpkb` enum('Ada','Tidak Ada','Proses Balik Nama') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_stnk` enum('Hidup','Mati','Proses Perpanjangan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pajak_berlaku_sampai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_rangka` enum('Mulus','Pernah Servis Ringan','Bekas Tabrak') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ban_depan` enum('Bagus','Cukup','Perlu Ganti') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ban_belakang` enum('Bagus','Cukup','Perlu Ganti') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tersedia_kredit` tinyint(1) NOT NULL DEFAULT '1',
  `info_leasing` text COLLATE utf8mb4_unicode_ci,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motors`
--

LOCK TABLES `motors` WRITE;
/*!40000 ALTER TABLE `motors` DISABLE KEYS */;
INSERT INTO `motors` VALUES (2,'XMAX','Yamaha',7000000,2,'motor/EAfO7yJCec6Hr7L21xj8HOwx1s7w8tozFlvKkev9.jpg',NULL,NULL,'2025',250,'Merah','Matic','Bekas',12500,'T 3421 KL','Bpk. Hendra (Tangan Pertama)','Ada','Hidup','Desember 2026','Mulus','Bagus','Bagus',1,'Bisa diproses melalui Adira Finance, FIFGROUP, atau BAF. Promo DP mulai 15% atau potongan tenor 2 bulan.','Surat Lengkap','2026-08-14 08:29:18','2026-10-28 06:44:13',NULL),(3,'Beat','Honda',7000000,2,'motor/i6uGtbCakz8eQ6lwL3Z39PlNU7VmOHSF0oM3Fiag.jpg',NULL,NULL,'2023',110,'silver','Matic','Bekas',18200,'T 5892 WX','Ibu Ratna (Tangan Pertama)','Ada','Hidup','Agustus 2026','Mulus','Bagus','Bagus',1,'Bisa diproses melalui Adira Finance, FIFGROUP, atau BAF. Promo DP mulai 15% atau potongan tenor 2 bulan.','surat lengkap','2026-08-19 09:04:00','2026-10-28 06:44:13',NULL),(4,'Vario','Honda',18000000,3,'motor/G3jVeAGGzkuTi8fJXOMiOi3q4A2vhi0UtuOw1KN9.png',NULL,NULL,'2025',160,'Hitam','Matic','Baru',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'Lengkap','2026-08-19 09:05:59','2026-08-19 09:05:59',NULL),(5,'ADV','Honda',30000000,1,'motor/9qCoNJCCEKFlDu8Krf0xvWlyyvn54hkdhoPAB2Fa.jpg','motor/EwfaSJXZfcySvLCBlbECh4jPpa13CKXRtbnA9RLP.jpg',NULL,'2025',160,'Brown','Matic','Bekas',9800,'T 4901 BC','Bpk. Hendra (Tangan Pertama)','Ada','Hidup','November 2026','Mulus','Bagus','Bagus',1,'Bisa diproses melalui Adira Finance, FIFGROUP, atau BAF. Promo DP mulai 15% atau potongan tenor 2 bulan.','STNK only','2026-08-19 09:10:31','2026-10-28 06:44:13',NULL),(6,'ZX25R','KAWASAKI',100000000,1,'motor/G60wysKyMVijwNns59ZYpKZ7nmKbYHaBPYz8FtmL.jpg',NULL,NULL,'2020',250,'Hijau','Kopling','Bekas',31000,'T 3421 KL','Ibu Ratna (Tangan Pertama)','Ada','Hidup','Desember 2026','Mulus','Bagus','Bagus',1,'Bisa diproses melalui Adira Finance, FIFGROUP, atau BAF. Promo DP mulai 15% atau potongan tenor 2 bulan.','Lengkap','2026-08-19 09:11:37','2026-10-28 06:44:13',NULL),(8,'PCX','Honda',25000000,1,'motor/GEecSdYs1AKhLBb8Fm8veuPSk5N9PKzCc3u1SnWF.jpg',NULL,NULL,'2025',160,'hijau','Matic','Baru',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,'2026-08-19 09:51:09','2026-09-23 06:00:12',NULL),(9,'nmax','Yamaha',30000000,2,'motor/uQmKbY9sDp3e5gYj3MZmrHw1inOBvOiX9OsJb2I2.jpg',NULL,NULL,'2025',155,'hitam','Matic','Baru',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,'2026-09-23 05:23:38','2026-09-23 05:43:16','2026-09-23 05:43:16'),(10,'Ninja 250R','Kawasaki',1500000,2,'motor/4rtVixhwAx07Ise0rHEFEJRNEl3WVvbbhQsno9zX.jpg','motor/Ekld5hmrNwehrHdrF0Deah1WW3odgRtLaNdHTpRF.jpg','motor/6la7oBfwoa5TtYxu8KkKU0Qp5ORZUJ5HpVZlvfT6.jpg','2010',250,'Merah','Kopling','Bekas',32000,'B 5412 FIZ','suherman','Ada','Hidup','November 2027','Mulus','Bagus','Bagus',1,NULL,NULL,'2026-11-04 10:58:41','2026-11-04 10:58:41',NULL),(11,'Ninja 250R','Kawasaki',1500000,2,'motor/jkO1qlSteplF2JcqO39XdHMnEF0nRMw95Xkt5L8E.jpg','motor/oy86wUV67HkenkEyhTnnCUHvmRpwIRFqp2qpfNRO.jpg','motor/vFhy7vfF2xr5ZjoAntPrXEw2938wcGh7Hd1PjDNP.jpg','2010',250,'Merah','Kopling','Bekas',32000,'B 5412 FIZ','suherman','Ada','Hidup','November 2027','Mulus','Bagus','Bagus',1,NULL,NULL,'2026-11-04 10:58:41','2026-11-04 10:58:53','2026-11-04 10:58:53');
/*!40000 ALTER TABLE `motors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('359VFwRT32I2yFpg2WB8ziUNLbNCa5d76ZyCY7ZH',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36','eyJfdG9rZW4iOiIycU1QS0RLalJITTFraGNEckxPdHQ3S0dScDFJQ3NyclBlWUtPN3Y4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdFwvc2hvd3Jvb20ta3BcL3B1YmxpYyIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1793805614),('D9jAh5qycSMXtP8FHGJmZCvp337xDdzZHpctL1vL',1,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJSdkQ1dWdHZzBGbkxFWGdhZ1c5YVY0Rkk5ZHM1dkpXOFBTZjE3WXlVIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0XC9zaG93cm9vbS1rcFwvcHVibGljXC90cmFuc2Frc2lcL2NyZWF0ZSIsInJvdXRlIjoidHJhbnNha3NpLmNyZWF0ZSJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=',1793197201),('fe9GCXVCHUwiFW91pAP8hB9RAXA6V1llsIvgYM7Z',NULL,'127.0.0.1','Symfony','eyJfdG9rZW4iOiJTbm5aQXVDN0FYVXo4ck80YXdNT014TEcxUHVVaDVCYzNJY2I3SnFiIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1793195316),('GSw85OGc0FRTbUkjnSxAUEjWB198Oy9dU4a6TRef',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJXRUxvR1NjaXZMQ0c5VVM2UlJvZGROSlpvS0h3NjN0SURmOGlkUzBSIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdFwvc2hvd3Jvb20ta3BcL3B1YmxpYyIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1793021219),('hgODgHuXAYFgrgr2jkP92QfskWWS08rxLtODoe4P',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJmbDJ4UEFVWGRQYnFGZXVTSWJiRWxic1dWdE5jWk1pQktPM3R3bENZIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdFwvc2hvd3Jvb20ta3BcL3B1YmxpYyIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1791901634),('iVIaYSIQBDnvCTs91HBsV26txpcFxf8HVHWbLjpr',1,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJhYkpCZHM4RVNnR1RpRzZ2QmpyVFJLcW92YU5aMThXUFY0cXJzQzRmIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdFwvc2hvd3Jvb20ta3BcL3B1YmxpY1wvbW90b3IiLCJyb3V0ZSI6Im1vdG9yLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9',1793021571),('Sdj6bseZxER7pJ7cVjAXO9jM58uK6Ng0A0Yj7uAT',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456','eyJfdG9rZW4iOiJ4V1dlVUVXd3ZWV2dkTFFrNE5CeVdaWkRIV25La05kNFQ3NjN3ZzdMIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3Nob3dyb29tLWtwLnRlc3QiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1793195621),('x7VEYKXWFGHXFhjMUye24iWpTb0fysdUqz8crP08',NULL,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJSdWhHTnVjNGFldkQxTkdBZ2kwYUZ5Q0dyaXVmclByNzVqMzFTYkxUIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0XC9zaG93cm9vbS1rcFwvcHVibGljIiwicm91dGUiOiJob21lIn19',1791559416);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksis`
--

DROP TABLE IF EXISTS `transaksis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaksis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `motor_id` bigint unsigned NOT NULL,
  `nama_pembeli` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_pembeli` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telepon_pembeli` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_beli` int NOT NULL,
  `total_harga` bigint NOT NULL,
  `metode_pembayaran` enum('Cash','Kredit') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Cash',
  `nama_leasing` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uang_dp` bigint DEFAULT NULL,
  `tenor` int DEFAULT NULL,
  `angsuran_per_bulan` bigint DEFAULT NULL,
  `no_kontrak_leasing` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_transaksi` text COLLATE utf8mb4_unicode_ci,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksis_motor_id_foreign` (`motor_id`),
  CONSTRAINT `transaksis_motor_id_foreign` FOREIGN KEY (`motor_id`) REFERENCES `motors` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksis`
--

LOCK TABLES `transaksis` WRITE;
/*!40000 ALTER TABLE `transaksis` DISABLE KEYS */;
INSERT INTO `transaksis` VALUES (1,2,'Desrada',NULL,NULL,1,7000000,'Cash',NULL,NULL,NULL,NULL,NULL,NULL,'2026-10-26','2026-10-26 06:30:20','2026-10-26 06:30:20');
/*!40000 ALTER TABLE `transaksis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin Showroom','admin@gmail.com',NULL,'$2y$12$R6hqnXLzw.9.HDBB/iQllucpLxmhZDrep3c.QbGk/.t92OfQRT3XC',NULL,'2026-08-12 06:53:56','2026-08-12 06:53:56'),(2,'Owner Kenanga','owner@kenanga.com',NULL,'$2y$12$.GjhtjP/A1HN5YE2CVYXMeNiQn9cabt.Vsj/.y/krGaqLG4sI8/FS',NULL,'2026-09-22 23:05:06','2026-09-22 23:05:06');
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

-- Dump completed on 2026-11-05 14:51:25
