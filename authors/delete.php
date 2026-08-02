<?php
require_once '../config/db.php';

$author_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($author_id <= 0) {
    die("Invalid author ID.");
}

// Books table has ON DELETE SET NULL for author_id, so deleting an
// author is always safe — their books just become "authorless"
// rather than being deleted or blocking the operation.
$stmt = $conn->prepare("DELETE FROM authors WHERE author_id = ?");
$stmt->bind_param("i", $author_id);
$stmt->execute();
$stmt->close();
$conn->close();

header("Location: view.php?deleted=1");
exit;
?>