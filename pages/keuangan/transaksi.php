<?php
include '../../inc/auth.php';
include '../../inc/koneksi.php';
checkRole('keuangan');

if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $jumlah = $_POST['jumlah'];
    $keterangan = $_POST['keterangan'];
    $tanggal = $_POST['tanggal'];

    mysqli_query($koneksi, "INSERT INTO transaksi (user_id, jumlah, keterangan, tanggal) VALUES ('$user_id', '$jumlah', '$keterangan', '$tanggal')");
    echo "Transaksi berhasil ditambahkan!";
}
?>
<form method="POST">
  <input name="user_id" placeholder="User ID"><br>
  <input name="jumlah" type="number" step="0.01" placeholder="Jumlah"><br>
  <input name="keterangan" placeholder="Keterangan"><br>
  <input name="tanggal" type="date"><br>
  <button name="submit">Simpan Transaksi</button>
</form>
