<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin</title>
    <link rel="stylesheet" href="style.css"> <!-- Sesuaikan dengan file CSS Anda -->
</head>
<body>

<div class="create-admin-container">
    <form action="process_create_admin.php" method="post">
        <h2>Create Admin</h2>
        
        <div class="input-group">
            <label for="id">id:</label>
            <input type="text" name="id" id="id" required>
        </div>
        <div class="input-group">
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" id="firstname" required>
        </div>
        
        <div class="input-group">
            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" id="lastname" required>
        </div>
        
        <div class="input-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>
        
        <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        
        <div class="input-group">
            <label for="bio">Bio:</label>
            <textarea name="bio" id="bio" rows="4" required></textarea>
        </div>
        
        <button type="submit">Create Admin</button>
    </form>
</div>

</body>
</html>
