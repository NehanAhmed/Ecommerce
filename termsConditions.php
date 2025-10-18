<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Terms & Conditions</title>
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

    .policy-container {
      padding: 60px 0;
    }

    .policy-card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.12);
      padding: 40px;
      transition: all 0.3s ease;
    }

    .policy-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 35px rgba(0,0,0,0.18);
    }

    .policy-card h2 {
      color: #2d3748;
      font-weight: 700;
      margin-bottom: 25px;
    }

    .policy-card h4 {
      color: #4a5568;
      margin-top: 30px;
      font-weight: 600;
    }

    .policy-card p, .policy-card li {
      color: #4a5568;
      line-height: 1.8;
      font-size: 1.05rem;
    }

    .policy-card ul {
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
    <h1><i class="fas fa-file-contract me-2"></i>Terms & Conditions</h1>
    <p>Know your rights and responsibilities before shopping with us.</p>
  </div>
</div>

<!-- Terms Content -->
<div class="container policy-container">
  <div class="policy-card">
    <h2>Welcome to Our Online Store</h2>
    <p>By accessing or using our website, you agree to comply with and be bound by the following Terms and Conditions. Please read them carefully before using our services.</p>

    <h4>1. General Use</h4>
    <p>This website is owned and operated by our company. All content, images, and information are protected by copyright and intellectual property laws.</p>

    <h4>2. Account Responsibility</h4>
    <p>When creating an account, you are responsible for maintaining the confidentiality of your account information and for all activities that occur under your account.</p>

    <h4>3. Product Information</h4>
    <p>We strive to provide accurate product details, but we do not guarantee that product descriptions or pricing are free of errors. We reserve the right to correct errors at any time without prior notice.</p>

    <h4>4. Orders & Payments</h4>
    <p>All orders are subject to acceptance and product availability. We reserve the right to cancel any order if fraud or unauthorized activity is suspected.</p>

    <h4>5. Shipping & Delivery</h4>
    <p>Delivery times are estimated and may vary. We are not responsible for delays caused by third-party shipping carriers or unforeseen circumstances.</p>

    <h4>6. Returns & Refunds</h4>
    <p>Our return and refund policy is outlined on our <a href="refundPolicy.php">Refund & Return Policy</a> page. Please review it before initiating a return.</p>

    <h4>7. Limitation of Liability</h4>
    <p>We are not liable for any indirect, incidental, or consequential damages arising from the use or inability to use our website or products.</p>

    <h4>8. Changes to Terms</h4>
    <p>We reserve the right to update or modify these Terms & Conditions at any time without prior notice. Continued use of the website constitutes your acceptance of any changes.</p>

    <a href="/Ecommerce/index.php" class="btn-home"><i class="fas fa-arrow-left me-2"></i>Back to Home</a>
  </div>
</div>

<?php include("includes/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
