<?php
include("admin/include/db.php");

if (isset($_GET['id'])) {
    $product_Id = (int) $_GET['id'];

    $sql = "SELECT products.*, collection.name as collection_name 
            FROM `products` 
            LEFT JOIN collection ON products.collection_id = collection.id 
            WHERE products.id = $product_Id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        $error = true;
    }
} else {
    exit();
}

// Get related products from same collection
if (isset($product)) {
    $sql_related = "SELECT * FROM products WHERE collection_id = " . $product['collection_id'] . " AND id != $product_Id LIMIT 4";
    $result_related = $conn->query($sql_related);

    $related_products = [];
    if ($result_related->num_rows > 0) {
        while ($row_related = $result_related->fetch_assoc()) {
            $related_products[] = $row_related;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($product) ? htmlspecialchars($product['productName']) : 'Product Not Found' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .product-image {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        .product-details {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            height: 100%;
        }
        
        .product-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #212529;
            margin-bottom: 20px;
        }
        
        .product-price {
            font-size: 3rem;
            font-weight: 700;
            color: #28a745;
            margin: 25px 0;
        }
        
        .collection-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 25px;
            border-radius: 30px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 25px;
            font-size: 0.95rem;
        }
        
        .btn-add-cart {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 15px 50px;
            font-size: 1.2rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s;
            color: white;
        }
        
        .btn-add-cart:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }
        
        .btn-back {
            background: #6c757d;
            border: none;
            padding: 12px 35px;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 50px;
            transition: all 0.3s;
            color: white;
        }
        
        .btn-back:hover {
            background: #5a6268;
            transform: translateY(-2px);
            color: white;
        }
        
        .product-description {
            line-height: 1.9;
            color: #666;
            font-size: 1.15rem;
            margin: 30px 0;
            text-align: justify;
        }
        
        .product-meta {
            border-top: 2px solid #e9ecef;
            padding-top: 25px;
            margin-top: 30px;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 1rem;
        }
        
        .meta-item i {
            color: #667eea;
            margin-right: 12px;
            font-size: 1.2rem;
        }
        
        .related-section {
            background: white;
            padding: 50px 0;
            margin-top: 60px;
            border-radius: 15px;
        }
        
        .related-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 40px;
            text-align: center;
            color: #212529;
        }
        
        .related-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s;
            height: 100%;
        }
        
        .related-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .related-card img {
            height: 220px;
            object-fit: cover;
        }
        
        .related-card .card-body {
            padding: 20px;
        }
        
        .related-card .card-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 10px;
        }
        
        .related-card .price {
            color: #28a745;
            font-weight: 700;
            font-size: 1.3rem;
        }
        
        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 25px 0;
        }
        
        .quantity-selector button {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid #667eea;
            background: white;
            color: #667eea;
            font-weight: 600;
            font-size: 1.2rem;
            transition: all 0.3s;
        }
        
        .quantity-selector button:hover {
            background: #667eea;
            color: white;
        }
        
        .quantity-selector input {
            width: 70px;
            height: 45px;
            text-align: center;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>

<?php if (isset($error)): ?>
    <div class="container mt-5">
        <div class="alert alert-danger text-center" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Product not found!</strong> The product you're looking for doesn't exist.
            <br><br>
            <a href="index.php" class="btn btn-primary">Go Back to Home</a>
        </div>
    </div>
<?php else: ?>

    <div class="container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" style="text-decoration: none; color: #667eea;">Home</a></li>
                <li class="breadcrumb-item"><a href="productPage.php" style="text-decoration: none; color: #667eea;">Products</a></li>
                <li class="breadcrumb-item active"><?= htmlspecialchars($product['productName']) ?></li>
            </ol>
        </nav>

        <div class="row g-4">
            <!-- Product Image -->
            <div class="col-lg-6">
                <img src="admin/<?= htmlspecialchars($product['productImage']) ?>" 
                     alt="<?= htmlspecialchars($product['productName']) ?>" 
                     class="product-image">
            </div>

            <!-- Product Details -->
            <div class="col-lg-6">
                <div class="product-details">
                    <?php if (isset($product['collection_name'])): ?>
                        <span class="collection-badge">
                            <i class="fas fa-tags me-2"></i><?= htmlspecialchars($product['collection_name']) ?>
                        </span>
                    <?php endif; ?>
                    
                    <h1 class="product-title"><?= htmlspecialchars($product['productName']) ?></h1>
                    
                    <div class="product-price">
                        Rs. <?= htmlspecialchars($product['productPrice']) ?>
                    </div>
                    
                    <div class="product-description">
                        <h5 class="mb-3"><i class="fas fa-info-circle me-2"></i>Description</h5>
                        <?= nl2br(htmlspecialchars($product['description'])) ?>
                    </div>

                    <!-- Quantity Selector -->
                    <div class="quantity-selector">
                        <label class="fw-bold">Quantity:</label>
                        <button onclick="decreaseQty()"><i class="fas fa-minus"></i></button>
                        <input type="number" id="quantity" value="1" min="1" readonly>
                        <button onclick="increaseQty()"><i class="fas fa-plus"></i></button>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-3 mb-4">
                        <form action="includes/add_to_cart.php" method="post">
                             <input type="hidden" name="id" value="<?= $product['id'] ?>">
                             <input type="hidden" name="name" value="<?= htmlspecialchars($product['productName'])?>">
                             <input type="hidden" name="price" value="<?= htmlspecialchars($product['productPrice'])?>">
                             <input type="hidden" name="image" value="<?= htmlspecialchars($product['productImage'])?>">
                             <input type="hidden" id="hiddenQty" name="quantity" value="1">
                        <button class="btn btn-add-cart flex-grow-1">
                            <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                        </button>
                        </form>
                    </div>

                    <!-- Product Meta -->
                    <div class="product-meta">
                        <div class="meta-item">
                            <i class="fas fa-box"></i>
                            <span><strong>Product ID:</strong> #<?= $product['id'] ?></span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span><strong>Added on:</strong> <?= date('d M Y', strtotime($product['dt'])) ?></span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-check-circle"></i>
                            <span><strong>Availability:</strong> <span class="text-success">In Stock</span></span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-truck"></i>
                            <span><strong>Shipping:</strong> Free Delivery</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <?php if (!empty($related_products)): ?>
        <div class="related-section">
            <div class="container">
                <h2 class="related-title">You May Also Like</h2>
                <div class="row g-4">
                    <?php foreach ($related_products as $related): ?>
                        <div class="col-md-6 col-lg-3">
                            <a href="product_detail.php?id=<?= $related['id'] ?>" style="text-decoration: none; color: inherit;">
                                <div class="card related-card">
                                    <img src="admin/<?= htmlspecialchars($related['productImage']) ?>" 
                                        class="card-img-top" 
                                        alt="<?= htmlspecialchars($related['productName']) ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($related['productName']) ?></h5>
                                        <p class="price">Rs. <?= htmlspecialchars($related['productPrice']) ?></p>
                                        <button class="btn btn-outline-primary btn-sm w-100">View Details</button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Back Button -->
        <div class="text-center mt-5">
            <a href="index.php" class="btn btn-back">
                <i class="fas fa-arrow-left me-2"></i>Back to Products
            </a>
        </div>
    </div>

<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function increaseQty() {
        const qtyInput = document.getElementById('quantity');
        qtyInput.value = parseInt(qtyInput.value) + 1;
        document.getElementById('hiddenQty').value = qtyInput.value;
    }

    function decreaseQty() {
        const qtyInput = document.getElementById('quantity');
        if (parseInt(qtyInput.value) > 1) {
            qtyInput.value = parseInt(qtyInput.value) - 1;
            document.getElementById('hiddenQty').value = qtyInput.value;

        }
    }
</script>
</body>
</html>