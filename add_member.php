<?php
session_start();
include('inc/config.php');
include('inc/classes/User.php');

// Initialize the User class
$user = new User($pdo);

// Handle form submission to add a new member
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $physical_address = $_POST['physical_address'];
    
    if ($user->addMember($name, $email, $physical_address)) {
        echo "Member added successfully!";
    } else {
        echo "Failed to add member.";
    }
}
?>

<h2>Add New Member</h2>
<form method="post" action="">
    <label for="name">Name:</label>
    <input type="text" name="name" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="physical_address">Physical Address:</label>
    <input type="text" name="physical_address" required><br>

    <input type="submit" value="Add Member">
</form>
