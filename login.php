<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login Page</title>
</head>
<body>

<div class="login-container">
    <form action="process_login.php" method="post">
        <h2>Login</h2>
        <?php
        // Validasi jika ada kesalahan login
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo '<p class="error-message">Username atau password salah!</p>';
        }
        ?>
        <div class="input-group">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo isset($_COOKIE['remember_username']) ? $_COOKIE['remember_username'] : ''; ?>" required>
        </div>
        <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="input-group">
            <input type="checkbox" name="remember_me" id="remember_me" <?php echo isset($_COOKIE['remember_username']) ? 'checked' : ''; ?>>
            <label for="remember_me">Remember Me</label>
        </div>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
