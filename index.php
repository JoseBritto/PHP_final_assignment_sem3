<?php

require "utils/config.php";

echo "Welcome! <br/>";



// Create connection using mysqli_connect function
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Connection Check
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected Successfully!";
    $conn->close();
}

