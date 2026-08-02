<?php
require_once 'config/db.php';
include 'includes/header.php';

// Quick stats for the home page
$total_books   = $conn->query("SELECT COUNT(*) AS c FROM books")->fetch_assoc()['c'];
$total_authors = $conn->query("SELECT COUNT(*) AS c FROM authors")->fetch_assoc()['c'];
$total_members = $conn->query("SELECT COUNT(*) AS c FROM members")->fetch_assoc()['c'];
$total_issued  = $conn->query("SELECT COUNT(*) AS c FROM issued_books WHERE status = 'issued'")->fetch_assoc()['c'];
?>

<section class="hero">
    <h1>Welcome to the Library Management System</h1>
    <p>Manage books, authors, members, and track issued records — all in one place.</p>
</section>

<section class="stats-grid">
    <div class="stat-card">
        <h2><?php echo $total_books; ?></h2>
        <p>Total Books</p>
    </div>
    <div class="stat-card">
        <h2><?php echo $total_authors; ?></h2>
        <p>Total Authors</p>
    </div>
    <div class="stat-card">
        <h2><?php echo $total_members; ?></h2>
        <p>Total Members</p>
    </div>
    <div class="stat-card">
        <h2><?php echo $total_issued; ?></h2>
        <p>Books Currently Issued</p>
    </div>
</section>

<section class="quick-links">
    <h2>Quick Actions</h2>
    <div class="quick-links-grid">
        <a href="books/add.php" class="quick-link">➕ Add New Book</a>
        <a href="books/view.php" class="quick-link">📖 View All Books</a>
        <a href="issue_return/issue.php" class="quick-link">📤 Issue a Book</a>
        <a href="issue_return/return.php" class="quick-link">📥 Return a Book</a>
        <a href="search.php" class="quick-link">🔍 Search Books</a>
    </div>
</section>

<?php
include 'includes/footer.php';
$conn->close();
?>