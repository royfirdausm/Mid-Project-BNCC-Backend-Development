<?php
session_start(); // mulai session

// KONEKSI
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_system";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!isset($_SESSION['login'])) { // jika user belum login
    header("location: login.php"); // redirect ke halaman login
}
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$query = "SELECT * FROM mahasiswa WHERE firstname LIKE '%$search%' OR lastname LIKE '%$search%' OR email LIKE '%$search%'";
$result = mysqli_query($conn, $query);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <style>
        /* Your existing CSS styles here */
        body, h1, h2, ul, li {
            margin: 0;
            padding: 0;
        }

        .navbar {
            background: linear-gradient(to right, #4caf50, #2196f3);
            color: white;
            padding: 10px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-family: 'Poppins', sans-serif;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links {
            list-style-type: none;
            display: flex;
        }

        .nav-links li {
            margin-right: 20px;
        }

        .nav-links a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            transition: color 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .nav-links a:hover {
            color: #ffeb3b;
        }

        .dashboard-content {
            max-width: 800px;
            margin: 20px auto;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        .menu {
            margin-top: 20px;
        }

        .menu ul {
            list-style-type: none;
        }

        .menu li {
            display: inline-block;
            margin-right: 15px;
        }

        .menu a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            background: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease, transform 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .menu a:hover {
            background: #4caf50;
            color: white;
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .search-form {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .search-form input {
            margin-right: 10px;
            padding: 5px;
        }
        .footer {
            background: linear-gradient(to right, #4caf50, #2196f3);
            color: white;
            padding: 20px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .action-buttons {
        display: flex;
        gap: 5px;
    }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="container">
        <div class="logo">Dashboard</div>
        <ul class="nav-links">
            <li><a href="#">Dashboard</a></li>
            <li><a href="profile.php">Profile</a></li>
            
        </ul>
    </div>
</nav>

<div class="dashboard-content">
    
    <div class="menu">
        <!-- Example Table with Bootstrap Styles -->
        <div class="menu">
            <form action="" method="GET" class="search-form">
                <input type="text" name="search" placeholder="Search user...">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
            <table class="table table-responsive">
                <!-- ... -->
            </table>
        </div>

        <!-- Example Table with Bootstrap Styles -->
        <table class="table table-responsive">
        <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $counter . "</td>";
                    echo "<td><img src='" . $row['photo'] . "' alt='Photo' width='100' height='120'></td>";

                    // Menggabungkan first name dan last name
                    $fullName = $row['firstname'] . " " . $row['lastname'];

                    echo "<td>" . $fullName . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>
                    <div class='action-buttons'>
                        <a href='view_user.php?id=" . $row['id'] . "' class='btn btn-primary btn-action'>View</a>
                        <a href='edit_user.php?id=" . $row['id'] . "' class='btn btn-warning btn-action'>Edit</a>
                        <a href='delete_user.php?id=" . $row['id'] . "' class='btn btn-danger btn-action'>Delete</a>
                    </div>
                  </td>";
                    echo "</tr>";
                    $counter++;
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="add-user-container">
        <a href="add_user.php" class="btn btn-success">Add New User</a>
    </div>
</div>
<br>
<br>
<br>
<br>

<footer class="footer">
    <div class="container">
        <p>&copy; 2024 Mid Project BNCC Banckend Development</p>
    </div>
</footer>

<!-- Bootstrap JS (required for some Bootstrap features) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
