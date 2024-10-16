<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="../styles/login.css">
</head>
<body>
    <div class="login-container">
        <h1>Log In</h1>
        <form action="../php/login.php" method="POST"> <!-- Post form data to login.php -->
            <input type="text" name="email" placeholder="email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Log in</button>
        </form>
        <p>Don’t have an account yet? <a href="signup.php">Sign up here</a></p>
    </div>
</body>
</html>
