<?php
session_start();

function checkRole($role) {
    // Redirect jika belum login
    if (!isset($_SESSION['user'])) {
        header("Location: ../tampilan.php"); // arahkan ke halaman login
        exit;
    }

    // Redirect jika role tidak sesuai
    if ($_SESSION['user']['role'] !== $role) {
        header("Location: ../logout.php"); // logout paksa jika mencoba akses dashboard orang lain
        exit;
    }
}
