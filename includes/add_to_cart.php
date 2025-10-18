<?php
session_start();
?>
<?php include("../admin/include/db.php"); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $quantity = $_POST['quantity'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Check karo product already cart me to nahi
    $found = false;
    foreach ($_SESSION['cart'] as &$item){
    if ($item['id'] == $id) {
        $item['quantity'] += $quantity; // agar already ho to quantity badha do
        $found = true;
    }
    }
unset($item);

// Agar nahi tha to add karo

if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'quantity' => $quantity
        ];
    }

    // Redirect back to product page or home
    header("Location: ../landingPage.php?id=$id&added=1");
    exit();
}
?>