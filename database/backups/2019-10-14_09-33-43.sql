-- MySQL dump 10.13  Distrib 5.6.45, for Linux (x86_64)
--
-- Host: localhost    Database: dev_ivas_template_laravel5.8
-- ------------------------------------------------------
-- Server version	5.6.45

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_foreign` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Aflam','1550152145324.jpg','2019-02-14 18:49:05','2019-02-14 18:49:05',NULL),(2,'Music','1552552611379.jpg','2019-02-14 19:35:00','2019-03-14 12:36:51',NULL),(3,'Arabic','1552552637642.jpg','2019-03-06 14:01:44','2019-03-14 12:37:17',1),(5,'English','1552552649795.jpg','2019-03-14 12:37:29','2019-03-14 12:37:29',1),(6,'Arabic Music','1552552673699.jpg','2019-03-14 12:37:53','2019-03-14 12:47:32',2),(7,'English Music','1552552689643.jpg','2019-03-14 12:38:09','2019-03-14 12:47:47',2),(8,'Amr Diab','1552552713880.jpg','2019-03-14 12:38:33','2019-03-14 12:38:33',6),(9,'Tamer Ashour','155255273259.jpg','2019-03-14 12:38:52','2019-03-14 12:38:52',6),(10,'Action','1552552922566.jpg','2019-03-14 12:42:02','2019-10-14 13:04:49',1),(11,'Romantic','1552552933190.jpg','2019-03-14 12:42:13','2019-03-14 12:42:13',3),(12,'selena gomez','155255298255.jpg','2019-03-14 12:43:02','2019-03-14 12:43:02',7),(14,'Adele Lyrics','1552553075139.jpg','2019-03-14 12:44:35','2019-03-14 12:44:35',7),(15,'Horror','1552553097809.jpg','2019-03-14 12:44:57','2019-03-14 12:44:57',5),(16,'Scientific','1552553141894.jpg','2019-03-14 12:45:41','2019-03-14 12:45:41',5);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content_types`
--

DROP TABLE IF EXISTS `content_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content_types`
--

