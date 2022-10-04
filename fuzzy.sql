-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: fuzzy
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `kelompok`
--

DROP TABLE IF EXISTS `kelompok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kelompok` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kelompok` varchar(20) NOT NULL,
  `akses` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelompok`
--

LOCK TABLES `kelompok` WRITE;
/*!40000 ALTER TABLE `kelompok` DISABLE KEYS */;
INSERT INTO `kelompok` VALUES (1,'Karbohidrat','karbohidrat'),(2,'Waktu tanam','waktutanam'),(3,'Harga','harga');
/*!40000 ALTER TABLE `kelompok` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kriteria`
--

DROP TABLE IF EXISTS `kriteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kriteria` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama_kriteria` varchar(30) NOT NULL,
  `bawah` float(10,2) NOT NULL,
  `tengah` float(10,2) NOT NULL,
  `atas` float(10,2) NOT NULL,
  `kelompok` tinyint(2) NOT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kriteria`
--

LOCK TABLES `kriteria` WRITE;
/*!40000 ALTER TABLE `kriteria` DISABLE KEYS */;
INSERT INTO `kriteria` VALUES (1,'rendah',0.00,30.00,60.00,1,NULL),(2,'sedang',50.00,90.00,110.00,1,NULL),(3,'tinggi',100.00,130.00,150.00,1,NULL),(4,'pendek',0.00,2.00,5.00,2,NULL),(5,'panjang',3.00,8.00,12.00,2,NULL),(6,'murah',0.00,7000.00,12000.00,3,NULL),(7,'sedang',10000.00,20000.00,25000.00,3,NULL),(8,'mahal',23000.00,35000.00,50000.00,3,NULL);
/*!40000 ALTER TABLE `kriteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panen`
--

DROP TABLE IF EXISTS `panen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `panen` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tanaman` varchar(10) NOT NULL,
  `karbohidrat` varchar(20) NOT NULL,
  `waktutanam` varchar(10) NOT NULL,
  `harga` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panen`
--

LOCK TABLES `panen` WRITE;
/*!40000 ALTER TABLE `panen` DISABLE KEYS */;
INSERT INTO `panen` VALUES (1,'Beras','28 g/100 g','1 Tahun','12000'),(2,'Jagung','74 g/100 g','1 Tahun','6000'),(3,'Sagu','94 g/100 g','12 Tahun','38000'),(4,'Kentang','17 g/100 g','2 Tahun','15000'),(5,'Singkong','38 g/100 g','1 Tahun','5000'),(6,'Ubi','18 g/100 g','1 Tahun','12000');
/*!40000 ALTER TABLE `panen` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-10-04  9:44:04
