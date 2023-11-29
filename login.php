
<!--Redirect if logged-in-->

<?php
session_start();
require_once "controllers/login-controller.php";
/*
 * 
 * if(is logged in)
 * redirect to home.php
 * 
 * if(username and password are not empty)
 * login(username, password)
 * 
 * continue to login.php
 */
// Redirect if logged-in
if (isset($_SESSION['username'])) {
    header("Location: home.php");
/*    echo $_SESSION['display_name'];*/
    exit;
}

// Try to get the username and password from the request
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $loggedIn = login($username, $password, isset($_POST['remember']));
    if($loggedIn){
/*        echo "Logged in successfully as ". $_SESSION['display_name'];*/
        header("Location: home.php");
        exit;
    }
/*    echo "Failed to log in";*/
    $login_failed = true;
}

// If the username and password are not empty, try to log in
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/login.css">
    
</head>
<body>

<div class="img-box">
    <img src="assets/css/img/web-design.png" alt="" width="256"> 
</div>

<div class="login-box">
    <h1>Log In</h1>
    
    <h2>Welcome back, Adventurer!</h2>
    <form action="login.php" method="post">
        <div class="input-field">
            <input type="text" id="username" name="username" required>
            <label for="username">Username:</label>
            <div class="underline"></div>
        </div>
        <div class="input-field">
            <input type="password" name="password" id="password" required>
            <label for="password">Password: </label>
            <div class="underline"></div>
        </div>
        <p class="forgot"><a href="https://example.com">Forgot Password?</a></p>
        
        <div class="remember-me">
            <input type="checkbox" name="remember" id="remember" checked>
            <label for="remember">Remember me</label><br>
    
        </div>
        <br>
        <input class="submit" type="submit" value="Login">
        <p class="error">
            <?php
            if(isset($login_failed) && $login_failed)
                echo "Invalid username/password.  Please try again" 
            ?>
        </p>
        <p>Don't have account? <a href="register.php">Register</a>.</p>
    </form>
</div>
</body>
</html>

