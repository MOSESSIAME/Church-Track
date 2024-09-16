<?php
// start the session
session_start();

include('inc/header.php');
include('inc/config.php');
include('inc/classes/User.php');
include('inc/functions.php');
include('inc/navbar.php');

// Initialize the User class
$user = new User($pdo);

// Redirect if not logged in
if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

echo "<h2>Welcome to the Dashboard</h2>";
?>

<?php include('inc/footer.php'); ?>
