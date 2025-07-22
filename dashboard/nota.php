<?php
include '../inc/auth.php';
include '../inc/koneksi.php';
checkRole('user');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = $_SESSION['user']['id'];
  $nama = $_POST['nama'];
  $jenis = $_POST['jenis'];
  $keluhan = $_POST['keluhan'];
  $pembayaran = $_POST['pembayaran'];
  $layanan = $_POST['layanan'];
  $alamat = $_POST['alamat'];
  $lat = $_POST['lat'];
  $lng = $_POST['lng'];
  $uang_muka = 50000; // Misalnya, default uang muka

  // Upload file media
  $media_name = '';
  if (!empty($_FILES['media']['name'])) {
    $target_dir = "../uploads/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0755, true);
    $media_name = time() . '_' . basename($_FILES["media"]["name"]);
    $target_file = $target_dir . $media_name;
    move_uploaded_file($_FILES["media"]["tmp_name"], $target_file);
  }

  // Simpan ke DB tabel `transaksi`
  $stmt = $koneksi->prepare("INSERT INTO transaksi (user_id, nama_pemilik, jenis_kendaraan, keluhan, metode_pembayaran, layanan, alamat, media, total_uang_muka) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("isssssssd", $user_id, $nama, $jenis, $keluhan, $pembayaran, $layanan, $alamat, $media_name, $uang_muka);
  $stmt->execute();
  $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Nota Booking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .nota {
      max-width: 750px;
      margin: 50px auto;
      padding: 30px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    @media print {
      .btn { display: none; }
    }
  </style>
</head>
<body>
<div class="nota">
  <h3 class="text-center mb-4">🧾 Nota Booking Servis</h3>
  <table class="table">
    <tr><th>Nama</th><td><?= htmlspecialchars($nama) ?></td></tr>
    <tr><th>Jenis Kendaraan</th><td><?= htmlspecialchars($jenis) ?></td></tr>
    <tr><th>Keluhan</th><td><?= htmlspecialchars($keluhan) ?></td></tr>
    <tr><th>Metode Pembayaran</th><td><?= htmlspecialchars($pembayaran) ?></td></tr>
    <tr><th>Layanan</th><td><?= htmlspecialchars($layanan) ?></td></tr>
    <tr><th>Alamat</th><td><?= htmlspecialchars($alamat) ?></td></tr>
    <tr><th>Lokasi</th><td><?= $lat ?>, <?= $lng ?></td></tr>
    <tr><th>Uang Muka</th><td>Rp <?= number_format($uang_muka, 0, ',', '.') ?></td></tr>
    <?php if ($media_name): ?>
      <tr><th>Media</th><td><a href="../uploads/<?= $media_name ?>" target="_blank">📎 Lihat File</a></td></tr>
    <?php endif; ?>
  </table>

  <div class="text-center mt-4">
    <a href="user.php" class="btn btn-secondary">Kembali</a>
    <button onclick="window.print()" class="btn btn-primary">Cetak Nota</button>
  </div>
</div>
</body>
</html>
