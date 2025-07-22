<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Drive Care Indonesia</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to bottom right, #f6f6f7ff, #ecf1f5ff);
      font-family: 'Segoe UI', sans-serif;
    }

    .navbar {
      background-color: #343a40;
    }

    .navbar-brand {
      font-weight: bold;
    }

    .navbar .btn {
      font-size: 0.9rem;
    }

    .hero {
      padding: 100px 20px;
      background-color: #eaeaecff;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .hero h1 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 20px;
    }

    .hero p {
      font-size: 1.1rem;
      color: #555;
    }

    .info-section {
      padding: 60px 0;
    }

    .info-section h4 {
      font-size: 1.2rem;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .info-section p {
      font-size: 0.95rem;
      color: #666;
    }

    .info-img {
      max-height: 300px;
      width: 100%;
      object-fit: cover;
    }

    footer {
      background-color: #212529;
      color: #fff;
      text-align: center;
      padding: 20px 0;
      margin-top: 50px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Drive Care Indonesia</a>
    <div class="d-flex">
      <a href="login.php" class="btn btn-outline-light me-2">Login</a>
      <a href="register.php" class="btn btn-light">Register</a>
    </div>
  </div>
</nav>

<!-- Hero -->
<div class="hero">
  <div class="container">
    <h1>Bengkel Drive Care Indonesia</h1>
    <p>Solusi Praktis dan Modern untuk Servis Mobil Anda Di Mana Saja, Kapan Saja</p>
  </div>
</div>

<!-- Info Baris Bergambar -->
<section class="py-5 bg-white">
  <div class="container">
    <!-- Baris 1: Teks kiri, gambar kanan -->
    <div class="row align-items-center mb-5">
      <div class="col-md-6">
        <h4 class="fw-bold">Bengkel Utama</h4>
        <p>Kantor Utama di Pinggir Jalan Raya Solo.</p>
      </div>
      <div class="col-md-6">
        <img src="assets/images/WhatsApp Image 2025-07-16 at 08.27.06_3302a18f.jpg" alt="Bengkel Utama" class="img-fluid rounded shadow info-img">
      </div>
    </div>

    <!-- Baris 2: Gambar kiri, teks kanan -->
    <div class="row align-items-center">
      <div class="col-md-6 order-md-2">
        <h4 class="fw-bold">Armada Bengkel Mobil Service</h4>
        <h6>2 Unit Dengan Area Fokus:</h6>
        <ul>
          <li>Solo Bagian Timur: Solo, Solobaru, Sukoharjo, Karanganyar</li>
          <li>Solo Bagian Barat: Solo, Kartasura, Colomadu, Boyolali, Klaten</li>
        </ul>
      </div>
      <div class="col-md-6 order-md-1">
        <img src="assets/images/WhatsApp_Image_2025-07-16_at_08.26.47_7477b5bb-removebg-preview.png" alt="Armada" class="img-fluid rounded shadow info-img">
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer>
  &copy; <?= date('Y') ?> Bengkel Online. Drive Care Indonesia.
</footer>

</body>
</html>
