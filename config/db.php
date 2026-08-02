<?php
/**
 * Database Connection File
 * -------------------------
 * Include this at the top of every page that needs the database:
 *   require_once 'config/db.php';        (from project root)
 *   require_once '../config/db.php';     (from a subfolder like books/)
 */

// --- Connection settings ---
$db_host = "localhost";
$db_user = "root";      // default XAMPP/WAMP username
$db_pass = "";          // default XAMPP/WAMP password is blank
$db_name = "library_db";

// --- Create connection ---
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// --- Check connection ---
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- Set charset (prevents encoding issues with special characters) ---
$conn->set_charset("utf8mb4");
?>