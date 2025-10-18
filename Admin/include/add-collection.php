    <?php
    include 'db.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $collectionName = $_POST['collection_name'];
        $collectionImage = $_FILES['collection_image'];

        // Handle file upload
        $targetDir = "../uploads/collections/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $imageName = basename($collectionImage['name']);
        $targetFile = $targetDir . uniqid() . "_" . $imageName;

        if (move_uploaded_file($collectionImage['tmp_name'], $targetFile)) {
            // Save relative path to DB
            $imagePath = str_replace("../", "", $targetFile);
            $sql = "INSERT INTO `collection`(`name`, `image`) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $collectionName, $imagePath);
            $stmt->execute();
            $stmt->close();
            header("Location: ../?collection");
        } else {
            // Handle upload error
            echo "Image upload failed.";
        }
    }
    ?>