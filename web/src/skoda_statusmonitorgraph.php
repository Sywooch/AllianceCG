<?php

include 'dbconn.php';

$query = "SELECT DATE_FORMAT(`to`, '%Y-%m-%d') as date, COUNT(`regnumber`) AS car FROM sk_statusmonitor WHERE MONTH(DATE_FORMAT(`to`, '%Y-%m-%d')) = MONTH(CURDATE()) GROUP BY date";
$result = $mysqli->query($query);

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $data_car[] = [$row['date'],(int)$row['car']];
}

$result->free();

$mysqli->close();

echo json_encode($data_car);

?>