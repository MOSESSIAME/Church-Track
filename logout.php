<?php
session_start();

// logout.php
include('inc/config.php');
include('inc/classes/User.php');
include('inc/functions.php');

logout();

header("Location: login.php");
?>
