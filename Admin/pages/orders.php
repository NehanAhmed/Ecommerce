<?php
include "./include/db.php";

// Handle status update via AJAX
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'updateStatus') {
    $orderId = intval($_POST['orderId']);
    $status = in_array($_POST['status'], ['pending', 'paid']) ? $_POST['status'] : 'pending';
    
    $updateSql = "UPDATE orders SET status = '$status' WHERE id = $orderId";
    if ($conn->query($updateSql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Status updated']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Update failed']);
    }
    exit;
}

// Orders table se data lana
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

$orders = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container">
  <h2 class="mb-4 text-center fw-bold text-primary">🛒 Customer Orders</h2>

  <div class="table-responsive shadow-lg bg-white rounded p-3">
    <table class="table table-hover table-bordered align-middle">
      <thead class="table-primary">
        <tr>
          <th>#</th>
          <th>Customer Name</th>
          <th>Number</th>
          <th>Address</th>
          <th>Product Name</th>
          <th>Image</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($orders)): ?>
          <tr>
            <td colspan="10" class="text-center text-muted py-4">
              No orders found. Waiting for your first order!
            </td>
          </tr>
        <?php else: ?>
          <?php foreach ($orders as $index => $order): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><?= htmlspecialchars($order['customerName']) ?></td>
              <td><?= htmlspecialchars($order['customerNumber']) ?></td>
              <td><?= htmlspecialchars($order['customerAddress']) ?></td>
              <td><?= htmlspecialchars($order['productName']) ?></td>
              <td>
                <img src="<?= htmlspecialchars($order['productImage']) ?>" 
                     alt="<?= htmlspecialchars($order['productName']) ?>" 
                     width="60" height="60" 
                     class="rounded" style="object-fit: cover;">
              </td>
              <td><?= htmlspecialchars($order['productPrice'] * $order['quantity']) ?></td>
              <td><?= htmlspecialchars($order['quantity']) ?></td>
              <td><?= date('d M Y, h:i A', strtotime($order['dt'] ?? 'now')) ?></td>
              <td>
                <select class="form-select form-select-sm status-select" 
                        data-order-id="<?= $order['id'] ?>"
                        onchange="updateStatus(this)">
                  <option value="pending" <?= ($order['status'] ?? 'pending') == 'pending' ? 'selected' : '' ?>>Pending</option>
                  <option value="paid" <?= ($order['status'] ?? 'pending') == 'paid' ? 'selected' : '' ?>>Paid</option>
                </select>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<script>
function updateStatus(selectElement) {
    const orderId = selectElement.getAttribute('data-order-id');
    const status = selectElement.value;
    
    fetch(window.location.href, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=updateStatus&orderId=' + orderId + '&status=' + status
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            alert('Error updating status');
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>

</body>
</html>