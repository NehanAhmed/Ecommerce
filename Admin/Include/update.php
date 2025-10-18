<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Check if this is for PRODUCT update
    if (isset($_POST['productName'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $productName = mysqli_real_escape_string($conn, $_POST['productName']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $productPrice = mysqli_real_escape_string($conn, $_POST['productPrice']);
        $collection_id = mysqli_real_escape_string($conn, $_POST['collection_id']);
        $productImage = $_FILES['productImage']['name'];

        // Handle file upload
        if ($productImage && $_FILES['productImage']['error'] == 0) {
            $targetDir = "../uploads/";
            $fileExtension = strtolower(pathinfo($productImage, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            
            if (in_array($fileExtension, $allowedExtensions)) {
                $newFileName = uniqid() . '_' . basename($productImage);
                $targetFile = $targetDir . $newFileName;
                
                if (move_uploaded_file($_FILES['productImage']['tmp_name'], $targetFile)) {
                    $imageToUpdate = $targetFile;
                } else {
                    echo "Error uploading file.";
                    exit();
                }
            } else {
                echo "Invalid file type. Only JPG, JPEG, PNG, GIF, WEBP are allowed.";
                exit();
            }
        } else {
            // Get existing image if no new image is uploaded
            $query = "SELECT productImage FROM products WHERE id = '$id'";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $imageToUpdate = $row['productImage'];
            } else {
                echo "Product not found.";
                exit();
            }
        }

        $sql = "UPDATE `products` SET 
                `productName`='$productName',
                `productImage`='$imageToUpdate',
                `description`='$description',
                `productPrice`='$productPrice',
                `collection_id`='$collection_id' 
                WHERE `id` = '$id'";

        $res = mysqli_query($conn, $sql);
        if ($res) {
            header("Location: ../?addproduct");
            exit();
        } else {
            echo "Error updating product: " . mysqli_error($conn);
        }
    }
    
    // Check if this is for COLLECTION update
    elseif (isset($_POST['collectionName'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $collectionName = mysqli_real_escape_string($conn, $_POST['collectionName']);
        $collectionImage = $_FILES['collectionImage']['name'];

        // Handle file upload
        if ($collectionImage && $_FILES['collectionImage']['error'] == 0) {
            $targetDir = "../uploads/";
            $fileExtension = strtolower(pathinfo($collectionImage, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            
            if (in_array($fileExtension, $allowedExtensions)) {
                $newFileName = uniqid() . '_' . basename($collectionImage);
                $targetFile = $targetDir . $newFileName;
                
                if (move_uploaded_file($_FILES['collectionImage']['tmp_name'], $targetFile)) {
                    $imageToUpdate = $targetFile;
                } else {
                    echo "Error uploading file.";
                    exit();
                }
            } else {
                echo "Invalid file type. Only JPG, JPEG, PNG, GIF, WEBP are allowed.";
                exit();
            }
        } else {
            // Get existing image if no new image is uploaded
            $query = "SELECT image FROM collection WHERE id = '$id'";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $imageToUpdate = $row['image'];
            } else {
                echo "Collection not found.";
                exit();
            }
        }

        $sql = "UPDATE `collection` SET 
                `name`='$collectionName',
                `image`='$imageToUpdate' 
                WHERE `id` = '$id'";

        $res = mysqli_query($conn, $sql);
        if ($res) {
            header("Location: ../?collection");
            exit();
        } else {
            echo "Error updating collection: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid request.";
    }
} else {
    echo "Invalid request method.";
}
?>