LOCK TABLES `content_types` WRITE;
/*!40000 ALTER TABLE `content_types` DISABLE KEYS */;
INSERT INTO `content_types` VALUES (1,'Advanced Text','2019-02-14 18:05:42','2019-02-14 18:05:42'),(2,'Normal Text','2019-02-14 18:06:12','2019-02-14 18:06:12'),(3,'Image','2019-02-14 18:06:27','2019-02-14 18:06:27'),(4,'Audio','2019-02-14 18:06:34','2019-02-14 18:06:34'),(5,'Video','2019-02-14 18:06:38','2019-02-14 18:06:38'),(6,'external video link','2019-03-06 13:02:01','2019-03-06 13:02:01');
/*!40000 ALTER TABLE `content_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_preview` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_type_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `patch_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contents_content_type_id_foreign` (`content_type_id`),
  KEY `contents_category_id_foreign` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents`
--

LOCK TABLES `contents` WRITE;
/*!40000 ALTER TABLE `contents` DISABLE KEYS */;
INSERT INTO `contents` VALUES (23,'video 1','1552553197895.mp4','1552553196267.jpg',5,3,'12354','2019-03-14 12:46:37','2019-03-14 12:46:37'),(24,'audio 1','155255330417.mp3',NULL,4,12,'1234','2019-03-14 12:48:24','2019-03-14 12:48:24'),(25,'audio 2','1552553335747.mp3',NULL,4,9,'12456','2019-03-14 12:48:55','2019-03-14 12:48:55');
/*!40000 ALTER TABLE `contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Egypt','2019-02-11 18:12:04','2019-02-11 18:12:04'),(2,'KSA','2019-02-11 18:12:10','2019-02-11 18:12:10'),(3,'yosuefas','2019-10-14 13:03:02','2019-10-14 13:03:17');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delete_all_flags`
--

DROP TABLE IF EXISTS `delete_all_flags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delete_all_flags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `route_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `delete_all_flags_route_id_foreign` (`route_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delete_all_flags`
--

LOCK TABLES `delete_all_flags` WRITE;
/*!40000 ALTER TABLE `delete_all_flags` DISABLE KEYS */;
/*!40000 ALTER TABLE `delete_all_flags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `short_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rtl` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'yosuef','2019-10-14 13:05:40','2019-10-14 13:05:40','1',0),(2,'yosuefas','2019-10-14 13:06:06','2019-10-14 13:06:06','2',0);
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2017_08_01_141233_create_permission_tables',1),(2,'2019_04_22_161443_create_categories_table',1),(3,'2019_04_22_161443_create_content_types_table',1),(4,'2019_04_22_161443_create_contents_table',1),(5,'2019_04_22_161443_create_countries_table',1),(6,'2019_04_22_161443_create_delete_all_flags_table',1),(7,'2019_04_22_161443_create_languages_table',1),(8,'2019_04_22_161443_create_operators_table',1),(9,'2019_04_22_161443_create_password_resets_table',1),(10,'2019_04_22_161443_create_permissions_table',1),(11,'2019_04_22_161443_create_posts_table',1),(12,'2019_04_22_161443_create_rbt_codes_table',1),(13,'2019_04_22_161443_create_relations_table',1),(14,'2019_04_22_161443_create_role_has_permissions_table',1),(15,'2019_04_22_161443_create_role_route_table',1),(16,'2019_04_22_161443_create_roles_table',1),(17,'2019_04_22_161443_create_routes_table',1),(18,'2019_04_22_161443_create_scaffoldinterfaces_table',1),(19,'2019_04_22_161443_create_settings_table',1),(20,'2019_04_22_161443_create_static_bodies_table',1),(21,'2019_04_22_161443_create_static_translations_table',1),(22,'2019_04_22_161443_create_tans_bodies_table',1),(23,'2019_04_22_161443_create_translatables_table',1),(24,'2019_04_22_161443_create_types_table',1),(25,'2019_04_22_161443_create_user_has_permissions_table',1),(26,'2019_04_22_161443_create_user_has_roles_table',1),(27,'2019_04_22_161443_create_users_table',1),(28,'2019_04_22_161445_add_foreign_keys_to_categories_table',1),(29,'2019_04_22_161445_add_foreign_keys_to_contents_table',1),(30,'2019_04_22_161445_add_foreign_keys_to_delete_all_flags_table',1),(31,'2019_04_22_161445_add_foreign_keys_to_operators_table',1),(32,'2019_04_22_161445_add_foreign_keys_to_posts_table',1),(33,'2019_04_22_161445_add_foreign_keys_to_rbt_codes_table',1),(34,'2019_04_22_161445_add_foreign_keys_to_relations_table',1),(35,'2019_04_22_161445_add_foreign_keys_to_role_has_permissions_table',1),(36,'2019_04_22_161445_add_foreign_keys_to_role_route_table',1),(37,'2019_04_22_161445_add_foreign_keys_to_settings_table',1),(38,'2019_04_22_161445_add_foreign_keys_to_static_bodies_table',1),(39,'2019_04_22_161445_add_foreign_keys_to_tans_bodies_table',1),(40,'2019_04_22_161445_add_foreign_keys_to_user_has_permissions_table',1),(41,'2019_04_22_161445_add_foreign_keys_to_user_has_roles_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operators`
--

DROP TABLE IF EXISTS `operators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operators` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rbt_sms_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rbt_ussd_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `operators_country_id_foreign` (`country_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operators`
--

LOCK TABLES `operators` WRITE;
/*!40000 ALTER TABLE `operators` DISABLE KEYS */;
INSERT INTO `operators` VALUES (1,'etisalat','123','1234','1552552540477.png',1,'2019-02-11 18:12:35','2019-03-14 12:35:40'),(4,'Vodafone','123','','1552552433218.png',1,'2019-02-11 20:23:49','2019-03-14 12:33:53'),(5,'Orange','123456789','123','1552552570122.png',1,'2019-03-14 12:36:10','2019-03-14 12:36:10');
/*!40000 ALTER TABLE `operators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `published_date` date NOT NULL,
  `active` tinyint(1) NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_id` int(10) unsigned NOT NULL,
  `operator_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_content_id_foreign` (`content_id`),
  KEY `posts_operator_id_foreign` (`operator_id`),
  KEY `posts_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rbt_codes`
--

DROP TABLE IF EXISTS `rbt_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rbt_codes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rbt_code` int(11) NOT NULL,
  `content_id` int(10) unsigned NOT NULL,
  `operator_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rbt_codes_content_id_foreign` (`content_id`),
  KEY `rbt_codes_operator_id_foreign` (`operator_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rbt_codes`
--

LOCK TABLES `rbt_codes` WRITE;
/*!40000 ALTER TABLE `rbt_codes` DISABLE KEYS */;
INSERT INTO `rbt_codes` VALUES (1,12345,24,1,'2019-03-14 12:51:28','2019-03-14 12:51:28'),(3,133,24,4,'2019-03-14 12:52:51','2019-03-14 12:52:51'),(4,1235,24,5,'2019-03-14 12:52:51','2019-03-14 12:52:51');
/*!40000 ALTER TABLE `rbt_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relations`
--

DROP TABLE IF EXISTS `relations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `scaffoldinterface_id` int(10) unsigned NOT NULL,
  `to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `having` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `relations_scaffoldinterface_id_foreign` (`scaffoldinterface_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relations`
--

LOCK TABLES `relations` WRITE;
/*!40000 ALTER TABLE `relations` DISABLE KEYS */;
/*!40000 ALTER TABLE `relations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_route`
--

DROP TABLE IF EXISTS `role_route`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `route_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id_2` (`role_id`),
  KEY `route_id_2` (`route_id`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_route`
--

LOCK TABLES `role_route` WRITE;
/*!40000 ALTER TABLE `role_route` DISABLE KEYS */;
INSERT INTO `role_route` VALUES (1,1,120,'2019-02-14 18:01:13','2019-02-14 18:01:13'),(2,6,120,'2019-02-14 18:01:13','2019-02-14 18:01:13'),(3,1,121,'2019-02-14 18:01:13','2019-02-14 18:01:13'),(4,6,121,'2019-02-14 18:01:13','2019-02-14 18:01:13'),(5,1,122,'2019-02-14 18:01:13','2019-02-14 18:01:13'),(6,6,122,'2019-02-14 18:01:13','2019-02-14 18:01:13'),(7,1,123,'2019-02-14 18:01:13','2019-02-14 18:01:13'),(8,6,123,'2019-02-14 18:01:13','2019-02-14 18:01:13'),(9,1,124,'2019-02-14 18:01:13','2019-02-14 18:01:13'),(10,6,124,'2019-02-14 18:01:13','2019-02-14 18:01:13'),(11,1,125,'2019-02-14 18:01:13','2019-02-14 18:01:13'),(12,6,125,'2019-02-14 18:01:13','2019-02-14 18:01:13'),(13,1,126,'2019-02-14 18:01:13','2019-02-14 18:01:13'),(14,6,126,'2019-02-14 18:01:13','2019-02-14 18:01:13'),(15,1,127,'2019-02-14 18:02:21','2019-02-14 18:02:21'),(16,6,127,'2019-02-14 18:02:21','2019-02-14 18:02:21'),(17,1,128,'2019-02-14 18:02:21','2019-02-14 18:02:21'),(18,6,128,'2019-02-14 18:02:21','2019-02-14 18:02:21'),(19,1,129,'2019-02-14 18:02:21','2019-02-14 18:02:21'),(20,6,129,'2019-02-14 18:02:21','2019-02-14 18:02:21'),(21,1,130,'2019-02-14 18:02:22','2019-02-14 18:02:22'),(22,6,130,'2019-02-14 18:02:22','2019-02-14 18:02:22'),(23,1,131,'2019-02-14 18:02:22','2019-02-14 18:02:22'),(24,6,131,'2019-02-14 18:02:22','2019-02-14 18:02:22'),(25,1,132,'2019-02-14 18:02:22','2019-02-14 18:02:22'),(26,6,132,'2019-02-14 18:02:22','2019-02-14 18:02:22'),(27,1,133,'2019-02-14 18:02:22','2019-02-14 18:02:22'),(28,6,133,'2019-02-14 18:02:22','2019-02-14 18:02:22'),(29,1,134,'2019-02-14 18:03:26','2019-02-14 18:03:26'),(30,6,134,'2019-02-14 18:03:26','2019-02-14 18:03:26'),(31,1,135,'2019-02-14 18:03:26','2019-02-14 18:03:26'),(32,6,135,'2019-02-14 18:03:26','2019-02-14 18:03:26'),(33,1,136,'2019-02-14 18:03:26','2019-02-14 18:03:26'),(34,6,136,'2019-02-14 18:03:26','2019-02-14 18:03:26'),(35,1,137,'2019-02-14 18:03:26','2019-02-14 18:03:26'),(36,6,137,'2019-02-14 18:03:26','2019-02-14 18:03:26'),(37,1,138,'2019-02-14 18:03:26','2019-02-14 18:03:26'),(38,6,138,'2019-02-14 18:03:26','2019-02-14 18:03:26'),(39,1,139,'2019-02-14 18:03:26','2019-02-14 18:03:26'),(40,6,139,'2019-02-14 18:03:26','2019-02-14 18:03:26'),(41,1,140,'2019-02-14 18:03:26','2019-02-14 18:03:26'),(42,6,140,'2019-02-14 18:03:26','2019-02-14 18:03:26'),(43,1,141,'2019-02-14 18:04:09','2019-02-14 18:04:09'),(44,6,141,'2019-02-14 18:04:09','2019-02-14 18:04:09'),(45,1,142,'2019-02-14 18:04:09','2019-02-14 18:04:09'),(46,6,142,'2019-02-14 18:04:09','2019-02-14 18:04:09'),(47,1,143,'2019-02-14 18:04:09','2019-02-14 18:04:09'),(48,6,143,'2019-02-14 18:04:09','2019-02-14 18:04:09'),(49,1,144,'2019-02-14 18:04:09','2019-02-14 18:04:09'),(50,6,144,'2019-02-14 18:04:09','2019-02-14 18:04:09'),(51,1,145,'2019-02-14 18:04:09','2019-02-14 18:04:09'),(52,6,145,'2019-02-14 18:04:09','2019-02-14 18:04:09'),(53,1,146,'2019-02-14 18:04:09','2019-02-14 18:04:09'),(54,6,146,'2019-02-14 18:04:09','2019-02-14 18:04:09'),(55,1,147,'2019-02-14 18:04:09','2019-02-14 18:04:09'),(56,6,147,'2019-02-14 18:04:09','2019-02-14 18:04:09'),(57,1,148,'2019-03-06 14:00:28','2019-03-06 14:00:28'),(58,6,148,'2019-03-06 14:00:28','2019-03-06 14:00:28'),(59,1,149,'2019-03-06 14:00:28','2019-03-06 14:00:28'),(60,6,149,'2019-03-06 14:00:28','2019-03-06 14:00:28'),(61,1,150,'2019-03-06 14:00:28','2019-03-06 14:00:28'),(62,6,150,'2019-03-06 14:00:28','2019-03-06 14:00:28'),(63,1,151,'2019-03-06 14:00:28','2019-03-06 14:00:28'),(64,6,151,'2019-03-06 14:00:28','2019-03-06 14:00:28'),(65,1,152,'2019-03-06 14:00:28','2019-03-06 14:00:28'),(66,6,152,'2019-03-06 14:00:28','2019-03-06 14:00:28'),(67,1,153,'2019-03-06 14:00:28','2019-03-06 14:00:28'),(68,6,153,'2019-03-06 14:00:28','2019-03-06 14:00:28'),(69,1,154,'2019-03-06 14:00:28','2019-03-06 14:00:28'),(70,6,154,'2019-03-06 14:00:28','2019-03-06 14:00:28'),(71,1,155,'2019-03-14 12:51:14','2019-03-14 12:51:14'),(72,6,155,'2019-03-14 12:51:14','2019-03-14 12:51:14'),(73,1,156,'2019-03-14 12:51:14','2019-03-14 12:51:14'),(74,6,156,'2019-03-14 12:51:14','2019-03-14 12:51:14'),(75,1,157,'2019-03-14 12:51:15','2019-03-14 12:51:15'),(76,6,157,'2019-03-14 12:51:15','2019-03-14 12:51:15'),(77,1,158,'2019-03-14 12:51:15','2019-03-14 12:51:15'),(78,6,158,'2019-03-14 12:51:15','2019-03-14 12:51:15'),(79,1,159,'2019-03-14 12:51:15','2019-03-14 12:51:15'),(80,6,159,'2019-03-14 12:51:15','2019-03-14 12:51:15'),(81,1,160,'2019-03-14 12:51:15','2019-03-14 12:51:15'),(82,6,160,'2019-03-14 12:51:15','2019-03-14 12:51:15'),(83,1,161,'2019-03-14 12:51:15','2019-03-14 12:51:15'),(84,6,161,'2019-03-14 12:51:15','2019-03-14 12:51:15'),(85,1,41,'2019-10-14 12:06:01','2019-10-14 12:06:01');
/*!40000 ALTER TABLE `role_route` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_priority` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'super_admin',3,'2017-11-09 11:13:14','2017-11-09 11:13:14'),(6,'admin',2,'2018-01-08 19:40:19','2018-01-08 19:40:19'),(7,'yousef2',1,'2019-10-14 12:05:11','2019-10-14 12:05:17');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `method` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `controller_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `function_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=164 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `routes`
--

LOCK TABLES `routes` WRITE;
/*!40000 ALTER TABLE `routes` DISABLE KEYS */;
INSERT INTO `routes` VALUES (2,'get','setting/new','SettingController','2018-02-05 18:39:21','2018-02-05 18:39:21','create'),(3,'post','setting','SettingController','2018-02-05 18:39:21','2018-02-05 18:39:21','store'),(4,'get','dashboard','DashboardController','2018-02-05 18:39:21','2018-07-24 17:47:45','index'),(5,'get','/','DashboardController','2018-02-05 18:39:21','2018-02-05 18:39:21','index'),(6,'get','user_profile','UserController','2018-02-05 18:39:21','2018-02-05 18:39:21','profile'),(7,'post','user_profile/updatepassword','UserController','2018-02-05 18:39:21','2017-11-14 17:29:01','UpdatePassword'),(8,'post','user_profile/updateprofilepic','UserController','2018-02-05 18:39:21','2017-11-14 17:29:08','UpdateProfilePicture'),(9,'post','user_profile/updateuserdata','UserController','2018-02-05 18:39:21','2017-11-14 17:29:19','UpdateNameAndEmail'),(10,'get','setting/{id}/delete','SettingController','2018-02-05 18:39:21','2018-02-05 18:39:22','destroy'),(11,'get','setting/{id}/edit','SettingController','2018-02-05 18:39:21','2018-02-05 18:39:21','edit'),(12,'post','setting/{id}','SettingController','2018-02-05 18:39:21','2018-02-05 18:56:27','update'),(14,'get','static_translation','StaticTranslationController','2018-02-05 18:39:21','2017-11-14 17:29:57','index'),(21,'get','file_manager','DashboardController','2018-02-05 18:39:21','2018-02-05 18:39:21','file_manager'),(22,'get','upload_items','DashboardController','2018-02-05 18:39:21','2018-02-05 18:39:21','multi_upload'),(23,'post','save_items','DashboardController','2018-02-05 18:39:21','2018-02-05 18:39:21','save_uploaded'),(24,'get','upload_resize','DashboardController','2018-02-05 18:39:21','2018-02-05 18:39:21','upload_resize'),(25,'post','save_image','DashboardController','2018-02-05 18:39:21','2018-02-05 18:39:21','save_image'),(26,'post','static_translation/{id}/update','StaticTranslationController','2018-02-05 18:39:21','2017-11-12 17:19:46','update'),(27,'get','static_translation/{id}/delete','StaticTranslationController','2018-02-05 18:39:21','2018-02-05 18:39:21','destroy'),(28,'get','language/{id}/delete','LanguageController','2018-02-05 18:39:21','2018-02-05 18:39:21','destroy'),(29,'post','language/{id}/update','LanguageController','2018-02-05 18:39:21','2018-02-05 18:39:21','update'),(30,'get','roles','RoleController','2018-02-05 18:39:21','2018-02-05 18:39:21','index'),(31,'get','roles/new','RoleController','2018-02-05 18:39:21','2018-02-05 18:39:21','create'),(32,'post','roles','RoleController','2018-02-05 18:39:21','2018-02-05 18:39:21','store'),(33,'get','roles/{id}/delete','RoleController','2018-02-05 18:39:21','2018-02-05 18:39:21','destroy'),(34,'get','roles/{id}/edit','RoleController','2018-02-05 18:39:21','2018-02-05 18:39:21','edit'),(35,'post','roles/{id}/update','RoleController','2018-02-05 18:39:21','2018-02-05 18:39:21','update'),(36,'get','language','LanguageController','2018-02-05 18:39:21','2018-02-05 18:39:21','index'),(37,'get','language/create','LanguageController','2018-02-05 18:39:21','2018-02-05 18:39:21','create'),(38,'post','language','LanguageController','2018-02-05 18:39:21','2018-02-05 18:39:21','store'),(39,'get','language/{id}/edit','LanguageController','2018-02-05 18:39:21','2018-02-05 18:39:21','edit'),(40,'get','all_routes','RouteController','2018-02-05 18:39:21','2019-10-13 15:51:33','index'),(41,'post','all_routes','RouteController','2018-02-05 18:39:21','2019-10-14 12:06:01','store'),(42,'get','routes/{id}/edit','RouteController','2018-02-05 18:39:21','2018-02-05 18:39:21','edit'),(43,'post','routes/{id}/update','RouteController','2018-02-05 18:39:21','2018-01-28 14:25:29','update'),(44,'get','routes/{id}/delete','RouteController','2018-02-05 18:39:21','2018-02-05 18:39:21','destroy'),(45,'get','routes/create','RouteController','2018-02-05 18:39:21','2018-02-05 18:39:21','create'),(57,'get','routes/index_v2','RouteController','2017-11-12 18:45:15','2017-11-12 19:04:53','index_v2'),(58,'get','roles/{id}/view_access','RoleController','2017-11-14 15:56:14','2017-11-15 13:14:14','view_access'),(59,'get','types/index','TypeController','2018-01-28 13:25:37','2018-01-28 13:25:37','index'),(60,'get','types/create','TypeController','2018-01-28 13:25:37','2018-01-28 13:25:37','create'),(61,'post','types','TypeController','2018-01-28 13:25:38','2018-01-28 13:25:38','store'),(62,'get','types/{id}/edit','TypeController','2018-01-28 13:25:38','2018-01-28 13:25:38','edit'),(63,'patch','types/{id}','TypeController','2018-01-28 13:25:38','2018-01-28 13:25:38','update'),(64,'get','types/{id}/delete','TypeController','2018-01-28 13:25:38','2018-01-28 13:25:38','destroy'),(65,'post','sortabledatatable','SettingController','2018-01-28 14:22:00','2018-01-28 14:22:00','updateOrder'),(66,'get','buildroutes','RouteController','2018-01-28 14:23:55','2018-01-28 14:23:55','buildroutes'),(69,'get','delete_all','DashboardController','2018-02-04 17:01:23','2018-02-04 17:01:23','delete_all_index'),(70,'post','delete_all','DashboardController','2018-02-04 17:01:23','2018-02-04 17:01:23','delete_all_store'),(71,'get','upload_resize_v2','DashboardController','2018-02-04 18:02:56','2018-02-04 18:02:56','upload_resize_v2'),(72,'post','sortabledatatable','UserController','2018-02-05 18:39:22','2018-02-05 18:39:22','updateOrder'),(79,'get','setting','SettingController','2018-02-05 19:10:10','2018-02-05 19:10:10','index'),(80,'get','users','UserController','2018-05-31 13:42:21','2018-05-31 13:42:21','index'),(81,'get','users/new','UserController','2018-05-31 13:42:21','2018-05-31 13:42:21','create'),(82,'post','users','UserController','2018-05-31 13:42:21','2018-05-31 13:42:21','store'),(83,'get','users/{id}/edit','UserController','2018-05-31 13:42:21','2018-05-31 13:42:21','edit'),(84,'post','users/{id}/update','UserController','2018-05-31 13:42:21','2018-05-31 13:42:21','update'),(106,'get','country','CountryController','2019-02-10 13:09:36','2019-02-10 13:09:36','index'),(107,'get','country/create','CountryController','2019-02-10 13:09:36','2019-02-10 13:09:36','create'),(108,'post','country','CountryController','2019-02-10 13:09:36','2019-02-10 13:09:36','store'),(109,'get','country/{id}','CountryController','2019-02-10 13:09:36','2019-02-10 13:09:36','show'),(110,'get','country/{id}/edit','CountryController','2019-02-10 13:09:37','2019-02-10 13:09:37','edit'),(111,'patch','country/{id}','CountryController','2019-02-10 13:09:37','2019-02-10 13:10:42','update'),(112,'get','country/{id}/delete','CountryController','2019-02-10 13:09:37','2019-02-10 13:09:37','delete'),(113,'get','operator','OperatorController','2019-02-10 13:10:27','2019-02-10 13:10:27','index'),(114,'get','operator/create','OperatorController','2019-02-10 13:10:27','2019-02-10 13:10:27','create'),(115,'post','operator','OperatorController','2019-02-10 13:10:27','2019-02-10 13:10:27','store'),(116,'get','operator/{id}','OperatorController','2019-02-10 13:10:27','2019-02-10 13:10:27','show'),(117,'get','operator/{id}/edit','OperatorController','2019-02-10 13:10:27','2019-02-10 13:10:27','edit'),(118,'patch','operator/{id}','OperatorController','2019-02-10 13:10:27','2019-02-10 13:10:27','update'),(119,'get','operator/{id}/delete','OperatorController','2019-02-10 13:10:27','2019-02-10 13:10:27','destroy'),(120,'get','category','CategoryController','2019-02-14 18:01:13','2019-02-14 18:01:13','index'),(121,'get','category/create','CategoryController','2019-02-14 18:01:13','2019-02-14 18:01:13','create'),(122,'post','category','CategoryController','2019-02-14 18:01:13','2019-02-14 18:01:13','store'),(123,'get','category/{id}','CategoryController','2019-02-14 18:01:13','2019-02-14 18:01:13','show'),(124,'get','category/{id}/edit','CategoryController','2019-02-14 18:01:13','2019-02-14 18:01:13','edit'),(125,'patch','category/{id}','CategoryController','2019-02-14 18:01:13','2019-02-14 18:01:13','update'),(126,'get','category/{id}/delete','CategoryController','2019-02-14 18:01:13','2019-02-14 18:01:13','destroy'),(127,'get','content_type','ContentTypeController','2019-02-14 18:02:21','2019-02-14 18:02:21','index'),(128,'get','content_type/create','ContentTypeController','2019-02-14 18:02:21','2019-02-14 18:02:21','create'),(129,'post','content_type','ContentTypeController','2019-02-14 18:02:21','2019-02-14 18:02:21','store'),(130,'get','content_type/{id}','ContentTypeController','2019-02-14 18:02:21','2019-02-14 18:02:21','show'),(131,'get','content_type/{id}/edit','ContentTypeController','2019-02-14 18:02:22','2019-02-14 18:02:22','edit'),(132,'patch','content_type/{id}','ContentTypeController','2019-02-14 18:02:22','2019-02-14 18:02:22','update'),(133,'get','content_type/{id}/delete','ContentTypeController','2019-02-14 18:02:22','2019-02-14 18:02:22','destroy'),(134,'get','content','ContentController','2019-02-14 18:03:26','2019-02-14 18:03:26','index'),(135,'get','content/create','ContentController','2019-02-14 18:03:26','2019-02-14 18:03:26','create'),(136,'post','content','ContentController','2019-02-14 18:03:26','2019-02-14 18:03:26','store'),(137,'get','content/{id}','ContentController','2019-02-14 18:03:26','2019-02-14 18:03:26','show'),(138,'get','content/{id}/edit','ContentController','2019-02-14 18:03:26','2019-02-14 18:03:26','edit'),(139,'patch','content/{id}','ContentController','2019-02-14 18:03:26','2019-02-14 18:03:26','update'),(140,'get','content/{id}/delete','ContentController','2019-02-14 18:03:26','2019-02-14 18:03:26','destroy'),(141,'get','post','PostController','2019-02-14 18:04:09','2019-02-14 18:04:09','index'),(142,'get','post/create','PostController','2019-02-14 18:04:09','2019-02-14 18:04:09','create'),(143,'post','post','PostController','2019-02-14 18:04:09','2019-02-14 18:04:09','store'),(144,'get','post/{id}','PostController','2019-02-14 18:04:09','2019-02-14 18:04:09','show'),(145,'get','post/{id}/edit','PostController','2019-02-14 18:04:09','2019-02-14 18:04:09','edit'),(146,'patch','post/{id}','PostController','2019-02-14 18:04:09','2019-02-14 18:04:09','update'),(147,'get','post/{id}/delete','PostController','2019-02-14 18:04:09','2019-02-14 18:04:09','destroy'),(148,'get','sub_category','SubCategoryController','2019-03-06 14:00:28','2019-03-06 14:00:28','index'),(149,'get','sub_category/create','SubCategoryController','2019-03-06 14:00:28','2019-03-06 14:00:28','create'),(150,'post','sub_category','SubCategoryController','2019-03-06 14:00:28','2019-03-06 14:00:28','store'),(151,'get','sub_category/{id}','SubCategoryController','2019-03-06 14:00:28','2019-03-06 14:00:28','show'),(152,'get','sub_category/{id}/edit','SubCategoryController','2019-03-06 14:00:28','2019-03-06 14:00:28','edit'),(153,'patch','sub_category/{id}','SubCategoryController','2019-03-06 14:00:28','2019-03-06 14:00:28','update'),(154,'get','sub_category/{id}/delete','SubCategoryController','2019-03-06 14:00:28','2019-03-06 14:00:28','destroy'),(155,'get','rbt','RbtController','2019-03-14 12:51:14','2019-03-14 12:51:14','index'),(156,'get','rbt/create','RbtController','2019-03-14 12:51:14','2019-03-14 12:51:14','create'),(157,'post','rbt','RbtController','2019-03-14 12:51:15','2019-03-14 12:51:15','store'),(158,'get','rbt/{id}','RbtController','2019-03-14 12:51:15','2019-03-14 12:51:15','show'),(159,'get','rbt/{id}/edit','RbtController','2019-03-14 12:51:15','2019-03-14 12:51:15','edit'),(160,'patch','rbt/{id}','RbtController','2019-03-14 12:51:15','2019-03-14 12:51:15','update'),(161,'get','rbt/{id}/delete','RbtController','2019-03-14 12:51:15','2019-03-14 12:51:15','destroy'),(162,'get','users/{id}/delete','UserController','2019-10-13 15:51:03','2019-10-13 15:51:03','destroy'),(163,'get','migrate_tables','DashboardController','2019-10-13 16:09:15','2019-10-13 17:02:42','migrate_tables');
/*!40000 ALTER TABLE `routes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scaffoldinterfaces`
--

DROP TABLE IF EXISTS `scaffoldinterfaces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scaffoldinterfaces` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `package` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `controller` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tablename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scaffoldinterfaces`
--

LOCK TABLES `scaffoldinterfaces` WRITE;
/*!40000 ALTER TABLE `scaffoldinterfaces` DISABLE KEYS */;
/*!40000 ALTER TABLE `scaffoldinterfaces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `settings_type_id_foreign` (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (25,'uploadAllow','video','2018-02-04 17:04:09','2019-02-11 20:09:42',6,0),(27,'enable_testing','0','2019-02-11 20:14:30','2019-02-11 20:15:45',7,0),(28,'content_type_flag','0','2019-03-07 15:50:04','2019-03-14 12:54:06',7,0);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `static_bodies`
--

DROP TABLE IF EXISTS `static_bodies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `static_bodies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(10) unsigned NOT NULL,
  `static_translation_id` int(10) unsigned NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `static_bodies_language_id_foreign` (`language_id`),
  KEY `static_bodies_static_translation_id_foreign` (`static_translation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `static_bodies`
--

LOCK TABLES `static_bodies` WRITE;
/*!40000 ALTER TABLE `static_bodies` DISABLE KEYS */;
INSERT INTO `static_bodies` VALUES (1,1,1,'<p>tryiytupotiu</p>',NULL,NULL);
/*!40000 ALTER TABLE `static_bodies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `static_translations`
--

DROP TABLE IF EXISTS `static_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `static_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key_word` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `static_translations`
--

LOCK TABLES `static_translations` WRITE;
/*!40000 ALTER TABLE `static_translations` DISABLE KEYS */;
INSERT INTO `static_translations` VALUES (1,'yuisef','2019-10-14 13:05:54','2019-10-14 13:05:54'),(2,'yuisef','2019-10-14 13:06:27','2019-10-14 13:06:27');
/*!40000 ALTER TABLE `static_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tans_bodies`
--

DROP TABLE IF EXISTS `tans_bodies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tans_bodies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(10) unsigned NOT NULL,
  `translatable_id` int(10) unsigned NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tans_bodies_language_id_foreign` (`language_id`),
  KEY `tans_bodies_translatable_id_foreign` (`translatable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tans_bodies`
--

LOCK TABLES `tans_bodies` WRITE;
/*!40000 ALTER TABLE `tans_bodies` DISABLE KEYS */;
/*!40000 ALTER TABLE `tans_bodies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translatables`
--

DROP TABLE IF EXISTS `translatables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translatables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `record_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translatables`
--

LOCK TABLES `translatables` WRITE;
/*!40000 ALTER TABLE `translatables` DISABLE KEYS */;
/*!40000 ALTER TABLE `translatables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'Advanced Editor','2018-01-28 13:30:05','2018-01-28 13:30:05'),(2,'Normal Editor','2018-01-28 13:30:14','2018-01-28 13:30:14'),(3,'Image','2018-01-28 13:30:29','2018-01-28 13:30:29'),(4,'Video','2018-01-28 13:30:39','2018-01-28 13:30:39'),(5,'Audio','2018-01-28 13:30:47','2018-01-28 13:30:47'),(6,'File Manager Uploads Extensions','2018-01-28 13:30:57','2018-01-28 13:30:57'),(7,'selector','2019-02-11 18:18:52','2019-02-11 18:18:52');
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_has_permissions`
--

DROP TABLE IF EXISTS `user_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_has_permissions` (
  `user_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`),
  KEY `user_has_permissions_permission_id_foreign` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_has_permissions`
--

LOCK TABLES `user_has_permissions` WRITE;
/*!40000 ALTER TABLE `user_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_has_roles`
--

DROP TABLE IF EXISTS `user_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `user_has_roles_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_has_roles`
--

LOCK TABLES `user_has_roles` WRITE;
/*!40000 ALTER TABLE `user_has_roles` DISABLE KEYS */;
INSERT INTO `user_has_roles` VALUES (1,1),(1,2);
/*!40000 ALTER TABLE `user_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'super admin','super_admin@ivas.com','$2y$10$u2evAW530miwgUb2jcXkTuqIGswxnSQ3DSmX1Ji5rtO3Tx.MtVcX2','','01234567890','5lF5Lj73UOJpfkbgzfkcVt9DM7EEwy9AZAf1PDRZIX5Lg3XqIGK4XXmfdhAk','2017-11-09 11:13:14','2018-11-26 13:11:50');
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

-- Dump completed on 2019-10-14  5:33:43
