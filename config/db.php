<?php
/**
 * Database Connection File
 * -------------------------
 * Include this at the top of every page that needs the database:
 *   require_once 'config/db.php';        (from project root)
 *   require_once '../config/db.php';     (from a subfolder like books/)
 */

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$dbname = getenv('DB_NAME');
$conn = mysqli_connect($host, $user, $pass, $dbname);

// --- Check connection ---
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- Set charset (prevents encoding issues with special characters) ---
$conn->set_charset("utf8mb4");
?>