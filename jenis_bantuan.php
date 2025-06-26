<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <title>Jenis Bantuan - First Step Siswa</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      background-color: #f0f4f8;
    }
    
    .main-section {
      padding: 60px 20px;
    }

    .container {
      max-width: 1100px;
      margin: 0 auto;
    }

    .title {
    font-family: 'Inter', sans-serif;
    text-align: center;
    font-weight: 600;
    font-size: 30px;
    margin-bottom: 50px;
    color: #007BFF; /* Bootstrap blue or use any hex: #1d4ed8 for deep blue */
    }

    .aid-row {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      margin-bottom: 30px;
      padding: 20px;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
    }
    .aid-image {
      flex: 1 1 40%;
      min-width: 280px;
      max-width: 400px;
    }
    .carousel-inner .item img {
      width: 100%;
      height: 250px;
      object-fit: cover;
      border-radius: 8px;
      transition: transform 0.4s ease;
      cursor: pointer;
    }
    .carousel-inner .item img:hover {
      transform: scale(1.05);
    }
    .aid-text {
      flex: 1 1 55%;
      padding-left: 30px;
    }
    .aid-title {
      font-weight: bold;
      font-size: 20px;
      color: #222;
      margin-bottom: 10px;
    }
    .aid-desc {
      font-size: 14px;
      color: #555;
    }

    .aid-card {
    position: relative;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    display: flex;
    flex-direction: row;
    align-items: center;
    margin-bottom: 40px;
    transition: transform 0.3s;
    }

    .aid-card:hover {
    transform: translateY(-5px);
    }

    .aid-card img {
    width: 240px;
    height: auto;
    object-fit: cover;
    border-right: 1px solid #eee;
    }

    .aid-card-content {
    padding: 20px;
    flex: 1;
    }

    .aid-card-content h4 {
    margin-top: 0;
    color: #333;
    font-size: 20px;
    font-weight: bold;
    }

    .aid-card-content p {
    color: #555;
    font-size: 16px;
    }
    
    .aid-card img {
    width: 240px;
    height: 180px; /* fixed height */
    object-fit: cover; /* ensures image fills area without distortion */
    border-right: 1px solid #eee;
    border-top-left-radius: 18px;
    border-bottom-left-radius: 18px;
    }

    .slider-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    }

   .carousel-inner .item img {
    width: 300px;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
    transition: transform 0.4s ease;
    cursor: pointer;
    display: block;
    margin: 0 auto;
    }


    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      background-image: url('background.jpg');
      background-size: cover;
      background-position: center;
      z-index: -2;
      opacity: 1;
    }
    body::after {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      background-color: rgba(255, 255, 255, 0.5);
      z-index: -1;
    }
    .highlight-box {
        background: white;
        border-left: 8px solid #4f8df7; /* Soft blue border */
        border-radius: 12px;
        padding: 20px 25px;
        margin-bottom: 40px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        }

        .highlight-title {
        margin: 0;
        font-size: 30px;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px; /* space between title and text */
        }
        .highlight-box p {
        margin-bottom: 20px;
        font-size: 16px;
        }
        .aid-wrapper {
        background: #ffffff;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }



  </style>
</head>
<body>

<?php include('nav_bar.php'); ?>

<section class="main-section">
  <div class="container">
      <div class="aid-wrapper">
<div class="highlight-box">
  <h1 class="highlight-title">Jenis Bantuan</h1>
  <p><em> Berikut adalah jenis bantuan yang disediakan untuk pelajar: </em></p>
</div>

    <!-- Peralatan Digital -->
    <div class="aid-row">
      <div class="aid-image">
        <div id="carousel-digital" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="item active">
              <a href="laptop1.jpg" data-lightbox="digital">
                <img src="laptop1.jpg" alt="Laptop" class=slider-img>
              </a>
            </div>
            <div class="item">
              <a href="laptop2.jpg" data-lightbox="digital"class=slider-img>
                <img src="laptop2.jpg" alt="Charger">
              </a>
            </div>
            <div class="item">
              <a href="laptop3.jpg" data-lightbox="digital" class=slider-img>
                <img src="laptop3.jpg" alt="Laptop Bag">
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="aid-text">
        <div class="aid-title">Peralatan Digital</div>
        <div class="aid-desc">
        Laptop <strong>Dell Latitude 3420</strong>, Intel i5, RAM 8GB, SSD 256GB bersama <strong>pengecas asal</strong>, tetikus Logitech, dan beg laptop kalis air.
        </div>
      </div>
    </div>

    <!-- Bahan Pembelajaran -->
    <div class="aid-row">
      <div class="aid-image">
        <div id="carousel-bahan" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="item active">
              <a href="bahan1.jpg" data-lightbox="bahan">
                <img src="bahan1.jpg" alt="Pen">
              </a>
            </div>
            <div class="item">
              <a href="bahan2.jpg" data-lightbox="bahan">
                <img src="bahan2.jpg" alt="Notebook">
              </a>
            </div>
            <div class="item">
              <a href="bahan3.jpg" data-lightbox="bahan">
                <img src="bahan3.jpg" alt="Set Alat Tulis">
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="aid-text">
        <div class="aid-title">Bahan Pembelajaran</div>
        <div class="aid-desc">
        Set alat tulis Faber-Castell (pen, pensel, pemadam), buku nota A5 jenama Campus (80 muka surat), dan kalkulator Casio FX-570EX.
        </div>
      </div>
    </div>

    <!-- Keperluan Diri -->
    <div class="aid-row">
      <div class="aid-image">
        <div id="carousel-keperluan" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="item active">
              <a href="keperluan1.jpg" data-lightbox="keperluan">
                <img src="keperluan1.jpg" alt="Set Asas">
              </a>
            </div>
            <div class="item">
              <a href="keperluan2.jpg" data-lightbox="keperluan">
                <img src="keperluan2.jpg" alt="Set Perempuan">
              </a>
            </div>
            <div class="item">
              <a href="keperluan3.jpg" data-lightbox="keperluan">
                <img src="keperluan3.jpg" alt="Set Lelaki">
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="aid-text">
        <div class="aid-title">Keperluan Diri</div>
        <div class="aid-desc">
        Set mandian harian: sabun mandi, syampu, ubat gigi, berus gigi, tuala kecil, sikat dan lain-lain.
        <br><strong>Wanita:</strong> termasuk tuala wanita Sofy. 
        <br><strong>Lelaki:</strong> termasuk pencuci muka Nivea Men.
        </div>
      </div>
    </div>

  </div>

</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

</body>
</html>
