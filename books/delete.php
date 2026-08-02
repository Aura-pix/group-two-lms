<?php
require_once '../config/db.php';

$book_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($book_id <= 0) {
    die("Invalid book ID.");
}

// Check if this book currently has any active (unreturned) issues
$check = $conn->prepare("SELECT COUNT(*) AS active_count FROM issued_books WHERE book_id = ? AND status = 'issued'");
$check->bind_param("i", $book_id);
$check->execute();
$active_count = $check->get_result()->fetch_assoc()['active_count'];
$check->close();

if ($active_count > 0) {
    // Don't allow deleting a book that's currently issued to someone
    include '../includes/header.php';
    echo '<div class="error"><p>This book cannot be deleted because it currently has ' . $active_count . ' copy(ies) issued to a member. It must be returned first.</p>';
    echo '<p><a href="view.php">Back to all books</a></p></div>';
    include '../includes/footer.php';
    $conn->close();
    exit;
}

// Safe to delete
$stmt = $conn->prepare("DELETE FROM books WHERE book_id = ?");
$stmt->bind_param("i", $book_id);
$stmt->execute();
$stmt->close();
$conn->close();

header("Location: view.php?deleted=1");
exit;
?>