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

// Jika tombol "Edit" diklik
if (isset($_POST['edit'])) {
    // Ambil data dari formulir
    $editedFirstName = mysqli_real_escape_string($conn, $_POST['firstname']);
    $editedLastName = mysqli_real_escape_string($conn, $_POST['lastname']);
    $editedEmail = mysqli_real_escape_string($conn, $_POST['email']);
    $editedBio = mysqli_real_escape_string($conn, $_POST['bio']);

    // Validasi email unik, abaikan validasi untuk email yang sedang diedit
    $uniqueEmailQuery = "SELECT * FROM mahasiswa WHERE email = '$editedEmail' AND id != $userId";
    $uniqueEmailResult = mysqli_query($conn, $uniqueEmailQuery);

    if (mysqli_num_rows($uniqueEmailResult) > 0) {
        $error = "Email already exists. Please choose another email.";
    } else {
        // Update data pengguna
        $updateQuery = "UPDATE mahasiswa SET firstname = '$editedFirstName', lastname = '$editedLastName', email = '$editedEmail', bio = '$editedBio' WHERE id = $userId";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            // Jika berhasil diubah, redirect ke halaman dashboard dengan pesan sukses
            header("location: dashboard.php?edit_success=true");
        } else {
            // Jika gagal diubah, tampilkan pesan kesalahan
            die("Edit failed: " . mysqli_error($conn));
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Tambahkan CSS sesuai kebutuhan Anda -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <style>
        /* Your CSS styles here */
        body {
            font-family: 'Poppins', sans-serif;
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

        label {
            display: block;
            margin: 10px 0;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit User</h2>
    <?php
    // Tampilkan pesan kesalahan jika ada
    if (isset($error)) {
        echo "<p class='error-message'>$error</p>";
    }
    ?>
    <form method="post">
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" value="<?php echo $row['firstname']; ?>" required>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" value="<?php echo $row['lastname']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required>

        <label for="bio">Bio:</label>
        <textarea name="bio" rows="4"><?php echo $row['bio']; ?></textarea>

        <button type="submit" name="edit">Edit</button>
    </form>
    <br>
    <a href="dashboard.php">
        <button>Cancel</button>
    </a>
</div>

</body>
</html>
