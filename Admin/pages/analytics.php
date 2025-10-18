<?php
include "./include/db.php";
?>

<?php
// Fetch Analytics Data
// Total Sales
$result1 = mysqli_query($conn, "SELECT SUM(productPrice * quantity) AS total_sales FROM orders");
$row1 = mysqli_fetch_assoc($result1);
$total_sales = $row1['total_sales'] ?? 0;

// Total Orders
$result2 = mysqli_query($conn, "SELECT COUNT(*) AS total_orders FROM orders");
$row2 = mysqli_fetch_assoc($result2);
$total_orders = $row2['total_orders'] ?? 0;

// Total Customers
$result3 = mysqli_query($conn, "SELECT COUNT(DISTINCT customerNumber) AS total_customers FROM orders");
$row3 = mysqli_fetch_assoc($result3);
$total_customers = $row3['total_customers'] ?? 0;

// Pending Orders
$result4 = mysqli_query($conn, "SELECT COUNT(*) AS pending_orders FROM orders WHERE status='Pending'");
$row4 = mysqli_fetch_assoc($result4);
$pending_orders = $row4['pending_orders'] ?? 0;

// Paid Orders
$result5 = mysqli_query($conn, "SELECT COUNT(*) AS paid_orders FROM orders WHERE status='Paid'");
$row5 = mysqli_fetch_assoc($result5);
$paid_orders = $row5['paid_orders'] ?? 0;

// Total Collections
$result6 = mysqli_query($conn, "SELECT COUNT(*) AS total_collections FROM collection");
$row6 = mysqli_fetch_assoc($result6);
$total_collections = $row6['total_collections'] ?? 0;

// Total Products
$result7 = mysqli_query($conn, "SELECT COUNT(*) AS total_products FROM products");
$row7 = mysqli_fetch_assoc($result7);
$total_products = $row7['total_products'] ?? 0;
?>
<!-- Analytics Content - No HTML/BODY tags -->
<style>
  .card {
    border: none;
    border-radius: 15px;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
  }
  .icon-shape {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
  }
</style>

<div class="container-fluid py-4">

  <div class="row">
    <!-- Total Sales -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Sales</p>
                <h5 class="font-weight-bolder">
                  RS.<?= number_format($total_sales) ?>
                </h5>
                <p class="mb-0 text-muted">
                  Total revenue generated
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                <i class="fa-solid fa-dollar-sign text-white fs-4"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Orders -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Orders</p>
                <h5 class="font-weight-bolder">
                  <?= $total_orders ?>
                </h5>
                <p class="mb-0 text-muted">Orders placed</p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                <i class="fa-solid fa-cart-shopping text-white fs-4"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Customers -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Customers</p>
                <h5 class="font-weight-bolder">
                  <?= $total_customers ?>
                </h5>
                <p class="mb-0 text-muted">Unique customers</p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                <i class="fa-solid fa-users text-white fs-4"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending / Paid Orders -->
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Order Status</p>
                <h6 class="font-weight-bolder text-warning mb-1">Pending: <?= $pending_orders ?></h6>
                <h6 class="font-weight-bolder text-success">Paid: <?= $paid_orders ?></h6>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                <i class="fa-solid fa-receipt text-white fs-4"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <!-- Total Collections -->
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Collections</p>
                  <h5 class="font-weight-bolder">
                    <?= $total_collections ?>
                  </h5>
                  <p class="mb-0 text-muted">Collections created</p>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                  <i class="fa-solid fa-layer-group text-white fs-4"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Total Products -->
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Products</p>
                  <h5 class="font-weight-bolder">
                    <?= $total_products ?>
                  </h5>
                  <p class="mb-0 text-muted">Products available</p>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                  <i class="fa-solid fa-box text-white fs-4"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

  </div>
</div>