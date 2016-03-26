<?php

include 'dbconn.php';

$query = "SELECT DISTINCT(`responsible`) AS worker, COUNT(sk_statusmonitor.regnumber) AS carcount FROM sk_servicesheduler INNER JOIN sk_statusmonitor ON date = DATE_FORMAT(`to`, '%Y-%m-%d') AND YEAR(date) = YEAR(NOW()) AND MONTH(date) = MONTH(NOW()) GROUP BY worker";

$mysqli->query("SET NAMES 'utf8'");
$result = $mysqli->query($query);

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $data_worker[] = [$row['worker'],(int)$row['carcount']];
}

$result->free();

$mysqli->close();

echo json_encode($data_worker);

// use yii\helpers\Json;

// $items = Yii::$app->db->createCommand("SELECT DISTINCT(`responsible`) AS worker, COUNT(sk_statusmonitor.regnumber) AS carcount FROM sk_servicesheduler INNER JOIN sk_statusmonitor ON date = DATE_FORMAT(`to`, '%Y-%m-%d') AND YEAR(date) = YEAR(NOW()) AND MONTH(date) = MONTH(NOW()) GROUP BY worker")->queryAll();
// var_dump($items)
// echo Json::encode($items);

?>