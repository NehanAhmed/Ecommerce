<?php
include "./include/db.php";

// Get all collections
$sql = "SELECT `id`, `name`, `image`, `dt` FROM `collection`";
$res = mysqli_query($conn, $sql);

if (!$res) {
  die("Query failed: " . mysqli_error($conn));
}

// Put collections in array
$collections = [];
while ($row_collection = mysqli_fetch_assoc($res)) {
  $collections[] = $row_collection;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Collections</title>
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
    
    .collection-name {
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
  <?php if (isset($_GET['error']) && $_GET['error'] === 'has_products'): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Cannot Delete!</strong> This collection contains products. Please delete them first.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php elseif (isset($_GET['success']) && $_GET['success'] === 'deleted'): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    Collection deleted successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php elseif (isset($_GET['error']) && $_GET['error'] === 'failed'): ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    Something went wrong while deleting. Try again.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
<?php endif; ?>
  <div class="rounded bg-white shadow-sm">
    <div class="d-flex justify-content-between align-items-center border-bottom p-3">
      <h4 class="m-0">Collections Management</h4>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
        <i class="fas fa-plus me-1"></i>Add Collection
      </button>
    </div>

    <!-- Add Collection Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add New Collection</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <form method="post" action="./include/add-collection.php" enctype="multipart/form-data">
              <div class="mb-3">
                <label class="form-label">Collection Name</label>
                <input type="text" class="form-control" name="collection_name" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Collection Image</label>
                <input class="form-control" type="file" name="collection_image" accept="image/*" required>
              </div>
              
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Collection</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Collections Table -->
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th style="width: 10%;">S.No</th>
            <th style="width: 25%;">Collection Name</th>
            <th style="width: 20%;">Image</th>
            <th style="width: 25%;">Date & Time</th>
            <th style="width: 20%;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($collections)): ?>
          <tr>
            <td colspan="5" class="text-muted py-4">
              No collections found. Add your first collection!
            </td>
          </tr>
          <?php else: ?>
            <?php foreach ($collections as $index => $row): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td class="collection-name"><?= htmlspecialchars($row['name']) ?></td>
              <td>
                <img src="<?= htmlspecialchars($row['image']) ?>" 
                     alt="<?= htmlspecialchars($row['name']) ?>" 
                     width="60" height="60" 
                     style="object-fit: cover;">
              </td>
              <td><?= date('d M Y, h:i A', strtotime($row['dt'])) ?></td>
              <td>
                <div class="btn-group-actions">
                  <!-- Edit Button -->
                  <button class="btn btn-sm btn-warning" 
                          data-bs-toggle="modal" 
                          data-bs-target="#editModal<?= $row['id'] ?>"
                          title="Edit Collection">
                    Edit
                  </button>

                  <!-- Delete Button -->
                  <button class="btn btn-sm btn-danger" 
                          data-bs-toggle="modal" 
                          data-bs-target="#deleteModal<?= $row['id'] ?>"
                          title="Delete Collection">
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
                    <h5 class="modal-title">Edit Collection</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <form method="post" action="./include/update.php" enctype="multipart/form-data">
                    <div class="modal-body">
                      <input type="hidden" name="id" value="<?= $row['id'] ?>">

                      <div class="mb-3">
                        <label class="form-label">Collection Name</label>
                        <input type="text" class="form-control" name="collectionName" 
                               value="<?= htmlspecialchars($row['name']) ?>" required>
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Collection Image</label>
                        <div class="mb-2">
                          <img src="<?= htmlspecialchars($row['image']) ?>" 
                               alt="Current Image" width="80" height="80" 
                               style="object-fit: cover; border-radius: 4px;">
                        </div>
                        <input type="file" class="form-control" name="collectionImage" accept="image/*">
                        <div class="form-text">Leave empty to keep current image</div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary">Update Collection</button>
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
                    <h5 class="modal-title text-danger">Delete Collection</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <div class="text-center mb-3">
                      <img src="<?= htmlspecialchars($row['image']) ?>" 
                           alt="<?= htmlspecialchars($row['name']) ?>" 
                           width="80" height="80" 
                           style="object-fit: cover; border-radius: 4px;">
                    </div>
                    <p class="text-center">
                      Are you sure you want to delete the collection 
                      <strong>"<?= htmlspecialchars($row['name']) ?>"</strong>?
                    </p>
                    <div class="alert alert-warning">
                      <small><i class="fas fa-exclamation-triangle"></i> This action cannot be undone.</small>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="./include/delete.php?type=collection&id=<?= $row['id'] ?>" 
                       class="btn btn-danger">Delete Collection</a>
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