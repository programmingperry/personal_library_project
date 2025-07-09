-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: booknook
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
-- Table structure for table `aquired`
--

DROP TABLE IF EXISTS `aquired`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aquired` (
  `aqID` int(11) NOT NULL AUTO_INCREMENT,
  `aquiredTitle` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`aqID`),
  UNIQUE KEY `aquiredTitle` (`aquiredTitle`) USING HASH
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author` (
  `aID` int(11) NOT NULL AUTO_INCREMENT,
  `authorName` varchar(1000) NOT NULL,
  `country` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`aID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book` (
  `bID` int(11) NOT NULL AUTO_INCREMENT,
  `fID` int(11) NOT NULL,
  `bookTitle` varchar(1000) NOT NULL,
  `publishingYear` year(4) DEFAULT NULL,
  `nonFiction` varchar(250) DEFAULT NULL,
  `dateStarted` date DEFAULT NULL,
  `dateFinished` date DEFAULT NULL,
  `pages` int(11) DEFAULT NULL,
  `hours` int(11) DEFAULT NULL,
  `minutes` int(11) DEFAULT NULL,
  `image` varchar(3000) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `dnf` tinyint(1) DEFAULT 0,
  `owned` tinyint(1) DEFAULT 0,
  `lID` int(11) DEFAULT NULL,
  PRIMARY KEY (`bID`),
  KEY `fID` (`fID`),
  CONSTRAINT `book_ibfk_1` FOREIGN KEY (`fID`) REFERENCES `format` (`fID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `books_aquired`
--

DROP TABLE IF EXISTS `books_aquired`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books_aquired` (
  `bID` int(11) NOT NULL,
  `aqID` int(11) NOT NULL,
  PRIMARY KEY (`bID`,`aqID`),
  KEY `aqID` (`aqID`),
  CONSTRAINT `books_aquired_ibfk_1` FOREIGN KEY (`bID`) REFERENCES `book` (`bID`),
  CONSTRAINT `books_aquired_ibfk_2` FOREIGN KEY (`aqID`) REFERENCES `aquired` (`aqID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `books_authors`
--

DROP TABLE IF EXISTS `books_authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books_authors` (
  `bID` int(11) NOT NULL,
  `aID` int(11) NOT NULL,
  PRIMARY KEY (`bID`,`aID`),
  KEY `aID` (`aID`),
  CONSTRAINT `books_authors_ibfk_1` FOREIGN KEY (`bID`) REFERENCES `book` (`bID`) ON DELETE CASCADE,
  CONSTRAINT `books_authors_ibfk_2` FOREIGN KEY (`aID`) REFERENCES `author` (`aID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `books_genres`
--

DROP TABLE IF EXISTS `books_genres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books_genres` (
  `bID` int(11) NOT NULL,
  `gID` int(11) NOT NULL,
  PRIMARY KEY (`bID`,`gID`),
  KEY `gID` (`gID`),
  CONSTRAINT `books_genres_ibfk_1` FOREIGN KEY (`bID`) REFERENCES `book` (`bID`) ON DELETE CASCADE,
  CONSTRAINT `books_genres_ibfk_2` FOREIGN KEY (`gID`) REFERENCES `genre` (`gID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `books_tags`
--

DROP TABLE IF EXISTS `books_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books_tags` (
  `bID` int(11) NOT NULL,
  `tID` int(11) NOT NULL,
  PRIMARY KEY (`bID`,`tID`),
  KEY `tID` (`tID`),
  CONSTRAINT `books_tags_ibfk_1` FOREIGN KEY (`bID`) REFERENCES `book` (`bID`) ON DELETE CASCADE,
  CONSTRAINT `books_tags_ibfk_2` FOREIGN KEY (`tID`) REFERENCES `tag` (`tID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `format`
--

DROP TABLE IF EXISTS `format`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `format` (
  `fID` int(11) NOT NULL AUTO_INCREMENT,
  `formatName` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`fID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genre` (
  `gID` int(11) NOT NULL AUTO_INCREMENT,
  `genreTitle` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`gID`),
  UNIQUE KEY `genreTitle` (`genreTitle`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `language` (
  `lID` int(11) NOT NULL AUTO_INCREMENT,
  `languageName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`lID`),
  UNIQUE KEY `languageName` (`languageName`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `tID` int(11) NOT NULL AUTO_INCREMENT,
  `tagTitle` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`tID`),
  UNIQUE KEY `tagTitle` (`tagTitle`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-09 11:17:10
