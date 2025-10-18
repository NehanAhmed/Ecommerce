<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Privacy Policy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body {
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
    }

    .hero-section {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 70px 0 100px;
      text-align: center;
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
      text-shadow: 2px 2px 8px rgba(0,0,0,0.25);
    }

    .hero-section p {
      font-size: 1.2rem;
      opacity: 0.95;
    }

    .policy-container {
      background: #fff;
      border-radius: 20px;
      padding: 50px;
      margin-top: -50px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }

    .policy-container h2 {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 20px;
      color: #2d3748;
      position: relative;
    }

    .policy-container h2::after {
      content: '';
      width: 70px;
      height: 4px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      position: absolute;
      bottom: -10px;
      left: 0;
      border-radius: 2px;
    }

    .policy-container p {
      font-size: 1.05rem;
      line-height: 1.8;
      color: #4a5568;
      margin-bottom: 20px;
    }

    .policy-container ul {
      margin-left: 20px;
      color: #4a5568;
      line-height: 1.8;
    }

    .policy-container ul li {
      margin-bottom: 10px;
    }

    .contact-box {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-radius: 15px;
      padding: 30px;
      text-align: center;
      margin-top: 40px;
      box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
    }

    .contact-box h4 {
      font-weight: 700;
      margin-bottom: 15px;
    }

    .contact-box p {
      margin: 0;
      font-size: 1.05rem;
    }

    @media (max-width: 768px) {
      .policy-container {
        padding: 30px 20px;
      }

      .hero-section h1 {
        font-size: 2.3rem;
      }

      .hero-section p {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
  <?php include("includes/header.php"); ?>

  <!-- Hero Section -->
  <div class="hero-section">
    <div class="container">
      <h1><i class="fas fa-user-shield me-3"></i>Privacy Policy</h1>
      <p>Your privacy matters — learn how we protect and use your information.</p>
    </div>
  </div>

  <!-- Privacy Policy Content -->
  <div class="container policy-container">
    <h2>Introduction</h2>
    <p>
      Welcome to our Privacy Policy page. Your privacy is extremely important to us, and this policy explains how we collect, use, and protect your personal information when you visit or make a purchase from our website.
    </p>

    <h2>Information We Collect</h2>
    <p>We may collect the following types of information:</p>
    <ul>
      <li>Personal details such as name, email address, and contact information.</li>
      <li>Payment details when processing your orders.</li>
      <li>Technical data like your IP address, browser type, and browsing behavior.</li>
    </ul>

    <h2>How We Use Your Information</h2>
    <p>Your data helps us improve your experience. We use the information for:</p>
    <ul>
      <li>Processing and fulfilling your orders.</li>
      <li>Sending order confirmations, updates, and promotional offers.</li>
      <li>Improving website functionality and user experience.</li>
    </ul>

    <h2>Data Protection</h2>
    <p>
      We implement advanced security measures to protect your personal data. All sensitive transactions are encrypted, and we never sell, rent, or share your data with third parties without your consent.
    </p>

    <h2>Your Rights</h2>
    <p>
      You have the right to request access to the personal information we hold about you, request corrections, or ask for your data to be deleted.
    </p>

    <div class="contact-box">
      <h4><i class="fas fa-envelope me-2"></i>Contact Us</h4>
      <p>If you have any questions about this Privacy Policy, please contact us at:</p>
      <p><strong>Email:</strong> support@yourdomain.com</p>
      <p><strong>Phone:</strong> +1 (123) 456-7890</p>
    </div>
  </div>

  <?php include("includes/footer.php"); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
