<?php
$servername = "127.0.0.1"; // use TCP instead of unix socket to avoid socket path mismatch
$username = "root";
$password = "";
$dbname = "ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else {
    // echo "Connected successfully";
}
?>