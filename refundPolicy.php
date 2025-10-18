<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Refund & Return Policy</title>
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
    <h1><i class="fas fa-undo-alt me-2"></i>Refund & Return Policy</h1>
    <p>Customer satisfaction is our top priority – shop with confidence.</p>
  </div>
</div>

<!-- Policy Content -->
<div class="container policy-container">
  <div class="policy-card">
    <h2>Easy Returns & Hassle-Free Refunds</h2>
    <p>Thank you for shopping with us! We strive to deliver high-quality products and excellent service. If you're not completely satisfied with your purchase, we're here to help.</p>

    <h4>1. Return Period</h4>
    <p>You have <strong>14 days</strong> from the date you received your order to request a return or exchange.</p>

    <h4>2. Eligibility for Returns</h4>
    <ul>
      <li>The item must be unused, undamaged, and in its original packaging.</li>
      <li>All tags, labels, and accessories must be intact.</li>
      <li>You must provide a valid proof of purchase (e.g., order number or receipt).</li>
    </ul>

    <h4>3. Non-Returnable Items</h4>
    <ul>
      <li>Gift cards and digital products</li>
      <li>Personalized or custom-made items</li>
      <li>Items marked as "Final Sale"</li>
    </ul>

    <h4>4. Refund Process</h4>
    <p>Once we receive and inspect your returned item, we will notify you of the approval or rejection of your refund. Approved refunds will be processed within <strong>5-10 business days</strong> to your original payment method.</p>

    <h4>5. Exchanges</h4>
    <p>If you'd like to exchange an item for a different size, color, or variant, please contact our support team within 14 days of receiving your order.</p>

    <h4>6. Shipping Costs</h4>
    <p>Return shipping costs are the responsibility of the customer unless the return is due to a defective or incorrect item.</p>

    <a href="/Ecommerce/index.php" class="btn-home"><i class="fas fa-arrow-left me-2"></i>Back to Home</a>
  </div>
</div>

<?php include("includes/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
