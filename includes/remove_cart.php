<?php
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check agar cart set hai
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $id) {
                unset($_SESSION['cart'][$key]); // remove that item
                break;
            }
        }
        // Re-index array to avoid gaps
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    // Redirect back to cart page
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?removed=1");
    exit();
}
?>
