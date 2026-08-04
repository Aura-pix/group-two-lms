<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$dbname = getenv('DB_NAME');
$port = getenv('DB_PORT') ?: 3306;
$ca_cert = __DIR__ . '/ca.pem'; // adjust path to wherever you save it

$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, $ca_cert, NULL, NULL);

if (!mysqli_real_connect($conn, $host, $user, $pass, $dbname, $port, NULL, MYSQLI_CLIENT_SSL)) {
    die("Connection failed: " . mysqli_connect_error());
}

$conn->set_charset("utf8mb4");
?>