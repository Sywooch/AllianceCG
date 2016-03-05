<?php

include 'dbconn.php';

$mysqli = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}

$query = "SELECT DATE_FORMAT(`to`, '%Y-%m-%d') as date, COUNT(`regnumber`) AS car FROM sk_statusmonitor WHERE MONTH(DATE_FORMAT(`to`, '%Y-%m-%d')) = MONTH(CURDATE()) GROUP BY date";
$result = $mysqli->query($query);

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $data_car[] = [$row['date'],(int)$row['car']];
}

$result->free();

$mysqli->close();

// var_dump($data_car);
echo json_encode($data_car);

?>