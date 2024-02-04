<?php
session_start(); // mulai session
session_destroy(); // hapus session
header("location: login.php"); // redirect ke halaman login
?>