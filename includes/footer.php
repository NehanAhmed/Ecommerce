<?php
include("admin/include/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- ✅ Font Awesome CDN (Latest) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SzlrxWriC3U5l5EfsQd4hF6QbG8Gk4Yf5pZ6k5suw5J5lM7sYZ0j8V+PqQgl9HY6Np+Q8S2utFJ5B7rj2s4jQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>.
<style>
  /* 🌐 Footer Custom Styling - No Navbar Impact */
  .site-footer {
    background: #f8f9fa;
    color: #555;
    padding-top: 30px;
    font-size: 0.95rem;
  }

  .site-footer .footer-top {
    border-bottom: 1px solid #ddd;
    padding: 15px 0;
    text-align: center;
  }

  .site-footer .footer-icons a {
    margin: 0 10px;
    color: #555;
    text-decoration: none;
    font-size: 1.2rem;
  }

  .site-footer .footer-icons a:hover {
    color: #1e5f60;
  }

  .site-footer .footer-title {
    font-weight: 600;
    margin-bottom: 15px;
    color: #000;
  }

  .site-footer .footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .site-footer .footer-links li {
    margin-bottom: 8px;
  }

  .site-footer .footer-links a {
    color: #555;
    text-decoration: none;
    transition: color 0.3s;
  }

  .site-footer .footer-links a:hover {
    color: #1e5f60;
  }

  .site-footer .footer-bottom {
    background: #e9ecef;
    text-align: center;
    padding: 10px 0;
    margin-top: 20px;
    font-size: 0.9rem;
  }

  .site-footer .footer-bottom a {
    color: #1e5f60;
    text-decoration: none;
    font-weight: bold;
  }
</style>

<!-- Footer -->
<footer class="site-footer">
  <div class="footer-top">
    <div class="footer-social">
      <span>Get connected with us on social networks:</span>
      <div class="footer-icons">
        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
<a href="#"><i class="fa-brands fa-twitter"></i></a>
<a href="#"><i class="fa-brands fa-google"></i></a>
<a href="#"><i class="fa-brands fa-instagram"></i></a>
<a href="#"><i class="fa-brands fa-linkedin"></i></a>
<a href="#"><i class="fa-brands fa-github"></i></a>

      </div>
    </div>
  </div>

  <div class="footer-content container">
    <div class="row">
      <div class="col-md-3 col-lg-4 col-xl-3 mb-4">
        <h6 class="footer-title"><i class="fas fa-gem me-2"></i>Company name</h6>
        <p>
          Discover the best deals, trending products, and a seamless shopping experience — delivered right to your doorstep.
        </p>
      </div>

      <div class="col-md-2 col-lg-2 col-xl-2 mb-4">
        <h6 class="footer-title">Useful Links</h6>
        <ul class="footer-links">
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="productPage.php">Products</a></li>
          <li><a href="contact.php">Contact Us</a></li>
        </ul>
      </div>

      <div class="col-md-3 col-lg-2 col-xl-2 mb-4">
        <h6 class="footer-title">Our Policies</h6>
        <ul class="footer-links">
          <li><a href="privacyPolicy.php">Privacy Policy</a></li>
          <li><a href="refundPolicy.php">Refund & Return Policy</a></li>
          <li><a href="termsConditions.php">Terms & conditions</a></li>
          <li><a href="shippingPolicy.php">Shipping Policy</a></li>
          <li><a href="paymentPolicy.php">Payment Policy</a></li>
        </ul>
      </div>

      <div class="col-md-4 col-lg-3 col-xl-3 mb-4">
        <h6 class="footer-title">Contact</h6>
        <p><i class="fas fa-home me-2"></i> New York, NY 10012, US</p>
        <p><i class="fas fa-envelope me-2"></i> info@example.com</p>
        <p><i class="fas fa-phone me-2"></i> + 01 234 567 88</p>
        <p><i class="fas fa-print me-2"></i> + 01 234 567 89</p>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    © 2021 Copyright:
    <a href="#">MDBootstrap.com</a>
  </div>
</footer>

<!-- Font Awesome (for icons) -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>



<!-- Font Awesome (for icons) -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0a02fbb60a.js" crossorigin="anonymous"></script>
</body>
</html>