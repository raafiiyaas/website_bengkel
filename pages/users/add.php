<?php
include '../../inc/auth.php';
include '../../inc/koneksi.php';
checkRole('admin');

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    mysqli_query($koneksi, "INSERT INTO users (username, name, email, password, role) VALUES ('$username', '$name', '$email', '$password', '$role')");
    echo "User berhasil ditambahkan!";
}
?>
<form method="POST">
  <input name="username" placeholder="Username"><br>
  <input name="name" placeholder="Nama"><br>
  <input name="email" placeholder="Email"><br>
  <input name="password" type="password" placeholder="Password"><br>
  <select name="role">
    <option value="admin">admin</option>
    <option value="keuangan">keuangan</option>
    <option value="user" selected>user</option>
  </select><br>
  <button name="submit">Tambah</button>
</form>