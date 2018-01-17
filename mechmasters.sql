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
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `car_models_car_id_foreign` (`car_id`),
  CONSTRAINT `car_models_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `car_models`
--

LOCK TABLES `car_models` WRITE;
/*!40000 ALTER TABLE `car_models` DISABLE KEYS */;
INSERT INTO `car_models` VALUES (1,1,'Datsun','nissan.jpg','2018-01-12 01:54:41','2018-01-12 01:54:41',NULL,1),(2,2,'Mark II','toyota.jpg','2018-01-12 01:54:41','2018-01-12 01:54:41',NULL,1),(3,3,'Series 2','bmw.jpg','2018-01-12 01:54:41','2018-01-12 01:54:41',NULL,1),(4,4,'Escape','mazda.jpg','2018-01-12 01:54:41','2018-01-12 01:54:41',NULL,1),(5,5,'Discovery III','land-rover.jpg','2018-01-12 01:54:41','2018-01-12 01:54:41',NULL,1),(6,6,'Hyundai','hyundai.jpg','2018-01-12 01:54:41','2018-01-12 01:54:41',NULL,1),(7,7,'Pajero','mitsubishi.png','2018-01-12 01:54:41','2018-01-12 01:54:41',NULL,1),(8,8,'Ranger','ford.png','2018-01-12 01:54:41','2018-01-12 01:54:41',NULL,1);
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
  `date_added` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cars`
--

