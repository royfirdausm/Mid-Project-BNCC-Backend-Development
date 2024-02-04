<?php
include 'koneksi.php'; // Sesuaikan dengan nama file koneksi Anda

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = md5($_POST["password"]); // Melakukan hash MD5 pada password
    $bio = $_POST["bio"];

    
    // Simpan data ke dalam tabel admin
    $insertQuery = "INSERT INTO user (id, firstname, lastname, email, password, bio) VALUES ('$id','$firstname', '$lastname', '$email', '$password', '$bio')";
    $result = mysqli_query($conn, $insertQuery);

    if ($result) {
        // Jika penyimpanan berhasil, redirect ke halaman dashboard dengan pesan berhasil
        header("Location: dashboard.php?success=create_admin");
        exit();
    } else {
        // Jika terjadi kesalahan, redirect kembali ke halaman create admin dengan pesan kesalahan
        header("Location: create_admin.php?error=unknown");
        exit();
    }
} else {
    // Jika bukan metode POST, redirect ke halaman create admin
    header("Location: create_admin.php");
    exit();
}
?>
