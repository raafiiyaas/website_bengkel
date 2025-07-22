<?php
session_start();
if (isset($_SESSION['user'])) {
    $role = $_SESSION['user']['role'];
    header("Location: dashboard/{$role}.php"); // Redirect ke dashboard sesuai role
    exit;
}
header("Location: tampilan.php"); // Jika belum login, arahkan ke halaman perkenalan
?>