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
-- Table structure for table `all_message`
--

DROP TABLE IF EXISTS `all_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `all_message` (
  `id` int(11) NOT NULL,
  `language` varchar(16) NOT NULL,
  `translation` text,
  PRIMARY KEY (`id`,`language`),
  CONSTRAINT `fk_message_source_message` FOREIGN KEY (`id`) REFERENCES `all_source_message` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `all_message`
--

LOCK TABLES `all_message` WRITE;
/*!40000 ALTER TABLE `all_message` DISABLE KEYS */;
INSERT INTO `all_message` VALUES (1,'ru-RU','ID'),(2,'ru-RU','Язык'),(3,'ru-RU','Перевод'),(4,'ru-RU','Категория'),(5,'ru-RU','Сообщение'),(8,'ru-RU','Редактировать {modelClass}'),(9,'ru-RU','Редактирование'),(10,'ru-RU','Удалить'),(11,'ru-RU','Удалить запись?'),(12,'ru-RU','Добавить'),(13,'ru-RU','Поиск'),(14,'ru-RU','Сброс'),(16,'ru-RU','Интернационализация'),(17,'ru-RU',NULL),(18,'ru-RU',NULL),(19,'ru-RU',NULL),(20,'ru-RU',NULL),(21,'ru-RU',NULL),(22,'ru-RU',NULL),(23,'ru-RU',NULL),(24,'ru-RU',NULL),(25,'ru-RU',NULL),(26,'ru-RU',NULL),(27,'ru-RU',NULL),(28,'ru-RU','Автор'),(29,'ru-RU',NULL),(30,'ru-RU','Поиск'),(31,'ru-RU',NULL),(32,'ru-RU','Справочники'),(33,'ru-RU',NULL),(34,'ru-RU',NULL),(35,'ru-RU','{icon} Поиск'),(36,'ru-RU','{icon} Добавить'),(37,'ru-RU','{icon} Обновить'),(38,'ru-RU','{icon} Удалить'),(39,'ru-RU',NULL),(40,'ru-RU',NULL),(41,'ru-RU','Альянс'),(42,'ru-RU','ŠKODA'),(43,'ru-RU','Справочники'),(44,'ru-RU','Администрирование'),(45,'ru-RU','Администрирование'),(46,'ru-RU','Пользователи'),(47,'ru-RU','Роли пользователей'),(48,'ru-RU','Интернационализация'),(49,'ru-RU','{icon} Интернационализация'),(50,'ru-RU','{icon} Добавить'),(51,'ru-RU','{icon} Редактировать'),(52,'ru-RU','{icon} Удалить'),(53,'ru-RU','{icon} Отмена'),(55,'ru-RU','Вход'),(56,'ru-RU','Профиль'),(57,'ru-RU','Выход'),(58,'ru-RU','Ф.И.О.'),(59,'ru-RU','EMAIL'),(60,'ru-RU','Тема сообщения'),(61,'ru-RU','Текст сообщения'),(62,'ru-RU','Код подтверждения'),(63,'ru-RU','Обратная связь'),(64,'ru-RU','Сообщение отправлено'),(65,'ru-RU','Заполнить для отправки'),(67,'ru-RU','{icon} Отправить'),(68,'ru-RU',NULL),(69,'ru-RU',NULL),(70,'ru-RU','{icon} Справочники'),(71,'ru-RU','{icon} Сотрудники'),(72,'ru-RU','{icon} Регионы'),(73,'ru-RU','{icon} Цели'),(74,'ru-RU','{icon} Бренды'),(75,'ru-RU','{icon} Модели'),(76,'ru-RU','{icon} Типы кузова'),(77,'ru-RU','{icon} Должности'),(78,'ru-RU','{icon} Отделы'),(79,'ru-RU','{icon} Организации'),(80,'ru-RU','{icon} Виды контакта'),(83,'ru-RU','{icon} Альянс'),(84,'ru-RU','{icon} ОКиС. Календарь'),(85,'ru-RU','{icon} ОКиС. Трафик клиентов'),(86,'ru-RU','Экспорт в Excel доступен только пользователям с ролью \"Администратор\"'),(87,'ru-RU',NULL),(88,'ru-RU',NULL),(89,'ru-RU',NULL),(90,'ru-RU',NULL),(91,'ru-RU','Новый пароль'),(92,'ru-RU','Повтор пароля'),(93,'ru-RU','Роль'),(94,'ru-RU','Отдел'),(95,'ru-RU','Роль'),(96,'ru-RU','Описание роли'),(97,'ru-RU','Дата создания'),(98,'ru-RU','Дата редактирования'),(99,'ru-RU','Автор'),(100,'ru-RU','Количество пользователей'),(101,'ru-RU',NULL),(102,'ru-RU',NULL),(103,'ru-RU','Фамилия'),(104,'ru-RU','Имя'),(105,'ru-RU','Отчество'),(106,'ru-RU','Ф.И.О.'),(107,'ru-RU',NULL),(108,'ru-RU','Должность'),(109,'ru-RU','Имя пользователя'),(110,'ru-RU','EMAIL'),(111,'ru-RU','Статус'),(114,'ru-RU','{icon} Поиск'),(115,'ru-RU','{icon} Экспорт Excel'),(116,'ru-RU','Для организации переводов конструкций, включающих в себя описание иконок, либо моделей, т.е. имеющих вид <span class=\"label label-danger\">{icon} TRANSLATION_CODE</span> - в графе \"Перевод\" также необходимо указывать <span class=\"label label-danger\">{icon}</span> и т.д.'),(117,'ru-RU','Добавить'),(118,'ru-RU','Кол-во пользователей'),(119,'ru-RU','Редактировать'),(120,'ru-RU','{icon} Редактировать'),(121,'ru-RU',NULL),(122,'ru-RU','Добавление пользователя'),(123,'ru-RU','Редактирование'),(124,'ru-RU','Редактировать'),(125,'ru-RU','Удалить'),(126,'ru-RU','Удалить пользователя?'),(127,'ru-RU','{icon} Добавить'),(128,'ru-RU',NULL),(129,'ru-RU','{icon} Отмена'),(130,'ru-RU','{icon} Добавить'),(131,'ru-RU','{icon} Обновить'),(132,'ru-RU',NULL),(133,'ru-RU',NULL),(134,'ru-RU','ŠKODA'),(135,'ru-RU','ŠKODA. График смен'),(136,'ru-RU','ŠKODA. Монитор готовности'),(137,'ru-RU',NULL),(138,'ru-RU',NULL),(139,'ru-RU',NULL),(140,'ru-RU',NULL),(141,'ru-RU',NULL),(142,'ru-RU',NULL),(143,'ru-RU',NULL),(144,'ru-RU','Пароль'),(145,'ru-RU','Запомнить'),(146,'ru-RU','Новый пароль'),(147,'ru-RU','Повтор пароля'),(148,'ru-RU','Текущий пароль'),(149,'ru-RU',NULL),(150,'ru-RU',NULL),(151,'ru-RU',NULL),(152,'ru-RU',NULL),(153,'ru-RU','Код подтверждения'),(154,'ru-RU','Зарегистрирован'),(155,'ru-RU',NULL),(156,'ru-RU','Компания'),(157,'ru-RU','Отдел'),(158,'ru-RU','Фото:'),(159,'ru-RU','Роль'),(161,'ru-RU',NULL),(164,'ru-RU','Просмотр профиля'),(165,'ru-RU','Редактировать профиль'),(166,'ru-RU','Сменить пароль'),(167,'ru-RU','Смена пароля'),(168,'ru-RU','Сохранить изменения'),(169,'ru-RU','Отмена'),(170,'ru-RU','Редактирование профиля'),(171,'ru-RU','{icon} Сохранить изменения'),(172,'ru-RU','{icon} Отмена'),(173,'ru-RU','При изменении информации в полях \"Фамилия\", \"Имя\" и \"Отчество\" изменится имя входа пользователя (в случае его использования), при изменении информации в поле email также изменится email входа пользователя'),(174,'ru-RU','{icon} Сброс пароля'),(175,'ru-RU','{icon} Вход'),(176,'ru-RU','{icon} Вход'),(177,'ru-RU','{icon} Вход'),(178,'ru-RU','{icon} Обратная связь'),(179,'ru-RU','{icon} Профиль'),(180,'ru-RU','{icon} Выход'),(181,'ru-RU','{icon} Сброс пароля'),(182,'ru-RU','{icon} Заполнить для сброса пароля'),(183,'ru-RU','{icon} Назад'),(184,'ru-RU','{icon} Отправить'),(185,'ru-RU','{icon} Регистрация'),(186,'ru-RU','{icon} Заполнить для регистрации'),(187,'ru-RU','Данный раздел содержит справочную информацию о существующих ролях приложения. Перед добавление ролей в данный раздел необходимо описать роли в файлах <span class=\"label label-danger\">/commands/RbacController</span>, <span class=\"label label-danger\">/components/rbac/GroupRule</span>, <span class=\"label label-danger\">/config/common-local</span> (секция authManager), выполнить <span class=\"label label-danger\">php yii rbac/init</span> для инициализации ролей в консоли'),(188,'ru-RU','{icon} Пользователи'),(189,'ru-RU','{icon} Роли пользователей'),(190,'ru-RU','{icon} Интернационализация'),(191,'ru-RU','{icon} Перечень пользователей с указанной ролью'),(192,'ru-RU','{icon} ŠKODA'),(193,'ru-RU','{icon} ŠKODA. График смен'),(194,'ru-RU','{icon} ŠKODA. Монитор готовности'),(195,'ru-RU',NULL),(196,'ru-RU','{icon} График смен'),(197,'ru-RU','{icon} Монитор готовности');
/*!40000 ALTER TABLE `all_message` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-22 15:10:06
