<?php
include '../../inc/auth.php';
include '../../inc/koneksi.php';
checkRole('keuangan');

$result = mysqli_query($koneksi, "SELECT * FROM transaksi");
?>
<h2>Laporan Transaksi</h2>
<table border="1">
  <tr>
    <th>ID</th><th>User ID</th><th>Jumlah</th><th>Keterangan</th><th>Tanggal</th>
  </tr>
  <?php while($row = mysqli_fetch_assoc($result)): ?>
  <tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['user_id'] ?></td>
    <td><?= $row['jumlah'] ?></td>
    <td><?= $row['keterangan'] ?></td>
    <td><?= $row['tanggal'] ?></td>
  </tr>
  <?php endwhile; ?>
</table>
