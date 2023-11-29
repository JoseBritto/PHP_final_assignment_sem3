
<?php
require_once "controllers/login-controller.php";

$submitted_username = "";
$submitted_password = "";
$submitted_confirm_password = "";
$submitted_display_name = "";
$error_msg = "";

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['display_name'])){
    $submitted_username = $_POST['username'];
    $submitted_password = $_POST['password'];
    $submitted_confirm_password = $_POST['confirm_password'];
    $submitted_display_name = $_POST['display_name'];

    if($submitted_password != $submitted_confirm_password){
        $error_msg = "Passwords do not match";
    } else {
        $error_msg = getUsernameErrorMessage($submitted_username);
        if($error_msg == "")
            $error_msg = getPasswordErrorMessage($submitted_password);
        if($error_msg == "")
            $error_msg = getDisplayNameErrorMessage($submitted_display_name);
        $success = false;
        if($error_msg == "")
            $success = signup($submitted_username, $submitted_password, $submitted_display_name);
        if($success){
            login($submitted_username, $submitted_password, true);
            header("Location: home.php");
            exit;
        }
        else{
            $error_msg = "Sign up failed";
        }
    }
}
?>

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

    <h2>Welcome, Adventurer!</h2>
    <br>
    <form action="register.php" method="post">
        <div class="input-field">
            <input type="text" id="username" name="username" value="<?php echo $submitted_username ?>" required>
            <label for="username">Username</label>
            <div class="underline"></div>
        </div>
        <div class="input-field">
            <input type="password" name="password" id="password" value="<?php echo $submitted_password ?>" required>
            <label for="password">Password </label>
            <div class="underline"></div>
        </div>
        <div class="input-field">
            <input type="password" name="confirm_password" id="confirm_password" value="<?php echo $submitted_confirm_password ?>" required>
            <label for="confirm_password">Confirm Password </label>
            <div class="underline"></div>
        </div>
        <div class="input-field">
            <input type="text" name="display_name" id="display_name" value="<?php echo $submitted_display_name ?>" required>
            <label for="display_name">Display Name </label>
            <div class="underline"></div>
        </div>
        <br>
        <br>
        <input class="submit" type="submit" value="Register Now">
        <p>Already have an account? <a href="login.php">Login</a>.</p>
        <p class="error">
            <?php echo $error_msg ?>
        </p>
    </form>
</div>
</body>
</html>

