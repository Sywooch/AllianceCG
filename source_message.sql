-- MySQL dump 10.13  Distrib 5.7.11, for Win64 (x86_64)
--
-- Host: localhost    Database: alliance
-- ------------------------------------------------------
-- Server version	5.7.11-log

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
-- Table structure for table `all_source_message`
--

DROP TABLE IF EXISTS `all_source_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `all_source_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(32) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `all_source_message`
--

LOCK TABLES `all_source_message` WRITE;
/*!40000 ALTER TABLE `all_source_message` DISABLE KEYS */;
INSERT INTO `all_source_message` VALUES (1,'app','ID'),(2,'app','Language'),(3,'app','Translation'),(4,'app','Category'),(5,'app','Message'),(8,'app','Update {modelClass}: '),(9,'app','Update'),(10,'app','Delete'),(11,'app','Are you sure you want to delete this item?'),(12,'app','Create'),(13,'app','Search'),(14,'app','Reset'),(16,'app','Source Messages'),(17,'app','Calendar ID'),(18,'app','Company ID'),(19,'app','User ID'),(20,'app','Clientcirculation ID'),(21,'app','Contact Type'),(22,'app','Target'),(23,'app','Car Model'),(24,'app','Comment'),(25,'app','State'),(26,'app','Created At'),(27,'app','Updated At'),(28,'app','Author'),(29,'app','Client Circulations'),(30,'app','SEARCH'),(31,'app','Create Contact Type'),(32,'app','REFERENCES'),(33,'app','Contact Types'),(34,'app','CONTACTTYPES'),(35,'app','{icon} SEARCH'),(36,'app','{icon} CREATE'),(37,'app','{icon} REFRESH'),(38,'app','{icon} DELETE'),(39,'app','{icon} RESTORE'),(40,'app','ERROR_EMAIL_EXISTS'),(41,'app','NAV_ALLIANCE'),(42,'app','NAV_SKODA'),(43,'app','NAV_REFERENCES'),(44,'app','NAV_ADMIN'),(45,'app','ADMIN'),(46,'app','ADMIN_USERS'),(47,'app','NAV_USERROLES'),(48,'app','TRANSLATIONS'),(49,'app','{icon} TRANSLATIONS'),(50,'app','{icon} Create'),(51,'app','{icon} Update'),(52,'app','{icon} Delete'),(53,'app','{icon} CANCEL'),(55,'app','NAV_LOGIN'),(56,'app','NAV_PROFILE'),(57,'app','NAV_LOGOUT'),(58,'app','CONTACT_NAME'),(59,'app','CONTACT_EMAIL'),(60,'app','CONTACT_SUBJECT'),(61,'app','CONTACT_BODY'),(62,'app','CONTACT_VERIFYCODE'),(63,'app','TITLE_CONTACT'),(64,'app','CONTACT_THANKS'),(65,'app','CONTACT_INFO'),(67,'app','{icon} BUTTON_SUBMIT'),(68,'app','ERROR_OCCURED'),(69,'app','PLEASE_CONTACT'),(70,'app','{icon} NAV_REFERENCES'),(71,'app','{icon} REFERENCES_EMPLOYEES'),(72,'app','{icon} REFERENCES_REGIONS'),(73,'app','{icon} REFERENCES_TARGETS'),(74,'app','{icon} REFERENCES_BRANDS'),(75,'app','{icon} REFERENCES_MODELS'),(76,'app','{icon} REFERENCES_BODYTYPES'),(77,'app','{icon} ADMIN_POSITIONS'),(78,'app','{icon} ADMIN_DEPARTMENTS'),(79,'app','{icon} ADMIN_COMPANIES'),(80,'app','{icon} CONTACTTYPE'),(83,'app','{icon} NAV_ALLIANCE'),(84,'app','{icon} NAV_ALLIANCE_CREDITCALENDAR'),(85,'app','{icon} NAV_ALLIANCE_CLIENTCIRCULATION'),(86,'app','ONLY_ADMIN_CAN_EXPORT_EXCEL'),(87,'app','TR_EXCEL_TITLE'),(88,'app','TRANSLATIONS_HEADER_TEXT'),(89,'app','TRANSLATION_EXCEL_TABLEHEADER'),(90,'app','TRANSLATION_EXCEL_TITLE'),(91,'app','ADMIN_USER_NEW_PASSWORD'),(92,'app','ADMIN_USER_REPEAT_PASSWORD'),(93,'app','ADMIN_USERS_ROLE'),(94,'app','DEPARTMENT'),(95,'app','ROLE_NAME'),(96,'app','ROLE_DESCRIPTION'),(97,'app','CREATED_AT'),(98,'app','UPDATED_AT'),(99,'app','AUTHOR'),(100,'app','USERROLESCOUNT'),(101,'app','USER_CREATED'),(102,'app','USER_UPDATED'),(103,'app','USER_SURNAME'),(104,'app','USER_NAME'),(105,'app','USER_PATRONYMIC'),(106,'app','USER_FULLNAME'),(107,'app','USER_SHORTNAME'),(108,'app','USER_POSITION'),(109,'app','USER_USERNAME'),(110,'app','USER_EMAIL'),(111,'app','USER_STATUS'),(114,'app','{icon} Search'),(115,'app','{icon} EXPORT_EXCEL'),(116,'app','MESSAGE_TRANSLATION_INFO'),(117,'app','CREATE'),(118,'app','COUNTUSERS'),(119,'app','UPDATE'),(120,'app','{icon} UPDATE'),(121,'app','REALLY_DELETE'),(122,'app','ADMIN_USER_CREATE'),(123,'app','ADMIN_TITLE_UPDATE'),(124,'app','ADMIN_USER_UPDATE'),(125,'app','ADMIN_USER_DELETE'),(126,'app','ADMIN_USER_DELETE_CONFIRM'),(127,'app','{icon} BUTTON_CREATE'),(128,'app','{icon} ADMIN_USERS_BUTTON_UPDATE'),(129,'app','{icon} ADMIN_USERS_BUTTON_CANCEL'),(130,'app','{icon} ADMIN_USERS_CREATE'),(131,'app','{icon} ADMIN_USERS_REFRESH'),(132,'app','NAV_ALLIANCE_DASHBOARD'),(133,'app','NAV_ALLIANCE_CREDITCALENDAR'),(134,'app','NAV_SKODA_DASHBOARD'),(135,'app','NAV_SKODA_SERVICESHEDULER'),(136,'app','NAV_SKODA_STATUSMONITOR'),(137,'app','NAV_ADMIN_DASHBOARD'),(138,'app','NAV_USERS'),(139,'app','NAV_COMPANIES'),(140,'app','NAV_POSITIONS'),(141,'app','ERROR_WRONG_USERNAME_OR_PASSWORD'),(142,'app','ERROR_PROFILE_BLOCKED'),(143,'app','ERROR_PROFILE_NOT_CONFIRMED'),(144,'app','USER_PASSWORD'),(145,'app','USER_REMEMBER_ME'),(146,'app','USER_NEW_PASSWORD'),(147,'app','USER_REPEAT_PASSWORD'),(148,'app','USER_CURRENT_PASSWORD'),(149,'app','ERROR_WRONG_CURRENT_PASSWORD'),(150,'app','ERROR_USER_NOT_FOUND_BY_EMAIL'),(151,'app','PASSWORD_RESET_FOR'),(152,'app','ERROR_USERNAME_EXISTS'),(153,'app','USER_VERIFY_CODE'),(154,'app','USER_CREATED_AT'),(155,'app','USER_UPDATED_AT'),(156,'app','USER_COMPANY'),(157,'app','USER_DEPARTMENT'),(158,'app','USER_PHOTO'),(159,'app','USER_ROLE'),(161,'app','LOGIN_INFO'),(164,'app','PROFILE_TITLE_PROFILE'),(165,'app','PROFILE_BUTTON_UPDATE'),(166,'app','PROFILE_LINK_PASSWORD_CHANGE'),(167,'app','PROFILE_TITLE_PASSWORD_CHANGE'),(168,'app','PROFILE_BUTTON_SAVE'),(169,'app','PROFILE_BUTTON_CANCEL'),(170,'app','PROFILE_TITLE_UPDATE'),(171,'app','{icon} PROFILE_BUTTON_SAVE'),(172,'app','{icon} PROFILE_BUTTON_CANCEL'),(173,'app','PROFILE_UPDATE_INFO'),(174,'app','{icon} LINK_PASSWORD_RESET'),(175,'app','{icon} USER_BUTTON_LOGIN'),(176,'app','{icon} TITLE_LOGIN'),(177,'app','{icon} NAV_LOGIN'),(178,'app','{icon} NAV_CONTACT'),(179,'app','{icon} NAV_PROFILE'),(180,'app','{icon} NAV_LOGOUT'),(181,'app','{icon} TITLE_PASSWORD_RESET'),(182,'app','{icon} PLEASE_FILL_FOR_RESET_REQUEST'),(183,'app','{icon} GO_BACK'),(184,'app','{icon} BUTTON_SEND'),(185,'app','{icon} TITLE_SIGNUP'),(186,'app','{icon} PLEASE_FILL_FOR_SIGNUP'),(187,'app','USERROLES_INFO'),(188,'app','{icon} ADMIN_USERS'),(189,'app','{icon} ADMIN_USERROLES'),(190,'app','{icon} ADMIN_TRANSLATIONS'),(191,'app','{icon} USERS_WITH_CURRENT_ROLE'),(192,'app','{icon} NAV_SKODA'),(193,'app','{icon} NAV_SKODA_SERVICESHEDULER'),(194,'app','{icon} NAV_SKODA_STATUSMONITOR'),(195,'app','ŠKODA'),(196,'app','{icon} SERVICESHEDULER'),(197,'app','{icon} STATUSMONITOR');
/*!40000 ALTER TABLE `all_source_message` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-22 15:09:44
