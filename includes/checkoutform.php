<?php
session_start()
?>
<?php
include __DIR__ . '/../admin/Include/db.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['cart'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    foreach ($_SESSION['cart'] as $item){
        $productName = $item['name'];
        $productImage = $item['image'];
        $productPrice = $item['price'];
        $productQuantity = $item['quantity'];

        $sql = "INSERT INTO `orders`(`customerName`, `customerNumber`, `customerAddress`, `productName`, `productImage`, `productPrice`, `quantity`) VALUES ('$name','$phone','$address','$productName','$productImage','$productPrice','$productQuantity')";

        mysqli_query($conn, $sql);
    }

    // Empty cart after checkout
    unset($_SESSION['cart']);
    echo "<script>
        alert('✅ Order placed successfully!');
        window.location.href = '../index.php';
    </script>";
}
else {
    echo "<script>
        alert('⚠️ Your cart is empty!');
        window.location.href = '../productPage.php';
    </script>";

}
?>