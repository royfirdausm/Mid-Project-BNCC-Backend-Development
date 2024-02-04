<?php
session_start();

// KONEKSI
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("location: login.php");
}

$username = $_SESSION['username'];
$query = "SELECT * FROM user WHERE email = '$username'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #4caf50, #2196f3);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #333;
        }

        .profile-info {
            text-align: left;
            margin-top: 20px;
        }

        .profile-info p {
            margin-bottom: 15px;
        }

        .btn-container {
            margin-top: 20px;
        }

        .btn-container a {
            text-decoration: none;
            color: #fff;
        }

        .btn-logout {
            background-color: #d9534f;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-logout:hover {
            background-color: #c9302c;
        }

        .btn-back {
            background-color: #5bc0de;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }

        .btn-back:hover {
            background-color: #46b8da;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Admin Profile</h2>
    <div class="profile-info">
        <p><strong>First Name:</strong> <?php echo $row['firstname']; ?></p>
        <p><strong>Last Name:</strong> <?php echo $row['lastname']; ?></p>
        <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
        <p><strong>Bio:</strong> <?php echo $row['bio']; ?></p>
    </div>

    <div class="btn-container">
        <a href="logout.php" class="btn btn-logout">Logout</a>
        <a href="dashboard.php" class="btn btn-back">Back to Dashboard</a>
    </div>
</div>

<!-- Bootstrap JS (required for some Bootstrap features) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
