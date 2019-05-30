-- MySQL dump 10.13  Distrib 8.0.16, for Win64 (x86_64)
--
-- Host: localhost    Database: estudio_contable
-- ------------------------------------------------------
-- Server version	8.0.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `iibb` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'A',138128.99),(2,'B',207191.98),(3,'C',0.00),(4,'D',0.00),(5,'E',0.00),(6,'F',0.00),(7,'G',0.00),(8,'H',0.00),(9,'I',0.00),(10,'J',0.00),(11,'K',0.00);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(255) NOT NULL,
  `telefono_cliente` char(30) NOT NULL,
  `email_cliente` varchar(64) NOT NULL,
  `direccion_cliente` varchar(255) NOT NULL,
  `status_cliente` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL,
  `cuit` varchar(11) NOT NULL,
  `categoria` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `honorario` decimal(10,2) DEFAULT '0.00',
  `usuario` varchar(50) DEFAULT NULL,
  `clave` varchar(10) DEFAULT NULL,
  `condicion_iva` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `codigo_producto` (`nombre_cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (22,'Juan Carlos Medina','','','',1,'2019-05-12 00:00:00','20338049253','A',0.00,NULL,NULL,'Monotributo'),(21,'Diego Irala','','','',1,'2019-05-12 00:00:00','20338049253','A',0.00,NULL,NULL,'Monotributo'),(20,'Carlos Andres Vazquez','','','',1,'2019-05-12 00:00:00','20338049253','A',0.00,NULL,NULL,'Monotributo'),(19,'Marta Marchesi','','','',1,'2018-01-12 00:00:00','20338049253','A',0.00,NULL,NULL,'Monotributo'),(23,'Patricia Alejandra','','','',1,'2019-05-17 00:00:00','20338049253','',4201.00,'joseluis','joseluis','IVA Responsable Inscripto'),(24,'Jose luis','','','',1,'2018-02-25 00:00:00','20338049253','A',500.00,'joseluis','joseluis','Monotributo');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimientos`
--

DROP TABLE IF EXISTS `movimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `movimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movimiento` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cliente` int(11) NOT NULL,
  `anio` varchar(4) NOT NULL,
  `enero` decimal(10,2) DEFAULT '0.00',
  `febrero` decimal(10,2) DEFAULT '0.00',
  `marzo` decimal(10,2) DEFAULT '0.00',
  `abril` decimal(10,2) DEFAULT '0.00',
  `mayo` decimal(10,2) DEFAULT '0.00',
  `junio` decimal(10,2) DEFAULT '0.00',
  `julio` decimal(10,2) DEFAULT '0.00',
  `agosto` decimal(10,2) DEFAULT '0.00',
  `septiembre` decimal(10,2) DEFAULT '0.00',
  `octubre` decimal(10,2) DEFAULT '0.00',
  `noviembre` decimal(10,2) DEFAULT '0.00',
  `diciembre` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimientos`
--

LOCK TABLES `movimientos` WRITE;
/*!40000 ALTER TABLE `movimientos` DISABLE KEYS */;
INSERT INTO `movimientos` VALUES (3,'ingresos',19,'2019',10000.00,10000.00,10000.00,10000.00,10000.00,10000.00,10000.50,10000.00,10000.00,10000.00,10000.00,10000.00),(4,'egresos',19,'2019',10000.00,10000.00,10000.00,10000.00,10000.00,10000.00,10000.00,10000.00,10000.00,500.00,500.00,10000.00),(5,'ingresos',20,'2019',0.00,0.00,0.00,0.00,0.00,15000.00,20000.00,0.00,0.00,0.00,0.00,0.00),(6,'egresos',20,'2019',0.00,0.00,0.00,0.00,0.00,0.00,1500.00,25000.00,300.00,0.00,0.00,0.00),(7,'ingresos',21,'2019',0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00),(8,'egresos',21,'2019',0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00),(9,'ingresos',22,'2019',0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00),(10,'egresos',22,'2019',0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00),(11,'ingresos',23,'2019',0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00),(12,'egresos',23,'2019',0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00),(13,'ingresos',24,'2019',0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00),(14,'egresos',24,'2019',0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00);
/*!40000 ALTER TABLE `movimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `firstname` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Jose','Vazquez','admin','$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO','admin@admin.com','2016-05-21 15:06:00'),(2,'Cristian ','Bale','critian','$2y$10$uO9Nw9RCTmFmES.8xHWZseLvqQmxuan2u8tiAP41c1EDVHFgPcpeC','cbale@gmail.com','2019-05-21 19:20:04');
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

-- Dump completed on 2019-05-30  1:39:08
