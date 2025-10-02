<?php
include "./include/db.php";

// Get all products with collection names
$sql = "SELECT 
    products.id,
    products.productName,
    products.productImage,
    products.dt,
    products.description,
    products.collection_id,
    collection.name as collection_name
FROM products
JOIN collection ON products.collection_id = collection.id
ORDER BY products.id DESC";
$res = mysqli_query($conn, $sql);

// Get all collections for dropdown
$sql_collections = "SELECT * FROM `collection`";
$res_collections = mysqli_query($conn, $sql_collections);
$collections = [];
while ($row_collection = mysqli_fetch_assoc($res_collections)) {
  $collections[] = $row_collection;
}

if (!$res) {
  die("Query failed: " . mysqli_error($conn));
}

// Put products in array
$products = [];
while ($row_product = mysqli_fetch_assoc($res)) {
  $products[] = $row_product;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .parent {
      background-color: #f8f9fa;
      min-height: 100vh;
    }
    
    .table th {
      background-color: #f8f9fa;
      border-top: none;
      font-weight: 600;
      text-align: center;
      vertical-align: middle;
    }
    
    .table td {
      text-align: center;
      vertical-align: middle;
    }
    
    .table img {
      border-radius: 4px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .product-name {
      font-weight: 500;
    }
    
    .product-description {
      max-width: 200px;
      text-overflow: ellipsis;
      overflow: hidden;
      white-space: nowrap;
    }
    
    .collection-badge {
      background-color: #e3f2fd;
      color: #1976d2;
      padding: 4px 8px;
      border-radius: 12px;
      font-size: 0.85em;
      font-weight: 500;
    }
    
    .btn-group-actions {
      display: flex;
      gap: 5px;
      justify-content: center;
    }
  </style>
</head>
<body>
<div class="parent p-5">
  <div class="rounded bg-white shadow-sm">
    <div class="d-flex justify-content-between align-items-center border-bottom p-3">
      <h4 class="m-0">Products Management</h4>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
        <i class="fas fa-plus me-1"></i>Add Product
      </button>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add New Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <form method="post" action="./include/product.php" enctype="multipart/form-data">
              <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" class="form-control" name="product_name" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Product Description</label>
                <textarea class="form-control" name="product_description" rows="3" required></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">Collection</label>
                <select class="form-select" name="collection_id" required>
                  <option value="" disabled selected>Select a collection</option>
                  <?php foreach ($collections as $collection): ?>
                    <option value="<?= $collection['id'] ?>"><?= htmlspecialchars($collection['name']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Product Image</label>
                <input class="form-control" type="file" name="product_image" accept="image/*" required>
              </div>
              
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Product</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Products Table -->
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th style="width: 8%;">S.No</th>
            <th style="width: 18%;">Product Name</th>
            <th style="width: 15%;">Image</th>
            <th style="width: 25%;">Description</th>
            <th style="width: 12%;">Collection</th>
            <th style="width: 15%;">Date & Time</th>
            <th style="width: 15%;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($products)): ?>
          <tr>
            <td colspan="7" class="text-muted py-4">
              No products found. Add your first product!
            </td>
          </tr>
          <?php else: ?>
            <?php foreach ($products as $index => $row): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td class="product-name"><?= htmlspecialchars($row['productName']) ?></td>
              <td>
                <img src="<?= htmlspecialchars($row['productImage']) ?>" 
                     alt="<?= htmlspecialchars($row['productName']) ?>" 
                     width="60" height="60" 
                     style="object-fit: cover;">
              </td>
              <td>
                <div class="product-description" title="<?= htmlspecialchars($row['description']) ?>">
                  <?= htmlspecialchars($row['description']) ?>
                </div>
              </td>
              <td>
                <span class="collection-badge"><?= htmlspecialchars($row['collection_name']) ?></span>
              </td>
              <td><?= date('d M Y, h:i A', strtotime($row['dt'])) ?></td>
              <td>
                <div class="btn-group-actions">
                  <!-- Edit Button -->
                  <button class="btn btn-sm btn-warning" 
                          data-bs-toggle="modal" 
                          data-bs-target="#editModal<?= $row['id'] ?>"
                          title="Edit Product">
                    Edit
                  </button>

                  <!-- Delete Button -->
                  <button class="btn btn-sm btn-danger" 
                          data-bs-toggle="modal" 
                          data-bs-target="#deleteModal<?= $row['id'] ?>"
                          title="Delete Product">
                    Delete
                  </button>
                </div>
              </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <form method="post" action="./include/update.php" enctype="multipart/form-data">
                    <div class="modal-body">
                      <input type="hidden" name="id" value="<?= $row['id'] ?>">
                      <input type="hidden" name="type" value="product">

                      <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="productName" 
                               value="<?= htmlspecialchars($row['productName']) ?>" required>
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Product Description</label>
                        <textarea class="form-control" name="description" rows="3" required><?= htmlspecialchars($row['description']) ?></textarea>
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Collection</label>
                        <select class="form-select" name="collection_id" required>
                          <option value="" disabled>Select a collection</option>
                          <?php foreach ($collections as $collection): ?>
                          <option value="<?= $collection['id'] ?>" 
                                  <?= $collection['id'] == $row['collection_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($collection['name']) ?>
                          </option>
                          <?php endforeach; ?>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Product Image</label>
                        <div class="mb-2">
                          <img src="<?= htmlspecialchars($row['productImage']) ?>" 
                               alt="Current Image" width="80" height="80" 
                               style="object-fit: cover; border-radius: 4px;">
                        </div>
                        <input type="file" class="form-control" name="productImage" accept="image/*">
                        <div class="form-text">Leave empty to keep current image</div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Delete Modal -->
            <div class="modal fade" id="deleteModal<?= $row['id'] ?>" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title text-danger">Delete Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <div class="text-center mb-3">
                      <img src="<?= htmlspecialchars($row['productImage']) ?>" 
                           alt="<?= htmlspecialchars($row['productName']) ?>" 
                           width="80" height="80" 
                           style="object-fit: cover; border-radius: 4px;">
                    </div>
                    <p class="text-center">
                      Are you sure you want to delete the product 
                      <strong>"<?= htmlspecialchars($row['productName']) ?>"</strong>?
                    </p>
                    <div class="alert alert-warning">
                      <small><i class="fas fa-exclamation-triangle"></i> This action cannot be undone.</small>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="./include/delete.php?type=product&id=<?= $row['id'] ?>" 
                       class="btn btn-danger">Delete Product</a>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>