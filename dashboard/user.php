<?php
include '../inc/auth.php';
checkRole('user');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Booking Servis</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

  <style>
    body {
      background: #f5f5f5;
    }

    .container {
      max-width: 700px;
      margin-top: 50px;
      padding: 20px;
    }

    /* Custom Upload Button */
    .custom-file-wrapper {
      position: relative;
    }

    .custom-file-wrapper input[type="file"] {
      opacity: 0;
      width: 100%;
      height: 40px;
      position: absolute;
      left: 0;
      top: 0;
      cursor: pointer;
    }

    .custom-file-label {
      display: block;
      width: 100%;
      height: 40px;
      line-height: 40px;
      padding: 0 15px;
      background-color: #8f8b8bff;
      color: white;
      border-radius: 5px;
      font-weight: bold;
      text-align: center;
      pointer-events: none;
    }

    #map {
      height: 300px;
      margin-bottom: 15px;
      border-radius: 10px;
    }

    @media (max-width: 576px) {
      .container {
        padding: 15px;
      }

      h3 {
        font-size: 1.5rem;
      }

      #map {
        height: 250px;
      }
    }
  </style>
</head>
<body>

<a href="../logout.php" class="btn btn-secondary ms-3 mt-3">Logout</a>

<div class="container bg-white shadow p-4 rounded">
  <h3 class="mb-4 text-center">Form Booking Servis</h3>
  <form action="nota.php" method="POST" enctype="multipart/form-data"> 

    <div class="mb-3">
      <label class="form-label">Nama Pemilik</label>
      <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Jenis Kendaraan</label>
      <select type="text" name="jenis" class="form-control" required>
         <option value="">-- Pilih Jenis Kendaraan --</option>
        <option value="Mobil">Mobil</option>
        <option value="Motor">Motor</option>
        <option value="Bus">Bus</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Keluhan / Masalah Kendaraan</label>
      <textarea id="keluhan" name="keluhan" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Upload Foto atau Video</label>
      <div class="custom-file-wrapper">
        <span class="custom-file-label" id="customLabel">Upload</span>
        <input type="file" name="media" accept="image/*,video/*" onchange="updateLabel(this)">
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Metode Pembayaran</label>
      <select name="pembayaran" class="form-select" required>
        <option value="">-- Pilih Metode --</option>
        <option value="transfer">Transfer Bank</option>
        <option value="cod">COD</option>
        <option value="qris">QRIS</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Pilihan Servis</label>
      <select name="layanan" class="form-select" required>
        <option value="">-- Pilih Servis --</option>
        <option value="rumah">Servis di Rumah</option>
        <option value="bengkel">Datang ke Bengkel</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Alamat Servis (Lokasi Saat Ini)</label>
      <input id="alamat" name="alamat" class="form-control" placeholder="Alamat otomatis atau manual" required>
    </div>

    <div id="map"></div>

    <input type="hidden" name="lat" id="lat">
    <input type="hidden" name="lng" id="lng">

    <button type="submit" class="btn btn-success w-100">Konfirmasi & Cetak Nota</button>
  </form>
</div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
  function updateLabel(input) {
    const fileName = input.files.length > 0 ? input.files[0].name : "Upload Foto";
    document.getElementById('customLabel').textContent = fileName;
  }

  // Diagnosa Otomatis
  document.getElementById('keluhan').addEventListener('input', function () {
    const t = this.value.toLowerCase();
    let d = '';
    if (t.includes('starter') || t.includes('mati')) d = 'Kemungkinan: Starter/Aki bermasalah';
    else if (t.includes('rem') || t.includes('berdecit')) d = 'Kemungkinan: Kampas rem aus';
    else if (t.includes('panas') || t.includes('overheat')) d = 'Kemungkinan: Radiator rusak';
    else if (t.length > 10) d = 'Sedang menganalisis...';
    // Tambahkan hasil ke console/log (atau elemen jika mau)
    console.log(d);
  });

  // Map dan Lokasi
  const map = L.map('map').setView([-8.8368, 121.6623], 13);
  const marker = L.marker([-8.8368, 121.6623]).addTo(map);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap'
  }).addTo(map);

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
      const lat = position.coords.latitude;
      const lng = position.coords.longitude;
      map.setView([lat, lng], 15);
      marker.setLatLng([lat, lng]);
      document.getElementById('lat').value = lat;
      document.getElementById('lng').value = lng;

      fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
        .then(res => res.json())
        .then(data => {
          document.getElementById('alamat').value = data.display_name || '';
        });
    });
  }
</script>

</body>
</html>
