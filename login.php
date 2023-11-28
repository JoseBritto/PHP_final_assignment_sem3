
<!--Redirect if logged-in-->

<?php
session_start();

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
    exit;
}

// Try to get the username and password from the request
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    password_verify($password, $hash);
    //TODO: Check if the username and password are correct/not empty
    
    // If they are correct, set the session variable and redirect to index.php
    $_SESSION['username'] = $username;
    header("Location: home.php");
    exit;
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
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember me</label><br>
    
        </div>
        <br>
        <input class="submit" type="submit" value="Login">
        <p>Don't have account? <a href="register.php">Register</a>.</p>
        
    </form>
</div>
</body>
</html>

