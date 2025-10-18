<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../admin/Include/db.php';
?>

<?php 
$sql = "SELECT * FROM `products`";
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Your Website</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    /* 🔹 Transparent Navbar Styling */
    .navbar {
      background: transparent !important;
      position: absolute;
      top: 0;
      width: 100%;
      z-index: 1000;
      transition: background 0.3s ease, padding 0.3s ease;
      padding: 15px 0;
      display: flex;
      align-items: center;
    }

    .navbar.scrolled {
      background: rgba(0, 0, 0, 0.85) !important;
      backdrop-filter: blur(10px);
      padding: 8px 0;
    }

    .navbar-brand {
      color: #fff !important;
      font-weight: 600;
      font-size: 1.5rem;
      letter-spacing: 1px;
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 25px;
      margin: 0;
    }

    .nav-links li a {
      color: black !important;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .nav-links li a:hover {
      color: #1e5f60ff !important;
    }

    /* 🔥 Custom Hamburger */
    .hamburger {
      display: none;
      flex-direction: column;
      justify-content: center;
      gap: 5px;
      width: 30px;
      height: 25px;
      cursor: pointer;
    }

    .hamburger span {
      height: 3px;
      width: 100%;
      background: #fff;
      border-radius: 2px;
      transition: 0.3s;
    }

    /* ✨ Toggle animation */
    .hamburger.active span:nth-child(1) {
      transform: rotate(45deg) translateY(8px);
    }
    .hamburger.active span:nth-child(2) {
      opacity: 0;
    }
    .hamburger.active span:nth-child(3) {
      transform: rotate(-45deg) translateY(-8px);
    }
      .cart-icon-btn {
    background: transparent !important;
    border: none !important;
    color: black;
    font-size: 1.5rem;
    cursor: pointer;
    margin-right: 30px;
    transition: all 0.3s ease;
    padding: 0;
  }

  .cart-icon-btn:hover {
    color: #1e5f60ff !important;
    transform: scale(1.1);
  }

  /* When navbar is scrolled */
  .navbar.scrolled .cart-icon-btn {
    color: #fff;
  }

  .navbar.scrolled .cart-icon-btn:hover {
    color: #1e5f60ff !important;
  }
    /* 🔥 Responsive Styles */
    @media (max-width: 992px) {
      .hamburger {
        display: flex;
      }

      .nav-links {
        position: absolute;
        top: 70px;
        right: 0;
        background: rgba(0, 0, 0, 0.9);
        flex-direction: column;
        width: 200px;
        text-align: right;
        padding: 15px;
        display: none;
      }

      .nav-links.active {
        display: flex;
      }

      .nav-links li a {
        color: #fff !important;
        padding: 10px;
      }
    }
  </style>
</head>
<body>

<!-- 🔻 Transparent Navbar Start -->
<nav class="navbar">
  <div class="container d-flex justify-content-between align-items-center">
    <a class="navbar-brand" href="index.php">
      <span class="brand-text">Your Brand</span>
    </a>

    <!-- 🔥 Custom Hamburger -->
    <div class="hamburger" id="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>

    <!-- 🔥 Custom Nav Links -->
    <ul class="nav-links" id="navLinks">
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About Us</a></li>
      <li><a href="productPage.php">Products</a></li>
      <li><a href="contact.php">Contact Us</a></li>
    </ul>
  </div>
<button class="btn cart-icon-btn" data-bs-toggle="offcanvas" data-bs-target="#cartSidebar">
  <i class="fa-solid fa-cart-shopping"></i>
</button>
<div class="offcanvas offcanvas-end" tabindex="-1" id="cartSidebar">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Your Cart 🛒</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <?php if (isset($_GET['removed']) && $_GET['removed'] == 1): ?>
<script>
  alert("🗑️ Product removed from cart successfully!");
</script>
<?php endif; ?>

    <?php if (!empty($_SESSION['cart'])): ?>
      <?php foreach ($_SESSION['cart'] as $item): ?>
          <div class="d-flex justify-content-around align-items-center mb-3">
              <img src="admin/<?= htmlspecialchars($item['image']) ?>" style="width:60px;height:60px;object-fit:cover;margin-right:15px;">
              <div>
                  <p class="mb-1 fw-bold"><?= htmlspecialchars($item['name']) ?></p>
                  <p class="mb-0">Rs. <?= htmlspecialchars($item['price']) ?> x <?= htmlspecialchars($item['quantity']) ?></p>
                  <p class="mb-0">Total: Rs. <?= htmlspecialchars($item['price'] * $item['quantity']) ?></p>
              </div>
                  <a href="includes/remove_cart.php?id=<?= $item['id'] ?>" class="btn btn-danger btn-sm">Remove</a>

          </div>
          
      <?php endforeach; ?>
  <?php else: ?>
      <p class="text-center text-muted">Your cart is empty 🛒</p>
  <?php endif; ?>
  </div>
  <!-- Checout Form Start -->
 <div class="container mt-5">
  <h2 class="text-center mb-4">Checkout Form</h2>

  <form action="./includes/checkoutform.php" method="POST" class="p-4 bg-white shadow rounded">
    <div class="mb-3">
      <label class="form-label">Full Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Phone</label>
      <input type="text" name="phone" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Address</label>
      <textarea name="address" class="form-control" rows="3" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary w-100">Place Order</button>
  </form>
</div>
<!-- Checkout Form End -->
</div>


</nav>
<!-- 🔺 Navbar End -->



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- 🔥 Scroll effect + Hamburger toggle -->
<script>
  // Navbar scroll background
  window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".navbar");
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }
  });

  // Hamburger toggle
  const hamburger = document.getElementById("hamburger");
  const navLinks = document.getElementById("navLinks");

  hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    navLinks.classList.toggle("active");
  });
</script>

</body>
</html>
