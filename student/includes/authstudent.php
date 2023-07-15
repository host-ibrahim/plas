<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['student123'])) {
    header("Location: login.php");
    exit();
}
?>