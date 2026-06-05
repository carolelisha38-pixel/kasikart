<?php
session_start();
include("includes/db.php");

if (!isset($_GET['id'])) {
    header("Location: products.php");
    exit();
}

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT products.*, users.fullname, users.email 
                               FROM products 
                               JOIN users ON products.user_id = users.id 
                               WHERE products.id = $id");

if (mysqli_num_rows($result) == 0) {
    header("Location: products.php");
    exit();
}

$product = mysqli_fetch_assoc($result);

$message = "";

if (isset($_POST['add_to_cart'])) {

    if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "buyer") {
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $product_id = $product['id'];

    $check = mysqli_query($conn, "SELECT * FROM cart WHERE user_id=$user_id AND product_id=$product_id");

    if (mysqli_num_rows($check) > 0) {

    $message = "This product is already in your cart.";

} else {

    /* Seller of product being added */
    $new_seller_id = $product['user_id'];

    /* Check existing cart items */
    $cart_seller_check = mysqli_query($conn, "
        SELECT products.user_id
        FROM cart
        JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = $user_id
        LIMIT 1
    ");

    if (mysqli_num_rows($cart_seller_check) > 0) {

        $cart_item = mysqli_fetch_assoc($cart_seller_check);
        $existing_seller_id = $cart_item['user_id'];

        if ($existing_seller_id != $new_seller_id) {

            $message = "You can only add products from one seller at a time. Please checkout or clear your cart first.";

        } else {

            mysqli_query($conn,
                "INSERT INTO cart(user_id, product_id)
                 VALUES($user_id, $product_id)");

            $message = "Product added to cart.";
        }

    } else {

        mysqli_query($conn,
            "INSERT INTO cart(user_id, product_id)
             VALUES($user_id, $product_id)");

        $message = "Product added to cart.";
    }
}
}
    
$cart_count = 0;

if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] == "buyer") {
    $buyer_id = $_SESSION['user_id'];
    $cart_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM cart WHERE user_id = $buyer_id");
    $cart_data = mysqli_fetch_assoc($cart_result);
    $cart_count = $cart_data['total'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $product['name']; ?> | KasiKart</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

<header class="shop-header">
    <button class="menu-btn" onclick="openSidebar()">
        <i class="fa-solid fa-bars"></i>
    </button>

    <div class="logo">
        <h1>KasiKart</h1>
    </div>

    <nav class="shop-icons">
        <a href="buyer/cart.php" title="Cart" class="cart-icon">
            <i class="fa-solid fa-cart-shopping"></i>

            <?php if ($cart_count > 0) { ?>
        <span class="cart-count"><?php echo $cart_count; ?></span>
    <?php } ?>
        </a>
</nav>
</header>
<div id="sidebar" class="sidebar">
    <button class="close-btn" onclick="closeSidebar()">×</button>

    <a href="../index.php">Home</a>
    <a href="../about.php">About</a>
    <a href="../contact.php">Contact</a>
</div>

<div class="dashboard">

    <div class="product-detail">

        <?php if ($product['image'] != "") { ?>
            <img src="uploads/<?php echo $product['image']; ?>" alt="Product Image">
        <?php } ?>

        <div>
            <h1><?php echo $product['name']; ?></h1>
            <p><strong>Price:</strong> R<?php echo number_format($product['price'], 2); ?></p>
            <p><strong>Description:</strong> <?php echo $product['description']; ?></p>
            <p><strong>Seller:</strong> <?php echo $product['fullname']; ?></p>
            <p><strong>Seller Email:</strong> <?php echo $product['email']; ?></p>

            <?php if ($message != "") { ?>

    <div class="<?php echo strpos($message, 'Product added') !== false ? 'success-box' : 'warning-box'; ?>">
        <?php echo $message; ?>
    </div>

    <?php } ?>

            

<form method="POST" style="box-shadow:none; padding:0; width:auto;">
    <button type="submit" name="add_to_cart">Add to Cart</button>
</form>

            <div class="dashboard-links">
                <a href="products.php">Back to Products</a>
            </div>
        </div>

    </div>

</div>

<script>
    function openSidebar(){
        document.getElementById("sidebar").classList.add("active");
    }

    function closeSidebar(){
        document.getElementById("sidebar").classList.remove("active");
    }
</script>

</body>
</html>