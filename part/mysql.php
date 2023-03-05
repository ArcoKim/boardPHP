<?php
$host = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');
$port = getenv('DB_PORT');
$conn = mysqli_connect($host, $username, $password, $dbname, $port);
return $conn;
?>