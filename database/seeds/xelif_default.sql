-- Settings for the Felix website as of 21/12/2022
--
-- NOTE: In the future these might change, so DO NOT use this to redeploy the website if it has not been updated!
--

-- MariaDB dump 10.19  Distrib 10.5.18-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: laravel
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB-1:10.4.27+maria~ubu2004

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
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'2022-12-21 18:09:13','2022-12-21 18:09:13',NULL,'title-text','look-and-feel'),(2,'2022-12-21 18:09:13','2022-12-21 18:09:13',NULL,'meta-description','look-and-feel'),(3,'2022-12-21 18:09:13','2022-12-21 18:09:13',NULL,'meta-theme-colour','look-and-feel'),(4,'2022-12-21 18:09:13','2022-12-21 18:09:13',NULL,'issn','look-and-feel'),(5,'2022-12-21 18:09:13','2022-12-21 18:09:13',NULL,'tagline','look-and-feel'),(6,'2022-12-21 18:09:13','2022-12-21 18:09:13',NULL,'motto','look-and-feel'),(7,'2022-12-21 18:09:13','2022-12-21 18:09:13',NULL,'masthead-title','look-and-feel'),(8,'2022-12-21 18:09:13','2022-12-21 18:09:13',NULL,'minihead-title','look-and-feel'),(9,'2022-12-21 18:09:13','2022-12-21 18:09:13',NULL,'address','look-and-feel'),(10,'2022-12-21 18:09:13','2022-12-21 18:09:13',NULL,'postcode','look-and-feel'),(11,'2022-12-21 18:09:13','2022-12-21 18:09:13',NULL,'telephone','look-and-feel'),(12,'2022-12-21 18:09:13','2022-12-21 18:09:13',NULL,'copyright','look-and-feel'),(13,'2022-12-21 18:09:13','2022-12-21 18:09:13',NULL,'instagram','look-and-feel'),(14,'2022-12-21 18:09:13','2022-12-21 18:09:13',NULL,'twitter','look-and-feel'),(15,'2022-12-21 18:09:13','2022-12-21 18:09:13',NULL,'facebook','look-and-feel'),(16,'2022-12-21 18:09:13','2022-12-21 18:09:13',NULL,'email','look-and-feel'),(17,'2022-12-21 18:09:13','2022-12-21 18:09:13',NULL,'disable-menu-underline','look-and-feel'),(18,'2022-12-21 18:09:13','2022-12-21 18:09:13',NULL,'one-index-featured','look-and-feel'),(19,'2022-12-21 18:09:13','2022-12-21 18:09:13',NULL,'full-nav-cols','look-and-feel');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `setting_translations`
--

LOCK TABLES `setting_translations` WRITE;
/*!40000 ALTER TABLE `setting_translations` DISABLE KEYS */;
INSERT INTO `setting_translations` VALUES (1,1,NULL,'2022-12-21 18:09:13','2022-12-21 18:11:51','en',1,'Felix Local'),(2,2,NULL,'2022-12-21 18:09:13','2022-12-21 18:11:51','en',1,'Felix: the student newspaper of Imperial College London'),(3,3,NULL,'2022-12-21 18:09:13','2022-12-21 18:11:51','en',1,'#3a3a3a'),(4,4,NULL,'2022-12-21 18:09:13','2022-12-21 18:11:51','en',1,'0140-0711'),(5,5,NULL,'2022-12-21 18:09:13','2022-12-21 18:11:51','en',1,'The student newspaper of Imperial College London'),(6,6,NULL,'2022-12-21 18:09:13','2022-12-21 18:11:51','en',1,'Keep the Cat Free'),(7,7,NULL,'2022-12-21 18:09:13','2022-12-21 18:11:51','en',1,'Felix'),(8,8,NULL,'2022-12-21 18:09:13','2022-12-21 18:11:51','en',1,'Felix'),(9,9,NULL,'2022-12-21 18:09:13','2022-12-21 18:11:51','en',1,'Felix, Beit Quad, Prince Consort Road, London'),(10,10,NULL,'2022-12-21 18:09:13','2022-12-21 18:11:51','en',1,'SW7 2BB'),(11,11,NULL,'2022-12-21 18:09:13','2022-12-21 18:11:51','en',1,'0207 59 48072'),(12,12,NULL,'2022-12-21 18:09:13','2022-12-21 18:11:51','en',1,'Felix, Imperial College Union'),(13,13,NULL,'2022-12-21 18:09:13','2022-12-21 18:11:51','en',1,'felix_imperial'),(14,14,NULL,'2022-12-21 18:09:13','2022-12-21 18:11:51','en',1,'feliximperial'),(15,15,NULL,'2022-12-21 18:09:13','2022-12-21 18:11:51','en',1,'FelixImperial'),(16,16,NULL,'2022-12-21 18:09:13','2022-12-21 18:11:51','en',1,'felix@ic.ac.uk'),(17,17,NULL,'2022-12-21 18:09:13','2022-12-21 18:11:51','en',1,'1'),(18,18,NULL,'2022-12-21 18:09:13','2022-12-21 18:11:51','en',1,'1'),(19,19,NULL,'2022-12-21 18:09:13','2022-12-21 18:11:51','en',1,'6');
/*!40000 ALTER TABLE `setting_translations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-21 18:15:00
