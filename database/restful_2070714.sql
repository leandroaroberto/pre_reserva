-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: restful
-- ------------------------------------------------------
-- Server version	5.7.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `restful`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `restful` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `restful`;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_07_05_214321_create_pre_reserva_table',1),(4,'2017_07_05_214343_create_pre_reserva_datas_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
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
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
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
-- Table structure for table `pre_reserva`
--

DROP TABLE IF EXISTS `pre_reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pre_reserva` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `professor` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `evento` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `obs` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pre_reserva`
--

LOCK TABLES `pre_reserva` WRITE;
/*!40000 ALTER TABLE `pre_reserva` DISABLE KEYS */;
INSERT INTO `pre_reserva` VALUES (9,'Leandro Roberto','leroberto@gmail.com','19988429727','Lidiane Cristina','Qualificacao Doutorado','Evento Lidi','2017-07-14 16:52:10','2017-07-14 16:52:10',NULL),(10,'Leandro Roberto','leroberto@gmail.com','19988429727','Lidiane Cristina','Qualificacao Doutorado','Evento Lidi','2017-07-14 16:53:42','2017-07-14 16:53:42',NULL),(11,'Leandro Roberto','leroberto@gmail.com','19988429727','Lidiane Cristina','Qualificacao Doutorado','Evento Lidi','2017-07-14 16:54:01','2017-07-14 16:54:01',NULL),(12,'Leandro Roberto','leroberto@gmail.com','19988429727','Lidiane Cristina','Qualificacao Doutorado','Evento Lidi','2017-07-14 16:59:05','2017-07-14 16:59:05',NULL),(13,'Leandro Roberto','leroberto@gmail.com','19988429727','Lidiane Cristina','Qualificacao Doutorado','Evento Lidi','2017-07-14 16:59:33','2017-07-14 16:59:33',NULL),(14,'Leandro Roberto','leroberto@gmail.com','19988429727','Lidiane Cristina','Qualificacao Doutorado','Evento Lidi','2017-07-14 17:00:04','2017-07-14 17:00:04',NULL),(15,'Leandro Roberto','leroberto@gmail.com','19988429727','Lidiane Cristina','Qualificacao Doutorado','Evento Lidi','2017-07-14 17:00:37','2017-07-14 17:00:37',NULL),(16,'Leandro Roberto','leroberto@gmail.com','19988429727','Lidiane Cristina','Qualificacao Doutorado','Evento Lidi','2017-07-14 17:00:59','2017-07-14 17:00:59',NULL),(17,'Leandro Roberto','leroberto@gmail.com','19988429727','Lidiane Cristina','Qualificacao Doutorado','Evento Lidi','2017-07-14 17:01:16','2017-07-14 17:01:16',NULL),(18,'Leandro Roberto','leroberto@gmail.com','19988429727','Lidiane Cristina','Qualificacao Doutorado','Evento Lidi','2017-07-14 17:01:48','2017-07-14 17:01:48',NULL),(19,'Leandro Roberto','leroberto@gmail.com','19988429727','Lidiane Cristina','Qualificacao Doutorado','Evento Lidi','2017-07-14 17:02:24','2017-07-14 17:02:24',NULL),(20,'Leandro Roberto','leroberto@gmail.com','19988429727','Lidiane Cristina','Qualificacao Doutorado','Evento Lidi','2017-07-14 17:02:46','2017-07-14 17:02:46',NULL),(21,'Leandro Roberto','leroberto@gmail.com','19988429727','Lidiane Cristina','Qualificacao Doutorado','Evento Lidi','2017-07-14 17:03:05','2017-07-14 17:03:05',NULL),(22,'Leandro Aparecido Roberto','leroberto@gmail.com','5519988429727','Luciana','Defesa Doutorado','Banca UFC','2017-07-14 17:10:14','2017-07-14 17:10:14',NULL),(23,'Leandro','sfkjsldjf@teste.com','6546546','dsfsd','Aula','sdfds','2017-07-14 17:21:52','2017-07-14 17:21:52',NULL),(24,'rty','lidicristinaroberto@gmail.com','7878787','asdasd','Debate','asda','2017-07-14 17:24:13','2017-07-14 17:24:13',NULL);
/*!40000 ALTER TABLE `pre_reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pre_reserva_datas`
--

DROP TABLE IF EXISTS `pre_reserva_datas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pre_reserva_datas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_reserva` datetime NOT NULL,
  `pre_reserva_id` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pre_reserva_datas_pre_reserva_id_foreign` (`pre_reserva_id`),
  CONSTRAINT `pre_reserva_datas_pre_reserva_id_foreign` FOREIGN KEY (`pre_reserva_id`) REFERENCES `pre_reserva` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pre_reserva_datas`
--

LOCK TABLES `pre_reserva_datas` WRITE;
/*!40000 ALTER TABLE `pre_reserva_datas` DISABLE KEYS */;
INSERT INTO `pre_reserva_datas` VALUES (9,'2017-08-15 09:00:00',9,0,'2017-07-14 16:52:10','2017-07-14 16:52:10',NULL),(10,'2017-08-15 09:00:00',10,0,'2017-07-14 16:53:42','2017-07-14 16:53:42',NULL),(11,'2017-08-15 09:00:00',11,0,'2017-07-14 16:54:01','2017-07-14 16:54:01',NULL),(12,'2017-08-15 09:00:00',12,0,'2017-07-14 16:59:05','2017-07-14 16:59:05',NULL),(13,'2017-08-15 09:00:00',13,0,'2017-07-14 16:59:33','2017-07-14 16:59:33',NULL),(14,'2017-08-15 09:00:00',14,0,'2017-07-14 17:00:04','2017-07-14 17:00:04',NULL),(15,'2017-08-15 09:00:00',15,0,'2017-07-14 17:00:37','2017-07-14 17:00:37',NULL),(16,'2017-08-15 09:00:00',16,0,'2017-07-14 17:00:59','2017-07-14 17:00:59',NULL),(17,'2017-08-15 09:00:00',17,0,'2017-07-14 17:01:16','2017-07-14 17:01:16',NULL),(18,'2017-08-15 09:00:00',18,0,'2017-07-14 17:01:48','2017-07-14 17:01:48',NULL),(19,'2017-08-15 09:00:00',19,0,'2017-07-14 17:02:24','2017-07-14 17:02:24',NULL),(20,'2017-08-15 09:00:00',20,0,'2017-07-14 17:02:46','2017-07-14 17:02:46',NULL),(21,'2017-08-15 09:00:00',21,0,'2017-07-14 17:03:05','2017-07-14 17:03:05',NULL),(22,'2017-10-12 14:00:00',22,0,'2017-07-14 17:10:14','2017-07-14 17:10:14',NULL),(23,'2017-07-29 14:00:00',23,0,'2017-07-14 17:21:52','2017-07-14 17:21:52',NULL),(24,'2017-07-29 14:00:00',24,0,'2017-07-14 17:24:13','2017-07-14 17:24:13',NULL);
/*!40000 ALTER TABLE `pre_reserva_datas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `users` VALUES (1,'Leandro Roberto','rleandro@unicamp.br','$2y$10$HgEaSnzlQdA3eNcHriNmWe.R.hix8sZL.9.lWdTFC80QZ.P6ZBsDa',NULL,'2017-07-06 18:51:54','2017-07-06 18:51:54'),(2,'EAD','videofe@unicamp.br','$2y$10$M75EIurwydLhjgR715DfbeYH/Fgf77IQF70Z56R5VPDVH4Z7BH/Z2','HeDAnyTlcMmX7KHj73m1IPUidYwK4i6APpRto15PeoGT1p19Kt5LG2Yuw2YV','2017-07-10 19:19:01','2017-07-10 19:19:01');
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

-- Dump completed on 2017-07-14 16:31:27
