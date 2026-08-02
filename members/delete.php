<?php
require_once '../config/db.php';

$member_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($member_id <= 0) {
    die("Invalid member ID.");
}

// Check if this member currently has any active (unreturned) issues
$check = $conn->prepare("SELECT COUNT(*) AS active_count FROM issued_books WHERE member_id = ? AND status = 'issued'");
$check->bind_param("i", $member_id);
$check->execute();
$active_count = $check->get_result()->fetch_assoc()['active_count'];
$check->close();

if ($active_count > 0) {
    // Don't allow deleting a member who still has books out
    include '../includes/header.php';
    echo '<div class="error"><p>This member cannot be deleted because they currently have ' . $active_count . ' book(s) issued. Those must be returned first.</p>';
    echo '<p><a href="view.php">Back to all members</a></p></div>';
    include '../includes/footer.php';
    $conn->close();
    exit;
}

// Safe to delete
$stmt = $conn->prepare("DELETE FROM members WHERE member_id = ?");
$stmt->bind_param("i", $member_id);
$stmt->execute();
$stmt->close();
$conn->close();

header("Location: view.php?deleted=1");
exit;
?>