<?php
include './db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName = $_POST['product_name'];
    $productImage = $_FILES['product_image'];
    $productDescription = $_POST['product_description'];
    $collectionId = $_POST['collection_id'];

    // Handle file upload and database insertion here
        // Handle file upload
        $targetDir = "../uploads/collections/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $imageName = basename($productImage['name']);
        $targetFile = $targetDir . uniqid() . "_" . $imageName;

        if (move_uploaded_file($productImage['tmp_name'], $targetFile)) {
            // Save relative path to DB
            $imagePath = str_replace("../", "", $targetFile);
            $sql = "INSERT INTO `products`(`productName`, `productImage`, `description`, `collection_id`) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $productName, $imagePath, $productDescription, $collectionId);
            $stmt->execute();
            $stmt->close();
            header("Location: ../?addproduct");
        } else {
            // Handle upload error
            echo "Image upload failed.";
        }
}
?>