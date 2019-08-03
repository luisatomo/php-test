-- MySQL dump 10.17  Distrib 10.3.16-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: pbook
-- ------------------------------------------------------
-- Server version	10.3.16-MariaDB-1:10.3.16+maria~bionic-log

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
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(70) NOT NULL,
  `surname` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (1,'Luis','Mendoza'),(2,'Luis','Mendoza'),(3,'Luis','Mendoza'),(4,'Luis T','Mendoza'),(5,'F T','Terrazas'),(6,'Luis T','Mendoza'),(7,'Luis T','Mendoza'),(8,'Luis T','Mendoza'),(9,'Luis T','Mendoza'),(10,'Luis T','Mendoza'),(11,'Luis T','Mendoza'),(12,'F T','Terrazas'),(13,'Luis T','Mendoza'),(14,'F T','Terrazas'),(15,'Luis T','Mendoza'),(16,'F T','Terrazas'),(17,'Luis T','Mendoza'),(19,'Luis21','Mendoza21'),(20,'F T','Terrazas'),(21,'Luis T','Mendoza'),(22,'F T','Terrazas'),(23,'Luis ZZ','ZZ'),(24,'F T','Terrazas');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `contact_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_id` (`contact_id`),
  CONSTRAINT `email_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email`
--

LOCK TABLES `email` WRITE;
/*!40000 ALTER TABLE `email` DISABLE KEYS */;
INSERT INTO `email` VALUES (5,'luis@atomoweb.com',11),(6,'info@atomoweb.com',11),(7,'luis2@atomoweb.com',12),(8,'info2@atomoweb.com',12),(9,'luis@atomoweb.com',13),(10,'info@atomoweb.com',13),(11,'luis2@atomoweb.com',14),(12,'info2@atomoweb.com',14),(13,'luis@atomoweb.com',15),(14,'info@atomoweb.com',15),(15,'luis2@atomoweb.com',16),(16,'info2@atomoweb.com',16),(17,'luis@atomoweb.com',17),(18,'info@atomoweb.com',17),(21,'test1@atomoweb.com',19),(22,'info@atomoweb.com',19),(23,'luis2@atomoweb.com',20),(24,'info2@atomoweb.com',20),(25,'luis@atomoweb.com',21),(26,'info@atomoweb.com',21),(27,'luis2@atomoweb.com',22),(28,'info2@atomoweb.com',22),(29,'luis@atomoweb.com',23),(30,'info@atomoweb.com',23),(31,'luis2@atomoweb.com',24),(32,'info2@atomoweb.com',24);
/*!40000 ALTER TABLE `email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phone`
--

DROP TABLE IF EXISTS `phone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) NOT NULL,
  `contact_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_id` (`contact_id`),
  CONSTRAINT `phone_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phone`
--

LOCK TABLES `phone` WRITE;
/*!40000 ALTER TABLE `phone` DISABLE KEYS */;
INSERT INTO `phone` VALUES (1,'+591.79821755',11),(2,'+591.12323232',11),(3,'+591.78881455',12),(4,'+591.14324232',12),(5,'+591.79821755',13),(6,'+591.12323232',13),(7,'+591.78881455',14),(8,'+591.14324232',14),(9,'+591.79821755',15),(10,'+591.12323232',15),(11,'+591.78881455',16),(12,'+591.14324232',16),(13,'+591.79821755',17),(14,'+591.12323232',17),(17,'1234',19),(18,'+591.12323232',19),(19,'+591.78881455',20),(20,'+591.14324232',20),(21,'+591.79821755',21),(22,'+591.12323232',21),(23,'+591.78881455',22),(24,'+591.14324232',22),(25,'+591.79821755',23),(26,'+591.12323232',23),(27,'+591.78881455',24),(28,'+591.14324232',24);
/*!40000 ALTER TABLE `phone` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-03  4:05:36
