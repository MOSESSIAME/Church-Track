<?php
session_start();
include('inc/config.php');
include('inc/classes/User.php');
include('inc/navbar.php');

// Initialize the User class
$user = new User($pdo);

// Handle form submission to add a new visitor
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $physical_address = $_POST['physical_address'];
    
    if ($user->addMember($name, $email, $phone, $physical_address)) {
        echo "Visitor added successfully!";
    } else {
        echo "Failed to add visitor.";
    }
}
?>

<h2>Add New visitor</h2>
<form method="post" action="">
    <label for="name">Name:</label>
    <input type="text" name="name" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email"><br>

    <label for="phone">Phone Number:</label>
    <input type="number" name="phone" required><br>

    <label for="physical_address">Physical Address:</label>
    <input type="text" name="physical_address" required><br>

    <input type="submit" value="Add visitor">
</form>
<?php include('inc/footer.php'); ?>