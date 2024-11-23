<?php
session_start();
// register.php
include('inc/header.php');
include('inc/config.php');
include('inc/classes/User.php');
include('inc/navbar.php');

// Initialize the User class
$user = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Register user
    if ($user->create($name, $email, $password, $role)) {
        echo "User registered successfully!";
    } else {
        echo "Failed to register user.";
    }
}
?>
<div class="register_form">
    <h2 class="section-title">Register a new user</h2>
    <form class="register-form" method="post" action="">
        <div class="form-group">
            <label for="name" class="form-label">Name:</label>
            <input type="text" name="name" class="form-input" required>
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" class="form-input" required>
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" class="form-input" required>
        </div>

        <div class="form-group">
            <label for="role" class="form-label">Role:</label>
            <select name="role" class="form-select">
                <option value="admin">Admin</option>
                <option value="team_leader">Team Leader</option>
                <option value="team_member">Team Member</option>
            </select>
        </div>

        <input type="submit" class="submit-btn" value="Register">
    </form>
</div>


<?php include('inc/footer.php'); ?>
