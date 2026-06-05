<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "buyer") {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$cart_query = mysqli_query($conn, "
    SELECT cart.product_id, products.price
    FROM cart
    JOIN products ON cart.product_id = products.id
    WHERE cart.user_id = $user_id
");

if (mysqli_num_rows($cart_query) == 0) {
    header("Location: cart.php");
    exit();
}

$total = 0;
$items = [];

while ($row = mysqli_fetch_assoc($cart_query)) {
    $items[] = $row;
    $total += $row['price'];
}

$delivery_fee = 60;
$grand_total = $total + $delivery_fee;

mysqli_query($conn, "INSERT INTO orders (user_id, total) VALUES ($user_id, $grand_total)");

$order_id = mysqli_insert_id($conn);

foreach ($items as $item) {
    $product_id = $item['product_id'];
    $price = $item['price'];
    $quantity = 1;

    mysqli_query($conn, "
        INSERT INTO order_items (order_id, product_id, price, quantity)
        VALUES ($order_id, $product_id, $price, $quantity)
    ");

       $category_check = mysqli_query($conn,
        "SELECT category FROM products WHERE id = $product_id");

      $product = mysqli_fetch_assoc($category_check);

    if ($product && $product['category'] == 'Pre-Loved Items') {

        mysqli_query($conn,
            "UPDATE products
             SET status='sold'
             WHERE id = $product_id");
    }
}
mysqli_query($conn, "DELETE FROM cart WHERE user_id = $user_id");

header("Location: success.php");
exit();
?>