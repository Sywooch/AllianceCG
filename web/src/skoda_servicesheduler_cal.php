<?php

include 'dbconn.php';

header('Content-type: text/html; charset=utf-8');
// Список событий
 $json = array();

 // Запрос, возвращающий события
 // $request = "SELECT CONCAT(shipping_manager, ' => ', client_name) AS title, shipping_datetime as start from shipping_cars;";
 $request = "SELECT `id`, `date` AS start, `date` AS end, `responsible` AS title FROM `sk_servicesheduler`;";
mysql_query('SET NAMES utf8');
 // Соединение с БД
 try {
 // $dbcon = new PDO('mysql:host=localhost;dbname=skoda', 'user', 'password');
 $dbcon = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser, $dbpassword);
 $dbcon->exec("set names utf8");
 } catch(Exception $e) {
  exit('Unable to connect to database.');
 }
 // Выполнение запроса
 $result = $dbcon->query($request) or die(print_r($dbcon->errorInfo()));

 // Отправка кодированного результата на страницу
 echo json_encode($result->fetchAll(PDO::FETCH_ASSOC));

?>