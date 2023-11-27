
<!--Redirect if logged-in, maybe?-->

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign up</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

<div class="img-box">
    <img src="assets/css/img/web-design.png" alt="" width="256">
</div>

<div class="login-box">
    <h1>Sign Up</h1>

    <h2>Register blah bla blah!</h2>
   
    <form action="register.php" method="post">
        <div class="input-field">
            <input type="text" id="username" name="username" required>
            <label for="username">Username</label>
            <div class="underline"></div>
        </div>
        <br>
        <div class="input-field">
            <input type="password" name="password" id="password" required>
            <label for="password">Password </label>
            <div class="underline"></div>
        </div>
        <div class="input-field">
            <input type="password" name="confirm_password" id="confirm_password" required>
            <label for="confirm_password">Confirm Password </label>
            <div class="underline"></div>
        </div>
        <br>
        <div class="input-field">
            <input type="text" name="display_name" id="display_name" required>
            <label for="display_name">Display Name </label>
            <div class="underline"></div>
        </div>
        <br>
        <input class="submit" type="submit" value="Register Now">
        <p>Already have an account? <a href="https://example.com">Login</a>.</p>

    </form>
</div>
</body>
</html>

