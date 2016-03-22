 <?php

	$dbhost = 'localhost';
	$dbname = 'skoda';
	$dbuser = 'root';
	$dbpassword = '';

	$mysqli = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
	
	if ($mysqli->connect_errno) {
	    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
	    exit();
	}

?>