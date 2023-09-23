<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

// Logout user if logout button is clicked
if (isset($_POST['logout'])) {
    session_destroy();
    $_SESSION['loggedin'] = false;
    unset($_SESSION['user_id']);
    $_COOKIE['login'] = false;
    header('Location: login.php');
    exit;
}

// require_once __DIR__ . '/../View/dashboard.php';
?>


