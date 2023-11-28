<?php
echo "Welcome! <br/>";


$servername = "localhost";
$database = "test";
$username = "root";
$password = "2222";
// Create connection using musqli_connect function
$conn = mysqli_connect($servername, $username, $password, $database);
// Connection Check
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected Successfully!";
    $conn->close();
}

