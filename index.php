<?php
session_start();

// Cek apakah user sudah login
if (empty($_SESSION['user'])) {
    // Jika belum login, tampilkan form login
    include 'login.php';
} else {
    // Jika sudah login, tampilkan halaman admin
    include 'admin.php';
}
?>
