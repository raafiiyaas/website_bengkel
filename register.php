<?php
include 'inc/koneksi.php';

if (isset($_POST['register'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = htmlspecialchars($_POST['email']);
    $name = htmlspecialchars($_POST['name']);

    $role = 'user';
    $status = 'active';

    $query = "INSERT INTO users (username, password, email, name, role, status) 
              VALUES ('$username', '$password', '$email', '$name', '$role', '$status')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: login.php");
        exit;
    } else {
        $error = "Registrasi gagal: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi Akun</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #dbe9f4, #f5f8fa);
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    .container {
      width: 100%;
      max-width: 480px;
      padding: 30px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 576px) {
      .container {
        margin: 20px;
        padding: 20px;
      }
    }
  </style>
</head>
<body>
<div class="container">
  <h3 class="text-center mb-4">Registrasi Akun</h3>

  <?php if (isset($error)): ?>
    <div class="alert alert-danger text-center"><?= $error ?></div>
  <?php endif; ?>

  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Username</label>
      <input type="text" name="username" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Nama Lengkap</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <button name="register" class="btn btn-success w-100">Daftar</button>
    <a href="login.php" class="btn btn-outline-secondary w-100 mt-2">Sudah punya akun? Login</a>
     <a href="tampilan.php" class="btn btn-outline-secondary w-100 mt-2">Kembali ke Halaman Awal</a>
  </form>
</div>
</body>
</html>
