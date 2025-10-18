<?php
include ("admin/include/db.php");

$result = $conn->query("SELECT * FROM collection");
?>
<?php
$res = $conn->query("SELECT * FROM products");
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - Bootstrap Version</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    * {
      font-family: 'Founder Grotesk', sans-serif;
    }

    /* HERO SECTION */
    .hero {
      position: relative;
      height: 100vh;
      overflow: hidden;
      color: white;
    }

    .hero video {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1;
    }

    .hero-content h1 {
      font-size: 3rem;
      font-weight: bold;
    }

    .hero-content p {
      font-size: 1.5rem;
    }

    /* Explore Button */
    .button {
      --border-right: 6px;
      --text-stroke-color: rgba(255,255,255,0.6);
      --animation-color: #f5220bff;
      --fs-size: 2em;
      letter-spacing: 3px;
      background: transparent;
      border: none;
      text-transform: uppercase;
      font-size: var(--fs-size);
      color: transparent;
      -webkit-text-stroke: 1px var(--text-stroke-color);
      position: relative;
      cursor: pointer;
    }

    .hover-text {
      position: absolute;
      content: attr(data-text);
      color: var(--animation-color);
      width: 0%;
      inset: 0;
      border-right: var(--border-right) solid var(--animation-color);
      overflow: hidden;
      transition: 0.5s;
      -webkit-text-stroke: 1px var(--animation-color);
    }

    .button:hover .hover-text {
      width: 100%;
      filter: drop-shadow(0 0 23px var(--animation-color));
    }

    /* COLLECTION */
    .collection {
      background-color: green;
      padding: 2rem 0;
      text-align: center;
      color: white;
    }

    .collection h2 {
      font-size: 2.5rem;
      text-decoration: underline;
    }

    /* Cards */
    .card-custom {
      width: 100%;
      height: 250px;
      background-image: linear-gradient(163deg, #00ff75 0%, #3700ff 100%);
      border-radius: 20px;
      transition: all .3s;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card-inner {
      width: 95%;
      height: 95%;
      background-color: #1a1a1a;
      border-radius: 20px;
      transition: all .2s;
    }

    .card-inner:hover {
      transform: scale(0.98);
    }

    .card-custom:hover {
      box-shadow: 0px 0px 30px 1px rgba(0, 255, 117, 0.30);
    }
  </style>
</head>
<body>

<?php include("includes/header.php"); ?>

<!-- HERO SECTION -->
<section class="hero d-flex align-items-center text-white">
  <video autoplay muted loop playsinline src="sources/heroVideo.webm"></video>

  <div class="container hero-content">
    <div class="row">
      <div class="col-lg-8">
        <h1>Welcome to Our Store</h1>
        <p>Discover the best products at unbeatable prices.</p>
        <a href="#">
          <button class="button" data-text="Explore">
            <a style="text-decoration: none; color: rgba(255,255,255,0.6);" href="productPage.php"><span class="actual-text">&nbsp;Explore&nbsp;</span></a>
            <span aria-hidden="true" class="hover-text">&nbsp;Explore&nbsp;</span>
          </button>
        </a>
      </div>
    </div>
  </div>
</section>


<!-- COLLECTION SECTION -->
<section class="collection py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="display-4 fw-bold text-dark mb-3">Our Collection</h2>
      <div class="mx-auto" style="width: 80px; height: 4px; background: linear-gradient(90deg, #0d6efd 0%, #6610f2 100%); border-radius: 2px;"></div>
    </div>
    
    <div class="row g-4 justify-content-center">
      
<?php
while ($row = $result->fetch_assoc()) {
    $collectionId = $row['id'];
    $imgPath = '/Ecommerce/admin/' . htmlspecialchars($row['image']);
    $collectionName = htmlspecialchars($row['name']);
    
    echo "
    <div class='col-6 col-md-4 col-lg-3'>
      <div class='card h-100 border-0 shadow-sm overflow-hidden position-relative' style='border-radius: 15px; transition: all 0.3s ease;' onmouseover=\"this.style.transform='translateY(-10px)'; this.classList.add('shadow-lg')\" onmouseout=\"this.style.transform='translateY(0)'; this.classList.remove('shadow-lg')\">
        <div class='position-relative overflow-hidden' style='height: 250px;'>
          <img src='$imgPath' alt='$collectionName' class='card-img-top w-100 h-100' style='object-fit: cover; transition: transform 0.3s ease;' onmouseover='this.style.transform=\"scale(1.1)\"' onmouseout='this.style.transform=\"scale(1)\"'>
        </div>
        <div class='card-body text-center py-3'>
          <h5 class='card-title mb-0 fw-semibold'><a href='productPage.php?collection_id=$collectionId'>$collectionName</a></h5>
        </div>
      </div>
    </div>";
}
?>
    </div>
  </div>
</section>
<!-- Collection Section End -->

<!-- Products Section Start  -->
<section class="products py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="display-4 fw-bold text-dark mb-3">Our Products</h2>
      <div class="mx-auto" style="width: 80px; height: 4px; background: linear-gradient(90deg, #0d6efd 0%, #6610f2 100%); border-radius: 2px;"></div>
    </div>
    
    <div class="row g-4 justify-content-center">
      
<?php
while ($row = $res->fetch_assoc()) {
    $productImgPath = '/Ecommerce/admin/' . htmlspecialchars($row['productImage']);
    $product_Name = htmlspecialchars($row['productName']);
    $product_Price = htmlspecialchars($row['productPrice']);
    $product_Id = $row['id'];
    echo "
    <div class='col-6 col-md-4 col-lg-3'>
      <div class='card h-100 border-0 shadow-sm overflow-hidden position-relative' style='border-radius: 15px; transition: all 0.3s ease;' onmouseover=\"this.style.transform='translateY(-10px)'; this.classList.add('shadow-lg')\" onmouseout=\"this.style.transform='translateY(0)'; this.classList.remove('shadow-lg')\">
        <div class='position-relative overflow-hidden' style='height: 250px;'>
          <img src='$productImgPath' alt='$product_Name' class='card-img-top w-100 h-100' style='object-fit: cover; transition: transform 0.3s ease;' onmouseover='this.style.transform=\"scale(1.1)\"' onmouseout='this.style.transform=\"scale(1)\"'>
        </div>
        <div class='card-body text-center py-3'>
          <h5 class='card-title mb-0 fw-semibold'>$product_Name</h5>
          <p class='card-text'>Price: $product_Price PKR</p>
          <a href='landingPage.php?id=$product_Id' class='btn btn-primary'>Shop Now</a>
        </div>
      </div>
    </div>";
}
?>
    </div>
  </div>
</section>

<?php include("includes/footer.php"); ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
