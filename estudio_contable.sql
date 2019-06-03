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
  `categoria` char(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ingresos_brutos` varchar(100) NOT NULL DEFAULT '0.00',
  `actividad` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `can_min_emp` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sup_afe` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ene_ele_con_anual` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `alq_dev_anual` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `pres_serv` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ven_cos_muebles` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `aporte_sipa` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `aporte_os` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `t_pres_serv` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `t_ven_cos_muebles` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (171,'A','138127.99','No excluida','No requiere','Hasta 30 m2','Hasta 3330 Kw','51798','111.81','111.81','493.31','689','1294.12','1294.12'),(172,'B','207191.98','No excluida','No requiere','Hasta 45 m2','Hasta 5000 Kw','51798','215.42','215.42','542.64','689','1447.06','1447.06'),(173,'C','276255.98','No excluida','No requiere','Hasta 60 m2','Hasta 6700 Kw','103595.99','368.34','340.38','596.91','689','1654.25','1626.29'),(174,'D','414383.98','No excluida','No requiere','Hasta 85 m2','Hasta 10000 Kw','103595.99','605.13','559.09','656.6','689','1950.73','1904.69'),(175,'E','552511.95','No excluida','No requiere','Hasta 110 m2','Hasta 13000 Kw','129083.89','1151.06','892.89','722.26','689','2562.32','2304.15'),(176,'F','690639.95','No excluida','No requiere','Hasta 150 m2','Hasta 16500 Kw','129494.98','1583.54','1165.86','794.48','689','3067.02','2649.34'),(177,'G','828767.94','No excluida','No requiere','Hasta 200 m2','Hasta 20000 Kw','155393.99','2014.37','1453.62','873.93','689','3577.3','3016.55'),(178,'H','1151066.58','No excluida','No requiere','Hasta 200 m2','Hasta 20000 Kw','207191.98','4604.26','3568.31','961.32','689','6254.58','5218.63'),(179,'I','1352503.24','Venta de Bs. muebles','No requiere','Hasta 200 m2','Hasta 20000 Kw','207191.98','-','5755.33','1057.46','689','-','7501.79'),(180,'J','1553939.89','Venta de Bs. muebles','No requiere','Hasta 200 m2','Hasta 20000 Kw','207191.98','-','6763.34','1163.21','689','-','8615.55'),(181,'K','1726599.88','Venta de Bs. muebles','No requiere','Hasta 200 m2','Hasta 20000 Kw','207191.98','-','7769.7','1279.52','689','-','9738.22');
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
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (27,'Jose luis','','','',1,'2019-06-04 00:00:00','20338049253','A',2055.00,'joseluis','joseluis','Monotributo');
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
  `movimiento` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cliente` int(11) NOT NULL,
  `anio` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimientos`
--

LOCK TABLES `movimientos` WRITE;
/*!40000 ALTER TABLE `movimientos` DISABLE KEYS */;
INSERT INTO `movimientos` VALUES (21,'ingresos',27,'2019',10000.00,20000.00,20000.00,0.00,0.00,0.00,455.00,0.00,0.00,0.00,0.00,0.00),(22,'egresos',27,'2019',0.00,0.00,0.00,0.00,0.00,0.00,200.00,200.00,0.00,0.00,0.00,0.00),(23,'ingresos',27,'2018',1000.00,1500.00,2500.00,1110.00,0.00,0.00,10000.00,10000.00,10000.00,10000.00,10000.00,10000.00),(24,'egresos',27,'2018',15110.00,2500.00,1140.00,2250.00,0.00,0.00,10.00,10.00,10.00,10.50,30.00,0.00);
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
INSERT INTO `users` VALUES (1,'Jose','Vazquez','admin','$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO','nosequeoner@asdasd.com','2016-05-21 15:06:00'),(2,'Cristian ','Bale','critian','$2y$10$V/6ViDqB57DrD91KkQgwcu5L/p3PRmDex8b9J9u4WfjlPCcS5OlPe','cbale@gmail.com','2019-05-21 19:20:04');
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

-- Dump completed on 2019-06-03  3:50:19
