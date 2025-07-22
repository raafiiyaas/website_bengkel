<?php
session_start();
include 'inc/koneksi.php';

$error = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $sql = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND status='active'");
    $data = mysqli_fetch_assoc($sql);

    if ($data && password_verify($password, $data['password'])) {
        $_SESSION['user'] = $data;

        if ($data['role'] == 'admin') {
            header("Location: dashboard/admin.php");
        } elseif ($data['role'] == 'keuangan') {
            header("Location: dashboard/keuangan.php");
        } elseif ($data['role'] == 'user') {
            header("Location: dashboard/user.php");
        } else {
            $error = "Role tidak dikenali!";
        }
        exit;
    } else {
        $error = "Login gagal! Username, password, atau status tidak valid.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #e0eafc, #cfdef3);
      font-family: 'Segoe UI', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      width: 100%;
      max-width: 420px;
      padding: 30px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    @media (max-width: 576px) {
      .login-container {
        margin: 20px;
        padding: 20px;
      }
    }
  </style>
</head>
<body>
<div class="login-container">
  <h3 class="text-center mb-4">Login Bengkel</h3>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger text-center"><?= $error ?></div>
  <?php endif; ?>

  <form method="POST">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" name="username" class="form-control" required autofocus>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <button name="login" class="btn btn-primary w-100">Login</button>
    <a href="register.php" class="btn btn-outline-secondary w-100 mt-2">Belum punya akun? Daftar</a>
    <a href="tampilan.php" class="btn btn-outline-secondary w-100 mt-2">Kembali ke Halaman Awal</a>
  </form>
</div>
</body>
</html>
