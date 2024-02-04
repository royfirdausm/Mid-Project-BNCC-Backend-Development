<?php
session_start();

// KONEKSI
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("location: login.php");
}

// Ambil ID pengguna dari parameter URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $userId = $_GET['id'];

    // Query untuk mengambil data pengguna berdasarkan ID
    $query = "SELECT * FROM mahasiswa WHERE id = $userId";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        die("User not found");
    }
} else {
    die("Invalid user ID");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
    <!-- Tambahkan CSS sesuai kebutuhan Anda -->
    <style>
        /* Your CSS styles here */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #4caf50, #2196f3);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        img {
            width: 100%;
            max-width: 200px;
            height: auto;
            margin-bottom: 15px;
            border-radius: 8px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 15px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>View User</h2>
    <img src='<?php echo $row['photo']; ?>' alt='User Photo'>
    <p><strong>First Name:</strong> <?php echo $row['firstname']; ?></p>
    <p><strong>Full Name:</strong> <?php echo $row['firstname'] . " " . $row['lastname']; ?></p>
    <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
    <p><strong>Bio:</strong> <?php echo $row['bio']; ?></p>
    <a href="dashboard.php">
        <button>Back to Dashboard</button>
    </a>
</div>

</body>
</html>
