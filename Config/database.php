<?php
// $servername = "5.101.118.146";
// $username = "ulviya";
// $password = "iRw08wcy";
// $dbname = "ulviya_make";

$servername = "localhost";
$username = "root";
$password = "Ulviya2005!";
$dbname = "mydb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8mb4");

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// echo "Connected successfully";

?>