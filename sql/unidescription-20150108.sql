-- MySQL dump 10.13  Distrib 5.5.42, for osx10.6 (i386)
--
-- Host: localhost    Database: unidescription
-- ------------------------------------------------------
-- Server version	5.5.42

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
-- Table structure for table `forum_categories`
--

DROP TABLE IF EXISTS `forum_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  `enable_threads` tinyint(1) NOT NULL DEFAULT '0',
  `private` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_categories`
--

LOCK TABLES `forum_categories` WRITE;
/*!40000 ALTER TABLE `forum_categories` DISABLE KEYS */;
INSERT INTO `forum_categories` VALUES (1,0,'Audio Descriptions','Want help with your audio description? Post here, or in one of our sub-forums.',0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,1,'Person','',0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,1,'Place','',0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,1,'Thing','',0,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `forum_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_posts`
--

DROP TABLE IF EXISTS `forum_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `thread_id` int(10) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `post_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_posts`
--

LOCK TABLES `forum_posts` WRITE;
/*!40000 ALTER TABLE `forum_posts` DISABLE KEYS */;
INSERT INTO `forum_posts` VALUES (1,1,1,'Where do I start?','2015-11-23 15:07:36','2015-11-23 15:07:36',NULL,NULL),(2,1,1,'Hm, I\'m thinking about starting with their height.','2015-11-23 15:08:01','2015-11-23 15:08:01',NULL,0);
/*!40000 ALTER TABLE `forum_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_threads`
--

DROP TABLE IF EXISTS `forum_threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_threads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pinned` tinyint(1) NOT NULL,
  `locked` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_threads`
--

LOCK TABLES `forum_threads` WRITE;
/*!40000 ALTER TABLE `forum_threads` DISABLE KEYS */;
INSERT INTO `forum_threads` VALUES (1,2,1,'What is the best way to describe a person?',0,0,'2015-11-23 15:07:36','2015-11-23 15:08:01',NULL);
/*!40000 ALTER TABLE `forum_threads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_threads_read`
--

DROP TABLE IF EXISTS `forum_threads_read`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_threads_read` (
  `thread_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_threads_read`
--

LOCK TABLES `forum_threads_read` WRITE;
/*!40000 ALTER TABLE `forum_threads_read` DISABLE KEYS */;
INSERT INTO `forum_threads_read` VALUES (1,1,'2015-11-23 15:07:36','2015-11-23 15:08:01');
/*!40000 ALTER TABLE `forum_threads_read` ENABLE KEYS */;
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
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2015_11_23_060917_create_sessions_table',2),('2014_05_19_151759_create_forum_table_categories',3),('2014_05_19_152425_create_forum_table_threads',3),('2014_05_19_152611_create_forum_table_posts',3),('2015_04_14_180344_create_forum_table_threads_read',3),('2015_07_22_181406_update_forum_table_categories',3),('2015_07_22_181409_update_forum_table_threads',3),('2015_07_22_181417_update_forum_table_posts',3),('2015_11_27_215158_unidescription_project_table',4),('2015_11_28_003646_add_project_image',5),('2015_11_29_065745_rename_project_users_table',6),('2015_11_30_020953_project_section_update',7),('2015_12_05_210347_add_account_image',8),('2015_12_06_213248_project_updated_text',9);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('joe.oppegaard@gmail.com','27184f66787006ae50a7f40224956aab479c2baf75620a6014b32af50de56470','2015-12-07 03:29:09');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_sections`
--

DROP TABLE IF EXISTS `project_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_sections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_section_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `audio_file_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `audio_file_needs_update` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=529 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_sections`
--

LOCK TABLES `project_sections` WRITE;
/*!40000 ALTER TABLE `project_sections` DISABLE KEYS */;
INSERT INTO `project_sections` VALUES (481,'0',41,'30 Second Overviewa','This stunning landscape at the gateway to Puget Sound, with its rich farmland and promising seaport, lured the earliest American pioneers north of the Columbia River to Ebey’s Landing.a asdf','http://api.montanab.com/tts/tmp/1449439928-131474194.txt.wav',1,NULL,'2015-11-30 16:57:07','2015-12-07 07:34:51'),(482,'0',41,'General Descriptionb','Today this National Historical Reserve preserves the historical, agricultural and cultural traditions of Ebey’s Landing – both native and Euro-American – while offering spectacular opportunities for recreation.b','http://api.montanab.com/tts/tmp/1449439929-787419099.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:57:48'),(483,'0',41,'Planning Your Visit','Ebey\'s Landing National Historical Reserve is a unique place where history and natural resources come together to create a landscape of unparalleled beauty and richness. The Reserve\'s scenery is magnificent - dramtic bluffs rise from the waters of Penn Cove and the Strait of Juan de Fuca to dense forests and pastoral prairies while lakes and lagoons mark the rocky shores. But Central Whidbey is more than just a pretty place - it is a working landscape that reflects man\'s relationship with the land over a period of thousands of years.','http://api.montanab.com/tts/tmp/1449439931-1442171645.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:57:50'),(484,'483',41,'Geographic Orientationc','The result is a cultural landscape - a place that reflects the history of human interaction with the land, which tells the story of the people who have lived here - the Native People who first used the prairies and forests and the 19th century settlers whose houses, stores and farms are still being used today. Come for a visit and explore the Reserve!c','http://api.montanab.com/tts/tmp/1449439932-39813822.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:57:51'),(485,'483',41,'Activities in the Parkd','WELCOME to Ebey\'s Landing National Historical Reserve! You\'re invited to explore the history, culture, and natural resources that make this place a unique and fascinating part of the National Park system.d','http://api.montanab.com/tts/tmp/1449439934-1722763451.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:57:53'),(486,'483',41,'Amenities in the Parke','Located in the heart of Whidbey Island, Ebey\'s Landing NHR offers the visitor some of the most spectacular views and landscapes you will find in the state of Washington.e','http://api.montanab.com/tts/tmp/1449439935-1934175382.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:57:54'),(487,'483',41,'Time Issuesf','f','http://api.montanab.com/tts/tmp/1449439936-1837361889.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:57:54'),(488,'483',41,'Safety Messagesg','g','http://api.montanab.com/tts/tmp/1449439937-1685635066.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:57:55'),(489,'483',41,'Tipsh','h','http://api.montanab.com/tts/tmp/1449439937-464550305.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:57:55'),(490,'0',41,'Accessibilityi','Waysides and other facilities are accessible. The gravel trail that begins at the Prairie Overlook is accessible mid-way through Ebey’s Prairie.i','http://api.montanab.com/tts/tmp/1449439938-2007743883.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:57:56'),(491,'490',41,'Amenities in the Parkj','When you visit Ebey\'s Landing National Historical Reserve, you will see an incredible landscape designed to protect and preserve a rural landscape that remains virtually unchanged since the visit of Capt. George Vancouver.j','http://api.montanab.com/tts/tmp/1449439938-2110940020.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:57:57'),(492,'490',41,'What is Accessible?','You may also experience hiking, boating, kyaking and horseback riding among other outdoor activities.','http://api.montanab.com/tts/tmp/1449439939-244595527.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:57:58'),(493,'490',41,'Accessible Parking','here is this.','http://api.montanab.com/tts/tmp/1449439940-411325326.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:57:58'),(494,'0',41,'Site Highlights','Visitors will find a healthy and abundant source of wildlife - birds, mammals, sea creatures - you can find it all here on the Reserve. But, as with all wildlife, you are encouraged to keep a discreet distance - particularly when it comes to racoons, deer, coyote, and other small mammals. Never feed any of the animals you encounter!','http://api.montanab.com/tts/tmp/1449439941-1119800109.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:57:59'),(495,'494',41,'Popular Attractions','','http://api.montanab.com/tts/tmp/1449439942-1560233507.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:58:00'),(496,'494',41,'History','With outstanding vistas and great trails and beaches throughout the Reserve, hiking and beachcombing is are two of the most popular activities for the visitor.\r\n\r\nSeveral trails skirt along steep bluffs to the beaches far below, with access trails up and down the bluff. Its very important that hikers be mindful of the weather conditions, and understand the potential for a landslide. Stormy weather often brings incredible skies and wind that is fascinating to watch. However it can also bring hazardous conditions to the beaches with driftwood and logs crashing ashore. Again, as with any situation, use your common sense and steer clear!','http://api.montanab.com/tts/tmp/1449439942-513761367.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:58:02'),(497,'494',41,'Distinctions','The Reserve\'s saltwater lagoons and adjacent wetland marshes offer prime bird-watching opportunities. Shallow and weather-protected, they attract numerous species of migratory waterfowl and shorebirds.','http://api.montanab.com/tts/tmp/1449439944-1964433690.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:58:03'),(498,'0',41,'For More Information','','http://api.montanab.com/tts/tmp/1449439945-602771548.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:58:04'),(499,'498',41,'Links','','http://api.montanab.com/tts/tmp/1449439946-640146706.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:58:04'),(500,'0',41,'Contact Information','Staff\r\nKristen Griffin, Reserve Manager, e-mail us\r\nRoy Zipp, Operations Manager, e-mail us\r\nSarah Steen, Preservation Coordinator, e-mail us \r\nCarol Castellano, Office Manager, e-mail us','http://api.montanab.com/tts/tmp/1449439947-1119913825.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:58:05'),(501,'500',41,'Address','P.O. Box 774\r\nCoupeville, WA 98239','http://api.montanab.com/tts/tmp/1449439947-668412037.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:58:06'),(502,'500',41,'Phone Number','(360) 678-6084\r\n','http://api.montanab.com/tts/tmp/1449439948-1469917859.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:58:06'),(503,'500',41,'Directions','Hedgerows function as fences, property lines, important cultural ties with the past, and extremely valuable wildlife habitat. In the Reserve, hedgerows define historic cultural land use patterns dating back to early Euro-American settlement in the 1850s.','http://api.montanab.com/tts/tmp/1449439948-1041638659.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:58:07'),(504,'500',41,'Website - edited title','www.montanab.com - edited url','http://api.montanab.com/tts/tmp/1449439949-712011946.txt.wav',0,NULL,'2015-11-30 16:57:07','2015-12-07 05:58:08'),(505,'0',42,'30 Second Overview','It\'s Wonderland. Old Faithful and the majority of the world\'s geysers are preserved here. It\'s Wonderland. Old Faithful and the majority of the world\'s geysers are preserved here. It\'s Wonderland. Old Faithful and the majority of the world\'s geysers are preserved here.  It\'s Wonderland. Old Faithful and the majority of the world\'s geysers are preserved here.  ',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(506,'0',42,'General Description','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(507,'0',42,'Planning Your Visit','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(508,'507',42,'Geographic Orientation','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(509,'507',42,'Activities in the Park','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(510,'507',42,'Amenities in the Park','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(511,'507',42,'Time Issues','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(512,'507',42,'Safety Messages','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(513,'507',42,'Tips','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(514,'0',42,'Accessibility','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(515,'514',42,'Amenities in the Park','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(516,'514',42,'What is Accessible?','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(517,'514',42,'Accessible Parking','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(518,'0',42,'Site Highlights','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(519,'518',42,'Popular Attractions','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(520,'518',42,'History','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(521,'518',42,'Distinctions','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(522,'0',42,'For More Information','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(523,'522',42,'Links','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(524,'0',42,'Contact Information','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(525,'524',42,'Address','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(526,'524',42,'Phone Number','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(527,'524',42,'Directions','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40'),(528,'524',42,'Website','',NULL,1,NULL,'2015-11-30 17:38:40','2015-11-30 17:38:40');
/*!40000 ALTER TABLE `project_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_user`
--

DROP TABLE IF EXISTS `project_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_user`
--

LOCK TABLES `project_user` WRITE;
/*!40000 ALTER TABLE `project_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (41,1,'Ebey\'s Landing','\"...Almost a Paradise of Nature.\" test','/images/projects/41.jpeg','2015-11-30 16:57:07','2015-12-06 10:42:47'),(42,1,'Yellowstone','World\'s Greatest Concentration of Geysers\r\n','/images/projects/42.jpeg','2015-11-30 17:38:40','2015-11-30 17:38:40');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `section_templates`
--

DROP TABLE IF EXISTS `section_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `section_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `section_template_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `section_templates`
--

LOCK TABLES `section_templates` WRITE;
/*!40000 ALTER TABLE `section_templates` DISABLE KEYS */;
INSERT INTO `section_templates` VALUES (1,NULL,'30 Second Overview','A 30 second overview of the site.',10,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,NULL,'General Description','A longer general description of the site.',20,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,NULL,'Planning Your Visit','Factors to consider for your visit.',30,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,3,'Geographic Orientation','This will get your orientated to the site.',10,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,3,'Activities in the Park','e.g., Carry your backpack and stay in more than 300 backcountry campsites.',20,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,3,'Amenities in the Park','e.g., Lodging in Yellowstone provides the special opportunity to walk out your door into the world’s first national park. While the park provides almost limitless opportunities for amazement, exploration, and excitement, we don’t have many of the traditional amenities found outside the park.',30,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,3,'Time Issues','e.g., Lorem ipsum dolor site amet, consect.',40,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,3,'Safety Messages','e.g., You must stay at least 100 yards (91 m) away from bears and wolves and at least 25 yards (23 m) away from all other large animals - bison, elk, bighorn sheep, deer, moose, and coyotes. ',50,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,3,'Tips','e.g., Do not stop your vehicle in the middle of the road.\nPark on shoulders or in established turnouts and make sure your vehicle is completely off the paved roadway with the gear shift in park and the parking break engaged.',60,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,NULL,'Accessibility','e.g., Many of the facilities at Yellowstone National Park are more than a century old and built before the adoption of current accessibility standards; accessibility is not always ideal.',40,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,10,'Amenities in the Park','e.g., Lodging in Yellowstone provides the special opportunity to walk out your door into the world’s first national park. While the park provides almost limitless opportunities for amazement, exploration, and excitement, we don’t have many of the traditional amenities found outside the park.',10,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,10,'What is Accessible?','e.g., Versions of the Official Park Map and Guide are available in large print, audio descriptions, and braille. The park newspaper is available in a braille edition. Some films shown at visitor centers are audio described.',20,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,10,'Accessible Parking','e.g., Fans now head into the Navy Yard district for Nationals parking instead of the giant outdoor lot that surrounds RFK.',30,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,NULL,'Site Highlights','e.g., Visit the Madison Information Station\nExplore Artists Paintpots\nVisit Gibbon Falls\nHike to Monument Geyser Basin',50,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,14,'Popular Attractions','e.g., Fish the Madison River\nTake a Boardwalk Tour of Terrace Springs\nFish the Firehole River',10,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,14,'History','e.g., The human history of the Yellowstone region goes back more than 11,000 years. The stories of people in Yellowstone are preserved in objects that convey information about past human activities in the region, and in people’s connections to the land that provide a sense of place or identity.',20,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,14,'Distinctions','e.g., For more than a century, this classic Montana town has been the jumping off point for travel to Yellowstone National Park. ',30,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,NULL,'For More Information','e.g., Read the Official Park Newspaper\nRead about Backcountry Camping and Hiking',60,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(19,18,'Links','e.g., <a href=\"https://twitter.com/MontanaBWeb\" target=\"_blank\">Twitter</a>\n<a href=\"http://www.facebook.com/montanabweb\" target=\"_blank\">Facebook</a>\n',10,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,NULL,'Contact Information','e.g., Lorem ipsum dolor site amet, consect.',70,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(21,20,'Address','e.g., 425 NW Harrison St.\nPullman, WA\n99163',10,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(22,20,'Phone Number','e.g., Office: 509-339-6088\nCell: 360-910-1970',20,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(23,20,'Directions','e.g., If heading south on I-5 take Hwy-14 heading east Towards Camas.',30,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(24,20,'Website','e.g., www.example.com',40,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `section_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'George Washington','george@montanab.com','$2y$10$nIXOrkHT2SqTYQz3J3SihegGgU1oOA3hhsNh7Rix6fUY1/xawmR2.','/images/accounts/1.jpeg','KEdiVVrcVCTwN6h6tZtTOW8XTTuypv1COR6csCnsvtyJecgNTVoKLWnQmiYk','2015-11-23 11:10:56','2016-01-05 06:43:41'),(2,'Joe Oppegaard','joe.oppegaard@gmail.com','$2y$10$w19YWsLv8KUrrSOJdWyrGeRi7tX9R5VrezQsKijlvCvIa0/4gXuaq','/images/accounts/1.jpeg','jEpIUYr9gm38j717Abyfyxcjv1CjXYiRivGPLDOjdCwbYTMcSACY3JTBtD56','2015-11-23 11:47:46','2015-12-05 08:17:23');
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

-- Dump completed on 2016-01-08 10:28:12
