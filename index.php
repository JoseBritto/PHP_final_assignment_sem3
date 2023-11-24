<?php

$request = $_SERVER['REQUEST_URI'];


switch ($request) {
    case '/login':
        require __DIR__ . '/views/login.php';
        break;
}

// CAUTION: Any code/html below this line will be executed for every request made.
//echo "FOOTER";