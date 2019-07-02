-- MySQL dump 10.16  Distrib 10.1.38-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: mysql    Database: newquery
-- ------------------------------------------------------
-- Server version	5.7.26

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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (1,'Wilmshorst','Tom','wilmshorst.tom@gmail.com',NULL,'Test','2019-06-07 13:10:00','2019-06-07 13:10:00');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fos_user`
--

LOCK TABLES `fos_user` WRITE;
/*!40000 ALTER TABLE `fos_user` DISABLE KEYS */;
INSERT INTO `fos_user` VALUES (1,'newquery','newquery','wilmshorst.tom@gmail.com','wilmshorst.tom@gmail.com',1,NULL,'$2y$13$W69V50jp4pbTBXHoFITTqeMaHx9mRS3ilw/g5rumRI9.v8ZXHxLHC','2019-06-07 09:30:53',NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}');
/*!40000 ALTER TABLE `fos_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parameter`
--

DROP TABLE IF EXISTS `parameter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parameter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `labels` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `parameters` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:array)',
  `template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parameter`
--

LOCK TABLES `parameter` WRITE;
/*!40000 ALTER TABLE `parameter` DISABLE KEYS */;
INSERT INTO `parameter` VALUES (1,'site_informations','a:2:{s:5:\"fr_FR\";s:20:\"Informations du site\";s:5:\"en_EN\";s:17:\"Site informations\";}','a:6:{s:9:\"site_name\";s:6:\"Jeanne\";s:12:\"contact_name\";s:15:\"Jeanne Fourneau\";s:13:\"contact_email\";s:25:\"jeanne.fourneau@gmail.com\";s:13:\"contact_phone\";N;s:15:\"contact_address\";s:29:\"60 rue de bapaume 59000 Lille\";s:12:\"localisation\";s:26:\"actuellement à casablanca\";}','site_informations.html.twig',NULL),(2,'social','a:2:{s:5:\"fr_FR\";s:14:\"Social network\";s:5:\"en_EN\";s:14:\"Social network\";}','a:0:{}','social.html.twig',NULL),(3,'localisation','a:2:{s:5:\"fr_FR\";s:33:\"Actuellement à Casablanca, Maroc\";s:5:\"en_EN\";s:32:\"Currently in Casablance, Morroco\";}','a:0:{}',NULL,NULL),(4,'home_image','a:2:{s:5:\"fr_FR\";s:15:\"Image d\'accueil\";s:5:\"en_EN\";s:11:\"Cover image\";}','a:0:{}','home_image.html.twig','/uploads/Secheresse-AFP.jpg');
/*!40000 ALTER TABLE `parameter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portrait`
--

DROP TABLE IF EXISTS `portrait`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portrait` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `labels` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `descriptions` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:array)',
  `online` tinyint(1) NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portrait`
--

LOCK TABLES `portrait` WRITE;
/*!40000 ALTER TABLE `portrait` DISABLE KEYS */;
/*!40000 ALTER TABLE `portrait` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portrait_tag`
--

DROP TABLE IF EXISTS `portrait_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portrait_tag` (
  `portrait_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`portrait_id`,`tag_id`),
  KEY `IDX_4CFB5A5D1226EBF3` (`portrait_id`),
  KEY `IDX_4CFB5A5DBAD26311` (`tag_id`),
  CONSTRAINT `FK_4CFB5A5D1226EBF3` FOREIGN KEY (`portrait_id`) REFERENCES `portrait` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_4CFB5A5DBAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portrait_tag`
--

LOCK TABLES `portrait_tag` WRITE;
/*!40000 ALTER TABLE `portrait_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `portrait_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publication`
--

DROP TABLE IF EXISTS `publication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `labels` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `descriptions` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `online` tinyint(1) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated` datetime DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publication`
--

LOCK TABLES `publication` WRITE;
/*!40000 ALTER TABLE `publication` DISABLE KEYS */;
INSERT INTO `publication` VALUES (1,'massire','a:2:{s:5:\"fr_FR\";s:65:\"Massire, \"le chemin\" d\'une nouvelle gestion de l’eau au Maghreb\";s:5:\"en_EN\";s:65:\"Massire, \"le chemin\" d\'une nouvelle gestion de l’eau au Maghreb\";}','a:2:{s:5:\"fr_FR\";s:384:\"<p>Au d&eacute;but du mois, &eacute;tait lanc&eacute; &agrave; Rabat un grand projet pour la gestion de l&rsquo;eau en zone rurale au Maghreb. Baptis&eacute; &ldquo;Massire&rdquo;, il devrait s&rsquo;&eacute;taler sur quatre ans pour former les populations locales &agrave; une utilisation plus fructueuse de l&rsquo;eau, et &agrave; un d&eacute;veloppement du patrimoine rural.</p>\r\n\";s:5:\"en_EN\";s:384:\"<p>Au d&eacute;but du mois, &eacute;tait lanc&eacute; &agrave; Rabat un grand projet pour la gestion de l&rsquo;eau en zone rurale au Maghreb. Baptis&eacute; &ldquo;Massire&rdquo;, il devrait s&rsquo;&eacute;taler sur quatre ans pour former les populations locales &agrave; une utilisation plus fructueuse de l&rsquo;eau, et &agrave; un d&eacute;veloppement du patrimoine rural.</p>\r\n\";}','/uploads/Secheresse-AFP%20%281%29.jpg',1,'massire-le-destin-dune-nouvelle-gestion-de-leau-au-maghreb','2019-06-06 11:48:40','https://telquel.ma/2019/05/29/massire-le-destin-dune-nouvelle-gestion-de-leau-au-maghreb_1640028');
/*!40000 ALTER TABLE `publication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publication_tag`
--

DROP TABLE IF EXISTS `publication_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publication_tag` (
  `publication_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`publication_id`,`tag_id`),
  KEY `IDX_20D75B4C38B217A7` (`publication_id`),
  KEY `IDX_20D75B4CBAD26311` (`tag_id`),
  CONSTRAINT `FK_20D75B4C38B217A7` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_20D75B4CBAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publication_tag`
--

LOCK TABLES `publication_tag` WRITE;
/*!40000 ALTER TABLE `publication_tag` DISABLE KEYS */;
INSERT INTO `publication_tag` VALUES (1,1),(1,2),(1,3);
/*!40000 ALTER TABLE `publication_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serie`
--

DROP TABLE IF EXISTS `serie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `labels` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:array)',
  `online` tinyint(1) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:array)',
  `descriptions` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:array)',
  `date_sent` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serie`
--

LOCK TABLES `serie` WRITE;
/*!40000 ALTER TABLE `serie` DISABLE KEYS */;
/*!40000 ALTER TABLE `serie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serie_tag`
--

DROP TABLE IF EXISTS `serie_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serie_tag` (
  `serie_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`serie_id`,`tag_id`),
  KEY `IDX_DD5453A9D94388BD` (`serie_id`),
  KEY `IDX_DD5453A9BAD26311` (`tag_id`),
  CONSTRAINT `FK_DD5453A9BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_DD5453A9D94388BD` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serie_tag`
--

LOCK TABLES `serie_tag` WRITE;
/*!40000 ALTER TABLE `serie_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `serie_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `son`
--

DROP TABLE IF EXISTS `son`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `son` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `labels` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `descriptions` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:array)',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(555) COLLATE utf8mb4_unicode_ci NOT NULL,
  `online` tinyint(1) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `son`
--

LOCK TABLES `son` WRITE;
/*!40000 ALTER TABLE `son` DISABLE KEYS */;
/*!40000 ALTER TABLE `son` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `son_tag`
--

DROP TABLE IF EXISTS `son_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `son_tag` (
  `son_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`son_id`,`tag_id`),
  KEY `IDX_F0EA100E65EFA242` (`son_id`),
  KEY `IDX_F0EA100EBAD26311` (`tag_id`),
  CONSTRAINT `FK_F0EA100E65EFA242` FOREIGN KEY (`son_id`) REFERENCES `son` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_F0EA100EBAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `son_tag`
--

LOCK TABLES `son_tag` WRITE;
/*!40000 ALTER TABLE `son_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `son_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (1,'Maroc'),(2,'Massire'),(3,'Secheresse');
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-11 15:22:20
