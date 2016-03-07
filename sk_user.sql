-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: skoda
-- ------------------------------------------------------
-- Server version	5.5.47-0+deb8u1-log

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
-- Dumping data for table `sk_user`
--

LOCK TABLES `sk_user` WRITE;
/*!40000 ALTER TABLE `sk_user` DISABLE KEYS */;
INSERT INTO `sk_user` VALUES (1,1455446268,1457294221,'Максим','Ищенко','Георгиевич','Максим Ищенко','','Администратор','root','ИщенкоМГ','yRO_9dBA7sYMaf-Pl9gGW3QVOF1ivw7G',NULL,'$2y$13$UYU.xucZWaQrClS0zn/Nb.CwFUfD/cvIiprlXqia0j8KQAEltXo2C',NULL,'maxim.ishchenko@gmail.com',1),(28,1456337354,1457292196,'Ангелина','Белых','Александровна','Ангелина Белых','','Директор','head','БелыхАА','VjoAmjsk2XmcMlXMVnJOeZU_WN7Pv3EJ',NULL,'$2y$13$cZ4r9w5Zuz4SWqJMdxxh4.9Kqq2pRP4zo8UXJOcpPVxBwj42IvP8K',NULL,'angelina.belih@strela-avto.ru',1),(29,1456337623,1457292212,'Владислав','Степанов','Александрович','Владислав Степанов','','РОС','head','СтепановВА','m7WiOM-ubmdajw3PnCnbpKg80raqq5Ac',NULL,'$2y$13$91YHDgj6zP3j6LwEVg/g7uoY1I/mwdJSH3JH15bQb9hujdwQXKIIO',NULL,'vladislav.stepanov@strela-avto.ru',1),(39,1456388987,1457292224,'Леонид','Сикорский','Леонидович','Леонид Сикорский','img/uploads/userphoto/Сикорский.jpg','Мастер-консультант','manager','СикорскийЛЛ','6r7MbuvOMQo0EBOOkU9fYjpdaDaRpcmx',NULL,'$2y$13$FyhXAKlLKrCmDwBhX9GtRuBzksH2nUHCbWD336jVoBJRKfe0oNvZS',NULL,'leonid.sikorskiy@strela-avto.ru',1),(40,1456391012,1457292248,'Владимир','Видович','Александрович','Владимир Видович','img/uploads/userphoto/Видович.jpg','Мастер-консультант','manager','ВидовичВА','YFhKtX4TkysStY32HASs3ZZFjbw0Cjxc',NULL,'$2y$13$Ug7EDdj3clC7xhP/RbBQTuvcgI0j598WvqN1nqxC6HO8ZfWKx8BbK',NULL,'vladimir.vidovich@strela-avto.ru',1),(41,1456477816,1457292256,'Екатерина','Кожанова','Александровна','Екатерина Кожанова','','Ассистент сервиса','manager','КожановаЕА','7i0KFABzU_gZyxHy1qIfjBXQ19-Mqq2i',NULL,'$2y$13$OFiY1iegv77tL6DlDZOhwueUscrijOgF5..qkZJEcQtUcAStrjGoO',NULL,'service@strela-avto.ru',1),(42,1456477923,1457292261,'Елена','Моргунова','Викторовна','Елена Моргунова','','Ассистент сервиса','manager','МоргуноваЕВ','DPlKwaYAZByMeIH7Jt-AuwG5jdSTLZ1o',NULL,'$2y$13$U26QoQ5n3OXiO/HOqI.se.vhV0eysJYv6YAfgqpQisLBOx3wYDKrG',NULL,'elena.morgunova@strela-avto.ru',1);
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

-- Dump completed on 2016-03-07 15:50:46
