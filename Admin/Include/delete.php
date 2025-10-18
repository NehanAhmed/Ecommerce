<?php
include "db.php";

if (isset($_GET['type']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $type = $_GET['type'];

    // --- PRODUCT DELETE ---
    if ($type === "product") {
        $sql = "DELETE FROM `products` WHERE `id` = $id";
        $res = mysqli_query($conn, $sql);

        if ($res) {
            header("Location: ../?addproduct&success=deleted");
            exit();
        } else {
            header("Location: ../?addproduct&error=failed");
            exit();
        }
    }

    // --- COLLECTION DELETE ---
    if ($type === "collection") {
        // Step 1: Check if collection has products
        $check = mysqli_query($conn, "SELECT COUNT(*) AS total FROM `products` WHERE collection_id = $id");
        $data = mysqli_fetch_assoc($check);

        if ($data['total'] > 0) {
            // Collection has products → prevent delete
            header("Location: ../?collection&error=has_products");
            exit();
        }

        // Step 2: Delete collection if safe
        $sql = "DELETE FROM `collection` WHERE `id` = $id";
        $res = mysqli_query($conn, $sql);

        if ($res) {
            header("Location: ../?collection&success=deleted");
            exit();
        } else {
            header("Location: ../?collection&error=failed");
            exit();
        }
    }
}
?>
