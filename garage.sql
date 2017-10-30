-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: garage
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Table structure for table `car_models`
--

DROP TABLE IF EXISTS `car_models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `car_models` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `car_id` int(10) unsigned NOT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `car_models_car_id_foreign` (`car_id`),
  CONSTRAINT `car_models_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `car_models`
--

LOCK TABLES `car_models` WRITE;
/*!40000 ALTER TABLE `car_models` DISABLE KEYS */;
INSERT INTO `car_models` VALUES (1,1,'Nissan Patrol','nissan.jpg','2017-10-23 04:42:52','2017-10-23 04:42:52',NULL),(2,2,'Mark II','toyota.jpg','2017-10-23 04:42:52','2017-10-23 04:42:52',NULL),(3,3,'Suzuki','suzuki.jpg','2017-10-23 04:42:52','2017-10-23 04:42:52',NULL),(4,4,'BMW','bmw.jpg','2017-10-23 04:42:52','2017-10-23 04:42:52',NULL),(5,5,'Mazda','mazda.jpg','2017-10-23 04:42:53','2017-10-23 04:42:53',NULL),(6,6,'Discovery','land-rover.jpg','2017-10-23 04:42:53','2017-10-23 04:42:53',NULL),(7,7,'Hyundai','hyundai.jpg','2017-10-23 04:42:53','2017-10-23 04:42:53',NULL),(8,8,'Audi','audi.jpg','2017-10-23 04:42:53','2017-10-23 04:42:53',NULL),(9,9,'Jeep','jeep.jpg','2017-10-23 04:42:53','2017-10-23 04:42:53',NULL),(10,10,'Honda','honda.jpg','2017-10-23 04:42:53','2017-10-23 04:42:53',NULL),(11,11,'Lexus','lexus.jpg','2017-10-23 04:42:53','2017-10-23 04:42:53',NULL);
/*!40000 ALTER TABLE `car_models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_models` int(10) unsigned NOT NULL DEFAULT '1',
  `date_added` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cars`
--

LOCK TABLES `cars` WRITE;
/*!40000 ALTER TABLE `cars` DISABLE KEYS */;
INSERT INTO `cars` VALUES (1,'Nissan','nissan.jpg',1,'2017-10-23 04:42:52','2017-10-23 04:42:52',NULL),(2,'Toyota','toyota.jpg',1,'2017-10-23 04:42:52','2017-10-23 04:42:52',NULL),(3,'Suzuki','suzuki.jpg',1,'2017-10-23 04:42:52','2017-10-23 04:42:52',NULL),(4,'BMW','bmw.jpg',1,'2017-10-23 04:42:52','2017-10-23 04:42:52',NULL),(5,'Mazda','mazda.jpg',1,'2017-10-23 04:42:52','2017-10-23 04:42:52',NULL),(6,'Land Rover','land-rover.jpg',1,'2017-10-23 04:42:52','2017-10-23 04:42:52',NULL),(7,'Hyundai','hyundai.jpg',1,'2017-10-23 04:42:52','2017-10-23 04:42:52',NULL),(8,'Audi','audi.jpg',1,'2017-10-23 04:42:52','2017-10-23 04:42:52',NULL),(9,'Jeep','jeep.jpg',1,'2017-10-23 04:42:52','2017-10-23 04:42:52',NULL),(10,'Honda','honda.jpg',1,'2017-10-23 04:42:52','2017-10-23 04:42:52',NULL),(11,'Lexus','lexus.jpg',1,'2017-10-23 04:42:52','2017-10-23 04:42:52',NULL),(12,'sdf',NULL,1,'2017-10-23 12:18:01','2017-10-23 12:23:35','2017-10-23 12:23:35'),(13,'sd',NULL,1,'2017-10-23 12:20:16','2017-10-23 12:23:32','2017-10-23 12:23:32'),(14,'jk',NULL,1,'2017-10-23 12:23:21','2017-10-23 12:23:30','2017-10-23 12:23:30');
/*!40000 ALTER TABLE `cars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Family cars','2017-10-23 04:42:55','2017-10-23 11:22:20','2017-10-23 11:22:20'),(2,'Luxury cars','2017-10-23 04:42:56','2017-10-23 11:22:16','2017-10-23 11:22:16'),(3,'Saloons','2017-10-23 04:42:56','2017-10-23 11:22:24','2017-10-23 11:22:24'),(4,'Spark plugs','2017-10-23 04:42:56','2017-10-23 09:38:17',NULL),(5,'Brake pads','2017-10-23 04:42:56','2017-10-23 09:37:04',NULL),(6,'Gear/b oil','2017-10-23 04:42:56','2017-10-23 09:36:53',NULL),(7,'Cabin/AC filter','2017-10-23 04:42:56','2017-10-23 09:36:35',NULL),(8,'Air cleaner','2017-10-23 04:42:56','2017-10-23 09:36:20',NULL),(9,'Pre filter','2017-10-23 04:42:56','2017-10-23 09:36:09',NULL),(10,'Fuel filter','2017-10-23 04:42:56','2017-10-23 09:35:55',NULL),(11,'Oil filter','2017-10-23 04:42:56','2017-10-23 09:35:42',NULL),(12,'ghjh','2017-10-23 04:54:14','2017-10-23 04:54:21','2017-10-23 04:54:21'),(13,'gg','2017-10-23 05:05:09','2017-10-23 05:05:16','2017-10-23 05:05:16');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_cars`
--

DROP TABLE IF EXISTS `customer_cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_cars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `car_id` int(10) unsigned NOT NULL,
  `car_model_id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `date_added` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_cars_car_id_foreign` (`car_id`),
  KEY `customer_cars_customer_id_foreign` (`customer_id`),
  KEY `customer_cars_car_model_id_foreign` (`car_model_id`),
  CONSTRAINT `customer_cars_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`),
  CONSTRAINT `customer_cars_car_model_id_foreign` FOREIGN KEY (`car_model_id`) REFERENCES `car_models` (`id`),
  CONSTRAINT `customer_cars_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_cars`
--

LOCK TABLES `customer_cars` WRITE;
/*!40000 ALTER TABLE `customer_cars` DISABLE KEYS */;
INSERT INTO `customer_cars` VALUES (1,1,1,1,'2017-10-23 04:42:57','2017-10-23 04:42:57',NULL),(2,2,2,2,'2017-10-23 04:42:57','2017-10-23 04:42:57',NULL),(3,3,3,3,'2017-10-23 04:42:57','2017-10-23 04:42:57',NULL),(4,4,4,4,'2017-10-23 04:42:57','2017-10-23 04:42:57',NULL),(5,5,5,5,'2017-10-23 04:42:57','2017-10-23 04:42:57',NULL),(6,6,6,6,'2017-10-23 04:42:57','2017-10-23 04:42:57',NULL),(7,7,7,7,'2017-10-23 04:42:57','2017-10-23 04:42:57',NULL),(8,8,8,8,'2017-10-23 04:42:57','2017-10-23 04:42:57',NULL),(9,9,9,9,'2017-10-23 04:42:58','2017-10-23 04:42:58',NULL),(10,10,10,10,'2017-10-23 04:42:58','2017-10-23 04:42:58',NULL),(11,11,11,11,'2017-10-23 04:42:58','2017-10-23 04:42:58',NULL);
/*!40000 ALTER TABLE `customer_cars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_services`
--

DROP TABLE IF EXISTS `customer_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `service_as_product_id` int(10) unsigned NOT NULL,
  `status` int(10) unsigned NOT NULL DEFAULT '0',
  `comment` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `pick_option` tinyint(1) NOT NULL,
  `latitude` double(20,10) DEFAULT NULL,
  `longitude` double(20,10) DEFAULT NULL,
  `location_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `price` decimal(14,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_services_customer_id_foreign` (`customer_id`),
  KEY `customer_services_service_as_product_id_foreign` (`service_as_product_id`),
  CONSTRAINT `customer_services_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `customer_services_service_as_product_id_foreign` FOREIGN KEY (`service_as_product_id`) REFERENCES `service_as_products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_services`
--

LOCK TABLES `customer_services` WRITE;
/*!40000 ALTER TABLE `customer_services` DISABLE KEYS */;
INSERT INTO `customer_services` VALUES (1,1,1,3,'King, \'that saves a world of trouble, you know, and he hurried off. Alice thought she might find another key on it.','Hatter: \'let\'s all move one place on.\' He moved on as he shook his grey locks, \'I kept all my life!\' Just as she went.',0,-71.1508010000,-153.3583160000,'North Justynshire','2017-10-28','2017-10-23 04:42:58','2017-10-23 08:38:35',NULL,161509),(2,2,2,3,'Alice, \'when one wasn\'t always growing larger and smaller, and being ordered about in the act of crawling away:.','What would become of me? They\'re dreadfully fond of beheading people here; the great wonder is, that I\'m perfectly.',1,-11.2171170000,102.4299750000,'South Emmafort','2017-10-12','2017-10-23 04:42:58','2017-10-23 08:33:34',NULL,470601),(3,3,3,2,'I can kick a little!\' She drew her foot slipped, and in his sleep, \'that \"I like what I see\"!\' \'You might just as I.','Mock Turtle: \'crumbs would all wash off in the wood,\' continued the King. Here one of the sort. Next came the royal.',0,63.0764070000,75.2678530000,'Lake Dixie','1982-04-02','2017-10-23 04:42:58','2017-10-23 04:42:58',NULL,157602),(4,4,4,3,'Alice could not help thinking there MUST be more to be a grin, and she put her hand on the end of the water, and.','I can\'t be civil, you\'d better leave off,\' said the Queen. \'Sentence first--verdict afterwards.\' \'Stuff and nonsense!\'.',1,41.2812180000,15.3277700000,'Rosaliaview','2003-07-21','2017-10-23 04:42:58','2017-10-23 04:42:58',NULL,243843),(5,5,5,4,'Alice, so please your Majesty,\' said the Queen, and Alice was thoroughly puzzled. \'Does the boots and shoes!\' she.','THE COURT.\' Everybody looked at Two. Two began in a moment to be found: all she could do to hold it. As soon as look.',0,27.3786910000,34.5151320000,'New Rahsaan','1999-08-21','2017-10-23 04:42:59','2017-10-23 04:42:59',NULL,132481),(6,6,6,0,'Mock Turtle. \'Seals, turtles, salmon, and so on; then, when you\'ve cleared all the jurymen on to her chin upon Alice\'s.','Lizard as she could, \'If you please, sir--\' The Rabbit Sends in a great deal to ME,\' said the Gryphon. \'I mean, what.',1,11.5998180000,100.6169350000,'Handmouth','2013-03-22','2017-10-23 04:42:59','2017-10-23 04:42:59',NULL,159849),(7,7,7,1,'So she went on. \'Or would you tell me,\' said Alice, who was talking. Alice could see this, as she could, for the first.','The Knave of Hearts, and I shall fall right THROUGH the earth! How funny it\'ll seem to have it explained,\' said the.',0,-68.5262250000,-66.4787590000,'Josefinafort','2013-10-08','2017-10-23 04:42:59','2017-10-23 04:42:59',NULL,142405),(8,8,8,2,'Alice, \'it\'ll never do to ask: perhaps I shall be late!\' (when she thought of herself, \'I wonder how many miles I\'ve.','I shall think nothing of the teacups as the other.\' As soon as there seemed to Alice with one finger, as he spoke..',1,57.4368600000,-91.1461160000,'Port Casper','2008-10-01','2017-10-23 04:42:59','2017-10-23 04:42:59',NULL,266509),(9,9,9,3,'Alice appeared, she was surprised to see it pop down a good opportunity for croqueting one of the jury had a door.','Alice to find herself talking familiarly with them, as if his heart would break. She pitied him deeply. \'What is his.',0,60.6651330000,-3.6521240000,'Lindburgh','1970-03-17','2017-10-23 04:42:59','2017-10-23 04:42:59',NULL,141613),(10,10,10,4,'Queen of Hearts were seated on their backs was the Duchess\'s cook. She carried the pepper-box in her brother\'s Latin.','Mock Turtle to the Caterpillar, just as I do,\' said Alice thoughtfully: \'but then--I shouldn\'t be hungry for it, while.',1,24.7594690000,172.9136020000,'Hillarystad','1999-09-26','2017-10-23 04:42:59','2017-10-23 04:42:59',NULL,654378),(11,11,11,0,'Why, she\'ll eat a little snappishly. \'You\'re enough to get through was more than that, if you cut your finger VERY.','WOULD always get into that beautiful garden--how IS that to be seen--everything seemed to follow, except a little.',0,62.7074720000,119.0425130000,'West Armand','1974-07-18','2017-10-23 04:43:00','2017-10-23 04:43:00',NULL,387793);
/*!40000 ALTER TABLE `customer_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'delphia09@example.org','1-568-378-1001','Monserrate Bartoletti',0,'2017-10-23 04:42:53','2017-10-23 04:42:53',NULL),(2,'cwindler@example.org','586-645-5532 x6909','Prof. Christian West V',1,'2017-10-23 04:42:53','2017-10-23 04:42:53',NULL),(3,'amalia.witting@example.com','1-847-715-5355 x2185','Cordia Lindgren',0,'2017-10-23 04:42:53','2017-10-23 04:42:53',NULL),(4,'sparisian@example.com','(685) 687-8225','Dr. Derick McCullough III',1,'2017-10-23 04:42:53','2017-10-23 04:42:53',NULL),(5,'delbert55@example.com','713-399-9379 x10486','Mr. Baron Veum DDS',0,'2017-10-23 04:42:53','2017-10-23 04:42:53',NULL),(6,'phills@example.net','+1.713.938.2816','Mrs. Adrienne Connelly Sr.',1,'2017-10-23 04:42:53','2017-10-23 04:42:53',NULL),(7,'reilly.karianne@example.com','+1.829.643.0113','Mr. Isaiah Hermiston V',0,'2017-10-23 04:42:53','2017-10-23 04:42:53',NULL),(8,'fay.lucious@example.org','1-876-350-3751 x048','Miss Bethel Huel DDS',1,'2017-10-23 04:42:54','2017-10-23 04:42:54',NULL),(9,'phyllis33@example.net','+1-372-594-8957','Miss River Connelly MD',0,'2017-10-23 04:42:54','2017-10-23 04:42:54',NULL),(10,'swaniawski.dianna@example.net','1-551-397-0734','Dwight Langosh',1,'2017-10-23 04:42:54','2017-10-23 04:42:54',NULL),(11,'jbailey@example.net','1-981-758-6574 x888','Pietro Nienow',0,'2017-10-23 04:42:54','2017-10-23 04:42:54',NULL),(12,'haikarosetz@gmail.com','0719030004','emmanuel meena',0,'2017-10-23 07:20:46','2017-10-23 07:20:46',NULL);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `devices_customer_id_foreign` (`customer_id`),
  CONSTRAINT `devices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devices`
--

LOCK TABLES `devices` WRITE;
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
INSERT INTO `devices` VALUES (1,'8cb8e7a0102c92b47948e84ed92aeb248dcd02cf',1,'2017-10-23 04:43:00','2017-10-23 04:43:00',NULL),(2,'f989ff7d6577535aed5008560bc774869d3a21d6',2,'2017-10-23 04:43:00','2017-10-23 04:43:00',NULL),(3,'31412a37da93a68b96ab72a35591d0774c90292d',3,'2017-10-23 04:43:00','2017-10-23 04:43:00',NULL),(4,'7eb814f57335c87f92bb20b775a66245f26d4e26',4,'2017-10-23 04:43:00','2017-10-23 04:43:00',NULL),(5,'c3580083916422e522f78d83cbd863600974596b',5,'2017-10-23 04:43:00','2017-10-23 04:43:00',NULL),(6,'a471a995b9316e53bc0a6d07205955af39c7f24d',6,'2017-10-23 04:43:00','2017-10-23 04:43:00',NULL),(7,'dedd409da85e150aa85f831626f2a82d11c6b120',7,'2017-10-23 04:43:00','2017-10-23 04:43:00',NULL),(8,'be712d9e033650d78b4a578f884208a1e18386b3',8,'2017-10-23 04:43:01','2017-10-23 04:43:01',NULL),(9,'76696ebec3e7b7d21610dacd93f0aec3f97c8149',9,'2017-10-23 04:43:01','2017-10-23 04:43:01',NULL),(10,'ba4f371c1abbd36fb3f6122a99d7761d33da66f8',10,'2017-10-23 04:43:01','2017-10-23 04:43:01',NULL),(11,'20a97d91ab8b1d02fec57841b637f415017bead7',11,'2017-10-23 04:43:01','2017-10-23 04:43:01',NULL),(12,'ethVmHNAZ8I:APA91bFMmhFV7-TPNMjS-dprQhK0xjf5pJZYN42OtahrFoP9hHZLpdu4onAEbI3mVuugwmhBeYQyFKlk5byE9wToh9B31R_fVs_3CFrKf_-0dlp6zLfF1d2vAJbtrjrjhybQzUGaNzm6',12,'2017-10-23 07:20:46','2017-10-23 07:20:46',NULL);
/*!40000 ALTER TABLE `devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_resets_table',1),(2,'2017_09_17_061515_create_categories_table',1),(3,'2017_09_18_112745_create_cars_table',1),(4,'2017_09_18_112746_create_car_models_table',1),(5,'2017_09_18_112759_create_services_table',1),(6,'2017_09_18_112760_create_service_as_products_table',1),(7,'2017_09_18_112831_create_customers_table',1),(8,'2017_09_18_114535_create_products_table',1),(9,'2017_09_18_114759_create_customer_cars_table',1),(10,'2017_09_18_114848_create_customer_services_table',1),(11,'2017_09_18_114907_create_devices_table',1),(12,'2017_09_18_114956_create_orders_table',1),(13,'2017_09_18_115015_create_purchases_table',1),(14,'2017_09_22_000000_create_users_table',1),(15,'2017_09_25_072528_create_notifications_table',1),(16,'2017_10_18_080547_edit_service_as_products_table',1),(17,'2017_10_18_151546_edit_customer_services_table',1),(18,'2017_10_19_104153_edit_customer_services_table_8',1),(19,'2017_10_21_105120_edit_customer_services_table_9',1),(20,'2017_10_21_163559_edit_car_models_table_1',1),(21,'2017_10_23_014701_edit_orders_table_2',1),(22,'2017_10_23_092341_edit_cars_table_1',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_customer_id_foreign` (`customer_id`),
  CONSTRAINT `notifications_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'2009-11-10','push','March Hare was said to live. \'I\'ve seen hatters before,\' she said to herself, \'to be going messages for a great hurry..','unread',1,'2017-10-23 04:43:02','2017-10-23 04:43:02',NULL),(2,'2004-08-03','push','It means much the same height as herself; and when she looked down, was an old crab, HE was.\' \'I never thought about.','read',2,'2017-10-23 04:43:02','2017-10-23 04:43:02',NULL),(3,'2006-12-25','push','When they take us up and saying, \'Thank you, sir, for your walk!\" \"Coming in a very short time the Queen said to.','unread',3,'2017-10-23 04:43:03','2017-10-23 04:43:03',NULL),(4,'2012-01-20','push','I then? Tell me that first, and then, \'we went to work throwing everything within her reach at the place of the.','read',4,'2017-10-23 04:43:03','2017-10-23 04:43:03',NULL),(5,'2001-02-18','push','King, looking round the court with a cart-horse, and expecting every moment to be a very good height indeed!\' said the.','unread',5,'2017-10-23 04:43:03','2017-10-23 04:43:03',NULL),(6,'1982-07-17','push','I can\'t quite follow it as you go to law: I will prosecute YOU.--Come, I\'ll take no denial; We must have a trial: For.','read',6,'2017-10-23 04:43:03','2017-10-23 04:43:03',NULL),(7,'1997-05-25','push','Gryphon, and all must have been changed for any of them. \'I\'m sure I\'m not used to call him Tortoise--\' \'Why did they.','unread',7,'2017-10-23 04:43:03','2017-10-23 04:43:03',NULL),(8,'2015-07-10','push','Queen shouted at the bottom of a sea of green leaves that lay far below her. \'What CAN all that green stuff be?\' said.','read',8,'2017-10-23 04:43:03','2017-10-23 04:43:03',NULL),(9,'2014-01-01','push','Soup,\" will you, won\'t you, will you join the dance? Will you, won\'t you, will you join the dance. Will you, won\'t you.','unread',9,'2017-10-23 04:43:03','2017-10-23 04:43:03',NULL),(10,'1994-11-27','push','Alice; \'it\'s laid for a great deal too flustered to tell its age, there was nothing on it were nine o\'clock in the.','read',10,'2017-10-23 04:43:03','2017-10-23 04:43:03',NULL),(11,'2010-07-12','push','Mock Turtle said with some surprise that the meeting adjourn, for the hot day made her draw back in their mouths; and.','unread',11,'2017-10-23 04:43:04','2017-10-23 04:43:04',NULL);
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `num_items` int(10) unsigned NOT NULL,
  `amount` decimal(14,0) NOT NULL,
  `status` int(10) unsigned NOT NULL DEFAULT '0',
  `comment` text COLLATE utf8mb4_unicode_ci,
  `date` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_customer_id_foreign` (`customer_id`),
  CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,1,3022693,1,'She soon got it out into the Dormouse\'s place, and Alice looked down at her for a little anxiously. \'Yes,\' said Alice.','1998-06-20 05:21:55','1997-07-18 13:18:04',NULL),(2,2,1,4424638,0,'VERY much out of sight before the trial\'s begun.\' \'They\'re putting down their names,\' the Gryphon said, in a tone of.','1986-11-09 03:59:01','1985-10-10 16:09:49',NULL),(3,3,1,547225,1,'Dinah, and saying \"Come up again, dear!\" I shall only look up and straightening itself out again, so violently, that.','1975-08-15 19:06:08','2011-05-24 18:02:03',NULL),(4,4,1,4126076,0,'And the executioner went off like an arrow. The Cat\'s head with great curiosity. \'Soles and eels, of course,\' the Mock.','1996-10-19 06:17:01','1979-01-14 17:31:36',NULL),(5,5,1,4331659,1,'Alice indignantly. \'Let me alone!\' \'Serpent, I say again!\' repeated the Pigeon, raising its voice to its feet, ran.','1994-09-01 02:48:04','1994-03-12 19:49:48',NULL),(6,6,1,2608936,0,'Alice replied very solemnly. Alice was too dark to see the Queen. \'It proves nothing of the day; and this time with.','1991-10-06 21:16:08','1983-12-17 05:11:29',NULL),(7,7,1,3911458,1,'I am! But I\'d better take him his fan and two or three pairs of tiny white kid gloves, and she jumped up in a.','1993-03-03 00:56:06','2017-02-21 00:10:54',NULL),(8,8,1,1867237,0,'I have dropped them, I wonder?\' Alice guessed in a mournful tone, \'he won\'t do a thing I ever heard!\' \'Yes, I think I.','2014-05-08 16:58:39','1975-12-23 03:28:57',NULL),(9,9,1,1846382,1,'Because he knows it teases.\' CHORUS. (In which the wretched Hatter trembled so, that he shook his head sadly. \'Do I.','1990-04-14 12:30:34','1988-06-16 13:52:47',NULL),(10,10,1,837354,0,'Alice, a good opportunity for making her escape; so she went slowly after it: \'I never was so small as this is May it.','2004-04-28 15:51:21','1976-11-29 12:39:04',NULL),(11,11,1,1100240,1,'What WILL become of me? They\'re dreadfully fond of pretending to be listening, so she took up the other, looking.','2012-11-01 07:05:30','1978-03-13 01:35:18',NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
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
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `car_id` int(10) unsigned DEFAULT NULL,
  `car_model_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(14,0) NOT NULL,
  `stock` int(10) unsigned NOT NULL,
  `has_includes` tinyint(1) NOT NULL,
  `includes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `include_price` decimal(14,0) DEFAULT NULL,
  `warranty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT NULL,
  `date_modified` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_car_id_foreign` (`car_id`),
  KEY `products_car_model_id_foreign` (`car_model_id`),
  CONSTRAINT `products_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`),
  CONSTRAINT `products_car_model_id_foreign` FOREIGN KEY (`car_model_id`) REFERENCES `car_models` (`id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,1,1,'wind mirror','1',1644057,23,0,'voluptatibus et',53612,'year','1.jpg','2017-10-23 04:42:56','2017-10-23 04:42:56',NULL),(2,2,2,2,'side mirror','2',1451425,25,1,'perspiciatis unde',56022,'year','1.jpg','2017-10-23 04:42:56','2017-10-23 04:42:56',NULL),(3,3,3,3,'gear-box','3',543657,220,0,'reiciendis corporis',24909,'year','1.jpg','2017-10-23 04:42:56','2017-10-23 04:42:56',NULL),(4,4,4,4,'tyre','4',1800059,64,1,'neque quisquam',64870,'year','1.jpg','2017-10-23 04:42:56','2017-10-23 04:42:56',NULL),(5,5,5,5,'car-radio','5',1405102,123,0,'occaecati et',67528,'year','1.jpg','2017-10-23 04:42:57','2017-10-23 04:42:57',NULL),(6,6,6,6,'front-lights','6',1176360,61,1,'quia quia',50028,'year','1.jpg','2017-10-23 04:42:57','2017-10-23 04:42:57',NULL),(7,7,7,7,'indicator-lights','7',1616052,243,0,'ratione dolorum',32799,'year','1.jpg','2017-10-23 04:42:57','2017-10-23 04:42:57',NULL),(8,8,8,8,'back-lights','8',1080209,236,1,'nesciunt possimus',55410,'year','1.jpg','2017-10-23 04:42:57','2017-10-23 04:42:57',NULL),(9,9,9,9,'steering cover','9',662823,23,0,'vero vel',20784,'year','1.jpg','2017-10-23 04:42:57','2017-10-23 04:42:57',NULL),(10,10,10,10,'seat-cover','10',1997523,121,1,'quibusdam saepe',20689,'year','1.jpg','2017-10-23 04:42:57','2017-10-23 04:42:57',NULL),(11,11,11,11,'engine','11',654552,187,0,'et optio',55292,'year','1.jpg','2017-10-23 04:42:57','2017-10-23 04:42:57',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `price` decimal(14,0) NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `has_includes` tinyint(1) NOT NULL,
  `includes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `include_price` decimal(14,0) DEFAULT NULL,
  `total_price` decimal(14,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchases_order_id_foreign` (`order_id`),
  KEY `purchases_product_id_foreign` (`product_id`),
  CONSTRAINT `purchases_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `purchases_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases`
--

LOCK TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
INSERT INTO `purchases` VALUES (1,1968922,1,1,4,0,'dolores nulla',46736,2294122,'2017-10-23 04:43:01','2017-10-23 04:43:01',NULL),(2,1970880,2,2,6,1,'tenetur quod',57353,2295460,'2017-10-23 04:43:02','2017-10-23 04:43:02',NULL),(3,146395,3,3,1,0,'omnis eius',24407,209122,'2017-10-23 04:43:02','2017-10-23 04:43:02',NULL),(4,1311311,4,4,6,1,'quis molestiae',54356,534906,'2017-10-23 04:43:02','2017-10-23 04:43:02',NULL),(5,246156,5,5,4,0,'sit placeat',42854,845808,'2017-10-23 04:43:02','2017-10-23 04:43:02',NULL),(6,1982458,6,6,5,1,'non est',61201,2846067,'2017-10-23 04:43:02','2017-10-23 04:43:02',NULL),(7,1634285,7,7,0,0,'repellat similique',21988,1096087,'2017-10-23 04:43:02','2017-10-23 04:43:02',NULL),(8,1353243,8,8,5,1,'facilis quidem',47273,729942,'2017-10-23 04:43:02','2017-10-23 04:43:02',NULL),(9,1105664,9,9,5,0,'voluptates sed',34395,2569742,'2017-10-23 04:43:02','2017-10-23 04:43:02',NULL),(10,1619935,10,10,5,1,'et culpa',64071,3900774,'2017-10-23 04:43:02','2017-10-23 04:43:02',NULL),(11,112615,11,11,1,0,'voluptas reprehenderit',28333,90083,'2017-10-23 04:43:02','2017-10-23 04:43:02',NULL);
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_as_products`
--

DROP TABLE IF EXISTS `service_as_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_as_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(10) unsigned NOT NULL,
  `car_id` int(10) unsigned DEFAULT NULL,
  `car_model_id` int(10) unsigned DEFAULT NULL,
  `price` decimal(14,0) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_as_products_service_id_foreign` (`service_id`),
  KEY `service_as_products_car_id_foreign` (`car_id`),
  KEY `service_as_products_car_model_id_foreign` (`car_model_id`),
  CONSTRAINT `service_as_products_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`),
  CONSTRAINT `service_as_products_car_model_id_foreign` FOREIGN KEY (`car_model_id`) REFERENCES `car_models` (`id`),
  CONSTRAINT `service_as_products_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_as_products`
--

LOCK TABLES `service_as_products` WRITE;
/*!40000 ALTER TABLE `service_as_products` DISABLE KEYS */;
INSERT INTO `service_as_products` VALUES (1,1,1,1,175060,1,'2017-10-23 04:42:55','2017-10-23 04:42:55',NULL),(2,2,2,2,623670,1,'2017-10-23 04:42:55','2017-10-23 04:42:55',NULL),(3,3,3,3,171166,1,'2017-10-23 04:42:55','2017-10-23 04:42:55',NULL),(4,4,4,4,130593,1,'2017-10-23 04:42:55','2017-10-23 04:42:55',NULL),(5,5,5,5,506050,1,'2017-10-23 04:42:55','2017-10-23 04:42:55',NULL),(6,6,6,6,542746,1,'2017-10-23 04:42:55','2017-10-23 04:42:55',NULL),(7,7,7,7,687044,1,'2017-10-23 04:42:55','2017-10-23 04:42:55',NULL),(8,8,8,8,362724,1,'2017-10-23 04:42:55','2017-10-23 04:42:55',NULL),(9,9,9,9,250234,1,'2017-10-23 04:42:55','2017-10-23 04:42:55',NULL),(10,10,10,10,415247,1,'2017-10-23 04:42:55','2017-10-23 11:48:23',NULL),(11,11,11,11,146165,1,'2017-10-23 04:42:55','2017-10-23 11:47:27',NULL);
/*!40000 ALTER TABLE `service_as_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'washing','Id sint et voluptatem id. Est et et eos reprehenderit harum in. Facere alias similique qui veritatis laborum. Sunt adipisci non distinctio.','1.jpg','2017-10-23 04:42:54','2017-10-23 04:42:54',NULL),(2,'clean engine','Et ullam corporis culpa eum. Aut possimus libero error necessitatibus numquam enim. Quasi iure maiores praesentium.','1.jpg','2017-10-23 04:42:54','2017-10-23 04:42:54',NULL),(3,'replace side-mirror','Aliquam tempore corrupti est quis quibusdam. Error commodi repellat sunt ipsa. Error necessitatibus est odio natus. Reiciendis nostrum placeat atque molestiae magnam vitae.','1.jpg','2017-10-23 04:42:54','2017-10-23 04:42:54',NULL),(4,'replace back-mirror','Accusantium sunt deserunt omnis ut. Voluptas vel et modi cumque voluptatum nihil cum. Doloribus deleniti velit deleniti. Eius tempora voluptatibus voluptate ea dolorem.','1.jpg','2017-10-23 04:42:54','2017-10-23 04:42:54',NULL),(5,'replace front-mirror','Repellendus beatae odio voluptas id ut. Ipsa voluptatem perferendis magnam sint incidunt. Vitae sit quis et.','1.jpg','2017-10-23 04:42:54','2017-10-23 04:42:54',NULL),(6,'change gear-box','Cumque quisquam eaque quod. Voluptatem omnis odit maiores laboriosam reprehenderit. Occaecati repudiandae ipsa explicabo eius. Eum consequatur ut ea eius facilis dolores molestiae.','1.jpg','2017-10-23 04:42:54','2017-10-23 04:42:54',NULL),(7,'refuel','Eum repudiandae iusto consequuntur blanditiis dolores iusto. Error vero quo dolores. Impedit ipsa qui ea maxime sit numquam. Id commodi consequatur beatae.','1.jpg','2017-10-23 04:42:54','2017-10-23 04:42:54',NULL),(8,'break fuel','Nobis inventore doloremque dolores quia exercitationem exercitationem. Repellat quae maxime quo ducimus voluptatum saepe. Qui necessitatibus veritatis corrupti ut ut porro. Sit nesciunt soluta cupiditate autem voluptatem illum sunt.','1.jpg','2017-10-23 04:42:55','2017-10-23 04:42:55',NULL),(9,'change tyres','Maxime magnam autem quibusdam error veritatis dolor. Vel porro quaerat voluptatum ut non. Ea saepe sit harum dolorem et. Rem amet sint illum maiores aut illum.','1.jpg','2017-10-23 04:42:55','2017-10-23 04:42:55',NULL),(10,'repair engine','something more','wheel-balancing.jpg','2017-10-23 04:42:55','2017-10-23 11:48:23',NULL),(11,'sound system repair','Occaecati facere ad veniam et et incidunt praesentium. Esse consectetur eaque enim. Sint consequuntur illo nesciunt consectetur veritatis reprehenderit accusamus. Commodi nihil error nihil recusandae iure sequi eaque et. Nam praesentium distinctio et voluptas a omnis aliquid iusto.','wheel-aliginment.jpg','2017-10-23 04:42:55','2017-10-23 11:47:27',NULL);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Federico','Rogahn',NULL,'Ivory','$2y$10$0GBeFEyVvd3B1CrUrlE2B.uFEKGzjSWF.rOquPq5uuYrO6N1LrXs2',NULL,NULL,'2017-10-23 04:42:49','2017-10-23 04:42:49',NULL),(2,'Milan','Anderson',NULL,'Lucinda','$2y$10$PpZe5CT5A0EXPL2pUjuhceOvRil.8peo65QefY8rkwqAvlz0zB70K',NULL,NULL,'2017-10-23 04:42:50','2017-10-23 04:42:50',NULL),(3,'Jadon','Kuhic',NULL,'Karolann','$2y$10$Ao5oy2Sk/KwTpnipDjSbjOArdAC9GN4iIp9fD3o6.EWMVdtpnosXS',NULL,NULL,'2017-10-23 04:42:50','2017-10-23 04:42:50',NULL),(4,'Michele','Lind',NULL,'Aiden','$2y$10$D5vTBb0mvkB/xyl6e6HyL.SQLPrx71do.ZNDuR2wDL9oAZOIPWeIC',NULL,NULL,'2017-10-23 04:42:50','2017-10-23 04:42:50',NULL),(5,'Telly','Langosh',NULL,'Carli','$2y$10$Yek46qr1GmoQBg74MigVFujMl1D7TPnPhES0cCxe1D/9.uBBziXNm',NULL,NULL,'2017-10-23 04:42:50','2017-10-23 04:42:50',NULL),(6,'Eliezer','Tremblay',NULL,'Geraldine','$2y$10$e6OV14/utg7ZKIKfsnziJO7EKolw9scpLNkhfAi5UadVgCg6nT0Ru',NULL,NULL,'2017-10-23 04:42:50','2017-10-23 04:42:50',NULL),(7,'Lowell','Rosenbaum',NULL,'Filiberto','$2y$10$6wJEyHc9tIKI9F.zpqcpduzpANslyXoSkl1wGWAt5qO5ekGleGZxe',NULL,NULL,'2017-10-23 04:42:51','2017-10-23 04:42:51',NULL),(8,'Hershel','Runolfsdottir',NULL,'Magali','$2y$10$AJmq.Ahf6RhEXj9TBEDUZO2pJoQY3j6.trd4LM.yF3GX6EM5m4m.i',NULL,NULL,'2017-10-23 04:42:51','2017-10-23 04:42:51',NULL),(9,'Naomie','Little',NULL,'Kelli','$2y$10$ouipMnaALN2l0wMe/du7K.J57hjPJKwwmj2O7vo8/mDSl/Xt9DpKS',NULL,NULL,'2017-10-23 04:42:51','2017-10-23 04:42:51',NULL),(10,'Katrine','Abbott',NULL,'Danny','$2y$10$VdDo4QhGAF8drGAyUaYwCOsTmFSQzbJLlNXB.1akEPnhVscuwD4eS',NULL,NULL,'2017-10-23 04:42:51','2017-10-23 04:42:51',NULL),(11,'Carmine','Upton',NULL,'Zack','$2y$10$NmE5ezonR0HMfLE7GTSOoOZSXwkKlQfEUyCtUV9xz1NWg1Tjt5uNS',NULL,NULL,'2017-10-23 04:42:51','2017-10-23 04:42:51',NULL),(12,'Admin','Admin',NULL,'admin','$2y$10$K.veCGQ/ClIPmlK43jlV/uvOkNlkeG/a1nb.NaPd6bDhwh8yeEqMC',NULL,'KBJaWTO4acELZcgD5fybKBIFTp5pUkYIXkYVglV4tHAAHJ8enan6Js4gzjDh','2017-10-23 04:42:51','2017-10-23 04:42:51',NULL);
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

-- Dump completed on 2017-10-23 18:28:52
