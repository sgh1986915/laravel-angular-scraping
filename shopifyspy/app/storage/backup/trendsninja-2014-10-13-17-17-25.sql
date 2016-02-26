-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: trendsninja
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
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
INSERT INTO `favorites` VALUES (1,'Trevor Knight','2014-10-07 15:34:11','2014-10-07 15:34:11',0),(2,'Seahawks','2014-10-07 15:44:31','2014-10-07 15:44:31',0),(3,'Blake Lively','2014-10-07 18:47:12','2014-10-07 18:47:12',0),(4,'Adrian Peterson','2014-10-07 21:43:43','2014-10-07 21:43:43',0),(5,'Gone Girl','2014-10-07 21:54:16','2014-10-07 21:54:16',0),(6,'Twin Peaks','2014-10-07 21:56:44','2014-10-07 21:56:44',0),(7,'Disney Frozen Sparkle Princess Elsa Doll','2014-10-08 22:01:20','2014-10-08 22:01:20',0),(8,'Ebola Haemorrhagic Fever','2014-10-08 22:05:21','2014-10-08 22:05:21',0),(9,'American Horror Story','2014-10-09 17:53:31','2014-10-09 17:53:31',0),(10,'American Horror Story','2014-10-09 17:53:41','2014-10-09 17:53:41',0),(11,'American Horror Story','2014-10-09 17:55:18','2014-10-09 17:55:18',0),(12,'American Horror Story','2014-10-09 17:55:49','2014-10-09 17:55:49',0),(13,'American Horror Story','2014-10-09 17:57:40','2014-10-09 17:57:40',0),(14,'American Horror Story','2014-10-09 17:58:46','2014-10-09 17:58:46',0),(15,'American Horror Story','2014-10-09 18:03:40','2014-10-09 18:03:40',0),(16,'American Horror Story','2014-10-09 18:04:10','2014-10-09 18:04:10',6),(17,'Lorde','2014-10-10 02:28:55','2014-10-10 02:28:55',6),(18,'Lorde','2014-10-10 21:46:41','2014-10-10 21:46:41',6),(19,'Walking Dead','2014-10-13 11:37:55','2014-10-13 11:37:55',3),(20,'Walking Dead','2014-10-13 11:53:54','2014-10-13 11:53:54',6),(21,'Walking Dead','2014-10-13 11:53:56','2014-10-13 11:53:56',6),(22,'Walking Dead','2014-10-13 11:55:15','2014-10-13 11:55:15',6),(23,'Walking Dead','2014-10-13 11:56:32','2014-10-13 11:56:32',6),(24,'Walking Dead','2014-10-13 12:02:13','2014-10-13 12:02:13',6),(25,'Walking Dead','2014-10-13 12:02:14','2014-10-13 12:02:14',6),(26,'Walking Dead','2014-10-13 12:03:23','2014-10-13 12:03:23',6),(27,'Walking Dead','2014-10-13 12:03:23','2014-10-13 12:03:23',6),(28,'Walking Dead','2014-10-13 12:08:13','2014-10-13 12:08:13',6),(29,'Walking Dead','2014-10-13 12:08:16','2014-10-13 12:08:16',6),(30,'Seahawks','2014-10-13 12:10:55','2014-10-13 12:10:55',6),(31,'Bengals','2014-10-13 12:11:10','2014-10-13 12:11:10',6),(32,'John Luke Robertson','2014-10-13 12:11:13','2014-10-13 12:11:13',6),(33,'Orioles','2014-10-13 12:11:53','2014-10-13 12:11:53',6),(34,'Vikings','2014-10-13 12:11:55','2014-10-13 12:11:55',6),(35,'Auburn Football','2014-10-13 12:11:57','2014-10-13 12:11:57',6);
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (5,'Users','{\"users\":1}','2014-10-13 21:08:56','2014-10-13 21:08:56'),(6,'Admins','{\"admin\":1,\"users\":1}','2014-10-13 21:08:56','2014-10-13 21:08:56');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libraries`
--

DROP TABLE IF EXISTS `libraries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libraries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `src` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libraries`
--

LOCK TABLES `libraries` WRITE;
/*!40000 ALTER TABLE `libraries` DISABLE KEYS */;
INSERT INTO `libraries` VALUES (1,0,'http://thekey.xpn.org/2014/03/09/a-sold-out-crowd-worships-lordes-royal-debut-at-the-tower-theatre/','2014-10-10 08:23:53','2014-10-10 08:23:53','image','http://ts2.mm.bing.net/th?id=HN.608036222605724127&w=265&h=176&c=7&rs=1&pid=1.7'),(2,0,'http://thekey.xpn.org/2014/03/09/a-sold-out-crowd-worships-lordes-royal-debut-at-the-tower-theatre/','2014-10-10 08:24:28','2014-10-10 08:24:28','image','http://ts2.mm.bing.net/th?id=HN.608036222605724127&w=265&h=176&c=7&rs=1&pid=1.7'),(3,0,'http://www.huffingtonpost.com/2013/07/24/lorde-interview_n_3644831.html','2014-10-10 08:26:58','2014-10-10 08:26:58','image','http://ts2.mm.bing.net/th?id=HN.608046633610643536&w=266&h=176&c=7&rs=1&pid=1.7'),(4,6,'http://www.fanpop.com/clubs/american-horror-story/images/25850437/title/american-horror-story-wallpaper','2014-10-10 08:59:46','2014-10-10 08:59:46','image','http://ts1.mm.bing.net/th?id=HN.608018192333734478&w=232&h=174&c=7&rs=1&pid=1.7'),(5,6,'http://youtu.be/EF_IsA8NC8k','2014-10-10 08:59:57','2014-10-10 08:59:57','video','https://i.ytimg.com/vi/EF_IsA8NC8k/hqdefault.jpg'),(6,6,'http://amoviediary.tumblr.com/post/20226691842/american-horror-story','2014-10-10 21:08:00','2014-10-10 21:08:00','image','http://ts1.mm.bing.net/th?id=HN.608011599556117819&w=304&h=169&c=7&rs=1&pid=1.7'),(7,6,'http://youtu.be/zlhDo6Z49L8','2014-10-10 21:44:25','2014-10-10 21:44:25','video','https://i.ytimg.com/vi/zlhDo6Z49L8/hqdefault.jpg');
/*!40000 ALTER TABLE `libraries` ENABLE KEYS */;
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
INSERT INTO `migrations` VALUES ('2012_12_06_225921_migration_cartalyst_sentry_install_users',1),('2012_12_06_225929_migration_cartalyst_sentry_install_groups',1),('2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot',1),('2012_12_06_225988_migration_cartalyst_sentry_install_throttle',1),('2014_10_05_191726_create_favorites_table',1),('2014_10_08_191844_create_libraries_table',2),('2014_10_09_140108_remove_user_from_favorites_table',3),('2014_10_09_140219_add_user_id_to_favorites_table',4),('2014_10_10_041728_add_type_to_libraries_table',5),('2014_10_10_041843_add_thumbnail_to_libraries_table',6),('2014_10_10_041930_remove_url_from_libraries_table',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `throttle`
--

DROP TABLE IF EXISTS `throttle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `throttle`
--

LOCK TABLES `throttle` WRITE;
/*!40000 ALTER TABLE `throttle` DISABLE KEYS */;
INSERT INTO `throttle` VALUES (1,3,NULL,0,0,0,NULL,NULL,NULL),(2,4,NULL,0,0,0,NULL,NULL,NULL),(3,5,NULL,0,0,0,NULL,NULL,NULL),(4,6,NULL,0,0,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `throttle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (7,'admin@admin.com','$2y$10$TU3dCECP2xAgNWg2aOdyBuhgp3kY/WugeKsQB0./3R/es0ng8m.6K',NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-10-13 21:08:56','2014-10-13 21:08:56'),(8,'user@user.com','$2y$10$BFKJFIKIykqaucdceOxMh.8FwlKOOirJ4pMwfAZgSM.uYFi9/F/wy',NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-10-13 21:08:56','2014-10-13 21:08:56');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_groups`
--

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` VALUES (7,5),(7,6),(8,5);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-13 13:19:14
