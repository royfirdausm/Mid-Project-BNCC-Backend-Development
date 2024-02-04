<?php
session_start();
include 'koneksi.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM user WHERE email='$username' AND password='$password'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $data = mysqli_fetch_assoc($query);

        // Verifikasi password
        if ($data) {
            // Password benar, pengguna berhasil login

            // Set sesi login
            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;

            // Remember Me logic
            if (isset($_POST['remember_me'])) {
                setcookie('remember_username', $username, time() + (10 * 365 * 24 * 60 * 60)); // Set cookie for 10 years
            } else {
                // Clear cookie if "Remember Me" not checked
                setcookie('remember_username', '', time() - 3600);
            }

            echo "Selamat datang";
            header("location: dashboard.php"); // redirect ke halaman dashboard
            exit();
        }
    }

    // Gagal login, redirect ke halaman login dengan pesan kesalahan
    header("location: login.php?error=1");
}
?>
