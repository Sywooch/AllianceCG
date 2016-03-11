<?php

include 'dbconn.php';

$query = "SELECT DISTINCT(DATE_FORMAT(FROM_UNIXTIME(created_at), '%Y-%m-%d')) AS date, COUNT(id) AS userscount FROM sk_user GROUP BY date;";

$mysqli->query("SET NAMES 'utf8'");
$result = $mysqli->query($query);

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $data_user[] = [$row['date'],(int)$row['userscount']];
}

$result->free();

$mysqli->close();

echo json_encode($data_user);

// SELECT DISTINCT(DATE_FORMAT(FROM_UNIXTIME(created_at), '%Y-%m-%d')) AS date, COUNT(id) AS userscount FROM sk_user GROUP BY date;

?>