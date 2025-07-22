<?php
include '../../inc/auth.php';
include '../../inc/koneksi.php';
checkRole('admin');

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM users WHERE id=$id"));

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $status = $_POST['status'];

    mysqli_query($koneksi, "UPDATE users SET name='$name', email='$email', role='$role', status='$status' WHERE id=$id");
    echo "Data berhasil diupdate!";
}
?>
<form method="POST">
  <input name="name" value="<?= $data['name'] ?>"><br>
  <input name="email" value="<?= $data['email'] ?>"><br>
  <select name="role">
    <option <?= $data['role']=='admin'?'selected':'' ?>>admin</option>
    <option <?= $data['role']=='keuangan'?'selected':'' ?>>keuangan</option>
    <option <?= $data['role']=='user'?'selected':'' ?>>user</option>
  </select><br>
  <select name="status">
    <option <?= $data['status']=='active'?'selected':'' ?>>active</option>
    <option <?= $data['status']=='inactive'?'selected':'' ?>>inactive</option>
  </select><br>
  <button name="update">Update</button>
</form>
