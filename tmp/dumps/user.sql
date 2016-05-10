-- MySQL dump 10.16  Distrib 10.1.13-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: skoda
-- ------------------------------------------------------
-- Server version	10.1.13-MariaDB

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
-- Table structure for table `sk_user`
--

DROP TABLE IF EXISTS `sk_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sk_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `patronymic` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) DEFAULT NULL,
  `email_confirm_token` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_user_username` (`username`),
  KEY `idx_user_email` (`email`),
  KEY `idx_user_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sk_user`
--

LOCK TABLES `sk_user` WRITE;
/*!40000 ALTER TABLE `sk_user` DISABLE KEYS */;
INSERT INTO `sk_user` VALUES (1,1455446268,1458680258,'Максим','Ищенко','Георгиевич','Максим Ищенко','img/uploads/userphoto/1467509436.png','ООО \"Альянс\"','Администратор','root','ИщенкоМГ','yRO_9dBA7sYMaf-Pl9gGW3QVOF1ivw7G',NULL,'$2y$13$M.8Xx4FIXgfs5fWomNbFcueH77EtowL.B6xqLkjV/ixvNj/vpEkLu',NULL,'maxim.ishchenko@gmail.com',1),(28,1456337354,1457720272,'Ангелина','Белых','Александровна','Ангелина Белых','','ООО \"СтрелаАвто\"','Директор','head','БелыхАА','VjoAmjsk2XmcMlXMVnJOeZU_WN7Pv3EJ',NULL,'$2y$13$cZ4r9w5Zuz4SWqJMdxxh4.9Kqq2pRP4zo8UXJOcpPVxBwj42IvP8K',NULL,'angelina.belih@strela-avto.ru',1),(29,1456337623,1458375521,'Владислав','Степанов','Александрович','Владислав Степанов','','ООО \"СтрелаАвто\"','РОС','head','СтепановВА','m7WiOM-ubmdajw3PnCnbpKg80raqq5Ac',NULL,'$2y$13$91YHDgj6zP3j6LwEVg/g7uoY1I/mwdJSH3JH15bQb9hujdwQXKIIO',NULL,'vladislav.stepanov@strela-avto.ru',1),(39,1456388987,1457720300,'Леонид','Сикорский','Леонидович','Леонид Сикорский','img/uploads/userphoto/1467508933.jpg','ООО \"СтрелаАвто\"','Мастер-консультант','manager','СикорскийЛЛ','6r7MbuvOMQo0EBOOkU9fYjpdaDaRpcmx',NULL,'$2y$13$FyhXAKlLKrCmDwBhX9GtRuBzksH2nUHCbWD336jVoBJRKfe0oNvZS',NULL,'leonid.sikorskiy@strela-avto.ru',1),(40,1456391012,1457720310,'Владимир','Видович','Александрович','Владимир Видович','img/uploads/userphoto/1467509029.jpg','ООО \"СтрелаАвто\"','Мастер-консультант','manager','ВидовичВА','YFhKtX4TkysStY32HASs3ZZFjbw0Cjxc',NULL,'$2y$13$Ug7EDdj3clC7xhP/RbBQTuvcgI0j598WvqN1nqxC6HO8ZfWKx8BbK',NULL,'vladimir.vidovich@strela-avto.ru',1),(41,1456477816,1457720322,'Екатерина','Кожанова','Александровна','Екатерина Кожанова','','ООО \"СтрелаАвто\"','Ассистент сервиса','manager','КожановаЕА','7i0KFABzU_gZyxHy1qIfjBXQ19-Mqq2i',NULL,'$2y$13$OFiY1iegv77tL6DlDZOhwueUscrijOgF5..qkZJEcQtUcAStrjGoO',NULL,'service@strela-avto.ru',1),(42,1456477923,1457720343,'Елена','Моргунова','Викторовна','Елена Моргунова','','ООО \"СтрелаАвто\"','Ассистент сервиса','manager','МоргуноваЕВ','DPlKwaYAZByMeIH7Jt-AuwG5jdSTLZ1o',NULL,'$2y$13$U26QoQ5n3OXiO/HOqI.se.vhV0eysJYv6YAfgqpQisLBOx3wYDKrG',NULL,'elena.morgunova@strela-avto.ru',1),(45,1457717670,1457859593,'Сергей','Луганский','Викторович','Сергей Луганский',NULL,'ООО \"АвтоБерг\"','РОП','head','ЛуганскийСВ','fOpFnqgOG9d5L3wz5ivle5TZOAgTr27j',NULL,'$2y$13$L4rgymsY7OvW2JgMgRvvnedGj7xISdQB7R24H8QNnBWbNZJBAEJoi',NULL,'sergey.luganskiy@vw-kmw.ru',1),(46,1460139167,1460139167,'Иван','Иванов','Иванович','Иван Иванов',NULL,'ООО \"Альянс\"','Директор','head','ИвановИИ','isz0r-nCxO-jx0Bg3qWEbdM6aIT57Ywf',NULL,'$2y$13$mE/tOxQ0srWObUtj0K39E.CpW/5bdMRnROTy5EYms4Vpioa.xRk6G',NULL,'info@ivanov.org',1);
/*!40000 ALTER TABLE `sk_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-12 20:10:05
