<?php
include '../inc/auth.php';
include '../inc/koneksi.php';
include '../inc/functions.php';

checkRole('admin');

if (!function_exists('countUsers')) {
  function countUsers() {
    global $koneksi;
    $q = $koneksi->query("SELECT COUNT(*) AS total FROM users WHERE status='active'");
    return $q->fetch_assoc()['total'];
  }
}

if (!function_exists('countTodayTransactions')) {
  function countTodayTransactions() {
    global $koneksi;
    $today = date('Y-m-d');
    $q = $koneksi->query("SELECT COUNT(*) AS total FROM transaksi WHERE DATE(tanggal_transaksi) = '$today'");
    return $q->fetch_assoc()['total'];
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f0f2f5;
      font-family: 'Segoe UI', sans-serif;
    }

    .dashboard-container {
      max-width: 1000px;
      margin: 50px auto;
      padding: 30px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    .stat-box {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 30px;
    }

    .stat-card {
      flex: 1 1 45%;
      padding: 20px;
      background-color: #f8f9fa;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 0 5px rgba(0,0,0,0.05);
    }

    .logout-btn {
      position: absolute;
      top: 20px;
      right: 30px;
    }

    .chart-container {
      position: relative;
      width: 100%;
      height: auto;
      padding-bottom: 56.25%; /* 16:9 aspect ratio */
    }

    .chart-container canvas {
      position: absolute;
      top: 0;
      left: 0;
      width: 100% !important;
      height: 100% !important;
    }

    @media (max-width: 576px) {
      .stat-card {
        flex: 1 1 100%;
      }
      .logout-btn {
        position: static;
        display: block;
        text-align: right;
        margin-bottom: 10px;
      }
      .dashboard-container {
        padding: 20px;
        margin: 20px auto;
      }
    }
  </style>
</head>
<body>
  <div class="container position-relative">
    <div class="logout-btn">
      <a href="../logout.php" class="btn btn-danger">Logout</a>
    </div>

    <div class="dashboard-container">
      <h2 class="text-center mb-4">Dashboard Admin</h2>
      <p class="text-center">Selamat datang, <strong><?= htmlspecialchars($_SESSION['user']['name']); ?></strong>!</p>

      <div class="stat-box">
        <div class="stat-card">
          <h5>Total User Aktif</h5>
          <h3><?= countUsers(); ?></h3>
        </div>
        <div class="stat-card">
          <h5>Transaksi Hari Ini</h5>
          <h3><?= countTodayTransactions(); ?></h3>
        </div>
      </div>

      <h5 class="mb-3">Grafik Transaksi</h5>
      <div class="chart-container">
        <canvas id="grafikTransaksi"></canvas>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('grafikTransaksi').getContext('2d');
    const chart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        datasets: [{
          label: 'Transaksi',
          data: [12, 19, 3, 5, 2, 3, 7],
          borderColor: 'rgba(75, 192, 192, 1)',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          tension: 0.4,
          fill: true
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { position: 'top' }
        },
        scales: {
          y: { beginAtZero: true }
        }
      }
    });
  </script>
</body>
</html>
