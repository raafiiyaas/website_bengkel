<?php
include '../../inc/auth.php';
include '../../inc/koneksi.php';
checkRole('admin');

$result = mysqli_query($koneksi, "SELECT * FROM users");
?>
<h2>Daftar Pengguna</h2>
<table border="1">
  <tr>
    <th>ID</th><th>Username</th><th>Nama</th><th>Email</th><th>Role</th><th>Status</th>
  </tr>
  <?php while($row = mysqli_fetch_assoc($result)): ?>
  <tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['username'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['role'] ?></td>
    <td><?= $row['status'] ?></td>
  </tr>
  <?php endwhile; ?>
</table>
