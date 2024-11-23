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

if ($_SESSION['role'] == 'team_member') {
    echo '<h2>Welcome to the Team Member Dashboard</h2>';
} else if ($_SESSION['role'] == 'team_leader') {
    echo '<h2>Welcome to the Team Leader Dashboard</h2>';
} else {
    echo '<h2>Welcome to the Admin Dashboard</h2>';
}

?>

<?php include('inc/footer.php'); ?>
