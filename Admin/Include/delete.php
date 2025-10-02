<?php
include "db.php";

if (isset($_GET['type']) && isset($_GET['id'])) {
    $id = (int)$_GET['id']; 
    $type = $_GET['type'];

    if ($type === "product") {
        $sql = "DELETE FROM `products` WHERE `id` = $id";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            header("Location: ../?addproduct");
            exit();
        } else {
            echo "Error deleting product: " . mysqli_error($conn);
        }
    }

    if ($type === "collection") {
        $sql = "DELETE FROM `collection` WHERE `id` = $id";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            header("Location: ../?collection");
            exit();
        } else {
            echo "Error deleting collection: " . mysqli_error($conn);
        }
    }
}
?>
