<?php
session_start();

include_once '../Config/fb-api.php';

$permissions = ['email'];

// Generate the Facebook login URL with the state parameter
$_SESSION['state'] = bin2hex(random_bytes(16)); // Generate a unique state value
$loginUrl = $helper->getLoginUrl('http://localhost/Make/Controller/fb-callback.php', $permissions);

// Redirect the user to the Facebook login page
header('Location: ' . $loginUrl);
exit;
?>
