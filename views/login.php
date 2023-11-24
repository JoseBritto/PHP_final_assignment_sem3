
<!--Redirect if logged in-->

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/views/css/login.css">
</head>
<body>

<h1>Login</h1>

<h2>Welcome Back!</h2>

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
    
    <div class="remember-me">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember me</label>
    </div>
    <input type="submit" value="Login">
</form>

</body>
</html>

