-- MySQL dump 10.13  Distrib 5.6.17, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: ptf_demo
-- ------------------------------------------------------
-- Server version	5.6.17-1~dotdeb.1-log

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
-- Table structure for table `blog_entries`
--

DROP TABLE IF EXISTS `blog_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `headline` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `blog_entries_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_entries`
--

LOCK TABLES `blog_entries` WRITE;
/*!40000 ALTER TABLE `blog_entries` DISABLE KEYS */;
INSERT INTO `blog_entries` VALUES (1,'This is the first blog article','Lorem ipsum dolor sit amet consectetuer non sodales et Nam Sed. Pede convallis ut Curabitur libero rhoncus nibh Phasellus venenatis neque laoreet. Condimentum Aliquam ac interdum non parturient hendrerit sed ac et nec. Velit aliquet Pellentesque lacinia vitae.\r\n\r\nLeo dictum congue Sed odio lacinia consequat leo amet Aenean Nulla. Pellentesque non libero volutpat libero tellus dui non penatibus turpis Maecenas. Aliquam tempus tincidunt mauris.\r\n\r\n',1,'2014-06-04 15:11:06','2014-06-04 15:11:06'),(2,'This is article number two','Lorem ipsum dolor sit amet consectetuer Suspendisse consequat Fusce Duis augue. Sed wisi massa consequat mus rutrum amet sapien nec sed dolor. Et tellus diam congue tempor suscipit vel.',1,'2014-06-04 15:15:08','2014-06-04 15:17:35'),(3,'Ptf is great!','Ptf is my new favourite PHP framework for two reasons:\r\n- It is very lightweight\r\n- It is written by me',2,'2014-06-04 15:29:39','2014-06-04 15:43:50'),(4,'Demo blog application written with Ptf','Dig through the source code of this example application to learn how to use the Ptf framework.',1,'2014-06-04 15:40:18','2014-06-04 15:45:48');
/*!40000 ALTER TABLE `blog_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` char(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'demo','fe01ce2a7fbac8fafaed7c982a04e229'),(2,'ptf','28a52cb469744f132cd4b49dfcc6d190');
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

-- Dump completed on 2014-06-04 17:56:10
