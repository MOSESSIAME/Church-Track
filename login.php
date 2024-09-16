<?php
// start the session
session_start();

include('inc/header.php');
include('inc/config.php');
include('inc/classes/User.php');
include('inc/functions.php');
include('inc/loginstyle.php');

// chech if user is logged in
if (isLoggedIn()) {
    header('Location: dashboard.php');
}

// Initialize the User class
$user = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Authenticate user
    if ($user->login($email, $password)) {
        echo "Login successful!";
        header("Location: dashboard.php");
    } else {
        echo "Invalid login credentials.";
    }
}
?>

<h2 class="section-title">Login</h2>
<form class="login-form" method="post" action="">
    <div class="form-group">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-input" name="email" required>
    </div>
    <div class="form-group">
        <label for="password" class="form-label">Password:</label>
        <input type="password" class="form-input" name="password" required>
    </div>
    <input type="submit" class="submit-btn" value="Login">
</form>



<?php include('inc/footer.php'); ?>
