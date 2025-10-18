<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shipping Policy</title>
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
    <h1><i class="fas fa-truck-fast me-2"></i>Shipping Policy</h1>
    <p>We ensure fast, reliable, and secure delivery for every order.</p>
  </div>
</div>

<!-- Shipping Policy Content -->
<div class="container policy-container">
  <div class="policy-card">
    <h2>Our Shipping Commitment</h2>
    <p>We aim to provide a smooth and hassle-free shipping experience for all our customers. Please read the following policy to understand how we process and deliver your orders.</p>

    <h4>1. Processing Time</h4>
    <p>All orders are processed within <strong>1-3 business days</strong> (excluding weekends and holidays) after receiving your order confirmation email. You will receive another notification when your order has shipped.</p>

    <h4>2. Shipping Methods & Delivery Time</h4>
    <ul>
      <li><strong>Standard Shipping:</strong> 5–10 business days</li>
      <li><strong>Express Shipping:</strong> 2–5 business days</li>
      <li><strong>International Shipping:</strong> Delivery times may vary depending on location and customs clearance.</li>
    </ul>

    <h4>3. Shipping Rates</h4>
    <p>Shipping charges for your order will be calculated and displayed at checkout. Occasionally, we offer free shipping promotions, so keep an eye out for discounts.</p>

    <h4>4. Order Tracking</h4>
    <p>Once your order has shipped, you will receive a confirmation email with a tracking number. You can use this number to monitor your shipment’s progress.</p>

    <h4>5. Customs, Duties & Taxes</h4>
    <p>We are not responsible for any customs and taxes applied to your order. All fees imposed during or after shipping are the responsibility of the customer.</p>

    <h4>6. Delays & Delivery Issues</h4>
    <p>While we strive to meet estimated delivery times, delays can occur due to high order volume, weather conditions, or carrier issues. If your order is delayed beyond the expected timeframe, please contact our support team for assistance.</p>

    <h4>7. Incorrect Address</h4>
    <p>Customers are responsible for providing accurate shipping information. We are not responsible for orders shipped to incorrectly provided addresses.</p>

    <h4>8. Lost or Damaged Packages</h4>
    <p>If your package is lost or arrives damaged, please contact us immediately. We will work with the carrier to resolve the issue as quickly as possible.</p>

    <a href="/Ecommerce/index.php" class="btn-home"><i class="fas fa-arrow-left me-2"></i>Back to Home</a>
  </div>
</div>

<?php include("includes/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
