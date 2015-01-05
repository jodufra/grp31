CREATE DATABASE  IF NOT EXISTS `db-grp31` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db-grp31`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: db-grp31
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.14.04.1

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
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends` (
  `user_id` int(10) unsigned NOT NULL,
  `friend_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`,`friend_id`),
  KEY `friends_friend_id_foreign` (`friend_id`),
  CONSTRAINT `friends_friend_id_foreign` FOREIGN KEY (`friend_id`) REFERENCES `users` (`id`),
  CONSTRAINT `friends_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `winner` int(10) unsigned DEFAULT NULL,
  `finished_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `games_winner_foreign` (`winner`),
  CONSTRAINT `games_winner_foreign` FOREIGN KEY (`winner`) REFERENCES `players` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES (1,'',NULL,NULL,'2015-01-05 16:47:34','2015-01-05 16:47:34');
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games_have_players`
--

DROP TABLE IF EXISTS `games_have_players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games_have_players` (
  `game_id` int(10) unsigned NOT NULL,
  `player_id` int(10) unsigned NOT NULL,
  `player_num` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`player_num`,`game_id`,`player_id`),
  KEY `games_have_players_game_id_foreign` (`game_id`),
  KEY `games_have_players_player_id_foreign` (`player_id`),
  CONSTRAINT `games_have_players_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  CONSTRAINT `games_have_players_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games_have_players`
--

