
<!--Redirect if logged-in-->

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
<!--    <nav class="button">
    <button class="github-button">
        <img src="https://static-00.iconduck.com/assets.00/github-icon-2048x1988-jzvzcf2t.png" alt="Google Logo">
        Sign in with Github
    </button>
    <button class="google-button">
        <img src="https://cdn.freebiesupply.com/logos/large/2x/google-g-2015-logo-png-transparent.png" alt="Google Logo">
        Sign in with Google
    </button>
    </nav>
    
        
    <div class="separator">
        <hr>
        <p>or</p>
    </div>
    -->
    <form action="login.php" method="post">
        <div class="input-field">
            <input type="text" id="username" name="username" required>
            <label for="username">Username:</label>
            <div class="underline"></div>
        </div>
        <div class="input-field">
            <input type="password" name="Password" id="password" required>
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

