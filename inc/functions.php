<?php
// functions.php

// Example function to check if a user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Check user role
function isAuthorised() {
    if ($_SESSION['role'] != 'admin') {
        header("Location: unauthorized.php");
        exit();
    }
}

// Log the user out
function logout() {
    session_destroy();
}

// Redirect function
function redirect($url) {
    header("Location: $url");
    exit();
}
?>
