<?php
/**
 * Shared Header + Navigation Menu
 * ---------------------------------
 * Include this at the top of every page, AFTER the db.php require
 * and AFTER any PHP logic (like fetching data), but BEFORE your HTML content.
 *
 * From project root:      include 'includes/header.php';
 * From a subfolder:       include '../includes/header.php';
 *
 * NOTE: Because pages are nested at different depths (root vs
 * books/, authors/, etc.), all links below use BASE_URL so they
 * work correctly no matter which folder the current page is in.
 */

// Adjust this if your project folder name is different
if (!defined('BASE_URL')) {
    define('BASE_URL', 'https://group-two-lms.onrender.com/');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
</head>
<body>

<header class="site-header">
    <div class="logo">📚 Library Management System</div>
    <nav class="site-nav">
        <ul>
            <li><a href="<?php echo BASE_URL; ?>index.php">Home</a></li>
            <li><a href="<?php echo BASE_URL; ?>books/view.php">Books</a></li>
            <li><a href="<?php echo BASE_URL; ?>authors/view.php">Authors</a></li>
            <li><a href="<?php echo BASE_URL; ?>members/view.php">Members</a></li>
            <li><a href="<?php echo BASE_URL; ?>issue_return/issue.php">Issue Book</a></li>
            <li><a href="<?php echo BASE_URL; ?>issue_return/return.php">Return Book</a></li>
            <li><a href="<?php echo BASE_URL; ?>issue_return/status.php">Issued/Overdue</a></li>
            <li><a href="<?php echo BASE_URL; ?>search.php">Search</a></li>
        </ul>
    </nav>
</header>

<main class="site-content">