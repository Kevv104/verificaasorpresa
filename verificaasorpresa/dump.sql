/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.14-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: verificaasorpresaDB
-- ------------------------------------------------------
-- Server version	10.11.14-MariaDB-0ubuntu0.24.04.1

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
-- Table structure for table `Catalogo`
--

DROP TABLE IF EXISTS `Catalogo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Catalogo` (
  `fid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `costo` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`fid`,`pid`),
  KEY `fk_catalogo_pezzo` (`pid`),
  CONSTRAINT `fk_catalogo_fornitore` FOREIGN KEY (`fid`) REFERENCES `Fornitori` (`fid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_catalogo_pezzo` FOREIGN KEY (`pid`) REFERENCES `Pezzi` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Catalogo`
--

LOCK TABLES `Catalogo` WRITE;
/*!40000 ALTER TABLE `Catalogo` DISABLE KEYS */;
INSERT INTO `Catalogo` VALUES
(1,1,10.00),
(1,2,20.00),
(1,3,15.00),
(2,1,12.00),
(2,3,16.00),
(2,4,5.00),
(3,2,22.00),
(3,3,15.00),
(3,5,8.00),
(4,4,6.00),
(4,6,18.00),
(4,7,20.00),
(5,1,11.00),
(5,3,17.00),
(5,5,9.00);
/*!40000 ALTER TABLE `Catalogo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Fornitori`
--

DROP TABLE IF EXISTS `Fornitori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Fornitori` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `fnome` varchar(100) NOT NULL,
  `indirizzo` varchar(255) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Fornitori`
--

LOCK TABLES `Fornitori` WRITE;
/*!40000 ALTER TABLE `Fornitori` DISABLE KEYS */;
INSERT INTO `Fornitori` VALUES
(1,'Acme','Via Roma 10, Milano'),
(2,'SupplyCo','Via Torino 5, Roma'),
(3,'PartsRUs','Corso Venezia 12, Torino'),
(4,'MegaSupply','Piazza Napoli 7, Napoli'),
(5,'RedParts','Via Firenze 3, Firenze');
/*!40000 ALTER TABLE `Fornitori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pezzi`
--

DROP TABLE IF EXISTS `Pezzi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `Pezzi` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `pnome` varchar(100) NOT NULL,
  `colore` varchar(100) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pezzi`
--

LOCK TABLES `Pezzi` WRITE;
/*!40000 ALTER TABLE `Pezzi` DISABLE KEYS */;
INSERT INTO `Pezzi` VALUES
(1,'Bullone','rosso'),
(2,'Vite','verde'),
(3,'Dado','rosso'),
(4,'Rondella','blu'),
(5,'Chiodo','rosso'),
(6,'Molla','verde'),
(7,'Perno','rosso'),
(8,'RondellaSpeciale','verde');
/*!40000 ALTER TABLE `Pezzi` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-23  7:52:51
