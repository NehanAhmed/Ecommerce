<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body {
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .hero-section {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 60px 0 80px 0;
      margin-bottom: -30px;
      position: relative;
      overflow: hidden;
    }

    .hero-section::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 80px;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23f5f7fa" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
      background-size: cover;
    }

    .hero-section h1 {
      font-size: 3rem;
      font-weight: 800;
      margin-bottom: 10px;
      text-shadow: 2px 2px 8px rgba(0,0,0,0.2);
    }

    .hero-section p {
      font-size: 1.1rem;
      opacity: 0.95;
    }

    .about-container {
      padding: 60px 0;
    }

    .about-card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.12);
      padding: 40px;
      margin-bottom: 40px;
      transition: all 0.3s ease;
    }

    .about-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 35px rgba(0,0,0,0.18);
    }

    .about-card h2 {
      color: #2d3748;
      font-weight: 700;
      margin-bottom: 25px;
    }

    .about-card h4 {
      color: #4a5568;
      margin-top: 25px;
      font-weight: 600;
    }

    .about-card p, .about-card li {
      color: #4a5568;
      line-height: 1.8;
      font-size: 1.05rem;
    }

    .about-card ul {
      padding-left: 20px;
    }

    .btn-home {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #fff;
      padding: 12px 35px;
      border-radius: 50px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      display: inline-block;
      margin-top: 30px;
    }

    .btn-home:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
      color: #fff;
    }
  </style>
</head>
<body>

<?php include("includes/header.php"); ?>

<!-- Hero Section -->
<div class="hero-section text-center">
  <div class="container">
    <h1><i class="fas fa-users me-2"></i>About Us</h1>
    <p>Learn more about our mission, vision, and values</p>
  </div>
</div>

<!-- About Content -->
<div class="container about-container">

  <!-- Our Story -->
  <div class="about-card">
    <h2>Our Story</h2>
    <p>Founded with the goal of delivering exceptional products and experiences, our eCommerce store has grown into a trusted destination for customers worldwide. Our journey started with a vision to make online shopping seamless, enjoyable, and reliable.</p>
  </div>

  <!-- Mission -->
  <div class="about-card">
    <h2>Our Mission</h2>
    <p>Our mission is to provide high-quality products at competitive prices while ensuring excellent customer service. We aim to build lasting relationships with our customers based on trust, transparency, and satisfaction.</p>
  </div>

  <!-- Vision -->
  <div class="about-card">
    <h2>Our Vision</h2>
    <p>To become a leading online store recognized for innovation, customer satisfaction, and quality. We aspire to constantly improve our services and offer products that make a difference in the lives of our customers.</p>
  </div>

  <!-- Values -->
  <div class="about-card">
    <h2>Our Values</h2>
    <ul>
      <li><strong>Customer First:</strong> We prioritize our customers in every decision we make.</li>
      <li><strong>Integrity:</strong> We are honest and transparent in all our dealings.</li>
      <li><strong>Innovation:</strong> We continuously improve our products and services.</li>
      <li><strong>Quality:</strong> We maintain high standards in everything we offer.</li>
      <li><strong>Community:</strong> We believe in giving back and supporting our community.</li>
    </ul>
  </div>

  <a href="/Ecommerce/index.php" class="btn-home"><i class="fas fa-arrow-left me-2"></i>Back to Home</a>
</div>

<?php include("includes/footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