LOCK TABLES `cars` WRITE;
/*!40000 ALTER TABLE `cars` DISABLE KEYS */;
INSERT INTO `cars` VALUES (1,'Nissan','nissan.jpg','2018-01-12 01:54:40','2018-01-12 01:54:40',NULL,1),(2,'Toyota','toyota.jpg','2018-01-12 01:54:40','2018-01-12 01:54:40',NULL,1),(3,'BMW','bmw.jpg','2018-01-12 01:54:40','2018-01-12 01:54:40',NULL,1),(4,'Mazda','mazda.jpg','2018-01-12 01:54:40','2018-01-12 01:54:40',NULL,1),(5,'Land Rover','land-rover.jpg','2018-01-12 01:54:41','2018-01-12 01:54:41',NULL,1),(6,'Hyundai','hyundai.jpg','2018-01-12 01:54:41','2018-01-12 01:54:41',NULL,1),(7,'Mitsubishi','mitsubishi.png','2018-01-12 01:54:41','2018-01-12 01:54:41',NULL,1),(8,'Ford','ford.png','2018-01-12 01:54:41','2018-01-12 01:54:41',NULL,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Pre filter','2018-01-12 01:54:43','2018-01-12 01:54:43',NULL),(2,'Cabin/AC filter','2018-01-12 01:54:43','2018-01-12 01:54:43',NULL),(3,'Brake pads','2018-01-12 01:54:43','2018-01-12 01:54:43',NULL),(4,'Oil filter','2018-01-12 01:54:43','2018-01-12 01:54:43',NULL),(5,'Air Cleaner','2018-01-12 01:54:43','2018-01-12 01:54:43',NULL),(6,'Spark Plugs','2018-01-12 01:54:43','2018-01-12 01:54:43',NULL),(7,'Fuel Filter','2018-01-12 01:54:43','2018-01-12 01:54:43',NULL),(8,'Gear/b Oil','2018-01-12 01:54:43','2018-01-12 01:54:43',NULL);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_cars`
--

LOCK TABLES `customer_cars` WRITE;
/*!40000 ALTER TABLE `customer_cars` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_services`
--

LOCK TABLES `customer_services` WRITE;
/*!40000 ALTER TABLE `customer_services` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devices`
--

LOCK TABLES `devices` WRITE;
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
/*!40000 ALTER TABLE `devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `feedback_customer_id_foreign` (`customer_id`),
  CONSTRAINT `feedback_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=591 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (140,'2017_10_27_092243_create_promo_messages_table',1),(553,'2014_10_12_100000_create_password_resets_table',2),(554,'2016_06_01_000001_create_oauth_auth_codes_table',2),(555,'2016_06_01_000002_create_oauth_access_tokens_table',2),(556,'2016_06_01_000003_create_oauth_refresh_tokens_table',2),(557,'2016_06_01_000004_create_oauth_clients_table',2),(558,'2016_06_01_000005_create_oauth_personal_access_clients_table',2),(559,'2017_09_17_061515_create_categories_table',2),(560,'2017_09_18_112745_create_cars_table',2),(561,'2017_09_18_112746_create_car_models_table',2),(562,'2017_09_18_112759_create_services_table',2),(563,'2017_09_18_112760_create_service_as_products_table',2),(564,'2017_09_18_112831_create_customers_table',2),(565,'2017_09_18_114535_create_products_table',2),(566,'2017_09_18_114759_create_customer_cars_table',2),(567,'2017_09_18_114848_create_customer_services_table',2),(568,'2017_09_18_114907_create_devices_table',2),(569,'2017_09_18_114956_create_orders_table',2),(570,'2017_09_18_115015_create_purchases_table',2),(571,'2017_09_22_000000_create_users_table',2),(572,'2017_09_25_072528_create_notifications_table',2),(573,'2017_10_18_080547_edit_service_as_products_table',2),(574,'2017_10_18_151546_edit_customer_services_table',2),(575,'2017_10_19_104153_edit_customer_services_table_8',2),(576,'2017_10_21_105120_edit_customer_services_table_9',2),(577,'2017_10_21_163559_edit_car_models_table_1',2),(578,'2017_10_23_014701_edit_orders_table_2',2),(579,'2017_10_23_092341_edit_cars_table_1',2),(580,'2017_10_26_142127_create_user_devices_table',2),(581,'2017_10_27_085720_create_feedback_table',2),(582,'2017_10_27_112707_create_service_promo_messages_table',2),(583,'2017_10_27_112717_create_order_promo_messages_table',2),(584,'2017_11_03_140643_edit_customers_table_2',2),(585,'2017_11_09_153213_edit_cars_table_2',2),(586,'2017_11_10_084501_edit_cars_table_3',2),(587,'2017_11_10_084533_edit_car_models_table_2',2),(588,'2017_11_10_170049_edit_services_table_1',2),(589,'2018_01_11_131100_edit_products_table_1',2),(590,'2018_01_11_131450_edit_products_table_2',2);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'Laravel Personal Access Client','wRenEKO3gWyS8o6ZTrvYD32EEAcjxQKTL9tgGgaB','http://localhost',1,0,0,'2018-01-12 02:06:07','2018-01-12 02:06:07'),(2,NULL,'Laravel Password Grant Client','p9rqdUqDZf1FBC5RgPhgHVvKf4iw7aUXS8dfmvq9','http://localhost',0,1,0,'2018-01-12 02:06:08','2018-01-12 02:06:08');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2018-01-12 02:06:08','2018-01-12 02:06:08');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_promo_messages`
--

DROP TABLE IF EXISTS `order_promo_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_promo_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_promo_messages`
--

LOCK TABLES `order_promo_messages` WRITE;
/*!40000 ALTER TABLE `order_promo_messages` DISABLE KEYS */;
INSERT INTO `order_promo_messages` VALUES (1,'MechMaster cares for your car!','2018-01-12 01:54:44','2018-01-12 01:54:44',NULL);
/*!40000 ALTER TABLE `order_promo_messages` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
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
  `stock` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,1,1,'SteriPEN','1',175000,175,0,'A/C, Mirror',175000,'1 years','1.jpg','2018-01-12 01:54:43','2018-01-12 01:54:43',NULL),(2,2,2,2,'ACDelco','2',2000000,2000,1,'Oil, Filter',2000000,'2 months','2.jpg','2018-01-12 01:54:43','2018-01-12 01:54:43',NULL),(3,3,3,3,'RINGSPANN','3',175000,175,0,'A/C, Mirror',175000,'3 years','3.jpg','2018-01-12 01:54:43','2018-01-12 01:54:43',NULL),(4,4,4,4,'RYCO Oil Filter','4',2000000,2000,1,'Oil, Filter',2000000,'4 months','4.jpg','2018-01-12 01:54:44','2018-01-12 01:54:44',NULL),(5,5,5,5,'MUSTANG 13','5',175000,175,0,'A/C, Mirror',175000,'5 years','5.jpg','2018-01-12 01:54:44','2018-01-12 01:54:44',NULL),(6,6,6,6,'NGK Spark Plugs','6',2000000,2000,1,'Oil, Filter',2000000,'6 months','6.png','2018-01-12 01:54:44','2018-01-12 01:54:44',NULL),(7,7,7,7,'Paxton Superchargers','7',175000,175,0,'A/C, Mirror',175000,'7 years','7.jpg','2018-01-12 01:54:44','2018-01-12 01:54:44',NULL),(8,8,8,8,'Motul 2-stroke','8',2000000,2000,1,'Oil, Filter',2000000,'8 months','8.jpg','2018-01-12 01:54:44','2018-01-12 01:54:44',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_messages`
--

DROP TABLE IF EXISTS `promo_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_messages`
--

LOCK TABLES `promo_messages` WRITE;
/*!40000 ALTER TABLE `promo_messages` DISABLE KEYS */;
INSERT INTO `promo_messages` VALUES (1,'MechMaster cares for your car!','2017-10-27 06:30:27','2017-10-27 06:30:27',NULL);
/*!40000 ALTER TABLE `promo_messages` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases`
--

LOCK TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_as_products`
--

LOCK TABLES `service_as_products` WRITE;
/*!40000 ALTER TABLE `service_as_products` DISABLE KEYS */;
INSERT INTO `service_as_products` VALUES (1,1,1,1,175000,1,'2018-01-12 01:54:42','2018-01-12 01:54:42',NULL),(2,2,2,2,2000000,1,'2018-01-12 01:54:42','2018-01-12 01:54:42',NULL),(3,3,3,3,175000,1,'2018-01-12 01:54:42','2018-01-12 01:54:42',NULL),(4,4,4,4,2000000,1,'2018-01-12 01:54:42','2018-01-12 01:54:42',NULL),(5,5,5,5,175000,1,'2018-01-12 01:54:42','2018-01-12 01:54:42',NULL),(6,6,6,6,2000000,1,'2018-01-12 01:54:43','2018-01-12 01:54:43',NULL);
/*!40000 ALTER TABLE `service_as_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_promo_messages`
--

DROP TABLE IF EXISTS `service_promo_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_promo_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_promo_messages`
--

LOCK TABLES `service_promo_messages` WRITE;
/*!40000 ALTER TABLE `service_promo_messages` DISABLE KEYS */;
INSERT INTO `service_promo_messages` VALUES (1,'MechMaster services the solution!','2018-01-12 01:54:44','2018-01-12 01:54:44',NULL);
/*!40000 ALTER TABLE `service_promo_messages` ENABLE KEYS */;
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
  `description` text COLLATE utf8mb4_unicode_ci,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Diagnosis','We do a great service','1.jpg','2018-01-12 01:54:42','2018-01-12 01:54:42',NULL),(2,'Greesing','We do a great service','2.jpg','2018-01-12 01:54:42','2018-01-12 01:54:42',NULL),(3,'Check-up','We do a great service','3.jpg','2018-01-12 01:54:42','2018-01-12 01:54:42',NULL),(4,'Camber Adjustment','We do a great service','4.jpg','2018-01-12 01:54:42','2018-01-12 01:54:42',NULL),(5,'Wheel Balancing','We do a great service','5.jpg','2018-01-12 01:54:42','2018-01-12 01:54:42',NULL),(6,'Wheel Alignment','We do a great service','6.jpg','2018-01-12 01:54:42','2018-01-12 01:54:42',NULL);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_devices`
--

DROP TABLE IF EXISTS `user_devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_devices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_devices_user_id_foreign` (`user_id`),
  CONSTRAINT `user_devices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_devices`
--

LOCK TABLES `user_devices` WRITE;
/*!40000 ALTER TABLE `user_devices` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_devices` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','Admin',NULL,'admin','$2y$10$x/rF.aWqmAJbB/tWAqHQqO5JyRTS6Rr9V2ne4rBa4RTF0.FDiYJKK',NULL,NULL,'2018-01-12 01:54:40','2018-01-12 01:54:40',NULL);
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

-- Dump completed on 2018-01-12  8:07:07