LOCK TABLES `games_have_players` WRITE;
/*!40000 ALTER TABLE `games_have_players` DISABLE KEYS */;
INSERT INTO `games_have_players` VALUES (1,10,1,'2015-01-05 16:47:34','2015-01-05 16:47:34'),(1,14,2,'2015-01-05 16:47:34','2015-01-05 16:47:34');
/*!40000 ALTER TABLE `games_have_players` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_29_230424_create_people_table',1),('2014_10_31_120640_create_users_table',1),('2014_11_02_033330_create_password_reminders_table',1),('2014_12_10_123439_create_players_table',1),('2014_12_10_125926_create_games_table',1),('2014_12_10_130612_create_games_have_players_table',1),('2014_12_10_131001_create_spectators_table',1),('2014_12_10_132157_create_moves_table',1),('2014_12_19_045507_user_person_relation',1),('2014_12_19_045605_user_player_relation',1),('2014_12_19_045709_winner_game_relation',1),('2014_12_19_045745_games_players_relation',1),('2014_12_19_045831_player_spectator_game_relation',1),('2014_12_19_045904_player_move_game_relation',1),('2015_01_03_045345_create_friends_table',1),('2015_01_03_045649_add_users_friends_relation',1),('2015_01_03_175407_create_tournaments_table',1),('2015_01_03_180807_tournament_has_games',1),('2015_01_04_045745_tournament_game_relation',1),('2015_01_03_180807_tournament_has_players',3),('2015_01_05_046745_tournament_player_relation',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moves`
--

DROP TABLE IF EXISTS `moves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moves` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `game_id` int(10) unsigned NOT NULL,
  `player_id` int(10) unsigned NOT NULL,
  `diceshand` decimal(5,0) DEFAULT NULL,
  `dicessaved` decimal(5,0) DEFAULT NULL,
  `s_ones` tinyint(3) unsigned DEFAULT NULL,
  `s_twos` tinyint(3) unsigned DEFAULT NULL,
  `s_threes` tinyint(3) unsigned DEFAULT NULL,
  `s_fours` tinyint(3) unsigned DEFAULT NULL,
  `s_fives` tinyint(3) unsigned DEFAULT NULL,
  `s_sixes` tinyint(3) unsigned DEFAULT NULL,
  `s_bonus` tinyint(3) unsigned DEFAULT NULL,
  `s_threekind` tinyint(3) unsigned DEFAULT NULL,
  `s_fourkind` tinyint(3) unsigned DEFAULT NULL,
  `s_house` tinyint(3) unsigned DEFAULT NULL,
  `s_small_s` tinyint(3) unsigned DEFAULT NULL,
  `s_large_s` tinyint(3) unsigned DEFAULT NULL,
  `s_chance` tinyint(3) unsigned DEFAULT NULL,
  `s_yahtzee` tinyint(3) unsigned DEFAULT NULL,
  `choice` enum('ROLL','REROLL','ONES','TWOS','THREES','FOURS','FIVES','SIXES','THREEKIND','FOURKIND','HOUSE','SMALL_S','LARGE_S','CHANCE','YAHTZEE') COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`,`game_id`),
  KEY `moves_game_id_foreign` (`game_id`),
  KEY `moves_player_id_foreign` (`player_id`),
  CONSTRAINT `moves_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  CONSTRAINT `moves_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moves`
--

LOCK TABLES `moves` WRITE;
/*!40000 ALTER TABLE `moves` DISABLE KEYS */;
/*!40000 ALTER TABLE `moves` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reminders`
--

DROP TABLE IF EXISTS `password_reminders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_reminders_email_index` (`email`),
  KEY `password_reminders_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reminders`
--

LOCK TABLES `password_reminders` WRITE;
/*!40000 ALTER TABLE `password_reminders` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reminders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `people` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `phone` decimal(9,0) DEFAULT NULL,
  `facebook_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `credit_card_titular` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `credit_card_num` decimal(16,0) NOT NULL,
  `credit_card_valid` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `people_user_id_foreign` (`user_id`),
  CONSTRAINT `people_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `people`
--

LOCK TABLES `people` WRITE;
/*!40000 ALTER TABLE `people` DISABLE KEYS */;
INSERT INTO `people` VALUES (1,1,'eliasjsp pinheiro','/img/default.png','0000-00-00','Bahrain',NULL,NULL,'','','elias pinheiro',1234567890123,'0000-00-00','2015-01-04 22:44:14','2015-01-04 22:44:14'),(2,2,'wasdfasdf asdfasf','/img/default.png','0000-00-00','Afghanistan',NULL,NULL,'','','asdfasfdasdf',1234567897894,'0000-00-00','2015-01-04 22:58:46','2015-01-04 22:58:46'),(3,3,'wefsadf sadfsdfsa','/img/default.png','0000-00-00','Afghanistan',NULL,NULL,'','','sadfsafsafasdfad',1234567890123,'0000-00-00','2015-01-05 11:11:25','2015-01-05 11:11:25'),(4,4,'dzcasdf zccz','/img/default.png','0000-00-00','Afghanistan',NULL,NULL,'','','sdfasdfasfsfasdf',1234567890123,'0000-00-00','2015-01-05 11:44:03','2015-01-05 11:44:03'),(5,5,'fas sadfsaf','/img/default.png','0000-00-00','Afghanistan',NULL,NULL,'','','sdfsafd',1234567890123,'0000-00-00','2015-01-05 16:47:17','2015-01-05 16:47:17');
/*!40000 ALTER TABLE `people` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `players`
--

DROP TABLE IF EXISTS `players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `players` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `players_user_id_foreign` (`user_id`),
  CONSTRAINT `players_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `players`
--

LOCK TABLES `players` WRITE;
/*!40000 ALTER TABLE `players` DISABLE KEYS */;
INSERT INTO `players` VALUES (1,NULL,'2015-01-04 22:42:37','2015-01-04 22:42:37'),(2,NULL,'2015-01-04 22:42:37','2015-01-04 22:42:37'),(3,NULL,'2015-01-04 22:42:37','2015-01-04 22:42:37'),(4,NULL,'2015-01-04 22:42:37','2015-01-04 22:42:37'),(5,NULL,'2015-01-04 22:42:37','2015-01-04 22:42:37'),(6,NULL,'2015-01-04 22:42:37','2015-01-04 22:42:37'),(7,NULL,'2015-01-04 22:42:37','2015-01-04 22:42:37'),(8,NULL,'2015-01-04 22:42:37','2015-01-04 22:42:37'),(9,NULL,'2015-01-04 22:42:37','2015-01-04 22:42:37'),(10,1,'2015-01-04 22:44:14','2015-01-04 22:44:14'),(11,2,'2015-01-04 22:58:46','2015-01-04 22:58:46'),(12,3,'2015-01-05 11:11:25','2015-01-05 11:11:25'),(13,4,'2015-01-05 11:44:03','2015-01-05 11:44:03'),(14,5,'2015-01-05 16:47:17','2015-01-05 16:47:17');
/*!40000 ALTER TABLE `players` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spectators`
--

DROP TABLE IF EXISTS `spectators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spectators` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `game_id` int(10) unsigned NOT NULL,
  `player_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `spectators_game_id_foreign` (`game_id`),
  KEY `spectators_player_id_foreign` (`player_id`),
  CONSTRAINT `spectators_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  CONSTRAINT `spectators_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spectators`
--

LOCK TABLES `spectators` WRITE;
/*!40000 ALTER TABLE `spectators` DISABLE KEYS */;
/*!40000 ALTER TABLE `spectators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournament_have_games`
--

DROP TABLE IF EXISTS `tournament_have_games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournament_have_games` (
  `tournament_id` int(10) unsigned NOT NULL,
  `game_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `tournament_have_games_tournament_id_foreign` (`tournament_id`),
  KEY `tournament_have_games_game_id_foreign` (`game_id`),
  CONSTRAINT `tournament_have_games_game_id_foreign` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  CONSTRAINT `tournament_have_games_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournament_have_games`
--

LOCK TABLES `tournament_have_games` WRITE;
/*!40000 ALTER TABLE `tournament_have_games` DISABLE KEYS */;
/*!40000 ALTER TABLE `tournament_have_games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournament_have_players`
--

DROP TABLE IF EXISTS `tournament_have_players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournament_have_players` (
  `tournament_id` int(10) unsigned NOT NULL,
  `player_id` int(10) unsigned NOT NULL,
  `position` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `tournament_have_players_tournament_id_foreign` (`tournament_id`),
  KEY `tournament_have_players_player_id_foreign` (`player_id`),
  CONSTRAINT `tournament_have_players_player_id_foreign` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`),
  CONSTRAINT `tournament_have_players_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournament_have_players`
--

LOCK TABLES `tournament_have_players` WRITE;
/*!40000 ALTER TABLE `tournament_have_players` DISABLE KEYS */;
INSERT INTO `tournament_have_players` VALUES (3,10,0,'2015-01-05 19:57:19','2015-01-05 19:57:19'),(4,10,0,'2015-01-05 20:54:59','2015-01-05 20:54:59'),(4,10,0,'2015-01-05 20:59:42','2015-01-05 20:59:42');
/*!40000 ALTER TABLE `tournament_have_players` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournaments`
--

DROP TABLE IF EXISTS `tournaments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournaments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `begin` datetime NOT NULL,
  `ends` datetime NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `prize` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tournaments_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournaments`
--

LOCK TABLES `tournaments` WRITE;
/*!40000 ALTER TABLE `tournaments` DISABLE KEYS */;
INSERT INTO `tournaments` VALUES (1,'dasddfasdf','0000-00-00 00:00:00','0000-00-00 00:00:00','sdafasdfs','asdfasdfasdf','2015-01-05 16:59:24','2015-01-05 16:59:24'),(2,'testeee','1979-09-21 09:30:00','2015-01-05 18:14:00','dasfsdfasd','asdfasdfasdf','2015-01-05 18:14:25','2015-01-05 18:14:25'),(3,'Best Player','1979-09-23 10:30:00','1979-09-30 05:35:00','Try, you can be the best player.','1st: 500$\r\n2nd: 100$\r\n3rd: 50$','2015-01-05 19:12:22','2015-01-05 19:12:22'),(4,'teste aaaa','2015-03-13 09:30:00','2015-05-14 09:30:00','hellooooo','booiiii','2015-01-05 20:19:44','2015-01-05 20:19:44'),(5,'dadProject','2015-06-11 15:50:00','2015-08-20 21:50:00','asdfgdafgasgasd','gsafdgdsfgdfgdg','2015-01-05 22:18:22','2015-01-05 22:18:22');
/*!40000 ALTER TABLE `tournaments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(10) unsigned NOT NULL,
  `wins` int(10) unsigned NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','schmeisk@gmail.com','$2y$10$5sXfKwl.ZVuC29EZpxbP1uAo2huiEuq1y751NZPP/uv9TzRB1vzUe',0,0,'xpBB8Ao9lXmycoZrjofaBCxAlnsxWERPrhwDYfD8n2wFFu7YNrHXlDsVjh2s','2015-01-04 22:44:14','2015-01-05 20:21:06'),(2,'admin2','sdf@f.vo','$2y$10$2epGTzn6LMqsEQvIGUtfYu4a45lIa8HuPbM7Hl4x0ZGkulF7SOX3q',0,0,NULL,'2015-01-04 22:58:46','2015-01-04 22:58:46'),(3,'2120174','schmeisdfk@gmail.comf','$2y$10$1sV5h7noHHNVhV6ysB1mp.bqI.TCY1Nwx1iqo6tZoqqxsROmZvYka',0,0,'jlhzok8675ZvqhqUDIqQxhyHv9eE7fsbRyds5AqLSOqX4O8JN0gK2KDCrgYa','2015-01-05 11:11:25','2015-01-05 11:11:34'),(4,'sdfsadf','sdfs@kkk.com','$2y$10$RFUEZ29MxdDQEtE/GKmpu.4FZXROuRSV7SNKizXXqvylEgRo0ybQ2',0,0,'7pyEo8AaDkXtsqHYTlUL315rOO0hoIaYEmILMdujIDpaPp8o128Mpj9s7sYg','2015-01-05 11:44:03','2015-01-05 11:44:56'),(5,'admin1','sdd@hot.com','$2y$10$89IcNmJJ.wkehqQCwG/hYeMXr5i9HoQ11wuyHMamg3EkRDcKrKljK',0,0,NULL,'2015-01-05 16:47:17','2015-01-05 16:47:17');
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

-- Dump completed on 2015-01-05 23:42:16
