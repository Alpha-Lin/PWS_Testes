-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: stonksquiz
-- ------------------------------------------------------
-- Server version	8.0.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `critere`
--

DROP TABLE IF EXISTS `critere`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `critere` (
  `id` int NOT NULL AUTO_INCREMENT,
  `teste_id` int NOT NULL,
  `score_max` double NOT NULL,
  `score_defaut` double NOT NULL,
  `interpretation_max_texte` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interpretation_min_texte` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interpretation_max_couleur` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interpretation_min_couleur` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_critere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7F6A805380AA0132` (`teste_id`),
  CONSTRAINT `FK_7F6A805380AA0132` FOREIGN KEY (`teste_id`) REFERENCES `teste` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `critere`
--

LOCK TABLES `critere` WRITE;
/*!40000 ALTER TABLE `critere` DISABLE KEYS */;
INSERT INTO `critere` VALUES (1,1,20,0,'A1','A2','#ff0000','#0080ff','Crit1'),(2,1,20,0,'B1','B2','#00ff80','#80ffff','Crit2'),(3,2,30,0,'A1','A2','#ff0000','#0080ff','Crit1'),(4,2,30,0,'B1','B2','#00ff80','#ff8000','Crit2'),(5,2,30,0,'C1','C2','#804000','#8000ff','Crit3'),(6,3,15,0,'A','A','#0080ff','#0080ff','Crit1'),(7,3,15,0,'B','B','#ff0000','#ff0000','Crit2'),(8,3,15,0,'C','C','#00ff80','#00ff80','Crit3'),(9,3,15,0,'D','D','#ff8040','#ff8040','Crit4'),(10,3,15,0,'E','E','#804000','#804000','Crit5');
/*!40000 ALTER TABLE `critere` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `critere_solution`
--

DROP TABLE IF EXISTS `critere_solution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `critere_solution` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tentative_id` int DEFAULT NULL,
  `critere_id` int DEFAULT NULL,
  `point` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7CA5386DD78CE477` (`tentative_id`),
  KEY `IDX_7CA5386D9E5F45AB` (`critere_id`),
  CONSTRAINT `FK_7CA5386D9E5F45AB` FOREIGN KEY (`critere_id`) REFERENCES `critere` (`id`),
  CONSTRAINT `FK_7CA5386DD78CE477` FOREIGN KEY (`tentative_id`) REFERENCES `tentative` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `critere_solution`
--

LOCK TABLES `critere_solution` WRITE;
/*!40000 ALTER TABLE `critere_solution` DISABLE KEYS */;
INSERT INTO `critere_solution` VALUES (1,1,1,3),(2,1,2,6),(3,2,3,15),(4,2,4,6),(5,2,5,-10),(6,3,6,5),(7,3,8,9),(8,3,10,14),(9,3,7,3);
/*!40000 ALTER TABLE `critere_solution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20231208194224','2023-12-08 19:42:26',993);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `objet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `been_send` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B6BD307FF624B39D` (`sender_id`),
  KEY `IDX_B6BD307FCD53EDB6` (`receiver_id`),
  CONSTRAINT `FK_B6BD307FCD53EDB6` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_B6BD307FF624B39D` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question` (
  `id` int NOT NULL AUTO_INCREMENT,
  `teste_id` int NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B6F7494E80AA0132` (`teste_id`),
  CONSTRAINT `FK_B6F7494E80AA0132` FOREIGN KEY (`teste_id`) REFERENCES `teste` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (1,1,'Q1'),(2,1,'Q2'),(3,1,'Q3'),(4,2,'Q1'),(5,2,'Q2'),(6,2,'Q3'),(7,3,'Q1'),(8,3,'Q2'),(9,3,'Q3'),(10,3,'Q4');
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rememberme_token`
--

DROP TABLE IF EXISTS `rememberme_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rememberme_token` (
  `series` varchar(88) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(88) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastUsed` datetime NOT NULL,
  `class` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`series`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rememberme_token`
--

LOCK TABLES `rememberme_token` WRITE;
/*!40000 ALTER TABLE `rememberme_token` DISABLE KEYS */;
/*!40000 ALTER TABLE `rememberme_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reset_password_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`),
  CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reset_password_request`
--

LOCK TABLES `reset_password_request` WRITE;
/*!40000 ALTER TABLE `reset_password_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `reset_password_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solution`
--

DROP TABLE IF EXISTS `solution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solution` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question_id` int NOT NULL,
  `critere_id` int DEFAULT NULL,
  `nom_solution` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `point` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9F3329DB1E27F6BF` (`question_id`),
  KEY `IDX_9F3329DB9E5F45AB` (`critere_id`),
  CONSTRAINT `FK_9F3329DB1E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`),
  CONSTRAINT `FK_9F3329DB9E5F45AB` FOREIGN KEY (`critere_id`) REFERENCES `critere` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solution`
--

LOCK TABLES `solution` WRITE;
/*!40000 ALTER TABLE `solution` DISABLE KEYS */;
INSERT INTO `solution` VALUES (1,1,1,'1',5),(2,1,1,'2',0),(3,2,2,'1',10),(4,2,2,'2',6),(5,3,1,'1',-2),(6,3,1,'2',5),(7,4,3,'S1',15),(8,4,3,'S2',-10),(9,5,4,'S1',6),(10,5,4,'S2',26),(11,6,5,'S1',-10),(12,6,5,'S2',-14),(13,7,6,'S1',5),(14,7,7,'S2',8),(15,8,8,'S1',9),(16,8,9,'S2',4),(17,9,10,'S1',14),(18,9,6,'S2',2),(19,10,7,'S1',3),(20,10,8,'S2',4);
/*!40000 ALTER TABLE `solution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solution_tentative`
--

DROP TABLE IF EXISTS `solution_tentative`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solution_tentative` (
  `solution_id` int NOT NULL,
  `tentative_id` int NOT NULL,
  PRIMARY KEY (`solution_id`,`tentative_id`),
  KEY `IDX_D3E31E91C0BE183` (`solution_id`),
  KEY `IDX_D3E31E9D78CE477` (`tentative_id`),
  CONSTRAINT `FK_D3E31E91C0BE183` FOREIGN KEY (`solution_id`) REFERENCES `solution` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_D3E31E9D78CE477` FOREIGN KEY (`tentative_id`) REFERENCES `tentative` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solution_tentative`
--

LOCK TABLES `solution_tentative` WRITE;
/*!40000 ALTER TABLE `solution_tentative` DISABLE KEYS */;
/*!40000 ALTER TABLE `solution_tentative` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tentative`
--

DROP TABLE IF EXISTS `tentative`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tentative` (
  `id` int NOT NULL AUTO_INCREMENT,
  `teste_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `date_tentative` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DBC382F980AA0132` (`teste_id`),
  KEY `IDX_DBC382F9A76ED395` (`user_id`),
  CONSTRAINT `FK_DBC382F980AA0132` FOREIGN KEY (`teste_id`) REFERENCES `teste` (`id`),
  CONSTRAINT `FK_DBC382F9A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tentative`
--

LOCK TABLES `tentative` WRITE;
/*!40000 ALTER TABLE `tentative` DISABLE KEYS */;
INSERT INTO `tentative` VALUES (1,1,1,'2023-12-08 21:26:30'),(2,2,1,'2023-12-08 21:27:22'),(3,3,1,'2023-12-08 21:27:55');
/*!40000 ALTER TABLE `tentative` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teste`
--

DROP TABLE IF EXISTS `teste`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teste` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `type_teste_id` int DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `image_teste` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E6B4490FA76ED395` (`user_id`),
  KEY `IDX_E6B4490F4D5526CE` (`type_teste_id`),
  CONSTRAINT `FK_E6B4490F4D5526CE` FOREIGN KEY (`type_teste_id`) REFERENCES `type_teste` (`id`),
  CONSTRAINT `FK_E6B4490FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teste`
--

LOCK TABLES `teste` WRITE;
/*!40000 ALTER TABLE `teste` DISABLE KEYS */;
INSERT INTO `teste` VALUES (1,1,1,'Quizz en bâton','Un excellent quizz en bâton',NULL),(2,1,2,'Quizz horizontal','Un exemple de quizz horizontal',NULL),(3,1,3,'Quizz en radar','Un exemple de quizz en radar',NULL);
/*!40000 ALTER TABLE `teste` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_teste`
--

DROP TABLE IF EXISTS `type_teste`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `type_teste` (
  `id` int NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_teste`
--

LOCK TABLES `type_teste` WRITE;
/*!40000 ALTER TABLE `type_teste` DISABLE KEYS */;
INSERT INTO `type_teste` VALUES (1,'baton','Diagramme en bâton'),(2,'horizontal','Diagramme horizontal'),(3,'radar','Diagramme en radar');
/*!40000 ALTER TABLE `type_teste` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Rorne','[]','$2y$13$KYCCodvfpskShe8m4pJCSOGyptNbiu8kVc/2MnXDSjA6R48E45wSW','romain.msiah@gmail.com',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-08 22:28:59
