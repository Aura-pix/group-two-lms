<?php
$host = getenv('DB_HOST') ?: '127.0.0.1';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$dbname = getenv('DB_NAME') ?: 'library_db';
$port = getenv('DB_PORT') ?: 3306;
$ca_cert = __DIR__ . '/ca.pem';

$conn = mysqli_init();

$use_ssl = filter_var(getenv('DB_USE_SSL') ?: 'false', FILTER_VALIDATE_BOOLEAN);
if ($use_ssl && file_exists($ca_cert)) {
    mysqli_ssl_set($conn, NULL, NULL, $ca_cert, NULL, NULL);
    $ssl_flag = MYSQLI_CLIENT_SSL;
} else {
    $ssl_flag = 0;
}

if (!mysqli_real_connect($conn, $host, $user, $pass, $dbname, $port, NULL, $ssl_flag)) {
    die("Connection failed: " . mysqli_connect_error());
}

$conn->set_charset("utf8mb4");
?>