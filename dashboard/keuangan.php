<?php
include '../inc/auth.php';
include '../inc/koneksi.php';
checkRole('keuangan');

// Ambil data transaksi
$query = $koneksi->query("SELECT t.*, u.name AS user_name FROM transaksi t JOIN users u ON t.user_id = u.id ORDER BY t.tanggal_transaksi DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Keuangan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .container {
      margin-top: 40px;
    }
    h3 {
      font-size: 1.8rem;
    }
    .print-btn {
      margin-bottom: 20px;
    }
    @media print {
      .print-btn, .back-btn {
        display: none;
      }
    }

    @media (max-width: 768px) {
      .container {
        padding: 15px;
      }
      h3 {
        font-size: 1.5rem;
        text-align: center;
      }
      .d-flex.justify-content-between {
        flex-direction: column;
        align-items: center;
        gap: 10px;
      }
      .table th, .table td {
        font-size: 0.85rem;
        white-space: nowrap;
      }
      .table thead {
        font-size: 0.9rem;
      }
      .table-responsive {
        overflow-x: auto;
      }
    }

    @media (max-width: 480px) {
      .table th, .table td {
        font-size: 0.75rem;
      }
    }
  </style>
</head>
<body>
<div class="container bg-white shadow p-4 rounded">
  <h3 class="mb-4 text-center">Laporan Transaksi Servis</h3>
  
  <div class="d-flex justify-content-between mb-3 flex-wrap">
    <a href="../logout.php" class="btn btn-secondary back-btn">Logout</a>
    <button onclick="window.print()" class="btn btn-primary print-btn">Cetak</button>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
      <thead class="table-dark text-center">
        <tr>
          <th>No</th>
          <th>User</th>
          <th>Pemilik</th>
          <th>Jenis</th>
          <th>Keluhan</th>
          <th>Pembayaran</th>
          <th>Layanan</th>
          <th>Alamat</th>
          <th>Media</th>
          <th>Uang Muka</th>
          <th>Tanggal</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $total_uang_muka = 0;
        while ($row = $query->fetch_assoc()):
          $total_uang_muka += $row['total_uang_muka'];
        ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['user_name']) ?></td>
          <td><?= htmlspecialchars($row['nama_pemilik']) ?></td>
          <td><?= htmlspecialchars($row['jenis_kendaraan']) ?></td>
          <td><?= htmlspecialchars($row['keluhan']) ?></td>
          <td><?= htmlspecialchars($row['metode_pembayaran']) ?></td>
          <td><?= htmlspecialchars($row['layanan']) ?></td>
          <td><?= htmlspecialchars($row['alamat']) ?></td>
          <td class="text-center">
            <?php if (!empty($row['media'])): ?>
              <a href="../uploads/<?= $row['media'] ?>" target="_blank">📎</a>
            <?php else: ?>
              <span class="text-muted">-</span>
            <?php endif; ?>
          </td>
          <td>Rp <?= number_format($row['total_uang_muka'], 0, ',', '.') ?></td>
          <td><?= date('d-m-Y H:i', strtotime($row['tanggal_transaksi'])) ?></td>
        </tr>
        <?php endwhile; ?>
        <tr class="fw-bold text-end">
          <td colspan="10">Total Uang Muka</td>
          <td colspan="2">Rp <?= number_format($total_uang_muka, 0, ',', '.') ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>
