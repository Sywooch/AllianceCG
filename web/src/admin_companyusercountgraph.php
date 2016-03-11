<?php

include 'dbconn.php';

$query = "SELECT DISTINCT(company) as company, COUNT(id) AS users FROM sk_user GROUP BY company";

$mysqli->query("SET NAMES 'utf8'");
$result = $mysqli->query($query);

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $data_company[] = [$row['company'],(int)$row['users']];
}

$result->free();

$mysqli->close();

echo json_encode($data_company);

// SELECT DISTINCT(company) as company, COUNT(id) AS users FROM sk_user GROUP BY company;

?>