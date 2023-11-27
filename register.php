<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/register.css">
  <title>User Registration</title>
</head>
<body>
  <div class="container">
    <form action="register.php" method="post" class="items">
      <h2>User Registration</h2>

      <label for="fname">First Name:</label>
      <input type="text" id="fname" name="fname" required>

      <label for="lname">Last Name:</label>
      <input type="text" id="lname" name="lname" required>

      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <label for="confirmPassword">Confirm Password:</label>
      <input type="password" id="confirmPassword" name="confirmPassword" required>

      <button type="submit">Register</button>
    </form>
  </div>
</body>
</html>
