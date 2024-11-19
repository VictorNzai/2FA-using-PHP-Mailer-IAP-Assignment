<?php
// Database connection details
$server = "localhost";
$username = "root"; // Replace with your actual username if different
$password = "rehanais2cool"; // Your MySQL password
$database = "iap_assignment"; // The database you created

// Create connection
$con = mysqli_connect($server, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
