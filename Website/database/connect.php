<?php
$servername = "localhost";
$username = "root";
$password = "Password@123";
$dbname = "db";
$port = "80";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . $conn->connect_error);
}
?>