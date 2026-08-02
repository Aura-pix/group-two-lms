<?php
/**
 * Connection Test File
 * ---------------------
 * Every teammate should run this ONCE after cloning the repo and
 * importing the database, to confirm their local setup works.
 *
 * How to use:
 *   1. Place this file in the project root (same level as index.php)
 *   2. Open it in the browser: http://localhost/library-system/test_connection.php
 *   3. You should see "Connected successfully!" and a list of books
 *   4. DELETE this file once everyone has confirmed their setup works
 */

require_once 'config/db.php';

echo "<h2>Connected successfully!</h2>";

// Try pulling data to prove the tables + seed data are really there
$result = $conn->query("SELECT title FROM books");

if ($result && $result->num_rows > 0) {
    echo "<p>Books found in database:</p><ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row['title']) . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Connected, but no books found — check that the seed data was imported.</p>";
}

$conn->close();
?>