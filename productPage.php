<?php
// Start session safely
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        .products-section {
            padding: 40px 0 60px 0;
        }

        .search-filter-container {
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            margin-bottom: 50px;
        }

        .search-box {
            position: relative;
            max-width: 600px;
            margin: 0 auto 30px;
        }

        .search-box input {
            border-radius: 50px;
            padding: 18px 60px 18px 30px;
            border: 2px solid #e2e8f0;
            font-size: 1.05rem;
            width: 100%;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
            outline: none;
        }

        .search-box button {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 50px;
            padding: 10px 25px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .search-box button:hover {
            transform: translateY(-50%) scale(1.05);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .filter-section {
            border-top: 2px solid #f0f0f0;
            padding-top: 25px;
        }

        .filter-btn {
            border: 2px solid #667eea;
            background: white;
            color: #667eea;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 5px;
            text-decoration: none;
            display: inline-block;
        }

        .filter-btn:hover, .filter-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .section-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 35px;
            text-align: center;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card-title {
            color: #2d3748;
            font-size: 1.1rem;
        }

        .card-text {
            color: #28a745;
            font-weight: 700;
            font-size: 1.3rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .no-products {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .no-products i {
            font-size: 4rem;
            color: #cbd5e0;
            margin-bottom: 20px;
        }

        .no-products h4 {
            color: #4a5568;
            margin-bottom: 10px;
        }

        .no-products p {
            color: #718096;
        }
    </style>
</head>
<body>
<?php include("includes/header.php"); ?>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container text-center">
            <h1><i class="fas fa-shopping-bag me-3"></i>Our Products</h1>
            <p>Discover amazing products at great prices</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container products-section">
        
        <?php
        include("admin/include/db.php");

        // Get search query
        $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
        
        // Get all collections
        $result_collections = $conn->query("SELECT * FROM collection ORDER BY name ASC");
        ?>

        <!-- Search & Filter Container -->
        <div class="search-filter-container">
            <!-- Search Box -->
            <form method="GET" action="productPage.php">
                <div class="search-box">
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Search products by name..." 
                           value="<?= htmlspecialchars($search) ?>">
                    <button type="submit">
                        <i class="fas fa-search me-1"></i> Search
                    </button>
                </div>
                <?php if (isset($_GET['collection_id'])): ?>
                    <input type="hidden" name="collection_id" value="<?= htmlspecialchars($_GET['collection_id']) ?>">
                <?php endif; ?>
            </form>

            <!-- Filter Section -->
            <div class="filter-section">
                <div class="text-center">
                    <h5 class="mb-4 fw-bold"><i class="fas fa-filter me-2"></i>Filter by Collection</h5>
                    <a href="productPage.php<?= $search ? '?search=' . urlencode($search) : '' ?>" class="filter-btn <?= !isset($_GET['collection_id']) ? 'active' : '' ?>">
                        All Products
                    </a>
                    <?php
                    while ($row = $result_collections->fetch_assoc()) {
                        $collectionId = $row['id'];
                        $collectionName = htmlspecialchars($row['name']);
                        $active = (isset($_GET['collection_id']) && $_GET['collection_id'] == $collectionId) ? 'active' : '';
                        $searchParam = $search ? '&search=' . urlencode($search) : '';
                        echo "<a href='productPage.php?collection_id=$collectionId$searchParam' class='filter-btn $active'>$collectionName</a>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php
        // Build query based on filters
        $where_conditions = [];
        
        if (isset($_GET['collection_id']) && !empty($_GET['collection_id'])) {
            $collectionId = intval($_GET['collection_id']);
            $where_conditions[] = "collection_id = $collectionId";
        }
        
        if (!empty($search)) {
            $where_conditions[] = "productName LIKE '%$search%'";
        }
        
        $where_clause = !empty($where_conditions) ? "WHERE " . implode(" AND ", $where_conditions) : "";
        $sql = $conn->query("SELECT * FROM products $where_clause ORDER BY id DESC");
        ?>

        <!-- Products Grid -->
        <h2 class="section-title">
            <?php 
            if (!empty($search)) {
                echo "Search Results for \"" . htmlspecialchars($search) . "\"";
            } elseif (isset($_GET['collection_id'])) {
                echo "Filtered Products";
            } else {
                echo "All Products";
            }
            ?>
        </h2>

        <?php if ($sql->num_rows > 0): ?>
        <div class="row g-4">
            <?php
            while ($row = $sql->fetch_assoc()) {
                $product_Id = $row['id'];
                $productImgPath = '/Ecommerce/admin/' . htmlspecialchars($row['productImage']);
                $product_Name = htmlspecialchars($row['productName']);
                $product_Price = htmlspecialchars($row['productPrice']);

                echo "
                <div class='col-6 col-md-4 col-lg-3'>
                    <div class='card h-100 border-0 shadow-sm overflow-hidden position-relative' style='border-radius: 15px; transition: all 0.3s ease;' onmouseover=\"this.style.transform='translateY(-10px)'; this.classList.add('shadow-lg')\" onmouseout=\"this.style.transform='translateY(0)'; this.classList.remove('shadow-lg')\">
                        <div class='position-relative overflow-hidden' style='height: 250px;'>
                            <img src='$productImgPath' alt='$product_Name' class='card-img-top w-100 h-100' style='object-fit: cover; transition: transform 0.3s ease;' onmouseover='this.style.transform=\"scale(1.1)\"' onmouseout='this.style.transform=\"scale(1)\"'>
                        </div>
                        <div class='card-body text-center py-3'>
                            <h5 class='card-title mb-2 fw-semibold'>$product_Name</h5>
                            <p class='card-text mb-3'>Rs. $product_Price</p>
                            <a href='landingPage.php?id=$product_Id' class='btn btn-primary'>Shop Now</a>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>
        <?php else: ?>
        <div class="no-products">
            <i class="fas fa-box-open"></i>
            <h4>No Products Found</h4>
            <p>
                <?php if (!empty($search)): ?>
                    No products match your search "<?= htmlspecialchars($search) ?>". Try different keywords.
                <?php else: ?>
                    No products available in this collection.
                <?php endif; ?>
            </p>
            <a href="productPage.php" class="btn btn-primary mt-3">
                <i class="fas fa-arrow-left me-2"></i>View All Products
            </a>
        </div>
        <?php endif; ?>

    </div> 

<?php include("./Include/footer.php"); ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>