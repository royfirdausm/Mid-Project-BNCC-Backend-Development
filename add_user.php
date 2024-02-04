<?php
session_start();

// KONEKSI
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("location: login.php");
}

// Inisialisasi variabel dan pesan kesalahan
$firstName = $lastName = $email = $bio = $errorMsg = "";
$uploadOk = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data yang dikirimkan melalui form
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $email = $_POST["email"];
    $bio = $_POST["bio"];

    // Proses upload foto
    $targetDir = "image/";
    $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if email is unique
    $checkEmailQuery = "SELECT * FROM mahasiswa WHERE email='$email'";
    $checkEmailResult = mysqli_query($conn, $checkEmailQuery);

    if (mysqli_num_rows($checkEmailResult) > 0) {
        $errorMsg = "Email already exists. Please choose a different email.";
        $uploadOk = 0;  // Set uploadOk to 0 to prevent file upload
    }

    // ... (Pemeriksaan lainnya seperti pada contoh sebelumnya)

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $errorMsg .= "<br>Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
           
        } else {
            $errorMsg .= "<br>Sorry, there was an error uploading your file.";
        }
    }

    // Generate password and hash it using MD5
    $password = md5($firstName . "123");

    // Insert data into database if there are no errors
    if (empty($errorMsg)) {
        $sql = "INSERT INTO mahasiswa (photo, firstname, lastname, email, bio, password) 
                VALUES ('$targetFile', '$firstName', '$lastName', '$email', '$bio', '$password')";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['successMsg'] = "User added successfully!";
            header("location: dashboard.php");
            exit();
        } else {
            $errorMsg .= "<br>Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <!-- Tambahkan CSS sesuai kebutuhan Anda -->
    <style>
        /* Your CSS styles here */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
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

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
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

        .alert {
            background-color: #f2dede;
            color: #a94442;
            padding: 10px;
            border-radius: 4px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Add New User</h2>
    <!-- Tampilkan pesan kesalahan jika ada -->
    <?php
    if (!empty($errorMsg)) {
        echo "<div class='alert'>$errorMsg</div>";
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" value="<?php echo $firstName; ?>" required>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo $lastName; ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>

        <label for="bio">Bio:</label>
        <textarea name="bio" id="bio" rows="4" required><?php echo $bio; ?></textarea>

        <label for="photo">Photo:</label>
        <input type="file" name="photo" id="photo" accept="image/*" required>

        <button type="submit">Add User</button>
    </form>
</div>

</body>
</html>
